@extends('layouts.bas')

@section('content')
    <h1 class="text-2xl text-center font-bold mt-10">BoodschappenLijst</h1>
    <p class="text-center italic uppercase text-hamburger w-3/4 mx-auto">product gekocht? vergeet niet af te vinken.</p>

        <button onclick="SubmitChange()" class=" bg-banner rounded-xl w-32 text-green-50"> opslaan </button>
    <div class="flex mt-5">
        <div class="grid grid-cols-2 mx-3 gap-3 w-full">
            @foreach ($products as $product)
                <div class="relative">
                    <div class="flex flex-col h-full rounded-xl border-gray border m-1 w-90 overflow-hidden shadow-xl  bg-white" onclick='changecolor({{ $product->id }})'>
                        <img class="h-24 aspect-square object-contain" src={{ $product->image ?? asset('Images/noImage.png') }} />
                        <h5 class="p-2 text-sm">{{ $product->name }}</h5>
                    </div>
                    <div class="absolute -right-2 top-10" checkState=0
                         id='check-{{ $product->id }}'>
                        <svg fill="#bbbbbb" width="30px" class="" xmlns="http://www.w3.org/2000/svg"
                             viewBox="0 0 512 512">
                            <!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                            <path
                                d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM369 209L241 337c-9.4 9.4-24.6 9.4-33.9 0l-64-64c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l47 47L335 175c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9z"/>
                        </svg>
                    </div>
                </div>
        @endforeach

        </div>
    </div>

    <script>

        var ChangedData = {};

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
            registerChangeData(id, box)
        }

        function registerChangeData(id, box){

            var stateConvertForDatabase = box.getAttribute('checkState');

            if(stateConvertForDatabase == 1){
                stateConvertForDatabase = 0;
            }else{
                stateConvertForDatabase = 1;
            }

            ChangedData[id] = stateConvertForDatabase;

                
        }
        async function SubmitChange(){

                //Logic goes here

                //alert("test")
            const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;


            await fetch(`{{ url('UpdateShoppingList/'.$accountIndex) }}`, {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        "X-CSRF-Token": csrfToken
                    },
                    body: JSON.stringify(ChangedData),
                })
                
                location.reload();
                
            }
        
        



    </script>
@endsection
