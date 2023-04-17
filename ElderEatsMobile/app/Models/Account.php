<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product; 
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Account; 
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Account_Products; 

class Account extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'token',
        'temporary_token',
        'temporary_token_expires_at',
    ];

    public function GetCurrentProducts()
    {
        //return $this->belongsToMany(Account_Products::class, 'account_products');
        //return Account_Products::where('account_id', $this->id)->get();
    }
}
