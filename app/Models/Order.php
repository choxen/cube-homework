<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number',
        'price',
        'delivery_price',
        'status',
        'client',
        'order',
        'payment_method',
        'product_id',
        'product_quantity',
    ];

    public function getClientAttribute($value)
    {
        return unserialize($value);
    }

    public function getOrderAttribute($value)
    {
        return unserialize($value);
    }

    public function getPaymentMethodAttribute($value)
    {
        return unserialize($value);
    }
}
