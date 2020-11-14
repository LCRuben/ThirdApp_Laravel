<?php

namespace App\Http\Controllers;

use App\Models\Enterprise;
use Illuminate\Http\Request;

class BackendEnterpriseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $enterprises = Enterprise::all(); // eloquent -> select * from table.
        
        //$query = $request->query;
        
        // dd($enterprises); Muestra todo lo que devuelve la variable enterprise. Le ponemos un nombre: 'enterprises'
        return view('backend.enterprise.index', ['enterprises' => $enterprises]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.enterprise.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Diferentes formas de leer el mismo parametro.
        /* = $request->input('name');
        $name2 = $request->name;
        //$name3 = $request->input('name', kakas);
        //echo 'el nombre es: ' . $name;
        $all = $request->all();
        $input = $request->input();*/
        
        // dd($all); // Para mostrar algo por pantalla.
        
        /* 1 Esta es la forma 'Buena'.
        $enterprise = new Enterprise($request->all());
        $result = $enterprise->save();
        //echo "el resultado es $result y el id de la empresa es: " . $enterprise->id;
        
        // 2
        //$enterprise = Enterprise::create($request->all());
        //$enterprise = new Enterprise($request->all());*/
        
        /**********************************************************************
        * Así Guardamos los datos de una nueva empresa.
        */
         $enterprise = new Enterprise($request->all());
         
        try 
        {
            $result = $enterprise->save();
        } 
        catch(\Exception $e) 
        {
            $result = 0;
        }
        
        if($enterprise->id > 0)
        {
            $response = ['op' => 'create', 'r' => $result, 'id' => $enterprise->id];
            return redirect('backend/enterprise')->with($response);
        } 
        else 
        {
            return back()->withInput()->with(['error' => 'algo ha fallado']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Enterprise  $enterprise
     * @return \Illuminate\Http\Response
     */
    public function show(Enterprise $enterprise)
    {
        /* Guarda una imagen con su extension */
        $extensions = ['jpg', 'gif', 'png', 'jpeg'];
        $logo = 'nophoto.png';
        
        foreach($extensions as $extension)
        {
            if(file_exists('upload/' . $enterprise->id . '.' . $extension))
            {
                $logo = $enterprise->id . '.' . $extension;
                break;
            }
        }
        
        
        /*  ********* guarda imagen con su extension ********** */
        /*$path = public_path('upload');
        $files = \File::files($path);
        $logo = 'nophoto.png';
        
        foreach($files as $file)
        {
            $fileName = pathinfo($file, PATHINFO_FILENAME);
            
            if($fileName == $enterprise->id)
            {
                $logo = $file->getFileName();
                break;
            }
        }*/
        
        return view('backend.enterprise.show', ['enterprise' => $enterprise, 'logo' => $logo]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Enterprise  $enterprise
     * @return \Illuminate\Http\Response
     */
    public function edit(Enterprise $enterprise)
    {
        //$enterprise = Enterprise::find($id);
        $fichero = 'upload/' . $enterprise->id;
        
        return view('backend.enterprise.edit', ['enterprise' => $enterprise, 'fichero' => $fichero]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Enterprise  $enterprise
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Enterprise $enterprise)
    {
        /* // 1º Forma Update
            $result = $enterprise->update($request->all());
        // 2º Forma de Update.
        $enterprise->fill($request->all());
        $result = $enterprise->save();*/
        
        /* METODOS CREADOS MÁS ABAJO  */
        $this->uploadFile($request, $enterprise->id);
        $this->uploadPrivateFile($request, $enterprise->id);
        
        /* ----------------------------------------------------------------- */
        
        // Así hacemos el Update.
        try
        {
            $result = $enterprise->update($request->all());
        }
        catch(\Exception $e)
        {
            $result = 0;
        }
        
        // Si resultado contiene algo intento guardar. -> true o false. Guarda o No.
        if($result)
        {
            // Paso el array con los resultados.
            $response = ['op' => 'update', 'r' => $result, 'id' => $enterprise->id];
            
            // Aquí redirijo a una Vista y paso la respuesta.
            return redirect('backend/enterprise')->with($response);
        }
        else
        {
            return back()->withInput()->with(['error' => 'algo ha fallado']);
        }
    }


    /**
    * Nueva Funcion/Metodo para subir un archivo.
    */
    private function uploadFile(Request $request, $id)
    {
        if($request->hasFile('logo') && $request->file('logo')->isValid()) 
        {
            $extensions = ['jpg', 'gif', 'png', 'jpeg'];
            
            foreach($extensions as $extension)
            {
                if(file_exists('upload/' . $id . '.' . $extension))
                {
                    unlink('upload/' . $id . '.' . $extension);
                }
            }
            
            $file = $request->file('logo'); // $request->logo
            $target = 'upload/';
            $text = \File::extension($file->getClientOriginalName());
            $name = $id . '.' . $text;  // date('YmdHis') . $file->getClientOriginalName();
            $file->move($target, $name);
        }
    }
    
    
    /**
    * Nueva Funcion/Metodo para subir un archivo.
    */
    private function uploadPrivateFile(Request $request, $id)
    {
        if($request->hasFile('privada') && $request->file('privada')->isValid()) 
        {
             $file = $request->file('privada'); // $request->logo
             $target = '/var/www/privada/';
             $text = \File::extension($file->getClientOriginalName());
             $name = $id . '.' . $text;  // date('YmdHis') . $file->getClientOriginalName();
             $file->move($target, $name);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Enterprise  $enterprise
     * @return \Illuminate\Http\Response
     */
    public function destroy(Enterprise $enterprise)
    {
        //$result = Enterprise::destroy($enterprise->id); // Así NO
        // $result = Enterprise::destroy($enterprise->id); // Esta forma borra por el id.
        
        /* ------------------------------------------------------------------ */
        
        /*
        * así se Borra una empresa.
        */
        $id = $enterprise->id;
        
        try
        {
            $result = $enterprise->delete(); // Esta forma borra la empresa directamente.
        }
        catch (\Exception $e)
        {
            $result = 0;
        }
        
        
        $response = ['op' => 'destroy', 'r' => $result, 'id' => $id];
        return redirect('backend/enterprise')->with($response);
    }
}
