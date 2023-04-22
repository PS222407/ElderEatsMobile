@extends('layouts.bas')

@section('content')
    <div class="mt-8 mx-3">
        <h1 class="font-bold text-center">Wijzig product: {{ $product->name.' '.$product->brand }}</h1>

        <form method="POST" class="mt-3" action="{{ route('UpdateDatePost', ['productaccountid' => $product->pivot->id, 'accountIndex' => $accountIndex]) }}" accept-charset="UTF-8">
            @csrf
            <div class="flex flex-col">
                <label for="date">Houdbaarheidsdatum</label>
                <input type="date" id="date" name="datetime" value="{{ $product->pivot->expiration_date }}"><br>
            </div>
            <div class="flex flex-col gap-y-2">
                <x-primary-button type="submit"> Verstuur </x-primary-button>
                <a href="{{ url()->previous() ?? '/' }}" class="w-full mt-2 rounded-full text-center"> Ga terug </a>
            </div>
        </form>
    </div>
@endsection
