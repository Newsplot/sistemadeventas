<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('detallefactura', function (Blueprint $table) {
            $table->id();
            $table->string('nombredelatienda');
            $table->decimal('precio', 10,2);
            $table->char('cantidad', 10);

            $table->bigInteger('idProductos')->unsigned();
            $table->bigInteger('idFactura')->unsigned();

            $table->foreign('idProductos')->references('id')->on('productos')->onDelete('cascade');
            $table->foreign('idFactura')->references('id')->on('facturas')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detallefactura');
    }
};
