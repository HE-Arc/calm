@extends('layout.app')
@section('content')

    <h1 class="font-title text-4xl text-center my-3 text-seaNymph">Gestion des organisations</h1>

    <section class="flex flex-col gap-4 items-center justify-center">
        <div class="mx-auto text-center my-6">
            <a href="{{ route('management.organizations.create') }}" class="btn btn-forte">Créer une nouvelle organisation</a>
        </div>

        @if (count($organizations) === 0)
            <article class="flex items-center justify-center">
                <p class="mt-10">Aucune organisation n'est créer.</p>
            </article>
        @else
            @foreach ($organizations as $organization)
                <article class="items">
                    <!-- Icon -->

                    <span class="icons icons-less-forte col-span-12 md:col-span-1">
                        corporate_fare
                    </span>

                    <!-- Title -->
                    <a href="{{ route('management.organizations.show', $organization['id']) }}" class="col-span-11 xl:-ml-5 px-2 text-manhattan hover:bg-vividTangerine hover:bg-opacity-10 hover:text-vividTangerine font-semibold text-3xl font-title cursor-pointer rounded-lg">
                            {{ $organization['name'] }}
                    </a>
                    <!-- Description -->
                    <div class="flex flex-col gap-2 md:col-start-2 col-span-11 xl:-ml-5">
                        <a href="{{ route ('management.users.index', $organization['id'])}}" class="btn btn-sobre">
                            Gestions des utilisateurs
                        </a>

                        <a href="{{ route('management.laundries.index', $organization['id']) }}" class="btn btn-sobre">
                            Gestions des buandries
                        </a>
                    </div>
                </article>
            @endforeach
            {{ $organizations->links() }}
        @endif
    </section>

@endsection
