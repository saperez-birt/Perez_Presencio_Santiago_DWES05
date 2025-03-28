<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'usuarios';

    protected $primaryKey = 'id_usuario';

    protected $fillable = [
        'username',
        'nombre',
        'apellidos',
        'email',
        'fecha_nacimiento',
        'ultima_conexion'
    ];

    protected $dates = [
        'fecha_nacimiento',
        'ultima_conexion',
        'created_at',
        'updated_at'
    ];

    public $timestamps = true;
}
