@extends('layouts.bas')

@section('content')
    <div class="mt-8 mx-3">
        <h1 class="font-bold text-center">Wijzig product: {{ $product->full_name }}</h1>

        <form method="POST" class="mt-3" action="{{ route('inventory.update', $product->pivot->id) }}" accept-charset="UTF-8">
            @csrf
            <div class="flex flex-col">
                <label for="date">Houdbaarheidsdatum</label>
                @error('datetime')
                    <small style="color: red">{{ $message }}</small>
                @enderror
                <input type="date" id="date" name="datetime" value="{{ old('datetime') ?? $product->pivot->expiration_date }}">
            </div>
            <div class="flex flex-col gap-y-2 mt-3">
                <x-primary-button type="submit"> Verstuur </x-primary-button>
                <a href="{{ route('inventory.index') }}" class="w-full mt-2 rounded-full text-center">Ga terug </a>
            </div>
        </form>
    </div>
@endsection
