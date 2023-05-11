@extends('layouts.bas')

@section('content')

    <button class="py-3 px-5 bg-hamburger text-white rounded"
            onclick="document.dispatchEvent(new CustomEvent('permission-button-pressed'))">
        permission
    </button>
    <button class="py-3 px-5 bg-hamburger text-white rounded"
            onclick="document.dispatchEvent(new CustomEvent('send-notification-button-pressed'))">
        send notification
    </button>
    <button class="py-3 px-5 bg-hamburger text-white rounded"
            onclick="document.dispatchEvent(new CustomEvent('read-notification-permissions-button-pressed'))">
        log permissions
    </button>

    <div class="mt-8 mx-3 ">
        <h1 class="text-center text-2xl font-bold">Inventaris</h1>
        <div class="overflow-scroll flex-auto mt-4">
            <hr class=" h-1 dark:bg-gray-700">
            @foreach ($products as $product)
                <div class="py-3 relative flex">
                    <div class="flex ">
                        <p class=" flex-wrap w-56">
                            {{ $product->full_name }}
                        </p>
                    </div>
                    <p class=" absolute right-7">--{{ dateShortStringToHumanNL($product->pivot->expiration_date) }}</p>
                    <a href="{{ url('UpdateDate/' . $product->pivot->id) }}" class=" absolute right-0">
                        <img class=" w-6" src="{{ asset('svg/pencil.svg') }}" alt="bewerken" />
                    </a>
                </div>
                <hr class=" h-1 dark:bg-gray-700">
            @endforeach
        </div>
    </div>
@endsection
