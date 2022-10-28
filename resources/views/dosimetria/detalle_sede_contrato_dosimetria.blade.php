@extends('layouts.plantillabase')
@section('contenido')


    <div class="row">
        <div class="col-md">
            <a type="button" class="btn btn-circle colorQA" href="{{route('detallecontrato.create', $dosisededeptocontra->contratodosimetriasede->dosimetriacontrato->id_contratodosimetria)}}">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-arrow-left mt-1" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                </svg>
            </a>
        </div>
        <div class="col-md">
            <h2 class="text-center">DOSIMETRÍA DE <br>  <i>{{$dosisededeptocontra->contratodosimetriasede->sede->empresa->nombre_empresa}} - SEDE: {{$dosisededeptocontra->contratodosimetriasede->sede->nombre_sede}}</i> </h2>
        </div>
        <div class="col-md"></div>
    </div>
    <br>
    <h4 class="text-center align-middle">CONTRATO No. {{$dosisededeptocontra->contratodosimetriasede->dosimetriacontrato->codigo_contrato}}</h4>

    <br>
    <h6 class="text-center"> <b>TOTAL DE DOSÍMETROS:</b> CONTROL: # {{$dosisededeptocontra->dosi_control}} -- TÓRAX: # {{$dosisededeptocontra->dosi_torax}}   --  ÁREA: # {{$dosisededeptocontra->dosi_area}}   --  CASO: # {{$dosisededeptocontra->dosi_caso}} -- CRISTALINO: # {{$dosisededeptocontra->dosi_cristalino}} --  MUÑECA: # {{$dosisededeptocontra->dosi_muñeca}} -- DEDO: # {{$dosisededeptocontra->dosi_dedo}}</h6>

    <div class="row">
        <div class="col"></div>
        <div class="col-9">
            <div class="table table-responsive p-4">
                <table class="table table-bordered ">
                    <thead class="table-active">
                        <tr >
                            <th colspan="5" class=" text-center">ESPECIALIDAD: {{$dosisededeptocontra->departamentosede->nombre_departamento}}</th>
                        </tr>
                        <tr>
                            <th class="text-center align-middle" style='width: 8.90%'>NÚMERO</th>
                            <th class="text-center align-middle" style='width: 20.50%' >MESES</th>
                            {{-- <th class="text-center align-middle" style='width: 18.90%' >TRABAJADORES ASIGNADOS</th>
                            <th class="text-center align-middle" style='width: 18.90%' >DOSÍMETROS DISPONIBLES</th> --}}
                            <th class="text-center align-middle">ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>

                        @for($i=0; $i<12; $i++)
                            
                            <tr>
                                <th class="text-center align-middle">
                                    {{$i+1}}
                                </th>
                                <th class="align-middle">
                                   {{--  <a class="link-dark" href="{{route('asignadosicontrato.info', [ 'asigdosicont' => $dosisededeptocontra->id_contdosisededepto , 'mesnumber' => $i+1 ])}}">MES {{$i+1}} </a><br> --}}
                                    @if($i==0)
                                        @php
                                            $meses = ["01"=>'ENERO', "02"=>'FEBRERO', "03"=>'MARZO', "04"=>'ABRIL', "05"=>'MAYO', "06"=>'JUNIO', "07"=>'JULIO', "08"=>'AGOSTO', "09"=>'SEPTIEMBRE', "10"=>'OCTUBRE', "11"=>'NOVIEMBRE', "12"=>'DICIEMBRE'];
                                            echo $meses[date("m", strtotime($dosisededeptocontra->contratodosimetriasede->dosimetriacontrato->fecha_inicio))]." DE ".date("Y", strtotime($dosisededeptocontra->contratodosimetriasede->dosimetriacontrato->fecha_inicio)) ;
                                        @endphp
                                    @else
                                        <span id="mes{{$i}}"></span>
                                    @endif
                                </th>
                                
                                <td class='text-center'>
                                    <div class="row align-items-center"> 
                                        @if($mesTotal[$i]>0)
                                            @if(  $i == '0' )
                                                <div class="col-md text-center">
                                                    <a onclick="return false"  style="background-color: #a0aec0" href="{{route('asignadosicontratom1.create', ['asigdosicont' => $dosisededeptocontra->id_contdosisededepto, 'mesnumber' => $i+1 ])}}" class="btn  btn-sm aling-middle">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-arrow-bar-right" viewBox="0 0 16 16">
                                                            <path fill-rule="evenodd" d="M6 8a.5.5 0 0 0 .5.5h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L12.293 7.5H6.5A.5.5 0 0 0 6 8zm-2.5 7a.5.5 0 0 1-.5-.5v-13a.5.5 0 0 1 1 0v13a.5.5 0 0 1-.5.5z"/>
                                                        </svg> <br> ASIGNAR
                                                    </a>
                                                </div> 
                                                <div class="col-md text-center ">
                                                    <a class="btn btn-sm boton-alert colorQA " href="{{route('etiquetasdosimetria.pdf', ['deptodosi' => $dosisededeptocontra->id_contdosisededepto, 'mesnumber' => $i+1])}}" target="_blank">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-ticket-detailed" viewBox="0 0 16 16">
                                                            <path d="M4 5.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5Zm0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5ZM5 7a1 1 0 0 0 0 2h6a1 1 0 1 0 0-2H5Z"/>
                                                            <path d="M0 4.5A1.5 1.5 0 0 1 1.5 3h13A1.5 1.5 0 0 1 16 4.5V6a.5.5 0 0 1-.5.5 1.5 1.5 0 0 0 0 3 .5.5 0 0 1 .5.5v1.5a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 11.5V10a.5.5 0 0 1 .5-.5 1.5 1.5 0 1 0 0-3A.5.5 0 0 1 0 6V4.5ZM1.5 4a.5.5 0 0 0-.5.5v1.05a2.5 2.5 0 0 1 0 4.9v1.05a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-1.05a2.5 2.5 0 0 1 0-4.9V4.5a.5.5 0 0 0-.5-.5h-13Z"/>
                                                        </svg> <br> ETIQUETAS
                                                    </a>
                                                </div>
                                                <div class="col-md text-center">
                                                    @foreach($mes1AssignRev as $mes1)
                                                        @if($mes1->revision == NULL)
                                                            <a class="btn bg-warning btn-sm boton-alert"  href="{{route('revisiondosimetria.check', ['deptodosi' => $dosisededeptocontra->id_contdosisededepto, 'mesnumber' => $i+1] )}}">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" fill="currentColor" class="bi bi-box-arrow-up" viewBox="0 0 16 16">
                                                                    <path fill-rule="evenodd" d="M3.5 6a.5.5 0 0 0-.5.5v8a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5v-8a.5.5 0 0 0-.5-.5h-2a.5.5 0 0 1 0-1h2A1.5 1.5 0 0 1 14 6.5v8a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 14.5v-8A1.5 1.5 0 0 1 3.5 5h2a.5.5 0 0 1 0 1h-2z"/>
                                                                    <path fill-rule="evenodd" d="M7.646.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 1.707V10.5a.5.5 0 0 1-1 0V1.707L5.354 3.854a.5.5 0 1 1-.708-.708l3-3z"/>
                                                                </svg><br> REVISIÓN SALIDA
                                                            </a>
                                                            @break
                                                        @else
                                                            <a class="btn colorQA btn-sm boton-alert"  href="{{route('revisiondosimetria.check', ['deptodosi' => $dosisededeptocontra->id_contdosisededepto, 'mesnumber' => $i+1] )}}">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" fill="currentColor" class="bi bi-box-arrow-up" viewBox="0 0 16 16">
                                                                    <path fill-rule="evenodd" d="M3.5 6a.5.5 0 0 0-.5.5v8a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5v-8a.5.5 0 0 0-.5-.5h-2a.5.5 0 0 1 0-1h2A1.5 1.5 0 0 1 14 6.5v8a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 14.5v-8A1.5 1.5 0 0 1 3.5 5h2a.5.5 0 0 1 0 1h-2z"/>
                                                                    <path fill-rule="evenodd" d="M7.646.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 1.707V10.5a.5.5 0 0 1-1 0V1.707L5.354 3.854a.5.5 0 1 1-.708-.708l3-3z"/>
                                                                </svg> <br> REVISIÓN SALIDA
                                                            </a>
                                                            @break
                                                        @endif
                                                    @endforeach
                                                </div>
                                                <div class="col-md text-center">
                                                    <a class="btn colorQA btn-sm boton-alert"  href="{{route('revisiondosimetriaEntrada.check', ['deptodosi' => $dosisededeptocontra->id_contdosisededepto, 'mesnumber' => $i+1] )}}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-box-arrow-in-up" viewBox="0 0 16 16">
                                                            <path fill-rule="evenodd" d="M3.5 10a.5.5 0 0 1-.5-.5v-8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 .5.5v8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 0 0 1h2A1.5 1.5 0 0 0 14 9.5v-8A1.5 1.5 0 0 0 12.5 0h-9A1.5 1.5 0 0 0 2 1.5v8A1.5 1.5 0 0 0 3.5 11h2a.5.5 0 0 0 0-1h-2z"/>
                                                            <path fill-rule="evenodd" d="M7.646 4.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V14.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3z"/>
                                                        </svg> <br> REVISIÓN ENTRADA
                                                    </a>
                                                </div>
                                                <div class="col-md text-center">
                                                    <a class="btn colorQA btn-sm boton-alert"  href="{{route('asignadosicontrato.info', [ 'asigdosicont' => $dosisededeptocontra->id_contdosisededepto , 'mesnumber' => $i+1 ])}}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-card-checklist" viewBox="0 0 16 16">
                                                            <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                                                            <path d="M7 5.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0zM7 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0z"/>
                                                        </svg> <br> LECTURA
                                                    </a>
                                                </div>
                                                <div class="col-md text-center">
                                                    <a class="btn colorQA btn-sm boton-alert" href="{{route('repodosimetria.pdf', ['deptodosi' => $dosisededeptocontra->id_contdosisededepto, 'mesnumber' => $i+1] )}}" target="_blank" onclick="alertInforme('1');">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-file-earmark-check" viewBox="0 0 16 16">
                                                            <path d="M10.854 7.854a.5.5 0 0 0-.708-.708L7.5 9.793 6.354 8.646a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0l3-3z"/>
                                                            <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z"/>
                                                        </svg> <br> INFORMES
                                                    </a>
                                                </div> 
                                                
                                            @else
                                                <div class="col-md text-center">
                                                    <a onclick="return false" style="background-color: #a0aec0"  href="{{route('asignadosicontratomn.create', ['asigdosicont' => $dosisededeptocontra->id_contdosisededepto, 'mesnumber' => $i+1 ])}}" class="btn btn-sm">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-arrow-bar-right" viewBox="0 0 16 16">
                                                            <path fill-rule="evenodd" d="M6 8a.5.5 0 0 0 .5.5h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L12.293 7.5H6.5A.5.5 0 0 0 6 8zm-2.5 7a.5.5 0 0 1-.5-.5v-13a.5.5 0 0 1 1 0v13a.5.5 0 0 1-.5.5z"/>
                                                        </svg> <br> ASIGNAR
                                                    </a>
                                                </div>
                                                <div class="col-md text-center">
                                                    <a class="btn btn-sm boton-alert colorQA" href="{{route('etiquetasdosimetria.pdf', ['deptodosi' => $dosisededeptocontra->id_contdosisededepto, 'mesnumber' => $i+1])}}" target="_blank">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-ticket-detailed" viewBox="0 0 16 16">
                                                            <path d="M4 5.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5Zm0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5ZM5 7a1 1 0 0 0 0 2h6a1 1 0 1 0 0-2H5Z"/>
                                                            <path d="M0 4.5A1.5 1.5 0 0 1 1.5 3h13A1.5 1.5 0 0 1 16 4.5V6a.5.5 0 0 1-.5.5 1.5 1.5 0 0 0 0 3 .5.5 0 0 1 .5.5v1.5a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 11.5V10a.5.5 0 0 1 .5-.5 1.5 1.5 0 1 0 0-3A.5.5 0 0 1 0 6V4.5ZM1.5 4a.5.5 0 0 0-.5.5v1.05a2.5 2.5 0 0 1 0 4.9v1.05a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-1.05a2.5 2.5 0 0 1 0-4.9V4.5a.5.5 0 0 0-.5-.5h-13Z"/>
                                                        </svg> <br> ETIQUETAS
                                                    </a>
                                                </div>
                                                <div class="col-md text-center">
                                                   
                                                    {{-- @foreach(${"mesAssignRev".$i+1} as $mes) --}}
                                                    @foreach($mesesAssig[$i] as $mes)
                                                        @if($mes->revision == NULL)
                                                            <a class="btn bg-warning btn-sm boton-alert"  href="{{route('revisiondosimetria.check', ['deptodosi' => $dosisededeptocontra->id_contdosisededepto, 'mesnumber' => $i+1] )}}">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" fill="currentColor" class="bi bi-box-arrow-up" viewBox="0 0 16 16">
                                                                    <path fill-rule="evenodd" d="M3.5 6a.5.5 0 0 0-.5.5v8a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5v-8a.5.5 0 0 0-.5-.5h-2a.5.5 0 0 1 0-1h2A1.5 1.5 0 0 1 14 6.5v8a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 14.5v-8A1.5 1.5 0 0 1 3.5 5h2a.5.5 0 0 1 0 1h-2z"/>
                                                                    <path fill-rule="evenodd" d="M7.646.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 1.707V10.5a.5.5 0 0 1-1 0V1.707L5.354 3.854a.5.5 0 1 1-.708-.708l3-3z"/>
                                                                </svg> <br> REVISIÓN SALIDA
                                                            </a>
                                                            @break
                                                        @else
                                                            <a class="btn colorQA btn-sm boton-alert"  href="{{route('revisiondosimetria.check', ['deptodosi' => $dosisededeptocontra->id_contdosisededepto, 'mesnumber' => $i+1] )}}">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" fill="currentColor" class="bi bi-box-arrow-up" viewBox="0 0 16 16">
                                                                    <path fill-rule="evenodd" d="M3.5 6a.5.5 0 0 0-.5.5v8a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5v-8a.5.5 0 0 0-.5-.5h-2a.5.5 0 0 1 0-1h2A1.5 1.5 0 0 1 14 6.5v8a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 14.5v-8A1.5 1.5 0 0 1 3.5 5h2a.5.5 0 0 1 0 1h-2z"/>
                                                                    <path fill-rule="evenodd" d="M7.646.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 1.707V10.5a.5.5 0 0 1-1 0V1.707L5.354 3.854a.5.5 0 1 1-.708-.708l3-3z"/>
                                                                </svg> <br> REVISIÓN SALIDA
                                                            </a>
                                                            @break
                                                        @endif
                                                    @endforeach
                                                </div>
                                                <div class="col-md text-center">
                                                    <a class="btn colorQA btn-sm boton-alert"  href="{{route('revisiondosimetriaEntrada.check', ['deptodosi' => $dosisededeptocontra->id_contdosisededepto, 'mesnumber' => $i+1] )}}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-box-arrow-in-up" viewBox="0 0 16 16">
                                                            <path fill-rule="evenodd" d="M3.5 10a.5.5 0 0 1-.5-.5v-8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 .5.5v8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 0 0 1h2A1.5 1.5 0 0 0 14 9.5v-8A1.5 1.5 0 0 0 12.5 0h-9A1.5 1.5 0 0 0 2 1.5v8A1.5 1.5 0 0 0 3.5 11h2a.5.5 0 0 0 0-1h-2z"/>
                                                            <path fill-rule="evenodd" d="M7.646 4.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V14.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3z"/>
                                                        </svg> <br> REVISIÓN ENTRADA
                                                    </a>
                                                </div>
                                                <div class="col-md text-center">
                                                    <a class="btn colorQA btn-sm boton-alert"  href="{{route('asignadosicontrato.info', [ 'asigdosicont' => $dosisededeptocontra->id_contdosisededepto , 'mesnumber' => $i+1 ])}}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-card-checklist" viewBox="0 0 16 16">
                                                            <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                                                            <path d="M7 5.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0zM7 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0z"/>
                                                        </svg> <br> LECTURA
                                                    </a>
                                                </div>
                                                <div class="col-md text-center">
                                                    
                                                    <a class="btn colorQA btn-sm boton-alert" {{-- href="{{route('repodosimetria.pdf', ['deptodosi' => $dosisededeptocontra->id_contdosisededepto, 'mesnumber' => $i+1] )}}" target="_blank" --}} id="botoninfo" onclick="alertInforme('{{$i}}', '{{$dosisededeptocontra->id_contdosisededepto}}' );">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-file-earmark-check" viewBox="0 0 16 16">
                                                            <path d="M10.854 7.854a.5.5 0 0 0-.708-.708L7.5 9.793 6.354 8.646a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0l3-3z"/>
                                                            <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z"/>
                                                        </svg> <br> INFORMES
                                                    </a>
                                                </div>
                                                
                                            @endif
                                        @else
                                            @if(  $i == '0' )
                                                <div class="col-md text-center">
                                                    <a  href="{{route('asignadosicontratom1.create', ['asigdosicont' => $dosisededeptocontra->id_contdosisededepto, 'mesnumber' => $i+1 ])}}" class="btn colorQA btn-sm">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-arrow-bar-right" viewBox="0 0 16 16">
                                                            <path fill-rule="evenodd" d="M6 8a.5.5 0 0 0 .5.5h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L12.293 7.5H6.5A.5.5 0 0 0 6 8zm-2.5 7a.5.5 0 0 1-.5-.5v-13a.5.5 0 0 1 1 0v13a.5.5 0 0 1-.5.5z"/>
                                                        </svg> <br> ASIGNAR
                                                    </a>
                                                </div> 
                                                <div class="col-md text-center">
                                                    <a class="btn btn-sm boton-alert bg-warning" href="{{route('etiquetasdosimetria.pdf', ['deptodosi' => $dosisededeptocontra->id_contdosisededepto, 'mesnumber' => $i+1])}}" target="_blank">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-ticket-detailed" viewBox="0 0 16 16">
                                                            <path d="M4 5.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5Zm0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5ZM5 7a1 1 0 0 0 0 2h6a1 1 0 1 0 0-2H5Z"/>
                                                            <path d="M0 4.5A1.5 1.5 0 0 1 1.5 3h13A1.5 1.5 0 0 1 16 4.5V6a.5.5 0 0 1-.5.5 1.5 1.5 0 0 0 0 3 .5.5 0 0 1 .5.5v1.5a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 11.5V10a.5.5 0 0 1 .5-.5 1.5 1.5 0 1 0 0-3A.5.5 0 0 1 0 6V4.5ZM1.5 4a.5.5 0 0 0-.5.5v1.05a2.5 2.5 0 0 1 0 4.9v1.05a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-1.05a2.5 2.5 0 0 1 0-4.9V4.5a.5.5 0 0 0-.5-.5h-13Z"/>
                                                        </svg> <br> ETIQUETAS
                                                    </a>
                                                </div>
                                                <div class="col-md text-center">
                                                    <a class="btn btn-sm boton-alert" onclick="return false"  style="background-color: #a0aec0" href="{{route('revisiondosimetria.check', ['deptodosi' => $dosisededeptocontra->id_contdosisededepto, 'mesnumber' => $i+1] )}}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" fill="currentColor" class="bi bi-box-arrow-up" viewBox="0 0 16 16">
                                                            <path fill-rule="evenodd" d="M3.5 6a.5.5 0 0 0-.5.5v8a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5v-8a.5.5 0 0 0-.5-.5h-2a.5.5 0 0 1 0-1h2A1.5 1.5 0 0 1 14 6.5v8a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 14.5v-8A1.5 1.5 0 0 1 3.5 5h2a.5.5 0 0 1 0 1h-2z"/>
                                                            <path fill-rule="evenodd" d="M7.646.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 1.707V10.5a.5.5 0 0 1-1 0V1.707L5.354 3.854a.5.5 0 1 1-.708-.708l3-3z"/>
                                                        </svg> <br> REVISIÓN SALIDA
                                                    </a>
                                                </div>
                                                <div class="col-md text-center">
                                                    <a class="btn  btn-sm boton-alert" onclick="return false"  style="background-color: #a0aec0"  href="{{route('revisiondosimetriaEntrada.check', ['deptodosi' => $dosisededeptocontra->id_contdosisededepto, 'mesnumber' => $i+1] )}}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-box-arrow-in-up" viewBox="0 0 16 16">
                                                            <path fill-rule="evenodd" d="M3.5 10a.5.5 0 0 1-.5-.5v-8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 .5.5v8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 0 0 1h2A1.5 1.5 0 0 0 14 9.5v-8A1.5 1.5 0 0 0 12.5 0h-9A1.5 1.5 0 0 0 2 1.5v8A1.5 1.5 0 0 0 3.5 11h2a.5.5 0 0 0 0-1h-2z"/>
                                                            <path fill-rule="evenodd" d="M7.646 4.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V14.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3z"/>
                                                        </svg> <br> REVISIÓN ENTRADA
                                                    </a>
                                                </div>
                                                <div class="col-md text-center">
                                                    <a class="btn  btn-sm boton-alert" onclick="return false"  style="background-color: #a0aec0" href="{{route('asignadosicontrato.info', [ 'asigdosicont' => $dosisededeptocontra->id_contdosisededepto , 'mesnumber' => $i+1 ])}}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-card-checklist" viewBox="0 0 16 16">
                                                            <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                                                            <path d="M7 5.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0zM7 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0z"/>
                                                        </svg> <br> LECTURA
                                                    </a>
                                                </div>
                                                <div class="col-md text-center">
                                                    
                                                    <a class="btn btn-sm boton-alert" onclick="return false"  style="background-color: #a0aec0" href="{{route('repodosimetria.pdf', ['deptodosi' => $dosisededeptocontra->id_contdosisededepto, 'mesnumber' => $i+1] )}}" target="_blank">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-file-earmark-check" viewBox="0 0 16 16">
                                                            <path d="M10.854 7.854a.5.5 0 0 0-.708-.708L7.5 9.793 6.354 8.646a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0l3-3z"/>
                                                            <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z"/>
                                                        </svg> <br> INFORMES
                                                    </a>
                                                </div> 
                                                
                                            @else
                                                <div class="col-md text-center">
                                                    <a  href="{{route('asignadosicontratomn.create', ['asigdosicont' => $dosisededeptocontra->id_contdosisededepto, 'mesnumber' => $i+1 ])}}" class="btn colorQA btn-sm">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-arrow-bar-right" viewBox="0 0 16 16">
                                                            <path fill-rule="evenodd" d="M6 8a.5.5 0 0 0 .5.5h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L12.293 7.5H6.5A.5.5 0 0 0 6 8zm-2.5 7a.5.5 0 0 1-.5-.5v-13a.5.5 0 0 1 1 0v13a.5.5 0 0 1-.5.5z"/>
                                                        </svg> <br> ASIGNAR
                                                    </a>
                                                </div>
                                                <div class="col-md text-center">
                                                    <a class="btn btn-sm boton-alert" onclick="return false"  style="background-color: #a0aec0" href="{{route('etiquetasdosimetria.pdf', ['deptodosi' => $dosisededeptocontra->id_contdosisededepto, 'mesnumber' => $i+1])}}" target="_blank">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-ticket-detailed" viewBox="0 0 16 16">
                                                            <path d="M4 5.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5Zm0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5ZM5 7a1 1 0 0 0 0 2h6a1 1 0 1 0 0-2H5Z"/>
                                                            <path d="M0 4.5A1.5 1.5 0 0 1 1.5 3h13A1.5 1.5 0 0 1 16 4.5V6a.5.5 0 0 1-.5.5 1.5 1.5 0 0 0 0 3 .5.5 0 0 1 .5.5v1.5a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 11.5V10a.5.5 0 0 1 .5-.5 1.5 1.5 0 1 0 0-3A.5.5 0 0 1 0 6V4.5ZM1.5 4a.5.5 0 0 0-.5.5v1.05a2.5 2.5 0 0 1 0 4.9v1.05a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-1.05a2.5 2.5 0 0 1 0-4.9V4.5a.5.5 0 0 0-.5-.5h-13Z"/>
                                                        </svg> <br> ETIQUETAS
                                                    </a>
                                                </div>
                                                <div class="col-md text-center">
                                                    <a class="btn btn-sm boton-alert" onclick="return false"  style="background-color: #a0aec0" href="{{route('revisiondosimetria.check', ['deptodosi' => $dosisededeptocontra->id_contdosisededepto, 'mesnumber' => $i+1] )}}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" fill="currentColor" class="bi bi-box-arrow-up" viewBox="0 0 16 16">
                                                            <path fill-rule="evenodd" d="M3.5 6a.5.5 0 0 0-.5.5v8a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5v-8a.5.5 0 0 0-.5-.5h-2a.5.5 0 0 1 0-1h2A1.5 1.5 0 0 1 14 6.5v8a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 14.5v-8A1.5 1.5 0 0 1 3.5 5h2a.5.5 0 0 1 0 1h-2z"/>
                                                            <path fill-rule="evenodd" d="M7.646.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 1.707V10.5a.5.5 0 0 1-1 0V1.707L5.354 3.854a.5.5 0 1 1-.708-.708l3-3z"/>
                                                        </svg> <br> REVISIÓN SALIDA
                                                    </a>
                                                </div>
                                                <div class="col-md text-center">
                                                    <a class="btn  btn-sm boton-alert" onclick="return false"  style="background-color: #a0aec0"  href="{{route('revisiondosimetriaEntrada.check', ['deptodosi' => $dosisededeptocontra->id_contdosisededepto, 'mesnumber' => $i+1] )}}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-box-arrow-in-up" viewBox="0 0 16 16">
                                                            <path fill-rule="evenodd" d="M3.5 10a.5.5 0 0 1-.5-.5v-8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 .5.5v8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 0 0 1h2A1.5 1.5 0 0 0 14 9.5v-8A1.5 1.5 0 0 0 12.5 0h-9A1.5 1.5 0 0 0 2 1.5v8A1.5 1.5 0 0 0 3.5 11h2a.5.5 0 0 0 0-1h-2z"/>
                                                            <path fill-rule="evenodd" d="M7.646 4.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V14.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3z"/>
                                                        </svg> <br> REVISIÓN ENTRADA
                                                    </a>
                                                </div>
                                                <div class="col-md text-center">
                                                    <a class="btn btn-sm boton-alert" onclick="return false"  style="background-color: #a0aec0" href="{{route('asignadosicontrato.info', [ 'asigdosicont' => $dosisededeptocontra->id_contdosisededepto , 'mesnumber' => $i+1 ])}}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-card-checklist" viewBox="0 0 16 16">
                                                            <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                                                            <path d="M7 5.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0zM7 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0z"/>
                                                        </svg> <br> LECTURA
                                                    </a>
                                                </div>
                                                <div class="col-md text-center">
                                                    
                                                    <a class="btn btn-sm boton-alert"  onclick="return false"  style="background-color: #a0aec0" href="{{route('repodosimetria.pdf', ['deptodosi' => $dosisededeptocontra->id_contdosisededepto, 'mesnumber' => $i+1] )}}" target="_blank">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-file-earmark-check" viewBox="0 0 16 16">
                                                            <path d="M10.854 7.854a.5.5 0 0 0-.708-.708L7.5 9.793 6.354 8.646a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0l3-3z"/>
                                                            <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z"/>
                                                        </svg> <br> INFORMES
                                                    </a>
                                                </div>
                                                
                                            @endif
                                        @endif
                                        
                                    </div>
                                </td>
                            </tr>
                        @endfor


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
@if(session('fallo')=='ok')
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'REVISE SI TIENE EL CONTACTO DE DOSIMETRÍA !!!',
        })
    </script>
@endif

<script type="text/javascript">
    $(document).ready(function(){
        // Creamos array con los meses del año
        const meses = ['ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO', 'JULIO', 'AGOSTO', 'SEPTIEMBRE', 'OCTUBRE', 'NOVIEMBRE', 'DICIEMBRE'];
        let fecha = new Date("{{$dosisededeptocontra->contratodosimetriasede->dosimetriacontrato->fecha_inicio}}");
        fecha.setMinutes(fecha.getMinutes() + fecha.getTimezoneOffset());
        console.log(fecha)
        for($i=1; $i<=11; $i++){

            var r = new Date(new Date(fecha).setMonth(fecha.getMonth()+$i));
            var fechaesp = meses[r.getMonth()] + ' DE ' + r.getUTCFullYear();
            document.getElementById('mes'+$i).innerHTML = fechaesp;
            
            console.log(fechaesp); 
        }
        /* $('#botoninfo').click(function(e){
            e.preventDefault();
            console.log("SE SELECCIONO EL BOTON");
            Swal.fire({
                text: "ALGUNOS DOSIMETROS NO TIENEN REGISTRO DE LECTURA !!!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#1A9980',
                cancelButtonColor: '#d33',
                confirmButtonText: 'SI, SEGURO!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.open("repodosimetria/{deptodosi}/{mesnumber}/pdf", " _blank");
                    }
                })
        })   */ 
         
    });
    function alertInforme(i, depto){
        console.log("hoaaa");
        console.log(depto);
        var host = window.location.host;
        var path = "http://"+host+"/POSITRON/public/repodosimetria/1/3/pdf";
        console.log(host+"/POSITRON/public/repodosimetria/1/3/pdf");
        /* window.open(path, '_blank'); */
        var mesesAsing = {!! json_encode($mesesAssig) !!};
        const mesesA = mesesAsing[i];
        mesesA.forEach(mesw => {
            console.log(mesw)
            if(mesw.ubicacion == 'TORAX'){
                if(mesw.Hp007_calc_dose == null || mesw.Hp10_calc_dose == null || mesw.Hp3_calc_dose == null){
                    Swal.fire({
                        text: "ALGUNOS DOSIMETROS NO TIENEN REGISTRO DE LECTURA !!!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#1A9980',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'SI, SEGURO!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.open(path, '_blank');
                        }
                    })
                }else{
                    window.open(path, '_blank');
                }
            }
            
        });
    }
</script>
@endsection
