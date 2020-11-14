<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Enterprise;
use Illuminate\Http\Request;

class BackendTicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tickets = Ticket::all(); // eloquent -> select * from table.
        
        return view('backend.ticket.index', ['tickets' => $tickets]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $enterprises = Enterprise::all(); // nos da todas las empresas de la BD en un array.
        return view('backend.ticket.create', ['enterprises' => $enterprises]);
    }
    
    
    /**
    * Create para un nuevo Ticket de la empresa.
    */
    function createTicketEp($identerprise)
    {
        $enterprise = Enterprise::find($identerprise); // find() -> busca la empresa con el id pasado.
        
        return view('backend.ticket.create', ['enterprise' => $enterprise]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ticket = new Ticket($request->all());
         
        try 
        {
            $result = $ticket->save();
        } 
        catch(\Exception $e) 
        {
            $result = 0;
        }
        
        if($ticket->id > 0)
        {
            $response = ['op' => 'create', 'r' => $result, 'id' => $ticket->id];
            return redirect('backend/ticket')->with($response);
        } 
        else 
        {
            return back()->withInput()->with(['error' => 'algo ha fallado']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
        // $ticket = Ticket::find($id); // recogemos el ticket a partir del ID en caso de que No nos llegue el Ticket en sí.
        return view('backend.ticket.show', ['ticket' => $ticket]);
    }
    
    /**
    * 
    */
    function showTickets($identerprise)
    {
        $tickets = Ticket::where('identerprise', $identerprise)
            ->orderBy('name', 'asc')
            ->get();
        return view('backend.ticket.index', ['tickets' => $tickets]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function edit(Ticket $ticket)
    {
        $enterprises = Enterprise::all(); // find() -> busca la empresa con el id pasado.
        return view('backend.ticket.edit', ['ticket' => $ticket, 'enterprises' => $enterprises]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ticket $ticket)
    {
        // Así hacemos el Update.
        try
        {
            $result = $ticket->update($request->all());
        }
        catch(\Exception $e)
        {
            $result = 0;
        }
        
        // Si resultado contiene algo intento guardar. -> true o false. Guarda o No.
        if($result)
        {
            // Paso el array con los resultados.
            $response = ['op' => 'update', 'r' => $result, 'id' => $ticket->id];
            
            // Aquí redirijo a una Vista y paso la respuesta.
            return redirect('backend/ticket')->with($response);
        }
        else
        {
            return back()->withInput()->with(['error' => 'algo ha fallado']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        /*
        * así se Borra un ticket.
        */
        $id = $ticket->id;
        
        try
        {
            $result = $ticket->delete(); // Esta forma borra la empresa directamente.
        }
        catch (\Exception $e)
        {
            $result = 0;
        }
        
        $response = ['op' => 'destroy', 'r' => $result, 'id' => $id];
        return redirect('backend/ticket')->with($response);
    }
}
