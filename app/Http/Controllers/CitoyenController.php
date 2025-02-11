<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Helper\Helper;
use App\Models\Incident;
use Illuminate\Http\Request;

class CitoyenController extends Controller
{
    public function home(Request $request)
    {
        // dd($request->user()->incidents->sum('pointFidelite'));
        Helper::router($request->user());
        return view('frontend.index',['services' => \App\Models\Service::all(),'incidents'=>$request->user()->incidents->load('statut')]);
    }

    public function incident(Request $request)
    {
        return view('frontend.incident.index',['notes'=>Note::all(),'incidents'=>$request->user()->incidents->load('statut','departement.ville','user')->where('statut_id',3)]);
    }
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
        //
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
    public function edit(string $id)
    {
        //
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
