<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use App\Models\Product; 


class ProductList extends Controller
{
    public function LoadProducts(Request $request){
    
    $ConnectionNumber = $request->input('ConnectionNumber', 0);
    $User = Auth::user();
    $Code = $request->Code;  
    if (count($User->Connections) > 0){
    $Account = $User->Connections[$ConnectionNumber];
    $products = $Account->GetProducts;

    //dd($products);
    
    return view('storedProducts', ['products' => $products,'accounts' => $User->Connections , 'selectedAccount' => $Account, 'accountIndex'=> $ConnectionNumber]);

    }else{
        return view("noAccountConnection");
    }
        }


    public function updateDate(Request $request, int $productID, int $accountIndex)
    {
        $ConnectionNumber = $request->input('ConnectionNumber', 0);
        $User = Auth::user();
        $Code = $request->Code;  
        if (count($User->Connections) > 0){
        $Account = $User->Connections[$accountIndex];
        return view('editProduct', ['product' => $Account->GetProductsById($productID),'accountIndex' => $accountIndex]);
        //dd($Account->GetProductsById($productID));
        }
    }
    public function UpdateDatePost(Request $request, int $productID, int $accountIndex)
    {
        $Date = $request->input('datetime');
        $User = Auth::user();
        $Code = $request->Code;  
        if (count($User->Connections) > 0){
        $Account = $User->Connections[$accountIndex];
        $product = $Account->GetProductsById($productID);
        //dd($product);
        $product->pivot->expiration_date =$Date;
        $product->pivot->save();

        return redirect('/?ConnectionNumber='.$accountIndex);
    }

}
}
