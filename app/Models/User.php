<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\ConnectionStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Account;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;




class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function Connections()
    {
        return $this->belongsToMany(Account::class, 'account_users')->withPivot('status')->where('status', '=', '0');
    }

    public function accounts(): BelongsToMany
    {
        return $this->belongsToMany(Account::class, 'account_users');
    }
    public function connectedAccounts(): BelongsToMany
    {
        return $this->belongsToMany(Account::class, 'account_users')->wherePivot('status', ConnectionStatus::CONNECTED)->withTimestamps();
    }
    public function GetConnections(): BelongsToMany
    {
        return $this->belongsToMany(Account::class, 'account_users')->withPivot('status', 'updated_at');
    }
    // return $this->belongsToMany(Product::class, 'account_products')->withPivot('expiration_date','id')->where('account_products.id' ,'=', $productID)->first();
}
