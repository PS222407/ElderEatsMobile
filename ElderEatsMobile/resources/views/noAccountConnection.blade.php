@extends('layouts.bas')

@section('content')
    <div class="mt-8 flex flex-col gap-y-2 text-center mx-3">
        <h1 class="text-xl font-bold capitalize">je bent met geen accounts verbonden</h1>
        <x-primary-button-link href="{{ route('connect') }}">
            Met account verbinden
        </x-primary-button-link>
    </div>
@endsection
