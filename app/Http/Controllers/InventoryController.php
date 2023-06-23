<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class InventoryController extends Controller
{
    public function index()
    {
        if (Session::exists('AccountIndex')) {
            $accountIndex = Session::get('AccountIndex');
        } else {
            $accountIndex = 0;
        }

        $User = Auth::user();
        $UserConnections = Http::withoutVerifying()->withHeaders(['x-api-key' => $User->token])->get(config('app.api_base_url') . '/User/' . $User->id . '/Accounts/Active')->json();
        if($UserConnections == null) {
            return view('noAccountConnection');
        }
        if ($accountIndex > count($UserConnections)) {
            $Account = $UserConnections[0];
        } else {
            $Account = $UserConnections[$accountIndex];
        }
        $Account = json_decode(json_encode($Account));

        $products = Http::withoutVerifying()->withHeaders(['x-api-key' => $User->token])->get(config('app.api_base_url') . '/Accounts/' . $Account->id . '/Products')->json();

        $products = json_decode(json_encode($products));

        foreach ($products as $product) {
            if ($product->expirationDate != null) {
                $product->expirationDate = Carbon::parse($product->expirationDate)->format('Y-m-d');
            }
        }
        //dd($products);
        return view('storedProducts', [
            'products' => $products,
            'accounts' => $User->Connections,
            'selectedAccount' => $Account,
            'accountIndex' => $accountIndex,
        ]);
    }

    public function edit($productID)
    {
        if (Session::exists('AccountIndex')) {
            $accountIndex = Session::get('AccountIndex');
        } else {
            $accountIndex = 0;
        }
        $User = Auth::user();
        $UserConnections = Http::withoutVerifying()->withHeaders(['x-api-key' => $User->token])->get(config('app.api_base_url') . '/User/' . $User->id . '/Accounts/Active')->json();
        if($UserConnections == null) {
            return view('noAccountConnection');
        }
        if (count($UserConnections) > 0) {
            if ($accountIndex > count($UserConnections)) {
                $Account = $UserConnections[0];
            } else {
                $Account = $UserConnections[$accountIndex];
            }
            $Account = json_decode(json_encode($Account));
            $Product = Http::withoutVerifying()->withHeaders(['x-api-key' => $User->token])->get(config('app.api_base_url') . '/Products/Product/Connection/' . $productID . '/withConnection')->json();

            $Product = json_decode(json_encode($Product));

            if (!property_exists($Product, 'errors') && !property_exists($Product, 'status')) {
                if ($Product->expirationDate != null) {
                    $Product->expirationDate = Carbon::parse($Product->expirationDate)->format('Y-m-d');
                }

                if (!is_null($Product)) {
                    return view('editProduct', ['product' => $Product, 'accountIndex' => $accountIndex]);
                }
            }

            return view('Productdoesnotexist');
        }
    }

    public function update(Request $request, $productID)
    {
        $request->validate([
            'datetime' => ['nullable', 'date', 'max:10'],
        ]);
        $User = Auth::user();
        $ar = ['expirationDate' => $request->datetime];
        $json = json_encode($ar);

        $response = Http::withoutVerifying()->withHeaders(['x-api-key' => $User->token])->put(
            config('app.api_base_url') . '/Products/Account/' . $productID . '/ExpirationDate',
            $json
        );

        return redirect()->route('inventory.index');
    }

    public function storeImagePage($productID)
    {
        if (Session::exists('AccountIndex')) {
            $accountIndex = Session::get('AccountIndex');
        } else {
            $accountIndex = 0;
        }
        $User = Auth::user();
        $Product = Http::withoutVerifying()->withHeaders(['x-api-key' => $User->token])->get(config('app.api_base_url') . '/Products/' . $productID)->json();
        $Product = json_decode(json_encode($Product));

        if ($Product != null) {
            if (!property_exists($Product, 'errors') && !property_exists($Product, 'status')) {
                return view('AddImage', ['productID' => $productID]);
            }
        }
        return view('Productdoesnotexist');
    }

    public function storeImage(Request $request, $productID)
    {
        $validated = $request->validate([
            'image' => 'required|image|mimes:png,jpg,jpeg,webp|max:8192|min:0'
        ]);

        $imageName = time();

        if (app()->environment('local')) {
            $path = 'storage/';
        } else {
            $path = 'https://eldereatsmobile.jensramakers.nl/storage/';
        }
        $path = $path . Storage::disk('public')->put($imageName, $request->image);
        $User = Auth::user();
        $Product = Http::withoutVerifying()->withHeaders(['x-api-key' => $User->token])->get(config('app.api_base_url') . '/Products/' . $productID)->json();
        $Product = json_decode(json_encode($Product));
        if (!property_exists($Product, 'status')) {
            $ar = ['id' => $productID, 'image' => $path];
            $json = json_encode($ar);
            $response = Http::withoutVerifying()->withHeaders(['x-api-key' => $User->token])->put(
                config('app.api_base_url') . '/Products/Product/Image',
                $json
            );
            return redirect()->route('inventory.index');
        }
        return view('Productdoesnotexist');
    }

    public function destroy(int $pivotId)
    {
        $User = Auth::user();
        $response = Http::withoutVerifying()->withHeaders(['x-api-key' => $User->token])->put(
            config('app.api_base_url') . '/Accounts/Products/' . $pivotId . '/Ranout',
        );
        return redirect()->route('inventory.index');
    }
}
