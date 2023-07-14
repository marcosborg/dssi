<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToProductsTable extends Migration
{
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->unsignedBigInteger('manufacturer_id')->nullable();
            $table->foreign('manufacturer_id', 'manufacturer_fk_8753318')->references('id')->on('manufacturers');
            $table->unsignedBigInteger('solution_id')->nullable();
            $table->foreign('solution_id', 'solution_fk_8753325')->references('id')->on('solutions');
            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id', 'category_fk_8753326')->references('id')->on('categories');
        });
    }
}
