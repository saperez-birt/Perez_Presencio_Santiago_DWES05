<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id('id_usuario');
            $table->string('username', 50)->unique();
            $table->string('nombre', 100);
            $table->string('apellidos', 150);
            $table->string('email', 150)->unique();
            $table->date('fecha_nacimiento')->nullable();
            $table->timestamp('ultima_conexion')->nullable();
            $table->timestamps();
        });

        DB::table('usuarios')->insert([
            [
                'username' => 'Carlos',
                'nombre' => 'Carlos',
                'apellidos' => 'Gonzalez',
                'email' => 'carlos.gonzalez@ejemplo.com',
                'fecha_nacimiento' => '1990-05-15',
                'ultima_conexion' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'Maria',
                'nombre' => 'Maria',
                'apellidos' => 'Lopez',
                'email' => 'maria.lopez@ejemplo.com',
                'fecha_nacimiento' => '1992-08-20',
                'ultima_conexion' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'Juan',
                'nombre' => 'Juan',
                'apellidos' => 'Martinez',
                'email' => 'juan.martinez@ejemplo.com',
                'fecha_nacimiento' => '1988-12-30',
                'ultima_conexion' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'Ana',
                'nombre' => 'Ana',
                'apellidos' => 'Fernandez',
                'email' => 'ana.fernandez@ejemplo.com',
                'fecha_nacimiento' => '1995-03-10',
                'ultima_conexion' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
