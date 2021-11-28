<?php

namespace App\Services;

use App\Models\Order;

class ChangeOrderStatusService
{
    public function execute(int $orderId, string $status)
    {
        $order = Order::find($orderId);

        $order->status = $status;
        $order->save();
    }
}
