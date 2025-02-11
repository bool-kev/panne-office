<?php

namespace App\Livewire;

use App\Models\Departement;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Service;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Collection;

class UserRecompense extends Component
{
    public string $filter = "total";
    public Service $service;

    public Collection $users;

    public array $points=[];

    public function search()
    {
        $operateur = Auth::user()->operateur->load('departement.service.incidents');

        if ($this->filter === "total") {
            foreach ($operateur->departement->service->incidents->where('statut_id',3)->groupBy('user_id') as $user => $collection) {
                $total[$user] = $collection->sum('point');
            }
            $this->users = User::findMany(array_keys($total??[]))->take(10);
            $this->points=$total??[];
        } elseif ($this->filter === "mois") {
            foreach ($operateur->departement->service->incidents->where('statut_id',3)->whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->groupBy('user_id') as $user => $collection) {
                $month[$user] = $collection->sum('point');
            }
            $this->users = User::findMany(array_keys($month??[]))->take(10);
            $this->points=$month??[];
        } else {
            foreach (Departement::findOrFail($this->filter)->incidents->where('statut_id',3)->groupBy('user_id') as $user => $collection) {
                $dept[$user] = $collection->sum('point');
            }
            $this->users=User::findMany(array_keys($dept??[]))->take(10);
            $this->points=$dept??[];
        }

    }
    public function mount($service)
    {
        $this->service = $service;
        $this->search();
    }
    public function render()
    {
        return view('livewire.user-recompense', ['users' => $this->users, 'filter' => $this->filter]);
    }
}
