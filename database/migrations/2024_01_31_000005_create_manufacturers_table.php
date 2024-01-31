<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManufacturersTable extends Migration
{
    public function up()
    {
        Schema::create('manufacturers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('url')->nullable();
            $table->boolean('pt')->default(0)->nullable();
            $table->boolean('mz')->default(0)->nullable();
            $table->boolean('ao')->default(0)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
