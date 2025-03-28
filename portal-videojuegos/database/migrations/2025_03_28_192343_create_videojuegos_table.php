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
        Schema::create('videojuegos', function (Blueprint $table) {
            $table->id('id_videojuego');
            $table->string('nombre', 100);
            $table->text('descripcion')->nullable();
            $table->decimal('precio', 8, 2)->default(0);
            $table->integer('stock')->default(0);
            $table->datetime('fecha_lanzamiento')->nullable();
            $table->enum('clasificacion', ['E', 'E10+', 'T', 'M', 'AO'])->default('E');
            $table->timestamps();
        });

        DB::table('videojuegos')->insert([
            [
                'nombre' => 'Elden Ring',
                'descripcion' => 'Un juego de rol de acción desarrollado por FromSoftware.',
                'precio' => 59.99,
                'stock' => 100,
                'fecha_lanzamiento' => '2022-02-25 00:00:00',
                'clasificacion' => 'M',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'God of War Ragnarök',
                'descripcion' => 'Kratos y Atreus enfrentan su destino.',
                'precio' => 69.99,
                'stock' => 50,
                'fecha_lanzamiento' => '2022-11-09 00:00:00',
                'clasificacion' => 'M',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Horizon Forbidden West',
                'descripcion' => 'Aloy explora el Oeste Prohibido.',
                'precio' => 59.99,
                'stock' => 75,
                'fecha_lanzamiento' => '2022-02-18 00:00:00',
                'clasificacion' => 'T',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'The Legend of Zelda: Breath of the Wild',
                'descripcion' => 'Un juego de aventuras en un mundo abierto.',
                'precio' => 59.99,
                'stock' => 200,
                'fecha_lanzamiento' => '2017-03-03 00:00:00',
                'clasificacion' => 'E10+',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Minecraft',
                'descripcion' => 'Un juego de construcción y aventura en un mundo cúbico.',
                'precio' => 26.95,
                'stock' => 500,
                'fecha_lanzamiento' => '2011-11-18 00:00:00',
                'clasificacion' => 'E10+',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Fortnite',
                'descripcion' => 'Un juego de batalla real con construcción.',
                'precio' => 0.00,
                'stock' => 1000,
                'fecha_lanzamiento' => '2017-07-25 00:00:00',
                'clasificacion' => 'T',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Call of Duty: Warzone',
                'descripcion' => 'Un juego de batalla real en el universo de Call of Duty.',
                'precio' => 0.00,
                'stock' => 800,
                'fecha_lanzamiento' => '2020-03-10 00:00:00',
                'clasificacion' => 'M',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('videojuegos');
    }
};
