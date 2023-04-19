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
      
      public function waitForResponse(Request $request){

        $User = Auth::user();

        $Code = $request->Code;
        
        $Account = Account::where('temporary_token','=',$Code)->where('temporary_token_expires_at', '>', \DB::raw('NOW()'))->get();

        if(count($Account) > 0){
        $Account_users = new Account_users;

        $Account_users->account_id = $Account[0]->id;
        $Account_users->user_id = $User->id;
        $Account_users->status = ConnectionStatus::IN_PROCESS;
        $Account_users->save();
        }else{
            return view('tokendoesnotexist');
        }

        //TODO: api call naar jens api voor account verbinden
        return redirect('/');
      }
}
