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
        Schema::create('proveedoras', function(Blueprint $table){
            $table->bigIncrements('id');
            $table->string('identificacion', 10);
            $table->string('razon_social');
            $table->string('telefono')->nullable()->unique();
            $table->string('correo_electronico')->nullable()->unique();
            $table->string('direccion')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
