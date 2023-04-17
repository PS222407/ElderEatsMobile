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
          width: 1300px;
          overflow: auto;
          float: left;
        }
        
        .flex-container > div {
          background-color: #f1f1f1;
          margin: 10px;
          padding: 20px;
          font-size: 30px;
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
        @endif
    </div>
    @endforeach


    </div>
    <div class="vertical"> yrytrtyrytrtyrtyrytrtyrytrtyr </div>
</body>
</html>