@extends('layouts.plantillabase')
@section('contenido')


<h3 class="text-center ">{{$empresa->nombre_empresa}}</h3>
<div class="row">
    <div class="col"></div>
    <div class="col"></div>
    <div class="col"></div>
    <div class="col">
        <a href="{{route('contratosdosi.create', $empresa->id_empresa)}}" type="button" class="btn colorQA" >CREAR CONTRATO</a>
    </div>
</div>
<BR></BR>
<div class="row">
    <div class="col"></div>
    <div class="col-9">
        <h4 class="text-center">LISTADO DE CONTRATOS</h4>
        <div class="table table-responsive p-4 ">
            <table class="table table-bordered">
                <thead class ="text-center">
                    <tr>
                        <th>No. CONTRATO</th>
                        <th style='width: 15.60%'>FECHA INICIO</th>
                        <th style='width: 15.60%'>FECHA FINALIZACIÓN</th>
                        <th>P. RECAMBIO</th>
                        <th>ACCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($dosimetriacontrato as $dosicont)
                        <tr>
                            <td><a class="link-dark" href="{{route('detallecontrato.create', $dosicont->id_contratodosimetria)}}">{{$dosicont->codigo_contrato}}</a></td>
                            <td>{{$dosicont->fecha_inicio}}</td>
                            <td>{{$dosicont->fecha_finalizacion}}</td>
                            <td>{{$dosicont->periodo_recambio}}</td>
                            <td>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="col"></div>
</div>
<script
src="https://code.jquery.com/jquery-3.6.0.js"
integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
crossorigin="anonymous">
</script>


@endsection