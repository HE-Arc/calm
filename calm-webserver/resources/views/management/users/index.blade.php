@extends('layout.app')
@section('content')
<div class="flex flex-col gap-4 items-center justify-center">
    <article class="container flex flex-col items-gap-4 w-full mx-auto rounded-sm">
        <div class="flex flex-col gap-4 items-center justify-center">
            <h1 class="font-title text-4xl text-center mt-3 text-seaNymph">Gestion des utilisateurs de l'organisation {{$org->name}}</h1>

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
                            <a href="{{ route('management.users.add', $org->id) }}" class="btn block lg:inline-block btn-forte">Ajouter un nouvel utilisateur</a>
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
                            <td data-title="Nom d'utilisateur" class="px-6 lg:py-4 text-center font-medium text-gray-900">
                                {{$user->name}}
                            </td>
                            <td data-title="Adresse e-mail" class="px-6 lg:py-4 text-center">
                                {{$user->email}}
                            </td>
                            <td data-title="Rejoint le" class="px-6 lg:py-4 text-center">
                                {{$user->joined_at($org->id)?->format('d.m.Y')}}
                            </td>
                            <td data-title="Code d'activation utilisé" class="px-6 lg:py-4 text-center">
                                {{$user->invitation($org->id)?->code}}
                            </td>
                            <td class="px-6 py-4 text-center">
                                <a class="btn btn-sobre flex w-full justify-center" href="{{ route('management.users.userDetails', [$org->id, $user->id]) }}">Détails</a>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <button type="submit" class="btn btn-sobre flex w-full justify-center btn-admin-delete-user-account"
                                        data-modal-target="user-account-delete-confirm-modal"
                                        data-modal-show="user-account-delete-confirm-modal"
                                        data-org-id="{{$org->id}}" data-user-id="{{$user->id}}">
                                    Supprimer
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
