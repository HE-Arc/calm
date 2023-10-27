@extends('layout.app')
@section('content')
    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <h1 class="text-center text-4xl font-title text-seaNymph font-bold">Connexion</h1>
        </div>

        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
            <form class="space-y-6" action="{{route('authenticate')}}" method="POST">
                @csrf
                <div>
                    <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Adresse e-mail</label>
                    <div class="mt-2">
                        <input id="email" name="email" type="text" autocomplete="email" required class="block w-full rounded-md border-2 border-rollingStone py-1.5 text-gray-900 shadow-sm placeholder:text-gray-400 focus:ring-rollingStone focus:border-rollingStone sm:text-sm sm:leading-6">
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between">
                        <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Mot de passe</label>
                        <div class="text-sm">
                            <a href="#" class="font-semibold text-rollingStone hover:text-seaNymph">Mot de passe oublié ?</a>
                        </div>
                    </div>
                    <div class="mt-2">
                        <input id="password" name="password" type="password" autocomplete="current-password" required class="block w-full rounded-md border-2 border-rollingStone py-1.5 text-gray-900 shadow-sm placeholder:text-gray-400 focus:ring-rollingStone focus:border-rollingStone sm:text-sm sm:leading-6">
                    </div>
                </div>

                <div>
                    <button type="submit" class="flex shadow-gray-700 w-full justify-center rounded-md bg-rollingStone px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-seaNymph focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-rollingStone">Connexion</button>
                </div>
            </form>

            <p class="mt-10 text-center text-sm text-gray-500">
                Pas de compte ?
                <a href="{{ route('register') }}" class="font-semibold leading-6 text-rollingStone hover:text-seaNymph">Inscrivez-vous !</a>
            </p>
        </div>
    </div>
@endsection
