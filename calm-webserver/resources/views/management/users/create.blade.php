@extends('layout.app')
@section('content')

    <section class="container flex flex-col items-gap-4 w-full mx-auto rounded-sm md:w-1/2">

        <div
            class="btn btn-transparent">
            <a class="block align-middle" href="{{ route('management.users.index', $orgID) }}">
                <svg class="w-2 h-2 text-seaNymph inline" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                     viewBox="0 0 8 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M7 1 1.3 6.326a.91.91 0 0 0 0 1.348L7 13"/>
                </svg>
                Retour
            </a>
        </div>

        <h1 class="font-title text-4xl text-center my-3 text-seaNymph">Ajouter un nouvel utilisateur</h1>

        <p class="p-5 text-justify dark:text-white dark:bg-gray-800">
            Pour ajouter un nouvel utilisateur, il vous suffit d'entrer son adresse e-mail.
            <strong class="text-seaNymph">Attention</strong>, pour cela, il faut que l'utilisateur soit enregisté
            au préalable.
        </p>

        <article class="flex flex-col gap-2">

            <form class="space-y-6" action="{{ route('management.users.store', $orgID) }}" method="POST">
                @csrf
                @method('POST')

                <div>
                    <input id="organization" name="organization" type="hidden" required
                           class="block w-full pl-10 input input-sobre" value="{{$orgID}}">
                </div>

                <div>
                    <label for="email" >Adresse e-mail</label>
                    <div class="relative mt-2">

                        <div class="flowbite-icon-div">
                            <svg class="flowbite-icon-svg" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 16">
                                <path d="m10.036 8.278 9.258-7.79A1.979 1.979 0 0 0 18 0H2A1.987 1.987 0 0 0 .641.541l9.395 7.737Z"/>
                                <path d="M11.241 9.817c-.36.275-.801.425-1.255.427-.428 0-.845-.138-1.187-.395L0 2.6V14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2.5l-8.759 7.317Z"/>
                            </svg>
                        </div>

                        <input id="email" name="email" type="email" autocomplete="email" required class="block w-full pl-10 input input-sobre">
                    </div>
                </div>

                <div class="text-center">
                    <label class="relative inline-flex items-center mr-5 cursor-pointer">
                        <input type="checkbox" name="isAdmin" value="isAdmin" id="isAdmin" class="sr-only peer choose-wash-dry" @if(old("isAdmin") === "isAdmin") checked @endif>
                        <div
                            class="toggle-switch peer peer-focus:ring-4 peer-focus:ring-vividTangerine peer-checked:after:translate-x-full peer-checked:after:border-white peer-checked:bg-vividTangerine"></div>
                        <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">Compte administrateur</span>
                    </label>
                </div>

                <div>
                    <button type="submit" class="btn w-full btn-forte">Ajouter</button>
                </div>
            </form>
        </article>
    </section>
@endsection
