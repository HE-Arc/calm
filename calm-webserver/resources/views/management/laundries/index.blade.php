@extends('layout.app')
@section('content')

    {{$laundries}}

    <h1 class="font-title text-4xl text-center my-3 text-seaNymph">Gestion des buandries</h1>

    <section class="flex flex-col gap-4 items-center justify-center">
        <div class="mx-auto text-center my-6">
            <a href="{{ route('management.laundries.create', $orgId) }}" class="btn btn-forte">Créer une nouvelle buandries</a>
        </div>

        @if (count($laundries) === 0)
            <article class="flex items-center justify-center">
                <p class="mt-10">Aucune buandries n'est créer.</p>
            </article>
        @else
            @foreach ($laundries as $laundry)
                <a href="{{ route('management.laundries.show', [$laundry['organization_id'], $laundry['id']]) }}" class="items">
                    <!-- Icon -->
                    <span class="icons icons-less-forte col-span-12 md:col-span-1">
                        corporate_fare
                    </span>

                    <!-- Title -->
                    <p class="col-span-11 xl:-ml-5 font-semibold text-rollingStone">
                        {{ $laundry['name'] }}
                    </p>

                    <!-- Description -->
                    <div class="flex flex-col gap-2 md:col-start-2 col-span-11 xl:-ml-5">
                        <p class="mt-1 text-sm font-normal"> {{ $laundry['description'] }} </p>
                    </div>
                </a>
            @endforeach
            {{ $laundries->links() }}
        @endif
    </section>

@endsection
