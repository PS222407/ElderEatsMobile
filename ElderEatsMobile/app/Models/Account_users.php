<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account_users extends Model
{
    use HasFactory;

    protected $fillable = [
        'id','account_id','user_id','status',
        
    ];
}
