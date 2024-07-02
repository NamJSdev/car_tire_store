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
    Schema::create('order_and_product', function (Blueprint $table) {
        $table->unsignedBigInteger('orderID');
        $table->unsignedBigInteger('productID');
        $table->integer('soLuong');
        $table->decimal('thanhTien', 10, 2);
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
        Schema::dropIfExists('order_and_product');
    }
};