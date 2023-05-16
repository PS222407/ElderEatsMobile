@extends('layouts.bas')

@section('content')
    <div class="mx-3 mt-8">
        <h1 class="text-2xl text-center font-bold">QR Code scanner</h1>
        <form method="POST" id="requestConnForm" class="mt-4" action="{{ route('requestConnection') }}" accept-charset="UTF-8">
            @csrf
            <div id="reader" class="w-full mx-auto shadow rounded-2xl"></div>

            <p class="italic text-sm text-center">Verbind hier uw telefoon toestel met de inventaris tablet. Dit doe je doormiddel van de QR Code die te vinden is linksboven op de tablet.</p>

            <div class="my-6 flex w-fit mx-auto items-center gap-x-2">
                <div style="width: 50px; height: 1px; background: gray"></div>
                <span>Of</span>
                <div style="width: 50px; height: 1px; background: gray"></div>
            </div>
            <div class="flex flex-col w-fit mx-auto">
                <label for="Code">Code op tablet:</label>
                <div class="flex">
                    <input type="text" id="Code" name="Code"/>
                    <x-primary-button type="submit" class="w-fit rounded-l rounded-r">Verstuur</x-primary-button>
                </div>
            </div>
        </form>
    </div>

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
            document.getElementById('Code').value = `${result}`;
            document.getElementById('requestConnForm').submit();
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

    <script>
        document.getElementById('html5-qrcode-button-camera-permission').innerText = 'Start scanner';
    </script>
@endsection
