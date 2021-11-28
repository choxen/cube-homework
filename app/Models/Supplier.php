<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = [
        'delivery_code',
        'title',
        'address',
        'city',
        'full_name',
        'phone_number'
    ];
}
