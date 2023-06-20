@extends('layouts.bas')

@section('content')
    <div class="mt-8 mx-3 ">
        <h1 class="text-center text-2xl font-bold">Inventaris</h1>
        <div class="flex-auto mt-4">
            <hr class=" h-1 dark:bg-gray-700">
            @foreach ($products as $product)
                <div class="py-3 relative flex">
                    <div class="flex ">
                        <p class=" flex-wrap w-56">
                            {{ $product->full_name }}
                        </p>
                    </div>

                    <p>--{{ dateShortStringToHumanNL($product->pivot->expiration_date) }}</p>

                    <div aria-label="action-buttons" class="flex gap-x-2 w-fit">
                        <div>
                            @if(is_null($product->image))
                                <img class="w-4 top-0.5" src="{{ asset('Images/mark.png') }}" alt="bewerken" />
                            @endif
                            <a href="{{ route('inventory.edit', $product->pivot->id) }}">
                                <img class="w-6" src="{{ asset('svg/pencil.svg') }}" alt="bewerken" />
                            </a>
                        </div>
                        <form action="{{ route('inventory.destroy', $product->pivot->id) }}" method="post" onsubmit="return confirm('Weet je zeker dat je dit product wil verwijderen?')">
                            @csrf
                            @method('DELETE')
                            <button style="padding: .5em">
                                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#ff0000}</style><path d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0H284.2c12.1 0 23.2 6.8 28.6 17.7L320 32h96c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 96 0 81.7 0 64S14.3 32 32 32h96l7.2-14.3zM32 128H416V448c0 35.3-28.7 64-64 64H96c-35.3 0-64-28.7-64-64V128zm96 64c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16z"/></svg>
                            </button>
                        </form>
                    </div>
                </div>
                <hr class=" h-1 dark:bg-gray-700">
            @endforeach
        </div>
    </div>
@endsection
