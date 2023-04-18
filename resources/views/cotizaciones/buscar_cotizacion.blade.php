@extends('layouts.app')
@extends('layouts.plantillabase')
@section('contenido')
<div class="row">
    <div class="col">
        <a href="{{route('cotizaciones.create')}}" class="btn colorQA btn-sm">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
            </svg> CREAR COTIZACIÓN
        </a>
    </div>
    <div class="col"></div>
</div>
<br>
<div class="row">
    <div class="col-md"></div>
    <div class="col-md-8">
        <h2 class="text-center">TODOS LAS COTIZACIONES</h2>
        <br>
    </div>
    <div class="col-md"></div>
</div>
@endsection