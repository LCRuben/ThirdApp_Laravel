<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;
    
    // Esto es lo Primero que hay que hacer, definir el Nombre de la tabla para el modelo.
    protected $table = 'ticket';
    
    // Para campos que se deben mostrar y que son asignables.
    protected $fillable = ['identerprise', 'name', 'price', 'initialdate', 'finaldate', 'initialtime', 'finaltime', 'description'];
    
    // Campos que No quiero que introduzca el usuario y que No muestro al ususario.
    protected $hidden = ['profit'];
    
    // Campos que se rellenan de otra forma.
    protected $guarded = ['profit', 'active'];

    /* Aparte El beneficio va a ser del 15% */
    protected $attributes = ['profit' => 15.0 , 'active' => true];
    
    // Relacion que existe entre el identerpise y la tabla ticket -> el ticket pertenece a una empresa.
    // hace referencia a la empresa a la que pertenece el ticket.
    public function enterprise()
    {
        return $this->belongsTo ('App\Models\Enterprise', 'identerprise');
    }
    
    /* HASTA AQUI */
    
    /* ******************************************************************* */
    // Nombre del campo que forma la clave primaria -> el estandar es crear un id autonumerico.
    // Laravel crea por defecto el valor autonumerico llamado id para cualquier modelo.
    // Ponerlo y No ponerlo es lo mismo, No es necesario, Laravel te lo crea.
    //protected $primaryKey = 'id';
    
    // fecha de creación del registro y fecha de la ultima edicion del registro.
    // Cuando se creo y cuando se modifico por ultima vez.
    // Esto hace que se anulen esas fechas. // predeterminado es true.
    //public $timestamps = false;
    
    // Campos: id, create_at, updated_at
    
    //Campos que el usuario No introduce, pero que Si muestro.
    //protected $guarded = ['identerprise'];
    
}
