<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToOwnCloudsTable extends Migration
{
    public function up()
    {
        Schema::table('own_clouds', function (Blueprint $table) {
            $table->unsignedBigInteger('product_id')->nullable();
            $table->foreign('product_id', 'product_fk_9452796')->references('id')->on('products');
        });
    }
}
