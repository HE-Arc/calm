@extends('layout.app')
@section('content')
    <h1 class="font-title text-4xl text-center my-3 text-seaNymph">Gestion des Machines</h1>

    <section class="flex flex-col gap-4 items-center justify-center">
        <div class="mx-auto text-center my-6">
            <a href="{{ route('management.machines.create',[ $orgId,$laundryId]) }}" class="btn btn-forte">Créer une nouvelle Machine</a>
        </div>

        @if (count($machines) === 0)
            <article class="flex items-center justify-center">
                <p class="mt-10">Aucune machine n'a été créée</p>
            </article>
        @else
            @foreach ($machines as $machine)
                <a href="{{ route('management.machines.show', [$orgId,$laundryId,$machine['id']]) }}" class="items">
                    <!-- Icon -->
                    <span class="icons icons-less-forte col-span-12 md:col-span-1">
                        {{$machine['type']}}
                    </span>

                    <!-- Title -->
                    <p class="col-span-11 xl:-ml-5 font-semibold text-rollingStone">
                        {{ $machine['name'] }}
                    </p>


                    <!-- Description -->
                    <div class="flex flex-col gap-2 md:col-start-2 col-span-11 xl:-ml-5">
                        <p class="mt-1 text-sm font-normal"> {{ $machine['description'] }} </p>
                    </div>

                    <!-- Type -->
                    <div class="flex gap-2 md:col-start-2 col-span-11 xl:-ml-5 justify-end items-center">
                        <label for="type" class="font-semibold text-rollingStone">type de machine:</label>
                        <p id="type" class="text-sm font-normal"> {{ $machine['typeName'] }} </p>
                    </div>
                </a>
            @endforeach
            {{ $machines->links() }}
        @endif
    </section>

@endsection
