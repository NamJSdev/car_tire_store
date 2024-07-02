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
    Schema::create('warranty_services', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('warrantyID');
        $table->dateTime('serviceDate');
        $table->text('desc')->nullable();
        $table->decimal('cost', 10, 2)->nullable();
        $table->string('status');
        $table->foreign('warrantyID')->references('id')->on('warranties');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('warranty_services');
    }
};