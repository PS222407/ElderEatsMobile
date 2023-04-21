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

  <div class=" mx-36">
    @include('layouts.sidenav')

  <div class=" flex items-center pb-5">
    <p>apparaat:</p>
  @php
  $i = 0;
  @endphp
  <form action="/" method="get" name="FormM"> 
    <select class="" name="ConnectionNumber"  onchange="this.form.submit()" > 
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
  </div>

  <div>
    <div class=" h-96 overflow-scroll flex-auto">
    
    @foreach ($products as $product)
    <div class=" relative flex">
      <div class="flex">
          <p>{{$product->name}}</p>
             

            
      </div>
      <p class=" absolute right-7">--{{$product->pivot->expiration_date}}</p>
      <div class=" absolute right-0">
        <img class=" w-6" src = "{{asset('svg/pencil.svg');}}" alt="bewerken" onclick="location.href='{{ url('UpdateDate/'. $product->pivot->id.'/'.$accountIndex )}}'"/>
      </div>
      
    </div>
    <div class=" pb-2">
    <hr class=" h-1 dark:bg-gray-700">
    </div>
    @endforeach


    </div>

    <td><button class=" w-30 outline outline-1 outline-green-900 bg-green-800 text-white p-1" onclick="location.href='{{ url('Connect') }}'"> verbinden met account
    </button></td>
    <td><button onclick="location.href='{{ url('logout')}}'"> loguit
    </button></td>
    <td><button onclick="location.href='{{ url('shoppingList/'. $accountIndex )}}'"> boodschappen lijst
    </button></td>
    
  </div>
    </div>
</body>
</html>