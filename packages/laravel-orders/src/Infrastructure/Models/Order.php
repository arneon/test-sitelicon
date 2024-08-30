<?php

namespace Arneon\LaravelOrders\Infrastructure\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $fillable = [
        'user_id',
        'total_amount',
        'currency',
        'payment_status'
    ];
}

