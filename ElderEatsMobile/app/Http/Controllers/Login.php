<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Models\Account;
use App\Models\Account_users;
use App\Enums\ConnectionStatus;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;


class Login extends Controller
{
    public function RequestConnection(Request $request)
    {
        $account = Account::where('temporary_token', $request->Code)->where('temporary_token_expires_at', '>=', now())->first();

        if (!$account) {
            return view('tokendoesnotexist');
        }

        Account_users::updateOrCreate([
            'status' => ConnectionStatus::INACTIVE,
            'user_id' => Auth::id(),
            'account_id' => $account->id,
        ], [
            'status' => ConnectionStatus::IN_PROCESS,
        ]);

        Http::post(config('app.tablet_domain') . '/api/v1/account-connection', [
            'account_token' => $account->token,
        ]);

        return view('waitforconnection', ['accountID' => $account->id]);
    }

    public function waitForResponse(Request $request, int $accountID)
    {
        //    'id','account_id','user_id','status',
        $User = Auth::user();
        $Account = Account::where('id', '=', $accountID)->first();
        $Account_users = $User->GetConnections()->where([['account_id', $accountID], ['user_id', $User->id]])->first();

        //$connection = Account::where('id', '=', $accountID
        $data = $Account_users;
        //$connection
        return response()->json($data, 200);
    }

    public function LogoutUser(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function LoadMenu(Request $request)
    {
        $ConnectionNumber = $request->input('ConnectionNumber', 0);
        $User = Auth::user();
        if (count($User->Connections) > 0) {
            $Account = $User->Connections[$ConnectionNumber];

            return view('menu', ['accounts' => $User->Connections, 'selectedAccount' => $Account, 'accountIndex' => $ConnectionNumber]);
        } else {
            return view("noAccountConnection");
        }
    }
}
