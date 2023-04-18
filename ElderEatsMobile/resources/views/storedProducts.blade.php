<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
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
        
        .flex-container > div {
          background-color: #f1f1f1;
          margin: 5px;
          padding: 5px;
          font-size: 18px;
          width: 140px
        }

        .vertical{
 
        }
        </style>
</head>
<body>

    <div class="flex-container">
    
    @foreach ($products as $product)
    <div>
        <h5>{{$product->name}}</h3>
        @if (isset($product->pivot->expiration_date))
            <p>--{{$product->pivot->expiration_date}}</p>
            <td><button onclick="location.href='{{ url('UpdateDate/'. $product->pivot->id) }}'"> verander houdbaarheidsdatum 
            </button></td>

            @else
            <td><button onclick="location.href='{{ url('UpdateDate/'. $product->pivot->id) }}'"> voeg houdbaarheidsdatum toe
            </button></td>

        @endif
        
    </div>


    @endforeach


    </div>
    <button class="vertical"> instellingen </button>
    <button class="vertical"> verbinden met account </button>
</body>
</html>