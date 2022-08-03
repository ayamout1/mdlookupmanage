<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductVendorPivotTable extends Migration
{
    public function up()
    {
        Schema::create('product_vendor', function (Blueprint $table) {
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id', 'product_id_fk_7078446')->references('id')->on('products')->onDelete('cascade');
            $table->unsignedBigInteger('vendor_id');
            $table->foreign('vendor_id', 'vendor_id_fk_7078446')->references('id')->on('vendors')->onDelete('cascade');
        });
    }
}
