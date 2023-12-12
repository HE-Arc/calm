@extends('layout.app')

@section('content')
    <form action="{{ route('management.machines.store', [$orgId, $laundryId]) }}" method="POST">
        @csrf
        @method('POST')
        <section class="container flex flex-col items-gap-4 w-full mx-auto rounded-sm md:w-1/2">
            <h1 class="font-title text-4xl text-center my-3 text-seaNymph">Créer une machine</h1>

            <article class="flex flex-col gap-2">
                <label for="name">Nom de la machine</label>
                <div id="name" class="input input-sobre">
                    <input type="text" name="name" placeholder="Nom de la machine" value="{{ old('name') }}">
                    <span class="icons icons-sobre">text_fields</span>
                </div>
                <label for="description">Description de la machine</label>
                <div id="description" class="input input-sobre">
                    <textarea rows="5" type="text" name="description" placeholder="Description de la machine"> {{ old('description') }}</textarea>
                    <span class="icons icons-sobre">text_fields</span>
                </div>

                <label for="type_id">Type de la machine</label>
                <div id="type_id" class="input input-sobre">
                    <select name="type">
                        @foreach ($types as $type => $name)
                            <option value="{{ $type }}">{{ $name }}</option>
                        @endforeach
                    </select>
                    <span class="icons icons-sobre">text_fields</span>
                </div>

                <input type="hidden" name="organization_id" value="{{ $orgId }}">

                <button type="submit" class="btn btn-forte">Ajouter</button>

            </article>
        </section>
    </form>
@endsection
