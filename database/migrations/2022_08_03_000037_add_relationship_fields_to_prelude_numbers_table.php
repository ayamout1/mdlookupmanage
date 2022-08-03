<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToPreludeNumbersTable extends Migration
{
    public function up()
    {
        Schema::table('prelude_numbers', function (Blueprint $table) {
            $table->unsignedBigInteger('vendor_id')->nullable();
            $table->foreign('vendor_id', 'vendor_fk_7078438')->references('id')->on('vendors');
        });
    }
}
