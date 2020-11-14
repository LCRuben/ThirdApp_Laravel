@extends('backend.base')

@section('postcripts')
    <!-- jQuery -->
    <script src="{{ url('assets/backend/js/script.js?r=' . uniqid ()) }}"></script>
@endsection

@section('content')
<form id="formDelete" action="{{ url('backend/moneda/' . $moneda->id) }}" method="post">
    @method('delete')
    @csrf
</form>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <a href="{{ url()->previous() }}" class="btn btn-primary">Back</a>
                <a href="{{ url('backend/moneda') }}" class="btn btn-primary">Monedas</a>
                <a href="#" data-table="moneda" data-id="{{ $moneda->id }}" data-name="{{ $moneda->nombre }}" class="btn btn-danger" id="enlaceBorrar">Delete Moneda</a>
            </div>
        </div>
    </div>
</div>

@if(session()->has('error'))
    <div class="row">
        <div class="col-lg-12">
            <div class="alert alert-danger" role="alert">
                <h2>Error ...</h2>
            </div>
        </div>
    </div>
@endif

    @csrf
    <div class="card-body">
        <div class="form-group">
            <label for="id">Moneda #Id: </label>
            {{ $moneda->id }}
        </div>
        
        <div class="form-group">
            <label for="nombre">Nombre: </label>
            {{ $moneda->nombre }}
        </div>
        
        <div class="form-group">
            <label for="simbolo">Simbolo: </label>
            {{ $moneda->simbolo }}
        </div>
        
        <div class="form-group">
            <label for="pais">Pais: </label>
            {{ $moneda->pais }}
        </div>
        
        <div class="form-group">
            <label for="valor">Valor: </label>
           {{ $moneda->valor . '€' }}
        </div>
        
        <div class="form-group">
            <label for="fecha">Fecha de Introduccion: </label>
            {{ $moneda->fecha }}
        </div>
    </div>
    
</form>
@endsection