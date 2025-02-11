@php($admin=true)
@extends('layouts.operateur-dash')
@section('content2')

    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"> --}}
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="overview-wrap">
                            {{-- <h2 class="title-1">Dashboard</h2> --}}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <x-session key="success" :time="10000"></x-session>
                    </div>
                    <div class="col-12 row">
                        <div class="col-12 row">
                            <h2 class="title-1 m-b-25 col-8">Liste des services</h2>
                            <div class="col-4">
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small mb-2" data-toggle="modal"
                                    data-target="#smallmodal">
                                    <i class="zmdi zmdi-plus"></i>Nouveau <span class="d-none d-md-inline">service</span></button>
                            </div>
                            
                        </div>
                        @if (!$services->isEmpty())
                            @foreach ($services as $service)
                                <div class="col-md-4 ">
                                    <div class="card  mx-auto">

                                        <div class="card-body">
                                            <div class="mx-auto d-block" style="height: 12em">

                                                <a href="{{ route('admin.service.edit', $service) }}"
                                                    class="text-center mt-2 mb-1 d-block">
                                                    <img class="rounded-circle mx-auto d-block border"
                                                        src='{{ $service->getIcons() }}'
                                                        alt="{{ $service->nom }} icons" style="width: 100px;height: 100px">
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
                        @else
                            <p class="fs-3 py-3 ms-3">Aucun service enregistrer </p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!-- END MAIN CONTENT-->
        
    <!-- modal small -->
    <div class="modal fade w-100" id="smallmodal" tabindex="-1" role="dialog"
    aria-labelledby="smallmodalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('admin.service.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="smallmodalLabel">Enregister un nouvel service</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="description" class=" form-control-label">Nom service</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input name="nom" id="nom"  placeholder="nom du service"
                                class="form-control py-2" value="{{ old('nom') }}">
                            @error('nom')
                                <label for="" class="text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="description" class=" form-control-label">Icone du service</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="file" name="icons" id="icons" placeholder="icons du service"
                                class="form-control py-2" value="{{ old('icons') }}">
                            @error('icons')
                                <label for="" class="text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-dismiss="modal">fermer</button>
                    <button type="submit" class="btn btn-primary">Enregister</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- end modal small -->
    @endsection
