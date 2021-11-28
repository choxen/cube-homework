<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarcodeTable extends Migration
{
    public function up(): void
    {
        Schema::create('barcode', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id')->index();
            $table->string('barcode');
            $table->string('description');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('barcode');
    }
}
