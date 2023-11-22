@extends('layout.app')

@section('content')
    <form action="{{ route('management.organizations.store') }}" method="POST">
        @csrf
        @method('POST')
        <section class="container flex flex-col items-gap-4 w-full mx-auto rounded-sm md:w-1/2">
            <h1 class="font-title text-4xl text-center my-3 text-seaNymph">Ajouter une organisation</h1>

            <article class="flex flex-col gap-2">
                <label for="name">Nom de l'organisation</label>
                <div id="name" class="input input-sobre">
                    <input autofocus type="text" name="name" placeholder="Nom de l'organisation" value="{{ old('name') }}">
                    <span class="icons icons-sobre">text_fields</span>
                </div>
                <button type="submit" class="btn btn-forte">Ajouter</button>
            </article>
        </section>
    </form>
@endsection
