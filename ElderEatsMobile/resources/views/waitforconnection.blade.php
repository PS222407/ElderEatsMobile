@extends('layouts.bas')

@section('content')
    <h1>wachten tot verbinding is goedgekeurd</h1>
    <script>
        const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;

        function Data() {
            fetch(`{{ url('waitForConnection/' . $accountID) }}`, {
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
            console.log(JSON.stringify(response));
            if (response.pivot.status == 0) {
                location.href = '{{ url('/') }}';
            }
            if (response.pivot.status == 1) {

                console.log(':)');

                setTimeout(function() {
                    Data();
                }, 1000);
            }
            if (response.pivot.status == 2) {
                location.href = '{{ url('/Connectionfailed') }}';
            }
            //if(response.pivot.updated_at )
        }
        Data();
    </script>
@endsection
