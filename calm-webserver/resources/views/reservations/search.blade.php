@extends('layout.app')
@section('content')
    <h1 class="font-title text-4xl text-center mt-3 text-seaNymph">Nouvelle réservation</h1>
    <div class="flex min-h-full flex-col justify-center px-6 py-1 lg:px-8">
        <div class="mt-5 sm:mx-auto sm:w-full sm:max-w-sm">
            <form class="space-y-6" action="{{route('reservations.search_prop')}}" method="POST">
                @csrf
                <div>
                    <label for="organisations">Sélectionner
                        l'organisation</label>
                    <select id="organisations" required name="organisations"
                            class="input input-sobre block w-full">
                        <option selected disabled hidden value="">-- Sélectionner une organisation --</option>
                        @foreach($organizations as $org)
                            <option {{ old('organisations') == $org->id ? "selected" : "" }} value="{{$org->id}}">{{$org->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="@if(!old('laundry')) hidden @endif laundries-field">
                    <label for="laundries">Sélectionner la
                        buandrie</label>
                    <select id="laundries" required name="laundry"
                            class="input input-sobre block w-full">
                        @foreach($organizations as $org)
                            @foreach($org->laundries as $laundry)
                                <option {{ old('laundry') == $laundry->id ? "selected" : "" }} value="{{$laundry->id}}"
                                        data-organisation="{{$org->id}}">{{$laundry->name}}</option>
                            @endforeach
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="day" >Date</label>
                    <div class="mt-2">
                        <input id="day" min="{{date('Y-m-d')}}" name="day" type="date" autocomplete="date" required
                               value="{{ old('day', date('Y-m-d')) }}"
                               class="block w-full input input-sobre">
                    </div>
                </div>

                <div>
                    <label for="duration" >Durée (en minutes)</label>

                    <div class="mt-2">
                        <input id="duration" name="duration" type="number" min="30" max="360" step="15" autocomplete="duration"
                               required
                               value="{{ old('duration', 30) }}"
                               class="block w-full input input-sobre">
                    </div>
                </div>

                <div class="text-center">

                    @foreach ($machinesTypes as $name => $value)
                    <label class="relative inline-flex items-center mr-5 cursor-pointer">
                        <input type="checkbox" name="type" value="{{$name}}" id="{{$name}}" class="sr-only peer choose-wash-dry" @if(old("type") === "{{$name}}") checked @endif>
                        <div class="toggle-switch peer peer-focus:ring-4 peer-focus:ring-vividTangerine peer-checked:after:translate-x-full peer-checked:after:border-white peer-checked:bg-vividTangerine"></div>
                        <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">{{$value}}</span>
                    </label>
                    @endforeach
                </div>

                <div>
                    <button type="submit"
                            class="btn btn-sobre flex w-full justify-center">
                        Rechercher une disponibilité
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
