@extends('layout.app')
@section('content')
<div class="flex flex-col gap-4 items-center justify-center">
    <article class="container flex flex-col items-gap-4 w-full mx-auto rounded-sm">
        <div class="flex flex-col gap-4 items-center justify-center">
            <h1 class="font-title text-4xl text-center mt-3 text-seaNymph">Gestion des utilisateurs de l'organisation</h1>

            <div class="relative overflow-x-auto w-full shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <caption
                        class="p-5 text-justify dark:text-white dark:bg-gray-800">
                        Chaque organisation possède un certain nombre de membres (locataires).
                        Ici, en temps que propriétaire, vous avez la possibilité de visualiser la liste des membres, en affichant
                        leur nom, leur adresse e-mail, la date à laquelle ils ont rejoint l’organisation, le code d’invitation
                        qu’ils ont utilisé et toutes les réservations qu’ils possèdent ou qu’ils ont possédées. <br>
                        Vous pouvez également supprimer les réservations des membres. <br>
                        Vous pouvez pour ajouter un ou plusieurs membres à une organisation à l’aide d’une adresse e-mail. <br>
                        Et vous avez la possibilité de retirer des membres de l'organisation. <br>

                        <div class="mx-auto mt-2 text-right">
                            <a href="{{ route('management.users.add', $orgID) }}" class="btn block lg:inline-block btn-forte">Ajouter un nouvel utilisateur</a>
                        </div>
                    </caption>
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr class="invisible text-center lg:visible">
                            <th scope="col" class="px-6 py-3">
                                Nom d'utilisateur
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Adresse e-mail
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Rejoint le
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Code d'activation utilisé
                            </th>
                            <th scope="col" class="px-6 py-3 text-center">
                                Détail
                            </th>
                            <th scope="col" class="px-6 py-3 text-center">
                                Supprimer
                            </th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach($users as $user)
                        <tr class="bg-white border-b hover:bg-gray-50">
                            <td data-title="Nom d'utilisateur" class="px-6 py-4 text-center font-medium text-gray-900">
                                {{$user->name}}
                            </td>
                            <td data-title="Adresse e-mail" class="px-6 py-4 text-center">
                                {{$user->email}}
                            </td>
                            <td data-title="Rejoint le" class="px-6 py-4 text-center">
                                XX.XX.20XX
                            </td>
                            <td data-title="Code d'activation utilisé" class="px-6 py-4 text-center">
                                ----------
                            </td>
                            <td data-title="Détail" class="px-6 py-4 text-center">
                                <form action="#" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="">
                                    <button type="submit">
                                        <svg class="w-4 h-4 text-rollingStone font-bold dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                                        </svg>
                                    </button>
                                </form>
                            </td>
                            <td data-title="Supprimer" class="px-6 py-4 text-center">
                                <button type="submit" class="btn-admin-delete-user-account" data-modal-target="user-account-delete-confirm-modal"
                                        data-modal-show="user-account-delete-confirm-modal" data-org-id="{{$orgID}}" data-user-id="{{$user->id}}">
                                    <svg class="w-4 h-4 text-rollingStone font-bold dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
                                        <path d="M17 4h-4V2a2 2 0 0 0-2-2H7a2 2 0 0 0-2 2v2H1a1 1 0 0 0 0 2h1v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V6h1a1 1 0 1 0 0-2ZM7 2h4v2H7V2Zm1 14a1 1 0 1 1-2 0V8a1 1 0 0 1 2 0v8Zm4 0a1 1 0 0 1-2 0V8a1 1 0 0 1 2 0v8Z"/>
                                    </svg>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </article>
    {{$users->links()}}
</div>

<x-modal>
    @slot('id', 'user-account-delete-confirm-modal')
    @slot('form', 'delete-user-account-form')
    @slot('icon', 'warning')
    @slot('confirm', 'Supprimer')
    @slot('close', 'Annuler')
    @slot('closable', true)
    @slot('header', 'Supprimer le compte utilisateur')
    <x-slot name="body">
        <form id="delete-user-account-form" action="" method="post">
            @csrf
            @method('DELETE')

            <input type="hidden" name="id" value="">

            <p class="text-gray-500"><strong>!!! ATTENTION !!! </strong> Vous êtes sur le point de
                <strong>DÉFINITIVEMENT</strong> supprimer ce compte utilisateur ! <br>
                Cette action est <strong>IRRÉVERSIBLE</strong> ! Toutes les informations relatives au compte ainsi
                que toutes les réservations seront définitivement supprimées !
                L'utilisateur ne pourra plus rejoindre votre organisation à moins d'y être à nouveau invité !
                <br>
                <br>
                <strong>
                    Êtes-vous sûr de vouloir continuer ?
                </strong>
            </p>
        </form>
    </x-slot>
</x-modal>

@endsection
