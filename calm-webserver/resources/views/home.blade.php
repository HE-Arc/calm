@extends('layout.app')
@section('content')
    <h1 class="font-title text-4xl text-center my-3 text-seaNymph">Qu'est-ce que CALM ?</h1>
    <p class="text-justify">
        <strong>C</strong>apable and <strong>A</strong>ccessible <strong>L</strong>aundry <strong>M</strong>anager
        (CALM) est une application web permettant la gestion de buanderies dans les immeubles locatifs. Elle proposerait
        en particulier la planification horaire et la gestion des réservations.
    </p>

    <h1 class="font-title text-4xl text-center my-3 text-seaNymph">Notre équipe</h1>
    <ul class="text-center">
        <li class="p-1">Nima Dehkli</li>
        <li class="p-1">Lucas Gostelli</li>
        <li class="p-1">Miranda Fleury</li>
    </ul>

    @guest
    <div class="flex flex-col my-5 mx-auto md:max-w-sm">
        <a href="{{ route('login') }}" class="text-center text-white font-bold bg-manhattan hover:bg-vividTangerine focus:ring-4 focus:ring-manhattan rounded-lg text-sm px-5 py-2.5 focus:outline-none my-2">Connexion</a>
        <a href="{{ route('register') }}" class="text-center text-white font-bold bg-manhattan hover:bg-vividTangerine focus:ring-4 focus:ring-manhattan rounded-lg text-sm px-5 py-2.5 focus:outline-none my-2">Inscription</a>
    </div>
    @endguest
@endsection
