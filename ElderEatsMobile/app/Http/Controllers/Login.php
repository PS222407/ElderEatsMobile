<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Models\Account;
use App\Models\AccountUser;
use App\Models\User;
use App\Models\Product;
use App\Models\Account_users;
use App\Enums\ConnectionStatus;
use Illuminate\Support\Facades\Auth;


class Login extends Controller
{
    public function SendCode(Request $request)
    {
        /* $code = $request->input('code', 'null');

        if($code != 'null'){
            
            $Results = Accounts::where('temporary_token',$code)->where('temporary_token_expires_at', '<', \DB::raw('NOW()'));

            if(count($Results) == 0){
                //result not found
            }else if{count($Results) > 1}{
                //error more then one device found
            }else{
                $accountUser = new AccountUser
                $accountUser->status = 1;
            }

        }*/
    }

    public function RequestConnection(Request $request)
    {

        $User = Auth::user();

        $Code = $request->Code;

        $Account = Account::where('temporary_token', '=', $Code)->where('temporary_token_expires_at', '>', \DB::raw('NOW()'))->get();

        //dd(count($User->GetConnections($Account[0]->id)));
        if (count($Account) > 0) {
            if (!$User->GetConnections()->where([['account_id', $Account[0]->id], ['user_id', $User->id]])->first()) {
                $Account_users = new Account_users;

                $Account_users->account_id = $Account[0]->id;
                $Account_users->user_id = $User->id;
                $Account_users->status = ConnectionStatus::IN_PROCESS;
                $Account_users->save();
            } else {
                $Account_users = $User->GetConnections()->where([['account_id', $Account[0]->id], ['user_id', $User->id]])->first();
                $Account_users->pivot->status = ConnectionStatus::IN_PROCESS;
                $Account_users->pivot->updated_at = \DB::raw('NOW()');
                $Account_users->pivot->save();
                //dd($Account_users->toArray());
            }
            /*Http::post('localhost:8000/api/v1/account-connection', [
            'account_user' => $Account[0]->token,
        ]);*/
        } else {
            return view('tokendoesnotexist');
        }

        //dd($Account);
        //TODO: api call naar jens api voor account verbinden
        return view('waitforconnection', ['accountID' => $Account[0]->id]);
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

    public function LoadMenu(Request $request){

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
