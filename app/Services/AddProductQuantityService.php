<?php

namespace App\Services;

use App\Models\Product;

class AddProductQuantityService
{
    public function execute(int $productId, int $quantity)
    {
        $product = Product::find($productId);
        $product->quantity += $quantity;
        $product->save();
    }
}
