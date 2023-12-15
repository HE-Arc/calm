@extends('layout.app')

@section('content')
    <form action="{{ route('management.machines.update', [$orgId, $laundryId, $machine['id']]) }}" method="POST">
        @csrf
        @method('PUT')
        <section class="container flex flex-col items-gap-4 w-full mx-auto rounded-sm md:w-1/2">
            <h1 class="font-title text-4xl text-center my-3 text-seaNymph">Détails de la machine</h1>
            <article class="flex flex-col gap-2">
                <label for="name">Nom de la machine</label>
                <div id="name" class="input input-sobre">
                    <input type="text" name="name" value="{{ $machine['name'] }}" required>
                    <span class="icons icons-sobre">text_fields</span>
                </div>
                <label for="description">Description de la machine</label>

                <div id="description" class="input input-sobre">
                    <textarea rows="5" type="text" name="description" >{{ $machine['description'] }}</textarea>
                    <span class="icons icons-sobre">text_fields</span>
                </div>

                <label for="type">Type de la machine</label>

                <div class="input input-sobre">
                    <select id="type" name="type" class="block w-full" required>
                        @foreach ($types as $type => $name)
                            <option value="{{ $type}}" @if ($machine['type'] == $type) selected @endif>
                                {{ $name }}
                            </option>
                        @endforeach
                    </select>

                    <span class="icons icons-sobre">list</span>
                </div>

                <label for="laundry">Changer la machine de buanderie</label>

                <div class="input input-sobre">
                    <select id="laundry" name="laundry_id" class="block w-full" required>
                        @foreach ($laundries as $laundry)
                            <option value="{{ $laundry['id'] }}" @if ($laundry['id'] == $laundryId) selected @endif>
                                {{ $laundry['name'] }}
                            </option>
                        @endforeach
                    </select>

                    <span class="icons icons-sobre">list</span>
                </div>

                <div class="flex gap-2">
                    <a href="{{ route('management.machines.show', [$orgId, $laundryId, $machine['id']]) }}"
                        class="flex-grow btn btn-sobre">Annuler</a>
                    <button type="submit" class="btn btn-forte">Mettre à jour</button>
                </div>
            </article>
        </section>
    </form>
@endsection
