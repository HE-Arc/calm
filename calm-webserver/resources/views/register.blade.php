@extends('layout.app')
@section('content')
    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <h1 class="text-center text-4xl font-title text-seaNymph font-bold">Inscription</h1>
        </div>

        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
            <form class="space-y-6" action="#" method="POST">
                <div>
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Nom d'utilisateur</label>
                    <div class="mt-2">
                        <input id="name" name="name" type="text" autocomplete="name" required class="block w-full rounded-md border-2 border-rollingStone py-1.5 text-gray-900 shadow-sm placeholder:text-gray-400 focus:ring-rollingStone focus:border-rollingStone sm:text-sm sm:leading-6">
                    </div>
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Adresse e-mail</label>
                    <div class="mt-2">
                        <input id="email" name="email" type="email" autocomplete="email" required class="block w-full rounded-md border-2 border-rollingStone py-1.5 text-gray-900 shadow-sm placeholder:text-gray-400 focus:ring-rollingStone focus:border-rollingStone sm:text-sm sm:leading-6">
                    </div>
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Mot de passe</label>
                    <div class="mt-2">
                        <input id="password" name="password" type="password" autocomplete="current-password" required class="block w-full rounded-md border-2 border-rollingStone py-1.5 text-gray-900 shadow-sm placeholder:text-gray-400 focus:ring-rollingStone focus:border-rollingStone sm:text-sm sm:leading-6">
                    </div>
                </div>

                <div>
                    <label for="passwordConfirmation" class="block text-sm font-medium leading-6 text-gray-900">Confirmation du mot de passe</label>
                    <div class="mt-2">
                        <input id="passwordConfirmation" name="passwordConfirmation" type="password" autocomplete="current-password" required class="block w-full rounded-md border-2 border-rollingStone py-1.5 text-gray-900 shadow-sm placeholder:text-gray-400 focus:ring-rollingStone focus:border-rollingStone sm:text-sm sm:leading-6">
                    </div>
                </div>

                <div>
                    <button type="submit" class="flex shadow-gray-700 w-full justify-center rounded-md bg-rollingStone px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-seaNymph focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-rollingStone">Inscription</button>
                </div>
            </form>

            <p class="mt-10 text-center text-sm text-gray-500">
                Déjà un compte ?
                <a href="{{ route('login') }}" class="font-semibold leading-6 text-rollingStone hover:text-seaNymph">Connectez-vous !</a>
            </p>
        </div>
    </div>
@endsection
