@extends('layouts.plantillabase')
@section('contenido')
<div class="row">
    <div class="col-md">
        <div class="col-md">
            <a type="button" class="btn btn-circle colorQA" href="{{route('novedadesdosimetria.search')}}">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-arrow-left mt-1" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                </svg>
            </a>
        </div> 
    </div>
    <div class="col-7">
        <h2 class="text-center">DETALLE DE NOVEDAD DOSIMETRÍA  <br> <i>{{$contdosisededepto->contratodosimetriasede->sede->empresa->nombre_empresa}}</i>- SEDE: <i>{{$contdosisededepto->contratodosimetriasede->sede->nombre_sede}}</i></h2>
        <h3 class="text-center">ESPECIALIDAD: <i>{{$contdosisededepto->departamentosede->departamento->nombre_departamento}}</i> </h3>
        <br>
        <h4 class="text-center" id="id_contrato"></h4>
    </div>
    <div class="col md"></div>
</div>
<br>
<br>

<br>
<div class="row">
    <div class="col-md"></div>
    <div class="col-md-12">
        <div class="table table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr class="table-active text-center">
                        <th class='align-middle' style='width: 2.0%'>MES ASIGNACIÓN</th>
                        <th class='align-middle' style='width: 5.0%'>FECHA</th>
                        <th class='align-middle' style='width: 10.0%'>TRABAJADOR</th>
                        <th class='align-middle' style='width: 2.90%'>N. IDEN.</th>
                        <th class='align-middle' style='width: 2.90%'>DOSÍMETRO</th>
                        <th class='align-middle' style='width: 2.90%'>HOLDER</th>
                        <th class='align-middle' style='width: 2.90%'>OCUPACIÓN</th>
                        <th class='align-middle' style='width: 4.90%'>UBICACIÓN</th>
                        <th class='align-middle' style='width: 8.90%'>OBSERVACIÓN</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($novedad as $nov)
                        <td class='align-middle text-center' id="mes{{$nov->mes_asignacion}}">{{$nov->mes_asignacion}}</td>
                        <td class='align-middle text-center'>{{$nov->created_at}}</td>
                        <td class='align-middle text-center'>{{$nov->trabajadordosimetro->persona->primer_nombre_persona}} {{$nov->trabajadordosimetro->persona->segundo_nombre_persona}} {{$nov->trabajadordosimetro->persona->primer_apellido_persona}} {{$nov->trabajadordosimetro->persona->segundo_apellido_persona}}</td>
                        <td class='align-middle text-center'>{{$nov->trabajadordosimetro->persona->cedula_persona}}</td>
                        <td class='align-middle text-center'>@if($nov->trabajadordosimetro->dosimetro_id == null) @else {{$nov->trabajadordosimetro->dosimetro->codigo_dosimetro}} @endif </td>
                        <td class='align-middle text-center'>@if($nov->trabajadordosimetro->holder_id == null) @else {{$nov->trabajadordosimetro->holder->codigo_holder}} @endif</td>
                        <td class='align-middle text-center'>@if($nov->trabajadordosimetro->ocupacion == null) @else {{$nov->trabajadordosimetro->ocupacion}} @endif</td>
                        <td class='align-middle text-center'>@if($nov->trabajadordosimetro->ubicacion == null) @else {{$nov->trabajadordosimetro->ubicacion}} @endif</td>
                        <td class='align-middle text-center'>{{$nov->nota_cambiodosim}}</td>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-md"></div>
</div>
<script
src="https://code.jquery.com/jquery-3.6.0.js"
integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
crossorigin="anonymous">
</script>
<script type="text/javascript">
    $(document).ready(function(){
        var TDcontrato = document.getElementById("id_contrato");
        var num = parseInt('{{$contdosisededepto->contratodosimetriasede->dosimetriacontrato->codigo_contrato}}');
        var n = num.toString().padStart(5,'0');
        console.log("ESTE ES EL CODIGO" +n);
           
        TDcontrato.innerHTML = "CONTRATO No."+n;
        

        
    })
    function fechaMesasig(){

    }
</script>

@endsection()
