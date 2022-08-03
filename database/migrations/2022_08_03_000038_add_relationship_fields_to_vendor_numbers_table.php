<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToVendorNumbersTable extends Migration
{
    public function up()
    {
        Schema::table('vendor_numbers', function (Blueprint $table) {
            $table->unsignedBigInteger('vendor_id')->nullable();
            $table->foreign('vendor_id', 'vendor_fk_7078458')->references('id')->on('vendors');
        });
    }
}
