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
        Schema::create('categorias', function (Blueprint $table) {
            $table->id();
            $table->string("nombre",25);
            $table->string("slug",25)->unique(); //Es para las rutas, unique para que sean unicas
            $table->text("descripcion")->nullable(); //Nullable es para que acepte valores nulos
            $table->boolean("menu")->default(0); //0 porque es null, este va ser para ver si esta en el menu o no
            $table->integer("orden")->default(1); //Un valor int para guardar la posicion de la ctegoria de la empresa
            $table->timestamps(); // Esto crea automáticamente created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categorias');
    }
};
