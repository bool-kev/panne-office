<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Service;
use App\Models\Incident;
use App\Models\Operateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OperateurController extends Controller
{
    //
    public function home(Request $request)
    {
        $incidents = $request->user()->operateur?->departement->incidents;
        // dd($request->user()->operateur?->departement);
        return view('operateur.index', ['incidents' => $incidents->where('statut_id', 1)->load(['statut', 'departement', 'images']), 'today' => $incidents->filter(function($incident){
            return $incident->created_at->isToday();
        })->count(), 'process' => $incidents->where('statut_id', 2)->count(), 'resolved' => $incidents->where('statut_id', 3)->count(), 'total' => $incidents->count()]);
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'nom' => 'required|max:255',
            'prenom' => 'required|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'telephone' => 'required|string|max:255|unique:users,telephone',
            'departement_id' => 'required|exists:departements,id',
            'password' => 'required|min:4|confirmed',
        ]);
        $data['role_id'] = 2;
        $user = User::create($data);
        Operateur::create([
            'user_id' => $user->id,
            'departement_id' => $request->departement_id
        ]);
        return back()->with('success', 'Operateur ajouté avec succès');
    }

    public function destroy(Operateur $operateur)
    {
        $operateur->user()->delete();
        return back()->with('success', 'Operateur supprimé avec succès');
    }

    public function statistiques(Request $request)
    {
        //dd(phpinfo());
        $operateur=$request->user()->operateur->load('departement.service.incidents');
        return view('operateur.statistiques', ['service'=>$operateur->departement->service]);
    }
}
