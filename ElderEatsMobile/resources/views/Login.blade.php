<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connect</title>
</head>
<body>
    
    <form method="POST" action="{{route('LoginWait')}}" accept-charset="UTF-8">
        {{ csrf_field() }}
        <input type="text" name="Code"/>
        <button type="submit"> submit </button>

    </form>

</body>
</html>