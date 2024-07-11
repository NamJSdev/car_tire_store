<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('warranties', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('orderID');
        $table->unsignedBigInteger('productID');
        $table->integer('warrantyPeriod');
        $table->dateTime('warrantyStart');
        $table->dateTime('warrantyEnd');
        $table->text('terms')->nullable();
        $table->string('status');
        $table->foreign('orderID')->references('id')->on('orders');
        $table->foreign('productID')->references('id')->on('products');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('warranties');
    }
};