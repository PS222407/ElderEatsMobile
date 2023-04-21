@extends('layouts.bas')

@section('content')
    <form method="POST" action="{{ route('requestConnection') }}" accept-charset="UTF-8">
        {{ csrf_field() }}
        <input type="text" id="Code" name="Code"/>
        <button type="submit"> Verstuur</button>
        <main>
            <div id="reader"></div>
        </main>
    </form>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5-qrcode/2.3.4/html5-qrcode.min.js"
            integrity="sha512-k/KAe4Yff9EUdYI5/IAHlwUswqeipP+Cp5qnrsUjTPCgl51La2/JhyyjNciztD7mWNKLSXci48m7cctATKfLlQ=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script defer>
        const scanner = new Html5QrcodeScanner('reader', {
            // Scanner will be initialized in DOM inside element with id of 'reader'
            qrbox: {
                width: 250,
                height: 250,
            }, // Sets dimensions of scanning box (set relative to reader element width)
            fps: 20, // Frames per second to attempt a scan
        });
        scanner.render(success, error);

        // Starts scanner
        function success(result) {
            document.getElementById('Code').value = `${result}`
            // Prints result as a link inside result element
            scanner.clear();
            // Clears scanning instance
            document.getElementById('reader').remove();
            // Removes reader element from DOM since no longer needed
        }

        function error(err) {
            console.error(err);
            // Prints any errors to the console
        }
    </script>
@endsection
