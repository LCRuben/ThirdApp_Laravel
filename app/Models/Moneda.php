<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Moneda extends Model
{
    use HasFactory;
    
    // Esto es lo Primero que hay que hacer, definir el Nombre de la tabla para el modelo.
    protected $table = 'moneda';
    
    // Para campos que se deben mostrar y que son asignables.
    protected $fillable = ['nombre', 'simbolo', 'pais', 'valor', 'fecha'];
}
