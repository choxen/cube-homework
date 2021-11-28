<?php

namespace App\Services;

use App\Models\Supplier;
use App\Models\SupplierData;
use Illuminate\Http\Request;

class StoreSupplierService
{
    public function execute(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        $supplierData = new SupplierData($data);

        Supplier::create([
            'delivery_code' => $supplierData->deliveryCode(),
            'title' => $supplierData->title(),
            'address' => $supplierData->address(),
            'city' => $supplierData->city(),
            'full_name' => $supplierData->fullName(),
            'phone_number' => $supplierData->phoneNumber()
        ]);
    }
}
