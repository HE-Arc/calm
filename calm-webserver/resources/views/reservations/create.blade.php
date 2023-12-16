@extends('layout.app')
@section('content')

    <div class="flex flex-col gap-4 items-center justify-center">
        <h1 class="font-title text-4xl text-center mt-3 text-seaNymph">Liste des disponibilités</h1>

        <div class="relative overflow-x-auto w-full shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <caption
                    class="p-5 text-lg font-semibold text-left text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                    Détail de votre réservation
                    <ul class="mt-1 text-sm font-normal text-gray-500">
                        <li>Organisation : {{$proposition['organization']}}</li>
                        <li>Buanderie : {{$proposition['laundry']}}</li>
                        <li>Date : {{\Illuminate\Support\Carbon::create($proposition['date'])->toDateString()}}</li>
                        <li>Type : {{$proposition['type']['name']}}</li>
                    </ul>
                </caption>
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Équipement
                    </th>
                    <th scope="col" class="hidden px-6 py-3 sm:table-cell">
                        Description
                    </th>
                    <th scope="col" class="px-6 py-3 sm:table-cell">
                        Heure
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($proposition['reservations'] as $id => $res)
                    <tr class="bg-white border-b hover:bg-gray-50">
                        <td data-title="Équipement" class="px-6 lg:py-4 font-medium text-gray-900">
                            {{$res->machine->name}}
                        </td>
                        <td class="px-6 py-4 hidden sm:table-cell">
                            {{$res->machine->description}}
                        </td>
                        <td data-title="Heure" class="px-6 lg:py-4">
                            {{\Illuminate\Support\Carbon::create($res->start)->format('H:i')}}
                        </td>
                        <td class="px-6 py-4 text-right">
                            <form action="{{route('reservations.store')}}" method="post">
                                @csrf
                                <input type="hidden" name="id" value="{{$id}}">
                                <button type="submit"
                                        class="btn btn-sobre flex w-full justify-center">
                                    Réserver
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        {{$proposition['reservations']->links()}}
    </div>
@endsection

