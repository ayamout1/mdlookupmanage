<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBrandVendorPivotTable extends Migration
{
    public function up()
    {
        Schema::create('brand_vendor', function (Blueprint $table) {
            $table->unsignedBigInteger('brand_id');
            $table->foreign('brand_id', 'brand_id_fk_7077983')->references('id')->on('brands')->onDelete('cascade');
            $table->unsignedBigInteger('vendor_id');
            $table->foreign('vendor_id', 'vendor_id_fk_7077983')->references('id')->on('vendors')->onDelete('cascade');
        });
    }
}
