<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Models\Account; 
use App\Models\AccountUser; 
use App\Models\User; 
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
       /* $ExpireDate
        $AccountUserConnection 
        if($AccountUserConnection->status == 1){
            Return view('LoginWait');
        }else if($AccountUserConnection->status == 0){
            Return view('LoginSuccesfull');
        }else {
            Return view('LoginFailed');
        }*/
        $User = Auth::user()->ConnectionInProcess;

        dd($User);
      }
}
