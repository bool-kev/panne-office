@extends('layouts.citoyen-dash')
@section('content2')

    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"> --}}
    <!-- BREADCRUMB-->
    {{-- <section class="au-breadcrumb m-t-75">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="au-breadcrumb-content">
                            <div class="au-breadcrumb-left">
                                <span class="au-breadcrumb-span">You are here:</span>
                                <ul class="list-unstyled list-inline au-breadcrumb__list">
                                    <li class="list-inline-item active">
                                        <a href="#">Home</a>
                                    </li>
                                    <li class="list-inline-item seprate">
                                        <span>/</span>
                                    </li>
                                    <li class="list-inline-item">Dashboard</li>
                                </ul>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    <!-- END BREADCRUMB-->
    <!-- DATA TABLE-->
    <section class="p-t-20">
        <div class="container">
            <x-session key="success"></x-session>
            <div class="row">
                <div class="col">
                    <h3 class="title-5 m-b-35">Mes declarations</h3>
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <i class="">Recompense
                                <strong>{{ ' ' . request()->user()->incidents->sum('point') . ' ' }}</strong>Points</i>

                            <div class="rs-select2--light rs-select2--sm d-none">
                                <select class="js-select2" name="time">
                                    <option selected="selected">Today</option>
                                    <option value="">3 Days</option>
                                    <option value="">1 Week</option>
                                </select>
                                <div class="dropDownSelect2"></div>
                            </div>
                            <button class="au-btn-filter">
                                {{-- <i class="zmdi zmdi-filter-list"></i></button> --}}
                        </div>
                        <div class="table-data__tool-right">
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small" data-toggle="modal"
                                data-target="#smallmodal">
                                <i class="zmdi zmdi-plus"></i>Declarer un incident</button>

                        </div>
                        <!-- modal small -->
                        <div class="modal fade w-100" id="smallmodal" tabindex="-1" role="dialog"
                            aria-labelledby="smallmodalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="smallmodalLabel">Choisir le type d'incident</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            @foreach ($services as $service)
                                                <div class="col-md-4 ">
                                                    <div class="card  mx-auto">

                                                        <div class="card-body">
                                                            <div class="mx-auto d-block" style="height: 12em">

                                                                <a href="{{ route('citoyen.incident.create', $service) }}"
                                                                    class="text-center mt-2 mb-1 d-block">
                                                                    <img class="rounded-circle mx-auto d-block border"
                                                                        src='{{ $service->getIcons() }}'
                                                                        alt="{{ $service->nom }} icons"
                                                                        style="width: 100px;height: 100px">
                                                                    {{ $service->nom }}</a>
                                                                <div class="location text-sm-center">
                                                                    <i class="fa fa-map-marker"></i>
                                                                    {{-- <p class="text-small ">Incident qui concerne {{$service->nom}}</p> --}}
                                                                </div>
                                                            </div>
                                                            <hr>

                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach

                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">fermer</button>
                                        {{-- <button type="button" class="btn btn-primary">Confirm</button> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end modal small -->
                    </div>
                    <div class="table-responsive table-responsive-data2">
                        @if (!$incidents->isEmpty())
                            <table class="table table-data2">
                                <thead>
                                    <tr>
                                        <th>service</th>
                                        <th>Description</th>
                                        <th>date</th>
                                        <th>status</th>
                                        <th>actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($incidents->sortByDesc('created_at') as $incident)
                                        <tr class="tr-shadow border">
                                            <td><img src="{{ $incident->departement->service->getIcons() }}" alt=""
                                                    width="50px" height="50px" style="border-radius: 50%"
                                                    title="{{ $incident->departement->service->nom }}">({{ $incident->departement->ville->nom }})
                                            </td>
                                            <td class="text-dark">{{ Str::limit($incident->description, 30) }}</td>
                                            <td>{{ $incident->created_at->diffForHumans() }}</td>
                                            <td>
                                                <span @class([
                                                    'status--denied' => $incident->statut->id === 4,
                                                    'status--process' => $incident->statut->id === 3,
                                                    'text-primary' => $incident->statut->id === 2,
                                                ])>{{ $incident->statut->nom }}</span>
                                            </td>
                                            <td>
                                                <div class="table-data-feature">

                                                    <a href="{{ $incident->statut_id === 1 ? route('citoyen.incident.edit', $incident) : '#' }}"
                                                        class="item" data-placement="top" title="Edit">
                                                        <i class="zmdi zmdi-edit"></i>
                                                    </a>
                                                    <button class="item" data-toggle="modal"
                                                        @if ($incident->statut_id !== 2) data-target="#deleteModal-{{ $incident->id }}" @endif
                                                        data-placement="top" title="Delete" type="submit">
                                                        <i class="zmdi zmdi-delete"></i>
                                                    </button>

                                                    <button class="item" data-toggle="modal"
                                                        data-target="#moreModal-{{ $incident->id }}" data-placement="top"
                                                        title="More">
                                                        <i class="zmdi zmdi-more"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        <!-- modal small -->
                                        <div class="modal fade w-100" id="deleteModal-{{ $incident->id }}"
                                            data-placement="top" tabindex="-1" role="dialog"
                                            aria-labelledby="smallmodalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <form action="{{ route('citoyen.incident.destroy', $incident) }}"
                                                        method="post">
                                                        @method('DELETE')
                                                        @csrf
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="smallmodalLabel">Confirmation de
                                                                suppression</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p class="">
                                                                Voulez-vous supprimer l'incident #{{ $incident->id }}?
                                                                <span class="d-block text-danger">cette action est
                                                                    irreversible</span>
                                                            </p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">fermer</button>
                                                            <button type="submit"
                                                                class="btn btn-danger">Supprimer</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end modal small -->

                                        <!-- modal more -->
                                        <div class="modal fade" id="moreModal-{{ $incident->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="moremodalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">Information de l'incident
                                                        #{{ $incident->id }}</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row border border-2 p-3 mx-2">
                                                            <strong class="col-4">Service</strong>
                                                            <i
                                                                class="col-8">{{ $incident->departement->service->nom }}</i>
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
                                                            <i class="col-8">{{ $incident->location }}</i>
                                                        </div>
                                                        <div class="row border border-2 p-3 mx-2">
                                                            <strong class="col-4">statut</strong>
                                                            <i class="col-8"
                                                                @class([
                                                                    'text-danger' => $incident->statut->id === 4,
                                                                    'text-success' => $incident->statut->id === 3,
                                                                    'text-primary' => $incident->statut->id === 2,
                                                                ])>{{ $incident->statut->nom }}</i>
                                                        </div>
                                                        <div class="row border border-2 p-3 mx-2">
                                                            <strong class="col-4">Notes</strong>
                                                            <i class="col-8"></i>
                                                        </div>

                                                        <!-- images jointes -->
                                                        <h4>Images jointes</h4>
                                                        <div id="carouselExampleControls" class="carousel slide"
                                                            data-ride="carousel">
                                                            <div class="carousel-inner">
                                                                @foreach ($incident->images as $image)
                                                                    <div @class(['carousel-item', 'active' => $loop->first])>
                                                                        <img src="{{ $image->getUrl() }}"
                                                                            class="d-block w-100" alt="preuves "
                                                                            style="height: 30rem;object-fit: cover;"
                                                                            data-interval="1000">
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
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">fermer</button>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end modal scroll -->
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="fs-4 ms-3 text-secondary">Aucun incident declare</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END DATA TABLE-->
@endsection
