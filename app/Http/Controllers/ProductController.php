<?php

namespace App\Http\Controllers;

use App\Services\AddProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function store(Request $request, AddProductService $service)
    {
        $this->validate($request, [
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
}
