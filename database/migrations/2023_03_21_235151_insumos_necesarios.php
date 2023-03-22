<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Insumo;
use App\Producto;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('insumos_producto', function(Blueprint $table){
            $table->bigIncrements('id');
            $table->decimal('cantidad', 10,2);
            $table->foreignIdFor(Insumo::class);
            $table->foreignIdFor(Producto::class);
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
