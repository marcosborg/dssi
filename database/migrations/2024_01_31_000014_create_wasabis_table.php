<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWasabisTable extends Migration
{
    public function up()
    {
        Schema::create('wasabis', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->integer('tb')->nullable();
            $table->integer('term')->nullable();
            $table->string('product_number')->nullable();
            $table->string('description')->nullable();
            $table->decimal('partner_eur', 15, 2)->nullable();
            $table->decimal('pvp_eur', 15, 2)->nullable();
            $table->decimal('partner_mt', 15, 2)->nullable();
            $table->decimal('pvp_mt', 15, 2)->nullable();
            $table->decimal('partner_kz', 15, 2)->nullable();
            $table->decimal('pvp_kz', 15, 2)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
