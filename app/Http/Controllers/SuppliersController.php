<?php

namespace App\Http\Controllers;


use App\Services\StoreSupplierService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SuppliersController extends Controller
{
    public function store(Request $request, StoreSupplierService $service): JsonResponse
    {
        $this->validate($request, [
            'delivery_code' => 'required',
            'title' => 'required',
            'address' => 'required',
            'city' => 'required',
            'phone_number' => 'required'
        ]);

        $service->execute($request);

        return response()->json([
            'message' => 'Supplier has been added successfully'
        ], 201);
    }
}
