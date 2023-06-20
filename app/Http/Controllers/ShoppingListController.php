<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class ShoppingListController extends Controller
{
    public function index()
    {
        $User = Auth::user();

        if (Session::exists('AccountIndex')) {
            $accountIndex = Session::get('AccountIndex');
        } else {
            $accountIndex = 0;
        }
        
        $UserConnections = Http::withoutVerifying()->withHeaders(['x-api-key' => $User->token])->get(config('app.api_base_url'). "/User/" . $User->id . "/Accounts/Active")->json();
       
        if($UserConnections == null){
            return view('noAccountConnection');
        }
       
        if ($accountIndex > count($UserConnections)) {
            $Account = $UserConnections[0];
        } else {
            $Account = $UserConnections[$accountIndex];
        }
        $test = json_decode(json_encode($Account));

        $fixedProducts = json_decode(json_encode(Http::withoutVerifying()->withHeaders(['x-api-key' => $User->token])->get(config('app.api_base_url'). "/Accounts/".$test->id."/FixedProducts")->json())); 

        return view('shoppingList', [
            'products' =>  $fixedProducts,
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

        $User = Auth::user();
        $UserConnections = Http::withoutVerifying()->withHeaders(['x-api-key' => $User->token])->get(config('app.api_base_url'). "/User/" . $User->id . "/Accounts/Active")->json();
        
        if($UserConnections == null){
            return view('noAccountConnection');
        }

        if ($accountIndex > count($UserConnections)) {
            $Account = $UserConnections[0];
        } else {
            $Account = $UserConnections[$accountIndex];
        }
        $Account = json_decode(json_encode($Account));

        $data = $request->all();

        foreach ($data as $k => $v) {
            $dataobject[$k] = $v;
        }

        $response = Http::withoutVerifying()->withHeaders(['x-api-key' => $User->token])->put(config('app.api_base_url'). "/Accounts/".$Account->id."/Fixedproducts/Update", 
        json_encode($dataobject)
        );
        dd($response->json());
        return $dataobject;
        
    }
}