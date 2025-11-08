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
        Schema::create('departments', function (Blueprint $table) {
            $table->id();
            $table->string('name', 45)->unique(); // nombre único y <= 45 caracteres
            $table->unsignedBigInteger('parent_id')->nullable(); // departamento superior opcional 
            $table->unsignedInteger('level')->default(1); // entero positivo (llenado por factory/seeder o validado)
            $table->unsignedInteger('employees')->default(1); // entero positivo
            $table->string('ambassador')->nullable(); // nombre completo del embajador (solo texto)
            $table->timestamps();

            $table->foreign('parent_id')
                ->references('id')->on('departments')
                ->onDelete('set null') // si el padre se borra, el hijo se queda con parent_id NULL
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('departments');
    }
};
