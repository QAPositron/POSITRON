@extends('layouts.app')
@extends('layouts.plantillabase')
@section('contenido')
<div class="row">
    <div class="col-md"></div>
    <div class="col-md-15">
        <div class="card text-dark bg-light">
            <br>
            <h2 class="text-center">ASIGNACIÓN DOSÍMETROS</h2>
            <h3 class="text-center" id="nueva_empresaModalLabel"> <br> <i>{{$contdosisededepto->contratodosimetriasede->sede->empresa->nombre_empresa}} - SEDE: {{$contdosisededepto->contratodosimetriasede->sede->nombre_sede}}</i> <br>
                ESP.: {{$contdosisededepto->departamentosede->departamento->nombre_departamento}} <br>
                PERÍODO {{$mesnumber}}
                @if($contdosisededepto->contratodosimetriasede->dosimetriacontrato->periodo_recambio == 'MENS')
                    ( <span>
                        @php  
                            $meses = ["01"=>'ENERO', "02"=>'FEBRERO', "03"=>'MARZO', "04"=>'ABRIL', "05"=>'MAYO', "06"=>'JUNIO', "07"=>'JULIO', "08"=>'AGOSTO', "09"=>'SEPTIEMBRE', "10"=>'OCTUBRE', "11"=>'NOVIEMBRE', "12"=>'DICIEMBRE'];
                            $fecha1 = $contdosisededepto->contratodosimetriasede->dosimetriacontrato->fecha_inicio;
                            $fecha2 = date("t-m-Y",strtotime($fecha1));
                            echo date("j", strtotime($fecha1))." ".$meses[date("m", strtotime($fecha1))]." DE ".date("Y", strtotime($fecha1))." - ".date("t", strtotime($fecha2))." ".$meses[date("m", strtotime($fecha2))]." DE ".date("Y", strtotime($fecha2))
                        @endphp
                    </span> )
                @elseif($contdosisededepto->contratodosimetriasede->dosimetriacontrato->periodo_recambio == 'TRIMS')
                    ( <span>
                        @php  
                            $meses = ["01"=>'ENERO', "02"=>'FEBRERO', "03"=>'MARZO', "04"=>'ABRIL', "05"=>'MAYO', "06"=>'JUNIO', "07"=>'JULIO', "08"=>'AGOSTO', "09"=>'SEPTIEMBRE', "10"=>'OCTUBRE', "11"=>'NOVIEMBRE', "12"=>'DICIEMBRE'];
                            $inicio = date($contdosisededepto->contratodosimetriasede->dosimetriacontrato->fecha_inicio);
                            $fecha1 = date("t-m-Y",strtotime($inicio));
                            $fecha2= date("t-m-Y",strtotime($fecha1."+ 2 month"));
                            echo date("j", strtotime($inicio))." ".$meses[date("m", strtotime($inicio))]." DE ".date("Y", strtotime($inicio))." - ".date("j", strtotime($fecha2))." ".$meses[date("m", strtotime($fecha2))]." DE ".date("Y", strtotime($fecha2))
                        @endphp
                    </span> )
                @elseif($contdosisededepto->contratodosimetriasede->dosimetriacontrato->periodo_recambio == 'BIMS')
                    ( <span>
                        @php  
                            $meses = ["01"=>'ENERO', "02"=>'FEBRERO', "03"=>'MARZO', "04"=>'ABRIL', "05"=>'MAYO', "06"=>'JUNIO', "07"=>'JULIO', "08"=>'AGOSTO', "09"=>'SEPTIEMBRE', "10"=>'OCTUBRE', "11"=>'NOVIEMBRE', "12"=>'DICIEMBRE'];
                            $fecha1 = date($contdosisededepto->contratodosimetriasede->dosimetriacontrato->fecha_inicio);
                            $fecha2_total = date("t-m-Y",strtotime($fecha1."+ 1 month"));
                            echo date("j", strtotime($fecha1))." ".$meses[date("m", strtotime($fecha1))]." DE ".date("Y", strtotime($fecha1))." - ".date("j", strtotime($fecha2_total))." ".$meses[date("m", strtotime($fecha2_total))]." DE ".date("Y", strtotime($fecha2_total))
                        @endphp
                    </span> )
                @endif
                 
            </h3>

            <form action="{{route('asignadosicontratom1.save', ['asigdosicont'=> $contdosisededepto->id_contdosisededepto, 'mesnumber'=>$mesnumber])}}" method="POST"  id="form-nueva-asignacion" name="form-nueva-asignacion" class="form-nueva-asignacion m-4">
                @csrf
                
                {{-- <label class="text-center mx-5">INGRESE LA INFORMACIÓN CORRESPONDIENTE PARA REALIZAR LAS ASIGNACIONES QUE ESTAN PENDIENTES EN EL CONTRATO DE DOSIMETRÍA:</label> --}}
                
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
                                        {{-- <th class="align-middle">MUÑECA</th> --}}
                                        <th class="align-middle">AMBIENTAL</th>
                                        <th class="align-middle">CASO</th>
                                        @if($contdosisededepto->controlTransT_unicoCont != 'TRUE' && $contdosisededepto->controlTransC_unicoCont != 'TRUE' && $contdosisededepto->controlTransA_unicoCont != 'TRUE')
                                            <th class="align-middle">CONTROL TÓRAX</th>
                                            <th class="align-middle">CONTROL CRISTALINO</th>
                                            <th class="align-middle">CONTROL ANILLO</th>
                                        @endif
                                        <th class="align-middle">TOTAL</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center">{{$contdosisededepto->dosi_torax}}</td>
                                        <td class="text-center">{{$contdosisededepto->dosi_cristalino}}</td>
                                        <td class="text-center">{{$contdosisededepto->dosi_dedo}}</td>
                                        {{-- <td class="text-center">{{$contdosisededepto->dosi_muñeca}}</td> --}}
                                        <td class="text-center">{{$contdosisededepto->dosi_area}}</td>
                                        <td class="text-center">{{$contdosisededepto->dosi_caso}}</td>
                                        @if($contdosisededepto->controlTransT_unicoCont == 'TRUE' || $contdosisededepto->controlTransC_unicoCont == 'TRUE' || $contdosisededepto->controlTransA_unicoCont == 'TRUE')
                                            <td class="text-center">{{$contdosisededepto->dosi_torax + $contdosisededepto->dosi_cristalino + $contdosisededepto->dosi_dedo + $contdosisededepto->dosi_muñeca + $contdosisededepto->dosi_area + $contdosisededepto->dosi_caso}}</td>
                                        @else
                                            <td class="text-center">{{$contdosisededepto->dosi_control_torax}}</td>
                                            <td class="text-center">{{$contdosisededepto->dosi_control_cristalino}}</td>
                                            <td class="text-center">{{$contdosisededepto->dosi_control_dedo}}</td>
                                            <td class="text-center">{{$contdosisededepto->dosi_torax + $contdosisededepto->dosi_cristalino + $contdosisededepto->dosi_dedo + $contdosisededepto->dosi_muñeca + $contdosisededepto->dosi_area + $contdosisededepto->dosi_caso + $contdosisededepto->dosi_control_torax + $contdosisededepto->dosi_control_cristalino + $contdosisededepto->dosi_control_dedo}}</td>
                                        @endif
                                    </tr>
                                </tbody>
                                @if($contdosisededepto->controlTransT_unicoCont == 'TRUE' || $contdosisededepto->controlTransC_unicoCont == 'TRUE' || $contdosisededepto->controlTransA_unicoCont == 'TRUE')
                                    <tfoot>
                                        <tr class="text-center table-active">
                                            <th colspan='9'>DOSÍMETROS DE CONTROL TRANSPORTE</th>
                                        </tr>
                                        <tr class="text-center table-active">
                                            <th  colspan='2' class="align-middle">TÓRAX</th>
                                            <th  colspan='2' class="align-middle">CRISTALINO</th>
                                            <th  colspan='2' class="align-middle">ANILLO</th>
                                        </tr>
                                        <tr class="text-center bg-light">
                                            <td  colspan='2' >{{$contdosisededepto->controlTransT_unicoCont == 'TRUE' ? 1 : 0}}</td>
                                            <td  colspan='2' >{{$contdosisededepto->controlTransC_unicoCont == 'TRUE' ? 1 : 0}}</td>
                                            <td  colspan='2' >{{$contdosisededepto->controlTransA_unicoCont == 'TRUE' ? 1 : 0}}</td>   
                                        </tr>
                                    </tfoot>
                                @endif
                            </table>
                        </div>
                    </div>
                    <div class="col-md"></div>

                </div>
                 
                <div class="row g-2 mx-3">
                    <div class="col-md">
                        <div class="form-floating">
                            <input type="date" class="form-control @error('primerDia_asigdosim') is-invalid @enderror" name="primerDia_asigdosim" id="primerDia_asigdosim" value="{{$contdosisededepto->contratodosimetriasede->dosimetriacontrato->fecha_inicio}}">
                            <label for="floatingInputGrid">PRIMER DÍA</label>
                            @error('primerDia_asigdosim')
                                <small class="invalid-feedback">*{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-floating">
                            <input type="date" class="form-control @error('ultimoDia_asigdosim') is-invalid @enderror" name="ultimoDia_asigdosim" id="ultimoDia_asigdosim" 
                            @if($contdosisededepto->contratodosimetriasede->dosimetriacontrato->periodo_recambio == 'MENS')
                                value="{{date("Y-m-t",strtotime($contdosisededepto->contratodosimetriasede->dosimetriacontrato->fecha_inicio))}}"
                            @elseif($contdosisededepto->contratodosimetriasede->dosimetriacontrato->periodo_recambio == 'TRIMS')
                                @php
                                    $inicio = date($contdosisededepto->contratodosimetriasede->dosimetriacontrato->fecha_inicio);
                                    $fecha1 = date("t-m-Y",strtotime($inicio));
                                    $fecha2= date("t-m-Y",strtotime($fecha1."+ 2 month"));
                                @endphp
                                value="{{date("Y-m-t",strtotime($fecha2))}}"
                            @elseif($contdosisededepto->contratodosimetriasede->dosimetriacontrato->periodo_recambio == 'BIMS')
                                @php  
                                    $fecha1 = date($contdosisededepto->contratodosimetriasede->dosimetriacontrato->fecha_inicio);
                                    $fecha2_total = date("t-m-Y",strtotime($fecha1."+ 1 month"));
                                @endphp
                                value="{{date("Y-m-t",strtotime($fecha2_total))}}"
                            @endif>
                            <label for="floatingInputGrid">ULTIMO DÍA:</label>
                            @error('ultimoDia_asigdosim')
                                <small class="invalid-feedback">*{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-floating">
                            <input type="date" class="form-control" name="fecha_envio_dosim_asignado" id="fecha_envio_dosim_asignado" >
                            <label for="floatingInputGrid">FECHA ENVÍO AL USUARIO</label>
                            
                        </div>
                    </div>
                </div> 
                <br> 
                <div class="row g-2 mx-3">
                    <div class="col-md">
                        <div class="form-floating">
                            <input type="text" class="form-control" name="energia_asigdosim" id="energia_asigdosim" value="F" readonly>
                            <label for="floatingInputGrid">ENERGÍA:</label>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-floating">
                            <input type="text" class="form-control" name="periodorecambio_asigdosim" id="periodorecambio_asigdosim" value="{{$contdosisededepto->contratodosimetriasede->dosimetriacontrato->periodo_recambio}}" readonly>
                            <label for="floatingInputGrid">PERIODO RECAMBIO:</label>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-floating">
                            <input type="text" class="form-control" name="ocupacion_asigdosim" id="ocupacion_asigdosim" value="{{$contdosisededepto->contratodosimetriasede->dosimetriacontrato->ocupacion}}" readonly>
                            <label for="floatingInputGrid">OCUPACIÓN:</label>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row g-2 mx-3">
                    <div class="col-md">
                        <div class="table table-responsive text-center">
                            <table class="table table-bordered" id="tablaAsignacionDosimetrosm1">
                                <thead class=" table-active text-center">
                                    <th style='width: 28.20%'>TRABAJADOR / ÁREA</th>
                                    <th style='width: 16.40%'>UBICACIÓN</th>
                                    <th style='width: 16.40%'>DOSÍMETRO</th>
                                    <th style='width: 16.40%'>HOLDER</th>
                                </thead> 
                                <tbody>
                                    
                                    <input hidden name="mesNumber1" id="mesNumber1" value="{{$mesnumber}}">
                                    <input type="number" name="id_departamento_asigdosim" id="id_departamento_asigdosim" hidden value="{{$contdosisededepto->id_contdosisededepto}}">
                                    <input type="number" name="id_contrato_asigdosim_sede" id="id_contrato_asigdosim_sede" hidden value="{{$contdosisededepto->contratodosimetriasede_id}}">
                                    <input type="number" name="id_contrato_asigdosim" id="id_contrato_asigdosim" hidden value="{{$contdosisededepto->contratodosimetriasede->dosimetriacontrato->id_contratodosimetria}}">
                                    {{-- ///Filas creadas para el dosimetro de control transporte TORAX de todo el contrato/////// --}} 
                                    @if($contdosisededepto->controlTransT_unicoCont == 'TRUE')
                                        <tr>
                                            <td colspan='2' class='align-middle text-center'>CONTROL TRANS. T.</td>
                                            <td>
                                                <select class="form-control id_dosimetro_ControlToraxUnico"  name="id_dosimetro_ControlToraxUnico" id="id_dosimetro_ControlToraxUnico" autofocus aria-label="Floating label select example" @if(count($dosimControlTransT) != 0) { disabled } @endif>
                                                    <option value="@if(count($dosimControlTransT) != 0) {{$dosimControlTransT[0]->dosimetro_id}} @endif"> @if(count($dosimControlTransT) != 0) {{$dosimControlTransT[0]->dosimetro->codigo_dosimeter}} @else ---- @endif</option>
                                                    @foreach($dosimLibresGeneral as $dosigenlib)
                                                        <option value="{{$dosigenlib->id_dosimetro}}">{{$dosigenlib->codigo_dosimeter}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td class='align-middle text-center'>N.A.</td>
                                        </tr>
                                    @endif
                                    {{-- ///Filas creadas para el dosimetro de control transporte CRISTALINO de todo el contrato/////// --}} 
                                    @if($contdosisededepto->controlTransC_unicoCont == 'TRUE')
                                        <tr>
                                            <td colspan='2' class='align-middle text-center'>CONTROL TRANS. C.</td>
                                            <td>
                                                <select class="form-select id_dosimetro_ControlCristalinoUnico"  name="id_dosimetro_ControlCristalinoUnico" id="id_dosimetro_ControlCristalinoUnico" autofocus aria-label="Floating label select example" @if(count($dosimControlTransC) != 0) { disabled } @endif>
                                                    <option value="@if(count($dosimControlTransC) != 0) {{$dosimControlTransC[0]->dosimetro_id}} @endif">@if(count($dosimControlTransC) != 0) {{$dosimControlTransC[0]->dosimetro->codigo_dosimeter}} @else ---- @endif</option>
                                                    @foreach($dosimLibresEzclip as $dosiezcliplib)
                                                        <option value="{{$dosiezcliplib->id_dosimetro}}">{{$dosiezcliplib->codigo_dosimeter}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <select class="form-select"  name="id_holder_ControlCristalinoUnico" id="id_holder_ControlCristalinoUnico" autofocus aria-label="Floating label select example" @if(count($dosimControlTransC) != 0) { disabled } @endif>
                                                    <option value="@if(count($dosimControlTransC) != 0){{$dosimControlTransC[0]->holder_id}}@endif">@if(count($dosimControlTransC) != 0) {{$dosimControlTransC[0]->holder->codigo_holder}}@else ---- @endif</option>
                                                    @foreach($holderLibresCristalino as $holibcris)
                                                        <option value="{{$holibcris->id_holder}}">{{$holibcris->codigo_holder}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                        </tr>
                                    @endif
                                    {{-- ///Filas creadas para el dosimetro de control transporte ANILLO de todo el contrato/////// --}} 
                                    @if($contdosisededepto->controlTransA_unicoCont == 'TRUE')
                                        <tr>
                                            <td colspan='2' class='align-middle text-center'>CONTROL TRANS. A.</td>
                                            <td>
                                                <select class="form-select id_dosimetro_ControlDedoUnico"  name="id_dosimetro_ControlDedoUnico" id="id_dosimetro_ControlDedoUnico" @if(count($dosimControlTransA)) { disabled } @endif>
                                                    <option value="@if(count($dosimControlTransA) != 0) {{$dosimControlTransA[0]->dosimetro_id}} @endif"> @if(count($dosimControlTransA) != 0) {{$dosimControlTransA[0]->dosimetro->codigo_dosimeter}} @else ---- @endif</option>
                                                    @foreach($dosimLibresEzclip as $dosiezcliplib)
                                                        <option value="{{$dosiezcliplib->id_dosimetro}}">{{$dosiezcliplib->codigo_dosimeter}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <select class="form-select id_holder_ControlDedoUnico"  name="id_holder_ControlDedoUnico" id="id_holder_ControlDedoUnico" @if(count($dosimControlTransA) != 0) { disabled } @endif>
                                                    <option value="@if(count($dosimControlTransA) != 0){{$dosimControlTransA[0]->holder_id}}@endif">@if(count($dosimControlTransA)!= 0){{$dosimControlTransA[0]->holder->codigo_holder}}@else ---- @endif</option>
                                                    @foreach($holderLibresAnillo as $holibanillo)
                                                        <option value="{{$holibanillo->id_holder}}">{{$holibanillo->codigo_holder}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                        </tr>
                                    @endif
                                    {{-- ///Filas creadas segun la cantidad de dosimetros tipo control_torax DEL primer mes/////// --}}
                                    @for($i=1; $i<=$contdosisededepto->dosi_control_torax; $i++)
                                        <tr>
                                            <td colspan='2' class='align-middle text-center'>CONTROL TÓRAX</td>
                                            <td>
                                                <select class="form-control id_dosimetro_asigdosimControlTorax"  name="id_dosimetro_asigdosimControlTorax[]" id="id_dosimetro_asigdosimControlTorax" autofocus aria-label="Floating label select example">
                                                    <option value="">----</option>
                                                    @foreach($dosimLibresGeneral as $dosigenlib)
                                                        <option value="{{$dosigenlib->id_dosimetro}}">{{$dosigenlib->codigo_dosimeter}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td class='align-middle text-center'>N.A.</td>
                                        </tr>
                                    @endfor
                                    {{-- ///Filas creadas segun la cantidad de dosimetros tipo control_cristalino DEL primer mes/////// --}}
                                    @for($i=1; $i<=$contdosisededepto->dosi_control_cristalino; $i++)
                                        <tr>
                                            <td colspan='2' class='align-middle text-center'>CONTROL CRISTALINO</td>
                                            <td>
                                                <select class="form-select id_dosimetro_asigdosimControlCristalino"  name="id_dosimetro_asigdosimControlCristalino[]" id="id_dosimetro_asigdosimControlCristalino" autofocus aria-label="Floating label select example">
                                                    <option value="">----</option>
                                                    @foreach($dosimLibresEzclip as $dosiezcliplib)
                                                        <option value="{{$dosiezcliplib->id_dosimetro}}">{{$dosiezcliplib->codigo_dosimeter}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <select class="form-select"  name="id_holder_asigdosimControlCristalino[]" id="id_holder_asigdosimControlCristalino" autofocus aria-label="Floating label select example">
                                                    <option value="">----</option>
                                                    @foreach($holderLibresCristalino as $holibcris)
                                                        <option value="{{$holibcris->id_holder}}">{{$holibcris->codigo_holder}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                        </tr>
                                    @endfor
                                    {{-- ///Filas creadas segun la cantidad de dosimetros tipo control_dedo DEL primer mes/////// --}}
                                    @for($i=1; $i<=$contdosisededepto->dosi_control_dedo; $i++)
                                        <tr>
                                            <td colspan='2' class='align-middle text-center'>CONTROL ANILLO</td>
                                            <td>
                                                <select class="form-select id_dosimetro_asigdosimControlDedo"  name="id_dosimetro_asigdosimControlDedo[]" id="id_dosimetro_asigdosimControlDedo" autofocus aria-label="Floating label select example">
                                                    <option value="">----</option>
                                                    @foreach($dosimLibresEzclip as $dosiezcliplib)
                                                        <option value="{{$dosiezcliplib->id_dosimetro}}">{{$dosiezcliplib->codigo_dosimeter}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <select class="form-select"  name="id_holder_asigdosimControlDedo[]" id="id_holder_asigdosimControlDedo" autofocus aria-label="Floating label select example">
                                                    <option value="">----</option>
                                                    @foreach($holderLibresAnillo as $holibanillo)
                                                        <option value="{{$holibanillo->id_holder}}">{{$holibanillo->codigo_holder}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                        </tr>
                                    @endfor
                                    {{-- ///Filas creadas segun la cantidad de dosimetros tipo ambiental que falten por asignar en el primer mes/////// --}}
                                    @for($i=1; $i<=$contdosisededepto->dosi_area; $i++)
                                        @if($mesnumber = 1)
                                            <tr>
                                                <td>
                                                    <select class="form-select id_area_asigdosimArea"  name="id_area_asigdosimArea[]" id="id_area_asigdosimArea" autofocus aria-label="Floating label select example">
                                                        <option value="">----</option>
                                                        @foreach($areaSede as $area)
                                                            <option  value ="{{$area->id_areadepartamentosede}}">{{$area->nombre_area}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td class='align-middle text-center'>ÁREA</td>
                                                <td>
                                                    <select class="form-select id_dosimetro_asigdosimArea"  name="id_dosimetro_asigdosimArea[]" id="id_dosimetro_asigdosimArea" autofocus aria-label="Floating label select example">
                                                        <option value="">----</option>
                                                        @foreach($dosimLibresGeneral as $dosigenlib)
                                                            <option value="{{$dosigenlib->id_dosimetro}}">{{$dosigenlib->codigo_dosimeter}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td class='align-middle text-center'>N.A</td>
                                            </tr>
                                        @endif
                                    @endfor
                                    
                                    {{-- ///Filas creadas segun la cantidad de dosimetros tipo caso que falten por asignar en el primer mes/////// --}}
                                    @for($i=1; $i<=$contdosisededepto->dosi_caso; $i++)
                                        @if($mesnumber = 1)
                                            <tr>
                                                <td>
                                                    <select class="form-select"  name="id_trabajador_asigdosimCaso[]" id="id_trabajador_asigdosimCaso" autofocus aria-label="Floating label select example">
                                                        <option value="">----</option>
                                                        @foreach($personaSede as $persed)
                                                            <option value="{{$persed->id_persona}}">{{$persed->primer_nombre_persona}} {{$persed->segundo_nombre_persona}} {{$persed->primer_apellido_persona}} {{$persed->segundo_apellido_persona}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td class='align-middle text-center'>CASO</td>
                                                <td>
                                                    <select class="form-select"  name="id_dosimetro_asigdosimCaso[]" id="id_dosimetro_asigdosimCaso" autofocus aria-label="Floating label select example">
                                                        <option value="">----</option>
                                                        @foreach($dosimLibresGeneral as $dosigenlib)
                                                            <option value="{{$dosigenlib->id_dosimetro}}">{{$dosigenlib->codigo_dosimeter}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td class='align-middle text-center'>N.A</td>
                                            </tr>
                                        @endif
                                    @endfor

                                    {{-- ///Filas creadas segun la cantidad de dosimetros tipo cuerpo entero que falten por asignar en el primer mes/////// --}}
                                    @for($i=1; $i<=$contdosisededepto->dosi_torax; $i++)
                                        @if($mesnumber = 1) 
                                            <tr>
                                                <td>
                                                    <select class="form-select"  name="id_trabajador_asigdosimTorax[]" id="id_trabajador_asigdosimTorax" autofocus aria-label="Floating label select example">
                                                        <option value="">----</option>
                                                        
                                                        @foreach($personaSede as $persed)
                                                            <option value="{{$persed->id_persona}}">{{$persed->primer_nombre_persona}} {{$persed->segundo_nombre_persona}} {{$persed->primer_apellido_persona}} {{$persed->segundo_apellido_persona}} - ({{$persed->nombre_rol}})</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td class='align-middle text-center'>TÓRAX</td>
                                                <td>
                                                    <select class="form-select"  name="id_dosimetro_asigdosimTorax[]" id="id_dosimetro_asigdosimTorax" autofocus aria-label="Floating label select example">
                                                        <option value="">----</option>
                                                        @foreach($dosimLibresGeneral as $dosigenlib)
                                                            <option value="{{$dosigenlib->id_dosimetro}}">{{$dosigenlib->codigo_dosimeter}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td class='align-middle text-center'>N.A</td>
                                            </tr>
                                        @endif
                                    @endfor
                                        
                                    {{-- ///Filas creadas segun la cantidad de dosimetros tipo CRISTALINO que falten por asignar en el primer mes/////// --}}
                                    @for($i=1; $i<=$contdosisededepto->dosi_cristalino; $i++)
                                        @if($mesnumber = 1)
                                            <tr>
                                                <td>
                                                    <select class="form-select"  name="id_trabajador_asigdosimCristalino[]" id="id_trabajador_asigdosimCristalino" autofocus aria-label="Floating label select example">
                                                        <option value="">----</option>
                                                        
                                                        @foreach($personaSede as $persed)
                                                            <option value="{{$persed->id_persona}}">{{$persed->primer_nombre_persona}} {{$persed->segundo_nombre_persona}} {{$persed->primer_apellido_persona}} {{$persed->segundo_apellido_persona}} - ({{$persed->nombre_rol}})</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td class='align-middle text-center'>CRISTALINO</td>
                                                <td>
                                                    <select class="form-select"  name="id_dosimetro_asigdosimCristalino[]" id="id_dosimetro_asigdosimCristalino" autofocus aria-label="Floating label select example">
                                                        <option value="">----</option>
                                                        @foreach($dosimLibresEzclip as $dosiezcliplib)
                                                            <option value="{{$dosiezcliplib->id_dosimetro}}">{{$dosiezcliplib->codigo_dosimeter}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <select class="form-select"  name="id_holder_asigdosimCristalino[]" id="id_holder_asigdosimCristalino" autofocus aria-label="Floating label select example">
                                                        <option value="">----</option>
                                                        @foreach($holderLibresCristalino as $holibcris)
                                                            <option value="{{$holibcris->id_holder}}">{{$holibcris->codigo_holder}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                            </tr>
                                        @endif
                                    @endfor  

                                    {{-- ///Filas creadas segun la cantidad de dosimetros tipo EXTREMIDAD  que falten por asignar en el primer mes/////// --}}
                                    {{-- @for($i=1; $i<=$contdosisededepto->dosi_muñeca; $i++)
                                        @if($mesnumber = 1)
                                            <tr>
                                                <td>
                                                    <select class="form-select"  name="id_trabajador_asigdosimMuneca[]" id="id_trabajador_asigdosimMuneca" autofocus aria-label="Floating label select example">
                                                        <option value="">----</option>
                                                        
                                                        @foreach($personaSede as $persed)
                                                            <option value="{{$persed->id_persona}}">{{$persed->primer_nombre_persona}} {{$persed->segundo_nombre_persona}} {{$persed->primer_apellido_persona}} {{$persed->segundo_apellido_persona}}- ({{$persed->nombre_rol}})</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td class='align-middle text-center'>MUÑECA</td>
                                                <td>
                                                    <select class="form-select"  name="id_dosimetro_asigdosimMuneca[]" id="id_dosimetro_asigdosimMuneca" autofocus aria-label="Floating label select example">
                                                        <option value="">----</option>
                                                        @foreach($dosimLibresEzclip as $dosiezcliplib)
                                                            <option value="{{$dosiezcliplib->id_dosimetro}}">{{$dosiezcliplib->codigo_dosimeter}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <select class="form-select"  name="id_holder_asigdosimMuneca[]" id="id_holder_asigdosimMuneca" autofocus aria-label="Floating label select example">
                                                        <option value="">----</option>
                                                        @foreach($holderLibresExtrem as $holibexm)
                                                            <option value="{{$holibexm->id_holder}}">{{$holibexm->codigo_holder}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                            </tr>
                                        @endif
                                    @endfor  --}}

                                    {{-- ///Filas creadas segun la cantidad de dosimetros tipo ANILLO  que falten por asignar en el primer mes/////// --}}
                                    @for($i=1; $i<=$contdosisededepto->dosi_dedo; $i++)
                                        @if($mesnumber = 1)
                                            <tr>
                                                <td>
                                                    <select class="form-select"  name="id_trabajador_asigdosimDedo[]" id="id_trabajador_asigdosimDedo" autofocus aria-label="Floating label select example">
                                                        <option value="">----</option>
                                                        
                                                        @foreach($personaSede as $persed)
                                                            <option value="{{$persed->id_persona}}">{{$persed->primer_nombre_persona}} {{$persed->segundo_nombre_persona}} {{$persed->primer_apellido_persona}} {{$persed->segundo_apellido_persona}} - ({{$persed->nombre_rol}})</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td class='align-middle text-center'>ANILLO</td>
                                                <td>
                                                    <select class="form-select"  name="id_dosimetro_asigdosimDedo[]" id="id_dosimetro_asigdosimDedo" autofocus aria-label="Floating label select example">
                                                        <option value="">----</option>
                                                        @foreach($dosimLibresEzclip as $dosiezcliplib)
                                                            <option value="{{$dosiezcliplib->id_dosimetro}}">{{$dosiezcliplib->codigo_dosimeter}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <select class="form-select"  name="id_holder_asigdosimDedo[]" id="id_holder_asigdosimDedo" autofocus aria-label="Floating label select example">
                                                        <option value="">----</option>
                                                        @foreach($holderLibresAnillo as $holibanillo)
                                                            <option value="{{$holibanillo->id_holder}}">{{$holibanillo->codigo_holder}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                            </tr>
                                        @endif
                                    @endfor 
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            
                <div class="row">
                    <div class="col"></div>
                    <div class="col">
                        <div class="d-grid gap-2 col-6 mx-auto">
                            <button id="assignBtn" class="btn colorQA"  type="submit">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-save" viewBox="0 0 16 16">
                                    <path d="M2 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H9.5a1 1 0 0 0-1 1v7.293l2.646-2.647a.5.5 0 0 1 .708.708l-3.5 3.5a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L7.5 9.293V2a2 2 0 0 1 2-2H14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h2.5a.5.5 0 0 1 0 1H2z"/>
                                </svg> <br> GUARDAR ASIGNACIÓN
                            </button>
                        </div>
                    </div>
                    <div class="col">
                        <div class="d-grip gap-2 col-6 mx-auto">
                            {{-- <button type="button" class="btn btn-lg btn-danger" data-bs-toggle="popover" title="ESTE ES EL CONTENIDO DEL POPOVER" data-bs-content="And here's some amazing content. It's very engaging. Right?">Click to toggle popover</button> --}}
                            <a href="{{route('detallesedecont.create', $contdosisededepto->id_contdosisededepto)}}" class="btn btn-danger " type="button" id="cancelar" name="cancelar" role="button">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                                </svg> 
                                <br> CANCELAR ASIGNACIÓN
                            </a>
                        </div>
                    </div>
                    <div class="col"></div>
                </div>
                <br>
            </form>
        </div>
        <br>
    </div>
    <div class="col-md"></div>
</div>



<script
    src="https://code.jquery.com/jquery-3.6.0.js"
    integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
    crossorigin="anonymous">
</script>

<script type="text/javascript">
    $(document).ready(function() {
        //select2 para dosimetros de tipo control////
        $('#id_dosimetro_asigdosimControlTorax').select2({width: "100%",});
        $('#id_dosimetro_asigdosimControlCristalino').select2({width: "100%",});
        $('#id_holder_asigdosimControlCristalino').select2({width: "100%",});
        $('#id_dosimetro_asigdosimControlDedo').select2({width: "100%",});
        $('#id_holder_asigdosimControlDedo').select2({width: "100%",});

        $('#id_dosimetro_ControlToraxUnico').select2({width: "100%",});
        $('#id_dosimetro_ControlCristalinoUnico').select2({width: "100%",});
        $('#id_holder_ControlCristalinoUnico').select2({width: "100%",});
        $('#id_dosimetro_ControlDedoUnico').select2({width: "100%",});
        $('#id_holder_ControlDedoUnico').select2({width: "100%",});
        /////SELECT2 PARA LOS SELECTS DE TRABAJADORES//////// 
        var trabj_torax = document.querySelectorAll('select[name="id_trabajador_asigdosimTorax[]"]');
        for(var i = 0; i < trabj_torax.length; i++){
            trabj_torax[i].setAttribute("id", "id_trabajador_asigdosimTorax"+[i]);
            $('#id_trabajador_asigdosimTorax'+[i]).select2({width: "100%",});
        }
        var nombres_area = document.querySelectorAll('select[name="id_area_asigdosimArea[]"]');
        for(var i = 0; i < nombres_area.length; i++){
            nombres_area[i].setAttribute("id", "id_area_asigdosimArea"+[i]);
            $('#id_area_asigdosimArea'+[i]).select2({width: "100%",});
        }
        var trabj_caso = document.querySelectorAll('select[name="id_trabajador_asigdosimCaso[]"]');
        for(var i = 0; i < trabj_caso.length; i++){
            trabj_caso[i].setAttribute("id", "id_trabajador_asigdosimCaso"+[i]);
            $('#id_trabajador_asigdosimCaso'+[i]).select2({width: "100%",});
        }
        var trabj_cristalino = document.querySelectorAll('select[name="id_trabajador_asigdosimCristalino[]"]');
        for(var i = 0; i < trabj_cristalino.length; i++){
            trabj_cristalino[i].setAttribute("id", "id_trabajador_asigdosimCristalino"+[i]);
            $('#id_trabajador_asigdosimCristalino'+[i]).select2({width: "100%",});
        }
        var trabj_muñenca = document.querySelectorAll('select[name="id_trabajador_asigdosimMuneca[]"]');
        for(var i = 0; i < trabj_muñenca.length; i++){
            trabj_muñenca[i].setAttribute("id", "id_trabajador_asigdosimMuneca"+[i]);
            $('#id_trabajador_asigdosimMuneca'+[i]).select2({width: "100%",});
        }
        var trabj_dedo = document.querySelectorAll('select[name="id_trabajador_asigdosimDedo[]"]');
        for(var i = 0; i < trabj_dedo.length; i++){
            trabj_dedo[i].setAttribute("id", "id_trabajador_asigdosimDedo"+[i]);
            $('#id_trabajador_asigdosimDedo'+[i]).select2({width: "100%",});
        }
        ///////SELECT2 PARA LOS SELECTS DE DOSIMETROS //////
        
        var dosim_area = document.querySelectorAll('select[name="id_dosimetro_asigdosimArea[]"]');
        for(var i = 0; i < dosim_area.length; i++){
            dosim_area[i].setAttribute("id", "id_dosimetro_asigdosimArea"+[i]);
            $('#id_dosimetro_asigdosimArea'+[i]).select2({width: "100%",});
        }
        var dosim_caso = document.querySelectorAll('select[name="id_dosimetro_asigdosimCaso[]"]');
        for(var i = 0; i < dosim_caso.length; i++){
            dosim_caso[i].setAttribute("id", "id_dosimetro_asigdosimCaso"+[i]);
            $('#id_dosimetro_asigdosimCaso'+[i]).select2({width: "100%",});
        }
        var dosim_torax = document.querySelectorAll('select[name="id_dosimetro_asigdosimTorax[]"]');
        for(var i = 0; i < dosim_torax.length; i++){
            dosim_torax[i].setAttribute("id", "id_dosimetro_asigdosimTorax"+[i]);
            $('#id_dosimetro_asigdosimTorax'+[i]).select2({width: "100%",});
        }
        var dosim_cristalino = document.querySelectorAll('select[name="id_dosimetro_asigdosimCristalino[]"]');
        for(var i = 0; i < dosim_cristalino.length; i++){
            dosim_cristalino[i].setAttribute("id", "id_dosimetro_asigdosimCristalino"+[i]);
            $('#id_dosimetro_asigdosimCristalino'+[i]).select2({width: "100%",});
        }
        var dosim_muñeca = document.querySelectorAll('select[name="id_dosimetro_asigdosimMuneca[]"');
        for(var i = 0; i < dosim_muñeca.length; i++){
            dosim_muñeca[i].setAttribute("id", "id_dosimetro_asigdosimMuneca"+[i]);
            $('#id_dosimetro_asigdosimMuneca'+[i]).select2({width: "100%",});
        }
        var dosim_dedo = document.querySelectorAll('select[name="id_dosimetro_asigdosimDedo[]"');
        for(var i = 0; i < dosim_dedo.length; i++){
            dosim_dedo[i].setAttribute("id", "id_dosimetro_asigdosimDedo"+[i]);
            $('#id_dosimetro_asigdosimDedo'+[i]).select2({width: "100%",});
        }
        //////SELECT2 PARA LOS SELECTS DE LOS HOLDERS /////
        var holder_cristalino = document.querySelectorAll('select[name="id_holder_asigdosimCristalino[]"');
        for(var i = 0; i < holder_cristalino.length; i++){
            holder_cristalino[i].setAttribute("id", "id_holder_asigdosimCristalino"+[i]);
            $('#id_holder_asigdosimCristalino'+[i]).select2({width: "100%",});
        }
        var holder_muñeca = document.querySelectorAll('select[name="id_holder_asigdosimMuneca[]"');
        for(var i = 0; i < holder_muñeca.length; i++){
            holder_muñeca[i].setAttribute("id", "id_holder_asigdosimMuneca"+[i]);
            $('#id_holder_asigdosimMuneca'+[i]).select2({width: "100%",});
        }
        var holder_dedo = document.querySelectorAll('select[name="id_holder_asigdosimDedo[]"');
        for(var i = 0; i < holder_dedo.length; i++){
            holder_dedo[i].setAttribute("id", "id_holder_asigdosimDedo"+[i]);
            $('#id_holder_asigdosimDedo'+[i]).select2({width: "100%",});
        }
    });
    
</script>

<script type="text/javascript">
    $(document).ready(function(){
        $('#form-nueva-asignacion').submit(function(e){
            e.preventDefault();
            ///////////////////////VALIDACION PARA LAS FECHAS/////////////////
            var fecha_inicio = document.getElementById("primerDia_asigdosim").value;
            if(fecha_inicio == ''){
                    return Swal.fire({
                                title:"FALTA SELECCIONAR LA FECHA DEL PRIMER DÍA PARA EL PERIODO",
                                text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN DESEADA",
                                icon: 'error'
                            });
                    
            };
            var fecha_final = document.getElementById("ultimoDia_asigdosim").value;
            if(fecha_final == ''){
                    return Swal.fire({
                                title:"FALTA SELECCIONAR LA FECHA DEL ULTIMO DÍA PARA EL PERIODO",
                                text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN DESEADA",
                                icon: 'error'
                            });
                    
            };
            /////////////////////VALIDACION PARA LOS DOSIMETROS CONTROL /////////////////
            var dosimControlTorax = document.querySelectorAll('select[name="id_dosimetro_asigdosimControlTorax[]"]');
            console.log("ESTAS SON LOS  DOSIM CONTROL TORAX");
            console.log(dosimControlTorax);
            for(var i = 0; i < dosimControlTorax.length; i++){
                var values = dosimControlTorax[i].value;
                if(values == ''){
                    return Swal.fire({
                                title:"FALTA SELECCIONAR ALGUN DOSÍMETRO DE TIPO CONTROL TÓRAX",
                                text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN DESEADA",
                                icon: 'error'
                            });
                    
                };
                for(var x = 0; x < dosimControlTorax.length; x++){
                    var valuesX = dosimControlTorax[x].value;
                    if(values == valuesX && i != x){
                        return Swal.fire({
                                title:"ALGUNOS DOSÍMETROS DE CONTROL TÓRAX SELECCIONADOS SE ENCUENTRAN REPETIDOS",
                                text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN CORRECTAMENTE",
                                icon: 'error'
                            });
                    }
                }
            };
            
            var dosimControlCristalino = document.querySelectorAll('select[name="id_dosimetro_asigdosimControlCristalino[]"]');
            console.log("ESTAS SON LOS  DOSIM CONTROL CRISTALINO");
            console.log(dosimControlCristalino);
            for(var i = 0; i < dosimControlCristalino.length; i++){
                var values = dosimControlCristalino[i].value;
                if(values == ''){
                    return Swal.fire({
                                title:"FALTA SELECCIONAR ALGUN DOSÍMETRO DE TIPO CONTROL CRISTALINO",
                                text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN DESEADA",
                                icon: 'error'
                            });
                    
                };
                for(var x = 0; x < dosimControlCristalino.length; x++){
                    var valuesX = dosimControlCristalino[x].value;
                    if(values == valuesX && i != x){
                        return Swal.fire({
                                title:"ALGUNOS DOSÍMETROS DE CONTROL CRISTALINO SELECCIONADOS SE ENCUENTRAN REPETIDOS",
                                text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN CORRECTAMENTE",
                                icon: 'error'
                            });
                    }
                }
            };
            var dosimControlDedo = document.querySelectorAll('select[name="id_dosimetro_asigdosimControlDedo[]"]');
            console.log("ESTAS SON LOS  DOSIM CONTROL DEDO");
            console.log(dosimControlDedo);
            for(var i = 0; i < dosimControlDedo.length; i++){
                var values = dosimControlDedo[i].value;
                if(values == ''){
                    return Swal.fire({
                                title:"FALTA SELECCIONAR ALGUN DOSÍMETRO DE TIPO CONTROL ANILLO",
                                text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN DESEADA",
                                icon: 'error'
                            });
                    
                };
                for(var x = 0; x < dosimControlDedo.length; x++){
                    var valuesX = dosimControlDedo[x].value;
                    if(values == valuesX && i != x){
                        return Swal.fire({
                                title:"ALGUNOS DOSÍMETROS DE CONTROL ANILLO SELECCIONADOS SE ENCUENTRAN REPETIDOS",
                                text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN CORRECTAMENTE",
                                icon: 'error'
                            });
                    }
                }

                for(var y = 0; y < dosimControlCristalino.length; y++){
                    var valuesCrist = dosimControlCristalino[y].value;
                    if(values == valuesCrist){
                        return Swal.fire({
                                title:"ALGUNOS DOSÍMETROS DE CONTROL ANILLO SELECCIONADOS SE ENCUENTRAN REPETIDOS CON LOS DOSÍMETROS DE CONTROL CRISTALINO",
                                text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN CORRECTAMENTE",
                                icon: 'error'
                            });
                    }
                }
            };
            /////VALIDACION DOSIMETROS CONTROL TRANSPORTE UNICO//////
            
            var dosimControlToraxUni = document.querySelectorAll('select[name="id_dosimetro_ControlToraxUnico"]');
            console.log("ESTAS SON LOS  DOSIM CONTROL TORAX UNICO");
            console.log(dosimControlToraxUni);
            for(var i = 0; i < dosimControlToraxUni.length; i++){
                var values = dosimControlToraxUni[i].value;
                if(values == ''){
                    return Swal.fire({
                                title:"FALTA SELECCIONAR ALGUN DOSÍMETRO DE TIPO CONTROL TRANSPORTE TÓRAX",
                                text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN DESEADA",
                                icon: 'error'
                            });
                    
                };
            };
            
            var dosimControlCristalinoUni = document.querySelectorAll('select[name="id_dosimetro_ControlCristalinoUnico"]');
            console.log("ESTAS SON LOS  DOSIM CONTROL CRISTALINO UNICO");
            console.log(dosimControlCristalinoUni);
            for(var i = 0; i < dosimControlCristalinoUni.length; i++){
                var values = dosimControlCristalinoUni[i].value;
                if(values == ''){
                    return Swal.fire({
                                title:"FALTA SELECCIONAR ALGUN DOSÍMETRO DE TIPO CONTROL TRANSPORTE CRISTALINO ",
                                text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN DESEADA",
                                icon: 'error'
                            });
                    
                };
            };
            
            var dosimControlDedoUni = document.querySelectorAll('select[name="id_dosimetro_ControlDedoUnico"]');
            console.log("ESTAS SON LOS  DOSIM CONTROL DEDO UNICO");
            console.log(dosimControlDedoUni);
            for(var i = 0; i < dosimControlDedoUni.length; i++){
                var values = dosimControlDedoUni[i].value;
                if(values == ''){
                    return Swal.fire({
                                title:"FALTA SELECCIONAR ALGUN DOSÍMETRO DE TIPO CONTROL TRANSPORTE ANILLO",
                                text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN DESEADA",
                                icon: 'error'
                            });
                    
                };

                for(var y = 0; y < dosimControlCristalinoUni.length; y++){
                    var valuesCrist = dosimControlCristalinoUni[y].value;
                    if(values == valuesCrist){
                        return Swal.fire({
                                title:"ALGUNOS DOSÍMETROS DE CONTROL TRANSPORTE ANILLO SELECCIONADOS SE ENCUENTRAN REPETIDOS CON LOS DOSÍMETROS DE CONTROL TRANSPORTE CRISTALINO ",
                                text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN CORRECTAMENTE",
                                icon: 'error'
                            });
                    }
                }
            };

            for(var i = 0; i < dosimControlCristalinoUni.length; i++){
                var values = dosimControlCristalinoUni[i].value;
                for(var y = 0; y < dosimControlDedoUni.length; y++){
                    var valuesDedo = dosimControlDedoUni[y].value;
                    if(values == valuesDedo){
                        return Swal.fire({
                                title:"ALGUNOS DOSÍMETROS DE CONTROL TRANSPORTE CRISTALINO SELECCIONADOS SE ENCUENTRAN REPETIDOS CON LOS DOSIMETROS DE UBICACIÓN CONTROL TRANSPORTE ANILLO",
                                text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN CORRECTAMENTE",
                                icon: 'error'
                            });
                    }
                }
            };
            for(var i = 0; i < dosimControlDedoUni.length; i++){
                var values = dosimControlDedoUni[i].value;
                for(var y = 0; y < dosimControlCristalinoUni.length; y++){
                    var valuesCrist = dosimControlCristalinoUni[y].value;
                    if(values == valuesCrist){
                        return Swal.fire({
                                title:"ALGUNOS DOSÍMETROS DE CONTROL TRANSPORTE ANILLO SELECCIONADOS SE ENCUENTRAN REPETIDOS CON LOS DOSÍMETROS DE UBICACIÓN CONTROL TRANSPORTE CRISTALINO",
                                text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN CORRECTAMENTE",
                                icon: 'error'
                            });
                    }
                }
            };
            ///////////////////////VALIDACION PARA LOS TRABAJADORES Y AREAS /////////////////
            var trabjTorax = document.querySelectorAll('select[name="id_trabajador_asigdosimTorax[]"]');
            console.log("ESTAS SON LOS TRABAJADORES DOSIM TORAX");
            console.log(trabjTorax);
            for(var i = 0; i < trabjTorax.length; i++){
                var values = trabjTorax[i].value;
                if(values == ''){
                    return Swal.fire({
                                title:"FALTA SELECCIONAR ALGÚN TRABAJADOR PARA UN DOSÍMETRO DE UBICACIÓN TORAX",
                                text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN DESEADA",
                                icon: 'error'
                            });
                    
                }
            }
            var trabjCristalino = document.querySelectorAll('select[name="id_trabajador_asigdosimCristalino[]"]');
            console.log("ESTAS SON LOS TRABAJADORES DOSIM CRISTALINO");
            console.log(trabjCristalino);
            for(var i = 0; i < trabjCristalino.length; i++){
                var values = trabjCristalino[i].value;
                if(values == ''){
                    return Swal.fire({
                                title:"FALTA SELECCIONAR ALGÚN TRABAJADOR PARA UN DOSÍMETRO DE UBICACIÓN CRISTALINO",
                                text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN DESEADA",
                                icon: 'error'
                            });
                    
                }
            }
            var trabjAnillo = document.querySelectorAll('select[name="id_trabajador_asigdosimDedo[]"]');
            console.log("ESTAS SON LOS TRABAJADORES DOSIM ANILLO");
            console.log(trabjAnillo);
            for(var i = 0; i < trabjAnillo.length; i++){
                var values = trabjAnillo[i].value;
                if(values == ''){
                    return Swal.fire({
                                title:"FALTA SELECCIONAR ALGÚN TRABAJADOR PARA UN DOSÍMETRO DE UBICACIÓN ANILLO",
                                text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN DESEADA",
                                icon: 'error'
                            });
                    
                }
            }
            var trabjMuneca = document.querySelectorAll('select[name="id_trabajador_asigdosimMuneca[]"]');
            console.log("ESTAS SON LOS TRABAJADORES DOSIM MUÑENA");
            console.log(trabjMuneca);
            for(var i = 0; i < trabjMuneca.length; i++){
                var values = trabjMuneca[i].value;
                if(values == ''){
                    return Swal.fire({
                                title:"FALTA SELECCIONAR ALGÚN TRABAJADOR PARA UN DOSÍMETRO DE UBICACIÓN MUÑECA",
                                text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN DESEADA",
                                icon: 'error'
                            });
                    
                }
            }
            
            var nombreArea = document.querySelectorAll('select[name="id_area_asigdosimArea[]"]');
            console.log("ESTAS SON LAS AREA DOSIM ARAEA");
            console.log(nombreArea);
            for(var i = 0; i < nombreArea.length; i++){
                var values = nombreArea[i].value;
                if(values == ''){
                    return Swal.fire({
                                title:"FALTA SELECCIONAR ALGÚNA ÁREA PARA UN DOSÍMETRO DE UBICACIÓN ÁREA",
                                text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN DESEADA",
                                icon: 'error'
                            });
                    
                }
            }
            var trabjCaso = document.querySelectorAll('select[name="id_trabajador_asigdosimCaso[]"]');
            console.log("ESTAS SON LOS TRABAJADORES DOSIM CASO");
            console.log(trabjCaso);
            for(var i = 0; i < trabjCaso.length; i++){
                var values = trabjCaso[i].value;
                if(values == ''){
                    return Swal.fire({
                                title:"FALTA SELECCIONAR ALGÚN TRABAJADOR PARA UN DOSÍMETRO DE UBICACIÓN CASO",
                                text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN DESEADA",
                                icon: 'error'
                            });
                    
                }
            }
            /////////////////////VALIDACION PARA LOS DOSIMETROS /////////////////
            var dosimArea = document.querySelectorAll('select[name="id_dosimetro_asigdosimArea[]"]');
            console.log("ESTAS SON LOS DOSIMTROS AREA");
            console.log(dosimArea);
            for(var i = 0; i < dosimArea.length; i++){
                var values = dosimArea[i].value;
                console.log("***SON LOS DOSIM AREA");
                console.log(values);
                if(values == ''){
                    /* return alert("FALTA SELECCIONAR ALGUN TRABAJADOR"); */
                    return Swal.fire({
                                title:"FALTA SELECCIONAR EL DOSÍMETRO PARA UNO DE UBICACIÓN ÁREA",
                                text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN DESEADA",
                                icon: 'error'
                            });
                    
                };
                for(var x = 0; x < dosimArea.length; x++){
                    var valuesX = dosimArea[x].value;
                    if(values == valuesX && i != x){
                        return Swal.fire({
                                title:"ALGUNOS DOSÍMETROS DE UBICACIÓN ÁREA SELECCIONADOS SE ENCUENTRAN REPETIDOS",
                                text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN CORRECTAMENTE",
                                icon: 'error'
                            });
                    }
                }
                for(var x = 0; x < dosimControlToraxUni.length; x++){
                    var valuesX = dosimControlToraxUni[x].value;
                    console.log("***SON LOS DOSIMTORAX UNICOS");
                    console.log(valuesX);
                    if(values == valuesX ){
                        return Swal.fire({
                                title:"ALGUNOS DOSÍMETROS DE UBICACIÓN ÁREA SELECCIONADOS SE ENCUENTRAN REPETIDOS CON LOS DOSÍMETROS DE CONTROL TRANSPORTE TÓRAX",
                                text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN CORRECTAMENTE",
                                icon: 'error'
                            });
                    }   
                }
                
            };
            var dosimCaso = document.querySelectorAll('select[name="id_dosimetro_asigdosimCaso[]"]');
            console.log("ESTAS SON LOS DOSIMETROS CASO");
            console.log(dosimCaso);
            for(var i = 0; i < dosimCaso.length; i++){
                var values = dosimCaso[i].value;
                if(values == ''){
                    /* return alert("FALTA SELECCIONAR ALGUN TRABAJADOR"); */
                    return Swal.fire({
                                title:"FALTA SELECCIONAR EL DOSÍMETRO PARA UNO DE UBICACIÓN CASO",
                                text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN DESEADA",
                                icon: 'error'
                            });
                };
                for(var x = 0; x < dosimCaso.length; x++){
                    var valuesX = dosimCaso[x].value;
                    if(values == valuesX && i != x){
                        return Swal.fire({
                                title:"ALGUNOS DOSÍMETROS DE UBICACIÓN CASO SELECCIONADOS SE ENCUENTRAN REPETIDOS",
                                text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN CORRECTAMENTE",
                                icon: 'error'
                            });
                    }
                }
                for(var x = 0; x < dosimControlToraxUni.length; x++){
                    var valuesX = dosimControlToraxUni[x].value;
                    if(values == valuesX ){
                        return Swal.fire({
                                title:"ALGUNOS DOSÍMETROS DE UBICACIÓN CASO SELECCIONADOS SE ENCUENTRAN REPETIDOS CON LOS DOSÍMETROS DE CONTROL TRANSPORTE TÓRAX",
                                text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN CORRECTAMENTE",
                                icon: 'error'
                            });
                    }   
                }
                for(var x = 0; x < dosimArea.length; x++){
                    var valuesX = dosimArea[x].value;
                    if(values == valuesX ){
                        return Swal.fire({
                                title:"ALGUNOS DOSÍMETROS DE UBICACIÓN CASO SELECCIONADOS SE ENCUENTRAN REPETIDOS CON LOS DOSÍMETROS DE UBICACION ÁREA",
                                text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN CORRECTAMENTE",
                                icon: 'error'
                            });
                    }   
                }
            };
            var dosimTorax = document.querySelectorAll('select[name="id_dosimetro_asigdosimTorax[]"]');
            console.log("ESTAS SON LOS DOSIMETROS TORAX");
            console.log(dosimTorax);
            for(var i = 0; i < dosimTorax.length; i++){
                var values = dosimTorax[i].value;
                if(values == ''){
                    /* return alert("FALTA SELECCIONAR ALGUN TRABAJADOR"); */
                    return Swal.fire({
                                title:"FALTA SELECCIONAR EL DOSÍMETRO PARA UNO DE UBICACIÓN TÓRAX",
                                text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN DESEADA",
                                icon: 'error'
                            });
                    
                };
                for(var x = 0; x < dosimTorax.length; x++){
                    var valuesX = dosimTorax[x].value;
                    if(values == valuesX && i != x){
                        return Swal.fire({
                                title:"ALGUNOS DOSÍMETROS DE UBICACIÓN TÓRAX SELECCIONADOS SE ENCUENTRAN REPETIDOS",
                                text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN CORRECTAMENTE",
                                icon: 'error'
                            });
                    }
                }
                for(var y = 0; y < dosimControlTorax.length; y++){
                    var valuesTorax = dosimControlTorax[y].value;
                    if(values == valuesTorax){
                        return Swal.fire({
                                title:"ALGUNOS DOSÍMETROS DE CONTROL TÓRAX SELECCIONADOS SE ENCUENTRAN REPETIDOS CON LOS DOSIMETROS DE UBICACIÓN TÓRAX",
                                text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN CORRECTAMENTE",
                                icon: 'error'
                            });
                    }
                }
                for(var x = 0; x < dosimControlToraxUni.length; x++){
                    var valuesX = dosimControlToraxUni[x].value;
                    if(values == valuesX){
                        return Swal.fire({
                                title:"ALGUNOS DOSÍMETROS DE CONTROL TRANSPORTE TÓRAX SELECCIONADOS SE ENCUENTRAN REPETIDOS CON LOS DOSÍMETROS DE UBICACION TÓRAX",
                                text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN CORRECTAMENTE",
                                icon: 'error'
                            });
                    }   
                }
                for(var x = 0; x < dosimArea.length; x++){
                    var valuesX = dosimArea[x].value;
                    if(values == valuesX){
                        return Swal.fire({
                                title:"ALGUNOS DOSÍMETROS DE UBICACIÓN TÓRAX SELECCIONADOS SE ENCUENTRAN REPETIDOS CON LOS DOSÍMETROS DE UBICACION ÁREA",
                                text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN CORRECTAMENTE",
                                icon: 'error'
                            });
                    }   
                }
                for(var x = 0; x < dosimCaso.length; x++){
                    var valuesX = dosimCaso[x].value;
                    if(values == valuesX){
                        return Swal.fire({
                                title:"ALGUNOS DOSÍMETROS DE UBICACIÓN TÓRAX SELECCIONADOS SE ENCUENTRAN REPETIDOS CON LOS DOSÍMETROS DE UBICACION CASO",
                                text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN CORRECTAMENTE",
                                icon: 'error'
                            });
                    }   
                }
            
            };
            var dosimCristalino = document.querySelectorAll('select[name="id_dosimetro_asigdosimCristalino[]"]');
            console.log("ESTAS SON LOS DOSIMETROS CRISTALINO");
            console.log(dosimCristalino);
            for(var i = 0; i < dosimCristalino.length; i++){
                var values = dosimCristalino[i].value;
                if(values == ''){
                    /* return alert("FALTA SELECCIONAR ALGUN TRABAJADOR"); */
                    return Swal.fire({
                                title:"FALTA SELECCIONAR EL DOSÍMETRO PARA UNO DE UBICACIÓN CRISTALINO",
                                text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN DESEADA",
                                icon: 'error'
                            });
                    
                };
                for(var x = 0; x < dosimCristalino.length; x++){
                    var valuesX = dosimCristalino[x].value;
                    if(values == valuesX && i != x){
                        return Swal.fire({
                                title:"ALGUNOS DOSÍMETROS DE UBICACIÓN CRISTALINO SELECCIONADOS SE ENCUENTRAN REPETIDOS",
                                text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN CORRECTAMENTE",
                                icon: 'error'
                            });
                    }
                }
                for(var y = 0; y < dosimControlCristalino.length; y++){
                    var valuesCrist = dosimControlCristalino[y].value;
                    if(values == valuesCrist){
                        return Swal.fire({
                                title:"ALGUNOS DOSÍMETROS DE CONTROL CRISTALINO SELECCIONADOS SE ENCUENTRAN REPETIDOS CON LOS DOSÍMETROS DE UBICACIÓN CRISTALINO",
                                text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN CORRECTAMENTE",
                                icon: 'error'
                            });
                    }
                }
                for(var y = 0; y < dosimControlDedo.length; y++){
                    var valuesDedo = dosimControlDedo[y].value;
                    if(values == valuesDedo){
                        return Swal.fire({
                                title:"ALGUNOS DOSÍMETROS DE CONTROL ANILLO SELECCIONADOS SE ENCUENTRAN REPETIDOS CON LOS DOSÍMETROS DE UBICACIÓN CRISTALINO",
                                text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN CORRECTAMENTE",
                                icon: 'error'
                            });
                    }
                }
                for(var y = 0; y < dosimControlCristalinoUni.length; y++){
                    var valuesCrist = dosimControlCristalinoUni[y].value;
                    if(values == valuesCrist){
                        return Swal.fire({
                                title:"ALGUNOS DOSÍMETROS DE UBICACIÓN CRISTALINO SELECCIONADOS SE ENCUENTRAN REPETIDOS CON LOS DOSÍMETROS DE CONTROL TRANSPORTE CRISTALINO",
                                text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN CORRECTAMENTE",
                                icon: 'error'
                            });
                    }
                }
                for(var y = 0; y < dosimControlDedoUni.length; y++){
                    var valuesDedo = dosimControlDedoUni[y].value;
                    if(values == valuesDedo){
                        return Swal.fire({
                                title:"ALGUNOS DOSÍMETROS DE UBICACIÓN CRISTALINO SELECCIONADOS SE ENCUENTRAN REPETIDOS CON LOS DOSÍMETROS DE CONTROL TRANSPORTE ANILLO",
                                text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN CORRECTAMENTE",
                                icon: 'error'
                            });
                    }
                }
            };
            var dosimAnillo = document.querySelectorAll('select[name="id_dosimetro_asigdosimDedo[]"]');
            console.log("ESTAS SON LOS DOSIMETROS ANILLO");
            console.log(dosimAnillo);
            for(var i = 0; i < dosimAnillo.length; i++){
                var values = dosimAnillo[i].value;
                console.log("VALOR DE LOS DOSIMETROS ANILLO" +values)
                if(values == ''){
                    /* return alert("FALTA SELECCIONAR ALGUN TRABAJADOR"); */
                    return Swal.fire({
                                title:"FALTA SELECCIONAR EL DOSÍMETRO PARA UNO DE UBICACIÓN ANILLO",
                                text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN DESEADA",
                                icon: 'error'
                            });
                    
                };
                for(var x = 0; x < dosimAnillo.length; x++){
                    var valuesX = dosimAnillo[x].value;
                    if(values == valuesX && i != x){
                        return Swal.fire({
                                title:"ALGUNOS DOSÍMETROS DE UBICACIÓN ANILLO SELECCIONADOS SE ENCUENTRAN REPETIDOS",
                                text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN CORRECTAMENTE",
                                icon: 'error'
                            });
                    }
                }
                for(var y = 0; y < dosimControlDedo.length; y++){
                    var valuesDedo = dosimControlDedo[y].value;
                    if(values == valuesDedo){
                        return Swal.fire({
                                title:"ALGUNOS DOSÍMETROS DE CONTROL ANILLO SELECCIONADOS SE ENCUENTRAN REPETIDOS CON LOS DOSÍMETROS DE UBICACIÓN ANILLO",
                                text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN CORRECTAMENTE",
                                icon: 'error'
                            });
                    }
                }
                for(var y = 0; y < dosimControlCristalino.length; y++){
                    var valuesCrist = dosimControlCristalino[y].value;
                    if(values == valuesCrist){
                        return Swal.fire({
                                title:"ALGUNOS DOSÍMETROS DE CONTROL CRISTALINO SELECCIONADOS SE ENCUENTRAN REPETIDOS CON LOS DOSÍMETROS DE UBICACIÓN ANILLO",
                                text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN CORRECTAMENTE",
                                icon: 'error'
                            });
                    }
                }
                for(var y = 0; y < dosimControlDedoUni.length; y++){
                    var valuesDedo = dosimControlDedoUni[y].value;
                    if(values == valuesDedo){
                        return Swal.fire({
                                title:"ALGUNOS DOSÍMETROS DE CONTROL TRANSPORTE ANILLO SELECCIONADOS SE ENCUENTRAN REPETIDOS CON LOS DOSÍMETROS DE UBICACIÓN ANILLO",
                                text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN CORRECTAMENTE",
                                icon: 'error'
                            });
                    }
                }
                for(var y = 0; y < dosimControlCristalinoUni.length; y++){
                    var valuesCrist = dosimControlCristalinoUni[y].value;
                    if(values == valuesCrist){
                        return Swal.fire({
                                title:"ALGUNOS DOSÍMETROS DE CONTROL TRANSPORTE CRISTALINO SELECCIONADOS SE ENCUENTRAN REPETIDOS CON LOS DOSÍMETROS DE UBICACIÓN ANILLO",
                                text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN CORRECTAMENTE",
                                icon: 'error'
                            });
                    }
                }
            };
            /////////////////////VALIDACION PARA DOSIMETROS REPETIDOS ENTRE CONTROL y TORAX /////////////////
            var dosimContr = document.querySelectorAll('select[name="id_dosimetro_asigdosimControl[]"]');
            console.log("DOSIMETROS DE TIPO CONTROL");
            console.log(dosimContr);
            for(var i = 0; i < dosimContr.length; i++){
                console.log("DOSIMETRO CONTROL POSICION" +i);
                var valuesContr = dosimContr[i].value;
                console.log(valuesContr);
                var dosimTorax = document.querySelectorAll('select[name="id_dosimetro_asigdosimTorax[]"]');
                console.log("DOSIMETROS DE TIPO TORAX");
                console.log(dosimTorax);
                for(var x = 0; x < dosimTorax.length; x++){
                    console.log("DOSIMETRO TORAX POSICION" +x);
                    var valuesTorax = dosimTorax[x].value;
                    console.log(valuesTorax);
                    if(valuesContr == valuesTorax){

                        return Swal.fire({
                                title:"ALGUNOS DOSÍMETROS DE UBICAIÓN TÓRAX SE ENCUENTRAN REPETIDOS",
                                text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN CORRECTAMENTE",
                                icon: 'error'
                            }); 
                    }
                }
            };
            var dosimTorax = document.querySelectorAll('select[name="id_dosimetro_asigdosimTorax[]"]');
            console.log("DOSIMETROS DE TIPO TORAX");
            console.log(dosimTorax);
            for(var i = 0; i < dosimTorax.length; i++){
                console.log("DOSIMETRO TORAX POSICION" +i);
                var valuesTorax = dosimTorax[i].value;
                console.log(valuesTorax);
                var dosimContr = document.querySelectorAll('select[name="id_dosimetro_asigdosimControl[]"]');
                console.log("DOSIMETROS DE TIPO CONTROL");
                console.log(dosimContr);
                console.log("TAMAÑO DOSIMETRO CRISTALINO" +dosimContr.length);
                for(var x = 0; x < dosimContr.length; x++){
                    console.log("DOSIMETRO CRISTALINO POSICION" +x);
                    var valuesContr = dosimContr[x].value;
                    console.log(valuesContr);

                    if(valuesTorax == valuesContr){
                        return Swal.fire({
                                title:"ALGUNOS DOSÍMETROS EZCLIP SE ENCUENTRAN REPETIDOS",
                                text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN CORRECTAMENTE",
                                icon: 'error'
                            });
                    }
                }
            }

            /////////////////////VALIDACION PARA DOSIMETROS REPETIDOS ENTRE CRISTALINO y (ANILLO, MUÑECA) /////////////////
            
            var dosimCrist = document.querySelectorAll('select[name="id_dosimetro_asigdosimCristalino[]"]');
            console.log("DOSIMETROS DE TIPO CRISTALINO");
            console.log(dosimCrist);
            for(var i = 0; i < dosimCrist.length; i++){
                console.log("DOSIMETRO CRISTALINO POSICION" +i);
                var valuesCrist = dosimCrist[i].value;
                console.log(valuesCrist);
                var dosimMun = document.querySelectorAll('select[name="id_dosimetro_asigdosimMuneca[]"]');
                console.log("DOSIMETROS DE TIPO MUÑECA");
                console.log(dosimMun);
                for(var x = 0; x < dosimMun.length; x++){
                    console.log("DOSIMETRO MUÑECA POSICION" +x);
                    var valuesMun = dosimMun[x].value;
                    console.log(valuesMun);
                    if(valuesCrist == valuesMun){

                        return Swal.fire({
                                title:"ALGUNOS DOSÍMETROS EZCLIP SE ENCUENTRAN REPETIDOS",
                                text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN CORRECTAMENTE",
                                icon: 'error'
                            }); 
                    }
                }
            };
            for(var i = 0; i < dosimCrist.length; i++){
                console.log("DOSIMETRO CRISTALINO POSICION" +i);
                var valuesCrist = dosimCrist[i].value;
                console.log(valuesCrist);
                var dosimAni = document.querySelectorAll('select[name="id_dosimetro_asigdosimDedo[]"]');
                console.log("DOSIMETROS DE TIPO ANILLO");
                console.log(dosimAni);
                console.log("TAMAÑO DOSIMETRO ANILLO" +dosimAni.length)
                for(var x = 0; x < dosimAni.length; x++){
                    console.log("DOSIMETRO ANILLO POSICION" +x);
                    var valuesAni = dosimAni[x].value;
                    console.log(valuesAni);
                    if(valuesCrist == valuesAni){
                        return Swal.fire({
                                title:"ALGUNOS DOSÍMETROS EZCLIP SE ENCUENTRAN REPETIDOS",
                                text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN CORRECTAMENTE",
                                icon: 'error'
                            });
                    }
                }
            }
            
            /////////////////////VALIDACION PARA DOSIMETROS REPETIDOS ENTRE ANILLO y (MUÑECA, CRISTALINO) /////////////////
            var dosimAni = document.querySelectorAll('select[name="id_dosimetro_asigdosimDedo[]"]');
            console.log("DOSIMETROS DE TIPO ANILLO");
            console.log(dosimAni);
            for(var i = 0; i < dosimAni.length; i++){
                console.log("DOSIMETRO ANILLO POSICION" +i);
                var valuesAni = dosimAni[i].value;
                console.log(valuesAni);
                var dosimMun = document.querySelectorAll('select[name="id_dosimetro_asigdosimMuneca[]"]');
                console.log("DOSIMETROS DE TIPO MUÑECA");
                console.log(dosimMun);
                for(var x = 0; x < dosimMun.length; x++){
                    console.log("DOSIMETRO MUÑECA POSICION" +x);
                    var valuesMun = dosimMun[x].value;
                    console.log(valuesMun);
                    if(valuesAni == valuesMun){

                        return Swal.fire({
                                title:"ALGUNOS DOSÍMETROS EZCLIP SE ENCUENTRAN REPETIDOS",
                                text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN CORRECTAMENTE",
                                icon: 'error'
                            }); 
                    }
                }
            };
            for(var i = 0; i < dosimAni.length; i++){
                console.log("DOSIMETRO ANILLO POSICION" +i);
                var valuesAni = dosimAni[i].value;
                console.log(valuesAni);
                var dosimCris = document.querySelectorAll('select[name="id_dosimetro_asigdosimCristalino[]"]');
                console.log("DOSIMETROS DE TIPO CRISTALINO");
                console.log(dosimCris);
                console.log("TAMAÑO DOSIMETRO CRISTALINO" +dosimCris.length);
                for(var x = 0; x < dosimCris.length; x++){
                    console.log("DOSIMETRO CRISTALINO POSICION" +x);
                    var valuesCris = dosimCris[x].value;
                    console.log(valuesCris);

                    if(valuesAni == valuesCris){
                        return Swal.fire({
                                title:"ALGUNOS DOSÍMETROS EZCLIP SE ENCUENTRAN REPETIDOS",
                                text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN CORRECTAMENTE",
                                icon: 'error'
                            });
                    }
                }
            };
            
            /////////////////////VALIDACION PARA LOS HOLDERS /////////////////
            var holContTransCristalino = document.querySelectorAll('select[name="id_holder_ControlCristalinoUnico"]');
            console.log("ESTAS SON LOS HOLDERS DE CRISTALINO DE LOS CONTROLES TRANSPORTE UNICOS");
            console.log(holContTransCristalino);
            for(var i = 0; i < holContTransCristalino.length; i++) {
                var values = holContTransCristalino[i].value;
                if(values == ''){
                    /* alert("FALTA SELECCIONAR ALGUN HOLDER"); */
                    return Swal.fire({
                                title:"FALTA SELECCIONAR ALGÚN HOLDER PARA DOSÍMETRO DE CONTROL TRANSPORTE CRISTALINO",
                                text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN DESEADA",
                                icon: 'error'
                            });
                };
               
            };
            var holContTransAnillo = document.querySelectorAll('select[name="id_holder_ControlDedoUnico"]');
            console.log("ESTAS SON LOS HOLDERS DE ANILLO DE LOS CONTROLES TRANSPORTE UNICOS");
            console.log(holContTransAnillo);
            for(var i = 0; i < holContTransAnillo.length; i++) {
                var values = holContTransAnillo[i].value;
                if(values == ''){
                    /* alert("FALTA SELECCIONAR ALGUN HOLDER"); */
                    return Swal.fire({
                                title:"FALTA SELECCIONAR ALGÚN HOLDER PARA DOSÍMETRO DE CONTROL TRANSPORTE ANILLO",
                                text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN DESEADA",
                                icon: 'error'
                            });
                };
                for(var x = 0; x < holContTransCristalino.length; x++){
                    var valuesX = holContTransCristalino[x].value;
                    if(values == valuesX ){
                        return Swal.fire({
                                title:"ALGUNOS HOLDERS DE CONTROL TRANSPORTE ANILLO SELECCIONADOS SE ENCUENTRAN REPETIDOS CON LOS HOLDERS DE CONTROL TRANSPORTE CRISTALINO",
                                text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN CORRECTAMENTE",
                                icon: 'error'
                            });
                    }
                }
               
            };
            var holCristalino = document.querySelectorAll('select[name="id_holder_asigdosimCristalino[]"]');
            console.log("ESTAS SON LOS HOLDERS DE CRISTALINO");
            console.log(holCristalino);
            for(var i = 0; i < holCristalino.length; i++) {
                var values = holCristalino[i].value;
                if(values == ''){
                    /* alert("FALTA SELECCIONAR ALGUN HOLDER"); */
                    return Swal.fire({
                                title:"FALTA SELECCIONAR ALGÚN HOLDER PARA DOSIMETRO DE UBICACIÓN CRISTALINO",
                                text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN DESEADA",
                                icon: 'error'
                            });
                };
                for(var x = 0; x < holCristalino.length; x++){
                    var valuesX = holCristalino[x].value;
                    if(values == valuesX && i != x){
                        return Swal.fire({
                                title:"ALGUNOS HOLDERS DE UBICACIÓN CRISTALINO SELECCIONADOS SE ENCUENTRAN REPETIDOS",
                                text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN CORRECTAMENTE",
                                icon: 'error'
                            });
                    }
                }
                for(var x = 0; x < holContTransCristalino.length; x++){
                    var valuesX = holContTransCristalino[x].value;
                    if(values == valuesX ){
                        return Swal.fire({
                                title:"ALGUNOS HOLDERS DE CONTROL TRANSPORTE CRISTALINO SELECCIONADOS SE ENCUENTRAN REPETIDOS CON LOS HOLDERS DE CONTROL TRANSPORTE CRISTALINO",
                                text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN CORRECTAMENTE",
                                icon: 'error'
                            });
                    }
                }
            }; 
            var holAnillo = document.querySelectorAll('select[name="id_holder_asigdosimDedo[]"]');
            console.log("ESTAS SON LOS HOLDERS DE ANILLO");
            console.log(holAnillo);
            for(var i = 0; i < holAnillo.length; i++) {
                var values = holAnillo[i].value;
                if(values == ''){
                    /* alert("FALTA SELECCIONAR ALGUN HOLDER"); */
                    return Swal.fire({
                                title:"FALTA SELECCIONAR ALGÚN HOLDER PARA DOSÍMETRO DE UBICACIÓN ANILLO",
                                text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN DESEADA",
                                icon: 'error'
                            });
                };
                for(var x = 0; x < holAnillo.length; x++){
                    var valuesX = holAnillo[x].value;
                    if(values == valuesX && i != x){
                        return Swal.fire({
                                title:"ALGUNOS HOLDERS DE UBICACIÓN ANILLO SELECCIONADOS SE ENCUENTRAN REPETIDOS",
                                text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN CORRECTAMENTE",
                                icon: 'error'
                            });
                    }
                }
            };

            
            

            Swal.fire({
                text: "DESEA GUARDAR ESTA ASIGNACIÓN??",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
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
@endsection