<?php

namespace App\Http\Controllers;

use App\Models\Moneda;
use Illuminate\Http\Request;

class BackendMonedaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $monedas = Moneda::all(); // eloquent -> select * from table.
        
        return view('backend.moneda.index', ['monedas' => $monedas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.moneda.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /**********************************************************************
        * Así Guardamos los datos de una nueva empresa.
        */
        $moneda = new Moneda($request->all());
         
        try 
        {
            $result = $moneda->save();
        } 
        catch(\Exception $e) 
        {
            $result = 0;
        }
        
        if($moneda->id > 0)
        {
            $response = ['op' => 'create', 'r' => $result, 'id' => $moneda->id];
            return redirect('backend/moneda')->with($response);
        } 
        else 
        {
            return back()->withInput()->with(['error' => 'algo ha fallado']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Moneda  $moneda
     * @return \Illuminate\Http\Response
     */
    public function show(Moneda $moneda)
    {
        return view('backend.moneda.show', ['moneda' => $moneda]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Moneda  $moneda
     * @return \Illuminate\Http\Response
     */
    public function edit(Moneda $moneda)
    {
        return view('backend.moneda.edit', ['moneda' => $moneda]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Moneda  $moneda
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Moneda $moneda)
    {
        // Así hacemos el Update.
        try
        {
            $result = $moneda->update($request->all());
        }
        catch(\Exception $e)
        {
            $result = 0;
        }
        
        // Si resultado contiene algo intento guardar. -> true o false. Guarda o No.
        if($result)
        {
            // Paso el array con los resultados.
            $response = ['op' => 'update', 'r' => $result, 'id' => $moneda->id];
            
            // Aquí redirijo a una Vista y paso la respuesta.
            return redirect('backend/moneda')->with($response);
        }
        else
        {
            return back()->withInput()->with(['error' => 'algo ha fallado']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Moneda  $moneda
     * @return \Illuminate\Http\Response
     */
    public function destroy(Moneda $moneda)
    {
        /*
        * así se Borra una moneda.
        */
        $id = $moneda->id;
        
        try
        {
            $result = $moneda->delete(); // Esta forma borra la moneda directamente.
        }
        catch (\Exception $e)
        {
            $result = 0;
        }
        
        $response = ['op' => 'destroy', 'r' => $result, 'id' => $id];
        
        return redirect('backend/moneda')->with($response);
    }
}
