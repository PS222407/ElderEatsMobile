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
            <td><button onclick="location.href='{{ url('UpdateDate/'. $product->pivot->id.'/'.$accountIndex )}}'"> verander houdbaarheidsdatum 
            </button></td>

            @else
            <td><button onclick="location.href='{{ url('UpdateDate/'. $product->pivot->id.'/'.$accountIndex )}}'"> voeg houdbaarheidsdatum toe
            </button></td>

        @endif
        
    </div>


    @endforeach


    </div>
    <button class="vertical"> instellingen </button>
    <td><button onclick="location.href='{{ url('Connect') }}'"> verbinden met account
    </button></td>
    @php
    $i = 0;
    @endphp
    <form action="/" method="get" name="FormM"> 
      <select name="ConnectionNumber"  onchange="this.form.submit()" > 
              @foreach ($accounts as $account) 
              <option value="{{$i}}" 

          

                @if($account->id == $selectedAccount->id)
                 selected
               @endif
>
            @if (isset($account->name))
              {{$i+1 .': '.$account->name}}
            @else
              {{$i+1}}
            @endif
          </option>
          {{$i++;}}
            @endforeach     
      </select>
    </form>
</body>
</html>