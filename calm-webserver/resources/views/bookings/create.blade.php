@extends('layout.app')
@section('content')
    <div>
        <a class="btn btn-primary" href="{{ route('bookings.index') }}"> Retour</a>
    </div>

    <h1 class="font-title text-4xl text-center mt-3 text-seaNymph">Nouvelles réservations</h1>
    <div class="flex min-h-full flex-col justify-center px-6 py-1 lg:px-8">
        <div class="mt-5 sm:mx-auto sm:w-full sm:max-w-sm">
            <form class="space-y-6" action="#" method="POST">
                <div>
                    <label for="date" class="block text-sm font-medium leading-6 text-gray-900">Date</label>
                    <div class="mt-2">
                        <input id="date" name="date" type="date" autocomplete="date" required class="block w-full rounded-md border-2 border-rollingStone py-1.5 text-gray-900 shadow-sm placeholder:text-gray-400 focus:ring-rollingStone focus:border-rollingStone sm:text-sm sm:leading-6">
                    </div>
                </div>

                <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                        <label for="hour-start" class="block text-sm font-medium leading-6 text-gray-900">Heure de début</label>
                        <div class="mt-2">
                            <input id="hour-start" name="hour-start" type="time" autocomplete="hour-start" required class="block w-full rounded-md border-2 border-rollingStone py-1.5 text-gray-900 shadow-sm placeholder:text-gray-400 focus:ring-rollingStone focus:border-rollingStone sm:text-sm sm:leading-6">
                        </div>
                    </div>

                    <div class="w-full md:w-1/2 px-3">
                        <label for="hour-end" class="block text-sm font-medium leading-6 text-gray-900">Heure de fin</label>
                        <div class="mt-2">
                            <input id="hour-end" name="hour-end" type="time" autocomplete="hour-end" required class="block w-full rounded-md border-2 border-rollingStone py-1.5 text-gray-900 shadow-sm placeholder:text-gray-400 focus:ring-rollingStone focus:border-rollingStone sm:text-sm sm:leading-6">
                        </div>
                    </div>
                </div>

                <div class="text-center">
                    <label class="relative inline-flex items-center mr-5 cursor-pointer">
                        <input type="checkbox" value="washing-machine" class="sr-only peer">
                        <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-vividTangerine peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-vividTangerine"></div>
                        <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">Laver</span>
                    </label>

                    <label class="relative inline-flex items-center mr-5 cursor-pointer">
                        <input type="checkbox" value="dryer" class="sr-only peer">
                        <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-vividTangerine peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-vividTangerine"></div>
                        <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">Sècher</span>
                    </label>
                </div>

                <div>
                    <label for="washing-machines" class="block mb-2 text-sm font-medium text-gray-900">Sélectionner votre machine à laver</label>
                    <select id="washing-machines" name="washing-machines" class="border-2 border-rollingStone text-sm rounded-lg focus:ring-rollingStone focus:border-rollingStone block w-full p-2.5">
                        <option selected>-- Sélectionner une machine --</option>
                    </select>
                </div>

                <div>
                    <label for="dryers" class="block mb-2 text-sm font-medium text-gray-900">Sélectionner votre sèche linge</label>
                    <select id="dryers" name="dryers" class="border-2 border-rollingStone text-sm rounded-lg focus:ring-rollingStone focus:border-rollingStone block w-full p-2.5">
                        <option selected>-- Sélectionner une machine --</option>
                    </select>
                </div>

                <div>
                    <button type="submit" class="flex shadow-gray-700 w-full justify-center rounded-md bg-rollingStone px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-seaNymph focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-rollingStone">Confirmer</button>
                </div>
            </form>
        </div>
    </div>

@endsection
