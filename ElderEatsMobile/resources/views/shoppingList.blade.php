<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        .flex-container {
            display: flex;
            background-color: #d0d0d0;
            flex-direction: row;
            flex-wrap: wrap;
            max-height: 700px;
            width: 444px;
            overflow: auto;
            float: left;
        }

        .flex-container>div {
            flex: 1 0 21%;
            background-color: #f1f1f1;
            margin: 5px;
            padding: 5px;
            font-size: 18px;
            width: 140px
        }

        .vertical {
            float: left;

            margin-top: auto;
            margin-bottom: auto;
        }

        .vertical2 {
            float: left;
            padding-left: 30px;
            margin-top: auto;
            margin-bottom: auto;
        }
    </style>
</head>

<body>

    <h1>BoodschappenLijst</h1>
    <p>product gekocht? vergeet niet af te vinken.</p>

    <div class="flex-container">

        @foreach ($products as $product)
            <div onclick='changecolor({{ $product->id }})'>
                @if (isset($product->image))
                @endif
                <h5 class="vertical">{{ $product->name }}</h5>
                </td>
                <div class="vertical2" checkState=0 id='check-{{ $product->id }}'>
                    <svg fill="#000000" width="20px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                        <path
                            d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM369 209L241 337c-9.4 9.4-24.6 9.4-33.9 0l-64-64c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l47 47L335 175c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9z" />
                    </svg>
                </div>
            </div>
        @endforeach


    </div>
    <script>
        function changecolor(id) {
            var box = document.getElementById("check-" + id);
            if (box.getAttribute('checkState') == 0) {
                box.setAttribute("checkState", '1');
                box.innerHTML =
                    `<svg fill="#32c671" width="20px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM369 209L241 337c-9.4 9.4-24.6 9.4-33.9 0l-64-64c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l47 47L335 175c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9z"/></svg>`
            } else {
                box.setAttribute("checkState", '0');
                box.innerHTML =
                    `<svg fill="#000000" width="20px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM369 209L241 337c-9.4 9.4-24.6 9.4-33.9 0l-64-64c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l47 47L335 175c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9z"/></svg>`
            }
        }
    </script>
</body>

</html>
