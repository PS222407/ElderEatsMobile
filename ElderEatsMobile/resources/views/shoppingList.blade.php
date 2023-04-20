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
        
        .flex-container > div {
            flex: 1 0 21%;
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

    <h1>BoodschappenLijst</h1>
    <p>product gekocht? vergeet niet af te vinken.</p>

    <div class="flex-container">
    
    @foreach ($products as $product)
    <div>
        @if (isset($product->image))

        @endif
        <h5>{{$product->name}}</h3>

        
    </div>


    @endforeach


    </div>
</body>
</html>