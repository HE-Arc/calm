@if (isset($id))
    <article id="{{ $id }}"
        class="mx-auto md:w-1/2 mb-4 flex flex-row gap-2 p-2 rounded-lg shadow bg-{{ $background }} text-{{ $background }} bg-opacity-5">
        @if (isset($icon))
            <div class="sr-only">{{ $icon }}</div>
            <div class="flex p-2.5 text-2xl">
                <span class="icons">{{ $icon }}</span>
            </div>
        @endif

        <section class="flex flex-col flex-grow">
            <div class="flex-grow font-medium">
                @if (isset($header)){{ $header }}@endif
            </div>
            @if (isset($message))
                <section class="flex-grow">{{ $message }}</section>
            @endif
        </section>
        <button type="button"
            class="h-8 w-8 items-center justify-center flex p-2 rounded-lg bg-{{ $background }} hover:bg-{{ $background }} bg-opacity-5 hover:bg-opacity-10 hover:shadow text-2xl"
            data-dismiss-target="#{{ $id }}" aria-label="Close">
            <span class="icons">Close</span>
        </button>
    </article>
@endisset
