<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use function PHPUnit\Framework\isNull;

class ProductList extends Controller
{
    public function LoadProducts()
    {

        if(Session::exists('AccountIndex')){
            $accountIndex = Session::get('AccountIndex');
        }else{
            $accountIndex = 0;
        }

        $User = Auth::user();
        if (count($User->Connections) > 0) {
            if ($accountIndex < count($User->Connections)) {
                $Account = $User->Connections[$accountIndex];
                $products = $Account->GetProducts()->wherePivotNull('ran_out_at')->get();

                return view('storedProducts', ['products' => $products, 'accounts' => $User->Connections, 'selectedAccount' => $Account, 'accountIndex' => $accountIndex]);
            } else {
                //TODO: error connection nummer to high
            }
        } else {
            return view("noAccountConnection");
        }
    }

    public function updateDate(int $productID)
    {
        if(Session::exists('AccountIndex')){
            $accountIndex = Session::get('AccountIndex');
        }else{
            $accountIndex = 0;
        }
        $User = Auth::user();
        if (count($User->Connections) > 0) {
            $Account = $User->Connections[$accountIndex];

            return view('editProduct', ['product' => $Account->GetProductsById($productID), 'accountIndex' => $accountIndex]);
        }
    }

    public function UpdateDatePost(Request $request, int $productID)
    {
        if(Session::exists('AccountIndex')){
            $accountIndex = Session::get('AccountIndex');
        }else{
            $accountIndex = 0;
        }
        $Date = $request->input('datetime');
        $User = Auth::user();

        if (count($User->Connections) > 0) {
            $Account = $User->Connections[$accountIndex];
            $product = $Account->GetProductsById($productID);
            $product->pivot->expiration_date = $Date;
            $product->pivot->save();
        }

        return redirect()->route('ProductList');
    }

    public function GetShoppingList()
    {

        if(Session::exists('AccountIndex')){
            $accountIndex = Session::get('AccountIndex');
        }else{
            $accountIndex = 0;
        }



        $User = Auth::user();
        if ($accountIndex > count($User->Connections)) {
            $Account = $User->Connections[0];
        } else {
            $Account = $User->Connections[$accountIndex];
        }

        return view('shoppingList', ['products' => $Account->GetFixedProducts(), 'accountIndex' => $accountIndex]);
    }

    public function UpdateShoppingList(Request $request)
    {

        if(Session::exists('AccountIndex')){
            $accountIndex = Session::get('AccountIndex');
        }else{
            $accountIndex = 0;
        }
        //dd($request->all());
        $User = Auth::user();
        if ($accountIndex > count($User->Connections)) {
            $Account = $User->Connections[0];
        } else {
            $Account = $User->Connections[$accountIndex];
        }
        $data = $request->all();

        foreach ($data as $k => $v) {

            $product = $Account->GetFixedProductsById($k);
            $product->pivot->is_active = $v;
            $product->pivot->save();
        }
        return $data;
    }
}
