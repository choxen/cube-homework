<?php

namespace App\Services;

use App\Models\Product;

class RemoveProductQuantityService
{
    public function execute(int $productId, int $quantity)
    {
        $product = Product::find($productId);

        $product->quantity -= $quantity;

        if ($product->quantity <= 0) {
            $product->quantity = 0;
            $product->status = "Out of Stock";
        }

        $product->save();
    }
}
