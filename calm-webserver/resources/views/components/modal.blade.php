@if (isset($id))
    <article id="{{ $id }}" tabindex="-1" aria-hidden="true"
        @if (!isset($closable)) data-modal-backdrop="{{ $id }}" @endif
        class="hidden fixed top-0 left-0 right-0 z-50 w-full h-full backdrop-blur-sm p-4 overflow-x-hidden overflow-y-auto md:inset-0 bg-rollingStone bg-opacity-70">
        <div class="relative w-full md:max-w-2xl max-h-full">
            <div class="relative flex flex-col bg-white rounded-lg shadow gap-2 p-4">
                @if (isset($closable))
                    <button class="btn btn-transparent flex self-end ">
                        <span class="text-2xl icons icons-sobre"
                            data-modal-hide="{{ $id }}">close</span>
                    </button>
                @endif
                @if (isset($icon))
                    <section class="self-center text-8xl my-3">
                        @switch($icon)
                            @case('success')
                                <h1 class=" text-success">
                                    <span class="icons">check_circle</span>
                                </h1>
                            @break

                            @case('warning')
                                <h1 class=" text-warning">
                                    <span class="icons">warning</span>
                                </h1>
                            @break

                            @case('error')
                                <h1 class=" text-error">
                                    <span class="icons">error</span>
                                </h1>
                            @break

                            @default
                                <h1 class="text-seaNymph">
                                    {{ $icon }}
                                </h1>
                        @endswitch
                    </section>
                @endif
                @if (isset($header))
                    <section>{{ $header }}</section>
                @endif
                @if (isset($body))
                    <section>{{ $body }}</section>
                @endif
                <section class="flex flex-row gap-2">
                    @if (isset($confirm))
                        <button
                            class="btn btn-forte w-full mx-auto"
                            @if (isset($form)) onclick="document.getElementById('{{ $form }}').submit();" @endif>
                            {{ $confirm }}
                        </button>
                    @endif
                    @if (isset($close))
                        <button
                            class="btn btn-less-forte w-full mx-auto"
                            data-modal-hide="{{ $id }}">
                            {{ $close }}
                        </button>
                    @endif
                </section>
            </div>
        </div>
    </article>
@endif
