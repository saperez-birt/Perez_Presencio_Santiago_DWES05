<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BibliotecaUsuario extends Model
{
    protected $table = 'biblioteca_usuarios';

    protected $primaryKey = 'id_biblioteca';

    protected $fillable = [
        'id_usuario',
        'id_videojuego',
        'fecha_compra',
        'estado_juego',
        'horas_jugadas'
    ];

    protected $casts = [
        'fecha_compra' => 'datetime',
        'horas_jugadas' => 'float'
    ];

    protected $dates = [
        'fecha_compra',
        'created_at',
        'updated_at'
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario', 'id_usuario');
    }

    public function videojuego()
    {
        return $this->belongsTo(Videojuego::class, 'id_videojuego', 'id_videojuego');
    }

    public $timestamps = true;

}
