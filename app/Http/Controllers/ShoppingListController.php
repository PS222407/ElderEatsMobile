<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ShoppingListController extends Controller
{
    public function index()
    {
        if (Session::exists('AccountIndex')) {
            $accountIndex = Session::get('AccountIndex');
        } else {
            $accountIndex = 0;
        }

        $User = Auth::user();
        if ($accountIndex > count($User->Connections)) {
            $Account = $User->Connections[0];
        } else {
            $Account = $User->Connections[$accountIndex];
        }

        return view('shoppingList', [
            'products' => $Account->GetFixedProducts(),
            'accountIndex' => $accountIndex,
        ]);
    }

    public function update(Request $request)
    {
        if (Session::exists('AccountIndex')) {
            $accountIndex = Session::get('AccountIndex');
        } else {
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
