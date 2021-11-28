<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Rules\OrderExists;
use App\Services\ChangeOrderStatusService;
use App\Services\StoreOrderService;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(Request $request, StoreOrderService $service): JsonResponse
    {
        $this->validate($request, [
            'orders' => 'required|array',
            'orders.*.order_number' => 'required',
            'orders.*.price' => 'required',
            'orders.*.delivery_price' => 'required',
            'orders.*.status' => 'required',
            'orders.*.client' => 'required',
            'orders.*.client.*.name' => 'required',
            'orders.*.client.*.lastname' => 'required',
            'orders.*.client.*.phone_number' => 'required',
            'orders.*.order' => 'required',
            'orders.*.order.*.delivery_type' => 'required',
            'orders.*.order.*.address' => 'required',
            'orders.*.payment_method' => 'required',
            'orders.*.payment_method.*.method' => 'required',
            'orders.*.payment_method.*.status' => 'required',
            'orders.*.product_id' => 'required',
            'orders.*.product_quantity' => 'required',
        ]);

        $service->execute($request);

        return response()->json([
            'message' => 'Order has been made successfully'
        ], 201);
    }

    public function show(Request $request): JsonResponse
    {
        $request->validate([
            'date' => 'required|string'
        ]);

        $dateString = $request->get('date');

        $date = Carbon::parse($dateString);
        $tomorrow = Carbon::parse($dateString)->addDay();

        $orders = Order::whereBetween('updated_at', [$date->toDateString(), $tomorrow])->get();

        return response()->json([
            $orders
        ]);
    }

    public function updateStatus(Request $request, ChangeOrderStatusService $service): JsonResponse
    {
        $request->validate([
            'order_id' => [
                'required',
                new OrderExists()
            ],
            'status' => 'required'
        ]);

        $orderId = $request->get('order_id');
        $status = $request->get('status');

        $service->execute($orderId, $status);

        return response()->json([
            'message' => 'Order status with ID: ' . $orderId . ' has been updated successfully'
        ]);
    }
}
