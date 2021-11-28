<?php

namespace App\Http\Controllers;

use App\Models\Barcode;
use App\Models\Product;
use App\Rules\ProductExists;
use App\Services\AddProductQuantityService;
use App\Services\StoreProductService;
use App\Services\RemoveProductQuantityService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function store(Request $request, StoreProductService $service)
    {
        $this->validate($request, [
            'products' => 'required|array|min:1',
            'products.*.category' => 'required',
            'products.*.title' => 'required',
            'products.*.price' => 'required',
            'products.*.discount' => 'required',
            'products.*.delivery_code' => 'required',
            'products.*.product_dimensions' => 'required',
            'products.*.status' => 'required',
            'products.*.quantity' => 'required',
            'products.*.barcodes' => 'required|array',
            'products.*.barcodes.*.barcode' => 'required',
            'products.*.barcodes.*.description' => 'required',
        ]);

        $service->execute($request);

        return response()->json([
            'message' => 'Product was added successfully'
        ], 201);
    }

    public function show(Request $request): JsonResponse
    {
        $request->validate([
            'product_id' => [
                'required',
                new ProductExists()
            ]
        ]);

        $productId = $request->get('product_id');

        $product = Product::with('barcode')->where('id', $productId)->get();

        return response()->json([
            'product' => $product,
        ]);
    }

    public function addQuantity(Request $request, AddProductQuantityService $service): JsonResponse
    {
        $request->validate([
            'product_id' => [
                'required',
                new ProductExists(),
            ],
            'quantity' => 'required',
        ]);

        $service->execute(
            $request->get('product_id'),
            $request->get('quantity')
        );

        return response()->json([
            'message' => 'Product quantity has been updated successfully'
        ]);
    }

    public function removeQuantity(Request $request, RemoveProductQuantityService $service): JsonResponse
    {
        $request->validate([
            'product_id' => [
                'required',
                new ProductExists()
            ],
            'quantity' => [
                'required',
            ],
        ]);

        $service->execute(
            $request->get('product_id'),
            $request->get('quantity')
        );

        return response()->json([
            'message' => 'Product quantity has been updated successfully'
        ]);
    }
}
