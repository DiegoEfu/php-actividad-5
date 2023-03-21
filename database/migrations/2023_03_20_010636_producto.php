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
        Schema::create('productos', function(Blueprint $table){
            $table->bigIncrements('id');
            $table->string('nombre');
            $table->string('codigo_barra');
            $table->decimal('stock', 10, 2);
            $table->timestamps();
        });

        Schema::create('insumos', function(Blueprint $table){
            $table->bigIncrements('id');
            $table->string('nombre');
            $table->decimal('precio', 10, 2);
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
