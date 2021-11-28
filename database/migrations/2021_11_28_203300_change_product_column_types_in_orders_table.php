<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeProductColumnTypesInOrdersTable extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->integer('product_id')->change();
            $table->integer('product_quantity')->change();
        });
    }


    public function down(): void
    {

    }
}
