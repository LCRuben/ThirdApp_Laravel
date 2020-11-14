<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enterprise extends Model
{
    use HasFactory;
    
    // Esto es lo Primero que hay que hacer, definir el Nombre de la tabla para el modelo.
    protected $table = 'enterprise';
    
    // Para los campos de la tabla que se deben mostrar y que son asignables.
    protected $fillable = ['name', 'phone', 'contactperson', 'address', 'taxnumber'];
    
    // Relacion que existe entre el identerpise y la tabla ticket.
    // hace referencia a los tickets que pertenecen a la empresa.
    public function tickets() 
    {
        return $this->hasMany ('App\Models\Ticket', 'identerpise', 'id');
    }
    
    /* HASTA AQUÍ */
    
    /* **************************************************************** */
    
    // Nombre del campo que forma la clave primaria -> el estandar es crear un id autonumerico.
    // Laravel crea por defecto el valor autonumerico llamado id para cualquier modelo.
    // Ponerlo y No ponerlo es lo mismo, No es necesario, Laravel te lo crea.
    //protected $primaryKey = 'id';
    
    // fecha de creación del registro y fecha de la ultima edicion del registro.
    // Cuando se creo y cuando se modifico por ultima vez.
    // Esto hace que se anulen esas fechas. // predeterminado es true.
    //public $timestamps = false;
    
    // Campos que No quiero que introduzca el usuario y que No muestro al ususario.
    //protected $hidden = ['profit'];
    //Campos que el usuario No introduce, pero que Si muestro.
    //protected $guarded = ['ss'];
    
    /* Aparte */
    //protected $attributes = ['profit' => 0.2];
}
