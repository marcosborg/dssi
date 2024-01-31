<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToUbiquitisTable extends Migration
{
    public function up()
    {
        Schema::table('ubiquitis', function (Blueprint $table) {
            $table->unsignedBigInteger('product_id')->nullable();
            $table->foreign('product_id', 'product_fk_9452802')->references('id')->on('products');
            $table->unsignedBigInteger('stock_mz_id')->nullable();
            $table->foreign('stock_mz_id', 'stock_mz_fk_9424751')->references('id')->on('stocks');
            $table->unsignedBigInteger('stock_ao_id')->nullable();
            $table->foreign('stock_ao_id', 'stock_ao_fk_9424752')->references('id')->on('stocks');
        });
    }
}
