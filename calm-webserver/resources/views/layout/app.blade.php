<!DOCTYPE html>
<html class="scroll-smooth" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ $pageDescription }}">

    <title> {{ $pageTitle }} | CALM</title>

    <!-- Custom Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Itim&family=Montserrat:wght@400;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.png') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased min-h-screen flex flex-col">
    <header>
        <nav class="bg-seaNymph shadow-lg">
            <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
                <button data-collapse-toggle="navbar-user" type="button"
                    class="inline-flex items-center p-2 justify-center md:hidden focus:outline-none"
                    aria-controls="navbar-user" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-7 h-7 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 17 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 1h15M1 7h15M1 13h15" />
                    </svg>
                </button>

                <a href="{{ route('home') }}" class="flex items-center">
                    <span class="self-center text-4xl font-title text-white">CALM</span>
                </a>

                @auth
                    <div class="flex items-center md:order-2">
                        <button type="button"
                            class="flex mr-3 text-sm bg-transparent text-white rounded-full md:mr-0 focus:ring-4 focus:ring-gray-300"
                            id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown"
                            data-dropdown-placement="bottom">
                            <span class="sr-only">Open user menu</span>
                            <svg class="w-7 h-7" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path
                                    d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm0 5a3 3 0 1 1 0 6 3 3 0 0 1 0-6Zm0 13a8.949 8.949 0 0 1-4.951-1.488A3.987 3.987 0 0 1 9 13h2a3.987 3.987 0 0 1 3.951 3.512A8.949 8.949 0 0 1 10 18Z" />
                            </svg>
                        </button>

                        <!-- Dropdown menu -->
                        <div class="z-50 hidden text-white font-bold my-4 text-base bg-greyNurse divide-y divide-gray-100 rounded-lg shadow transition-none "
                            id="user-dropdown">
                            <div class="px-4 py-3 hover:bg-greyNurse">
                                <span class="block text-sm">{{ auth()->user()->name }}</span>
                                <span class="block text-sm truncate">{{ auth()->user()->email }}</span>
                            </div>

                            <ul class="py-2" aria-labelledby="user-menu-button">
                                <li>
                                    <a href="{{ route('user.index') }}"
                                        class="block px-4 py-2 text-sm hover:bg-berylGreen">Compte</a>
                                </li>
                                <li>
                                    <form action="{{ route('logout') }}" method="post"
                                        class="block cursor-pointer text-sm hover:bg-berylGreen">
                                        @csrf
                                        <input type="submit"
                                            class="block cursor-pointer px-4 py-2 text-sm hover:bg-berylGreen"
                                            value="Déconnexion">
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                @endauth

                <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-user">
                    <ul
                        class="flex flex-col font-bold md:p-0 mt-4 rounded-lg md:flex-row md:space-x-8 md:mt-0 md:border-0 text-white">
                        <li>
                            <a href="{{ route('home') }}"
                                class="block py-2 pl-3 pr-4 rounded md:bg-transparent md:hover:text-rollingStone md:p-0 {{ $page === 'home' ? 'md:text-rollingStone bg-rollingStone' : '' }}"
                                aria-current="page">Accueil</a>
                        </li>

                        <!-- IF NOT CONNECTED -->
                        @guest
                            <li>
                                <a href="{{ route('login') }}"
                                    class="block py-2 pl-3 pr-4 rounded hover:bg-rollingStone md:hover:bg-transparent md:hover:text-rollingStone md:p-0 {{ $page === 'login' ? 'md:text-rollingStone bg-rollingStone md:bg-transparent' : '' }}">Connexion</a>
                            </li>
                            <li>
                                <a href="{{ route('register') }}"
                                    class="block py-2 pl-3 pr-4 rounded hover:bg-rollingStone md:hover:bg-transparent md:hover:text-rollingStone md:p-0 {{ $page === 'register' ? 'md:text-rollingStone bg-rollingStone md:bg-transparent' : '' }}">Inscription</a>
                            </li>
                        @endguest

                        <!-- IF CONNECTED -->
                        @auth
                            <li>
                                <a href="{{ route('reservations.index') }}"
                                    class="block py-2 pl-3 pr-4 rounded hover:bg-rollingStone md:hover:bg-transparent md:hover:text-rollingStone md:p-0 {{ $page === 'reservations' ? 'md:text-rollingStone bg-rollingStone md:bg-transparent' : '' }}">Réservations</a>
                            </li>
                        @endauth

                        <!-- IF ADMIN -->
                        @can('admin')
                            <li>
                                <a href="{{ route('management.organizations.index') }}"
                                    class="block py-2 pl-3 pr-4 rounded hover:bg-rollingStone md:hover:bg-transparent md:hover:text-rollingStone md:p-0 {{ $page === 'organizations' ? 'md:text-rollingStone bg-rollingStone md:bg-transparent' : '' }}">Gestion
                                    des organisations</a>
                            </li>
                        @endcan

                        @cannot('admin')
                            <li>
                                <a href="{{ route('invitation.joinView')}}" class="block py-2 pl-3 pr-4 rounded hover:bg-rollingStone md:hover:bg-transparent md:hover:text-rollingStone md:p-0 {{ $page === 'jointOrganization' ? 'md:text-rollingStone bg-rollingStone md:bg-transparent' : '' }}">Rejoindre une organisation</a>
                            </li>
                        @endcannot
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main class="md:container md:mx-auto px-6 my-5">

        @if ($errors->any())
            <x-toast>
                @slot('id', 'toast-alert')
                @slot('icon', 'info')
                @slot('background', 'error')
                <x-slot name="header">
                    <span class="font-medium">Une erreur est survenue : </span>
                </x-slot>
                <x-slot name="message">
                    @if($errors->count() == 1)
                        <div class="mt-1.5">
                            {{$errors->all()[0]}}
                        </div>
                    @else
                        <ul class="mt-1.5 ml-4 list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                </x-slot>
            </x-toast>
        @elseif (session('success'))
            <x-toast>
                @slot('id', 'toast-success')
                @slot('icon', 'done')
                @slot('background', 'success')
                <x-slot name="header">
                    <span class="font-medium"></span>
                </x-slot>
                <x-slot name="message">
                    <div class="mt-1.5">
                        {{ session('success') }}
                    </div>
                </x-slot>
            </x-toast>
        @endif

        @if (isset($pageParent))
            @foreach ($pageParent as $page => $args)
                <a href="{{ route($page, $args) }}"
                    class="sticky top-2 btn btn-transparent flex lg:ml-2 lg:inline-flex justify-center">
                    <span class="icons">arrow_back</span>
                    Retour
                </a>
            @endforeach
        @endif

        @yield('content')



    </main>

    <footer class="bg-white rounded-lg m-4 text-center mt-auto mx-auto">
        <button class="goTop" id="goTop" title="Go to top">
            <svg class="w-6 h-6 text-white dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 8">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7 7.674 1.3a.91.91 0 0 0-1.348 0L1 7"/>
            </svg>
        </button>

        <div class="w-full mx-auto max-w-screen-xl p-4 md:flex md:items-center md:justify-between">
		<span class="text-sm text-gray-500 sm:text-center">
			&copy; 2023 <a href="https://he-arc.ch" target="_blank" class="hover:underline">Haute Ecole Arc</a>.
			Tous droits réservés.
		</span>
        </div>
    </footer>
</body>

</html>
