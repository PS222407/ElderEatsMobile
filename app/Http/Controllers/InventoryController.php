<?php

namespace App\Http\Controllers;

use App\Models\account_products;
use App\Models\AccountProducts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;

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
        if (count($User->Connections) > 0) {
            if ($accountIndex < count($User->Connections)) {
                $Account = $User->Connections[$accountIndex];
                $products = $Account->GetProducts()->wherePivotNull('ran_out_at')->get();

                return view('storedProducts', [
                    'products' => $products,
                    'accounts' => $User->Connections,
                    'selectedAccount' => $Account,
                    'accountIndex' => $accountIndex,
                ]);
            }
            // TODO: error connection nummer to high
        }

        return view('noAccountConnection');
    }

    public function edit(int $productID)
    {
        if (Session::exists('AccountIndex')) {
            $accountIndex = Session::get('AccountIndex');
        } else {
            $accountIndex = 0;
        }
        $User = Auth::user();
        if (count($User->Connections) > 0) {
            $Account = $User->Connections[$accountIndex];

            if (!is_null($Account->GetProductsByConnectionId($productID))) {
                return view('editProduct', ['product' => $Account->GetProductsByConnectionId($productID), 'accountIndex' => $accountIndex]);
            }

            return view('Productdoesnotexist');
        }
    }

    public function update(Request $request, int $productID)
    {
        $request->validate([
            'datetime' => ['nullable', 'date', 'max:10'],
        ]);

        if (Session::exists('AccountIndex')) {
            $accountIndex = Session::get('AccountIndex');
        } else {
            $accountIndex = 0;
        }

        $User = Auth::user();

        if (count($User->Connections) > 0) {
            $Account = $User->Connections[$accountIndex];
            $product = $Account->GetProductsByConnectionId($productID);
            $product->pivot->expiration_date = $request->datetime;
            $product->pivot->save();
        }

        return redirect()->route('inventory.index');
    }

    public function storeImagePage(int $productID)
    {
        if (Session::exists('AccountIndex')) {
            $accountIndex = Session::get('AccountIndex');
        } else {
            $accountIndex = 0;
        }
        $User = Auth::user();
        if (count($User->Connections) > 0) {
            $Account = $User->Connections[$accountIndex];

            if (!is_null(Product::find($productID))) {
                return view('AddImage', ['productID' => $productID]);
            }

            return view('Productdoesnotexist');
        }
    }

    public function storeImage(Request $request, int $productID)
    {
        $validated = $request->validate([
            'image' => 'required|image|mimes:png,jpg,jpeg,webp|max:8192|min:0'
        ]);

        //dd($validated);

        $imageName = time();

        if (app()->environment('local')) {
            $path = 'storage/';
        } else {
            $path = 'https://eldereatsmobile.jensramakers.nl/storage/';
        }

        $path = $path . Storage::disk('public')->put($imageName, $request->image);

        //$path = 'storage/'. $imageName.'/'. $request->image;
        $User = Auth::user();
        if (count($User->Connections) > 0) {
            if (!is_null(Product::find($productID))) {
                $product = Product::find($productID);
                $product->image = $path;
                $product->save();

                return redirect()->route('inventory.index');
            }

            return view('Productdoesnotexist');
        }

        //return 'e3';
        return back()->with('success', 'Image uploaded Successfully!')
            ->with('image', $imageName);
    }

    public function destroy(int $pivotId)
    {
        account_products::where('id', $pivotId)->update([
            'ran_out_at' => now(),
        ]);

        return redirect()->route('inventory.index');
    }
}
