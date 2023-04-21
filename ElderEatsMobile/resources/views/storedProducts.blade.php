<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>opslag</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .flex-container {
            display: flex;
            background-color: #d0d0d0;
            flex-direction: row;
            flex-wrap: wrap;
            max-height: 700px;
            width: 60%;
            overflow: auto;
            float: left;
        }

        .flex-container>div {
            background-color: #f1f1f1;
            margin: 5px;
            padding: 5px;
            font-size: 18px;
            width: 140px
        }

        .vertical {}
    </style>
</head>

<body>

    <div class=" mx-36">
        @include('layouts.sidenav')

        <div>
            <div class=" h-96 overflow-scroll flex-auto">

                @foreach ($products as $product)
                    <div class=" relative flex">
                        <div class="flex">
                            <p>{{ $product->name }}</p>



                        </div>
                        <p class=" absolute right-7">--{{ $product->pivot->expiration_date }}</p>
                        <div class=" absolute right-0">
                            <img class=" w-6" src="{{ asset('svg/pencil.svg') }}" alt="bewerken"
                                onclick="location.href='{{ url('UpdateDate/' . $product->pivot->id . '/' . $accountIndex) }}'" />
                        </div>

                    </div>
                    <div class=" pb-2">
                        <hr class=" h-1 dark:bg-gray-700">
                    </div>
                @endforeach


            </div>





        </div>
    </div>
</body>

</html>
