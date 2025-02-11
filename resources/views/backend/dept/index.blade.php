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
                    <div class="row">
                        <div class="col">
                            <h3 class="title-5 m-b-35">Operateurs pour <strong>{{ $service->nom }}</strong></h3>
                            <div class="table-data__tool">

                                <div class="table-data__tool-right">
                                    <button class="au-btn au-btn-icon au-btn--green au-btn--small" data-toggle="modal"
                                        data-target="#smallmodal">
                                        <i class="zmdi zmdi-plus"></i>Nouveau Operateur</button>

                                </div>

                            </div>
                            <div class="table-responsive table-responsive-data2">
                                @if (!$operateurs->isEmpty())
                                    <table class="table table-data2">
                                        <thead>
                                            <tr>
                                                <th>nom</th>
                                                <th>prenom</th>
                                                <th>email</th>
                                                <th>telephone</th>
                                                <th>Departement</th>
                                                <th>actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($operateurs as $operateur)
                                                <tr class="tr-shadow border">
                                                    <td>{{ $operateur->user->nom }}
                                                    </td>
                                                    <td>{{ $operateur->user->prenom }}</td>
                                                    <td>{{ $operateur->user->email }}</td>
                                                    <td>{{ $operateur->user->telephone }}</td>
                                                    <td>{{ $operateur->departement->ville->nom }}</td>

                                                    <td>
                                                        <div class="table-data-feature">


                                                            <button class="item" data-toggle="modal"
                                                                data-target="#deleteModal-{{ $operateur->id }}"
                                                                data-placement="top" title="Delete" type="submit">
                                                                <i class="zmdi zmdi-delete"></i>
                                                            </button>

                                                        </div>
                                                    </td>

                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <div class="fs-4 ms-3 text-secondary">Aucun operateur enregistrer pour ce service</div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @foreach ($operateurs as $operateur)
            <!-- modal small -->
            <div class="modal fade w-100" id="deleteModal-{{ $operateur->id }}" data-placement="top" tabindex="-1"
                role="dialog" aria-labelledby="smallmodalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form action="{{ route('admin.operateur.destroy', $operateur) }}" method="post">
                            @method('DELETE')
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title" id="smallmodalLabel">
                                    Confirmation de
                                    suppression</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p class="">
                                    Voulez-vous supprimer l'operateur
                                    #{{ $operateur->id }}?
                                    <span class="d-block text-danger">cette action est
                                        irreversible</span>
                                </p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">fermer</button>
                                <button type="submit" class="btn btn-danger">Supprimer</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- end modal small -->
        @endforeach
        <!-- END MAIN CONTENT-->

        <!-- modal small -->
        <div class="modal fade w-100" id="smallmodal" tabindex="-1" role="dialog" aria-labelledby="smallmodalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <form action="{{ route('admin.operateur.store') }}" method="post">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="smallmodalLabel">Enregistrer un operateur pour le compte de {{ $service->nom }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <input class="au-input au-input--full" type="text" name="nom" placeholder="nom"
                                    value="{{ old('nom') }}">
                                @error('nom')
                                    <label class="text-danger">{{ $message }}</label>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input class="au-input au-input--full" type="text" name="prenom" placeholder="prenom"
                                    value="{{ old('prenom') }}">
                                @error('prenom')
                                    <label class="text-danger">{{ $message }}</label>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input class="au-input au-input--full" type="text" name="telephone"
                                    placeholder="telephone" value="{{ old('telephone') }}">
                                @error('telephone')
                                    <label class="text-danger">{{ $message }}</label>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input class="au-input au-input--full" type="email" name="email" placeholder="Email"
                                    value="{{ old('email') }}">
                                @error('email')
                                    <label class="text-danger">{{ $message }}</label>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input class="au-input au-input--full" type="password" name="password"
                                    placeholder="mot de passe">
                                @error('password')
                                    <label class="text-danger">{{ $message }}</label>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input class="au-input au-input--full" type="password" name="password_confirmation"
                                    placeholder="confirmation de mot de passe">
                                @error('password_confirmation')
                                    <label class="text-danger">{{ $message }}</label>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="depatement_id">Departement</label>
                                <div class="row">
                                    <select name="departement_id" id="departement_id"
                                        class="form-control border border-primary col-10">
                                        @foreach ($service->departements as $dept)
                                            <option value="{{ $dept->id }}">
                                                {{ $dept->ville->nom }}</option>
                                        @endforeach
                                    </select>
                                    <div class="col-2">
                                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target="#smallmodal2" id="btnMod">Ajouter
                                        </button>
                                    </div>
                                </div>
                                @error('departement_id')
                                    <label class="text-danger">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">fermer</button>
                            <button type="submit" class="btn btn-primary">Enregister</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- end modal small -->

        <!-- modal small -->
        <div class="modal fade w-100" id="smallmodal2" data-placement="top" tabindex="-1" role="dialog"
            aria-labelledby="smallmodalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="{{ route('admin.service.dept.create',$service) }}" method="post">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="smallmodalLabel">
                                Un nouveau departement</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="ville_id">Ville</label>
                                <div class="row">
                                    <select name="ville_id" id="ville_id"
                                        class="form-control border border-primary col">
                                        @foreach ($villes as $ville)
                                            <option value="{{ $ville->id }}">
                                                {{ $ville->nom }}</option>
                                        @endforeach
                                    </select>
                                    
                                </div>
                                @error('ville_id')
                                    <label class="text-danger">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">fermer</button>
                            <button type="submit" class="btn btn-primary">Enregister</button>
                        </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    @session('mod')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                document.getElementById('btnMod').dispatchEvent(new Event('click'));
            })
        </script>
    @endsession
    <!-- end modal small -->
@endsection
