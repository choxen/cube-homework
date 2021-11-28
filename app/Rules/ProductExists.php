<?php

namespace App\Rules;

use App\Models\Product;
use Illuminate\Contracts\Validation\Rule;

class ProductExists implements Rule
{
    public function passes($attribute, $value): bool
    {
        $product = Product::find($value);

        if ($product) {
            return true;
        }
        return false;
    }

    public function message(): string
    {
        return 'This product does not exist.';
    }
}
