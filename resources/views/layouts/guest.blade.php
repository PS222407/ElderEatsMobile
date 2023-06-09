@extends('layouts.bas')

@section('content')
    <div class="flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
        <div
            class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white border-gray border shadow-md overflow-hidden sm:rounded-lg">
            {{ $slot }}
        </div>
    </div>
@endsection
