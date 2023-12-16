@extends('layout.app')

@section('content')
    <form action="{{ route('management.laundries.update', [$laundry['organization_id'], $laundry['id']]) }}" method="POST">
        @csrf
        @method('PUT')
        <section class="container flex flex-col items-gap-4 w-full mx-auto rounded-sm md:w-1/2">
            <h1 class="font-title text-4xl text-center my-3 text-seaNymph">Modifier une buanderie</h1>

            <article class="flex flex-col gap-2">
                <label for="name">Nom de la buanderie</label>
                <div id="name" class="input input-sobre">
                    <input type="text" name="name" value="{{ $laundry['name'] }}">
                    <span class="icons icons-sobre">text_fields</span>
                </div>
                <label for="description">Description de la buanderie</label>
                <div id="description" class="input input-sobre">
                    <textarea rows="5" type="text" name="description" >{{ $laundry['description'] }}</textarea>
                    <span class="icons icons-sobre">text_fields</span>
                </div>
                <div class="flex gap-2">
                    <a href="{{ route('management.laundries.show', [$laundry['organization_id'],$laundry['id']]) }}"
                        class="flex-grow btn btn-sobre">Annuler</a>
                    <button type="submit" class="btn btn-forte">Mettre à jour</button>
                </div>
                </div>
            </article>
        </section>
    </form>
@endsection
