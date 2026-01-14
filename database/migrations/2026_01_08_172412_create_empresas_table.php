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
        Schema::create('empresas', function (Blueprint $table) {
            $table->id();
            $table->string("nombre",50);
            $table->string("email",50)->unique();
            $table->string("telefono",9);
            $table->string("direccion",50);
            $table->string("website",50)->nullable();
            $table->string("facebook",50)->nullable();
            $table->string("youtube",50)->nullable();
            $table->string("tiktok",50)->nullable();
            $table->text("descripcion")->nullable(); //Nullable es para que acepte valores nulos
            $table->string("urlfoto",50)->nullable();
            $table->boolean("publicado")->default(0); //0 porque es null, este va ser para ver si esta en el menu o no
            $table->integer("orden")->default(1); //Un valor int para guardar la posicion de la ctegoria de la empresa
            $table->integer("visitas")->default(1);
            $table->foreignId('categoria_id')->references('id')->on('categorias')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');           
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empresas');
    }
};
