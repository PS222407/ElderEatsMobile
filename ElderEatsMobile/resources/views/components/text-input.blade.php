@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 focus:border-hamburger focus:ring-hamburger rounded-md shadow-sm']) !!}>
