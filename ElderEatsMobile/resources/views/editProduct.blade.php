@extends('layouts.bas')

@section('content')
    <h1>{{ $product->pivot->id }}</h1>

    <form method="POST" action="{{ url('UpdateDatePost/' . $product->pivot->id . '/' . $accountIndex) }}"
        accept-charset="UTF-8">
        {{ csrf_field() }}
        <input type="date" name="datetime"><br>
        <button type="submit"> Verstuur </button>
    </form>
@endsection
