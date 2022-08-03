<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorNumbersTable extends Migration
{
    public function up()
    {
        Schema::create('vendor_numbers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('number')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
