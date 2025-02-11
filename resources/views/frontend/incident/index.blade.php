@extends('layouts.citoyen-dash')
@section('content2')
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"> --}}
    <!-- BREADCRUMB-->
    <section class="au-breadcrumb m-t-75">
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
                                    <li class="list-inline-item">Incidents</li>
                                </ul>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END BREADCRUMB-->
    <!-- DATA TABLE-->
    <section class="p-t-20">
        <div class="container">
            <x-session key="success"></x-session>
            <div class="row">
                <div class="col">
                    <h3 class="title-5 m-b-35">Mon historique de declaration</h3>

                    <div class="table-responsive table-responsive-data2">
                        @if (!$incidents->isEmpty())
                            <table class="table table-data2">
                                <thead>
                                    <tr>
                                        <th>service</th>
                                        <th>Description</th>
                                        <th>date</th>
                                        <th>Votre Avis</th>
                                        <th>Points</th>
                                        <th>actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($incidents as $incident)
                                        <tr class="tr-shadow mb-2">
                                            <td>{{ $incident->departement->service->nom }}({{ $incident->departement->ville->nom }})
                                            </td>
                                            <td class="desc">{{ $incident->description }}</td>
                                            <td>{{ $incident->created_at->diffForHumans() }}</td>
                                            <td class="fst-italic">{{ $incident->note?->nom ?? 'pas d\'avis' }}</td>
                                            <td class="fst-italic">{{ $incident->point }}</td>
                                            <td>
                                                <div class="table-data-feature">


                                                    <button class="item" data-toggle="modal"
                                                        data-target="#evalModal-{{ $incident->id }}" data-placement="top"
                                                        title="Evaluez notre travail" type="submit">
                                                        <i class="zmdi zmdi-favorite @if($incident->note?->nom) text-danger @endif"></i>
                                                    </button>

                                                </div>
                                            </td>
                                        </tr>
                                        <!-- modal small -->
                                        <div class="modal fade w-100" id="evalModal-{{ $incident->id }}"
                                            data-placement="top" tabindex="-1" role="dialog"
                                            aria-labelledby="smallmodalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <form action="{{ route('citoyen.incident.eval', $incident) }}"
                                                        method="post" id="evalForm-{{ $incident->id }}">
                                                        @csrf
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="smallmodalLabel">Evaluez notre
                                                                travail</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row my-2 p-3">
                                                                <label for="avis" class="form-label">Votre Avis?</label>
                                                                <select name="avis" id="avis" class="form-control border border-primary">
                                                                    <option value="">Donnez nous votre avis</option>
                                                                    @foreach ($notes as $avis)
                                                                        <option value="{{ $avis->id }}" @selected($avis->id===$incident->note_id)>
                                                                            {{ $avis->nom }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">fermer</button>
                                                            {{-- <button type="submit"
                                                                class="btn btn-danger">Supprimer</button> --}}
                                                        </div>
                                                    </form>
                                                    <script>
                                                        document.getElementById('avis').addEventListener('change', function() {
                                                            setTimeout(() => {
                                                                document.getElementById('evalForm-{{ $incident->id }}').submit();
                                                            }, 2000);
                                                        });
                                                    </script>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end modal small -->

                                        
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="fs-4 ms-3 text-secondary">Votre historique est vide</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END DATA TABLE-->
@endsection
