@extends('backend.base')

@section('postscript')
<script src="{{ url('assets/backend/js/script.js?r=' . uniqid()) }}"></script>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <a href="{{ url('backend/ticket/create') }}" class="btn btn-primary">Create Ticket</a>
            </div>
        </div>
    </div>
</div>

<!--
op -> store, update, destroy
r -> negativo, 0, positivo (acierto)
id -> id del elemento afectado
-->

@if(session()->has('op'))
<div class="row">
    <div class="col-lg-12">
        <div class="alert alert-success" role="alert">
            Operation: {{ session()->get('op') }}. Id: {{ session()->get('id') }}. Result: {{ session()->get('r') }}
        </div>
    </div>
</div>
@endif

{{--
@if(Session::get('op') !== null)
<div class="row">
    <div class="col-lg-12">
        <div class="alert alert-success" role="alert">
            Ticket created successfully 2: {{ Session::get('id') }}
        </div>
    </div>
</div>
@endif
--}}

<table class="table table-hover">
    <thead>
        <tr>
            <th>#id</th>
            <th>name</th>
            <th>enterprise</th>
            <th>price</th>
            <th>initial date</th>
            <th>final date</th>
            <th>active</th>
            
            <th>show</th>
            <th>edit</th>
            <th>delete</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($tickets as $ticket)
        <tr>
            <td scope="row">{{ $ticket->id }}</td>
            <td>{{ $ticket->name }}</td>
            
            <!-- Llama a la funcion enterprise del Models Ticket. -->
            <td>{{ $ticket->enterprise->name }}</td> 
            
            <td>{{ $ticket->price }}</td>
            
            <!-- date('d-,-Y'), strtotime($date) - Formate la fecha. -->
            <td>{{ date('d-m-Y', strtotime($ticket->initialdate)) }}</td>
            <td>{{ date('d-m-Y', strtotime($ticket->finaldate)) }}</td>
            
            <!-- Si el ticket esta activo -->
            <td>@if($ticket->active)
                    &#x2714; <!-- Crea un caracter/simbolo Unicode -->
                @else
                	&#10060; <!-- Crea un caracter/simbolo Unicode -->
                @endif</td>
            
            <td><a href="{{ url('backend/ticket/' . $ticket->id) }}">show</a></td>
            <td><a href="{{ url('backend/ticket/' . $ticket->id . '/edit') }}">edit</a></td>
            <td><a href="#" data-id="{{ $ticket->id }}" class="enlaceBorrar" >delete</a></td>
        </tr>
    @endforeach
    </tbody>
</table>
<form id="formDelete" action="{{ url('backend/ticket') }}" method="post">
    @method('delete')
    @csrf
</form>
@endsection