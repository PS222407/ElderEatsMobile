@extends('layouts.bas')

@section('content')
    <h1>de login is niet gelukt.</h1>
    <td>
        <button onclick="location.href='{{ url('/') }}'">ga terug</button>
    </td>
@endsection
