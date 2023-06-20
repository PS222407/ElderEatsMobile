<nav class="bg-banner w-full z-20 top-0 left-0 flex justify-between">
    <div class="flex flex-col flex-1 justify-center ml-10 rounded text-xs font-medium uppercase leading-tight">
        <button class="navbar-burger flex items-center text-blue-600">
            <svg class="block h-10 w-10 fill-current text-hamburger" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <title>Mobile menu</title>
                <path fill="black" d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"></path>
            </svg>
        </button>
    </div>

    <div class="flex justify-center flex-1 mr-10">
        <a href="/">
            <img src="{{ asset('Images/logo_schaduw.png') }}" alt="logo" class="w-28 p-2 aspect-square">
        </a>
    </div>

    <div class="flex-1">

    </div>

    <div class="navbar-menu relative z-50 hidden bg-banner">
        <div class="navbar-backdrop fixed inset-0 bg-gray-800 opacity-25"></div>
        <nav class="fixed top-0 left-0 bottom-0 flex flex-col w-5/6 max-w-sm py-2 px-6 bg-banner border-r overflow-y-auto">
            <div class="flex items-center mb-8">
                <a class="mr-auto text-3xl font-bold leading-none" href="/">
                    <img src="{{ asset('Images/logo_schaduw.png') }}" alt="logo" class="w-20 p-2 aspect-square">
                </a>
                <button class="navbar-close">
                    <svg class="h-6 w-6 text-gray-400 cursor-pointer hover:text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <div>
                <ul>
                    @isset($accounts)
                        <div class="flex pl-4">
                            <a class="text-white block text-sm font-semibold text-gray-400 hover:bg-blue-50 hover:text-blue-600 rounded">Apparaat:</a>

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
                    @endisset

                    <li class="mb-1 pt-3">
                        <a class="text-white block p-4 text-lg font-bold text-gray-400 hover:bg-blue-50 hover:text-blue-600 rounded" href="#">Functies</a>
                    </li>
                    <li>
                        <a class="text-white block p-4 text-sm font-semibold text-gray-400 hover:bg-blue-50 hover:text-blue-600 rounded cursor-pointer" href="{{ route('inventory.index') }}">Inventaris</a>
                    </li>
                    <li>
                        <a class="text-white block p-4 text-sm font-semibold text-gray-400 hover:bg-blue-50 hover:text-blue-600 rounded cursor-pointer" href="{{ route('shopping-list.index') }}">Boodschappenlijst</a>
                    </li>



                    <li class="mb-1 pt-3">
                        <a class="text-white block p-4 text-lg font-bold text-gray-400 hover:bg-blue-50 hover:text-blue-600 rounded" href="#">Instellingen</a>
                    </li>
                    <li class="mb-1">
                        <a class="text-white block p-4 text-sm font-semibold text-gray-400 hover:bg-blue-50 hover:text-blue-600 rounded cursor-pointer" onclick="location.href='{{ route('connect') }}'">Apparaat configureren</a>
                    </li>
{{--                    <li class="mb-1">--}}
{{--                        <a class="text-white block p-4 text-sm font-semibold text-gray-400 hover:bg-blue-50 hover:text-blue-600 rounded" href="#">Wijzigen van Account</a>--}}
{{--                    </li>--}}
                    <li class="mb-1">
                        <a class="text-white block p-4 text-sm font-semibold text-gray-400 hover:bg-blue-50 hover:text-blue-600 rounded" href="#">Taal</a>
                    </li>


{{--                    <li class="mb-1 pt-3">--}}
{{--                        <a class="text-white block p-4 text-lg font-bold text-gray-400 hover:bg-blue-50 hover:text-blue-600 rounded" href="#">Over ons</a>--}}
{{--                    </li>--}}
{{--                    <li class="">--}}
{{--                        <a class="text-white block p-4 text-sm font-semibold text-gray-400 hover:bg-blue-50 hover:text-blue-600 rounded" href="#">Help</a>--}}
{{--                    </li>--}}
{{--                    <li class="">--}}
{{--                        <a class="text-white block p-4 text-sm font-semibold text-gray-400 hover:bg-blue-50 hover:text-blue-600 rounded" href="#">Informatie</a>--}}
{{--                    </li>--}}
{{--                    <li class="">--}}
{{--                        <a class="text-white block p-4 text-sm font-semibold text-gray-400 hover:bg-blue-50 hover:text-blue-600 rounded" href="#">Rapporteer een probleem</a>--}}
{{--                    </li>--}}
                </ul>
            </div>
            <div class="mt-auto">
                <div class="pt-6">
                    <a class="text-white block px-4 py-3 mb-3 leading-loose text-lg cursor-pointer text-center font-semibold leading-none bg-gray-50 hover:bg-gray-100 rounded-xl" onclick="location.href='{{ route('logout') }}'">Uitloggen</a>
                </div>
                <p class="text-white my-4 text-md text-center text-gray-400">
                    <span>©2023 ElderEats. All Rights Reserved.</span>
                </p>
            </div>
        </nav>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const burger = document.querySelectorAll('.navbar-burger');
            const menu = document.querySelectorAll('.navbar-menu');

            if (burger.length && menu.length) {
                for (var i = 0; i < burger.length; i++) {
                    burger[i].addEventListener('click', function() {
                        for (var j = 0; j < menu.length; j++) {
                            menu[j].classList.toggle('hidden');
                        }
                    });
                }
            }

            const close = document.querySelectorAll('.navbar-close');
            const backdrop = document.querySelectorAll('.navbar-backdrop');

            if (close.length) {
                for (var i = 0; i < close.length; i++) {
                    close[i].addEventListener('click', function() {
                        for (var j = 0; j < menu.length; j++) {
                            menu[j].classList.toggle('hidden');
                        }
                    });
                }
            }

            if (backdrop.length) {
                for (var i = 0; i < backdrop.length; i++) {
                    backdrop[i].addEventListener('click', function() {
                        for (var j = 0; j < menu.length; j++) {
                            menu[j].classList.toggle('hidden');
                        }
                    });
                }
            }
        });
    </script>
</nav>

