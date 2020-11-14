@extends('backend.base')

@section('postcripts')
<!-- jQuery -->
<script src="{{ url('assets/backend/js/script.js?r=' . uniqid ()) }}"></script>
@endsection

@section('content')
<form id="formDelete" action="{{ url('backend/ticket/' . $ticket->id) }}" method="post">
@method('delete')
@csrf
</form>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <a href="{{ url()->previous() }}" class="btn btn-primary">Back</a>
                <a href="{{ url('backend/ticket') }}" class="btn btn-primary">Ticket</a>
                <a href="#" data-table="ticket" data-id="{{ $ticket->id }}" data-name="{{ $ticket->name }}" class="btn btn-danger" id="enlaceBorrar">Delete Ticket</a>
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
            <label for="identerprise">Enterprise</label>
            {{ $ticket->enterprise->name . ' - ' . $ticket->enterprise->phone }}
        </div>
        
        <div class="form-group">
            <label for="name">Name</label>
            {{ $ticket->name }}
        </div>
        
        <div class="form-group">
            <label for="price">Price</label>
            {{ $ticket->price }}
        </div>
        <div class="form-group">
            <label for="initialdate">Initial Date</label>
            {{ $ticket->initialdate }}
        </div>
        <div class="form-group">
            <label for="finaldate">Final Date</label>
           {{ $ticket->finaldate }}
        </div>
        <div class="form-group">
            <label for="initialtime">Initial Time</label>
            {{ $ticket->initialtime }}
        </div>
        <div class="form-group">
            <label for="finaltime">Final Time</label>
            {{ $ticket->finaltime }}
        </div>
        
        <div class="form-group">
            <label for="description">Description</label>
            {{ $ticket->description }}
        </div>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>
@endsection