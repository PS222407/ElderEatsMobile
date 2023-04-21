<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>bewerk datum</title>
</head>

<body>

    <h1>{{ $product->pivot->id }}</h1>

    <form method="POST" action="{{ url('UpdateDatePost/' . $product->pivot->id . '/' . $accountIndex) }}"
        accept-charset="UTF-8">
        {{ csrf_field() }}
        <input type="date" name="datetime"><br>
        <button type="submit"> Verstuur </button>
    </form>
</body>

</html>
