@extends('layouts.app')
@extends('layouts.plantillabase')
@section('contenido')
<div class="row">
    <div class="col-md ">
        <a type="button" class="btn btn-circle colorQA" href="{{route('detallesedecont.create', $contdosisededepto->id_contdosisededepto)}}">
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-arrow-left mt-1" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
            </svg>
        </a>
    </div>
    <div class="col-md-8 ">
        <h2 class="text-center">REVISIÓN DE ENTRADA PARA DOSÍMETROS ASIGNADOS</h2>
        <h3 class="text-center"><i>{{$contdosisededepto->contratodosimetriasede->sede->empresa->nombre_empresa}} - SEDE: {{$contdosisededepto->contratodosimetriasede->sede->nombre_sede}}</i> <br>
            ESPECIALIDAD: {{$contdosisededepto->departamentosede->departamento->nombre_departamento}}
        </h3>
        <h3 class="text-center">    
            @if($mesnumber == 1)
                @if($contdosisededepto->contratodosimetriasede->dosimetriacontrato->periodo_recambio == 'MENS')
                    PERÍODO 1 (@php
                        $meses = ["01"=>'ENERO', "02"=>'FEBRERO', "03"=>'MARZO', "04"=>'ABRIL', "05"=>'MAYO', "06"=>'JUNIO', "07"=>'JULIO', "08"=>'AGOSTO', "09"=>'SEPTIEMBRE', "10"=>'OCTUBRE', "11"=>'NOVIEMBRE', "12"=>'DICIEMBRE'];
                        $inicio = $contdosisededepto->contratodosimetriasede->dosimetriacontrato->fecha_inicio;
                        $fin = date("t-m-Y",strtotime($inicio));
                        echo date("j", strtotime($inicio))." ".$meses[date("m", strtotime($inicio))]." DE ".date("Y", strtotime($inicio))." - ".date("t", strtotime($fin))." ".$meses[date("m", strtotime($fin))]." DE ".date("Y", strtotime($fin));
                    @endphp)
                @elseif($contdosisededepto->contratodosimetriasede->dosimetriacontrato->periodo_recambio == 'TRIMS')
                    PERÍODO 1 ( <span>
                        @php  
                            $meses = ["01"=>'ENERO', "02"=>'FEBRERO', "03"=>'MARZO', "04"=>'ABRIL', "05"=>'MAYO', "06"=>'JUNIO', "07"=>'JULIO', "08"=>'AGOSTO', "09"=>'SEPTIEMBRE', "10"=>'OCTUBRE', "11"=>'NOVIEMBRE', "12"=>'DICIEMBRE'];
                            $inicio = date($contdosisededepto->contratodosimetriasede->dosimetriacontrato->fecha_inicio);
                            $fecha1 = date("t-m-Y",strtotime($inicio));
                            $fecha2= date("t-m-Y",strtotime($fecha1."+ 2 month"));
                            echo date("j", strtotime($inicio))." ".$meses[date("m", strtotime($inicio))]." DE ".date("Y", strtotime($inicio))." - ".date("j", strtotime($fecha2))." ".$meses[date("m", strtotime($fecha2))]." DE ".date("Y", strtotime($fecha2))
                        @endphp
                    </span> )
                @elseif($contdosisededepto->contratodosimetriasede->dosimetriacontrato->periodo_recambio == 'BIMS')
                    PERÍODO 1 ( <span>
                        @php  
                            $meses = ["01"=>'ENERO', "02"=>'FEBRERO', "03"=>'MARZO', "04"=>'ABRIL', "05"=>'MAYO', "06"=>'JUNIO', "07"=>'JULIO', "08"=>'AGOSTO', "09"=>'SEPTIEMBRE', "10"=>'OCTUBRE', "11"=>'NOVIEMBRE', "12"=>'DICIEMBRE'];
                            $fecha1 = date($contdosisededepto->contratodosimetriasede->dosimetriacontrato->fecha_inicio);
                            $fecha2_total = date("t-m-Y",strtotime($fecha1."+ 1 month"));
                            echo date("j", strtotime($fecha1))." ".$meses[date("m", strtotime($fecha1))]." DE ".date("Y", strtotime($fecha1))." - ".date("j", strtotime($fecha2_total))." ".$meses[date("m", strtotime($fecha2_total))]." DE ".date("Y", strtotime($fecha2_total))
                        @endphp
                    </span> )
                @endif
            @else
                PERÍODO {{$mesnumber}} ( <span id="mes{{$mesnumber}}"></span> )  
            @endif
        </h3>
    </div>
    <div class="col-md "></div>
</div>
<br>
<br>

<div class="row">
    <div class="col-md"></div>
    <div class="col-md-5">
        <div class="card text-dark bg-light">
            <div class="row">
                <div class="col-md m-3">
                    <h6 class="pt-4 text-center">CÓDIGO DE LA ETIQUETA </h6>
                    <br>
                    <input class="form-control" type="text" name="codigo_etiqueta" id="codigo_etiqueta" placeholder="-DIGITE UN CODIGO-" autofocus >
                </div>
                <div class="col-md m-3">
                    <h6 class="pt-4 text-center">CÓDIGO DEL DOSÍMETRO </h6>
                    <br>
                    <input class="form-control" type="text" name="codigo_dosimetro" id="codigo_dosimetro" placeholder="-DIGITE UN CODIGO-" autofocus >
                </div>
            </div>
            
            <div class="row">
                <div class="col-md"></div>
                <div class="col-md-6 ">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="dosi_control" name="dosi_control" checked>
                        <label class="form-check-label" for="defaultCheck1">    
                            DOSIMETRO DE CONTROL
                        </label>
                    </div>
                </div>
                <div class="col-md"></div>
            </div>
            <div class="row">
                <div class="col-md"></div>
                <div class="col-md-6">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="dosi_ambiental" name="dosi_ambiental">
                        <label class="form-check-label" for="defaultCheck1">    
                            DOSIMETRO AMBIENTAL
                        </label>
                    </div>
                </div>
                <div class="col-md"></div>
            </div>
            <br>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-secondary text-bg-light">
            <div class="card-header text-center">
                <h6 class="card-title ">INFORMACIÓN DEL DOSÍMETRO</h6>
            </div>
            <div class="card-body p-2">
                <div class="table table-responsive m-0">
                    <table class="table table-sm">
                        <tbody>
                            <tr>
                                <td class="align-middle"><h6 class="text-end m-0">No. DOSÍMETRO :</h6></td>
                                <td class="align-middle"><label id="codigo_dosi"></label></td>
                            </tr>
                            <tr>
                                <td class="align-middle"><h6 class="text-end m-0">TIPO :</h6></td>
                                <td class="align-middle"><label id="tipo_dosi"></label></td>
                            </tr>
                            <tr>
                                <td class="align-middle"><h6 class="text-end m-0">TECNOLOGIA :</h6></td>
                                <td class="align-middle"><label id="tecnologia_dosi"></label></td>
                            </tr>
                            <tr>
                                <td class="align-middle"><h6 class="text-end m-0">ESTADO :</h6></td>
                                <td class="align-middle"><label id="estado_dosi"></label></td>
                            </tr>
                            <tr>
                                <td class="align-middle"><h6 class="text-end m-0">USO ACTUAL :</h6></td>
                                <td class="align-middle"><label id="uso_dosi"></label></td>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md text-center">
        
        <a type="button" class="btn btn-circle colorQA mt-5"  {{-- href="{{route('Reporterevisionentrada.pdf', [ 'empresa'=> 0, 'deptodosi' =>$contdosisededepto->id_contdosisededepto , 'mesnumber' => $mesnumber])}}" --}} onclick="alertCertificado('{{0}}', '{{$contdosisededepto->id_contdosisededepto}}', '{{$mesnumber}}', {{$dosicontrolasig}}, {{$trabjasignados}});" target="_blank">
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-file-earmark-pdf pt-1" viewBox="0 0 16 16">
                <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z"/>
                <path d="M4.603 14.087a.81.81 0 0 1-.438-.42c-.195-.388-.13-.776.08-1.102.198-.307.526-.568.897-.787a7.68 7.68 0 0 1 1.482-.645 19.697 19.697 0 0 0 1.062-2.227 7.269 7.269 0 0 1-.43-1.295c-.086-.4-.119-.796-.046-1.136.075-.354.274-.672.65-.823.192-.077.4-.12.602-.077a.7.7 0 0 1 .477.365c.088.164.12.356.127.538.007.188-.012.396-.047.614-.084.51-.27 1.134-.52 1.794a10.954 10.954 0 0 0 .98 1.686 5.753 5.753 0 0 1 1.334.05c.364.066.734.195.96.465.12.144.193.32.2.518.007.192-.047.382-.138.563a1.04 1.04 0 0 1-.354.416.856.856 0 0 1-.51.138c-.331-.014-.654-.196-.933-.417a5.712 5.712 0 0 1-.911-.95 11.651 11.651 0 0 0-1.997.406 11.307 11.307 0 0 1-1.02 1.51c-.292.35-.609.656-.927.787a.793.793 0 0 1-.58.029zm1.379-1.901c-.166.076-.32.156-.459.238-.328.194-.541.383-.647.547-.094.145-.096.25-.04.361.01.022.02.036.026.044a.266.266 0 0 0 .035-.012c.137-.056.355-.235.635-.572a8.18 8.18 0 0 0 .45-.606zm1.64-1.33a12.71 12.71 0 0 1 1.01-.193 11.744 11.744 0 0 1-.51-.858 20.801 20.801 0 0 1-.5 1.05zm2.446.45c.15.163.296.3.435.41.24.19.407.253.498.256a.107.107 0 0 0 .07-.015.307.307 0 0 0 .094-.125.436.436 0 0 0 .059-.2.095.095 0 0 0-.026-.063c-.052-.062-.2-.152-.518-.209a3.876 3.876 0 0 0-.612-.053zM8.078 7.8a6.7 6.7 0 0 0 .2-.828c.031-.188.043-.343.038-.465a.613.613 0 0 0-.032-.198.517.517 0 0 0-.145.04c-.087.035-.158.106-.196.283-.04.192-.03.469.046.822.024.111.054.227.09.346z"/>
            </svg>
        </a>
        <br>
        CERTIFICADO
    </div>
</div>
<br>
<br>
<div class="row">
    <div class="col-md"><br></div>
    <div class="col-md-9">
        <form action="{{route('observacionesReventrada.save')}}" method="POST"  id="form-observacionesreventrada" name="form-observacionesreventrada" >
            @csrf
            <div class="row">
                <div class="col-md">
                    <input type="number" name="mes_asignacion" value="{{$mesnumber}}" hidden>
                    <input type="number" name="contdosisededepto" value="{{$contdosisededepto->id_contdosisededepto}}" hidden>
                    <input type="number" name="contratodosimetriasede" value="{{$contdosisededepto->contratodosimetriasede_id}}" hidden>
                    <div class="table table-responsive p-2">
                        <table class="table table-sm table-bordered">
                            <thead>
                                <tr class="table-active text-center ">
                                    <th class='align-middle py-4' style='width: 20%'>TRABAJADOR / ÁREA</th>
                                    <th class='align-middle py-4' >No. IDEN.</th>
                                    <th class='align-middle py-4' >DOSÍMETRO</th>
                                    <th class='align-middle py-4' >HOLDER</th>
                                    <th class='align-middle py-4' >OCUPACIÓN</th>
                                    <th class='align-middle py-4' >UBICACIÓN</th>
                                    <th class='align-middle py-4' style='width: 35%'>OBSERVACIÓN</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($dosicontrolasig->isEmpty())
                                    @foreach($areasignados as $area)
                                        <tr id='A{{$area->id_dosiareacontdosisedes}}'>
                                            <td class='align-middle py-3'>{{$area->areadepartamentosede->nombre_area}}</td>
                                            <td class='align-middle text-center'>N.A.</td>
                                            <td class='align-middle text-center'>{{$area->dosimetro->codigo_dosimeter}}</td>
                                            <td class='align-middle text-center'>N.A.</td>
                                            <td class='align-middle text-center'>{{$contdosisededepto->contratodosimetriasede->dosimetriacontrato->ocupacion}}</td>
                                            <td class='align-middle text-center'>AMBIENTAL</td>
                                            <td class='align-middle text-center'>
                                                @if(count($observacionesAsig) > 0)
                                                    <div class="row">
                                                        @foreach($observacionesAsig as $obsAsig)
                                                            @if($obsAsig->dosiareacontdosimetro_id == $area->id_dosiareacontdosisedes)
                                                                <div class="col-9 m-1 align-middle text-center" style="font-size: 14px;">
                                                                    {{$obsAsig->observacion_id}}) {{$obsAsig->observaciones->obs}}
                                                                    <br>
                                                                </div>
                                                                <div class="col-2 m-1">
                                                                    <button  class="btn btn-danger"  type="button" onclick="removeObs('{{$obsAsig->id_obsreventrada}}');">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                                                                            <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z"/>
                                                                        </svg>
                                                                    </button>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                @endif
                                                <div class="row">
                                                    <div class="col">
                                                        <input type="text" name="id_dosiareacontdosisedes[]" value="{{$area->id_dosiareacontdosisedes}}" hidden>
                                                        <select class="form-select" name="observacion_asig_dosiarea{{$area->id_dosiareacontdosisedes}}[]" id="observacion_asig_dosiarea" autofocus multiple="true">
                                                            @if(count($observacionesAsig) == 0)
                                                                <option value="1" selected>--1) BUEN ESTADO FÍSICO--</option>
                                                                @foreach($observaciones as $obs)
                                                                    <option value="@if($obs->id_observacion != 1){{$obs->id_observacion}}@endif">{{$obs->id_observacion}}) {{$obs->obs}}</option>
                                                                @endforeach
                                                            @else
                                                                @foreach($observaciones as $obs)
                                                                    <option value="{{$obs->id_observacion}}">{{$obs->id_observacion}}) {{$obs->obs}}</option>
                                                                @endforeach
                                                            @endif
                                                        </select> 
                                                        <textarea class="form-control mt-1" name="obsAddArea{{$area->id_dosiareacontdosisedes}}" id="obsAddArea{{$area->id_dosiareacontdosisedes}}" cols="35" rows="3" hidden></textarea>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    @foreach($trabjasignados as $trabasig)
                                        <tr id='{{$trabasig->id_trabajadordosimetro}}'>
                                            <td class='align-middle py-3'>@if(!empty($trabasig->persona->primer_nombre_persona)){{$trabasig->persona->primer_nombre_persona}} {{$trabasig->persona->segundo_nombre_persona}} {{$trabasig->persona->primer_apellido_persona}} {{$trabasig->persona->segundo_apellido_persona}}@endif </td>
                                            <td class='align-middle py-3 text-center'>@if(!empty($trabasig->persona->cedula_persona)) {{$trabasig->persona->cedula_persona}}@endif </td>
                                            <td class='align-middle py-3 text-center'>{{$trabasig->dosimetro->codigo_dosimeter}}</td>
                                            <td class='align-middle py-3 text-center'>
                                                @if($trabasig->holder_id == '')
                                                    N.A.
                                                @else
                                                    {{$trabasig->holder->codigo_holder}}
                                                @endif
                                            </td>
                                            <td class='align-middle py-3 text-center'>{{$contdosisededepto->contratodosimetriasede->dosimetriacontrato->ocupacion}}</td>
                                            <td class='align-middle py-3 text-center'>{{$trabasig->ubicacion}}</td>
                                            <td class='align-middle py-3 text-center'>
                                                @if(count($observacionesAsig) > 0)
                                                    <div class="row">
                                                        @foreach($observacionesAsig as $obsAsig)
                                                            @if($obsAsig->trabajcontdosimetro_id == $trabasig->id_trabajadordosimetro)
                                                                <div class="col-9 m-1 align-middle text-center" style="font-size: 14px;">
                                                                    {{$obsAsig->observacion_id}}) {{$obsAsig->observaciones->obs}}
                                                                    <br>
                                                                </div>
                                                                <div class="col-2 m-1">
                                                                    <button  class="btn btn-danger"  type="button" onclick="removeObs('{{$obsAsig->id_obsreventrada}}');">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                                                                            <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z"/>
                                                                        </svg>
                                                                    </button>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                @endif
                                                <div class="row">
                                                    <div class="col">
                                                        <input type="text" name="id_trabajadordosimetro[]" value="{{$trabasig->id_trabajadordosimetro}}" hidden>
                                                        <select class="form-select"  name="observacion_asig{{$trabasig->id_trabajadordosimetro}}[]" id="observacion_asig" autofocus multiple="true">
                                                            @if(count($observacionesAsig) == 0)
                                                                <option value="1" selected>--1) BUEN ESTADO FÍSICO--</option>
                                                                @foreach($observaciones as $obs)
                                                                    <option value="@if($obs->id_observacion != 1){{$obs->id_observacion}}@endif">{{$obs->id_observacion}}) {{$obs->obs}}</option>
                                                                @endforeach
                                                            @else
                                                                @foreach($observaciones as $obs)
                                                                    <option value="{{$obs->id_observacion}}">{{$obs->id_observacion}}) {{$obs->obs}}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                        <textarea class="form-control mt-1" name="obsAddTrab{{$trabasig->id_trabajadordosimetro}}" id="obsAddTrab{{$trabasig->id_trabajadordosimetro}}" cols="35" rows="3" hidden></textarea>
                                                    </div>
                                                </div>
                                                
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    @foreach($dosicontrolasig as $dosicontasig)
                                        <tr id="C{{$dosicontasig->id_dosicontrolcontdosisedes}}">
                                            <td class='align-middle py-3'>CONTROL {{$dosicontasig->ubicacion}}</td>
                                            <td class='align-middle py-3 text-center'>N.A.</td>
                                            <td class='align-middle py-3 text-center'>{{$dosicontasig->dosimetro->codigo_dosimeter}}</td>
                                            <td class='align-middle py-3 text-center'>
                                                @if($dosicontasig->holder_id == '')
                                                    N.A.
                                                @else
                                                    {{$dosicontasig->holder->codigo_holder}}
                                                @endif
                                            </td>
                                            <td class='align-middle py-3 text-center'>{{$contdosisededepto->contratodosimetriasede->dosimetriacontrato->ocupacion}}</td>
                                            <td class='align-middle py-3 text-center'>{{$dosicontasig->ubicacion}}</td>
                                            <td class='align-middle py-3 text-center'>
                                                @if(count($observacionesAsig) > 0)
                                                    <div class="row">
                                                        @foreach($observacionesAsig as $obsAsig)
                                                            @if($obsAsig->dosicontrol_id == $dosicontasig->id_dosicontrolcontdosisedes)
                                                                <div class="col-9 m-1 align-middle text-center" style="font-size: 14px;">
                                                                    {{$obsAsig->observacion_id}}) {{$obsAsig->observaciones->obs}}
                                                                    <br>
                                                                </div>
                                                                <div class="col-2 m-1">
                                                                    <button  class="btn btn-danger"  type="button" onclick="removeObs('{{$obsAsig->id_obsreventrada}}');">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                                                                            <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z"/>
                                                                        </svg>
                                                                    </button>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                @endif
                                                <div class="row">
                                                    <div class="col">
                                                        <input type="text" name="id_dosicontrolcontdosisedes[]" value="{{$dosicontasig->id_dosicontrolcontdosisedes}}" hidden>
                                                        <select class="form-select" name="observacion_asig_dosicont{{$dosicontasig->id_dosicontrolcontdosisedes}}[]" id="observacion_asig_dosicont" autofocus multiple="true">
                                                            @if(count($observacionesAsig) == 0)
                                                                <option value="1" selected>--1) BUEN ESTADO FÍSICO--</option>
                                                                @foreach($observaciones as $obs)
                                                                    <option value="@if($obs->id_observacion != 1){{$obs->id_observacion}}@endif">{{$obs->id_observacion}}) {{$obs->obs}}</option>
                                                                @endforeach
                                                            @else
                                                                @foreach($observaciones as $obs)
                                                                    <option value="{{$obs->id_observacion}}">{{$obs->id_observacion}}) {{$obs->obs}}</option>
                                                                @endforeach
                                                            @endif
                                                        </select> 
                                                        <textarea class="form-control mt-1" name="obsAddCont{{$dosicontasig->id_dosicontrolcontdosisedes}}" id="obsAddCont{{$dosicontasig->id_dosicontrolcontdosisedes}}" cols="35" rows="3" hidden></textarea>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    @foreach($areasignados as $area)
                                        <tr id='A{{$area->id_dosiareacontdosisedes}}'>
                                            <td class='align-middle py-3'>{{$area->areadepartamentosede->nombre_area}}</td>
                                            <td class='align-middle text-center'>N.A.</td>
                                            <td class='align-middle text-center'>{{$area->dosimetro->codigo_dosimeter}}</td>
                                            <td class='align-middle text-center'>N.A.</td>
                                            <td class='align-middle text-center'>{{$contdosisededepto->contratodosimetriasede->dosimetriacontrato->ocupacion}}</td>
                                            <td class='align-middle text-center'>AMBIENTAL</td>
                                            <td class='align-middle text-center'>
                                                @if(count($observacionesAsig) > 0)
                                                    <div class="row">
                                                        @foreach($observacionesAsig as $obsAsig)
                                                            @if($obsAsig->dosiareacontdosimetro_id == $area->id_dosiareacontdosisedes)
                                                                <div class="col-9 m-1 align-middle text-center" style="font-size: 14px;">
                                                                    {{$obsAsig->observacion_id}}) {{$obsAsig->observaciones->obs}}
                                                                    <br>
                                                                </div>
                                                                <div class="col-2 m-1">
                                                                    <button  class="btn btn-danger"  type="button" onclick="removeObs('{{$obsAsig->id_obsreventrada}}');">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                                                                            <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z"/>
                                                                        </svg>
                                                                    </button>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                @endif
                                                <div class="row">
                                                    <div class="col">
                                                        <input type="text" name="id_dosiareacontdosisedes[]" value="{{$area->id_dosiareacontdosisedes}}" hidden>
                                                        <select class="form-select" name="observacion_asig_dosiarea{{$area->id_dosiareacontdosisedes}}[]" id="observacion_asig_dosiarea" autofocus multiple="true">
                                                            @if(count($observacionesAsig) == 0)
                                                                <option value="1" selected>--1) BUEN ESTADO FÍSICO--</option>
                                                                @foreach($observaciones as $obs)
                                                                    <option value="@if($obs->id_observacion != 1){{$obs->id_observacion}}@endif">{{$obs->id_observacion}}) {{$obs->obs}}</option>
                                                                @endforeach
                                                            @else
                                                                @foreach($observaciones as $obs)
                                                                    <option value="{{$obs->id_observacion}}">{{$obs->id_observacion}}) {{$obs->obs}}</option>
                                                                @endforeach
                                                            @endif
                                                        </select> 
                                                        <textarea class="form-control mt-1" name="obsAddArea{{$area->id_dosiareacontdosisedes}}" id="obsAddCont{{$area->id_dosiareacontdosisedes}}" cols="35" rows="3" hidden></textarea>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    @foreach($trabjasignados as $trabasig)
                                        <tr id='{{$trabasig->id_trabajadordosimetro}}'>
                                            <td class='align-middle py-3'>@if(!empty($trabasig->persona->primer_nombre_persona)){{$trabasig->persona->primer_nombre_persona}} {{$trabasig->persona->segundo_nombre_persona}} {{$trabasig->persona->primer_apellido_persona}} {{$trabasig->persona->segundo_apellido_persona}}@endif </td>
                                            <td class='align-middle py-3 text-center'>@if(!empty($trabasig->persona->cedula_persona)) {{$trabasig->persona->cedula_persona}}@endif </td>
                                            <td class='align-middle py-3 text-center'>{{$trabasig->dosimetro->codigo_dosimeter}}</td>
                                            <td class='align-middle py-3 text-center'>
                                                @if($trabasig->holder_id == '')
                                                    N.A.
                                                @else
                                                    {{$trabasig->holder->codigo_holder}}
                                                @endif
                                            </td>
                                            <td class='align-middle py-3 text-center'>{{$contdosisededepto->contratodosimetriasede->dosimetriacontrato->ocupacion}}</td>
                                            <td class='align-middle py-3 text-center'>{{$trabasig->ubicacion}}</td>
                                            <td class='align-middle py-3 text-center'>
                                                @if(count($observacionesAsig) > 0)
                                                    <div class="row">
                                                        @foreach($observacionesAsig as $obsAsig)
                                                            @if($obsAsig->trabajcontdosimetro_id == $trabasig->id_trabajadordosimetro)
                                                                <div class="col-9 m-1 align-middle text-center" style="font-size: 14px;">
                                                                    {{$obsAsig->observacion_id}}) {{$obsAsig->observaciones->obs}}
                                                                    <br>
                                                                </div>
                                                                <div class="col-2 m-1">
                                                                    <button  class="btn btn-danger"  type="button" onclick="removeObs('{{$obsAsig->id_obsreventrada}}');">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                                                                            <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z"/>
                                                                        </svg>
                                                                    </button>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                @endif
                                                <div class="row">
                                                    <div class="col">
                                                        <input type="text" name="id_trabajadordosimetro[]" value="{{$trabasig->id_trabajadordosimetro}}" hidden>
                                                        <select class="form-select"  name="observacion_asig{{$trabasig->id_trabajadordosimetro}}[]" id="observacion_asig" autofocus multiple="true">
                                                            @if(count($observacionesAsig) == 0)
                                                                <option value="1" selected>--1) BUEN ESTADO FÍSICO--</option>
                                                                @foreach($observaciones as $obs)
                                                                    <option value="@if($obs->id_observacion != 1){{$obs->id_observacion}}@endif">{{$obs->id_observacion}}) {{$obs->obs}}</option>
                                                                @endforeach
                                                            @else
                                                                @foreach($observaciones as $obs)
                                                                    <option value="{{$obs->id_observacion}}">{{$obs->id_observacion}}) {{$obs->obs}}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                        <textarea class="form-control mt-1" name="obsAddTrab{{$trabasig->id_trabajadordosimetro}}" id="obsAddTrab{{$trabasig->id_trabajadordosimetro}}" cols="35" rows="3" hidden></textarea>
                                                    </div>
                                                </div>
                                                
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <!---------BOTON------------->
                    <div class="col-md text-center">
                        <button class="btn colorQA " type="submit" id="boton-guardar">GUARDAR</button>
                    </div>
                    <br>
                    
                </div>
            </div>
        </form>
    </div>    
    <div class="col-md"><br></div>
</div>
<br>
<br>
<div class="row">
    <div class="col-md"></div>
    <div class="col-md-8">
        <div class="alert alert-info" role="alert">
            <h4 class="alert-heading"> <b>OBSERVACIONES:</b> </h4>
                @foreach($observacionesAsig as $obsAsig)
                    @if($obsAsig->observacion_id == 9)
                        
                        @if($obsAsig->dosicontrol_id != NULL)
                        - CORRESPONDIENTE AL DOSÍMETRO CONTROL {{$obsAsig->dosicontrolcontdosisedes->ubicacion}}:
                        @elseif($obsAsig->trabajcontdosimetro_id != NULL)
                        - CORRESPONDIENTE AL DOSÍMETRO  {{$obsAsig->trabajadordosimetro->ubicacion}} DEL TRABAJADOR {{$obsAsig->trabajadordosimetro->persona->primer_nombre_persona}} {{$obsAsig->trabajadordosimetro->persona->primer_apellido_persona}} {{$obsAsig->trabajadordosimetro->persona->segundo_apellido_persona}}:
                        @elseif($obsAsig->dosiareacontdosimetro_id  != NULL)
                        - CORRESPONDIENTE AL ÁREA {{$obsAsig->dosiareacontdosisede->areadepartamentosede->nombre_area}}:
                        @endif 
                        {{$obsAsig->nota_obs9}}<br>
                    @endif
                @endforeach
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
                                <form action="{{route('nuevaobservacionreventrada.create')}}" method="POST" id="form_crear_observacionrevsentrada" name="form_crear_observacionrevsentrada" class="form_crear_observacionrevsentrada">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="col-md">
                                            <label class="text-center"><b>OBSERVACION:</b></label>
                                            <textarea class="form-control mt-1" name="obs_new" id="obs_new" cols="35" rows="3"></textarea>
                                            <br>
                                            <label>ESTA SE GURDARÁ PARA PODER UTILIZARLA EN CUALQUIER PERÍODO DE CUALQUIER CONTRATO, ES DECIR DE MANERA GENERAL, DE LO CONTRARIO YA EXISTE LA OBSERVACIÓN <b>9) OTRA ADICIONAL</b> </label>
                                        </div>
                                        <br>
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
        // Creamos array con los meses del año
        const meses = ['ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO', 'JULIO', 'AGOSTO', 'SEPTIEMBRE', 'OCTUBRE', 'NOVIEMBRE', 'DICIEMBRE'];
        let fecha = new Date("{{$contdosisededepto->contratodosimetriasede->dosimetriacontrato->fecha_inicio}}, 00:00:00" );
        console.log(fecha);
        var numLec = '{{$contdosisededepto->contratodosimetriasede->dosimetriacontrato->numlecturas_año}}';
        
        if('{{$contdosisededepto->contratodosimetriasede->dosimetriacontrato->periodo_recambio}}' == 'MENS'){
            var xx = 1; 
            for(var i=0; i<=(numLec-2); i++){
                var ultimoDiaPM = new Date(fecha.getFullYear(), fecha.getMonth() + 1, 1);
                console.log("ULTIMO DIA PRIMER MES:"+ ultimoDiaPM);
                /* console.log("esta es la i="+i); */
                var r = new Date(new Date(ultimoDiaPM).setMonth(ultimoDiaPM.getMonth()+i));
                /* console.log("r1" +r); */
                var r2 = new Date(new Date(r).setMonth(r.getMonth()+1));
                var fechaesp = meses[r.getMonth()] + ' DE ' + r.getUTCFullYear();
                var r2final = new Date(new Date(r2).setDate(r.getDate()-1));
                /* console.log("r2 " +r2final); */
                var fechaesp1 = r.getDate()+' '+meses[r.getMonth()] + ' DE ' + r.getUTCFullYear();
                /* console.log(fechaesp1); */
                var fechaesp2 = (r2final.getDate()) +' '+ meses[r2final.getMonth()] + ' DE ' + r2final.getUTCFullYear(); 
                /* console.log(fechaesp2); */
                xx++;
                /* console.log("XX"+xx); */
                for(var x=2; x<=numLec; x++){
                    /* console.log("ESTA ES LA X="+x); */
                    if("{{$mesnumber}}" == xx){
                        document.getElementById('mes{{$mesnumber}}').innerHTML = fechaesp1+' - '+fechaesp2;
                        
                    }
                }
            }
        }else if('{{$contdosisededepto->contratodosimetriasede->dosimetriacontrato->periodo_recambio}}' == 'TRIMS'){
            var xx = 1;
            for(var i=0; i<=(numLec+1); i= i+3){
                var ultimoDiaPM = new Date(fecha.getFullYear(), fecha.getMonth() + 3, 1);
                console.log("ULTIMO DIA PRIMER MES:"+ ultimoDiaPM);
                console.log("ESTA ES LA I = "+i);
                var r = new Date(new Date(ultimoDiaPM).setMonth(ultimoDiaPM.getMonth()+i));
                console.log("r1" +r);
                var r2 = new Date(new Date(r).setMonth(r.getMonth()+3));
                var r2final = new Date(new Date(r2).setDate(r.getDate()-1));
                console.log("r2 " +r2final);
                var fechaesp1 = r.getDate()+' '+meses[r.getMonth()] + ' DE ' + r.getUTCFullYear();
                console.log(fechaesp1);

                var fechaesp2 = (r2final.getDate()) +' '+ meses[r2final.getMonth()] + ' DE ' + r2final.getUTCFullYear(); 
                console.log(fechaesp2);
                xx++;
                console.log("XX ="+xx);
                console.log("MES ACTUAL ="+"{{$mesnumber}}");
                
                if("{{$mesnumber}}" == xx){
                    document.getElementById('mes{{$mesnumber}}').innerHTML = fechaesp1+' - '+fechaesp2;
                }
                
            }
        }else if('{{$contdosisededepto->contratodosimetriasede->dosimetriacontrato->periodo_recambio}}' == 'BIMS'){
            var xx = 1;
            for(var i=0; i<=(numLec+1); i= i+2){
                var ultimoDiaPM = new Date(fecha.getFullYear(), fecha.getMonth() + 2, 1);
                console.log("ULTIMO DIA PRIMER MES:"+ ultimoDiaPM);
                console.log("ESTA ES LA I = "+i);
                var r = new Date(new Date(ultimoDiaPM).setMonth(ultimoDiaPM.getMonth()+i));
                console.log("r1" +r);
                var r2 = new Date(new Date(r).setMonth(r.getMonth()+2));
                var r2final = new Date(new Date(r2).setDate(r.getDate()-1));
                console.log("r2 " +r2final);
                var fechaesp1 = r.getDate()+' '+meses[r.getMonth()] + ' DE ' + r.getUTCFullYear();
                console.log(fechaesp1);

                var fechaesp2 = (r2final.getDate()) +' '+ meses[r2final.getMonth()] + ' DE ' + r2final.getUTCFullYear(); 
                console.log(fechaesp2);
                xx++;
                console.log("XX"+xx);
                
                if("{{$mesnumber}}" == xx){
                    document.getElementById('mes{{$mesnumber}}').innerHTML = fechaesp1+' - '+fechaesp2;
                    
                }
                
            } 
        }

        @foreach($dosicontrolasig as $dosicontasig)
            var asigdosicont = document.querySelectorAll('select[name="observacion_asig_dosicont{{$dosicontasig->id_dosicontrolcontdosisedes}}[]"]');
            console.log(asigdosicont);
            for(var i = 0; i < asigdosicont.length; i++){
                asigdosicont[i].setAttribute("id", "observacion_asig_dosicont"+'{{$dosicontasig->id_dosicontrolcontdosisedes}}');
                $('#observacion_asig_dosicont'+'{{$dosicontasig->id_dosicontrolcontdosisedes}}').select2({
                    placeholder:"--SELECCIONE--",
                    tags: true,
                    tokenSeparators: ['/',',',',',','," "],
                    width: "100%",
                });
            };  
        @endforeach
        @foreach($trabjasignados as $trabasig)
            var asigdosi = document.querySelectorAll('select[name="observacion_asig{{$trabasig->id_trabajadordosimetro}}[]"]');
            console.log(asigdosi);
            for(var i = 0; i < asigdosi.length; i++){
                asigdosi[i].setAttribute("id", "observacion_asig"+'{{$trabasig->id_trabajadordosimetro}}');
                $('#observacion_asig'+'{{$trabasig->id_trabajadordosimetro}}').select2({
                    placeholder:"--SELECCIONE--",
                    tags: true,
                    tokenSeparators: ['/',',',',',','," "],
                    width: "100%",
                });
            };
        @endforeach
        @foreach($areasignados as $area)
            var asigdosi = document.querySelectorAll('select[name="observacion_asig_dosiarea{{$area->id_dosiareacontdosisedes}}[]"]');
            console.log(asigdosi);
            for(var i = 0; i < asigdosi.length; i++){
                asigdosi[i].setAttribute("id", "observacion_asig_dosiarea"+'{{$area->id_dosiareacontdosisedes}}');
                $('#observacion_asig_dosiarea'+'{{$area->id_dosiareacontdosisedes}}').select2({
                    placeholder:"--SELECCIONE--",
                    tags: true,
                    tokenSeparators: ['/',',',',',','," "],
                    width: "100%",
                });
            };
        @endforeach
        
    })
    
</script>
<script type="text/javascript">
    
    $(document).ready(function(){
        @foreach($areasignados as $area)
            if('{{$area->revision_entrada}}' == 'TRUE'){
                let tr = document.getElementById('A{{$area->id_dosiareacontdosisedes}}'); 
                tr.style.boxShadow = "0px 0px 7px 1px rgb(26, 153, 128)";  
            }
        @endforeach
        @foreach($trabjasignados as $trabj)
            if('{{$trabj->revision_entrada}}' == 'TRUE'){
                let tr = document.getElementById('{{$trabj->id_trabajadordosimetro}}'); 
                tr.style.boxShadow = "0px 0px 7px 1px rgb(26, 153, 128)";  
            }
        @endforeach
        @foreach($dosicontrolasig as $dosicont)
            if('{{$dosicont->revision_entrada}}' == 'TRUE'){
                let tr = document.getElementById('C{{$dosicont->id_dosicontrolcontdosisedes}}'); 
                tr.style.boxShadow = "0px 0px 7px 1px rgb(26, 153, 128)";  
            }
        @endforeach

        $('#dosi_control').on('change', function(){
            var codigoEtiq = document.querySelector('#codigo_etiqueta').value;
            const js = document.querySelector('#dosi_control').checked;
            console.log("ESTADO INICIAL"+js);
            console.log("codigo etiqueta con checkbox estado inicial"+codigoEtiq+js);
            
            if(js){
                document.getElementById("dosi_ambiental").disabled = true;
                consultarDosiControl();
            }else{
                document.getElementById("dosi_ambiental").disabled = false;
                consultarTrabDosi();
            }
        });
        $('#dosi_ambiental').on('change', function(){
            console.log("ENTRO AL DOSI  AMBIENTAL CHANGE");
            var codigoEtiq = document.querySelector('#codigo_etiqueta').value;
            const js = document.querySelector('#dosi_ambiental').checked;
            console.log("ESTADO INICIAL"+js);
            console.log("codigo etiqueta con checkbox estado inicial"+codigoEtiq+js);
            
            if(js){
                document.getElementById("dosi_control").disabled = true;
                consultarAreaDosi();
            }else{
                document.getElementById("dosi_control").disabled = false;
                consultarTrabDosi();
            }
        });
        
        function consultarDosiControl(){
            console.log("****CONSULTA DOSIMETRO CONTROL****");
            var codigoDosi = document.getElementById('codigo_dosimetro').value; 
            console.log(codigoDosi);
            if(codigoDosi != ''){
                $.get('dosimetro',{codigo_dosi : codigoDosi}, function(dosimetro){
                    console.log(dosimetro);
                    if(dosimetro.length != 0){
                        var check = 0;
                        var codigoEtiq = document.getElementById("codigo_etiqueta").value;
                        console.log(check);
                        console.log("codigo etiqueta "+codigoEtiq);
                        @foreach($dosicontrolasig as $dosicont)
                            if(codigoEtiq == codigoDosi && codigoDosi == '{{$dosicont->dosimetro->codigo_dosimeter}}' /* && dosimetro[0].estado_dosimetro == 'EN USO' */){
                                console.log("SI SE HIZO MATCH CONTROL");
                                check = 1;
                                Swal.fire({
                                    icon: 'success',
                                    title: 'CORRECTO!!',
                                    text: 'SI HAY COINCIDENCIA ENTRE LA ETIQUETA Y EL DOSíMETRO DE CONTROL',
                                    showConfirmButton: false,
                                    timer: 1500
                                })
    
                                document.getElementById("codigo_dosimetro").value = "";
                                document.getElementById("codigo_etiqueta").value = "";
                                document.querySelector('#dosi_control').disabled= false;
                                $.get('dosimetroControlEntrada', {id_dosicontrolcontdosisedes: '{{$dosicont->id_dosicontrolcontdosisedes}}'}, function(dosicontrol){
                                    console.log("SE HIZO EL CHECK CONTROL"+dosicontrol);
                                    let tr = document.getElementById('C{{$dosicont->id_dosicontrolcontdosisedes}}'); 
                                    tr.style.boxShadow = "0px 0px 7px 1px rgb(26, 153, 128)";  
                                })
                            }
                        @endforeach  
                        console.log(check);
                        if(check == 0){
                            console.log("NO SE HIZO MATCH CONTROL");
                            Swal.fire({
                                icon: 'error',
                                title: 'ERROR!!',
                                text: 'NO SE ENCUENTRA RELACIONADO ESTE DOSÍMETRO DE CONTROL',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            document.getElementById("codigo_dosimetro").value = "";
                            document.getElementById("codigo_etiqueta").value = "";
                            document.querySelector('#dosi_control').disabled= false;
                        }
                    }else{
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!!',
                            text: 'NO EXISTE NINGUN DOSÍMETRO CON ESE CODIGO',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        document.getElementById("codigo_dosimetro").value = "";
                        document.getElementById("codigo_etiqueta").value = "";
                        document.querySelector('#dosi_control').disabled= false;
                        console.log("NO EXISTE ESTE DOSIMETRO");
                    }
                })
            }
        }

        function consultarTrabDosi(){
            console.log("/////CONSULTA DOSIMETRO TRABAJADOR/////");
            

            var codigoDosi = document.getElementById('codigo_dosimetro').value; 
            console.log("DOSIMETRO" + codigoDosi);
            if(codigoDosi != ''){
                $.get('dosimetro',{codigo_dosi : codigoDosi}, function(dosimetro){
                    console.log(dosimetro);
                    if(dosimetro.length != 0){
                        var check = 0;
                        var codigoEtiq = document.getElementById("codigo_etiqueta").value;
                        console.log("ETIQUETA" +codigoEtiq)
                        console.log(check);
                        @foreach($trabjasignados as $trabj)
                            if(codigoEtiq == codigoDosi && codigoDosi == '{{$trabj->dosimetro->codigo_dosimeter}}' && dosimetro[0].uso_dosimetro == '{{$trabj->ubicacion}}'){
                                console.log("SI SE HIZO MATCH");
                                check = 1;
                                Swal.fire({
                                    icon: 'success',
                                    title: 'CORRECTO!!',
                                    text: 'SI SE ENCUENTRA RELACIONADO ESTE DOSÍMETRO Y ADEMAS COINCIDE LA UBICACIÓN',
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                                document.getElementById("codigo_dosimetro").value = "";
                                document.getElementById("codigo_etiqueta").value = "";
                                document.querySelector('#dosi_control').disabled= false;
                                $.get('trabajadordosimetroEntrada', {id_trabajadordosimetro: '{{$trabj->id_trabajadordosimetro}}'}, function(trabajadordosi){
                                    console.log("SE HIZO EL CHECK"+trabajadordosi);
                                    let tr = document.getElementById('{{$trabj->id_trabajadordosimetro}}'); 
                                    tr.style.boxShadow = "0px 0px 7px 1px rgb(26, 153, 128)";  
                                })
                            }
                        @endforeach  
                        console.log(check);
                        if(check == 0){
                            console.log("NO SE HIZO MATCH");
                            Swal.fire({
                                icon: 'error',
                                title: 'ERROR!!',
                                text: 'NO SE ENCUENTRA RELACIONADO ESTE DOSÍMETRO',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            document.getElementById("codigo_dosimetro").value = "";
                            document.getElementById("codigo_etiqueta").value = "";
                            document.querySelector('#dosi_control').disabled= false;
                        }
                    }else{
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!!',
                            text: 'NO EXISTE NINGUN DOSÍMETRO CON ESE CODIGO',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        document.getElementById("codigo_dosimetro").value = "";
                        document.getElementById("codigo_etiqueta").value = "";
                        document.querySelector('#dosi_control').disabled= false;
                        console.log("NO EXISTE");
                    }
                    document.getElementById("codigo_dosi").innerHTML = dosimetro[0].codigo_dosimeter;
                    document.getElementById("tipo_dosi").innerHTML =  dosimetro[0].tipo_dosimetro;
                    document.getElementById("tecnologia_dosi").innerHTML = dosimetro[0].tecnologia_dosimetro;
                    document.getElementById("estado_dosi").innerHTML = dosimetro[0].estado_dosimetro;
                    document.getElementById("uso_dosi").innerHTML = dosimetro[0].uso_dosimetro;
                    
                })
            }
        }

        function consultarAreaDosi(){
            console.log("/////CONSULTA DOSIMETRO AMBIENTAL/////");

            var codigoDosi = document.getElementById('codigo_dosimetro').value; 
            console.log("DOSIMETRO" + codigoDosi);
            if(codigoDosi != ''){
                $.get('dosimetro',{codigo_dosi : codigoDosi}, function(dosimetro){
                    console.log(dosimetro);
                    if(dosimetro.length != 0){
                        var check = 0;
                        var codigoEtiq = document.getElementById("codigo_etiqueta").value;
                        console.log("ETIQUETA" +codigoEtiq)
                        console.log(check);
                        @foreach($areasignados as $area)
                            if(codigoEtiq == codigoDosi && codigoDosi == '{{$area->dosimetro->codigo_dosimeter}}' && dosimetro[0].uso_dosimetro == 'AMBIENTAL'){
                                console.log("SI SE HIZO MATCH");
                                check = 1;
                                Swal.fire({
                                    icon: 'success',
                                    title: 'CORRECTO!!',
                                    text: 'SI HAY COINCIDENCIA ENTRE LA ETIQUETA Y EL DOSÍMETRO',
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                                document.getElementById("codigo_dosimetro").value = "";
                                document.getElementById("codigo_etiqueta").value = "";
                                /* document.querySelector('#dosi_control').disabled= false; */
                                $.get('ambientaldosimetroEntrada', {id_dosiareacontdosisedes: '{{$area->id_dosiareacontdosisedes}}'}, function(ambientaldosi){
                                    console.log("SE HIZO EL CHECK"+ambientaldosi);
                                    let tr = document.getElementById('A{{$area->id_dosiareacontdosisedes}}'); 
                                    tr.style.boxShadow = "0px 0px 7px 1px rgb(26, 153, 128)";  
                                })
                            }
                        @endforeach  
                        console.log(check);
                        if(check == 0){
                            console.log("NO SE HIZO MATCH");
                            Swal.fire({
                                icon: 'error',
                                title: 'ERROR!!',
                                text: 'NO HAY COINCIDENCIA ENTRE LA ETIQUETA Y EL DOSÍMETRO',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            document.getElementById("codigo_dosimetro").value = "";
                            document.getElementById("codigo_etiqueta").value = "";
                            /* document.querySelector('#dosi_control').disabled= false; */
                        }
                    }else{
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!!',
                            text: 'NO EXISTE NINGUN DOSÍMETRO CON ESE CODIGO',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        document.getElementById("codigo_dosimetro").value = "";
                        document.getElementById("codigo_etiqueta").value = "";
                        /* document.querySelector('#dosi_control').disabled= false; */
                        console.log("NO EXISTE");
                    }
                    document.getElementById("codigo_dosi").innerHTML = dosimetro[0].codigo_dosimeter;
                    document.getElementById("tipo_dosi").innerHTML =  dosimetro[0].tipo_dosimetro;
                    document.getElementById("tecnologia_dosi").innerHTML = dosimetro[0].tecnologia_dosimetro;
                    document.getElementById("estado_dosi").innerHTML = dosimetro[0].estado_dosimetro;
                    document.getElementById("uso_dosi").innerHTML = dosimetro[0].uso_dosimetro;
                    
                })
            }
        }

        $('#codigo_dosimetro').on('change', function(){
            console.log("ENTRO AL CODIGO DOSIMETRO CHANGE");

            var codigoEtiq = document.querySelector('#codigo_etiqueta').value;
            const jscontrol = document.querySelector('#dosi_control').checked;
            const jsambiental = document.querySelector('#dosi_ambiental').checked;
            console.log("ESTADO INICIAL CONTROL"+jscontrol);
            console.log("ESTADO INICIAL AMBIENTAL"+jsambiental);
            console.log("codigo etiqueta con checkbox estado inicial control"+codigoEtiq+jscontrol);
            console.log("codigo etiqueta con checkbox estado inicial ambiental"+codigoEtiq+jsambiental);
            /* document.querySelector('#dosi_control').disabled= true; */
            if(jscontrol){
                consultarDosiControl();
            }else if(jsambiental){
                consultarAreaDosi();
            }else{
                consultarTrabDosi();
            }
        });
        @foreach($dosicontrolasig as $dosicontasig)
            $('#observacion_asig_dosicont'+'{{$dosicontasig->id_dosicontrolcontdosisedes}}').on('change', function(){
                var id = 'observacion_asig_dosicont'+'{{$dosicontasig->id_dosicontrolcontdosisedes}}';
                console.log(id);
                $('#'+id+' option:selected').each(function() {
                    /* console.log($(this).val()); */
                    if($(this).val() == 9){
                        console.log("ES IGUAL A 9");
                        $('#obsAddCont'+'{{$dosicontasig->id_dosicontrolcontdosisedes}}').prop("hidden", false);
                    }else{
                        $('#obsAddCont'+'{{$dosicontasig->id_dosicontrolcontdosisedes}}').prop("hidden", true);
                    }
                    
                });
                
            })
        @endforeach
        @foreach($trabjasignados as $trabasig)
            $('#observacion_asig'+'{{$trabasig->id_trabajadordosimetro}}').on('change', function(){
                var id = 'observacion_asig'+'{{$trabasig->id_trabajadordosimetro}}';
                console.log(id);
                $('#'+id+' option:selected').each(function() {
                    /* console.log($(this).val()); */
                    if($(this).val() == 9){
                        console.log("ES IGUAL A 9");
                        $('#obsAddTrab'+'{{$trabasig->id_trabajadordosimetro}}').prop("hidden", false);
                    }else{
                        $('#obsAddTrab'+'{{$trabasig->id_trabajadordosimetro}}').prop("hidden", true);
                    }
                    
                });
                
            })
        @endforeach
        @foreach($areasignados as $area)
            $('#observacion_asig_dosiarea'+'{{$area->id_dosiareacontdosisedes}}').on('change', function(){
                var id = 'observacion_asig_dosiarea'+'{{$area->id_dosiareacontdosisedes}}';
                console.log(id);
                $('#'+id+' option:selected').each(function() {
                    if($(this).val() == 9){
                        console.log("ES IGUAL A 9");
                        $('#obsAddArea'+'{{$area->id_dosiareacontdosisedes}}').prop("hidden", false);
                    }else{
                        $('#obsAddArea'+'{{$area->id_dosiareacontdosisedes}}').prop("hidden", true);
                    }
                    
                });
                
            })
        @endforeach
        /* $('#codigo_etiqueta').on('change', function(){
            var codigoEtiq = document.querySelector('#codigo_etiqueta').value;
            const js = document.querySelector('#dosi_control').checked;
            console.log("ESTADO INICIAL"+js);
            console.log("codigo etiqueta con checkbox estado inicial"+codigoEtiq+js);
            document.getElementById("codigo_dosimetro").value = "";
            
            if(js){
                console.log("ESTTRO AL IF TRUE");
                consultarDosiControl();
            }else{
                consultarTrabDosi();
            }
        }); */
        
        
        
    })
    function removeObs(id){
        console.log("id" +id);
        Swal.fire({
            title: "DESEA ELIMINAR LA OBSERVACIÓN ??",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#1A9980',
            cancelButtonColor: '#d33',
            confirmButtonText: 'SI, SEGURO!'
        }).then((result) => {
            $.ajax({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                type: "post",
                url: "{{route('observaciones.remove', ['deptodosi' => $contdosisededepto->id_contdosisededepto, 'mesnumber' =>$mesnumber])}}",
                data:{
                    'id': id,
                    '_token': $('#signup-token').val()
                },
                dataType: 'JSON',
                success: function (msg) {
                    Swal.fire({
                        title: 'ELIMINADO!',
                        text: 'SE HA ELIMINADO CON EXITO!',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 8000
                    });
                    window.location.reload();
                }
            });
        })
    }
    function alertCertificado(empresa, id, mes){
        console.log("SE SELECCIONO EL BOTON" +empresa+id+mes);
        
        var obsdosi = 0;
        var obstrab = 0;
        var obsarea = 0;
        $.get('observacionesreventrada',{id : id, mes: mes})
        .done(function( obsrevent ){
            console.log("OBSERVACIONES");
            console.log(obsrevent);
            if(obsrevent.length == 0){
                Swal.fire({
                    title: "LAS ASIGNACIONES NO TIENEN NINGUNA OBSERVACIÓN !!!",
                    text:"OPRIMA EL BOTÓN GUARDAR",
                    icon: 'warning',
                })
            }else{
                var arrayCONT = [];
                @foreach($observacionesAsig as $obsAsig)
                    if('{{$obsAsig->dosicontrol_id}}' != ""){
                        arrayCONT.push('{{$obsAsig->dosicontrol_id}}');
                    }
                @endforeach
                console.log("arrayCONT="+arrayCONT);
                @foreach($dosicontrolasig as $dosicontasig)
                    console.log('{{$dosicontasig->id_dosicontrolcontdosisedes}}');
                    if(arrayCONT.includes('{{$dosicontasig->id_dosicontrolcontdosisedes}}')){
                        console.log("está presente control");
                    }else{
                        console.log("No encontrado control");
                        obsdosi ++;
                    }
                @endforeach 
                var arrayTRAB = [];
                @foreach($observacionesAsig as $obsAsig)
                    if('{{$obsAsig->trabajcontdosimetro_id}}' != ""){
                        arrayTRAB.push('{{$obsAsig->trabajcontdosimetro_id}}');
                    }
                @endforeach
                console.log("arrayTRAB="+arrayTRAB);
                @foreach($trabjasignados as $trabasig)
                    console.log('{{$trabasig->id_trabajadordosimetro}}');
                    if(arrayTRAB.includes('{{$trabasig->id_trabajadordosimetro}}')){
                        console.log("está presente");
                    }else{
                        console.log("No encontrado");
                        obstrab ++;
                    }
                @endforeach 
                var arrayAREA = [];
                @foreach($observacionesAsig as $obsAsig)
                    if('{{$obsAsig->dosiareacontdosimetro_id}}' != ""){
                        arrayAREA.push('{{$obsAsig->dosiareacontdosimetro_id}}');
                    }
                @endforeach
                console.log("arrayAREA="+arrayAREA);
                @foreach($areasignados as $area)
                    console.log('{{$area->id_dosiareacontdosisedes}}');
                    if(arrayAREA.includes('{{$area->id_dosiareacontdosisedes}}')){
                        console.log("está presente");
                    }else{
                        console.log("No encontrado");
                        obsarea ++;
                    }
                @endforeach
                
            };
            if(obsdosi != 0){
                Swal.fire({
                    title: "ALGUNAS ASIGNACIONES DE DOSÍMETRO CONTROL NO TIENEN OBSERVACIÓN",
                    text:"REVISELAS Y OPRIMA EL BOTÓN GUARDAR",
                    icon: 'warning',
                })
            }else if(obstrab != 0){
                Swal.fire({
                    title: "ALGUNAS ASIGNACIONES NO TIENEN OBSERVACIÓN",
                    text:"REVISELAS Y OPRIMA EL BOTÓN GUARDAR",
                    icon: 'warning',
                })
            }else if(obsarea != 0){
                Swal.fire({
                    title: "ALGUNAS ASIGNACIONES DE DOSÍMETRO AMBIENTAL NO TIENEN OBSERVACIÓN",
                    text:"REVISELAS Y OPRIMA EL BOTÓN GUARDAR",
                    icon: 'warning',
                })
            };


            var dosi = 0;
            var trab = 0;
            var area = 0;

            console.log("SON CERO "+obsdosi + obstrab + obsarea);
            if(obsdosi == 0 && obstrab == 0 && obsarea == 0){
                $.get('asignacionesTrab',{id : id, mes: mes})
                .done(function(asignacionesTrab){
                    console.log("ASIGNACIONES");
                    console.log(asignacionesTrab);
                    asignacionesTrab.forEach(trabj => {
                        if(trabj.revision_entrada == null){
                            console.log("hay trabj");
                            trab ++;
                        }
                    });
                    console.log(trab);
                    if(trab != 0){
                        Swal.fire({
                            title: "ALGUNOS DOSÍMETROS NO HAN SIDO REVISADOS !!!",
                            text:"DESEA GENERAR EL REPORTE DE ENTRADA??",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#1A9980',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'SI, SEGURO!'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                var host = window.location.host;
                                var path = "http://"+host+"/POSITRON/public/reporteRevisionEntrada/"+empresa+"/"+id+"/"+mes+"/pdf";
                                window.open(path, '_blank');
                            }
                        })
                    
                    }else{
                        $.get('asignacionesCont', {id : id, mes: mes})
                        .done(function(asignacionesCont){
                            console.log("ASIGNACIONES CONTROL");
                            console.log(asignacionesCont);
                            asignacionesCont.forEach(dosicont => {
                                if(dosicont.revision_entrada == null){
                                    console.log("hay dosi");
                                    dosi ++;
                                }
                            });
                            console.log("dosi="+dosi);
                            console.log("trab="+trab);
                            
                            if(dosi != 0){
                                Swal.fire({
                                    title: "ALGUNOS DOSÍMETROS DE CONTROL NO HAN SIDO REVISADOS !!!",
                                    text:"DESEA GENERAR EL REPORTE DE ENTRADA??",
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonColor: '#1A9980',
                                    cancelButtonColor: '#d33',
                                    confirmButtonText: 'SI, SEGURO!'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        var host = window.location.host;
                                        var path = "http://"+host+"/POSITRON/public/reporteRevisionEntrada/"+empresa+"/"+id+"/"+mes+"/pdf";
                                        window.open(path, '_blank');
                                    }
                                })
                            
                            
                            }else{
                                /* var host = window.location.host;
                                var path = "http://"+host+"/POSITRON/public/reporteRevisionEntrada/"+empresa+"/"+id+"/"+mes+"/pdf";
                                window.open(path, '_blank'); */
                                $.get('asignacionesArea', {id : id, mes: mes})
                                .done(function(asignacionesarea){
                                 
                                    console.log("ASIGNACIONES AREA");
                                    console.log(asignacionesarea);
                                    asignacionesarea.forEach(dosiarea => {
                                        if(dosiarea.revision_entrada == null){
                                            console.log("hay dosi area");
                                            area ++;
                                        }
                                    });
                                    console.log("dosi="+dosi);
                                    console.log("trab="+trab);
                                    console.log("area="+trab);
                                    if(area != 0){
                                        Swal.fire({
                                            title: "ALGUNOS DOSÍMETROS AMBIENTAL NO HAN SIDO REVISADOS !!!",
                                            text:"DESEA GENERAR EL REPORTE DE ENTRADA??",
                                            icon: 'warning',
                                            showCancelButton: true,
                                            confirmButtonColor: '#1A9980',
                                            cancelButtonColor: '#d33',
                                            confirmButtonText: 'SI, SEGURO!'
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                var host = window.location.host;
                                                var path = "http://"+host+"/POSITRON/public/reporteRevisionEntrada/"+empresa+"/"+id+"/"+mes+"/pdf";
                                                window.open(path, '_blank');
                                            }
                                        })
                                    }else{
                                        $.get('trabjencargado', {id : id}, function(trabjencargado){
                                            console.log(trabjencargado)
                                            if(trabjencargado.length != 0){
                                                var host = window.location.host;
                                                var path = "http://"+host+"/POSITRON/public/reporteRevisionEntrada/"+empresa+"/"+id+"/"+mes+"/pdf";
                                                window.open(path, '_blank');
                                            }else{
                                                Swal.fire({
                                                    title: "NO HAY UN LIDER O PERSONA ENCARGADA DE LA DOSIMETRÍA PARA ESTA SEDE!!!",
                                                    text:"DESEA GENERAR EL REPORTE DE ENTRADA??",
                                                    icon: 'warning',
                                                    showCancelButton: true,
                                                    confirmButtonColor: '#1A9980',
                                                    cancelButtonColor: '#d33',
                                                    confirmButtonText: 'SI, SEGURO!'
                                                }).then((result) => {
                                                    if (result.isConfirmed) {
                                                        var host = window.location.host;
                                                        var path = "http://"+host+"/POSITRON/public/reporteRevisionEntrada/"+empresa+"/"+id+"/"+mes+"/pdf";
                                                        window.open(path, '_blank');
                                                    }
                                                })
                                            } 
                                        });
                                    }
                                });
                            }
                        })
                    }
                    
                });
            }
        });
        
    }
</script>
@endsection