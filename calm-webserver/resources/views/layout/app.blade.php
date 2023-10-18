<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="@yield('pageDescription')">

        <title> @yield('pageTitle') | CALM</title>

        <!-- Custom Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Itim&family=Montserrat:wght@400;700&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css','resources/js/app.js'])
    </head>

    <body class="antialiased">
        <header>
            <nav class="bg-seaNymph shadow-lg">
                <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
                    <button data-collapse-toggle="navbar-user" type="button" class="inline-flex items-center p-2 justify-center rounded-lg md:hidden focus:outline-none" aria-controls="navbar-user" aria-expanded="false">
                        <span class="sr-only">Open main menu</span>
                        <svg class="w-7 h-7 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
                        </svg>
                    </button>

                    <a href="#" class="flex items-center">
                        <span class="self-center text-4xl font-title text-white">CALM</span>
                    </a>

                    <div class="flex items-center md:order-2">
                        <button type="button" class="flex mr-3 text-sm bg-transparent text-white rounded-full md:mr-0 focus:ring-4 focus:ring-gray-300" id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom">
                            <span class="sr-only">Open user menu</span>
                            <svg class="w-7 h-7" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm0 5a3 3 0 1 1 0 6 3 3 0 0 1 0-6Zm0 13a8.949 8.949 0 0 1-4.951-1.488A3.987 3.987 0 0 1 9 13h2a3.987 3.987 0 0 1 3.951 3.512A8.949 8.949 0 0 1 10 18Z"/>
                            </svg>
                        </button>

                        <!-- Dropdown menu -->
                        <div class="z-50 hidden text-white font-bold my-4 text-base bg-greyNurse divide-y divide-gray-100 rounded-lg shadow" id="user-dropdown">
                            <div class="px-4 py-3 hover:bg-greyNurse">
                                <span class="block text-sm">JohnDoe</span>
                                <span class="block text-sm truncate">johndoe@example.com</span>
                            </div>

                            <ul class="py-2" aria-labelledby="user-menu-button">
                                <li>
                                    <a href="#" class="block px-4 py-2 text-sm hover:bg-berylGreen">Compte</a>
                                </li>
                                <li>
                                    <a href="#" class="block px-4 py-2 text-sm hover:bg-berylGreen">Déconnexion</a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-user">
                        <ul class="flex flex-col font-bold md:p-0 mt-4 rounded-lg md:flex-row md:space-x-8 md:mt-0 md:border-0 text-white">
                            <li>
                                <a href="#" class="block py-2 pl-3 pr-4 bg-rollingStone rounded md:bg-transparent md:text-rollingStone md:p-0" aria-current="page">Accueil</a>
                            </li>

                            <!-- IF NOT CONNECTED -->
                            <li>
                                <a href="#" class="block py-2 pl-3 pr-4 rounded hover:bg-rollingStone md:hover:bg-transparent md:hover:text-rollingStone md:p-0">Connexion</a>
                            </li>
                            <li>
                                <a href="#" class="block py-2 pl-3 pr-4 rounded hover:bg-rollingStone md:hover:bg-transparent md:hover:text-rollingStone md:p-0">Inscription</a>
                            </li>

                            <!-- IF NOT IN ORGANISATION -->
                            <li>
                                <a href="#" class="block py-2 pl-3 pr-4 rounded hover:bg-rollingStone md:hover:bg-transparent md:hover:text-rollingStone md:p-0">Rejoindre une organisation</a>
                            </li>

                            <!-- IF CONNECTED -->
                            <li>
                                <a href="#" class="block py-2 pl-3 pr-4 rounded hover:bg-rollingStone md:hover:bg-transparent md:hover:text-rollingStone md:p-0">Réservation</a>
                            </li>

                            <!-- IF ADMIN -->
                            <li>
                                <a href="#" class="block py-2 pl-3 pr-4 rounded hover:bg-rollingStone md:hover:bg-transparent md:hover:text-rollingStone md:p-0">Gestion des organisations</a>
                            </li>
                            <li>
                                <a href="#" class="block py-2 pl-3 pr-4 rounded hover:bg-rollingStone md:hover:bg-transparent md:hover:text-rollingStone md:p-0">Gestion des buandries</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>

        <main class="md:container md:mx-auto px-4">
            @yield('content')
        </main>

        <footer class="bg-white rounded-lg m-4">
            <div class="w-full mx-auto max-w-screen-xl p-4 md:flex md:items-center md:justify-between">
                <span class="text-sm text-gray-500 sm:text-center">
                &copy; 2023 <a href="https://he-arc.ch" target="_blank" class="hover:underline">Haute École Arc</a>.
                All Rights Reserved.
                </span>
            </div>
        </footer>
    </body>
</html>
