<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToKSevenSecuritiesTable extends Migration
{
    public function up()
    {
        Schema::table('k_seven_securities', function (Blueprint $table) {
            $table->unsignedBigInteger('product_id')->nullable();
            $table->foreign('product_id', 'product_fk_9452793')->references('id')->on('products');
        });
    }
}
