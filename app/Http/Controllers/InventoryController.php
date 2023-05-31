<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use function PHPUnit\Framework\isNan;
use function PHPUnit\Framework\isNull;

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

                return view('storedProducts', ['products' => $products, 'accounts' => $User->Connections, 'selectedAccount' => $Account, 'accountIndex' => $accountIndex]);
            }
        //TODO: error connection nummer to high
        } else {
            return view('noAccountConnection');
        }
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

            if(!is_null($Account->GetProductsById($productID))){
            return view('editProduct', ['product' => $Account->GetProductsById($productID), 'accountIndex' => $accountIndex]);
            }else{
                return view('Productdoesnotexist');
            }
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
            $product = $Account->GetProductsById($productID);
            $product->pivot->expiration_date = $request->datetime;
            $product->pivot->save();
        }

        return redirect()->route('inventory.index');
    }
}
