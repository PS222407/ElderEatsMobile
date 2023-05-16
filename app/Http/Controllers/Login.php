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

use function PHPUnit\Framework\isNull;

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

        if (App::environment('production')) {
            Http::post(config('app.tablet_domain') . '/api/v1/account-connection', [
                'account_token' => $account->token,
            ]);
        }

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
    { //session()->regenerate();
        $ConnectionNumber = $request->input('ConnectionNumber', -1);
        if ($ConnectionNumber >= 0) {
            ///dd('test');
            Session::put(['AccountIndex' => $ConnectionNumber]);
        } else {
            //if (!isNull(Session::get('AccountIndex'))) {
            if (Session::exists('AccountIndex')) {
                $ConnectionNumber = Session::get('AccountIndex');
            } else {
                $ConnectionNumber = 0;
            }
        }
        //session()->save();
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
