<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('link')->nullable();
            $table->integer('questions')->nullable();
            $table->string('question_1_pt')->nullable();
            $table->string('question_1_en')->nullable();
            $table->string('question_2_pt')->nullable();
            $table->string('question_2_en')->nullable();
            $table->string('question_3_pt')->nullable();
            $table->string('question_3_en')->nullable();
            $table->string('question_4_pt')->nullable();
            $table->string('question_4_en')->nullable();
            $table->string('question_5_pt')->nullable();
            $table->string('question_5_en')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
