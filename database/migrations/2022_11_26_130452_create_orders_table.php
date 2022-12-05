<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('customer')->nullable();
            $table->integer('price');
            $table->string('details')->nullable();
            $table->enum('status', ['waiting', 'done', 'fail']);
            $table->string('statusDetails')->nullable();
            $table->foreignId('captain_id');
            $table->foreign('captain_id')->on('captains')->references('id')->cascadeOnDelete();
            $table->foreignId('client_id');
            $table->foreign('client_id')->on('clients')->references('id')->cascadeOnDelete();
            $table->foreignId('street_id');
            $table->foreign('street_id')->on('streets')->references('id')->cascadeOnDelete();
            $table->foreignId('city_id');
            $table->foreign('city_id')->on('cities')->references('id')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}