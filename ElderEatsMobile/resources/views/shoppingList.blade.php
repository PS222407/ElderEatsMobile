@extends('layouts.bas')

@section('content')
    <div class="">
        @include('layouts.sidenav')

        <h1 class=" mx-3">BoodschappenLijst</h1>
        <p class=" mx-3">product gekocht? vergeet niet af te vinken.</p>

        <div class=" flex mx-3">
            <div class=" w-full grid grid-cols-3">



                @foreach ($products as $product)
                    <div class=" m-1 w-90 overflow-hidden relative shadow-xl" onclick='changecolor({{ $product->id }})'>
                        @if (isset($product->image))
                            <img class=" w-28 h-24" src={{ $product->image }} />
                            @else
                            <img src="{{ asset('Images/noImage.png') }}"class="w-28 h-24">
                        @endif
                        <h5 class=" left-0">{{ $product->name }}</h5>
                        </td>
                        <div class=" absolute right-0 top-0 h-full grid place-items-center" checkState=0
                            id='check-{{ $product->id }}'>
                            <svg fill="#bbbbbb" width="30px" class="" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 512 512">
                                <!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                <path
                                    d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM369 209L241 337c-9.4 9.4-24.6 9.4-33.9 0l-64-64c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l47 47L335 175c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9z" />
                            </svg>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <script>
            function changecolor(id) {
                var box = document.getElementById("check-" + id);
                if (box.getAttribute('checkState') == 0) {
                    box.setAttribute("checkState", '1');
                    box.innerHTML =
                        `<svg fill="#32c671" width="30px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM369 209L241 337c-9.4 9.4-24.6 9.4-33.9 0l-64-64c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l47 47L335 175c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9z"/></svg>`
                } else {
                    box.setAttribute("checkState", '0');
                    box.innerHTML =
                        `<svg fill="#bbbbbb" width="30px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM369 209L241 337c-9.4 9.4-24.6 9.4-33.9 0l-64-64c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l47 47L335 175c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9z"/></svg>`
                }
            }
        </script>
    @endsection
