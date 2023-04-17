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
    $Account = $User->Connections[$ConnectionNumber];
    $products = $Account->GetProducts;
    //dd($products);
    
    return view('storedProducts', ['products' => $products]);
    }
}
