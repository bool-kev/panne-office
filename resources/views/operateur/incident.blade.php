@extends('layouts.operateur-dash')
@php($route = request()->route()->action['as'])
@section('content2')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-12">
                        <x-session key="success" :time="10000"></x-session>
                    </div>
                    <div class="col-12">
                        <h2 class="title-1 m-b-25">Incident en Cours de traitement</h2>
                        @if (!$incidents->isEmpty())
                            <div class="table-responsive table--no-card m-b-40">
                                <table class="table table-borderless table-striped table-earning">
                                    <thead>
                                        <tr>
                                            <th>date</th>
                                            <th colspan="2">description</th>
                                            <th>localisation</th>
                                            <th>{{ $route !== 'operateur.incident.list' ? 'Statut' : 'Traiter?' }}</th>
                                            <th class="text-right">Avis</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($incidents as $incident)
                                            <tr>
                                                <td>{{ $incident->updated_at->diffForHumans() }}</td>
                                                <td colspan="2">{{ Str::limit($incident->description, 30) }}</td>
                                                <td><a href="https://www.google.com/maps?q={{ json_decode($incident->location)->latitude }},{{ json_decode($incident->location)->longitude }}"
                                                        target="_blank">
                                                        Voir la localisation
                                                    </a></td>
                                                <td class="text-right">
                                                    @if ($route === 'operateur.incident.list')
                                                        {{-- <form action="{{ route('operateur.incident.update', $incident) }}"
                                                            method="post" id="form-{{ $incident->id }}"> --}}
                                                            @csrf
                                                            <div class="form-check form-switch">
                                                                <button class="form-check-input fs-3" type="checkbox"
                                                                    role="switch"
                                                                    id="flexSwitchCheckChecked-{{ $incident->id }}"
                                                                    style="cursor: pointer" name="statut" value="Traiter"
                                                                    data-toggle="modal" data-target="#smallmodal-{{$incident->id}}"></button>

                                                            </div>


                                                        </form>
                                                    @else
                                                        <p @class([
                                                            'text-danger' => $incident->statut->id === 4,
                                                            'text-success' => $incident->statut->id === 3,
                                                        ])>{{ $incident->statut->nom }}</p>
                                                    @endif
                                                </td>
                                                <td>{{ $incident->note?->nom }}</td>
                                            </tr>

                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p class="fs-3 py-3 ms-3">Aucun incident en cours de traitement </p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!-- modal small -->
        @foreach ($incidents as $incident)
            <div class="modal fade w-100" id="smallmodal-{{$incident->id}}" tabindex="-1"
            role="dialog" aria-labelledby="smallmodalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form
                        action="{{ route('operateur.incident.update',$incident) }}"
                        method="post"
                        enctype="multipart/form-data"
                        id="form-{{ $incident->id }}">
                        @csrf
                        <input type="hidden" name="statut" value="Traiter">
                        <div class="modal-header">
                            <h5 class="modal-title"
                                id="smallmodalLabel">Point de recompense</h5>
                            <button type="button" class="close"
                                data-dismiss="modal"
                                aria-label="Close">
                                <span
                                    aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for=""
                                        class=" form-control-label">Nombre de point</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <select name="point" id="" class="form-select"  onchange='setTimeout(()=>{ document.getElementById("form-{{ $incident->id }}").submit()},2000)'>
                                        <option value="">selectionnez le nombre de point</option>
                                        <option value="1">1 point</option>
                                        <option value="3">3 points</option>
                                        <option value="5">5 points</option>
                                        <option value="10">10 points</option>
                                        <option value="15">15 points</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button"
                                class="btn btn-secondary"
                                data-dismiss="modal">fermer</button>
                        </div>
                    {{-- </form> --}}
                </div>
            </div>
        </div>
        <!-- end modal small -->
        @endforeach
    </div>
        <!-- END MAIN CONTENT-->
    @endsection
