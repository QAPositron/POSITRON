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
        <h2 class="text-center">TODAS LAS COTIZACIONES</h2>
        <br>
        <table class="table table-responsive hover table-bordered" id="cotizaciones">
            <thead class="table-active align-middle">
                <th class="text-center">CODIGO</th>
                <th class="text-center">EMPRESA</th>
                <th class="text-center">SEDE</th>
                <th class="text-center">FECHA EMISIÓN</th>
                <th class="text-center">FECHA VENCIMIENTO</th>
                <th class="text-center">PERIODO LECTURA</th>
                <th class="text-center">NÚMERO DE LECTURAS</th>
                <th class="text-center">VALOR TOTAL SD PERIODO</th>
                <th class="text-center">VALOR TOTAL PERIODO</th>
            </thead>
            <tbody>
                @foreach($cotizaciones as $coti)
                    <tr>
                        <td>{{$coti->codigo_cotizacion}}</td>
                        <td>{{$coti->empresa->nombre_empresa}}</td>
                        <td>{{$coti->sede->nombre_sede}}</td>
                        <td>{{$coti->fecha_emision}}</td>
                        <td>{{$coti->fecha_vencimiento}}</td>
                        <td>{{$coti->periodoLec}}</td>
                        <td>{{$coti->lecturas_ano}}</td>
                        <td>{{$coti->valorTotalSDPeriodo}}</td>
                        <td>{{$coti->valorTotalPeriodo}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="col-md"></div>
</div>
<script
src="https://code.jquery.com/jquery-3.6.0.js"
integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
crossorigin="anonymous">
</script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if(session('guardar')== 'ok')
    <script>
        Swal.fire(
        'GUARDADA!',
        'SE HA GUARDADO CON ÉXITO.',
        'success'
        )
    </script>
@endif
@endsection