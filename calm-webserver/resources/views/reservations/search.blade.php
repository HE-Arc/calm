@extends('layout.app')
@section('content')
    <div
        class="text-center text-sm text-seaNymph font-bold transition-colors duration-200 bg-white border rounded-lg hover:bg-gray-100 sm:hidden">
        <a class="block px-5 py-2 align-middle" href="{{ route('reservations.index') }}">
            <svg class="w-2 h-2 text-seaNymph inline" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                 viewBox="0 0 8 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M7 1 1.3 6.326a.91.91 0 0 0 0 1.348L7 13"/>
            </svg>
            Retour
        </a>
    </div>
    <h1 class="font-title text-4xl text-center mt-3 text-seaNymph">Nouvelle réservation</h1>
    <div class="flex min-h-full flex-col justify-center px-6 py-1 lg:px-8">
        <div class="mt-5 sm:mx-auto sm:w-full sm:max-w-sm">
            <form class="space-y-6" action="/reservations/create" method="POST">
                @csrf
                <div>
                    <label for="organisations" class="block mb-2 text-sm font-medium text-gray-900">Sélectionner
                        l'organisation</label>
                    <select id="organisations" required name="organisations"
                            class="border-2 border-rollingStone text-sm rounded-lg focus:ring-rollingStone focus:border-rollingStone block w-full p-2.5">
                            <option selected disabled hidden value="">-- Sélectionner une organisation --</option>
                        @foreach($organizations as $org)
                            <option value="{{$org['id']}}">{{$org['name']}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="hidden laundries-field">
                    <label for="laundries" class="block mb-2 text-sm font-medium text-gray-900">Sélectionner la
                        buandrie</label>
                    <select id="laundries" required name="laundry"
                            class="border-2 border-rollingStone text-sm rounded-lg focus:ring-rollingStone focus:border-rollingStone block w-full p-2.5">
                        @foreach($organizations as $org)
                            @foreach($org['laundries'] as $laundry)
                                <option value="{{$laundry['id']}}"
                                        data-organisation="{{$org['id']}}">{{$laundry['name']}}</option>
                            @endforeach
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="day" >Date</label>
                    <div class="mt-2">
                        <input id="day" name="day" type="date" autocomplete="date" required
                               class="block w-full rounded-md border-2 border-rollingStone py-1.5 text-gray-900 shadow-sm placeholder:text-gray-400 focus:ring-rollingStone focus:border-rollingStone sm:text-sm sm:leading-6">
                    </div>
                </div>

                <div>
                    <label for="duration" >Durée</label>
                    <div class="mt-2">
                        <input id="duration" name="duration" type="number" min="1" max="1440" autocomplete="duration"
                               required
                               class="block w-full rounded-md border-2 border-rollingStone py-1.5 text-gray-900 shadow-sm placeholder:text-gray-400 focus:ring-rollingStone focus:border-rollingStone sm:text-sm sm:leading-6">
                    </div>
                </div>

                <div class="text-center">
                    <label class="relative inline-flex items-center mr-5 cursor-pointer">
                        <input type="checkbox" name="type" value="wash" id="wash" class="sr-only peer">
                        <div
                            class="toggle-switch peer peer-focus:ring-4 peer-focus:ring-vividTangerine peer-checked:after:translate-x-full peer-checked:after:border-white peer-checked:bg-vividTangerine"></div>
                        <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">Laver</span>
                    </label>

                    <label class="relative inline-flex items-center mr-5 cursor-pointer">
                        <input type="checkbox" name="type" value="dry" id="dry" class="sr-only peer">
                        <div class="toggle-switch peer peer-focus:ring-4 peer-focus:ring-vividTangerine peer-checked:after:translate-x-full peer-checked:after:border-white peer-checked:bg-vividTangerine"></div>
                        <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">Sécher</span>
                    </label>
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
