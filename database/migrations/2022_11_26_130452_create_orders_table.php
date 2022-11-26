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
            $table->string('forName');
            $table->integer('price');
            $table->string('details');
            $table->enum('status',['قيد التسليم','تم التسليم بنجاح','فشلت عملية التسليم']);
            $table->string('statusDetails');
            $table->foreignId('captin_id');
            $table->foreign('captin_id')->on('captins')->references('id')->cascadeOnDelete();
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
