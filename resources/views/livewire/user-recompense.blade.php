<div>
    <h2 class="title-1 m-b-25">Statistiques des fideles utilisateurs</h2>
<div class="filters m-b-45">
    <div class="rs-select2--dark rs-select2--md m-r-10 rs-select2--border">
        <select class="form-control" name="filter" wire:model="filter" wire:change="search">
            <optgroup label="{{ $service->nom}}">
                <option value="total">Tous</option>
                <option value="mois">Ce mois</option>
            </optgroup>
            <optgroup label="Par Ville">
                @foreach ($service->departements as $item)
                    <option value="{{ $item->id }}">{{ $item->ville->nom }}</option>
                @endforeach
            </optgroup>
        </select>
        <div class="dropDownSelect2"></div>
    </div>
</div>
<div class="table-responsive table--no-card m-b-30">
    @if (!$users->isEmpty())
        <table class="table table-borderless table-striped table-earning">
            <thead>
                <tr>
                    <th>N ordre</th>
                    <th>Nom</th>
                    <th>Prenom</th>
                    <th>email</th>
                    <th class="text-right">Points</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $user->nom }}</td>
                        <td>{{ $user->prenom }}</td>
                        <td>{{ $user->email }}</td>
                        <td class="text-right">{{ $points[$user->id ]}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="py-4">Aucun utilisateur pour cet filtre</p>
    @endif
</div>
</div>
