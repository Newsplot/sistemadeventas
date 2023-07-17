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
        Schema::create('proveedores', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 50);

            $table->bigInteger('idCiudad')->unsigned();
            $table->bigInteger('idDepartamento')->unsigned();

            $table->foreign('idCiudad')->references('id')->on('ciudad')->onDelete('cascade');
            $table->foreign('idDepartamento')->references('id')->on('departamento')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proveedores');
    }
};
