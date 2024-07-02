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
    Schema::create('orders', function (Blueprint $table) {
        $table->id();
        $table->string('maDonHang')->unique();
        $table->text('desc')->nullable();
        $table->decimal('price', 10, 2);
        $table->unsignedBigInteger('customerID');
        $table->unsignedBigInteger('accountID');
        $table->unsignedBigInteger('paymentID');
        $table->foreign('customerID')->references('id')->on('customers');
        $table->foreign('accountID')->references('id')->on('accounts');
        $table->foreign('paymentID')->references('id')->on('payments');
        $table->dateTime('ngayTao');
        $table->dateTime('capNhat')->nullable();
        $table->string('status');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};