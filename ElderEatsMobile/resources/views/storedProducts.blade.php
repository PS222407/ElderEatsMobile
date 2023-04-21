@extends('layouts.bas')

@section('content')
    <div class=" mx-36">
        @include('layouts.sidenav')
        <div>
            <div class=" m-3 overflow-scroll flex-auto">

                @foreach ($products as $product)
                    <div class=" relative flex">
                        <div class="flex">
                            <p>{{ $product->name }}</p>
                        </div>
                        <p class=" absolute right-7">--{{ $product->pivot->expiration_date }}</p>
                        <div class=" absolute right-0">
                            <img class=" w-6" src="{{ asset('svg/pencil.svg') }}" alt="bewerken"
                                 onclick="location.href='{{ url('UpdateDate/' . $product->pivot->id . '/' . $accountIndex) }}'"/>
                        </div>
                    </div>
                    <div class=" pb-2">
                        <hr class=" h-1 dark:bg-gray-700">
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
