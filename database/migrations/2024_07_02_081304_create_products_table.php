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
    Schema::create('products', function (Blueprint $table) {
        $table->id();
        $table->string('maHang');
        $table->string('tenHang');
        $table->string('image')->nullable();
        $table->string('donViTinh');
        $table->decimal('giaBan', 10, 2);
        $table->decimal('giaVon', 10, 2);
        $table->integer('tonKho');
        $table->integer('luongBan')->default(0);
        $table->text('desc')->nullable();
        $table->string('thueID')->nullable();
        $table->unsignedBigInteger('categoryID');
        $table->foreign('categoryID')->references('id')->on('categories');
        $table->string('status');
        $table->string('warrantyStatus')->nullable();
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};