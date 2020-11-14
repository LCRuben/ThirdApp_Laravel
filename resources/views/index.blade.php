@extends('base')

@section('title')
Index Page
@endsection

@section('titlePart')
Hello world!
@endsection

@section('subtitle')
<h3>This is the second subtitle. h3</h3>
@parent
@endsection

@section('content')
<p>This is the new content. <a href="{{ url('ticket') }}">tickets</a></p>
<p>Escapar un Caracter: {{ $cadena ?? '' }}</p>
<p>No Escapar Caracteres: {!! $cadena ?? '' !!}</p>

<p>No me llega: {{ $nollega ?? 'No me ha llegado'}}</p>


@auth
 <h2>Usuario autentificado</h2>
@endauth

@guest
 <h2>Eres un usuario invitado</h2>
@endguest

<!-- Si llega la variable entra, si No llega No -->
@isset($nombre)
 <h2>La variable $nombre tiene el valor {{ $nombre }}</h2>
@endisset

@endsection