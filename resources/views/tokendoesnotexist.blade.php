@extends('layouts.bas')

@section('content')
<h1>deze token bestaat niet of is verlopen</h1>

<td>
    <button onclick="location.href='{{ url('/') }}'"> ga terug
    </button>
</td>
@endsection
