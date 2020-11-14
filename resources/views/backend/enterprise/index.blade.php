@extends('backend.base')

@section('postscript')
<script src="{{ url('assets/backend/js/script.js?r=' . uniqid()) }}"></script>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <a href="{{ url('backend/enterprise/create') }}" class="btn btn-primary">Create enterprise</a>
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
            Enterprise created successfully 2: {{ Session::get('id') }}
        </div>
    </div>
</div>
@endif
--}}

<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">#id</th>
            <th scope="col">name</th>
            <th scope="col">phone</th>
            <th scope="col">contact person</th>
            <th scope="col">tax number</th>
            <th scope="col">Add Ticket</th>
            <th scope="col">view Tickets</th>
            <th scope="col">show</th>
            <th scope="col">edit</th>
            <th scope="col">delete</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($enterprises as $enterprise)
        <tr>
            <td scope="row">{{ $enterprise->id }}</td>
            <td>{{ $enterprise->name }}</td>
            <td>{{ $enterprise->phone }}</td>
            <td>{{ $enterprise->contactperson }}</td>
            <td>{{ $enterprise->taxnumber }}</td>
            
            <td><a href="{{ url('backend/ticket/create/' . $enterprise->id) }}">Add</a></td>
            <td><a href="{{ url('backend/ticket/' . $enterprise->id . '/tickets') }}">View</a></td>
            
            <td><a href="{{ url('backend/enterprise/' . $enterprise->id) }}">show</a></td>
            <td><a href="{{ url('backend/enterprise/' . $enterprise->id . '/edit') }}">edit</a></td>
            <td><a href="#" data-id="{{ $enterprise->id }}" class="enlaceBorrar" >delete</a></td>
        </tr>
    @endforeach
    </tbody>
</table>
<form id="formDelete" action="{{ url('backend/enterprise') }}" method="post">
    @method('delete')
    @csrf
</form>
@endsection