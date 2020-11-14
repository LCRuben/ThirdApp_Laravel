<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class IndexController extends Controller
{
    function index()
    {
        return view('index', ['cadena' => '<a href="https:google.es">enlace</a>', 'nombre' => 'Paquito']);
    }
    
    function sesion(Request $request)
    {
        $incrementar = $request->get('incrementar');
        $suma = 0;
        
        if($request->session()->exists('sumacontinua'))
        {
            $suma = $request->session()->get('sumacontinua');
        }
        
        // No es necesario para el proyect, son cosas de session.
        $leer = Session::get('flash');
        $leer2 = $request->session()->get('flash');
        
        $suma = $suma + $incrementar;
        
        if($incrementar == 11)
        {
            $request->session()->flash('flash', $incrementar);
        }
        if($incrementar == 12)
        {
            $request->session()->reflash();
        }
        $request->session()->put('sumacontinua', $suma);
        
        return view('ticket.sesion', ['incrementar' => $incrementar, 'suma' => $suma]);
    }
    
    
    function logo($id)
    {
        $file = '/var/www/privada/' . $id;
        
        if(!file_exists($file))
        {
            $file = '/var/www/nophoto.png';
        }
        
        return response()->file($file);
    }
    
    // Otra forma de hacerlo.
    /*function sesion()
    {
        // Facades -> Facade/Request
        // Request -> laravel los inyecta.
        // request() -> $request
        // muchos caminos.
        $incrementar = $request->get('incrementar');
        $suma = 0;
        
        if($request->session()->exists('sumacontinua'))
        {
            $suma = $request->session()->get('sumacontinua');
        }
        
        // No es necesario para el proyect, son cosas de session.
        $leer = Session::get('flash');
        $leer2 = $request->session()->get('flash');
        
        $suma = $suma + $incrementar;
        
        if($incrementar == 11)
        {
            $request->session()->flash('flash', $incrementar);
        }
        
        $request->session()->put('sumacontinua', $suma);
        
        return view('ticket.sesion', ['incrementar' => $incrementar, 'suma' => $suma]);
    }*/
}
