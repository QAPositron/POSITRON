@extends('layouts.app')
@extends('layouts.plantillabase')
@section('contenido')
    <div class="row">
        <div class="col-md">
            <a type="button" class="btn btn-circle colorQA" href="{{route('detallecontrato.create', $novcontdosisededepto->contratodosimetriasededepto->contratodosimetriasede->dosimetriacontrato->id_contratodosimetria)}}">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-arrow-left mt-1" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                </svg>
            </a>
        </div>
        <div class="col-md-9">
            <h2 class="text-center">DOSIMETRÍA DE</h2>
            <h3 class="text-center"><i>{{$novcontdosisededepto->contratodosimetriasededepto->contratodosimetriasede->sede->empresa->nombre_empresa}} </i></h3>
            <h3 class="text-center">SEDE:<i> {{$novcontdosisededepto->contratodosimetriasededepto->contratodosimetriasede->sede->nombre_sede}}</i></h3>
            @php
                $codigo = str_pad($novcontdosisededepto->id_novcontdosisededepto, 5, "0", STR_PAD_LEFT);
            @endphp
            <h3 class="text-center">SUB-ESPECIALIDAD: <i>NOV-{{$novcontdosisededepto->departamentosede->departamento->nombre_departamento}}-{{$codigo}}</i></h3>
        </div>
        <div class="col-md"></div>
    </div>
    <br>
    <h4 class="text-center align-middle">CONTRATO No.{{$codigo}}</h4>
    <br>
    <div class="row g-2 mx-3">
        <div class="col-md"></div>
        <div class="col-md-8">    
            <div class="table table-responsive">
                <table class="table table-sm table-bordered">
                    <thead class="table-active">
                        <tr class="text-center">
                            <th colspan='9'>DOSíMETROS CONTRATADOS</th>
                        </tr>
                        <tr class="text-center">
                            <th class="align-middle">TÓRAX</th>
                            <th class="align-middle">CRISTALINO</th>
                            <th class="align-middle">ANILLO</th>
                            <th class="align-middle">AMBIENTAL</th>
                            <th class="align-middle">CASO</th>
                            <th class="align-middle">CONTROL TÓRAX</th>
                            <th class="align-middle">CONTROL CRISTALINO</th>
                            <th class="align-middle">CONTROL ANILLO</th>
                            <th class="align-middle">TOTAL</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center">{{$novcontdosisededepto->dosi_torax}}</td>
                            <td class="text-center">{{$novcontdosisededepto->dosi_cristalino}}</td>
                            <td class="text-center">{{$novcontdosisededepto->dosi_dedo}}</td>
                            <td class="text-center">{{$novcontdosisededepto->dosi_area}}</td>
                            <td class="text-center">{{$novcontdosisededepto->dosi_caso}}</td>
                            <td class="text-center">{{$novcontdosisededepto->dosi_control_torax}}</td>
                            <td class="text-center">{{$novcontdosisededepto->dosi_control_cristalino}}</td>
                            <td class="text-center">{{$novcontdosisededepto->dosi_control_dedo}}</td>
                            <td class="text-center">{{$novcontdosisededepto->dosi_torax + $novcontdosisededepto->dosi_cristalino + $novcontdosisededepto->dosi_dedo + $novcontdosisededepto->dosi_area + $novcontdosisededepto->dosi_caso + $novcontdosisededepto->dosi_control_torax + $novcontdosisededepto->dosi_control_cristalino + $novcontdosisededepto->dosi_control_dedo}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md"></div>
    </div>
    <div class="row">
        <div class="col"></div>
        <div class="col-12">
            <div class="table table-responsive p-4">
                <table class="table table-bordered ">
                    <thead class="table-active">
                        <tr>
                            <th class="text-center align-middle" style='width: 8.90%'>NÚMERO</th>
                            <th class="text-center align-middle" style='width:35%' >PERÍODOS</th>
                            <th class="text-center align-middle">ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        <tr style="background-color: rgb(26, 153, 128, 0.1);">
                            <th class="text-center align-middle">
                                {{$novcontdosisededepto->mes_asignacion}}
                            </th>
                            <th class="align-middle">
                                @if(!empty($trabjasigcontra))
                                    @php
                                        $meses = ["01"=>'ENERO', "02"=>'FEBRERO', "03"=>'MARZO', "04"=>'ABRIL', "05"=>'MAYO', "06"=>'JUNIO', "07"=>'JULIO', "08"=>'AGOSTO', "09"=>'SEPTIEMBRE', "10"=>'OCTUBRE', "11"=>'NOVIEMBRE', "12"=>'DICIEMBRE'];
                                        $inicio = date($trabjasigcontra[0]->primer_dia_uso);
                                        $fin = date($trabjasigcontra[0]->ultimo_dia_uso);
                                        echo date("j", strtotime($inicio))." ".$meses[date("m", strtotime($inicio))]." DE ".date("Y", strtotime($inicio)). " - ".date("d", strtotime($fin))." ".$meses[date("m", strtotime($fin))]." DE ".date("Y", strtotime($fin));
                                    @endphp
                                @elseif(!empty($areasigcontra))
                                    @php
                                        $meses = ["01"=>'ENERO', "02"=>'FEBRERO', "03"=>'MARZO', "04"=>'ABRIL', "05"=>'MAYO', "06"=>'JUNIO', "07"=>'JULIO', "08"=>'AGOSTO', "09"=>'SEPTIEMBRE', "10"=>'OCTUBRE', "11"=>'NOVIEMBRE', "12"=>'DICIEMBRE'];
                                        $inicio = date($areasigcontra[0]->primer_dia_uso);
                                        $fin = date($areasigcontra[0]->ultimo_dia_uso);
                                        echo date("j", strtotime($inicio))." ".$meses[date("m", strtotime($inicio))]." DE ".date("Y", strtotime($inicio)). " - ".date("d", strtotime($fin))." ".$meses[date("m", strtotime($fin))]." DE ".date("Y", strtotime($fin));
                                    @endphp
                                @endif
                            </th>
                            <td class='text-center'>
                                <div class="row align-items-center">
                                    {{-- /////////SI SOLO EXISTEN AREAS ASIGNADAS A UN DEPTO///////// --}}
                                    {{-- ///////////////// SE CREA UN NUEVO PARAMETRO PARA LAS SIGUIENTES RUTAS Y ASI SE PUEDAN USAR LAS MISMAS PAGINAS/////////////////// --}}
                                    @if($novcontdosisededepto->dosi_torax == 0 && $novcontdosisededepto->dosi_cristalino == 0 && $novcontdosisededepto->dosi_dedo == 0 && $novcontdosisededepto->dosi_caso == 0)
                                        
                                        <div class="col-md text-center">
                                            <a onclick="return false"  style="background-color: #a0aec0" href="" class="btn  btn-sm aling-middle">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-arrow-bar-right" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd" d="M6 8a.5.5 0 0 0 .5.5h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L12.293 7.5H6.5A.5.5 0 0 0 6 8zm-2.5 7a.5.5 0 0 1-.5-.5v-13a.5.5 0 0 1 1 0v13a.5.5 0 0 1-.5.5z"/>
                                                </svg> <br> ASIGNAR
                                            </a>
                                        </div> 
                                        <div class="col-md text-center">
                                            @php 
                                                $totalA1 = count($areasigcontra);
                                                $totalA = 0; 
                                            @endphp 
                                            @foreach($areasigcontra as $area)
                                                @if($area->revision_salida != NULL)
                                                    @php $totalA += 1;  @endphp
                                                @endif
                                            @endforeach
                                            @if($totalA1 != $totalA)
                                                <a class="btn btn-sm boton-alert colorQA" id="botonEtiq" onclick="cambiaColor()" href="{{route('etiquetasdosimetria.pdf', ['deptodosi' => $novcontdosisededepto->id_novcontdosisededepto, 'mesnumber' => $novcontdosisededepto->mes_asignacion, 'item' => 1])}}" target="_blank">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-ticket-detailed" viewBox="0 0 16 16">
                                                        <path d="M4 5.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5Zm0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5ZM5 7a1 1 0 0 0 0 2h6a1 1 0 1 0 0-2H5Z"/>
                                                        <path d="M0 4.5A1.5 1.5 0 0 1 1.5 3h13A1.5 1.5 0 0 1 16 4.5V6a.5.5 0 0 1-.5.5 1.5 1.5 0 0 0 0 3 .5.5 0 0 1 .5.5v1.5a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 11.5V10a.5.5 0 0 1 .5-.5 1.5 1.5 0 1 0 0-3A.5.5 0 0 1 0 6V4.5ZM1.5 4a.5.5 0 0 0-.5.5v1.05a2.5 2.5 0 0 1 0 4.9v1.05a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-1.05a2.5 2.5 0 0 1 0-4.9V4.5a.5.5 0 0 0-.5-.5h-13Z"/>
                                                    </svg> <br> ETIQUETAS
                                                </a>
                                            @else
                                                <a class="btn btn-sm boton-alert" style="background-color: #a0aec0"   href="{{route('etiquetasdosimetria.pdf', ['deptodosi' => $novcontdosisededepto->id_novcontdosisededepto, 'mesnumber' => $novcontdosisededepto->mes_asignacion, 'item' => 1])}}" target="_blank">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-ticket-detailed" viewBox="0 0 16 16">
                                                        <path d="M4 5.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5Zm0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5ZM5 7a1 1 0 0 0 0 2h6a1 1 0 1 0 0-2H5Z"/>
                                                        <path d="M0 4.5A1.5 1.5 0 0 1 1.5 3h13A1.5 1.5 0 0 1 16 4.5V6a.5.5 0 0 1-.5.5 1.5 1.5 0 0 0 0 3 .5.5 0 0 1 .5.5v1.5a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 11.5V10a.5.5 0 0 1 .5-.5 1.5 1.5 0 1 0 0-3A.5.5 0 0 1 0 6V4.5ZM1.5 4a.5.5 0 0 0-.5.5v1.05a2.5 2.5 0 0 1 0 4.9v1.05a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-1.05a2.5 2.5 0 0 1 0-4.9V4.5a.5.5 0 0 0-.5-.5h-13Z"/>
                                                    </svg> <br> ETIQUETAS
                                                </a>
                                            @endif
                                        </div>
                                        <div class="col-md text-center">
                                            @php 
                                                $totalA1 = count($areasigcontra);
                                                $totalA = 0; 
                                            @endphp 
                                            @foreach($areasigcontra as $area)
                                                @if($area->revision_salida != NULL)
                                                    @php $totalA += 1;  @endphp
                                                @endif
                                            @endforeach
                                            @if($totalA1 != $totalA)
                                                <a class="btn btn-sm colorQA boton-alert" id="botoRsalida" href="{{route('revisiondosimetria.check', ['deptodosi' => $novcontdosisededepto->id_novcontdosisededepto, 'mesnumber' => $novcontdosisededepto->mes_asignacion, 'item' => 1] )}}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" fill="currentColor" class="bi bi-box-arrow-up" viewBox="0 0 16 16">
                                                        <path fill-rule="evenodd" d="M3.5 6a.5.5 0 0 0-.5.5v8a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5v-8a.5.5 0 0 0-.5-.5h-2a.5.5 0 0 1 0-1h2A1.5 1.5 0 0 1 14 6.5v8a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 14.5v-8A1.5 1.5 0 0 1 3.5 5h2a.5.5 0 0 1 0 1h-2z"/>
                                                        <path fill-rule="evenodd" d="M7.646.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 1.707V10.5a.5.5 0 0 1-1 0V1.707L5.354 3.854a.5.5 0 1 1-.708-.708l3-3z"/>
                                                    </svg><br> REV. SAL.
                                                </a>
                                            @else
                                                <a class="btn btn-sm boton-alert" style="background-color: #a0aec0" href="{{route('revisiondosimetria.check', ['deptodosi' => $novcontdosisededepto->id_novcontdosisededepto, 'mesnumber' => $novcontdosisededepto->mes_asignacion, 'item' => 1] )}}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" fill="currentColor" class="bi bi-box-arrow-up" viewBox="0 0 16 16">
                                                        <path fill-rule="evenodd" d="M3.5 6a.5.5 0 0 0-.5.5v8a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5v-8a.5.5 0 0 0-.5-.5h-2a.5.5 0 0 1 0-1h2A1.5 1.5 0 0 1 14 6.5v8a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 14.5v-8A1.5 1.5 0 0 1 3.5 5h2a.5.5 0 0 1 0 1h-2z"/>
                                                        <path fill-rule="evenodd" d="M7.646.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 1.707V10.5a.5.5 0 0 1-1 0V1.707L5.354 3.854a.5.5 0 1 1-.708-.708l3-3z"/>
                                                    </svg><br> REV. SAL.
                                                </a>
                                            @endif
                                        </div>
                                        <div class="col-md text-center">
                                            @php 
                                                $totalA1 = count($areasigcontra);
                                                $totalA = 0; 
                                                $totala = 0;
                                            @endphp 
                                            @foreach($areasigcontra as $area)
                                                @if($area->revision_salida != NULL)
                                                    @php $totala += 1;  @endphp
                                                @endif
                                                @if($area->revision_entrada != NULL)
                                                    @php $totalA += 1;  @endphp
                                                @endif
                                            @endforeach
                                            @if($totalA1 == $totala && $totalA1 != $totalA)
                                                <a class="btn colorQA btn-sm boton-alert"  href="{{route('revisiondosimetriaEntrada.check', ['deptodosi' => $novcontdosisededepto->id_novcontdosisededepto, 'mesnumber' => $novcontdosisededepto->mes_asignacion, 'item' => 1] )}}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-box-arrow-in-up" viewBox="0 0 16 16">
                                                        <path fill-rule="evenodd" d="M3.5 10a.5.5 0 0 1-.5-.5v-8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 .5.5v8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 0 0 1h2A1.5 1.5 0 0 0 14 9.5v-8A1.5 1.5 0 0 0 12.5 0h-9A1.5 1.5 0 0 0 2 1.5v8A1.5 1.5 0 0 0 3.5 11h2a.5.5 0 0 0 0-1h-2z"/>
                                                        <path fill-rule="evenodd" d="M7.646 4.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V14.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3z"/>
                                                    </svg> <br> REV. ENT.
                                                </a>
                                            @else
                                                <a class="btn btn-sm boton-alert" style="background-color: #a0aec0"  href="{{route('revisiondosimetriaEntrada.check', ['deptodosi' => $novcontdosisededepto->id_novcontdosisededepto, 'mesnumber' => $novcontdosisededepto->mes_asignacion, 'item' => 1] )}}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-box-arrow-in-up" viewBox="0 0 16 16">
                                                        <path fill-rule="evenodd" d="M3.5 10a.5.5 0 0 1-.5-.5v-8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 .5.5v8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 0 0 1h2A1.5 1.5 0 0 0 14 9.5v-8A1.5 1.5 0 0 0 12.5 0h-9A1.5 1.5 0 0 0 2 1.5v8A1.5 1.5 0 0 0 3.5 11h2a.5.5 0 0 0 0-1h-2z"/>
                                                        <path fill-rule="evenodd" d="M7.646 4.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V14.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3z"/>
                                                    </svg> <br> REV. ENT.
                                                </a>
                                            @endif
                                        </div>
                                        <div class="col-md text-center">
                                            @php 
                                                $totalA1 = count($areasigcontra);
                                                $totalA = 0; 
                                            @endphp 
                                            @foreach($areasigcontra as $area)
                                                @if($area->revision_entrada != NULL)
                                                    @php $totalA += 1;  @endphp
                                                @endif
                                            @endforeach
                                            @if($totalA1 == $totalA)
                                                <a class="btn colorQA btn-sm boton-alert"  href="{{route('asignadosicontrato.info', [ 'asigdosicont' => $novcontdosisededepto->id_novcontdosisededepto , 'mesnumber' => $novcontdosisededepto->mes_asignacion, 'item' => 1 ])}}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-card-checklist" viewBox="0 0 16 16">
                                                        <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                                                        <path d="M7 5.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0zM7 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0z"/>
                                                    </svg> <br> LECTURA
                                                </a>
                                            @else
                                                <a class="btn btn-sm boton-alert" style="background-color: #a0aec0" href="{{route('asignadosicontrato.info', [ 'asigdosicont' => $novcontdosisededepto->id_novcontdosisededepto , 'mesnumber' => $novcontdosisededepto->mes_asignacion, 'item' => 1 ])}}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-card-checklist" viewBox="0 0 16 16">
                                                        <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                                                        <path d="M7 5.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0zM7 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0z"/>
                                                    </svg> <br> LECTURA
                                                </a>
                                            @endif
                                        </div>
                                        <div class="col-md text-center">
                                            @php 
                                                $totalA1 = count($areasigcontra);
                                                $totalA = 0; 
                                            @endphp 
                                            @foreach($areasigcontra as $area)
                                                @if($area->revision_entrada == 'TRUE')
                                                    @php $totalA += 1;  @endphp
                                                @endif
                                            @endforeach
                                            @if($totalA1 == $totalA)
                                                <a class="btn colorQA btn-sm boton-alert" href="{{route('repodosimetria.pdf', ['deptodosi' => $novcontdosisededepto->id_novcontdosisededepto, 'mesnumber' => $novcontdosisededepto->mes_asignacion, 'item' => 1] )}}" target="_blank">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-file-earmark-check" viewBox="0 0 16 16">
                                                        <path d="M10.854 7.854a.5.5 0 0 0-.708-.708L7.5 9.793 6.354 8.646a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0l3-3z"/>
                                                        <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z"/>
                                                    </svg> <br> INFORMES
                                                </a>
                                            @else
                                                <a class="btn btn-sm boton-alert" style="background-color: #a0aec0" href="{{route('repodosimetria.pdf', ['deptodosi' => $novcontdosisededepto->id_novcontdosisededepto, 'mesnumber' => $novcontdosisededepto->mes_asignacion, 'item' => 1] )}}" target="_blank">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-file-earmark-check" viewBox="0 0 16 16">
                                                        <path d="M10.854 7.854a.5.5 0 0 0-.708-.708L7.5 9.793 6.354 8.646a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0l3-3z"/>
                                                        <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z"/>
                                                    </svg> <br> INFORMES
                                                </a>
                                            @endif
                                        </div>
                                        
                                    @else
                                        {{--  ///////////// SI EXISTEN TRABAJADORES Y AREAS ASIGNADOS A UN DEPTO ////////////////// --}}
                                        
                                        <div class="col-md text-center">
                                            <a onclick="return false"  style="background-color: #a0aec0" href="" class="btn  btn-sm aling-middle">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-arrow-bar-right" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd" d="M6 8a.5.5 0 0 0 .5.5h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L12.293 7.5H6.5A.5.5 0 0 0 6 8zm-2.5 7a.5.5 0 0 1-.5-.5v-13a.5.5 0 0 1 1 0v13a.5.5 0 0 1-.5.5z"/>
                                                </svg> <br> ASIGNAR
                                            </a>
                                        </div> 
                                        <div class="col-md text-center">
                                            @php 
                                                $totalT1 = count($trabjasigcontra);
                                                $totalT = 0; 
                                            @endphp 
                                            @foreach($trabjasigcontra as $trabj)
                                                @if($trabj->revision_salida != NULL)
                                                    @php $totalT += 1;  @endphp
                                                @endif
                                            @endforeach
                                            @if($totalT1 != $totalT)
                                                <a class="btn btn-sm boton-alert colorQA" id="botonEtiq" onclick="cambiaColor()" href="{{route('etiquetasdosimetria.pdf', ['deptodosi' => $novcontdosisededepto->id_novcontdosisededepto, 'mesnumber' => $novcontdosisededepto->mes_asignacion, 'item' => 1])}}" target="_blank">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-ticket-detailed" viewBox="0 0 16 16">
                                                        <path d="M4 5.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5Zm0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5ZM5 7a1 1 0 0 0 0 2h6a1 1 0 1 0 0-2H5Z"/>
                                                        <path d="M0 4.5A1.5 1.5 0 0 1 1.5 3h13A1.5 1.5 0 0 1 16 4.5V6a.5.5 0 0 1-.5.5 1.5 1.5 0 0 0 0 3 .5.5 0 0 1 .5.5v1.5a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 11.5V10a.5.5 0 0 1 .5-.5 1.5 1.5 0 1 0 0-3A.5.5 0 0 1 0 6V4.5ZM1.5 4a.5.5 0 0 0-.5.5v1.05a2.5 2.5 0 0 1 0 4.9v1.05a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-1.05a2.5 2.5 0 0 1 0-4.9V4.5a.5.5 0 0 0-.5-.5h-13Z"/>
                                                    </svg> <br> ETIQUETAS
                                                </a>
                                            @else
                                                <a class="btn btn-sm boton-alert" style="background-color: #a0aec0"  href="{{route('etiquetasdosimetria.pdf', ['deptodosi' => $novcontdosisededepto->id_novcontdosisededepto, 'mesnumber' => $novcontdosisededepto->mes_asignacion, 'item' => 1])}}" target="_blank">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-ticket-detailed" viewBox="0 0 16 16">
                                                        <path d="M4 5.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5Zm0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5ZM5 7a1 1 0 0 0 0 2h6a1 1 0 1 0 0-2H5Z"/>
                                                        <path d="M0 4.5A1.5 1.5 0 0 1 1.5 3h13A1.5 1.5 0 0 1 16 4.5V6a.5.5 0 0 1-.5.5 1.5 1.5 0 0 0 0 3 .5.5 0 0 1 .5.5v1.5a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 11.5V10a.5.5 0 0 1 .5-.5 1.5 1.5 0 1 0 0-3A.5.5 0 0 1 0 6V4.5ZM1.5 4a.5.5 0 0 0-.5.5v1.05a2.5 2.5 0 0 1 0 4.9v1.05a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-1.05a2.5 2.5 0 0 1 0-4.9V4.5a.5.5 0 0 0-.5-.5h-13Z"/>
                                                    </svg> <br> ETIQUETAS
                                                </a>
                                            @endif
                                        </div>
                                        <div class="col-md text-center">
                                            @php 
                                                $totalT1 = count($trabjasigcontra);
                                                $totalT = 0; 
                                            @endphp 
                                            @foreach($trabjasigcontra as $trabj)
                                                @if($trabj->revision_salida != NULL)
                                                    @php $totalT += 1;  @endphp
                                                @endif
                                            @endforeach
                                            @if($totalT1 != $totalT)
                                                <a class="btn btn-sm colorQA boton-alert" id="botoRsalida" href="{{route('revisiondosimetria.check', ['deptodosi' => $novcontdosisededepto->id_novcontdosisededepto, 'mesnumber' => $novcontdosisededepto->mes_asignacion, 'item' => 1] )}}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" fill="currentColor" class="bi bi-box-arrow-up" viewBox="0 0 16 16">
                                                        <path fill-rule="evenodd" d="M3.5 6a.5.5 0 0 0-.5.5v8a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5v-8a.5.5 0 0 0-.5-.5h-2a.5.5 0 0 1 0-1h2A1.5 1.5 0 0 1 14 6.5v8a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 14.5v-8A1.5 1.5 0 0 1 3.5 5h2a.5.5 0 0 1 0 1h-2z"/>
                                                        <path fill-rule="evenodd" d="M7.646.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 1.707V10.5a.5.5 0 0 1-1 0V1.707L5.354 3.854a.5.5 0 1 1-.708-.708l3-3z"/>
                                                    </svg><br> REV. SAL.
                                                </a>
                                            @else
                                                <a class="btn btn-sm boton-alert" style="background-color: #a0aec0" href="{{route('revisiondosimetria.check', ['deptodosi' => $novcontdosisededepto->id_novcontdosisededepto, 'mesnumber' => $novcontdosisededepto->mes_asignacion, 'item' => 1] )}}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" fill="currentColor" class="bi bi-box-arrow-up" viewBox="0 0 16 16">
                                                        <path fill-rule="evenodd" d="M3.5 6a.5.5 0 0 0-.5.5v8a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5v-8a.5.5 0 0 0-.5-.5h-2a.5.5 0 0 1 0-1h2A1.5 1.5 0 0 1 14 6.5v8a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 14.5v-8A1.5 1.5 0 0 1 3.5 5h2a.5.5 0 0 1 0 1h-2z"/>
                                                        <path fill-rule="evenodd" d="M7.646.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 1.707V10.5a.5.5 0 0 1-1 0V1.707L5.354 3.854a.5.5 0 1 1-.708-.708l3-3z"/>
                                                    </svg><br> REV. SAL.
                                                </a>
                                            @endif
                                        </div>
                                        <div class="col-md text-center">
                                            @php
                                                $totalT1 = count($trabjasigcontra);
                                                $totalT = 0; 
                                                $totalt = 0;
                                            @endphp 
                                            @foreach($trabjasigcontra as $trabj)
                                                @if($trabj->revision_salida != NULL)
                                                    @php $totalt += 1;  @endphp
                                                @endif
                                                @if($trabj->revision_entrada != NULL)
                                                    @php $totalT += 1;  @endphp
                                                @endif
                                            @endforeach
                                            @if($totalT1 == $totalt && $totalT1 != $totalT)
                                                <a class="btn colorQA btn-sm boton-alert"  href="{{route('revisiondosimetriaEntrada.check', ['deptodosi' => $novcontdosisededepto->id_novcontdosisededepto, 'mesnumber' => $novcontdosisededepto->mes_asignacion, 'item' => 1] )}}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-box-arrow-in-up" viewBox="0 0 16 16">
                                                        <path fill-rule="evenodd" d="M3.5 10a.5.5 0 0 1-.5-.5v-8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 .5.5v8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 0 0 1h2A1.5 1.5 0 0 0 14 9.5v-8A1.5 1.5 0 0 0 12.5 0h-9A1.5 1.5 0 0 0 2 1.5v8A1.5 1.5 0 0 0 3.5 11h2a.5.5 0 0 0 0-1h-2z"/>
                                                        <path fill-rule="evenodd" d="M7.646 4.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V14.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3z"/>
                                                    </svg> <br> REV. ENT.
                                                </a>
                                            @else
                                                <a class="btn btn-sm boton-alert" style="background-color: #a0aec0"  href="{{route('revisiondosimetriaEntrada.check', ['deptodosi' => $novcontdosisededepto->id_novcontdosisededepto, 'mesnumber' => $novcontdosisededepto->mes_asignacion, 'item' => 1] )}}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-box-arrow-in-up" viewBox="0 0 16 16">
                                                        <path fill-rule="evenodd" d="M3.5 10a.5.5 0 0 1-.5-.5v-8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 .5.5v8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 0 0 1h2A1.5 1.5 0 0 0 14 9.5v-8A1.5 1.5 0 0 0 12.5 0h-9A1.5 1.5 0 0 0 2 1.5v8A1.5 1.5 0 0 0 3.5 11h2a.5.5 0 0 0 0-1h-2z"/>
                                                        <path fill-rule="evenodd" d="M7.646 4.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V14.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3z"/>
                                                    </svg> <br> REV. ENT.
                                                </a>
                                            @endif
                                        </div>
                                        <div class="col-md text-center">
                                            @php 
                                                $totalT1 = count($trabjasigcontra);
                                                $totalT = 0; 
                                            @endphp 
                                            @foreach($trabjasigcontra as $trabj)
                                                @if($trabj->revision_entrada != NULL)
                                                    @php $totalT += 1;  @endphp
                                                @endif
                                            @endforeach
                                            @if($totalT1 == $totalT)
                                                <a class="btn colorQA btn-sm boton-alert"  href="{{route('asignadosicontrato.info', [ 'asigdosicont' => $novcontdosisededepto->id_novcontdosisededepto, 'mesnumber' => $novcontdosisededepto->mes_asignacion, 'item' => 1 ])}}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-card-checklist" viewBox="0 0 16 16">
                                                        <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                                                        <path d="M7 5.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0zM7 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0z"/>
                                                    </svg> <br> LECTURA
                                                </a>
                                            @else
                                                <a class="btn btn-sm boton-alert" style="background-color: #a0aec0" href="{{route('asignadosicontrato.info', [ 'asigdosicont' => $novcontdosisededepto->id_novcontdosisededepto, 'mesnumber' => $novcontdosisededepto->mes_asignacion, 'item' => 1 ])}}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-card-checklist" viewBox="0 0 16 16">
                                                        <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                                                        <path d="M7 5.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0zM7 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0z"/>
                                                    </svg> <br> LECTURA
                                                </a>
                                            @endif
                                        </div>
                                        <div class="col-md text-center">
                                            @php 
                                                $totalT1 = count($trabjasigcontra);
                                                $totalT = 0; 
                                            @endphp 
                                            @foreach($trabjasigcontra as $trabj)
                                                @if($trabj->revision_entrada == 'TRUE')
                                                    @php $totalT += 1;  @endphp
                                                @endif
                                            @endforeach
                                            @if($totalT1 == $totalT)
                                                <a class="btn colorQA btn-sm boton-alert"  href="{{route('repodosimetria.pdf', ['deptodosi' => $novcontdosisededepto->id_novcontdosisededepto, 'mesnumber' => $novcontdosisededepto->mes_asignacion, 'item' => 1] )}}" target="_blank">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-file-earmark-check" viewBox="0 0 16 16">
                                                        <path d="M10.854 7.854a.5.5 0 0 0-.708-.708L7.5 9.793 6.354 8.646a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0l3-3z"/>
                                                        <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z"/>
                                                    </svg> <br> INFORMES
                                                </a>
                                            @else
                                                <a class="btn btn-sm boton-alert" style="background-color: #a0aec0" href="{{route('repodosimetria.pdf', ['deptodosi' => $novcontdosisededepto->id_novcontdosisededepto, 'mesnumber' => $novcontdosisededepto->mes_asignacion, 'item' => 1] )}}" target="_blank"  >
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-file-earmark-check" viewBox="0 0 16 16">
                                                        <path d="M10.854 7.854a.5.5 0 0 0-.708-.708L7.5 9.793 6.354 8.646a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0l3-3z"/>
                                                        <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z"/>
                                                    </svg> <br> INFORMES
                                                </a>
                                            @endif
                                        </div> 
                                    @endif
                                </div>
                            </td>
                        </tr>
                        
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
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script type="text/javascript">
    $(document).ready(function(){
        
        // Creamos array con los meses del año
        const meses = ['ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO', 'JULIO', 'AGOSTO', 'SEPTIEMBRE', 'OCTUBRE', 'NOVIEMBRE', 'DICIEMBRE'];
        let fecha = new Date("{{$novcontdosisededepto->contratodosimetriasededepto->contratodosimetriasede->dosimetriacontrato->fecha_inicio}}");
        fecha.setMinutes(fecha.getMinutes() + fecha.getTimezoneOffset());
        console.log(fecha);
        var numLec = '{{$novcontdosisededepto->contratodosimetriasededepto->contratodosimetriasede->dosimetriacontrato->numlecturas_año}}';
        var xx = 1; 
        if("{{$novcontdosisededepto->contratodosimetriasededepto->contratodosimetriasede->dosimetriacontrato->periodo_recambio}}" == 'MENS'){
            var ultimoDiaPM = new Date(fecha.getFullYear(), fecha.getMonth() + 1, 1);
            console.log("ULTIMO DIA PRIMER MES:"+ ultimoDiaPM);
            for(var i=0; i<=(numLec-1); i++){
                console.log("esta es la i="+i);
                var r = new Date(new Date(ultimoDiaPM).setMonth(ultimoDiaPM.getMonth()+i));
                console.log("r1" +r);
                var r2 = new Date(new Date(r).setMonth(r.getMonth()+1));
                var fechaesp = meses[r.getMonth()] + ' DE ' + r.getUTCFullYear();
                var r2final = new Date(new Date(r2).setDate(r.getDate()-1));
                console.log("r2 " +r2final);
                var fechaesp1 = r.getDate()+' '+meses[r.getMonth()] + ' DE ' + r.getUTCFullYear();
                console.log(fechaesp1);
                var fechaesp2 = (r2final.getDate()) +' '+ meses[r2final.getMonth()] + ' DE ' + r2final.getUTCFullYear(); 
                console.log(fechaesp2);
                xx++;
                console.log("XX"+xx);
                if(xx == "{{$novcontdosisededepto->mes_asignacion}}"){
                    document.getElementById('mes'+"{{$novcontdosisededepto->mes_asignacion}}").innerHTML = fechaesp1+' - '+fechaesp2;
                }
            }
        }else if("{{$novcontdosisededepto->contratodosimetriasededepto->contratodosimetriasede->dosimetriacontrato->periodo_recambio}}" == 'BIMS'){
            var ultimoDiaPM = new Date(fecha.getFullYear(), fecha.getMonth() + 2, 1);
            console.log("ULTIMO DIA PRIMER MES:"+ ultimoDiaPM);
            for(var i=0; i<=(numLec+1); i= i+2){
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
                
                if(xx == "{{$novcontdosisededepto->mes_asignacion}}"){
                    document.getElementById('mes'+"{{$novcontdosisededepto->mes_asignacion}}").innerHTML = fechaesp1+' - '+fechaesp2;
                }
            }
        }else if("{{$novcontdosisededepto->contratodosimetriasededepto->contratodosimetriasede->dosimetriacontrato->periodo_recambio}}" == 'TRIMS'){
            var ultimoDiaPM = new Date(fecha.getFullYear(), fecha.getMonth() + 3, 1);
            console.log("ULTIMO DIA PRIMER MES:"+ ultimoDiaPM);
            console.log("numlectura="+numLec);
            for(var i=0; i<=(numLec+1); i= i+3){
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
                console.log("XX"+xx);
                
                if(xx == "{{$novcontdosisededepto->mes_asignacion}}"){
                    document.getElementById('mes'+"{{$novcontdosisededepto->mes_asignacion}}").innerHTML = fechaesp1+' - '+fechaesp2;
                }
            }
        }
        
    })
</script>
@endsection