@extends('base')

@section('title')
Index Page
@endsection

@section('titlePart')
Hello world!
@endsection

@section('subtitle')
<h3>Esto deberia ser una sesion</h3>
@parent
@endsection

@section('content')
<p>No me llega: {{ $nollega ?? 'No me ha llegado'}}</p>
@endsection

<h2>{{ $incrementar }}</h2>

<h2>
 @if($suma != 0)
  {{ $suma }}
 @else
  {{ $suma }} 
 @endif
</h2>

<!--No es especialmente necesario Ruben.-->
<h2>
 Flash: {{ Session::get('flash') }} {{ request()->session()->get('flash') }}
</h2>

<form action="{{ url('sesion') }}">
 <input type="number" name="incrementar" placeholder="incrementar"/>
 <input type="text" name="sumacontinua" placeholder="sumacontinua"/>
 <input type="submit" value="Submit"/>
</form>