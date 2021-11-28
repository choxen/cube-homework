<?php

namespace App\Rules;

use App\Models\Order;
use Illuminate\Contracts\Validation\Rule;

class OrderExists implements Rule
{
    public function passes($attribute, $value): bool
    {
        $order = Order::find($value);
        if ($order) {
            return true;
        }
        return false;
    }

    public function message(): string
    {
        return 'This order does not exist.';
    }
}
