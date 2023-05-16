@extends('layouts.bas')

@section('content')
    <div class="bg-banner h-screen">
        <div class=" flex items-center pb-5 mx-10">
            <p class=" text-gray">apparaat:</p>
            @php
                $i = 0;
            @endphp
            <form action="/" method="get" name="FormM">
                <select class="ml-2 pl-4 pr-12 py-0 rounded" name="ConnectionNumber" onchange="this.form.submit()">
                    @foreach ($accounts as $account)
                        <option value="{{ $i }}" @if ($account->id == $selectedAccount->id) selected @endif>
                            {{ $account->name ?? $i + 1 }}
                        </option>
                        {{ $i++ }}
                    @endforeach
                </select>
            </form>
        </div>
        <div class=" pb-2 mx-10">
            <p class=" text-gray">Functies</p>
            <hr class=" h-1 dark:bg-gray-700">
        </div>
        <div class=" flex justify-center">
            <div class="grid grid-cols-1">
                <a class=" text-white flex justify-center cursor-pointer hover:underline"
                   href="{{ route('inventory.index') }}">
                    Inventaris
                </a>

                <a class=" text-white flex justify-center  cursor-pointer hover:underline"
                   href="{{ route('shopping-list.index') }}">
                    Boodschappenlijst
                </a>
            </div>
        </div>
        <div class=" pb-2 mx-10">
            <p class=" text-gray">Instellingen</p>
            <hr class=" h-1 dark:bg-gray-700">
        </div>
        <div class=" mt-4 flex justify-center">
            <div class="grid grid-cols-1">
                <a class=" text-white flex justify-center cursor-pointer hover:underline" onclick="location.href='{{ route('connect') }}'">
                    Apparaat configureren
                </a>

                <a class=" text-unused flex justify-center ">
                    Wijzigen van Account
                </a>

                <a class=" text-unused flex justify-center ">
                    Taal
                </a>
            </div>
        </div>

        <div class=" pb-2 mx-10">
            <p class=" text-gray">Over ons</p>
            <hr class=" h-1 dark:bg-gray-700">
        </div>

        <div class=" mt-4 flex justify-center mb-4">
            <div class="grid grid-cols-1">
                <a class=" text-unused flex justify-center ">
                    Help
                </a>

                <a class=" text-unused flex justify-center ">
                    Informatie
                </a>

                <a class=" text-unused flex justify-center">
                    Rapporteer een probleem
                </a>
            </div>
        </div>
        <div class=" pb-2 mx-10">
            <hr class=" h-1 dark:bg-gray-700">
        </div>
        <div class=" mt-4 flex justify-center">
            <div class="grid grid-cols-1">
                <a class=" text-white flex justify-center  cursor-pointer hover:underline" onclick="location.href='{{ route('logout') }}'">
                    loguit
                </a>
            </div>
        </div>
    </div>
@endsection
