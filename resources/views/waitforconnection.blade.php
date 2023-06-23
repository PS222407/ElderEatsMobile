@extends('layouts.bas')

@section('content')
    <h1>wachten tot verbinding is goedgekeurd</h1>
    <script>
        const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;

        function Data() {
            fetch(`{{ route('login.wait-for-response', $accountID) }}`, {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        "X-CSRF-Token": csrfToken
                    },
                })
                .then(response => response.json())
                .then(response => Process(response))
        }

        function Process(response) {
            //console.log(JSON.stringify(response));
            if (response.pivot.status == 0) {
                location.href = '/';
            }
            else if (response.pivot.status == 2) {
                location.href = '{{ route('connection-failed') }}';
            }else{
                setTimeout(function() {
                    Data();
                }, 1000);
            }
            //if(response.pivot.updated_at )
        }
        Data();
    </script>
@endsection
