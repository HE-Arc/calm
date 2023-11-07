@extends('layout.app')
@section('content')
    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <h1 class="text-center text-4xl font-title text-seaNymph font-bold">Inscription</h1>
        </div>

        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
            <form class="space-y-6" action="#" method="POST">
                <div>
                    <label for="name">Nom d'utilisateur</label>
                    <div class="mt-2">
                        <input id="name" name="name" type="text" autocomplete="name" required class="block w-full input input-sobre">
                    </div>
                </div>

                <div>
                    <label for="email" >Adresse e-mail</label>
                    <div class="mt-2">
                        <input id="email" name="email" type="email" autocomplete="email" required class="block w-full input input-sobre">
                    </div>
                </div>

                <div>
                    <label for="password" >Mot de passe</label>
                    <div class="mt-2">
                        <input id="password" name="password" type="password" autocomplete="current-password" required class="block w-full input input-sobre">
                    </div>
                </div>

                <div>
                    <label for="passwordConfirmation" >Confirmation du mot de passe</label>
                    <div class="mt-2">
                        <input id="passwordConfirmation" name="passwordConfirmation" type="password" autocomplete="current-password" required class="block w-full input input-sobre">
                    </div>
                </div>

                <div>
                    <button type="submit" class="btn btn-sobre flex justify-center w-full ">Inscription</button>
                </div>
            </form>

            <p class="mt-10 text-center text-sm text-gray-500">
                Déjà un compte ?
                <a href="{{ route('login') }}" class="font-semibold leading-6 text-rollingStone hover:text-seaNymph">Connectez-vous !</a>
            </p>
        </div>
    </div>
@endsection
