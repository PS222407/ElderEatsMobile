<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Account;


class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'barcode ',
    ];

    public function accounts()
    {
        return $this->belongsToMany(Account::class, 'account_products');
    }
    public function GetFixedProducts(int $AccountID){

    }
}
