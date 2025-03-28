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
        Schema::create('biblioteca_usuarios', function (Blueprint $table) {
            $table->id('id_biblioteca');
            
            $table->unsignedBigInteger('id_usuario');
            $table->unsignedBigInteger('id_videojuego');
            
            $table->timestamp('fecha_compra')->useCurrent();
            $table->enum('estado_juego', ['sin_jugar', 'jugando', 'completado', 'pausado'])->default('sin_jugar');
            $table->decimal('horas_jugadas', 6, 2)->default(0);
            
            $table->timestamps();
            
            $table->unique(['id_usuario', 'id_videojuego']);
            
            $table->foreign('id_usuario')
                  ->references('id_usuario')
                  ->on('usuarios')
                  ->onDelete('cascade');
            
            $table->foreign('id_videojuego')
                  ->references('id_videojuego')
                  ->on('videojuegos')
                  ->onDelete('cascade');
        });

        DB::table('biblioteca_usuarios')->insert([
            [
                'id_usuario' => 1,
                'id_videojuego' => 1,
                'fecha_compra' => now(),
                'estado_juego' => 'jugando',
                'horas_jugadas' => 15.5,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_usuario' => 1,
                'id_videojuego' => 2,
                'fecha_compra' => now(),
                'estado_juego' => 'sin_jugar',
                'horas_jugadas' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_usuario' => 2,
                'id_videojuego' => 3,
                'fecha_compra' => now(),
                'estado_juego' => 'completado',
                'horas_jugadas' => 45.2,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('biblioteca_usuarios');
    }
};
