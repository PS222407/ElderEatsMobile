@extends('layouts.bas')

@section('content')
    <h1>je bent met geen accounts verbonden</h1>
    <td>
        <button onclick="location.href='{{ url('Connect') }}'">
            Met account verbinden
        </button>
    </td>
@endsection
