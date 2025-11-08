<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'customer_name',
        'email',
        'amount',
        'status',
        'payment_proof',
    ];
}
