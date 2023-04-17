<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Models\Account; 
use App\Models\AccountUser; 
use App\Models\User; 
use App\Models\Product; 
use App\Models\Account_users; 
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
        /*$ExpireDate
        //$accountUsers = Auth::user()->ConnectionInProcess;
        $AccountUserConnection 
        if($AccountUserConnection->status == 1){
            Return view('LoginWait');
        }else if($AccountUserConnection->status == 0){
            Return view('LoginSuccesfull');
        }else {
            Return view('LoginFailed');
        }
        */
        $User = Auth::user();

        //dd($User);

        $Code = $request->Code;
        
        $Account = Account::where('temporary_token','=',$Code)->get();

//        'account_id','user_id','status',

        $Account_users = new Account_users;

        $Account_users->account_id = $Account[0]->id;
        $Account_users->user_id = $User->id;
        $Account_users->status = 1;
        $Account_users->save();
        dd($Account);
      }
}
