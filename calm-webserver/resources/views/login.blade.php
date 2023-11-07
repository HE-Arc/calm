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
                    <label for="email">Adresse e-mail</label>
                    <div class="mt-2">
                        <input value="{{old('email')}}" id="email" name="email" type="text" autocomplete="email" required class="block w-full input input-sobre">
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between">
                        <label for="password" >Mot de passe</label>
                        <div class="text-sm">
                            <a href="#" class="font-semibold text-rollingStone hover:text-seaNymph">Mot de passe oublié ?</a>
                        </div>
                    </div>
                    <div class="mt-2">
                        <input id="password" name="password" type="password" autocomplete="current-password" required class="block w-full input input-sobre">
                    </div>
                </div>

                <div>
                    <button type="submit" class="btn btn-sobre flex w-full justify-center">Connexion</button>
                </div>
            </form>

            <p class="mt-10 text-center text-sm text-gray-500">
                Pas de compte ?
                <a href="{{ route('register') }}" class="font-semibold leading-6 text-rollingStone hover:text-seaNymph">Inscrivez-vous !</a>
            </p>
        </div>
    </div>
@endsection
