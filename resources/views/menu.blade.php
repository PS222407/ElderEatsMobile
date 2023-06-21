@extends('layouts.bas')

@section('content')
    <div>
        <div>
            <img src="{{ asset('Images/ElderEating.jpg') }}" alt="elder eating" class="w-full h-96 object-cover">
        </div>

        <div class="px-10 pt-5">
            <h1 class="text-4xl font-medium">Welkom bij ElderEats</h1>
            <p class="pt-4 text-lg">
                Welkom bij "ElderEats" - de app die smaakvolle verbindingen creëert tussen oudere mensen en hun boodschappen.

                Er is iets magisch aan voedsel - het heeft de kracht om herinneringen op te roepen, emoties te voeden en ons terug te brengen naar dierbare momenten uit het verleden. Bij ElderEats begrijpen we dat de eenvoudige handeling van boodschappen doen veel meer is dan alleen het verzamelen van ingrediënten. Het gaat om het delen van verhalen, het koesteren van tradities en het versterken van banden met degenen die ons het meest dierbaar zijn.

                Met ElderEats willen we oudere mensen in staat stellen om met gemak boodschappen te doen en tegelijkertijd een brug te slaan tussen generaties. We geloven dat elke maaltijd een kans is om liefde en zorg te delen, zelfs als fysieke afstand ons scheidt.

                Deze app is meer dan alleen een boodschappenlijst - het is een culinaire metgezel die inspiratie biedt, recepten deelt en het delen van maaltijden met familie en vrienden bevordert. Met ElderEats kunnen oudere mensen hun favoriete gerechten en boodschappenlijstjes eenvoudig beheren, ze delen met hun dierbaren en zelfs nieuwe culinaire ontdekkingen doen.

                Of het nu gaat om het traditionele familierecept dat al generaties lang wordt doorgegeven, of een eenvoudig gerecht dat troost biedt op een eenzame dag - ElderEats staat klaar om je te ondersteunen bij het creëren van heerlijke herinneringen en het ervaren van de vreugde van het samenzijn, zelfs op afstand.

                We nodigen je uit om deel te nemen aan deze smakelijke reis. Een reis vol gastronomische avonturen, gelach aan de keukentafel en het delen van liefdevolle momenten. Samen kunnen we van boodschappen doen een smaakvolle en betekenisvolle ervaring maken.

                Welkom bij ElderEats, waar voedsel de taal van genegenheid spreekt.
            </p>
        </div>
    </div>


   {{-- <div class="bg-banner h-screen">
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
    </div>--}}
@endsection
