@extends('layout.app')

@section('content')
    <form action="{{ route('management.laundries.update', [$laundry['organization_id'], $laundry['id']]) }}" method="POST">
        @csrf
        @method('PUT')
        <section class="container flex flex-col items-gap-4 w-full mx-auto rounded-sm md:w-1/2">
            <h1 class="font-title text-4xl text-center my-3 text-seaNymph">Editer une buandrie</h1>

            <article class="flex flex-col gap-2">
                <label for="name">Nom de la buandrie</label>
                <div id="name" class="input input-sobre">
                    <input type="text" name="name" value="{{ $laundry['name'] }}">
                    <span class="icons icons-sobre">text_fields</span>
                </div>
                <label for="description">Description de la buandrie</label>
                <div id="description" class="input input-sobre">
                    <textarea rows="5" type="text" name="description" >{{ $laundry['description'] }}</textarea>
                    <span class="icons icons-sobre">text_fields</span>
                </div>
                @if ($machines->count() > 0)
                <section class="">
                    <label for="machines">Machines de la buandrie</label>


                    <!-- Grid Container -->
                    <div class="grid grid-cols-1 border-2 border-rollingStone rounded-lg p-0 ">
                        <div class="grid grid-cols-2 rounded-t bg-rollingStone text-white">
                            <div>
                                <h2 class="p-2 text-lg font-semibold">Nom</h2>
                            </div>
                            <div>
                                <h2 class="p-2 text-lg font-semibold">Type</h2>
                            </div>
                        </div>
                        <div class="grid grid-cols-2">
                            @foreach ($machines as $machine)
                                <div class ="border-r-2 p-2 border-rollingStone">
                                    {{ $machine['name'] }}
                                </div>
                                <div class =" p-2 ">
                                    {{ $machine->typeName() }}
                                </div>
                            @endforeach
                        </div>
                    </div><!-- End Grid Container -->


                </section>
                @endif

                <div class="flex gap-2">
                    <a href="{{ route('management.laundries.show', [$laundry['organization_id'],$laundry['id']]) }}"
                        class="flex-grow btn btn-sobre">Annuler</a>
                    <button type="submit" class="btn btn-forte">Mettre a jour</button>
                </div>
                </div>
            </article>
        </section>
    </form>
@endsection
