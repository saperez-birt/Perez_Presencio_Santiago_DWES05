<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Videojuego extends Model
{
    protected $table = 'videojuegos';

    protected $primaryKey = 'id_videojuego';

    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'stock',
        'fecha_lanzamiento',
        'clasificacion'
    ];

    protected $casts = [
        'precio' => 'decimal:2',
        'fecha_lanzamiento' => 'datetime',
        'stock' => 'integer'
    ];

    protected $dates = [
        'fecha_lanzamiento',
        'created_at',
        'updated_at'
    ];

    public $timestamps = true;


}
