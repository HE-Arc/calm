@extends('layout.app')

@section('content')
    <form action="{{ route('management.organizations.update', $organization['id']) }}" method="POST">
        @csrf
        @method('PUT')
        <section class="container flex flex-col items-gap-4 w-full mx-auto rounded-sm md:w-1/2">
            <h1 class="font-title text-4xl text-center my-3 text-seaNymph">Editer une organisation</h1>

            <article class="flex flex-col gap-2">
                <label for="name">Nom de l'organisation</label>
                <div id="name" class="input input-sobre">
                    <input autofocus type="text" name="name" value="{{ $organization['name'] }}">
                    <span class="icons icons-sobre">text_fields</span>
                </div>
                <div class="flex gap-2">
                    <a href="{{ route('management.organizations.show', $organization['id']) }}"
                        class="flex-grow btn btn-sobre">Annuler</a>
                    <button type="submit" class="btn btn-forte">Mettre a jour</button>
                </div>
            </article>
        </section>
    </form>
@endsection
