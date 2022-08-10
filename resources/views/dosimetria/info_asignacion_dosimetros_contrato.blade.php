@extends('layouts.plantillabase')
@section('contenido')

<div class="row">
    <div class="col-md">
        <a type="button" class="btn btn-circle colorQA" href="{{route('detallesedecont.create', $contdosisededepto->id_contdosisededepto)}}">
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-arrow-left mt-1" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
            </svg>
        </a>
    </div>
    <div class="col-md">
        <h2 class="text-center">DOSIMETRÍA DE <br> <i>{{$contdosisededepto->contratodosimetriasede->sede->empresa->nombre_empresa}} - SEDE: {{$contdosisededepto->contratodosimetriasede->sede->nombre_sede}}</i> </h2>
    </div>
    <div class="col-md"></div>
</div>
<br>
<h4 class="text-center">CONTRATO No. {{$contdosisededepto->contratodosimetriasede->dosimetriacontrato->codigo_contrato}} <br> <h5 class="text-center">ESPECIALIDAD: {{$contdosisededepto->departamentosede->nombre_departamento}}</h5></h4>
<br>
{{--<div class="row g-2 mx-3">
    <div class="col-md">
        <div class="table table-responsive">
             <table class="table table-sm table-bordered">
                <thead>

                    <tr class="text-center">
                        <th>DOSíMETROS</th>
                        <th>CONTRATADOS</th>
                        <th>ASIGNADOS</th>
                        <th>PENDIENTES</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>C. ENTERO:</th>
                        <td class="text-center">{{$contdosisededepto->dosi_cuerpo_entero}}</td>
                        <td class="text-center">{{$DosiCuerpoAsignados}}</td>
                        <td class="text-center">{{$contdosisededepto->dosi_cuerpo_entero - $DosiCuerpoAsignados}}</td>
                    </tr>
                    <tr>
                        <th>AMBIENTE:</th>
                        <td class="text-center">{{$contdosisededepto->dosi_ambiental}}</td>
                        <td class="text-center"></td>
                        <td class="text-center"></td>
                    </tr>
                    <tr>
                        <th>CONTROL:</th>
                        <td class="text-center">{{$contdosisededepto->dosi_control}}</td>
                        <td class="text-center">{{$DosiControlAsignados}}</td>
                        <td class="text-center">{{$contdosisededepto->dosi_control - $DosiControlAsignados}}</td>
                    </tr>
                    <tr>
                        <th>EzCLIP:</th>
                        <td class="text-center">{{$contdosisededepto->dosi_ezclip}}</td>
                        <td class="text-center">{{$DosiEzclipAsignados}}</td>
                        <td class="text-center">{{$contdosisededepto->dosi_ezclip - $DosiEzclipAsignados}}</td>
                    </tr>
                </tbody>
            </table> 
        </div>
    </div>
</div>--}}

{{-- -------------ALERTAS QUE INDICAN SI FALTAN DOSIMETROS POR ASIGNAR--------------}}
{{-- <div class="row">
    <div class="col-md"></div>
    <div class="col-md-5">
        @if($mescontdosisededepto->mes_asignacion == $mesnumber || $mescontdosisededepto->mes_asignacion <= $mesnumber)
            @if($mescontdosisededepto->dosi_torax - $DosiToraxAsignados != 0)
                <div class="alert alert-warning text-center" role="alert">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                    </svg>  <b> FALTA POR ASIGNAR {{$mescontdosisededepto->dosi_torax - $DosiToraxAsignados}} DOSÍMETROS DE UBICACIÓN TÓRAX!!</b>
                </div>
            @endif
            @if($mescontdosisededepto->dosi_control - $DosiControlAsignados != 0)
                <div class="alert alert-warning text-center" role="alert">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                    </svg>  <b> FALTA POR ASIGNAR {{$mescontdosisededepto->dosi_control - $DosiControlAsignados}} DOSÍMETROS DE UBICACIÓN CONTROL!!</b>
                </div>
            @endif
            @if($mescontdosisededepto->dosi_cristalino - $DosiCristalinoAsignados != 0)
                <div class="alert alert-warning text-center" role="alert">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                    </svg>  <b> FALTA POR ASIGNAR {{$mescontdosisededepto->dosi_cristalino - $DosiCristalinoAsignados}} DOSÍMETROS DE UBICACIÓN CRISTALINO!!</b>
                </div>
            @endif
            @if($mescontdosisededepto->dosi_muñeca - $DosiMuñecaAsignados != 0)
                <div class="alert alert-warning text-center" role="alert">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                    </svg>  <b> FALTA POR ASIGNAR {{$mescontdosisededepto->dosi_muñeca - $DosiMuñecaAsignados}} DOSÍMETROS DE UBICACIÓN MUÑECA!!</b>
                </div>
            @endif
            @if($mescontdosisededepto->dosi_dedo - $DosiDedoAsignados != 0)
                <div class="alert alert-warning text-center" role="alert">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                    </svg>  <b> FALTA POR ASIGNAR {{$mescontdosisededepto->dosi_dedo - $DosiDedoAsignados}} DOSÍMETROS DE UBICACIÓN DEDO!!</b>
                </div>
            @endif
        @else
            @if($contdosisededepto->dosi_torax - $DosiToraxAsignados != 0)
                <div class="alert alert-warning text-center" role="alert">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                    </svg>  <b> FALTA POR ASIGNAR {{$contdosisededepto->dosi_torax - $DosiToraxAsignados}} DOSÍMETROS DE UBICACIÓN TÓRAX!!</b>
                </div>
            @endif
            @if($contdosisededepto->dosi_control - $DosiControlAsignados != 0)
                <div class="alert alert-warning text-center" role="alert">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                    </svg>  <b> FALTA POR ASIGNAR {{$contdosisededepto->dosi_control - $DosiControlAsignados}} DOSÍMETROS DE UBICACIÓN CONTROL!!</b>
                </div>
            @endif
            @if($contdosisededepto->dosi_cristalino - $DosiCristalinoAsignados != 0)
                <div class="alert alert-warning text-center" role="alert">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                    </svg>  <b> FALTA POR ASIGNAR {{$contdosisededepto->dosi_cristalino - $DosiCristalinoAsignados}} DOSÍMETROS DE UBICACIÓN CRISTALINO!!</b>
                </div>
            @endif
            @if($contdosisededepto->dosi_muñeca - $DosiMuñecaAsignados != 0)
                <div class="alert alert-warning text-center" role="alert">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                    </svg>  <b> FALTA POR ASIGNAR {{$contdosisededepto->dosi_muñeca - $DosiMuñecaAsignados}} DOSÍMETROS DE UBICACIÓN MUÑECA!!</b>
                </div>
            @endif
            @if($contdosisededepto->dosi_dedo - $DosiDedoAsignados != 0)    
                <div class="alert alert-warning text-center" role="alert">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                    </svg>  <b> FALTA POR ASIGNAR {{$contdosisededepto->dosi_dedo - $DosiDedoAsignados}} DOSÍMETROS DE UBICACIÓN DEDO!!</b>
                </div>
            @endif
        @endif
        
        
    </div>
    <div class="col-md"></div>
</div> --}}
{{-- <div class="row">
    <div class="col-md"></div>
    <div class="col-md text-center">
        
            <button type="submit" class="btn colorQA" data-bs-toggle="modal" data-bs-target="#nuevaAsignacionModal" autofocus>
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-arrow-bar-right" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M6 8a.5.5 0 0 0 .5.5h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L12.293 7.5H6.5A.5.5 0 0 0 6 8zm-2.5 7a.5.5 0 0 1-.5-.5v-13a.5.5 0 0 1 1 0v13a.5.5 0 0 1-.5.5z"/>
                </svg>  ASIGNAR FALTANTES
            </button>
        
    </div>
    <div class="col-md"></div>
</div> --}}


<br>
<h3 class="text-center">
    TRABAJADORES ASIGNADOS AL MES {{ Request()->mesnumber  }} (
        @if(Request()->mesnumber == 1)
            @php
                $meses = ["01"=>'ENERO', "02"=>'FEBRERO', "03"=>'MARZO', "04"=>'ABRIL', "05"=>'MAYO', "06"=>'JUNIO', "07"=>'JULIO', "08"=>'AGOSTO', "09"=>'SEPTIEMBRE', "10"=>'OCTUBRE', "11"=>'NOVIEMBRE', "12"=>'DICIEMBRE'];
                echo $meses[date("m", strtotime($contdosisededepto->contratodosimetriasede->dosimetriacontrato->fecha_inicio))]." DE ".date("Y", strtotime($contdosisededepto->contratodosimetriasede->dosimetriacontrato->fecha_inicio)) ;
            @endphp
        @else
            <span id="mes{{Request()->mesnumber}}">{{-- {{date("d-m-Y",strtotime($contdosisededepto->contratodosimetriasede->dosimetriacontrato->fecha_inicio."+ ".(30*(Request()->mesnumber-1))." days" ))}} --}}</span>
        @endif 
    )
</h3>
<br>

{{-- ///////ALERTAS AMARILLAS QUE ESTABAN DUPLICADAS////////// --}}

{{-- <div class="row">
    <div class="col-md"></div>
    <div class="col-md-5">
        @if($dosicontrolasig->isEmpty())
            <div class="alert alert-warning text-center" role="alert">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-exclamation-triangle" viewBox="0 0 16 16">
                    <path d="M7.938 2.016A.13.13 0 0 1 8.002 2a.13.13 0 0 1 .063.016.146.146 0 0 1 .054.057l6.857 11.667c.036.06.035.124.002.183a.163.163 0 0 1-.054.06.116.116 0 0 1-.066.017H1.146a.115.115 0 0 1-.066-.017.163.163 0 0 1-.054-.06.176.176 0 0 1 .002-.183L7.884 2.073a.147.147 0 0 1 .054-.057zm1.044-.45a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566z"/>
                    <path d="M7.002 12a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 5.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995z"/>
                  </svg> <b> NO HAY DOSÍMETRO DE CONTROL ASIGNADO !!</b>
            </div>
        @endif
        @if($trabjasignados->isEmpty())
            <div class="alert alert-warning text-center" role="alert">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-exclamation-triangle" viewBox="0 0 16 16">
                    <path d="M7.938 2.016A.13.13 0 0 1 8.002 2a.13.13 0 0 1 .063.016.146.146 0 0 1 .054.057l6.857 11.667c.036.06.035.124.002.183a.163.163 0 0 1-.054.06.116.116 0 0 1-.066.017H1.146a.115.115 0 0 1-.066-.017.163.163 0 0 1-.054-.06.176.176 0 0 1 .002-.183L7.884 2.073a.147.147 0 0 1 .054-.057zm1.044-.45a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566z"/>
                    <path d="M7.002 12a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 5.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995z"/>
                </svg> <b> NO HAY TRABAJADORES ASIGNADOS !!</b>
            </div>
        @endif
    </div>
    <div class="col-md"></div>
</div> --}}


@if(count($trabjasignados)>0 || count($dosicontrolasig)>0)
    <form id="edit_fecha_contasig" name="edit_fecha_contasig" action="{{route('asignadosicontrato.updatefechas', ['id'=>$contdosisededepto->id_contdosisededepto, 'mesnumber'=> Request()->mesnumber])}}" method="POST">
        @csrf
        @method('put')
        <div class="row g-2 mx-3">
            <div class="col-md">
                <div class="form-floating">
                    <input value="{{$trabjasignados->isEmpty() ? $dosicontrolasig[0]->fecha_dosim_enviado : $trabjasignados[0]->fecha_dosim_enviado}}" type="date" class="form-control" name="fecha_envio_dosim_asignado" id="fecha_envio_dosim_asignado" >
                    <label for="floatingInputGrid">FECHA ENVIO</label>
                </div>
            </div>
            <div class="col-md">
                <div class="form-floating">
                    <input value="{{$trabjasignados->isEmpty() ? $dosicontrolasig[0]->fecha_dosim_recibido : $trabjasignados[0]->fecha_dosim_recibido}}" type="date" class="form-control" name="fecha_recibido_dosim_asignado" id="fecha_recibido_dosim_asignado" >
                    <label for="floatingInputGrid">FECHA RECIBIDO</label>
                </div>
            </div>
            <div class="col-md">
                <div class="form-floating">
                    <input value="{{$trabjasignados->isEmpty() ? $dosicontrolasig[0]->fecha_dosim_devuelto : $trabjasignados[0]->fecha_dosim_devuelto}}" type="date" class="form-control" name="fecha_devuelto_dosim_asignado" id="fecha_devuelto_dosim_asignado" >
                    <label for="floatingInputGrid">FECHA DEVUELTO</label>
                </div>
            </div>
        </div>
        <br>
        <br>
        <div class="row">
            <div class="col-md"></div>
            <div class="col-md text-center">
                <button type="submit" class="btn colorQA" style="width: 200px">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill mb-1" viewBox="0 0 16 16">
                        <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                    </svg> EDITAR FECHAS
                </button>
            </div>
            {{-- <div class="col-md text-center">
                <button type="submit" class="btn colorQA">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-arrow-bar-right" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M6 8a.5.5 0 0 0 .5.5h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L12.293 7.5H6.5A.5.5 0 0 0 6 8zm-2.5 7a.5.5 0 0 1-.5-.5v-13a.5.5 0 0 1 1 0v13a.5.5 0 0 1-.5.5z"/>
                    </svg>  ASIGNAR FALTANTES
                </button>
            </div> --}}
            <div class="col-md"></div>
        </div>
    </form>
@endif
<br>
<br>
<div class="row">
    <div class="col"></div>
    <div class="col-13">
        <div class="table table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr class="table-active text-center">
                        <th class='align-middle' >TRABAJADOR</th>
                        <th class='align-middle' style='width: 5.90%'>N. IDEN.</th>
                        <th class='align-middle' style='width: 7.90%'>DOSÍM.</th>
                        <th class='align-middle' style='width: 5.90%'>HOLDER</th>
                        <th class='align-middle' style='width: 3.90%'>OCUP.</th>
                        <th class='align-middle' style='width: 7.70%'>UBICACIÓN</th>
                        <th class='align-middle' style='width: 5.70%'>Hp(10)</th>
                        <th class='align-middle' style='width: 5.70%'>Hp(3)</th>
                        <th class='align-middle' style='width: 5.70%'>Hp(0.07)</th>
                        <th class='align-middle' style='width: 4.90%'>EZCLIP</th>
                        <th class='align-middle' style='width: 4.90%'>NOTAS</th>
                        <th class='align-middle' style='width: 21.90%'>ACCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    @if($dosicontrolasig->isEmpty())
                        
                        {{--@foreach($dosiareasignados as $dosiareasig)
                            <tr>
                                <td class='align-middle'>{{$dosiareasig->areadepartamentosede->nombre_area}}</td>
                                <td class='align-middle'>N.A.</td>
                                <td class='align-middle'>{{$dosiareasig->dosimetro->codigo_dosimeter}}</td>
                                <td class='align-middle'>N.A.</td>
                                <td class='align-middle'>{{$dosiareasig->ocupacion}}</td>
                                <td class='align-middle'>ÁREA</td>
                                <td class='align-middle'>{{$dosiareasig->measurement_date}}</td>
                                <td class='align-middle'>{{$dosiareasig->verification_date}}</td>
                                <td class='align-middle'>{{$dosiareasig->verification_required_on_or_before}}</td>
                                <td class='align-middle'>{{$dosiareasig->remaining_days_available_for_use}}</td>
                                <td class='align-middle'>
                                    @for($i=1; $i<=5; $i++)
                                        @if($dosiareasig->{"nota$i"} == 'TRUE')
                                            {{$i}})
                                        @endif 
                                    @endfor
                                    @if($dosiareasig->DNL == 'TRUE')
                                        {{'DNL'}}
                                    @endif
                                </td>
                                <td>
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md p-1">
                                                <a href="{{route('lecturadosiarea.create', $dosiareasig->id_dosiareacontdosisedes)}}" class="btn colorQA btn-sm">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-card-checklist" viewBox="0 0 16 16">
                                                    <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                                                    <path d="M7 5.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0zM7 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0z"/>
                                                    </svg><br> LECTURA
                                                </a>
                                            </div>
                                            <div class="col-md p-1">
                                                <form id="form_eliminar_asigcontrol" name="form_eliminar_asigcontrol" action="" method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="btn btn-danger btn-sm" type="submit">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                                        </svg> <br> ELIMINAR
                                                    </button>
                                                </form>
                                            </div>
                                            <div class="col p-1 text-center">
                                                <a href="" class="btn colorQA btn-sm">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                                        <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                                    </svg> <br> EDITAR
                                                </a>
                                            </div>
                                        </div>  
                                    </div>
                                </td>
                            </tr>
                        @endforeach --}}
                        @foreach($trabjasignados as $trabasig)
                            <tr id='{{$trabasig->id_trabajadordosimetro}}'>
                                <td class='align-middle'>@if(!empty($trabasig->trabajador->primer_nombre_trabajador)){{$trabasig->trabajador->primer_nombre_trabajador}} {{$trabasig->trabajador->segundo_nombre_trabajador}} {{$trabasig->trabajador->primer_apellido_trabajador}} {{$trabasig->trabajador->segundo_apellido_trabajador}}@endif </td>
                                <td class='align-middle'>@if(!empty($trabasig->trabajador->cedula_trabajador)) {{$trabasig->trabajador->cedula_trabajador}}@endif </td>
                                <td class='align-middle'>{{$trabasig->dosimetro->codigo_dosimeter}}</td>
                                <td class='align-middle'>
                                    @if($trabasig->holder_id == '')
                                        N.A.
                                    @else
                                        {{$trabasig->holder->codigo_holder}}
                                    @endif
                                </td>
                                <td class='align-middle'>{{$trabasig->ocupacion}}</td>
                                <td class='align-middle'>{{$trabasig->ubicacion}}</td>
                                <td class='align-middle'>
                                    @if($trabasig->nota2 == 'TRUE')
                                        {{'NP'}}
                                    @elseif($trabasig->DNL == 'TRUE')
                                        {{'DNL'}}
                                    @elseif($trabasig->EU == 'TRUE')
                                        {{'EU'}}
                                    @elseif($trabasig->DPL == 'TRUE')
                                        {{'DPL'}}
                                    @elseif($trabasig->DSU == 'TRUE')
                                        {{'DSU'}}
                                    @else
                                        {{$trabasig->Hp10_calc_dose}}
                                    @endif
                                </td>
                                <td class='align-middle'>
                                    @if($trabasig->nota2 == 'TRUE')
                                        {{'NP'}}
                                    @elseif($trabasig->DNL == 'TRUE')
                                        {{'DNL'}}
                                    @elseif($trabasig->EU == 'TRUE')
                                        {{'EU'}}
                                    @elseif($trabasig->DPL == 'TRUE')
                                        {{'DPL'}}
                                    @elseif($trabasig->DSU == 'TRUE')
                                        {{'DSU'}}
                                    @else
                                        {{$trabasig->Hp3_calc_dose}}
                                    @endif
                                </td>
                                <td class='align-middle'>
                                    @if($trabasig->nota2 == 'TRUE')
                                        {{'NP'}}
                                    @elseif($trabasig->DNL == 'TRUE')
                                        {{'DNL'}}
                                    @elseif($trabasig->EU == 'TRUE')
                                        {{'EU'}}
                                    @elseif($trabasig->DPL == 'TRUE')
                                        {{'DPL'}}
                                    @elseif($trabasig->DSU == 'TRUE')
                                        {{'DSU'}}
                                    @else
                                        {{$trabasig->Hp007_calc_dose}}
                                    @endif
                                </td>
                                <td class='align-middle'></td>
                                <td class='align-middle'>
                                    @for($i=1; $i<=6; $i++)
                                        @if($trabasig->{"nota$i"} == 'TRUE')
                                            {{$i}})
                                        @endif 
                                    @endfor
                                </td>
                                <td class='align-middle'>
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md p-1 ">
                                                <a href="{{route('lecturadosi.create', $trabasig->id_trabajadordosimetro )}}" class="btn colorQA btn-sm">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-card-checklist" viewBox="0 0 16 16">
                                                    <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                                                    <path d="M7 5.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0zM7 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0z"/>
                                                    </svg><br> LECTURA
                                                </a>
                                            </div>
                                            
                                            <div class="col-md p-1 ">
                                                <form id="form_eliminar_trabajadorasig" name="form_eliminar_trabajadorasig" class="form_eliminar_trabajadorasig" action="{{route('asigdosicont.destroyInfoTrabajador', $trabasig->id_trabajadordosimetro)}}" method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="btn btn-danger btn-sm" type="submit">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                                        </svg> <br> ELIMINAR
                                                    </button>
                                                </form>
                                            </div>
                                            
                                            <div class="col p-1 text-center">
                                                <a href="{{route('lecturadosi.edit', $trabasig->id_trabajadordosimetro)}}" class="btn colorQA btn-sm">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                                        <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                                    </svg><br> EDITAR
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        @foreach($dosicontrolasig as $dosicontasig)
                            <tr id="{{$dosicontasig->id_dosicontrolcontdosisedes}}">
                                <td class='align-middle'>CONTROL</td>
                                <td class='align-middle'>N.A.</td>
                                <td class='align-middle'>{{$dosicontasig->dosimetro->codigo_dosimeter}}</td>
                                <td class='align-middle'>N.A.</td>
                                <td class='align-middle'>{{$dosicontasig->ocupacion}}</td>
                                <td class='align-middle'>CONTROL</td>
                                <td class='align-middle'>
                                    @if($dosicontasig->nota2 == 'TRUE')
                                        {{'NP'}}
                                    @elseif($dosicontasig->DNL == 'TRUE')
                                        {{'DNL'}}
                                    @elseif($dosicontasig->EU == 'TRUE')
                                        {{'EU'}}
                                    @elseif($dosicontasig->DPL == 'TRUE')
                                        {{'DPL'}}
                                    @elseif($dosicontasig->DSU == 'TRUE')
                                        {{'DSU'}}
                                    @else
                                        {{$dosicontasig->Hp10_calc_dose}}
                                    @endif
                                </td>
                                <td class='align-middle'>
                                    @if($dosicontasig->nota2 == 'TRUE')
                                        {{'NP'}}
                                    @elseif($dosicontasig->DNL == 'TRUE')
                                        {{'DNL'}}
                                    @elseif($dosicontasig->EU == 'TRUE')
                                        {{'EU'}}
                                    @elseif($dosicontasig->DPL == 'TRUE')
                                        {{'DPL'}}
                                    @elseif($dosicontasig->DSU == 'TRUE')
                                        {{'DSU'}}
                                    @else
                                        {{$dosicontasig->Hp3_calc_dose}}
                                    @endif
                                </td>
                                <td class='align-middle'>
                                    @if($dosicontasig->nota2 == 'TRUE')
                                        {{'NP'}}
                                    @elseif($dosicontasig->DNL == 'TRUE')
                                        {{'DNL'}}
                                    @elseif($dosicontasig->EU == 'TRUE')
                                        {{'EU'}}
                                    @elseif($dosicontasig->DPL == 'TRUE')
                                        {{'DPL'}}
                                    @elseif($dosicontasig->DSU == 'TRUE')
                                        {{'DSU'}}
                                    @else
                                        {{$dosicontasig->Hp007_calc_dose}}
                                    @endif
                                </td>
                                <td class='align-middle'></td>
                                <td class='align-middle'>
                                    @for($i=1; $i<=6; $i++)
                                        @if($dosicontasig->{"nota$i"} == 'TRUE')
                                            {{$i}})
                                        @endif 
                                    @endfor
                                </td>
                                <td>
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md p-1">
                                                <a href="{{route('lecturadosicontrol.create', $dosicontasig->id_dosicontrolcontdosisedes)}}" class="btn colorQA btn-sm">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-card-checklist" viewBox="0 0 16 16">
                                                    <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                                                    <path d="M7 5.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0zM7 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0z"/>
                                                    </svg><br> LECTURA
                                                </a> 
                                            </div>
                                            <div class="col-md p-1">
                                                <form id="form_eliminar_asigcontrol" name="form_eliminar_asigcontrol" action="{{route('asigdosicont.destroyInfoControl',  $dosicontasig->id_dosicontrolcontdosisedes)}}" method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="btn btn-danger btn-sm" type="submit">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                                        </svg> <br> ELIMINAR
                                                    </button>
                                                </form>
                                            </div>
                                            <div class="col p-1 text-center">
                                                <a href="{{route('lecturadosicontrol.edit', $dosicontasig->id_dosicontrolcontdosisedes)}}" class="btn colorQA btn-sm">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                                        <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                                    </svg> <br> EDITAR
                                                </a>
                                            </div>
                                        </div>  
                                    </div>
                                </td>
                            </tr>
                            {{--@foreach($dosiareasignados as $dosiareasig)
                                <tr>
                                    <td class='align-middle'>{{$dosiareasig->areadepartamentosede->nombre_area}}</td>
                                    <td class='align-middle'>N.A.</td>
                                    <td class='align-middle'>{{$dosiareasig->dosimetro->codigo_dosimeter}}</td>
                                    <td class='align-middle'>N.A.</td>
                                    <td class='align-middle'>{{$dosiareasig->ocupacion}}</td>
                                    <td class='align-middle'>ÁREA</td>
                                    <td class='align-middle'>{{$dosiareasig->measurement_date}}</td>
                                    <td class='align-middle'>{{$dosiareasig->verification_date}}</td>
                                    <td class='align-middle'>{{$dosiareasig->verification_required_on_or_before}}</td>
                                    <td class='align-middle'>{{$dosiareasig->remaining_days_available_for_use}}</td>
                                    <td class='align-middle'>
                                        @for($i=1; $i<=5; $i++)
                                            @if($dosiareasig->{"nota$i"} == 'TRUE')
                                                {{$i}})
                                            @endif 
                                        @endfor
                                        @if($dosiareasig->DNL == 'TRUE')
                                            {{'DNL'}}
                                        @endif
                                    </td>
                                    <td>
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md p-1">
                                                    <a href="{{route('lecturadosiarea.create', $dosiareasig->id_dosiareacontdosisedes)}}" class="btn colorQA btn-sm">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-card-checklist" viewBox="0 0 16 16">
                                                        <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                                                        <path d="M7 5.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0zM7 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0z"/>
                                                        </svg><br> LECTURA
                                                    </a>
                                                </div>
                                                <div class="col-md p-1">
                                                    <form id="form_eliminar_asigcontrol" name="form_eliminar_asigcontrol" action="" method="POST">
                                                        @csrf
                                                        @method('delete')
                                                        <button class="btn btn-danger btn-sm" type="submit">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                                            </svg> <br> ELIMINAR
                                                        </button>
                                                    </form>
                                                </div>
                                                <div class="col p-1 text-center">
                                                    <a href="" class="btn colorQA btn-sm">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                                            <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                                        </svg> <br> EDITAR
                                                    </a>
                                                </div>
                                            </div>  
                                        </div>
                                    </td>
                                </tr>
                            @endforeach --}}
                            @foreach($trabjasignados as $trabasig)
                                <tr id='{{$trabasig->id_trabajadordosimetro}}'>
                                    <td class='align-middle'>@if(!empty($trabasig->trabajador->primer_nombre_trabajador)){{$trabasig->trabajador->primer_nombre_trabajador}} {{$trabasig->trabajador->segundo_nombre_trabajador}} {{$trabasig->trabajador->primer_apellido_trabajador}} {{$trabasig->trabajador->segundo_apellido_trabajador}}@endif </td>
                                    <td class='align-middle'>@if(!empty($trabasig->trabajador->cedula_trabajador)) {{$trabasig->trabajador->cedula_trabajador}}@endif </td>
                                    <td class='align-middle'>{{$trabasig->dosimetro->codigo_dosimeter}}</td>
                                    <td class='align-middle'>
                                        @if($trabasig->holder_id == '')
                                            N.A.
                                        @else
                                            {{$trabasig->holder->codigo_holder}}
                                        @endif
                                    </td>
                                    <td class='align-middle'>{{$trabasig->ocupacion}}</td>
                                    <td class='align-middle'>{{$trabasig->ubicacion}}</td>
                                    
                                    <td class='align-middle'>
                                        @if($trabasig->nota2 == 'TRUE')
                                            {{'NP'}}
                                        @elseif($trabasig->DNL == 'TRUE')
                                            {{'DNL'}}
                                        @elseif($trabasig->EU == 'TRUE')
                                            {{'EU'}}
                                        @elseif($trabasig->DPL == 'TRUE')
                                            {{'DPL'}}
                                        @elseif($trabasig->DSU == 'TRUE')
                                            {{'DSU'}}
                                        @else
                                            {{$trabasig->Hp10_calc_dose}}
                                        @endif
                                    </td>
                                    <td class='align-middle'>
                                        @if($trabasig->nota2 == 'TRUE')
                                            {{'NP'}}
                                        @elseif($trabasig->DNL == 'TRUE')
                                            {{'DNL'}}
                                        @elseif($trabasig->EU == 'TRUE')
                                            {{'EU'}}
                                        @elseif($trabasig->DPL == 'TRUE')
                                            {{'DPL'}}
                                        @elseif($trabasig->DSU == 'TRUE')
                                            {{'DSU'}}
                                        @else
                                            {{$trabasig->Hp3_calc_dose}}
                                        @endif
                                    </td>
                                    <td class='align-middle'>
                                        @if($trabasig->nota2 == 'TRUE')
                                            {{'NP'}}
                                        @elseif($trabasig->DNL == 'TRUE')
                                            {{'DNL'}}
                                        @elseif($trabasig->EU == 'TRUE')
                                            {{'EU'}}
                                        @elseif($trabasig->DPL == 'TRUE')
                                            {{'DPL'}}
                                        @elseif($trabasig->DSU == 'TRUE')
                                            {{'DSU'}}
                                        @else
                                            {{$trabasig->Hp007_calc_dose}}
                                        @endif
                                    </td>
                                    <td class='align-middle'></td>
                                    <td class='align-middle'>
                                        @for($i=1; $i<=6; $i++)
                                            @if($trabasig->{"nota$i"} == 'TRUE')
                                                {{$i}})
                                            @endif 
                                        @endfor
                                    </td>
                                    <td class='align-middle'>
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md p-1 ">
                                                    <a href="{{route('lecturadosicontrl.create', ['lecdosi'=>$trabasig->id_trabajadordosimetro, 'lecdosicontrol'=>$dosicontasig->id_dosicontrolcontdosisedes])}}" class="btn colorQA btn-sm">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-card-checklist" viewBox="0 0 16 16">
                                                        <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                                                        <path d="M7 5.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0zM7 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0z"/>
                                                        </svg><br> LECTURA
                                                    </a>
                                                </div>
                                                
                                                <div class="col-md p-1 ">
                                                    <form id="form_eliminar_trabajadorasig" name="form_eliminar_trabajadorasig" class="form_eliminar_trabajadorasig" action="{{route('asigdosicont.destroyInfoTrabajador', $trabasig->id_trabajadordosimetro)}}" method="POST">
                                                        @csrf
                                                        @method('delete')
                                                        <button class="btn btn-danger btn-sm" type="submit">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                                            </svg> <br> ELIMINAR
                                                        </button>
                                                    </form>
                                                </div>
                                                
                                                <div class="col p-1 text-center">
                                                    <a href="{{route('lecturadosi.edit', $trabasig->id_trabajadordosimetro)}}" class="btn colorQA btn-sm">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                                            <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                                        </svg><br> EDITAR
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    <div class="col"></div>
    
</div>
<br>
<br>
<div class="row">
    <div class="col-md"></div>
    <div class="col-md-8 ">
        <div class="alert alert-info" role="alert">
            <h4 class="alert-heading"> <b>OBSERVACIONES:</b> </h4>
            @php
                $nota3 = 'vacio';
                $nota5 = 'vacio';
                $nota6 = 'vacio';
            @endphp
            @foreach($trabjasignados as $trabasig)
                @php
                    if($trabasig->nota3 == 'TRUE' &&  $trabasig->nota3 != $nota3){
                        echo "<p>- SE RECOMIENDA REVISAR EL LIMITE DE LAS DOSIS PERMITIDAS</p>";
                        $nota3 = $trabasig->nota3;
                    }
                    if($trabasig->nota5 == 'TRUE' && $trabasig->nota5 != $nota5){
                        echo "<p>- CONTROL NO UTILIZADO EN LA EVALUACIÓN</p>";
                        $nota5 = $trabasig->nota5;
                    }
                    if($trabasig->nota6 == 'TRUE' &&  $trabasig->nota6 != $nota6){
                        echo "<p>-  DOSÍMETRO CONTAMINADO CON MATERIAL RADIOACTIVO SE RECOMIENDA HACER INVESTIGACIÓN</p>";
                        $nota6 = $trabasig->nota6;  
                    }

                @endphp
            @endforeach
            @if(!empty($observacionesDelMes))
                @foreach($observacionesDelMes as $observaciones)
                    @if($observaciones->nota_cambiodosim != null)
                        <p>- {{$observaciones->nota_cambiodosim}}</p>
                    @endif
                @endforeach
            @endif
            <br>
            <div class="row">
                <div class="col-md"></div>
                <div class="col-md d-grid gap-2">
                    <button type="button" class="btn colorQA" data-bs-toggle="modal" data-bs-target="#nueva_observacionModal" >NUEVA OBSERVACIÓN</button>
                    <div class="modal fade" id="nueva_observacionModal" tabindex="-1" aria-labelledby="nueva_observacionModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title w-100 text-center" id="nueva_observacionModalLabel">NUEVA OBSERVACIÓN</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{route('asigdosicont.saveObservacionMesAsigdosim')}}" method="POST" id="form_crear_observacionmes" name="form_crear_observacionmes" class="form_crear_observacionmes">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="col-md">
                                            <label class="text-center">INGRESE LAS OBSERVACIONES O NOTAS PERTINENTES AL MES:</label>
                                            <textarea class="form-control" name="nota_cambio_dosimetros" id="nota_cambio_dosimetros" rows="3" autofocus style="text-transform:uppercase"></textarea> 
                                            <input type="number" hidden value="{{$mesnumber}}" name="mesnumber" id="mesnumber">
                                            <input type="number" hidden value="{{$contdosisededepto->id_contdosisededepto}}" name="id_contdosisededepto" id="id_contdosisededepto">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">CANCELAR</button>
                                        <button type="submit" class="btn colorQA"  data-bs-dismiss="modal" >GUARDAR</button>
                                    </div>
                                </form>
                            </div> 
                        </div>
                    </div>
                </div>
                <div class="col-md"></div>
            </div>

        </div>
    </div>
    <div class="col-md"></div>
</div>



<script
src="https://code.jquery.com/jquery-3.6.0.js"
integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
crossorigin="anonymous">
</script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if(session('actualizar')== 'ok')
    <script>
        Swal.fire(
        'ACTUALIZADO!',
        'SE HA ACTUALIZADO LA LECTURA DEL DOSÍMETRO CON ÉXITO.',
        'success'
        )
    </script>
@endif

@if(session('eliminar')== 'ok')
    <script>
        Swal.fire(
        'ELIMINADO!',
        'SE HA ELIMINADO CON ÉXITO.',
        'success'
        )
    </script>
@endif
@if(session('actualizado')== 'ok')
    <script>
        Swal.fire(
        'ACTUALIZADO!',
        'SE HA ACTUALIZADO CON ÉXITO.',
        'success'
        )
    </script>
@endif
@if(session('crear')== 'ok')
    <script>
        Swal.fire(
        'GUARDADO!',
        'SE HA GUARDADO CON ÉXITO.',
        'success'
        )
    </script>
@endif

<script type="text/javascript">
    $(document).ready(function(){

        $('#form_eliminar_asigcontrol').submit(function(e){
            e.preventDefault();
            Swal.fire({
                text: "SEGURO QUE DESEA ELIMINAR ESTA ASIGNACIÓN DEL DOSÍMETRO DE CONTROL??",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#1A9980',
                cancelButtonColor: '#d33',
                confirmButtonText: 'SI, SEGURO!'
                }).then((result) => {
                if (result.isConfirmed) {
                   
                    this.submit();
                }
            })
        })

        $('.form_eliminar_trabajadorasig').submit(function(e){
            e.preventDefault();
            Swal.fire({
                text: "SEGURO QUE DESEA ELIMINAR ESTA ASIGNACIÓN??",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#1A9980',
                cancelButtonColor: '#d33',
                confirmButtonText: 'SI, SEGURO!'
                }).then((result) => {
                if (result.isConfirmed) {
                   
                    this.submit();
                }
            })
        })

        $('#edit_fecha_contasig').submit(function(e){
            e.preventDefault();
            Swal.fire({
                text: "SEGURO QUE DESEA ACTUALIZAR LAS FECHAS DE SEGUIMIENTO?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#1A9980',
                cancelButtonColor: '#d33',
                confirmButtonText: 'SI, SEGURO!'
                }).then((result) => {
                if (result.isConfirmed) {
                   
                    this.submit();
                }
            })
        })

        
    })
</script>

<script type="text/javascript">
    $(document).ready(function(){
        // Creamos array con los meses del año
        const meses = ['ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO', 'JULIO', 'AGOSTO', 'SEPTIEMBRE', 'OCTUBRE', 'NOVIEMBRE', 'DICIEMBRE'];
        let fecha = new Date("{{$contdosisededepto->contratodosimetriasede->dosimetriacontrato->fecha_inicio}}");
        /* fecha.setMinutes(fecha.getMinutes() + fecha.getTimezoneOffset()); */
        console.log(fecha);
        for($i=0; $i<=13; $i++){
            var r = new Date(new Date(fecha).setMonth(fecha.getMonth()+$i));
            var fechaesp = meses[r.getMonth()] + ' DE ' + r.getUTCFullYear();
            console.log(fechaesp); 
            if("{{ Request()->mesnumber}}" == $i){
                /* alert("NO SE SUPO"); */
            
                document.getElementById('mes{{ Request()->mesnumber}}').innerHTML = fechaesp;

            } 
        }
          
        var trab = [];
        var trabajadores = <?php echo json_encode($trabjasignados);  ?>;
        console.log(trabajadores);
        
        trabajadores.forEach(function(value, index) {
            trab[index] = value;
            console.log(trab[index]);
            if(trab[index].Hp3_calc_dose != 'NULL'){
                if(trab[index].ubicacion == 'CRISTALINO' && trab[index].Hp3_calc_dose >= 12.5){
                    alert('ALERTA ROJA CRISTALINO');
                    let trhp3 = document.getElementById(trab[index].id_trabajadordosimetro);
                    console.log("HP3"+trhp3);
                    trhp3.classList.add("trdosisroja");
                }
            }
            if(trab[index].Hp007_calc_dose != 'NULL'){
                if(trab[index].ubicacion == 'MUÑECA' && trab[index].Hp007_calc_dose >= 41.6){
                    alert('ALERTA ROJA MUÑECA');
                    let trhp007 = document.getElementById(trab[index].id_trabajadordosimetro);
                    trhp007.classList.add("trdosisroja");
                }
                if(trab[index].ubicacion == 'DEDO' && trab[index].Hp007_calc_dose >= 41.6){
                    alert('ALERTA ROJA DEDO');
                    let trhp007 = document.getElementById(trab[index].id_trabajadordosimetro);
                    trhp007.classList.add("trdosisroja");
                }
            } 
            if(trab[index].Hp10_calc_dose != 'NULL' ){
                if(trab[index].ubicacion == 'TORAX'  && trab[index].Hp10_calc_dose >= 1.67){
                    alert('ALERTA ROJA TORAX');
                    let trhp10 = document.getElementById(trab[index].id_trabajadordosimetro);
                    console.log("HP10"+trhp10);
                    trhp10.classList.add("trdosisroja");
                }
                if(trab[index].ubicacion == 'CASO'  && trab[index].Hp10_calc_dose >= 1.67){
                    alert('ALERTA ROJA CASO');
                    let trHP10 = document.getElementById(trab[index].id_trabajadordosimetro);
                    trHP10.classList.add("trdosisroja");
                }
            }           
                
            
        });
        
    })
</script>


@endsection
