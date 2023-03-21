<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Insumo;
use App\Proveedora;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('compras', function(Blueprint $table){
            $table->bigIncrements('id');
            $table->decimal('cantidad', 10, 2);
            $table->string('referencia');
            $table->string('estado', 1);
            $table->foreignIdFor(Insumo::class);
            $table->foreignIdFor(Proveedora::class);
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
