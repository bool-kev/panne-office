<?php

namespace App\Http\Controllers;

use App\Models\Departement;
use App\Models\Operateur;
use App\Models\Service;
use App\Models\Ville;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data=$request->validate([
            'nom'=>['required','string','max:255'],
            'icons'=>['required','image','mimes:jpeg,png,jpg','max:4096']
        ]);
        Service::create([
            'nom'=>$data['nom'],
            'icons'=> $request->icons->store('Images/icons','public'),
        ]);
        return back()->with('success','Service enregistré avec succès');
    }


    public function storeDept(Request $request,Service $service)
    {
        $request->validate([
            'ville_id'=>['required','exists:villes,id'],
        ]);
        Departement::create([
            'service_id'=>$service->id,
            'ville_id'=>$request->ville_id,
        ]);
        return back()->with(['success'=>'Département ajouté avec succès','mod'=>true]);
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        $operateurs=Operateur::whereIn('departement_id',$service->departements->pluck('id'))->get();
        session()->flash('service',$service->id);
        // dd(Ville::whereNotIn('id',$service->departements->pluck('ville_id'))->get());
        return view('backend.dept.index',['operateurs'=>$operateurs->load('user'),'service'=>$service,'villes'=>Ville::whereNotIn('id',$service->departements->pluck('ville_id'))->get()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
