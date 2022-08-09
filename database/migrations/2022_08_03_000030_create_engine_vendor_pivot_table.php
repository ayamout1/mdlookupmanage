<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEngineVendorPivotTable extends Migration
{
    public function up()
    {
        Schema::create('engine_vendor', function (Blueprint $table) {
            $table->unsignedBigInteger('engine_id');
            $table->foreign('engine_id', 'engine_id_fk_7078360')->references('id')->on('engines')->onDelete('cascade');
            $table->unsignedBigInteger('vendor_id');
            $table->foreign('vendor_id', 'vendor_id_fk_7078360')->references('id')->on('vendors')->onDelete('cascade');
            $table->timestamps();
        });
    }
}
