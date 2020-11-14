<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TicketController extends Controller
{
    function index()
    {
        return view('ticket.index');
    }
    
    function sesion()
    {
        return view('ticket.sesion');
    }
}
