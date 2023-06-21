@extends('layouts.bas')

@section('content')
    <div class="mt-8 mx-3">
        <h1 class="font-bold text-center">Wijzig product: {{ $product->product->full_name }}</h1>

        <form method="POST" class="mt-3" action="{{ route('inventory.update', $product->id) }}" accept-charset="UTF-8">
            @csrf
            <div class="flex flex-col">
                <label for="date">Houdbaarheidsdatum</label>
                @error('datetime')
                    <small style="color: red">{{ $message }}</small>
                @enderror
                <input type="date" id="date" name="datetime" value="{{ old('datetime') ?? $product->expirationDate }}">
            </div>
            <div class="flex flex-col gap-y-2 mt-3">
                <x-primary-button type="submit"> Verstuur </x-primary-button>
                <a href="{{ route('inventory.index') }}" class="w-full mt-2 rounded-full text-center">Ga terug </a>
            </div>
        </form>
        @if(!isset($product->product->image))

        <div class=" m-4 border-2">
        <h2 class="font-bold text-center mt-10">Het lijkt erop dat er nog geen foto voor dit product beschikbaar is. U kunt deze toevoegen als u dat wenst.</h2>
            <div class="flex m-3 flex-col gap-y-2 mt-3">
                <a href="{{ route('Product-image' , $product->product->id) }}" class="w-full mt-2 mb-2 bg-banner text-white p-2 rounded-full text-center">Voegtoe</a>
            </div>
        </div>
        @endif
    </div>
@endsection
