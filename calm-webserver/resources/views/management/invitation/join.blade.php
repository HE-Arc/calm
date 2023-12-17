@extends('layout.app')
@section('content')

    <div class="flex flex-col gap-4 items-center justify-center">
        <article class="container flex flex-col items-gap-4 w-full mx-auto rounded-sm">
            <div class="flex flex-col gap-4 items-center justify-center">
                <h1 class="font-title text-4xl text-center mt-3 text-seaNymph">Rejoindre une organisation</h1>

                <div class="sm:mx-auto sm:w-full sm:max-w-sm">
                    <form class="space-y-6" action="#" method="POST">
                        @csrf
                        @method('POST')
                        <div>
                            <label for="code">Code d'activation</label>
                            <div class="relative mt-2">
                                <div class="flowbite-icon-div">
                                    <svg class="flowbite-icon-svg" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                                        <path d="M6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Zm11-3h-2V5a1 1 0 0 0-2 0v2h-2a1 1 0 1 0 0 2h2v2a1 1 0 0 0 2 0V9h2a1 1 0 1 0 0-2Z"/>
                                    </svg>
                                </div>

                                <input id="code" value="{{old('code')}}" name="code" type="text" autocomplete="name" required class="block w-full pl-10 input input-sobre">
                            </div>
                        </div>

                        <div>
                            <button type="submit" class="btn btn-sobre flex justify-center w-full ">Rejoindre</button>
                        </div>
                    </form>
                </div>
            </div>
        </article>
    </div>

@endsection
