<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class account_products extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'account_id', 'product_id', 'expiration_date',

    ];
}
