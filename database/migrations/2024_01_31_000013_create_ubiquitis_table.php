<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUbiquitisTable extends Migration
{
    public function up()
    {
        Schema::create('ubiquitis', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('description')->nullable();
            $table->longText('product_information')->nullable();
            $table->string('product_number')->nullable();
            $table->decimal('partner_mt', 15, 2)->nullable();
            $table->decimal('pvp_mt', 15, 2)->nullable();
            $table->decimal('partner_kz', 15, 2)->nullable();
            $table->decimal('pvp_kz', 15, 2)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
