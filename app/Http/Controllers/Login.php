<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\Account_users;
use App\Enums\ConnectionStatus;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class Login extends Controller
{
    public function RequestConnection(Request $request)
    {
        $account = Account::where('temporary_token', $request->Code)->where('temporary_token_expires_at', '>=', now())->first();

        if (!$account) {
            return view('tokendoesnotexist');
        }

        Account_users::updateOrCreate([
            'user_id' => Auth::id(),
            'account_id' => $account->id,
        ], [
            'status' => ConnectionStatus::IN_PROCESS,
        ]);

        // dd('help', $account->token, config('app.tablet_domain') . '/api/v1/account-connection');
        $ar = ['account_token' => $account->token];
        $json = json_encode($ar);
        $response = Http::withoutVerifying()->post(config('app.tablet_domain'). '/api/v1/account-connection', $json);

        dd($response->json(), $response, $account, config('app.tablet_domain'). '/api/v1/account-connection');

        return view('waitforconnection', ['accountID' => $account->id]);
    }

    public function waitForResponse(int $accountID)
    {
        $User = Auth::user();
        $Account_users = $User->GetConnections()->where([['account_id', $accountID], ['user_id', $User->id]])->first();

        $data = $Account_users;
        return response()->json($data);
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
        $Connection = $request->input('ConnectionNumber', -1);
        $ConnectionNumber = (int) $Connection;

        if(is_null($ConnectionNumber)) {
            $ConnectionNumber=-1;
        }
        if ($ConnectionNumber >= 0) {
            Session::put(['AccountIndex' => $ConnectionNumber]);
        } else {
            if (Session::exists('AccountIndex')) {
                $ConnectionNumber = Session::get('AccountIndex');
            } else {
                $ConnectionNumber = 0;
            }
        }
        Session::save();
        $User = Auth::user();
        if (count($User->Connections) > 0) {
            if (count($User->Connections) < $ConnectionNumber) {
                Session::put(['AccountIndex' => 0]);
                $ConnectionNumber = 0;
            }
            $Account = $User->Connections[$ConnectionNumber];
            return view('menu', ['accounts' => $User->Connections, 'selectedAccount' => $Account, 'accountIndex' => $ConnectionNumber]);
        }
        return view('noAccountConnection');
    }
}
