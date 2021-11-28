<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category',
        'title',
        'price',
        'discount',
        'delivery_code',
        'product_dimensions',
        'status',
        'quantity',
    ];

    protected $dates = [
        'updated_at'
    ];

    public function barcode()
    {
        return $this->hasMany(Barcode::class);
    }
}
