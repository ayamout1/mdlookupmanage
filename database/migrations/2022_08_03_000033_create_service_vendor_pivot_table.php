<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceVendorPivotTable extends Migration
{
    public function up()
    {
        Schema::create('service_vendor', function (Blueprint $table) {
            $table->unsignedBigInteger('service_id');
            $table->foreign('service_id', 'service_id_fk_7078452')->references('id')->on('services')->onDelete('cascade');
            $table->unsignedBigInteger('vendor_id');
            $table->foreign('vendor_id', 'vendor_id_fk_7078452')->references('id')->on('vendors')->onDelete('cascade');
        });
    }
}
