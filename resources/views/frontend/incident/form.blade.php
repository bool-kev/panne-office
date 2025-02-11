@extends('layouts.citoyen-dash')
@section('content2')
<form action="{{ $incident->id?route('citoyen.incident.update',$incident):route('citoyen.incident.store') }}" method="post" enctype="multipart/form-data" class="form-horizontal m-t-75" enctype="multipart/form-data">
    @if ($incident->id)
        @method("PUT")
    @endif
    @error('location')
        <div class="alert alert-danger alert-dismissible m-t-4 py-3" role="alert" id="alert" >
            <i data-feather="alert-circle"></i>
            La localisation est requise vous devriez accepter les permissions de l'application a acceder a votre position!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"></button>
        </div> 
    @enderror
        <div class="card pt-5">
            <div class="card-header">
                Declarer un incident pour<strong> {{ $service->nom }}</strong>
            </div>
            <div class="card-body card-block">
                @csrf
                <input type="hidden" name="location" value="" id="location">
                <script>
                    let c=null;
                    var getUserLocation = function() {
                        return new Promise(function(resolve, reject) {
                            if (navigator.geolocation) {
                                navigator.geolocation.getCurrentPosition(function(position) {
                                    var latitude = position.coords.latitude;
                                    var longitude = position.coords.longitude;

                                    // Utilisez les coordonnées latitude et longitude pour effectuer des opérations supplémentaires
                                    resolve({
                                        latitude: latitude,
                                        longitude: longitude
                                    });
                                });
                            } else {
                                // alert('navigator.geolocation');
                                reject('La géolocalisation n\'est pas disponible.');
                            }
                        });
                    };
                    getUserLocation().then(function(location) {
                        console.log(location);
                        // alert(location)
                        document.getElementById('location').value = JSON.stringify(location);
                    }).catch(function(error) {
                        // alert('error')
                        console.log("error");
                    });
                </script>
                <div class="row form-group">
                    <div class="col col-md-3">
                        <label for="description" class=" form-control-label">Description</label>
                    </div>
                    <div class="col-12 col-md-9">
                        <textarea name="description" id="description" rows="9" placeholder="Description de l'incident"
                            class="form-control">{{ old('description',$incident->description) }}</textarea>
                        @error('description')
                            <label for="" class="text-danger">{{ $message }}</label>
                        @enderror
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col col-md-3">
                        <label for="departement"
                            class=" form-control-label @error('ville') is-invalid @enderror">Ville</label>
                    </div>
                    <div class="col-12 col-md-9">
                        <select name="departement_id" id="departement" class="form-control">
                            @foreach ($service->departements as $dept)
                                <option value="{{ $dept->id }}" @selected(old('departement_id',$incident->departement?->id)===$dept->id)>{{ $dept->ville->nom}}</option>
                            @endforeach
                        </select>
                        @error('departement')
                            <label for="" class="text-danger">{{ $message }}</label>
                        @enderror
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col col-md-3">
                        <label for="file-multiple-input" class=" form-control-label">Joindre des images</label>
                    </div>
                    <div class="col-12 col-md-9">
                        <input type="file" id="images" name="images[]" multiple
                            class="form-control-file @error('ville') is-invalid @enderror">
                        @error('images.*')
                            <label for="" class="text-danger">{{ $message }}</label>
                        @enderror
                        @error('images')
                            <label for="" class="text-danger">{{ $message }}</label>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary btn-sm">
                    <i class="fa fa-dot-circle-o"></i> {{$incident->id?'Modifier':'Declarer'}}
                </button>
                <a t class="btn btn-danger btn-sm" href="{{ route('citoyen.dashboard') }}">
                    <i class="fa fa-ban"></i> Retour
                </a>
            </div>
        </div>
    </form>
@endsection
