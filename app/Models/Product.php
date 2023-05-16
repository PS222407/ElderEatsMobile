<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
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
    protected function fullName(): Attribute
    {
        return Attribute::make(
            get: fn() => implode(' - ', array_filter([$this->name, $this->brand, $this->quantity_in_package])),
        );
    }
}