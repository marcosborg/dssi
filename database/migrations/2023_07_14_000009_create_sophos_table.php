<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSophosTable extends Migration
{
    public function up()
    {
        Schema::create('sophos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('family')->nullable();
            $table->string('type')->nullable();
            $table->integer('term')->nullable();
            $table->longText('description')->nullable();
            $table->integer('min')->nullable();
            $table->integer('max')->nullable();
            $table->decimal('price_partner_met', 15, 2)->nullable();
            $table->decimal('pvp_met', 15, 2)->nullable();
            $table->decimal('price_partner_kwa', 15, 2)->nullable();
            $table->decimal('pvp_kwa', 15, 2)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
