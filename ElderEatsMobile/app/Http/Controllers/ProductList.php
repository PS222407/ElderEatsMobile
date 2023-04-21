<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;


class ProductList extends Controller
{

    public function LoadProducts(Request $request, int $ConnectionNumber)
    {
        $User = Auth::user();
        if (count($User->Connections) > 0) {
            if ($ConnectionNumber < count($User->Connections)) {
                $Account = $User->Connections[$ConnectionNumber];
                $products = $Account->GetProducts;

                //dd($products);

                return view('storedProducts', ['products' => $products, 'accounts' => $User->Connections, 'selectedAccount' => $Account, 'accountIndex' => $ConnectionNumber]);
            } else {
                //TODO: error connection nummer to high
            }
        } else {
            return view("noAccountConnection");
        }
    }


    public function updateDate(Request $request, int $productID, int $accountIndex)
    {
        $ConnectionNumber = $request->input('ConnectionNumber', 0);
        $User = Auth::user();
        $Code = $request->Code;
        if (count($User->Connections) > 0) {
            $Account = $User->Connections[$accountIndex];
            return view('editProduct', ['product' => $Account->GetProductsById($productID), 'accountIndex' => $accountIndex]);
            //dd($Account->GetProductsById($productID));
        }
    }
    public function UpdateDatePost(Request $request, int $productID, int $accountIndex)
    {
        $Date = $request->input('datetime');
        $User = Auth::user();
        $Code = $request->Code;
        if (count($User->Connections) > 0) {
            $Account = $User->Connections[$accountIndex];
            $product = $Account->GetProductsById($productID);
            //dd($product);
            $product->pivot->expiration_date = $Date;
            $product->pivot->save();

            return redirect('/?ConnectionNumber=' . $accountIndex);
        }
    }

    public function GetShoppingList(Request $request, int $accountIndex)
    {
        $User = Auth::user();
        if ($accountIndex > count($User->Connections)) {
            $Account = $User->Connections[0];
        } else {
            $Account = $User->Connections[$accountIndex];
        }
        return view('shoppingList', ['products' => $Account->GetFixedProducts()]);
    }
}
