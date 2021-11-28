<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barcode extends Model
{
    use HasFactory;

    protected $table = 'barcode';

    protected $fillable = [
        'barcode',
        'description',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
