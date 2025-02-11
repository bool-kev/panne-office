<?php

namespace App\Http\Controllers;

use App\Mail\NotifMailer;
use App\Models\Image;
use App\Models\Incident;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class IncidentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $incidents=$request->user()->operateur?->departement->incidents->where('statut_id','=',2)->load(['departement']);
        return view('operateur.incident',['incidents'=>$incidents]);
    }
    public function archives(Request $request)
    {
        $incidents=$request->user()->operateur?->departement->incidents->whereIn('statut_id',[3,4])->load(['departement']);
        return view('operateur.incident',['incidents'=>$incidents]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Service $service)
    {
        $service->load('departements.ville');
        return view('frontend.incident.form',['service'=>$service,'incident'=>new Incident()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data=$request->validate([
            'location'=>'required',
            'description'=>['string','nullable'],
            'departement_id'=>['required','exists:departements,id'],
            'images'=>['required','array','max:5'],
            'images.*'=>['required','image','max:2048','mimes:jpeg,png,jpg'],
        ]);
        $data['user_id']=$request->user()->id;
        $data['statut_id']=1;
        $request->whenFilled('location',function($location){
            $data['location'] = json_decode($location);
        });
        
        $incident=Incident::create($data);
        foreach($request->images as $image){
            Image::create([
                'path'=>$image->store('Images','public'),
                'incident_id'=>$incident->id
            ]);
        }
        return to_route('citoyen.dashboard')->with('success','Incident declare avec succces');
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
    public function edit(Incident $incident)
    {
        // dd($incident->departement->service);
        return view('frontend.incident.form',['service'=>$incident->departement->service->load('departements.ville'),'incident' => $incident]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Incident $incident)
    {
        $data=$request->validate([
            'description'=>['string','nullable'],
            'departement_id'=>['required','exists:departements,id'],
            'images'=>['array','max:5'],
            'images.*'=>['required','image','max:2048','mimes:jpeg,png,jpg'],
        ]);
        
        $incident->update($data);
        $request->whenFilled('images',function(){
            foreach($request->images as $image){
            Image::create([
                'path'=>$image->store('Images','public'),
                'incident_id'=>$incident->id
            ]);
        }
        });
        return to_route('citoyen.dashboard')->with('success','Incident mis a jour avec succces');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Incident $incident)
    {
        $incident->delete();
        return back()->with('success','Incident supprimé avec succès');
    }

    public function eval(Request $request, Incident $incident)
    {
        $request->validate([
            'avis'=>['required','exists:notes,id'],
        ]);
        $incident->update(['note_id'=>$request->avis]);
        return back()->with('success','Merci de votre avis');
    }

    public function setStatut(Request $request, Incident $incident)
    {
        $tab=[
            'Receptionner'=>2,
            'Rejeter'=>4,
            'Traiter'=>3,
        ];
        $request->validate([
            'statut'=>['required','in:Receptionner,Rejeter,Traiter'],
            'point'=>['nullable','numeric','min:1','max:15']
        ]);

        $request->whenFilled('point',function() use($request,$incident){
            $incident->point=$request->point;
            $incident->save();
        });
        $incident->update(['statut_id'=>$tab[$request->statut]]);
        Mail::to($incident->user)->send(new NotifMailer($request->user(),$incident));
        return back()->with('success','Operation effectue avec succès');
    }
}
