@extends('layouts.bas')

@section('content')
    <div class="bg-banner h-screen">
        @include('layouts.sidenav')
        <div class=" flex items-center pb-5 mx-10">
            <p class=" text-gray">apparaat:</p>
            @php
                $i = 0;
            @endphp
            <form action="/" method="get" name="FormM">
                <select class=" p-0 pr-8" name="ConnectionNumber" onchange="this.form.submit()">
                    @foreach ($accounts as $account)
                        <option value="{{ $i }}" @if ($account->id == $selectedAccount->id) selected @endif>
                            @if (isset($account->name))
                                {{ $i + 1 . ': ' . $account->name }}
                            @else
                                {{ $i + 1 }}
                            @endif
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
                <a class=" text-white flex justify-center"
                   onclick="location.href='{{ url('ProductList/' . $accountIndex) }}'">
                    Inventaris
                </a>

                <a class=" text-white flex justify-center"
                   onclick="location.href='{{ url('shoppingList/' . $accountIndex) }}'">
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
                <a class=" text-white flex justify-center" onclick="location.href='{{ url('Connect') }}'">
                    Apparaat configureren
                </a>

                <a class=" text-unused flex justify-center">
                    Wijzigen van Account
                </a>

                <a class=" text-unused text-white flex justify-center">
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
                <a class=" text-unused flex justify-center">
                    Help
                </a>

                <a class=" text-unused flex justify-center">
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
                <a class=" text-white flex justify-center" onclick="location.href='{{ url('logout') }}'">
                    loguit
                </a>
            </div>
        </div>
    </div>
@endsection
