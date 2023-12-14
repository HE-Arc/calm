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
                    <div class="relative mt-2">
                        <div class="flowbite-icon-div">
                            <svg class="flowbite-icon-svg" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 14 18">
                                <path d="M7 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9Zm2 1H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z"/>
                            </svg>
                        </div>
                        <input value="{{old('email')}}" id="email" name="email" type="text" autocomplete="email" required class="block w-full pl-10 input input-sobre">
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between">
                        <label for="password" >Mot de passe</label>
                        <div class="text-sm">
                            <a href="#" class="font-semibold text-rollingStone hover:text-seaNymph">Mot de passe oublié ?</a>
                        </div>
                    </div>

                    <div class="relative mt-2">
                        <div class="flowbite-icon-div">
                            <svg class="flowbite-icon-svg" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 20">
                                <path d="M14 7h-1.5V4.5a4.5 4.5 0 1 0-9 0V7H2a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2Zm-5 8a1 1 0 1 1-2 0v-3a1 1 0 1 1 2 0v3Zm1.5-8h-5V4.5a2.5 2.5 0 1 1 5 0V7Z"/>
                            </svg>
                        </div>
                        <input id="password" name="password" type="password" autocomplete="current-password" required class="block w-full pl-10 input input-sobre">
                    </div>
                </div>

                <div>
                    <div class="text-center">
                        <label class="relative inline-flex items-center mr-5 cursor-pointer">
                            <input type="checkbox" name="remember" value="remember" id="remember" class="sr-only peer choose-wash-dry" {{ old('remember') ? 'checked' : '' }}>
                            <div
                                class="toggle-switch peer peer-focus:ring-4 peer-focus:ring-vividTangerine peer-checked:after:translate-x-full peer-checked:after:border-white peer-checked:bg-vividTangerine"></div>
                            <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">Se souvenir de moi</span>
                        </label>
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
