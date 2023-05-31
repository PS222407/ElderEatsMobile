<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
class Account extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'token',
        'temporary_token',
        'temporary_token_expires_at',
    ];

    public function GetProducts()
    {
        return $this->belongsToMany(Product::class, 'account_products')->withPivot('ran_out_at', 'expiration_date', 'id')->orderBy('expiration_date');
        //return Account_Products::where('account_id', $this->id)->get();
    }
    public function GetProductsById(int $productID)
    {
        return $this->belongsToMany(Product::class, 'account_products')->withPivot('expiration_date', 'id')->where('account_products.id', '=', $productID)->first();
    }

    public function GetFixedProductsById(int $productID)
    {
        return $this->belongsToMany(Product::class, 'fixed_products')->withPivot('is_active', 'id', 'product_id')->where([['product_id', $productID],['account_id', $this->id] ])->first();
    }
    public function GetFixedProducts()
    {
        return $this->belongsToMany(Product::class, 'fixed_products')->where([['is_active', 1], ['account_id', $this->id]])->get();
    }
}
