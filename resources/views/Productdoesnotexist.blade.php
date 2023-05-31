@extends('layouts.bas')

@section('content')
<h1 class=" text-center">er is een error voor gekomen bij het laden van u product. probeer het nog een keer</h1>

<div class="flex flex-col items-center">
<td >
    <button class=" bg-banner rounded-xl p-1 text-white" onclick="location.href='/inventory'"> ga terug
    </button>
</td>
</div>
@endsection
