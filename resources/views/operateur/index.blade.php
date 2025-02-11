@extends('layouts.operateur-dash')
@section('content2')
    <script src="
    https://cdn.jsdelivr.net/npm/leaflet@1.9.4/dist/leaflet.min.js
    "></script>
    <link href="
https://cdn.jsdelivr.net/npm/leaflet@1.9.4/dist/leaflet.min.css
" rel="stylesheet">

    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"> --}}
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="overview-wrap">
                            <h2 class="title-1">Dashboard <span style="font-size: 0.8rem">Operateur de {{request()->user()->operateur->departement->service->nom}} ({{request()->user()->operateur->departement->ville->nom}})</span></h2>
                        </div>
                    </div>
                </div>
                <div class="row m-t-25">
                    <div class="col-sm-6 col-lg-3">
                        <div class="overview-item overview-item--c1">
                            <div class="overview__inner">
                                <div class="overview-box clearfix">
                                    <div class="icon">
                                        <i class="zmdi zmdi-calendar-note"></i>
                                    </div>
                                    <div class="text">
                                        <h2>{{ $today }}</h2>
                                        <span>Declarations du jour</span>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="overview-item overview-item--c1">
                            <div class="overview__inner">
                                <div class="overview-box clearfix">
                                    <div class="icon">
                                        <i class="zmdi zmdi-chart-donut"></i>
                                    </div>
                                    <div class="text">
                                        <h2>{{ $process }}</h2>
                                        <span>En cours de traitement</span>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="overview-item overview-item--c1">
                            <div class="overview__inner">
                                <div class="overview-box clearfix">
                                    <div class="icon">
                                        <i class="zmdi zmdi-assignment-check"></i>
                                    </div>
                                    <div class="text">
                                        <h2>{{ $resolved }}</h2>
                                        <span>Incident resolus</span>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="overview-item overview-item--c1">
                            <div class="overview__inner">
                                <div class="overview-box clearfix">
                                    <div class="icon">
                                        <i class="zmdi zmdi-view-list-alt"></i>
                                    </div>
                                    <div class="text">
                                        <h2>{{ $total }}</h2>
                                        <span>Total d'incidents</span>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>


                </div>
                <div class="row">
                    <div class="col-12">
                        <x-session key="success" :time="10000"></x-session>
                    </div>
                    <div class="col-12">
                        <h2 class="title-1 m-b-25">Incident declarés</h2>
                        @if (!$incidents->isEmpty())
                            <div class="table-responsive table--no-card m-b-40">
                                <table class="table table-borderless table-striped table-earning">
                                    <thead>
                                        <tr>
                                            <th>date</th>
                                            <th colspan="2">description</th>
                                            <th>location</th>
                                            <th class="text-right">Actions</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($incidents as $incident)
                                            <tr>
                                                <td>{{ $incident->updated_at->diffForHumans() }}</td>
                                                <td colspan="2">{{ Str::limit($incident->description, 30) }}</td>
                                                <td><a href="https://www.google.com/maps?q={{ json_decode($incident->location)->latitude }},{{ json_decode($incident->location)->longitude }}" target="_blank">
                                                    Voir la localisation
                                                </a></td>
                                                <td class="text-right">
                                                    <button class="item" data-toggle="modal"
                                                        data-target="#moreModal-{{ $incident->id }}" title="More">
                                                        <i class="zmdi zmdi-more"></i>
                                                    </button>
                                                </td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p class="fs-3 py-3 ms-3">Aucun incident declare </p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!-- END MAIN CONTENT-->
        @foreach ($incidents as $incident)
            <!-- modal more -->
            <div class="modal fade" id="moreModal-{{ $incident->id }}" tabindex="-1" role="dialog"
                aria-labelledby="moremodalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">Information de l'incident
                            #{{ $incident->id }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form class="modal-body" method="POST"
                            action="{{ route('operateur.incident.update', $incident) }}">
                            @csrf
                            <div class="row border border-2 p-3 mx-2">
                                <strong class="col-4">Service</strong>
                                <i class="col-8">{{ $incident->departement->service->nom }}</i>
                            </div>
                            <div class="row border border-2 p-3 mx-2">
                                <strong class="col-4">Ville</strong>
                                <i class="col-8">{{ $incident->departement->ville->nom }}</i>
                            </div>
                            <div class="row border border-2 p-3 mx-2">
                                <strong class="col-4">Description</strong>
                                <i class="col-8">{{ $incident->description }}</i>
                            </div>
                            <div class="row border border-2 p-3 mx-2">
                                <strong class="col-4">localisation</strong>
                                <a href="https://www.google.com/maps?q={{ json_decode($incident->location)->latitude }},{{ json_decode($incident->location)->longitude }}" target="_blank">
                                    Voir la localisation
                                </a>                                
                            </div>
                            <div class="row border border-2 p-3 mx-2">
                                <strong class="col-4">statut</strong>
                                <i class="col-8" @class([
                                    'text-danger' => $incident->statut->id === 4,
                                    'text-success' => $incident->statut->id === 3,
                                    'text-primary' => $incident->statut->id === 2,
                                ])>{{ $incident->statut->nom }}</i>
                            </div>
                            <div class="row border border-2 p-3 mx-2">
                                <strong class="col-4">Notes</strong>
                                <i class="col-8"></i>
                            </div>

                            <div id="mapid" style="height: 300px;" class="w-75"></div>

                            <script>
                                var map = L.map('mapid').setView([{{ json_decode($incident->location)->latitude }},
                                    {{ json_decode($incident->location)->latitude }}
                                ], 13);

                                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                    attribution: '© OpenStreetMap contributors'
                                }).addTo(map);

                                L.marker([{{ json_decode($incident->location)->latitude }}, {{ json_decode($incident->location)->longitude }}]).addTo(map)
                                    .bindPopup('Lieu de l\'incident.')
                                    .openPopup();
                            </script>


                            <!-- images jointes -->
                            <h4>Images jointes</h4>
                            <div id="carouselExampleControls" class="carousel slide"
                                data-ride="carousel">
                                <div class="carousel-inner">
                                    @foreach ($incident->images as $image)
                                        <div @class(['carousel-item', 'active' => $loop->first])>
                                            <img src="{{ $image->getUrl() }}"
                                                class="d-block w-100" alt="preuves "
                                                style="height: 30rem;object-fit: cover;" data-interval="1000">
                                        </div>
                                    @endforeach
                                    
                                </div>
                                <button class="carousel-control-prev" type="button"
                                    data-target="#carouselExampleControls" data-slide="prev">
                                    <span class="carousel-control-prev-icon"
                                        aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button"
                                    data-target="#carouselExampleControls" data-slide="next">
                                    <span class="carousel-control-next-icon"
                                        aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </button>
                            </div>
                            <!-- images jointes -->


                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                <input type="submit" value="Rejeter" name="statut" class="btn btn-danger" />
                                <input type="submit" value="Receptionner" name="statut" class="btn btn-success" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- end modal scroll -->
        @endforeach
    @endsection
