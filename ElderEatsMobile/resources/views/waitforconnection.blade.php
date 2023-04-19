<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Wachten</title>
</head>
<body>
    <script>
        const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;

        function Data(){
            fetch(`{{url('waitForConnection/'. $accountID)}}` , {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                "X-CSRF-Token": csrfToken
            },
            body: JSON.stringify({ "id": 78912 })
        })
        .then(response => response.json())
        .then(response => Process(response))
        }

        function Process(response){

        }
        Data();
    </script>
</body>
</html>