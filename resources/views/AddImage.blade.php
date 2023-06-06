@extends('layouts.bas')


@section('content')

    <!-- Container (Contact Section) -->
    <div id="contact" class="container">
        <h1 class="text-2xl text-center font-bold mt-10">Foto toevoegen</h1>
        <p class="text-center italic uppercase text-hamburger w-3/4 mx-auto">product gekocht en heeft deze nog geen foto? u kunt deze zelf toevoegen!</p>
        <p class="text-center text-xs text-hamburger w-3/4 mx-auto">deze foto zal zichtbaar zijn voor andere gebruikers. zorg dat de foto geen persoonlijke informatie bevat</p>

        <form method="POST" action="{{ route('upload-image' , $productID) }}" enctype="multipart/form-data">
            @csrf
            <div class="flex flex-col  content-center">
                <input type="file" class="mx-16 mt-10 form-control" name="image" />
                <br>

                <div class="flex flex-col gap-y-2 mt-3">
                    <button type="submit" class="btn m-2 bg-banner text-white  rounded-full p-1 text-center">Upload</button>
                </div>
            </div>
        </form>
    </div>
@endsection
