@extends('layouts.app')
@extends('layouts.plantillabase')
@section('contenido')
<div class="row">
    <div class="col-md"></div>
    <div class="col-md-15">
        <div class="card text-dark bg-light">
            <br>
            <h2 class="text-center">ASIGNACIÓN DOSÍMETROS</h2>
            <h3 class="text-center" id="nueva_empresaModalLabel"> <br><i>{{$contdosisededepto->contratodosimetriasede->sede->empresa->nombre_empresa}} - SEDE: {{$contdosisededepto->contratodosimetriasede->sede->nombre_sede}}</i> <br> ESP.: {{$contdosisededepto->departamentosede->departamento->nombre_departamento}} <br> PERÍODO {{$mesnumber}} ( <span id="mes{{$mesnumber}}"></span> ) </h3>
            <form action="{{route('asignadosicontratomn.save', ['asigdosicont'=> $contdosisededepto->id_contdosisededepto, 'mesnumber'=>$mesnumber])}}" method="POST"  id="form-nueva-asignacion_mn" name="form-nueva-asignacion_mn" class="form-nueva-asignacion_mn m-4">
                @csrf

                <br>
                <div class="row g-2 mx-3">
                    <div class="col-md"></div>
                    <div class="col-md-7">    
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
                                        <th class="align-middle">MUÑECA</th>
                                        <th class="align-middle">ÁREA</th>
                                        <th class="align-middle">CASO</th>
                                        <th class="align-middle">CONTROL TÓRAX</th>
                                        <th class="align-middle">CONTROL CRISTALINO</th>
                                        <th class="align-middle">CONTROL ANILLO</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center">{{$mescontdosisededepto->dosi_torax}}</td>
                                        <td class="text-center">{{$mescontdosisededepto->dosi_cristalino}}</td>
                                        <td class="text-center">{{$mescontdosisededepto->dosi_dedo}}</td>
                                        <td class="text-center">{{$mescontdosisededepto->dosi_muñeca}}</td>
                                        <td class="text-center">{{$mescontdosisededepto->dosi_area}}</td>
                                        <td class="text-center">{{$mescontdosisededepto->dosi_caso}}</td>
                                        <td class="text-center">{{$mescontdosisededepto->dosi_control_torax}}</td>
                                        <td class="text-center">{{$mescontdosisededepto->dosi_control_cristalino}}</td>
                                        <td class="text-center">{{$mescontdosisededepto->dosi_control_dedo}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md"></div>
                </div>
                <br>
                <div class="row g-2 mx-3">
                    <div class="col-md">
                        <div class="form-floating">
                            <input value="" type="date" class="form-control @error('primerDia_asigdosim') is-invalid @enderror" name="primerDia_asigdosim" id="primerDia_asigdosim" onchange="fechaultimodia();">
                            <label for="floatingInputGrid">PRIMER DÍA</label>
                            @error('primerDia_asigdosim')
                                <small class="invalid-feedback">*{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-floating">
                            <input value="" type="date" class="form-control @error('ultimoDia_asigdosim') is-invalid @enderror" name="ultimoDia_asigdosim" id="ultimoDia_asigdosim" >
                            <label for="floatingInputGrid">ULTIMO DÍA:</label>
                            @error('ultimoDia_asigdosim')
                                <small class="invalid-feedback">*{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                </div> 
                <br>   
                <div class="row g-2 mx-3">
                    <div class="col-md">
                        <div class="form-floating">
                            <input type="date" class="form-control" name="fecha_envio_dosim_asignado" id="fecha_envio_dosim_asignado" >
                            <label for="floatingInputGrid">FECHA ENVIO</label>
                            
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-floating">
                            <input type="date" class="form-control" name="fecha_recibido_dosim_asignado" id="fecha_recibido_dosim_asignado" >
                            <label for="floatingInputGrid">FECHA RECIBIDO</label>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-floating">
                            <input type="date" class="form-control" name="fecha_devuelto_dosim_asignado" id="fecha_devuelto_dosim_asignado" >
                            <label for="floatingInputGrid">FECHA DEVUELTO</label>
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
                </div>
                <br>
                <div class="row g-2 mx-3">
                    <div class="col-md">
                        <div class="table table-responsive text-center">
                            <table  class="table table-bordered" id="tablaAsignacionDosimetrosmn">
                                <thead class="table-active text-center">
                                    <th style='width: 28.20%' >TRABAJADOR / ÁREA</th>
                                    <th style='width: 16.40%'>UBICACIÓN</th>
                                    <th style='width: 16.40%'>DOSÍMETRO</th>
                                    <th style='width: 16.40%'>HOLDER</th>
                                    <th style='width: 20.60%'>OCUPACIÓN</th>
                                </thead>
                                <tbody>
                                    <input hidden name="mesNumber1" id="mesNumber1" value="{{$mesnumber}}">
                                    <input type="number" name="id_departamento_asigdosim" id="id_departamento_asigdosim" hidden value="{{$contdosisededepto->id_contdosisededepto}}">
                                    <input type="number" name="id_contrato_asigdosim_sede" id="id_contrato_asigdosim_sede" hidden value="{{$contdosisededepto->contratodosimetriasede_id}}">
                                    
                                    {{--///Filas creadas segun la cantidad de dosimetros tipo CONTROL TORAX asignados en EL MES ANTERIOR QUE CAMBIA SI SE MODIFICAN LAS CANTIDADES EN EL MODULO DE NOVEDADES/////// --}}
                                    @foreach($dosicontrolToraxmesant as $dosicontrolToraxant)
                                        <tr>
                                            <td colspan='2' class='align-middle text-center'>CONTROL TÓRAX</td>
                                            <td class='align-middle'>
                                                <select class="form-select id_dosimetro_asigdosimControlTorax"  name="id_dosimetro_asigdosimControlTorax[]" id="id_dosimetro_asigdosimControlTorax" @if($dosicontrolToraxant->dosimetro_uso != 'FALSE') { disabled } @endif>
                                                    <option value="@if($dosicontrolToraxant->dosimetro_uso != 'FALSE') {{$dosicontrolToraxant->dosimetro_id}} @endif"> @if($dosicontrolToraxant->dosimetro_uso != 'FALSE') {{$dosicontrolToraxant->dosimetro->codigo_dosimeter}} @else ---- @endif</option>
                                                    @foreach($dosimLibresGeneral as $dosigenlib)
                                                        <option value="{{$dosigenlib->id_dosimetro}}">{{$dosigenlib->codigo_dosimeter}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td class='align-middle text-center'>N.A.</td>
                                            <td>
                                                <select class="form-select ocupacion_asigdosimControlTorax" name="ocupacion_asigdosimControlTorax[]" id="ocupacion_asigdosimControlTorax" style="text-transform:uppercase" @if($dosicontrolToraxant->dosimetro_uso != 'FALSE') { disabled } @endif>
                                                    @if($dosicontrolToraxant->dosimetro_uso != 'FALSE')
                                                        @if($dosicontrolToraxant->ocupacion=='AM')
                                                            <option selected hidden value="AM">APLICACIONES MÉDICAS</option>
                                                        @elseif($dosicontrolToraxant->ocupacion=='AI')
                                                            <option selected hidden value="AI">APLICACIONES INDUSTRIALES</option>
                                                        @elseif($dosicontrolToraxant->ocupacion=='O')
                                                            <option selected hidden value="O">OTRO</option>
                                                        @endif
                                                    @endif
                                                    <option value="">----</option>
                                                    <option value="AM">APLICCIONES MÉDICAS</option>
                                                    <option value="AI">APLICCIONES INDUSTRIALES</option>
                                                    <option value="O">OTRO</option>
                                                </select>
                                            </td>
                                            
                                        </tr>
                                    @endforeach
                                    {{-- ///Filas creadas SI LA CANTIDAD DE DOSIMETROS tipo CONTROL TORAX asignados ES MODIFICADA EN EL MES ACTUAL/////// --}}
                                    @if($mescontdosisededepto->mes_asignacion == $mesnumber || $mescontdosisededepto->mes_asignacion <= $mesnumber)
                                        @for($i=1; $i<=($mescontdosisededepto->dosi_control_torax - count($dosicontrolToraxmesant)); $i++)
                                            <tr>
                                                <td colspan='2' class='align-middle text-center'>CONTROL TÓRAX</td>
                                                <td class='align-middle'>
                                                    <select class="form-select id_dosimetro_asigdosimControlTorax"  name="id_dosimetro_asigdosimControlTorax[]" id="id_dosimetro_asigdosimControlTorax" autofocus aria-label="Floating label select example">
                                                        <option value="">----</option>
                                                        @foreach($dosimLibresGeneral as $dosigenlib)
                                                            <option value="{{$dosigenlib->id_dosimetro}}">{{$dosigenlib->codigo_dosimeter}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td class='align-middle text-center'>N.A.</td>
                                                <td>
                                                    <select class="form-select ocupacion_asigdosimControlTorax" name="ocupacion_asigdosimControlTorax[]" id="ocupacion_asigdosimControlTorax" autofocus style="text-transform:uppercase">
                                                        <option value="">----</option>
                                                        {{-- <option value="T"> TELETERAPIA</option>
                                                        <option value="BQ">BRAQUITERAPIA</option>
                                                        <option value="MN">MEDICINA NUCLEAR</option>
                                                        <option value="GI">GAMMAGRAFÍA INDUSTRIAL</option>
                                                        <option value="MF">MEDIDORES FIJOS</option>
                                                        <option value="IV">INVESTIGACIÓN</option>
                                                        <option value="DN">DENSÍMETRO NUCLEAR</option>
                                                        <option value="MM">MEDIDORES MÓVILES</option>
                                                        <option value="E"> DOCENCIA</option>
                                                        <option value="PR">PERFILAJE Y REGISTRO</option>
                                                        <option value="TR">TRAZADORES</option>
                                                        <option value="HD">HEMODINAMIA</option>
                                                        <option value="OD">RAYOS X ODONTOLÓGICO</option>
                                                        <option value="RX">RADIODIAGNÓSTICO</option>
                                                        <option value="FL">FLUOROSCOPIA</option> --}}
                                                        <option value="AM">APLICACIONES MÉDICAS</option>
                                                        <option value="AI">APLICACIONES INDUSTRIALES</option>
                                                        <option value="O">OTRO</option>
                                                    </select>
                                                </td>
                                                <td></td>
                                            </tr>
                                        @endfor
                                    @endif
                                    {{-- ///FIN DE LA CREACION DE LAS Filas creadas SI LA CANTIDAD DE DOSIMETROS tipo  CONTROL TORAX/////// --}}

                                    {{--///Filas creadas segun la cantidad de dosimetros tipo CONTROL CRISTALINO asignados en EL MES ANTERIOR QUE CAMBIA SI SE MODIFICAN LAS CANTIDADES EN EL MODULO DE NOVEDADES/////// --}}
                                    @foreach($dosicontrolCristalinomesant as $dosicontrolCristalinoant)
                                        <tr>
                                            <td colspan='2' class='align-middle text-center'>CONTROL CRISTALINO</td>
                                            <td class='align-middle'>
                                                <select class="form-select id_dosimetro_asigdosimControlCristalino"  name="id_dosimetro_asigdosimControlCristalino[]" id="id_dosimetro_asigdosimControlCristalino" @if($dosicontrolCristalinoant->dosimetro_uso != 'FALSE') { disabled } @endif>
                                                    <option value="@if($dosicontrolCristalinoant->dosimetro_uso != 'FALSE') {{$dosicontrolCristalinoant->dosimetro_id}} @endif"> @if($dosicontrolCristalinoant->dosimetro_uso != 'FALSE') {{$dosicontrolCristalinoant->dosimetro->codigo_dosimeter}} @else ---- @endif</option>
                                                    @foreach($dosimLibresEzclip as $dosiezcliplib)
                                                        <option value="{{$dosiezcliplib->id_dosimetro}}">{{$dosiezcliplib->codigo_dosimeter}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td class='align-middle text-center'>
                                                <select class="form-select id_holder_asigdosimControlCristalino[]"  name="id_holder_asigdosimControlCristalino[]" id="id_holder_asigdosimControlCristalino" @if($dosicontrolCristalinoant->dosimetro_uso != 'FALSE') { disabled } @endif>
                                                    <option value="@if($dosicontrolCristalinoant->dosimetro_uso != 'FALSE'){{$dosicontrolCristalinoant->holder_id}}@endif">@if($dosicontrolCristalinoant->dosimetro_uso != 'FALSE'){{$dosicontrolCristalinoant->holder->codigo_holder}}@else ---- @endif</option>
                                                    @foreach($holderLibresCristalino as $holibcris)
                                                        <option value="{{$holibcris->id_holder}}">{{$holibcris->codigo_holder}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <select class="form-select ocupacion_asigdosimControlCristalino" name="ocupacion_asigdosimControlCristalino[]" id="ocupacion_asigdosimControlCristalino" style="text-transform:uppercase" @if($dosicontrolCristalinoant->dosimetro_uso != 'FALSE') { disabled } @endif>
                                                    @if($dosicontrolCristalinoant->dosimetro_uso != 'FALSE')
                                                        @if($dosicontrolCristalinoant->ocupacion=='AM')
                                                            <option selected hidden value="AM">APLICACIONES MÉDICAS</option>
                                                        @elseif($dosicontrolCristalinoant->ocupacion=='AI')
                                                            <option selected hidden value="AI">APLICACIONES INDUSTRIALES</option>
                                                        @elseif($dosicontrolCristalinoant->ocupacion=='O')
                                                            <option selected hidden value="O">OTRO</option>
                                                        @endif
                                                    @endif
                                                    <option value="">----</option>
                                                    {{-- <option value="T"> TELETERAPIA</option>
                                                    <option value="BQ">BRAQUITERAPIA</option>
                                                    <option value="MN">MEDICINA NUCLEAR</option>
                                                    <option value="GI">GAMMAGRAFÍA INDUSTRIAL</option>
                                                    <option value="MF">MEDIDORES FIJOS</option>
                                                    <option value="IV">INVESTIGACIÓN</option>
                                                    <option value="DN">DENSÍMETRO NUCLEAR</option>
                                                    <option value="MM">MEDIDORES MÓVILES</option>
                                                    <option value="E"> DOCENCIA</option>
                                                    <option value="PR">PERFILAJE Y REGISTRO</option>
                                                    <option value="TR">TRAZADORES</option>
                                                    <option value="HD">HEMODINAMIA</option>
                                                    <option value="OD">RAYOS X ODONTOLÓGICO</option>
                                                    <option value="RX">RADIODIAGNÓSTICO</option>
                                                    <option value="FL">FLUOROSCOPIA</option> --}}
                                                    <option value="AM">APLICACIONES MÉDICAS</option>
                                                    <option value="AI">APLICACIONES INDUSTRIALES</option>
                                                    <option value="O">OTRO</option>
                                                </select>
                                            </td>
                                            
                                        </tr>
                                    @endforeach
                                    {{-- ///Filas creadas SI LA CANTIDAD DE DOSIMETROS tipo CONTROL CRISTALINO asignados ES MODIFICADA EN EL MES ACTUAL/////// --}}
                                    @if($mescontdosisededepto->mes_asignacion == $mesnumber || $mescontdosisededepto->mes_asignacion <= $mesnumber)
                                        @for($i=1; $i<=($mescontdosisededepto->dosi_control_cristalino - count($dosicontrolCristalinomesant)); $i++)
                                            <tr>
                                                <td colspan='2' class='align-middle text-center'>CONTROL CRISTALINO</td>
                                                <td class='align-middle'>
                                                    <select class="form-select id_dosimetro_asigdosimControlCristalino"  name="id_dosimetro_asigdosimControlCristalino[]" id="id_dosimetro_asigdosimControlCristalino" autofocus aria-label="Floating label select example">
                                                        <option value="">----</option>
                                                        @foreach($dosimLibresEzclip as $dosiezcliplib)
                                                            <option value="{{$dosiezcliplib->id_dosimetro}}">{{$dosiezcliplib->codigo_dosimeter}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td class='align-middle text-center'>
                                                    <select class="form-select id_holder_asigdosimControlCristalino"  name="id_holder_asigdosimControlCristalino[]" id="id_holder_asigdosimControlCristalino" autofocus aria-label="Floating label select example">
                                                        <option value="">----</option>
                                                        @foreach($holderLibresCristalino as $holibcris)
                                                            <option value="{{$holibcris->id_holder}}">{{$holibcris->codigo_holder}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <select class="form-select ocupacion_asigdosimControlCristalino" name="ocupacion_asigdosimControlCristalino[]" id="ocupacion_asigdosimControlCristalino" autofocus style="text-transform:uppercase">
                                                        <option value="">----</option>
                                                        {{-- <option value="T"> TELETERAPIA</option>
                                                        <option value="BQ">BRAQUITERAPIA</option>
                                                        <option value="MN">MEDICINA NUCLEAR</option>
                                                        <option value="GI">GAMMAGRAFÍA INDUSTRIAL</option>
                                                        <option value="MF">MEDIDORES FIJOS</option>
                                                        <option value="IV">INVESTIGACIÓN</option>
                                                        <option value="DN">DENSÍMETRO NUCLEAR</option>
                                                        <option value="MM">MEDIDORES MÓVILES</option>
                                                        <option value="E"> DOCENCIA</option>
                                                        <option value="PR">PERFILAJE Y REGISTRO</option>
                                                        <option value="TR">TRAZADORES</option>
                                                        <option value="HD">HEMODINAMIA</option>
                                                        <option value="OD">RAYOS X ODONTOLÓGICO</option>
                                                        <option value="RX">RADIODIAGNÓSTICO</option>
                                                        <option value="FL">FLUOROSCOPIA</option> --}}
                                                        <option value="AM">APLICACIONES MÉDICAS</option>
                                                        <option value="AI">APLICACIONES INDUSTRIALES</option>
                                                        <option value="O">OTRO</option>
                                                    </select>
                                                </td>
                                                <td></td>
                                            </tr>
                                        @endfor
                                    @endif
                                    {{-- ///FIN DE LA CREACION DE LAS Filas creadas SI LA CANTIDAD DE DOSIMETROS tipo  CONTROL CRISTALINO/////// --}}
                                    
                                    {{--///Filas creadas segun la cantidad de dosimetros tipo CONTROL DEDO asignados en EL MES ANTERIOR QUE CAMBIA SI SE MODIFICAN LAS CANTIDADES EN EL MODULO DE NOVEDADES/////// --}}
                                    @foreach($dosicontrolDedomesant as $dosicontrolDedoant)
                                        <tr>
                                            <td colspan='2' class='align-middle text-center'>CONTROL ANILLO</td>
                                            <td class='align-middle'>
                                                <select class="form-select id_dosimetro_asigdosimControlDedo"  name="id_dosimetro_asigdosimControlDedo[]" id="id_dosimetro_asigdosimControlDedo" @if($dosicontrolDedoant->dosimetro_uso != 'FALSE') { disabled } @endif>
                                                    <option value="@if($dosicontrolDedoant->dosimetro_uso != 'FALSE') {{$dosicontrolDedoant->dosimetro_id}} @endif"> @if($dosicontrolDedoant->dosimetro_uso != 'FALSE') {{$dosicontrolDedoant->dosimetro->codigo_dosimeter}} @else ---- @endif</option>
                                                    @foreach($dosimLibresEzclip as $dosiezcliplib)
                                                        <option value="{{$dosiezcliplib->id_dosimetro}}">{{$dosiezcliplib->codigo_dosimeter}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td class='align-middle text-center'>
                                                <select class="form-select id_holder_asigdosimControlDedo"  name="id_holder_asigdosimControlDedo[]" id="id_holder_asigdosimControlDedo" @if($dosicontrolDedoant->dosimetro_uso != 'FALSE') { disabled } @endif >
                                                    <option value="@if($dosicontrolDedoant->dosimetro_uso != 'FALSE'){{$dosicontrolDedoant->holder_id}}@endif">@if($dosicontrolDedoant->dosimetro_uso != 'FALSE'){{$dosicontrolDedoant->holder->codigo_holder}}@else ---- @endif</option>
                                                    @foreach($holderLibresAnillo as $holibanillo)
                                                        <option value="{{$holibanillo->id_holder}}">{{$holibanillo->codigo_holder}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <select class="form-select ocupacion_asigdosimControlDedo" name="ocupacion_asigdosimControlDedo[]" id="ocupacion_asigdosimControlDedo" style="text-transform:uppercase" @if($dosicontrolDedoant->dosimetro_uso != 'FALSE') { disabled } @endif>
                                                    @if($dosicontrolDedoant->dosimetro_uso != 'FALSE')
                                                        @if($dosicontrolDedoant->ocupacion=='AM')
                                                            <option selected hidden value="AM">APLICACIONES MÉDICAS</option>
                                                        @elseif($dosicontrolDedoant->ocupacion=='AI')
                                                            <option selected hidden value="AI">APLICACIONES INDUSTRIALES</option>
                                                        @elseif($dosicontrolDedoant->ocupacion=='0')
                                                            <option selected hidden value="0">OTRO</option>
                                                        @endif
                                                    @endif
                                                    <option value="">----</option>
                                                    {{-- <option value="T"> TELETERAPIA</option>
                                                    <option value="BQ">BRAQUITERAPIA</option>
                                                    <option value="MN">MEDICINA NUCLEAR</option>
                                                    <option value="GI">GAMMAGRAFÍA INDUSTRIAL</option>
                                                    <option value="MF">MEDIDORES FIJOS</option>
                                                    <option value="IV">INVESTIGACIÓN</option>
                                                    <option value="DN">DENSÍMETRO NUCLEAR</option>
                                                    <option value="MM">MEDIDORES MÓVILES</option>
                                                    <option value="E"> DOCENCIA</option>
                                                    <option value="PR">PERFILAJE Y REGISTRO</option>
                                                    <option value="TR">TRAZADORES</option>
                                                    <option value="HD">HEMODINAMIA</option>
                                                    <option value="OD">RAYOS X ODONTOLÓGICO</option>
                                                    <option value="RX">RADIODIAGNÓSTICO</option>
                                                    <option value="FL">FLUOROSCOPIA</option> --}}
                                                    <option value="AM">APLICACIONES MÉDICAS</option>
                                                    <option value="AI">APLICACIONES INDUSTRIALES</option>
                                                    <option value="O">OTRO</option>
                                                </select>
                                            </td>
                                            
                                        </tr>
                                    @endforeach
                                    {{-- ///Filas creadas SI LA CANTIDAD DE DOSIMETROS tipo CONTROL ANILLO asignados ES MODIFICADA EN EL MES ACTUAL/////// --}}
                                    @if($mescontdosisededepto->mes_asignacion == $mesnumber || $mescontdosisededepto->mes_asignacion <= $mesnumber)
                                        @for($i=1; $i<=($mescontdosisededepto->dosi_control_dedo - count($dosicontrolDedomesant)); $i++)
                                            <tr>
                                                <td colspan='2' class='align-middle text-center'>CONTROL ANILLO</td>
                                                <td class='align-middle'>
                                                    <select class="form-select id_dosimetro_asigdosimControlDedo"  name="id_dosimetro_asigdosimControlDedo[]" id="id_dosimetro_asigdosimControlDedo" autofocus aria-label="Floating label select example">
                                                        <option value="">----</option>
                                                        @foreach($dosimLibresEzclip as $dosiezcliplib)
                                                            <option value="{{$dosiezcliplib->id_dosimetro}}">{{$dosiezcliplib->codigo_dosimeter}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td class='align-middle text-center'>
                                                    <select class="form-select id_holder_asigdosimControlDedo"  name="id_holder_asigdosimControlDedo[]" id="id_holder_asigdosimControlDedo" autofocus aria-label="Floating label select example">
                                                        <option value="">----</option>
                                                        @foreach($holderLibresAnillo as $holibanillo)
                                                            <option value="{{$holibanillo->id_holder}}">{{$holibanillo->codigo_holder}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <select class="form-select ocupacion_asigdosimControlDedo" name="ocupacion_asigdosimControlDedo[]" id="ocupacion_asigdosimControlDedo" autofocus style="text-transform:uppercase">
                                                        <option value="">----</option>
                                                        {{-- <option value="T"> TELETERAPIA</option>
                                                        <option value="BQ">BRAQUITERAPIA</option>
                                                        <option value="MN">MEDICINA NUCLEAR</option>
                                                        <option value="GI">GAMMAGRAFÍA INDUSTRIAL</option>
                                                        <option value="MF">MEDIDORES FIJOS</option>
                                                        <option value="IV">INVESTIGACIÓN</option>
                                                        <option value="DN">DENSÍMETRO NUCLEAR</option>
                                                        <option value="MM">MEDIDORES MÓVILES</option>
                                                        <option value="E"> DOCENCIA</option>
                                                        <option value="PR">PERFILAJE Y REGISTRO</option>
                                                        <option value="TR">TRAZADORES</option>
                                                        <option value="HD">HEMODINAMIA</option>
                                                        <option value="OD">RAYOS X ODONTOLÓGICO</option>
                                                        <option value="RX">RADIODIAGNÓSTICO</option>
                                                        <option value="FL">FLUOROSCOPIA</option> --}}
                                                        <option value="AM">APLICACIONES MÉDICAS</option>
                                                        <option value="AI">APLICACIONES INDUSTRIALES</option>
                                                        <option value="O">OTRO</option>

                                                    </select>
                                                </td>
                                                <td></td>
                                            </tr>
                                        @endfor
                                    @endif
                                    {{-- ///FIN DE LA CREACION DE LAS Filas creadas SI LA CANTIDAD DE DOSIMETROS tipo  CONTROL DEDO/////// --}}


                                    {{-- ///Filas creadas segun la cantidad de dosimetros tipo AREA asignados en EL MES ANTERIOR/////// --}}
                                    @foreach($dosiareamesant as $dosiareant)
                                        <tr>
                                            <td>
                                                <input type="number" name="id_area_asigdosimArea[]" id="id_area_asigdosimArea_mesant" value="{{$dosiareant->areadepartamentosede_id}}" hidden >
                                                <select class="form-select id_area_asigdosimArea"  name="id_area_asigdosimArea[]" id="id_area_asigdosimArea{{$dosiareant->areadepartamentosede_id}}" disabled>
                                                    <option value="{{$dosiareant->areadepartamentosede_id}}">{{$dosiareant->areadepartamentosede->nombre_area}}</option>
                                                    @foreach($areaSede as $area)
                                                        @if($area->id_areadepartamentosede != $dosiareant->areadepartamentosede_id)
                                                            <option  value ="{{$area->id_areadepartamentosede}}">{{$area->nombre_area}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td class="align-middle text-center">ÁREA</td>
                                            <td>
                                                <select class="form-select id_dosimetro_asigdosimArea"  name="id_dosimetro_asigdosimArea[]" id="id_dosimetro_asigdosimArea" @if($dosiareant->dosimetro_uso != 'FALSE') { disabled } @endif>
                                                    <option value="@if($dosiareant->dosimetro_uso != 'FALSE'){{$dosiareant->dosimetro_id}}@endif">@if($dosiareant->dosimetro_uso != 'FALSE'){{$dosiareant->dosimetro->codigo_dosimeter}} @else ---- @endif</option>
                                                    @foreach($dosimLibresAmbiental as $dosiamblib)
                                                        <option value="{{$dosiamblib->id_dosimetro}}">{{$dosiamblib->codigo_dosimeter}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td class="align-middle text-center">N.A</td>
                                            <td>
                                                <select class="form-select" name="ocupacion_asigdosimArea[]" id="ocupacion_asigdosimArea" style="text-transform:uppercase" @if($dosiareant->dosimetro_uso != 'FALSE') { disabled } @endif>
                                                    @if($dosiareant->dosimetro_uso != 'FALSE')
                                                        @if($dosiareant->ocupacion=='AM')
                                                            <option selected hidden value="AM">APLICACIONES MÉDICAS</option>
                                                        @elseif($dosiareant->ocupacion=='AI')
                                                            <option selected hidden value="AI">APLICACIONES INDUSTRIALES</option>
                                                        @elseif($dosiareant->ocupacion=='O')
                                                            <option selected hidden value="O">OTRO</option>
                                                        @endif
                                                    @endif
                                                    <option value="">----</option>
                                                    {{-- <option value="T"> TELETERAPIA</option>
                                                    <option value="BQ">BRAQUITERAPIA</option>
                                                    <option value="MN">MEDICINA NUCLEAR</option>
                                                    <option value="GI">GAMMAGRAFÍA INDUSTRIAL</option>
                                                    <option value="MF">MEDIDORES FIJOS</option>
                                                    <option value="IV">INVESTIGACIÓN</option>
                                                    <option value="DN">DENSÍMETRO NUCLEAR</option>
                                                    <option value="MM">MEDIDORES MÓVILES</option>
                                                    <option value="E"> DOCENCIA</option>
                                                    <option value="PR">PERFILAJE Y REGISTRO</option>
                                                    <option value="TR">TRAZADORES</option>
                                                    <option value="HD">HEMODINAMIA</option>
                                                    <option value="OD">RAYOS X ODONTOLÓGICO</option>
                                                    <option value="RX">RADIODIAGNÓSTICO</option>
                                                    <option value="FL">FLUOROSCOPIA</option> --}}
                                                    <option value="AM">APLICACIONES MÉDICAS</option>
                                                    <option value="AI">APLICACIONES INDUSTRIALES</option>
                                                    <option value="O">OTRO</option>
                                                </select>
                                            </td>
                                            {{-- <td>
                                                <button id="changeArea" class="btn colorQA"  type="button" onclick="changueArea('{{$dosiareant->areadepartamentosede_id}}');">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-x" viewBox="0 0 16 16">
                                                        <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                                                        <path fill-rule="evenodd" d="M12.146 5.146a.5.5 0 0 1 .708 0L14 6.293l1.146-1.147a.5.5 0 0 1 .708.708L14.707 7l1.147 1.146a.5.5 0 0 1-.708.708L14 7.707l-1.146 1.147a.5.5 0 0 1-.708-.708L13.293 7l-1.147-1.146a.5.5 0 0 1 0-.708z"/>
                                                    </svg>
                                                </button>
                                            </td> --}}
                                        </tr>
                                    @endforeach
                                    {{-- ///Filas creadas SI LA CANTIDAD DE DOSIMETROS tipo AREA asignados ES MODIFICADA EN EL MES ACTUAL/////// --}}
                                    @if($mescontdosisededepto->mes_asignacion == $mesnumber || $mescontdosisededepto->mes_asignacion <= $mesnumber)
                                        @for($i=1; $i<=($mescontdosisededepto->dosi_area - count($dosiareamesant)); $i++)
                                            <tr>
                                                <td>
                                                    <select class="form-select id_area_asigdosimArea"  name="id_area_asigdosimArea[]" id="id_area_asigdosimArea" autofocus aria-label="Floating label select example">
                                                        <option value="">----</option>
                                                        @foreach($areaSede as $area)
                                                            <option  value ="{{$area->id_areadepartamentosede}}">{{$area->nombre_area}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td class="align-middle text-center">ÁREA</td>
                                                <td>
                                                    <select class="form-select id_dosimetro_asigdosimArea"  name="id_dosimetro_asigdosimArea[]" id="id_dosimetro_asigdosimArea" autofocus aria-label="Floating label select example">
                                                        <option value="">----</option>
                                                        @foreach($dosimLibresAmbiental as $dosiamblib)
                                                            <option value="{{$dosiamblib->id_dosimetro}}">{{$dosiamblib->codigo_dosimeter}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td class="align-middle text-center">N.A</td>
                                                <td>
                                                    <select class="form-select" name="ocupacion_asigdosimArea[]" id="ocupacion_asigdosimArea" autofocus style="text-transform:uppercase">
                                                        <option value="">----</option>
                                                        {{-- <option value="T"> TELETERAPIA</option>
                                                        <option value="BQ">BRAQUITERAPIA</option>
                                                        <option value="MN">MEDICINA NUCLEAR</option>
                                                        <option value="GI">GAMMAGRAFÍA INDUSTRIAL</option>
                                                        <option value="MF">MEDIDORES FIJOS</option>
                                                        <option value="IV">INVESTIGACIÓN</option>
                                                        <option value="DN">DENSÍMETRO NUCLEAR</option>
                                                        <option value="MM">MEDIDORES MÓVILES</option>
                                                        <option value="E"> DOCENCIA</option>
                                                        <option value="PR">PERFILAJE Y REGISTRO</option>
                                                        <option value="TR">TRAZADORES</option>
                                                        <option value="HD">HEMODINAMIA</option>
                                                        <option value="OD">RAYOS X ODONTOLÓGICO</option>
                                                        <option value="RX">RADIODIAGNÓSTICO</option>
                                                        <option value="FL">FLUOROSCOPIA</option> --}}
                                                        <option value="AM">APLICACIONES MÉDICAS</option>
                                                        <option value="AI">APLICACIONES INDUSTRIALES</option>
                                                        <option value="O">OTRO</option>

                                                    </select>
                                                </td>
                                                {{-- <td>
                                                    <button id="changeArea" class="btn colorQA"  type="button" onclick="changueArea('{{$dosiareant->areadepartamentosede_id}}');">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-x" viewBox="0 0 16 16">
                                                            <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                                                            <path fill-rule="evenodd" d="M12.146 5.146a.5.5 0 0 1 .708 0L14 6.293l1.146-1.147a.5.5 0 0 1 .708.708L14.707 7l1.147 1.146a.5.5 0 0 1-.708.708L14 7.707l-1.146 1.147a.5.5 0 0 1-.708-.708L13.293 7l-1.147-1.146a.5.5 0 0 1 0-.708z"/>
                                                        </svg>
                                                    </button>
                                                </td> --}}
                                            </tr>
                                        @endfor
                                    @endif
                                     {{-- ///FIN DE LA CREACION DE LAS Filas creadas SI LA CANTIDAD DE DOSIMETROS tipo  AREA/////// --}}
                                    {{-- ///Filas creadas segun la cantidad de dosimetros tipo CASO asignados en EL MES ANTERIOR/////// --}}
                                    @foreach($dosicasomesant as $dosicasoant)
                                        <tr>
                                            <td>
                                                <input type="number" name="id_trabajador_asigdosimCaso[]" id="id_trabajador_asigdosimCaso_mesant" value="{{$dosicasoant->persona_id}}" hidden>
                                                <select class="form-select"  name="id_trabajador_asigdosimCaso[]" id="id_trabajador_asigdosimCaso{{$dosicasoant->persona_id}}" disabled>
                                                    <option value="{{$dosicasoant->persona_id}}"> @if($dosicasoant->persona_id != NULL) {{$dosicasoant->persona->primer_nombre_persona}} {{$dosicasoant->persona->segundo_nombre_persona}} {{$dosicasoant->persona->primer_apellido_persona}} {{$dosicasoant->persona->segundo_apellido_persona}} @endif </option>
                                                    {{-- @foreach($trabajadoreSede as $trabsed)
                                                        @if($trabsed->trabajador->id_trabajador != $dosicasoant->trabajador_id)
                                                            <option value="{{$trabsed->trabajador->id_trabajador}}">{{$trabsed->trabajador->primer_nombre_trabajador}} {{$trabsed->trabajador->segundo_nombre_trabajador}} {{$trabsed->trabajador->primer_apellido_trabajador}} {{$trabsed->trabajador->segundo_apellido_trabajador}}</option>
                                                        @endif
                                                    @endforeach --}}
                                                    @foreach($personaSede as $persed)
                                                        @if($persed->id_persona != $dosicasoant->persona_id)
                                                            <option value="{{$persed->id_persona}}">{{$persed->primer_nombre_persona}} {{$persed->segundo_nombre_persona}} {{$persed->primer_apellido_persona}} {{$persed->segundo_apellido_persona}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td class="align-middle text-center">CASO</td>
                                            <td class="align-middle text-center">
                                                <select class="form-select"  name="id_dosimetro_asigdosimCaso[]" id="id_dosimetro_asigdosimCaso" @if($dosicasoant->dosimetro_uso != 'FALSE') { disabled } @endif>
                                                    <option value="@if($dosicasoant->dosimetro_uso != 'FALSE') {{$dosicasoant->dosimetro_id}} @endif">@if($dosicasoant->dosimetro_uso != 'FALSE') {{$dosicasoant->dosimetro->codigo_dosimeter}} @else ---- @endif</option>
                                                    @foreach($dosimLibresGeneral as $dosigenlib)
                                                        <option value="{{$dosigenlib->id_dosimetro}}">{{$dosigenlib->codigo_dosimeter}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td class="align-middle text-center">N.A</td>
                                            <td class="align-middle text-center">
                                                <select class="form-select" name="ocupacion_asigdosimCaso[]" id="ocupacion_asigdosimCaso" style="text-transform:uppercase" @if($dosicasoant->dosimetro_uso != 'FALSE') { disabled } @endif>
                                                    @if($dosicasoant->dosimetro_uso != 'FALSE')
                                                        @if($dosicasoant->ocupacion=='AM')
                                                            <option selected hidden value="AM">APLICACIONES MÉDICAS</option>
                                                        @elseif($dosicasoant->ocupacion=='AI')
                                                            <option selected hidden value="AI">APLICACIONES INDUSTRIALES</option>
                                                        @elseif($dosicasoant->ocupacion=='O')
                                                            <option selected hidden value="O">OTRO</option>
                                                        @endif
                                                    @endif
                                                    <option value="">----</option>
                                                    {{-- <option value="T"> TELETERAPIA</option>
                                                    <option value="BQ">BRAQUITERAPIA</option>
                                                    <option value="MN">MEDICINA NUCLEAR</option>
                                                    <option value="GI">GAMMAGRAFÍA INDUSTRIAL</option>
                                                    <option value="MF">MEDIDORES FIJOS</option>
                                                    <option value="IV">INVESTIGACIÓN</option>
                                                    <option value="DN">DENSÍMETRO NUCLEAR</option>
                                                    <option value="MM">MEDIDORES MÓVILES</option>
                                                    <option value="E"> DOCENCIA</option>
                                                    <option value="PR">PERFILAJE Y REGISTRO</option>
                                                    <option value="TR">TRAZADORES</option>
                                                    <option value="HD">HEMODINAMIA</option>
                                                    <option value="OD">RAYOS X ODONTOLÓGICO</option>
                                                    <option value="RX">RADIODIAGNÓSTICO</option>
                                                    <option value="FL">FLUOROSCOPIA</option> --}}
                                                    <option value="AM">APLICACIONES MÉDICAS</option>
                                                    <option value="AI">APLICACIONES INDUSTRIALES</option>
                                                    <option value="O">OTRO</option>

                                                </select>
                                            </td>
                                            {{-- <td>
                                                <button id="changeCaso" class="btn btn-danger"  type="button" onclick="changueCaso('{{$dosicasoant->persona_id}}');">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-x" viewBox="0 0 16 16">
                                                        <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                                                        <path fill-rule="evenodd" d="M12.146 5.146a.5.5 0 0 1 .708 0L14 6.293l1.146-1.147a.5.5 0 0 1 .708.708L14.707 7l1.147 1.146a.5.5 0 0 1-.708.708L14 7.707l-1.146 1.147a.5.5 0 0 1-.708-.708L13.293 7l-1.147-1.146a.5.5 0 0 1 0-.708z"/>
                                                    </svg>
                                                </button>
                                            </td> --}}
                                        </tr>
                                    @endforeach
                                    {{-- ///Filas creadas SI LA CANTIDAD DE DOSIMETROS tipo CASO asignados ES MODIFICADA EN EL MES ACTUAL/////// --}}
                                    @if($mescontdosisededepto->mes_asignacion == $mesnumber || $mescontdosisededepto->mes_asignacion <= $mesnumber)
                                        @for($i=1; $i<=($mescontdosisededepto->dosi_caso - count($dosicasomesant)); $i++)
                                            <tr>
                                                <td>
                                                    <select class="form-select"  name="id_trabajador_asigdosimCaso[]" id="id_trabajador_asigdosimCaso" autofocus aria-label="Floating label select example">
                                                        <option value="">----</option>
                                                        
                                                        {{-- @foreach($trabajadoreSede as $trabsed)
                                                            <option value="{{$trabsed->trabajador->id_trabajador}}">{{$trabsed->trabajador->primer_nombre_trabajador}} {{$trabsed->trabajador->segundo_nombre_trabajador}} {{$trabsed->trabajador->primer_apellido_trabajador}} {{$trabsed->trabajador->segundo_apellido_trabajador}}</option>
                                                        @endforeach --}}
                                                        @foreach($personaSede as $persed)
                                                            <option value="{{$persed->id_persona}}">{{$persed->primer_nombre_persona}} {{$persed->segundo_nombre_persona}} {{$persed->primer_apellido_persona}} {{$persed->segundo_apellido_persona}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td class="align-middle text-center">CASO</td>
                                                <td class="align-middle text-center">
                                                    <select class="form-select"  name="id_dosimetro_asigdosimCaso[]" id="id_dosimetro_asigdosimCaso" autofocus aria-label="Floating label select example">
                                                        <option value="">----</option>
                                                        @foreach($dosimLibresGeneral as $dosigenlib)
                                                            <option value="{{$dosigenlib->id_dosimetro}}">{{$dosigenlib->codigo_dosimeter}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td class="align-middle text-center">N.A</td>
                                                <td class="align-middle text-center">
                                                    <select class="form-select" name="ocupacion_asigdosimCaso[]" id="ocupacion_asigdosimCaso" autofocus style="text-transform:uppercase">
                                                        <option value="">----</option>
                                                        {{-- <option value="T"> TELETERAPIA</option>
                                                        <option value="BQ">BRAQUITERAPIA</option>
                                                        <option value="MN">MEDICINA NUCLEAR</option>
                                                        <option value="GI">GAMMAGRAFÍA INDUSTRIAL</option>
                                                        <option value="MF">MEDIDORES FIJOS</option>
                                                        <option value="IV">INVESTIGACIÓN</option>
                                                        <option value="DN">DENSÍMETRO NUCLEAR</option>
                                                        <option value="MM">MEDIDORES MÓVILES</option>
                                                        <option value="E"> DOCENCIA</option>
                                                        <option value="PR">PERFILAJE Y REGISTRO</option>
                                                        <option value="TR">TRAZADORES</option>
                                                        <option value="HD">HEMODINAMIA</option>
                                                        <option value="OD">RAYOS X ODONTOLÓGICO</option>
                                                        <option value="RX">RADIODIAGNÓSTICO</option>
                                                        <option value="FL">FLUOROSCOPIA</option> --}}
                                                        <option value="AM">APLICACIONES MÉDICAS</option>
                                                        <option value="AI">APLICACIONES INDUSTRIALES</option>
                                                        <option value="O">OTRO</option>

                                                    </select>
                                                </td>
                                                {{-- <td>
                                                    <button id="changeCaso" class="btn btn-danger"  type="button" onclick="changueCaso('{{$dosicasoant->persona_id}}');">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-x" viewBox="0 0 16 16">
                                                            <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                                                            <path fill-rule="evenodd" d="M12.146 5.146a.5.5 0 0 1 .708 0L14 6.293l1.146-1.147a.5.5 0 0 1 .708.708L14.707 7l1.147 1.146a.5.5 0 0 1-.708.708L14 7.707l-1.146 1.147a.5.5 0 0 1-.708-.708L13.293 7l-1.147-1.146a.5.5 0 0 1 0-.708z"/>
                                                        </svg>
                                                    </button>
                                                </td> --}}
                                            </tr>
                                        @endfor
                                    @endif
                                    {{-- ///FIN DE LA CREACION DE LAS Filas creadas SI LA CANTIDAD DE DOSIMETROS tipo  CASO/////// --}}
                                    {{-- ///Filas creadas segun la cantidad de dosimetros tipo  TORAX  asignados en EL MES ANTERIOR/////// --}}
                                    @foreach($dositoraxmesant as $dositoraxant)
                                        <tr>
                                            <td>
                                                <input type="number" name="id_trabajador_asigdosimTorax[]" id="id_trabajador_asigdosimTorax_mesant" value="{{$dositoraxant->persona_id}}" hidden>
                                                <select class="form-select"  name="id_trabajador_asigdosimTorax[]" id="id_trabajador_asigdosimTorax{{$dositoraxant->persona_id}}" disabled>
                                                    <option value="{{$dositoraxant->persona_id}}">@if($dositoraxant->persona_id != NULL) {{$dositoraxant->persona->primer_nombre_persona}} {{$dositoraxant->persona->segundo_nombre_persona}} {{$dositoraxant->persona->primer_apellido_persona}} {{$dositoraxant->persona->segundo_apellido_persona}} @endif</option>
                                                    {{-- @foreach($trabajadoreSede as $trabsed)
                                                        @if($trabsed->trabajador->id_trabajador != $dositoraxant->trabajador_id)
                                                            <option value="{{$trabsed->trabajador->id_trabajador}}">{{$trabsed->trabajador->primer_nombre_trabajador}} {{$trabsed->trabajador->segundo_nombre_trabajador}} {{$trabsed->trabajador->primer_apellido_trabajador}} {{$trabsed->trabajador->segundo_apellido_trabajador}}</option>
                                                        @endif
                                                    @endforeach --}}
                                                    @foreach($personaSede as $persed)
                                                        @if($persed->id_persona != $dositoraxant->persona_id)
                                                            <option value="{{$persed->id_persona}}">{{$persed->primer_nombre_persona}} {{$persed->segundo_nombre_persona}} {{$persed->primer_apellido_persona}} {{$persed->segundo_apellido_persona}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td class="align-middle text-center">TÓRAX</td>
                                            <td class="align-middle text-center">
                                                <select class="form-select"  name="id_dosimetro_asigdosimTorax[]" id="id_dosimetro_asigdosimTorax" @if($dositoraxant->dosimetro_uso != 'FALSE') { disabled } @endif>
                                                    <option value="@if($dositoraxant->dosimetro_uso != 'FALSE') {{$dositoraxant->dosimetro_id}}@endif">@if($dositoraxant->dosimetro_uso != 'FALSE') {{$dositoraxant->dosimetro->codigo_dosimeter}} @else ---- @endif</option>
                                                    @foreach($dosimLibresGeneral as $dosigenlib)
                                                        <option value="{{$dosigenlib->id_dosimetro}}">{{$dosigenlib->codigo_dosimeter}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td class="align-middle text-center">N.A</td>
                                            <td class="align-middle text-center">
                                                <select class="form-select" name="ocupacion_asigdosimTorax[]" id="ocupacion_asigdosimTorax" style="text-transform:uppercase" @if($dositoraxant->dosimetro_uso != 'FALSE') { disabled } @endif>
                                                    @if($dositoraxant->dosimetro_uso != 'FALSE')
                                                        @if($dositoraxant->ocupacion=='AM')
                                                            <option selected hidden value="AM">APLICACIONES MÉDICAS</option>
                                                        @elseif($dositoraxant->ocupacion=='AI')
                                                            <option selected hidden value="AI">APLICACIONES INDUSTRIALES</option>
                                                        @elseif($dositoraxant->ocupacion=='O')
                                                            <option selected hidden value="O">OTRO</option>
                                                        @endif
                                                    @endif
                                                    <option value="">----</option>
                                                    {{-- <option value="T"> TELETERAPIA</option>
                                                    <option value="BQ">BRAQUITERAPIA</option>
                                                    <option value="MN">MEDICINA NUCLEAR</option>
                                                    <option value="GI">GAMMAGRAFÍA INDUSTRIAL</option>
                                                    <option value="MF">MEDIDORES FIJOS</option>
                                                    <option value="IV">INVESTIGACIÓN</option>
                                                    <option value="DN">DENSÍMETRO NUCLEAR</option>
                                                    <option value="MM">MEDIDORES MÓVILES</option>
                                                    <option value="E"> DOCENCIA</option>
                                                    <option value="PR">PERFILAJE Y REGISTRO</option>
                                                    <option value="TR">TRAZADORES</option>
                                                    <option value="HD">HEMODINAMIA</option>
                                                    <option value="OD">RAYOS X ODONTOLÓGICO</option>
                                                    <option value="RX">RADIODIAGNÓSTICO</option>
                                                    <option value="FL">FLUOROSCOPIA</option> --}}
                                                    <option value="AM">APLICACIONES MÉDICAS</option>
                                                    <option value="AI">APLICACIONES INDUSTRIALES</option>
                                                    <option value="O">OTRO</option>

                                                </select>
                                            </td>
                                            {{-- <td>
                                                <button id="changeTorax" class="btn btn-danger"  type="button" onclick="changueTorax('{{$dositoraxant->persona_id}}');">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-x" viewBox="0 0 16 16">
                                                        <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                                                        <path fill-rule="evenodd" d="M12.146 5.146a.5.5 0 0 1 .708 0L14 6.293l1.146-1.147a.5.5 0 0 1 .708.708L14.707 7l1.147 1.146a.5.5 0 0 1-.708.708L14 7.707l-1.146 1.147a.5.5 0 0 1-.708-.708L13.293 7l-1.147-1.146a.5.5 0 0 1 0-.708z"/>
                                                    </svg>
                                                </button>
                                            </td> --}}
                                        </tr>
                                    @endforeach
                                    {{-- ///Filas creadas SI LA CANTIDAD DE DOSIMETROS tipo TORAX asignados ES MODIFICADA EN EL MES ACTUAL/////// --}}
                                    @if($mescontdosisededepto->mes_asignacion == $mesnumber || $mescontdosisededepto->mes_asignacion <= $mesnumber)
                                        @for($i=1; $i<=($mescontdosisededepto->dosi_torax - count($dositoraxmesant)); $i++)
                                            <tr>
                                                <td>
                                                    <select class="form-select"  name="id_trabajador_asigdosimTorax[]" id="id_trabajador_asigdosimTorax" autofocus aria-label="Floating label select example">
                                                        <option value="">----</option>
                                                        {{-- @foreach($trabajadoreSede as $trabsed)
                                                            <option value="{{$trabsed->trabajador->id_trabajador}}">{{$trabsed->trabajador->primer_nombre_trabajador}} {{$trabsed->trabajador->segundo_nombre_trabajador}} {{$trabsed->trabajador->primer_apellido_trabajador}} {{$trabsed->trabajador->segundo_apellido_trabajador}}</option>
                                                        @endforeach --}}
                                                        @foreach($personaSede as $persed)
                                                            <option value="{{$persed->id_persona}}">{{$persed->primer_nombre_persona}} {{$persed->segundo_nombre_persona}} {{$persed->primer_apellido_persona}} {{$persed->segundo_apellido_persona}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td class="align-middle text-center">TÓRAX</td>
                                                <td class="align-middle text-center">
                                                    <select class="form-select"  name="id_dosimetro_asigdosimTorax[]" id="id_dosimetro_asigdosimTorax" autofocus aria-label="Floating label select example">
                                                        <option value="">----</option>
                                                        @foreach($dosimLibresGeneral as $dosigenlib)
                                                            <option value="{{$dosigenlib->id_dosimetro}}">{{$dosigenlib->codigo_dosimeter}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td class="align-middle text-center">N.A</td>
                                                <td class="align-middle text-center">
                                                    <select class="form-select" name="ocupacion_asigdosimTorax[]" id="ocupacion_asigdosimTorax" autofocus style="text-transform:uppercase">
                                                        <option value="">----</option>
                                                        {{-- <option value="T"> TELETERAPIA</option>
                                                        <option value="BQ">BRAQUITERAPIA</option>
                                                        <option value="MN">MEDICINA NUCLEAR</option>
                                                        <option value="GI">GAMMAGRAFÍA INDUSTRIAL</option>
                                                        <option value="MF">MEDIDORES FIJOS</option>
                                                        <option value="IV">INVESTIGACIÓN</option>
                                                        <option value="DN">DENSÍMETRO NUCLEAR</option>
                                                        <option value="MM">MEDIDORES MÓVILES</option>
                                                        <option value="E"> DOCENCIA</option>
                                                        <option value="PR">PERFILAJE Y REGISTRO</option>
                                                        <option value="TR">TRAZADORES</option>
                                                        <option value="HD">HEMODINAMIA</option>
                                                        <option value="OD">RAYOS X ODONTOLÓGICO</option>
                                                        <option value="RX">RADIODIAGNÓSTICO</option>
                                                        <option value="FL">FLUOROSCOPIA</option> --}}
                                                        <option value="AM">APLICACIONES MÉDICAS</option>
                                                        <option value="AI">APLICACIONES INDUSTRIALES</option>
                                                        <option value="O">OTRO</option>

                                                    </select>
                                                </td>
                                                {{-- <td>
                                                    <button id="changeTorax" class="btn btn-danger"  type="button" onclick="changueTorax('{{$dositoraxant->persona_id}}');">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-x" viewBox="0 0 16 16">
                                                            <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                                                            <path fill-rule="evenodd" d="M12.146 5.146a.5.5 0 0 1 .708 0L14 6.293l1.146-1.147a.5.5 0 0 1 .708.708L14.707 7l1.147 1.146a.5.5 0 0 1-.708.708L14 7.707l-1.146 1.147a.5.5 0 0 1-.708-.708L13.293 7l-1.147-1.146a.5.5 0 0 1 0-.708z"/>
                                                        </svg>
                                                    </button>
                                                </td> --}}
                                            </tr>
                                        @endfor
                                    @endif
                                    {{-- ///FIN DE LA CREACION DE LAS Filas creadas SI LA CANTIDAD DE DOSIMETROS tipo  TORAX/////// --}}
                                    {{-- ///Filas creadas segun la cantidad de dosimetros tipo  CRISTALINO asignados en EL MES ANTERIOR/////// --}}
                                    @foreach($dosicristalinomesant as $dosicristalinoant)
                                        <tr>
                                            <td>
                                                <input type="number" name="id_trabajador_asigdosimCristalino[]" id="id_trabajador_asigdosimCristalino_mesant" value="{{$dosicristalinoant->persona_id}}" hidden>
                                                <select class="form-select"  name="id_trabajador_asigdosimCristalino[]" id="id_trabajador_asigdosimCristalino{{$dosicristalinoant->persona_id}}" disabled>
                                                    <option value="{{$dosicristalinoant->persona_id}}">@if($dosicristalinoant->persona_id != NULL) {{$dosicristalinoant->persona->primer_nombre_persona}} {{$dosicristalinoant->persona->segundo_nombre_persona}} {{$dosicristalinoant->persona->primer_apellido_persona}} {{$dosicristalinoant->persona->segundo_apellido_persona}} @endif</option>
                                                    {{-- @foreach($trabajadoreSede as $trabsed)
                                                        @if($trabsed->trabajador->id_trabajador != $dosicristalinoant->trabajador_id)
                                                            <option value="{{$trabsed->trabajador->id_trabajador}}">{{$trabsed->trabajador->primer_nombre_trabajador}} {{$trabsed->trabajador->segundo_nombre_trabajador}} {{$trabsed->trabajador->primer_apellido_trabajador}} {{$trabsed->trabajador->segundo_apellido_trabajador}}</option>
                                                        @endif
                                                    @endforeach --}}
                                                    @foreach($personaSede as $persed)
                                                        @if($persed->id_persona != $dosicristalinoant->persona_id)
                                                            <option value="{{$persed->id_persona}}">{{$persed->primer_nombre_persona}} {{$persed->segundo_nombre_persona}} {{$persed->primer_apellido_persona}} {{$persed->segundo_apellido_persona}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td class="align-middle text-center">CRISTALINO</td>
                                            <td class="align-middle text-center">
                                                <select class="form-select"  name="id_dosimetro_asigdosimCristalino[]" id="id_dosimetro_asigdosimCristalino" @if($dosicristalinoant->dosimetro_uso != 'FALSE') { disabled } @endif>
                                                    <option value="@if($dosicristalinoant->dosimetro_uso != 'FALSE'){{$dosicristalinoant->dosimetro_id}}@endif">@if($dosicristalinoant->dosimetro_uso != 'FALSE'){{$dosicristalinoant->dosimetro->codigo_dosimeter}} @else ---- @endif</option>
                                                    @foreach($dosimLibresEzclip as $dosiezcliplib)
                                                        <option value="{{$dosiezcliplib->id_dosimetro}}">{{$dosiezcliplib->codigo_dosimeter}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td class="align-middle text-center">
                                                <select class="form-select"  name="id_holder_asigdosimCristalino[]" id="id_holder_asigdosimCristalino" @if($dosicristalinoant->dosimetro_uso != 'FALSE') { disabled } @endif>
                                                    <option value="@if($dosicristalinoant->dosimetro_uso != 'FALSE'){{$dosicristalinoant->holder_id}}@endif">@if($dosicristalinoant->dosimetro_uso != 'FALSE'){{$dosicristalinoant->holder->codigo_holder}}@else ---- @endif</option>
                                                    @foreach($holderLibresCristalino as $holibcris)
                                                        <option value="{{$holibcris->id_holder}}">{{$holibcris->codigo_holder}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td class="align-middle text-center">
                                                <select class="form-select" name="ocupacion_asigdosimCristalino[]" id="ocupacion_asigdosimCristalino" @if($dosicristalinoant->dosimetro_uso != 'FALSE') { disabled } @endif>
                                                    @if($dosicristalinoant->dosimetro_uso != 'FALSE')
                                                        @if($dosicristalinoant->ocupacion=='AM')
                                                            <option selected hidden value="AM">APLICACIONES MÉDICAS</option>
                                                        @elseif($dosicristalinoant->ocupacion=='AI')
                                                            <option selected hidden value="AI">APLICACIONES INDUSTRIALES</option>
                                                        @elseif($dosicristalinoant->ocupacion=='O')
                                                            <option selected hidden value="O">OTRO</option>
                                                        @endif
                                                    @endif    
                                                    <option value="">----</option>
                                                    {{-- <option value="T"> TELETERAPIA</option>
                                                    <option value="BQ">BRAQUITERAPIA</option>
                                                    <option value="MN">MEDICINA NUCLEAR</option>
                                                    <option value="GI">GAMMAGRAFÍA INDUSTRIAL</option>
                                                    <option value="MF">MEDIDORES FIJOS</option>
                                                    <option value="IV">INVESTIGACIÓN</option>
                                                    <option value="DN">DENSÍMETRO NUCLEAR</option>
                                                    <option value="MM">MEDIDORES MÓVILES</option>
                                                    <option value="E"> DOCENCIA</option>
                                                    <option value="PR">PERFILAJE Y REGISTRO</option>
                                                    <option value="TR">TRAZADORES</option>
                                                    <option value="HD">HEMODINAMIA</option>
                                                    <option value="OD">RAYOS X ODONTOLÓGICO</option>
                                                    <option value="RX">RADIODIAGNÓSTICO</option>
                                                    <option value="FL">FLUOROSCOPIA</option> --}}
                                                    <option value="AM">APLICACIONES MÉDICAS</option>
                                                    <option value="AI">APLICACIONES INDUSTRIALES</option>
                                                    <option value="O">OTRO</option>

                                                </select>
                                            </td>
                                            {{-- <td>
                                                <button id="changeCristalino" class="btn btn-danger"  type="button" onclick="changueCristalino('{{$dosicristalinoant->persona_id}}');">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-x" viewBox="0 0 16 16">
                                                        <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                                                        <path fill-rule="evenodd" d="M12.146 5.146a.5.5 0 0 1 .708 0L14 6.293l1.146-1.147a.5.5 0 0 1 .708.708L14.707 7l1.147 1.146a.5.5 0 0 1-.708.708L14 7.707l-1.146 1.147a.5.5 0 0 1-.708-.708L13.293 7l-1.147-1.146a.5.5 0 0 1 0-.708z"/>
                                                    </svg>
                                                </button>
                                            </td> --}}
                                        </tr>
                                    @endforeach
                                    {{-- ///Filas creadas SI LA CANTIDAD DE DOSIMETROS tipo  CRISTALINO asignados ES MODIFICADA EN EL MES ACTUAL/////// --}}
                                    @if($mescontdosisededepto->mes_asignacion == $mesnumber || $mescontdosisededepto->mes_asignacion <= $mesnumber)
                                        @for($i=1; $i<=($mescontdosisededepto->dosi_cristalino - count($dosicristalinomesant)); $i++)
                                            <tr>
                                                <td>
                                                    <select class="form-select"  name="id_trabajador_asigdosimCristalino[]" id="id_trabajador_asigdosimCristalino" autofocus aria-label="Floating label select example">
                                                        <option value="">----</option>
                                                        {{-- @foreach($trabajadoreSede as $trabsed)
                                                            <option value="{{$trabsed->trabajador->id_trabajador}}">{{$trabsed->trabajador->primer_nombre_trabajador}} {{$trabsed->trabajador->segundo_nombre_trabajador}} {{$trabsed->trabajador->primer_apellido_trabajador}} {{$trabsed->trabajador->segundo_apellido_trabajador}}</option>
                                                        @endforeach --}}
                                                        @foreach($personaSede as $persed)
                                                            <option value="{{$persed->id_persona}}">{{$persed->primer_nombre_persona}} {{$persed->segundo_nombre_persona}} {{$persed->primer_apellido_persona}} {{$persed->segundo_apellido_persona}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td class="align-middle text-center">CRISTALINO</td>
                                                <td class="align-middle text-center">
                                                    <select class="form-select"  name="id_dosimetro_asigdosimCristalino[]" id="id_dosimetro_asigdosimCristalino" autofocus aria-label="Floating label select example">
                                                        <option value="">----</option>
                                                        @foreach($dosimLibresEzclip as $dosiezcliplib)
                                                            <option value="{{$dosiezcliplib->id_dosimetro}}">{{$dosiezcliplib->codigo_dosimeter}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <select class="form-select"  name="id_holder_asigdosimCristalino[]" id="id_holder_asigdosimCristalino" autofocus aria-label="Floating label select example">
                                                        <option value="">----</option>
                                                        @foreach($holderLibresCristalino as $holibcris)
                                                            <option value="{{$holibcris->id_holder}}">{{$holibcris->codigo_holder}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <select class="form-select" name="ocupacion_asigdosimCristalino[]" id="ocupacion_asigdosimCristalino" autofocus style="text-transform:uppercase">
                                                        <option value="">----</option>
                                                        {{-- <option value="T"> TELETERAPIA</option>
                                                        <option value="BQ">BRAQUITERAPIA</option>
                                                        <option value="MN">MEDICINA NUCLEAR</option>
                                                        <option value="GI">GAMMAGRAFÍA INDUSTRIAL</option>
                                                        <option value="MF">MEDIDORES FIJOS</option>
                                                        <option value="IV">INVESTIGACIÓN</option>
                                                        <option value="DN">DENSÍMETRO NUCLEAR</option>
                                                        <option value="MM">MEDIDORES MÓVILES</option>
                                                        <option value="E"> DOCENCIA</option>
                                                        <option value="PR">PERFILAJE Y REGISTRO</option>
                                                        <option value="TR">TRAZADORES</option>
                                                        <option value="HD">HEMODINAMIA</option>
                                                        <option value="OD">RAYOS X ODONTOLÓGICO</option>
                                                        <option value="RX">RADIODIAGNÓSTICO</option>
                                                        <option value="FL">FLUOROSCOPIA</option> --}}
                                                        <option value="AM">APLICACIONES MÉDICAS</option>
                                                        <option value="AI">APLICACIONES INDUSTRIALES</option>
                                                        <option value="O">OTRO</option>

                                                    </select>
                                                </td>
                                                {{-- <td>
                                                    <button id="changeCristalino" class="btn btn-danger"  type="button" onclick="changueCristalino('{{$dosicristalinoant->persona_id}}');">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-x" viewBox="0 0 16 16">
                                                            <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                                                            <path fill-rule="evenodd" d="M12.146 5.146a.5.5 0 0 1 .708 0L14 6.293l1.146-1.147a.5.5 0 0 1 .708.708L14.707 7l1.147 1.146a.5.5 0 0 1-.708.708L14 7.707l-1.146 1.147a.5.5 0 0 1-.708-.708L13.293 7l-1.147-1.146a.5.5 0 0 1 0-.708z"/>
                                                        </svg>
                                                    </button>
                                                </td> --}}
                                            </tr>
                                        @endfor
                                    
                                    @endif
                                    {{-- ///FIN DE LA CREACION DE LAS Filas creadas SI LA CANTIDAD DE DOSIMETROS tipo  CRISTALINO/////// --}}
                                    {{-- ///Filas creadas segun la cantidad de dosimetros tipo  MUÑECA asignados en EL MES ANTERIOR/////// --}}
                                    @foreach($dosimuñecamesant as $dosimuñecant)
                                        <tr>
                                            <td>
                                                <input type="number" name="id_trabajador_asigdosimMuneca[]" id="id_trabajador_asigdosimMuneca_mesant" value="{{$dosimuñecant->persona_id}}" hidden>
                                                <select class="form-select"  name="id_trabajador_asigdosimMuneca[]" id="id_trabajador_asigdosimMuneca{{$dosimuñecant->persona_id}}" disabled>
                                                    <option value="{{$dosimuñecant->persona_id}}">@if($dosimuñecant->persona_id != NULL) {{$dosimuñecant->persona->primer_nombre_persona}} {{$dosimuñecant->persona->segundo_nombre_persona}} {{$dosimuñecant->persona->primer_apellido_persona}} {{$dosimuñecant->persona->segundo_apellido_persona}} @endif</option>
                                                    {{-- @foreach($trabajadoreSede as $trabsed)
                                                        @if($trabsed->trabajador->id_trabajador != $dosimuñecant->trabajador_id)
                                                            <option value="{{$trabsed->trabajador->id_trabajador}}">{{$trabsed->trabajador->primer_nombre_trabajador}} {{$trabsed->trabajador->segundo_nombre_trabajador}} {{$trabsed->trabajador->primer_apellido_trabajador}} {{$trabsed->trabajador->segundo_apellido_trabajador}}</option>
                                                        @endif
                                                    @endforeach --}}
                                                    @foreach($personaSede as $persed)
                                                        @if($persed->id_persona != $dosimuñecant->persona_id)
                                                            <option value="{{$persed->id_persona}}">{{$persed->primer_nombre_persona}} {{$persed->segundo_nombre_persona}} {{$persed->primer_apellido_persona}} {{$persed->segundo_apellido_persona}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td class="align-middle text-center">MUÑECA</td>
                                            <td class="align-middle text-center">
                                                <select class="form-select"  name="id_dosimetro_asigdosimMuneca[]" id="id_dosimetro_asigdosimMuneca" @if($dosimuñecant->dosimetro_uso != 'FALSE') { disabled } @endif>
                                                    <option value="@if($dosimuñecant->dosimetro_uso != 'FALSE'){{$dosimuñecant->dosimetro_id}}@endif">@if($dosimuñecant->dosimetro_uso != 'FALSE'){{$dosimuñecant->dosimetro->codigo_dosimeter}}@else ---- @endif</option>
                                                    @foreach($dosimLibresEzclip as $dosiezcliplib)
                                                        <option value="{{$dosiezcliplib->id_dosimetro}}">{{$dosiezcliplib->codigo_dosimeter}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td class="align-middle text-center">
                                                <select class="form-select"  name="id_holder_asigdosimMuneca[]" id="id_holder_asigdosimMuneca" @if($dosimuñecant->dosimetro_uso != 'FALSE') { disabled } @endif>
                                                    <option value="@if($dosimuñecant->dosimetro_uso != 'FALSE'){{$dosimuñecant->holder_id}}@endif">@if($dosimuñecant->dosimetro_uso != 'FALSE'){{$dosimuñecant->holder->codigo_holder}}@else ---- @endif</option>
                                                    @foreach($holderLibresExtrem as $holibexm)
                                                        <option value="{{$holibexm->id_holder}}">{{$holibexm->codigo_holder}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td class="align-middle text-center">
                                                <select class="form-select" name="ocupacion_asigdosimMuneca[]" id="ocupacion_asigdosimMuneca"  style="text-transform:uppercase" @if($dosimuñecant->dosimetro_uso != 'FALSE') { disabled } @endif>
                                                    @if($dosimuñecant->dosimetro_uso != 'FALSE')
                                                        @if($dosimuñecant->ocupacion=='AM')
                                                            <option selected hidden value="AM">APLICACIONES MÉDICAS</option>
                                                        @elseif($dosimuñecant->ocupacion=='AI')
                                                            <option selected hidden value="AI">APLICACIONES INDUSTRIALES</option>
                                                        @elseif($dosimuñecant->ocupacion=='O')
                                                            <option selected hidden value="O">OTRO</option>
                                                        @endif
                                                    @endif
                                                    <option value="">----</option>
                                                    {{-- <option value="T"> TELETERAPIA</option>
                                                    <option value="BQ">BRAQUITERAPIA</option>
                                                    <option value="MN">MEDICINA NUCLEAR</option>
                                                    <option value="GI">GAMMAGRAFÍA INDUSTRIAL</option>
                                                    <option value="MF">MEDIDORES FIJOS</option>
                                                    <option value="IV">INVESTIGACIÓN</option>
                                                    <option value="DN">DENSÍMETRO NUCLEAR</option>
                                                    <option value="MM">MEDIDORES MÓVILES</option>
                                                    <option value="E"> DOCENCIA</option>
                                                    <option value="PR">PERFILAJE Y REGISTRO</option>
                                                    <option value="TR">TRAZADORES</option>
                                                    <option value="HD">HEMODINAMIA</option>
                                                    <option value="OD">RAYOS X ODONTOLÓGICO</option>
                                                    <option value="RX">RADIODIAGNÓSTICO</option>
                                                    <option value="FL">FLUOROSCOPIA</option> --}}
                                                    <option value="AM">APLICACIONES MÉDICAS</option>
                                                    <option value="AI">APLICACIONES INDUSTRIALES</option>
                                                    <option value="O">OTRO</option>

                                                </select>
                                            </td>
                                            {{-- <td>
                                                <button id="changeMuneca" class="btn btn-danger"  type="button" onclick="changueMuneca('{{$dosimuñecant->persona_id}}');">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-x" viewBox="0 0 16 16">
                                                        <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                                                        <path fill-rule="evenodd" d="M12.146 5.146a.5.5 0 0 1 .708 0L14 6.293l1.146-1.147a.5.5 0 0 1 .708.708L14.707 7l1.147 1.146a.5.5 0 0 1-.708.708L14 7.707l-1.146 1.147a.5.5 0 0 1-.708-.708L13.293 7l-1.147-1.146a.5.5 0 0 1 0-.708z"/>
                                                    </svg>
                                                </button>
                                            </td> --}}
                                        </tr>
                                    @endforeach
                                    {{-- ///Filas creadas SI LA CANTIDAD DE DOSIMETROS tipo MUÑECA asignados ES MODIFICADA EN EL MES ACTUAL/////// --}}
                                    @if($mescontdosisededepto->mes_asignacion == $mesnumber || $mescontdosisededepto->mes_asignacion <= $mesnumber)
                                        @for($i=1; $i<=($mescontdosisededepto->dosi_muñeca - count($dosimuñecamesant)); $i++)
                                            <tr>
                                                <td>
                                                    <select class="form-select"  name="id_trabajador_asigdosimMuneca[]" id="id_trabajador_asigdosimMuneca" autofocus aria-label="Floating label select example">
                                                        <option value="">----</option>
                                                        
                                                        @foreach($personaSede as $persed)
                                                            <option value="{{$persed->id_persona}}">{{$persed->primer_nombre_persona}} {{$persed->segundo_nombre_persona}} {{$persed->primer_apellido_persona}} {{$persed->segundo_apellido_persona}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td class="align-middle text-center">MUÑECA</td>
                                                <td class="align-middle text-center">
                                                    <select class="form-select"  name="id_dosimetro_asigdosimMuneca[]" id="id_dosimetro_asigdosimMuneca" autofocus aria-label="Floating label select example">
                                                        <option value="">----</option>
                                                        @foreach($dosimLibresEzclip as $dosiezcliplib)
                                                            <option value="{{$dosiezcliplib->id_dosimetro}}">{{$dosiezcliplib->codigo_dosimeter}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <select class="form-select"  name="id_holder_asigdosimMuneca[]" id="id_holder_asigdosimMuneca" autofocus aria-label="Floating label select example">
                                                        <option value="">----</option>
                                                        @foreach($holderLibresExtrem as $holibexm)
                                                            <option value="{{$holibexm->id_holder}}">{{$holibexm->codigo_holder}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <select class="form-select" name="ocupacion_asigdosimMuneca[]" id="ocupacion_asigdosimMuneca" autofocus style="text-transform:uppercase">
                                                        <option value="">----</option>
                                                        {{-- <option value="T"> TELETERAPIA</option>
                                                        <option value="BQ">BRAQUITERAPIA</option>
                                                        <option value="MN">MEDICINA NUCLEAR</option>
                                                        <option value="GI">GAMMAGRAFÍA INDUSTRIAL</option>
                                                        <option value="MF">MEDIDORES FIJOS</option>
                                                        <option value="IV">INVESTIGACIÓN</option>
                                                        <option value="DN">DENSÍMETRO NUCLEAR</option>
                                                        <option value="MM">MEDIDORES MÓVILES</option>
                                                        <option value="E"> DOCENCIA</option>
                                                        <option value="PR">PERFILAJE Y REGISTRO</option>
                                                        <option value="TR">TRAZADORES</option>
                                                        <option value="HD">HEMODINAMIA</option>
                                                        <option value="OD">RAYOS X ODONTOLÓGICO</option>
                                                        <option value="RX">RADIODIAGNÓSTICO</option>
                                                        <option value="FL">FLUOROSCOPIA</option> --}}
                                                        <option value="AM">APLICACIONES MÉDICAS</option>
                                                        <option value="AI">APLICACIONES INDUSTRIALES</option>
                                                        <option value="O">OTRO</option>
                                                        
                                                    </select>
                                                </td>
                                                {{-- <td>
                                                    <button id="changeMuneca" class="btn btn-danger"  type="button" onclick="changueMuneca('{{$dosimuñecant->persona_id}}');">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-x" viewBox="0 0 16 16">
                                                            <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                                                            <path fill-rule="evenodd" d="M12.146 5.146a.5.5 0 0 1 .708 0L14 6.293l1.146-1.147a.5.5 0 0 1 .708.708L14.707 7l1.147 1.146a.5.5 0 0 1-.708.708L14 7.707l-1.146 1.147a.5.5 0 0 1-.708-.708L13.293 7l-1.147-1.146a.5.5 0 0 1 0-.708z"/>
                                                        </svg>
                                                    </button>
                                                </td> --}}
                                            </tr>
                                        @endfor
                                    @endif
                                    {{-- ///FIN DE LA CREACION DE LAS Filas creadas para LA CANTIDAD DE DOSIMETROS tipo  MUÑECA/////// --}}
                                    {{-- ///Filas creadas segun la cantidad de dosimetros tipo DEDO asignados en EL MES ANTERIOR/////// --}}
                                    @foreach($dosidedomesant as $dosidedoant)
                                        <tr>
                                            <td>
                                                <input type="number" name="id_trabajador_asigdosimDedo[]" id="id_trabajador_asigdosimDedo_mesant" value="{{$dosidedoant->persona_id}}" hidden>
                                                <select class="form-select"  name="id_trabajador_asigdosimDedo[]" id="id_trabajador_asigdosimDedo{{$dosidedoant->persona_id}}" disabled>
                                                    <option value="{{$dosidedoant->persona_id}}">@if($dosidedoant->persona_id != NULL) {{$dosidedoant->persona->primer_nombre_persona}} {{$dosidedoant->persona->segundo_nombre_persona}} {{$dosidedoant->persona->primer_apellido_persona}} {{$dosidedoant->persona->segundo_apellido_persona}} @endif</option>
                                                    {{-- @foreach($trabajadoreSede as $trabsed)
                                                        @if($trabsed->trabajador->id_trabajador != $dosidedoant->trabajador_id)
                                                            <option value="{{$trabsed->trabajador->id_trabajador}}">{{$trabsed->trabajador->primer_nombre_trabajador}} {{$trabsed->trabajador->segundo_nombre_trabajador}} {{$trabsed->trabajador->primer_apellido_trabajador}} {{$trabsed->trabajador->segundo_apellido_trabajador}}</option>
                                                        @endif
                                                    @endforeach --}}
                                                    @foreach($personaSede as $persed)
                                                        @if($persed->id_persona != $dosidedoant->persona_id)
                                                            <option value="{{$persed->id_persona}}">{{$persed->primer_nombre_persona}} {{$persed->segundo_nombre_persona}} {{$persed->primer_apellido_persona}} {{$persed->segundo_apellido_persona}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td class="align-middle text-center">ANILLO</td>
                                            <td class="align-middle text-center">
                                                <select class="form-select"  name="id_dosimetro_asigdosimDedo[]" id="id_dosimetro_asigdosimDedo"  @if($dosidedoant->dosimetro_uso != 'FALSE') { disabled } @endif>
                                                    <option value="@if($dosidedoant->dosimetro_uso != 'FALSE'){{$dosidedoant->dosimetro_id}}@endif">@if($dosidedoant->dosimetro_uso != 'FALSE'){{$dosidedoant->dosimetro->codigo_dosimeter}}@else ---- @endif</option>
                                                    @foreach($dosimLibresEzclip as $dosiezcliplib)
                                                        <option value="{{$dosiezcliplib->id_dosimetro}}">{{$dosiezcliplib->codigo_dosimeter}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td class="align-middle text-center">
                                                <select class="form-select"  name="id_holder_asigdosimDedo[]" id="id_holder_asigdosimDedo" @if($dosidedoant->dosimetro_uso != 'FALSE') { disabled } @endif >
                                                    <option value="@if($dosidedoant->dosimetro_uso != 'FALSE'){{$dosidedoant->holder_id}}@endif">@if($dosidedoant->dosimetro_uso != 'FALSE'){{$dosidedoant->holder->codigo_holder}}@else ---- @endif</option>
                                                    @foreach($holderLibresAnillo as $holibanillo)
                                                        <option value="{{$holibanillo->id_holder}}">{{$holibanillo->codigo_holder}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td class="align-middle text-center">
                                                <select class="form-select" name="ocupacion_asigdosimDedo[]" id="ocupacion_asigdosipDedo" @if($dosidedoant->dosimetro_uso != 'FALSE') { disabled } @endif>
                                                    @if($dosidedoant->dosimetro_uso != 'FALSE')
                                                        @if($dosidedoant->ocupacion=='AM')
                                                            <option selected hidden value="AM">APLICACIONES MÉDICAS</option>
                                                        @elseif($dosidedoant->ocupacion=='AI')
                                                            <option selected hidden value="AI">APLICACIONES INDUSTRIALES</option>
                                                        @elseif($dosidedoant->ocupacion=='O')
                                                            <option selected hidden value="O">OTRO</option>
                                                        @endif
                                                    @endif
                                                    <option value="">----</option>
                                                    {{-- <option value="T"> TELETERAPIA</option>
                                                    <option value="BQ">BRAQUITERAPIA</option>
                                                    <option value="MN">MEDICINA NUCLEAR</option>
                                                    <option value="GI">GAMMAGRAFÍA INDUSTRIAL</option>
                                                    <option value="MF">MEDIDORES FIJOS</option>
                                                    <option value="IV">INVESTIGACIÓN</option>
                                                    <option value="DN">DENSÍMETRO NUCLEAR</option>
                                                    <option value="MM">MEDIDORES MÓVILES</option>
                                                    <option value="E"> DOCENCIA</option>
                                                    <option value="PR">PERFILAJE Y REGISTRO</option>
                                                    <option value="TR">TRAZADORES</option>
                                                    <option value="HD">HEMODINAMIA</option>
                                                    <option value="OD">RAYOS X ODONTOLÓGICO</option>
                                                    <option value="RX">RADIODIAGNÓSTICO</option>
                                                    <option value="FL">FLUOROSCOPIA</option> --}}
                                                    <option value="AM">APLICACIONES MÉDICAS</option>
                                                    <option value="AI">APLICACIONES INDUSTRIALES</option>
                                                    <option value="O">OTRO</option>

                                                </select>
                                            </td>
                                            {{-- <td>
                                                <button id="changeDedo" class="btn btn-danger"  type="button" onclick="changueDedo('{{$dosidedoant->persona_id}}');">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-x" viewBox="0 0 16 16">
                                                        <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                                                        <path fill-rule="evenodd" d="M12.146 5.146a.5.5 0 0 1 .708 0L14 6.293l1.146-1.147a.5.5 0 0 1 .708.708L14.707 7l1.147 1.146a.5.5 0 0 1-.708.708L14 7.707l-1.146 1.147a.5.5 0 0 1-.708-.708L13.293 7l-1.147-1.146a.5.5 0 0 1 0-.708z"/>
                                                    </svg>
                                                </button>
                                            </td> --}}
                                        </tr>
                                    @endforeach
                                    {{-- ///Filas creadas SI LA CANTIDAD DE DOSIMETROS tipo DEDO asignados ES MODIFICADA EN EL MES ACTUAL/////// --}}
                                    @if($mescontdosisededepto->mes_asignacion == $mesnumber || $mescontdosisededepto->mes_asignacion <= $mesnumber)
                                        @for($i=1; $i<=($mescontdosisededepto->dosi_dedo - count($dosidedomesant)); $i++)
                                            <tr>
                                                <td>
                                                    <select class="form-select"  name="id_trabajador_asigdosimDedo[]" id="id_trabajador_asigdosimDedo" autofocus aria-label="Floating label select example">
                                                        <option value="">----</option>
                                                        {{-- @foreach($trabajadoreSede as $trabsed)
                                                            <option value="{{$trabsed->trabajador->id_trabajador}}">{{$trabsed->trabajador->primer_nombre_trabajador}} {{$trabsed->trabajador->segundo_nombre_trabajador}} {{$trabsed->trabajador->primer_apellido_trabajador}} {{$trabsed->trabajador->segundo_apellido_trabajador}}</option>
                                                        @endforeach --}}
                                                        @foreach($personaSede as $persed)
                                                            <option value="{{$persed->id_persona}}">{{$persed->primer_nombre_persona}} {{$persed->segundo_nombre_persona}} {{$persed->primer_apellido_persona}} {{$persed->segundo_apellido_persona}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td class="align-middle text-center">ANILLO</td>
                                                <td class="align-middle text-center">
                                                    <select class="form-select"  name="id_dosimetro_asigdosimDedo[]" id="id_dosimetro_asigdosimDedo" autofocus aria-label="Floating label select example">
                                                        <option value="">----</option>
                                                        @foreach($dosimLibresEzclip as $dosiezcliplib)
                                                            <option value="{{$dosiezcliplib->id_dosimetro}}">{{$dosiezcliplib->codigo_dosimeter}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <select class="form-select"  name="id_holder_asigdosimDedo[]" id="id_holder_asigdosimDedo" autofocus aria-label="Floating label select example">
                                                        <option value="">----</option>
                                                        @foreach($holderLibresAnillo as $holibanillo)
                                                            <option value="{{$holibanillo->id_holder}}">{{$holibanillo->codigo_holder}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <select class="form-select" name="ocupacion_asigdosimDedo[]" id="ocupacion_asigdosipDedo" autofocus style="text-transform:uppercase">
                                                        <option value="">----</option>
                                                        {{-- <option value="T"> TELETERAPIA</option>
                                                        <option value="BQ">BRAQUITERAPIA</option>
                                                        <option value="MN">MEDICINA NUCLEAR</option>
                                                        <option value="GI">GAMMAGRAFÍA INDUSTRIAL</option>
                                                        <option value="MF">MEDIDORES FIJOS</option>
                                                        <option value="IV">INVESTIGACIÓN</option>
                                                        <option value="DN">DENSÍMETRO NUCLEAR</option>
                                                        <option value="MM">MEDIDORES MÓVILES</option>
                                                        <option value="E"> DOCENCIA</option>
                                                        <option value="PR">PERFILAJE Y REGISTRO</option>
                                                        <option value="TR">TRAZADORES</option>
                                                        <option value="HD">HEMODINAMIA</option>
                                                        <option value="OD">RAYOS X ODONTOLÓGICO</option>
                                                        <option value="RX">RADIODIAGNÓSTICO</option>
                                                        <option value="FL">FLUOROSCOPIA</option> --}}
                                                        <option value="AM">APLICACIONES MÉDICAS</option>
                                                        <option value="AI">APLICACIONES INDUSTRIALES</option>
                                                        <option value="O">OTRO</option>

                                                    </select>
                                                </td>
                                                {{-- <td>
                                                    <button id="changeDedo" class="btn btn-danger"  type="button" onclick="changueDedo('{{$dosidedoant->persona_id}}');">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-x" viewBox="0 0 16 16">
                                                            <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                                                            <path fill-rule="evenodd" d="M12.146 5.146a.5.5 0 0 1 .708 0L14 6.293l1.146-1.147a.5.5 0 0 1 .708.708L14.707 7l1.147 1.146a.5.5 0 0 1-.708.708L14 7.707l-1.146 1.147a.5.5 0 0 1-.708-.708L13.293 7l-1.147-1.146a.5.5 0 0 1 0-.708z"/>
                                                        </svg>
                                                    </button>
                                                </td> --}}
                                            </tr>
                                        @endfor
                                    @endif
                                    {{-- ///FIN DE LA CREACION DE LAS Filas creadas para LA CANTIDAD DE DOSIMETROS tipo  DEDO/////// --}}
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
            </form>
                    <div class="col">
                        <div class="d-grid gap-2 col-6 mx-auto">
                            <a href="{{route('asignadosicontratomn.clear',['asigdosicont' => $contdosisededepto->id_contdosisededepto, 'mesnumber' => $mesnumber] )}}" class="btn btn-primary limpiar_asig"  type="button" id="limpiar_asig" name="limpiar_asig" role="button">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                    <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                                </svg> <br> LIMPIAR ASIGNACIONES
                            </a>
                        </div>
                    </div>
                    <div class="col"></div>
                </div>
                
            
        </div>
        <br>
    </div>
    <div class="col md"></div>
</div>



<script
src="https://code.jquery.com/jquery-3.6.0.js"
integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
crossorigin="anonymous">
</script>

<script type="text/javascript">
    $(document).ready(function(){
        // Creamos array con los meses del año
        const meses = ['ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO', 'JULIO', 'AGOSTO', 'SEPTIEMBRE', 'OCTUBRE', 'NOVIEMBRE', 'DICIEMBRE'];
        let fecha = new Date("{{$contdosisededepto->contratodosimetriasede->dosimetriacontrato->fecha_inicio}}, 00:00:00");
        
        console.log(fecha);
        if('{{$contdosisededepto->contratodosimetriasede->dosimetriacontrato->periodo_recambio}}' == 'MENS'){
            
            var xx = 1; 
            for(var i=1; i<=11; i++){
                /* console.log(i); */
                var r = new Date(new Date(fecha).setMonth(fecha.getMonth()+i));
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
                for(var x=2; x<=12; x++){
                    /* console.log("ESTA ES LA X="+x); */
                    if("{{$mesnumber}}" == xx){
                        document.getElementById('mes{{$mesnumber}}').innerHTML = fechaesp1+' - '+fechaesp2;
                    }
                }
            }
        }else if('{{$contdosisededepto->contratodosimetriasede->dosimetriacontrato->periodo_recambio}}' == 'TRIMS'){
            var xx = 1;
            for(var i=3; i<=11; i= i+3){

                console.log(i);
                var r = new Date(new Date(fecha).setMonth(fecha.getMonth()+i));
                console.log("r1" +r);
                var r2 = new Date(new Date(r).setMonth(r.getMonth()+3));
                var r2final = new Date(new Date(r2).setDate(r.getDate()-1));
                console.log("r2 " +r2final);
                var fechaesp1 = r.getDate()+' '+meses[r.getMonth()] + ' DE ' + r.getUTCFullYear();
                console.log(fechaesp1);

                var fechaesp2 = (r2final.getDate()) +' '+ meses[r2final.getMonth()] + ' DE ' + r2final.getUTCFullYear(); 
                console.log(fechaesp2);
                
                console.log("{{$mesnumber}}");
                xx ++;
                
                if("{{$mesnumber}}" == xx){
                        document.getElementById('mes{{$mesnumber}}').innerHTML = fechaesp1+' - '+fechaesp2;
                }
            }
        }
        $('#id_dosimetro_asigdosimControlTorax').select2({width: "100%",});
        $('#ocupacion_asigdosimControlTorax').select2({width: "100%",});
        $('#id_dosimetro_asigdosimControlCristalino').select2({width: "100%",});
        $('#id_holder_asigdosimControlCristalino').select2({width: "100%",});
        $('#ocupacion_asigdosimControlCristalino').select2({width: "100%",});
        $('#id_dosimetro_asigdosimControlDedo').select2({width: "100%",});
        $('#id_holder_asigdosimControlDedo').select2({width: "100%",});
        $('#ocupacion_asigdosimControlDedo').select2({width: "100%",});
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
        ///SELECT2 PAR LOS SELECT DE LAS OCUPACIONES/////
        var ocu_area = document.querySelectorAll('select[name="ocupacion_asigdosimArea[]"');
        for(var i = 0; i < ocu_area.length; i++){
            ocu_area[i].setAttribute("id", "ocupacion_asigdosimArea"+[i]);
            $('#ocupacion_asigdosimArea'+[i]).select2({width: "100%",});
        }
        var ocu_caso = document.querySelectorAll('select[name="ocupacion_asigdosimCaso[]"');
        for(var i = 0; i < ocu_caso.length; i++){
            ocu_caso[i].setAttribute("id", "ocupacion_asigdosimCaso"+[i]);
            $('#ocupacion_asigdosimCaso'+[i]).select2({width: "100%",});
        }
        var ocu_torax = document.querySelectorAll('select[name="ocupacion_asigdosimTorax[]"');
        for(var i = 0; i < ocu_torax.length; i++){
            ocu_torax[i].setAttribute("id", "ocupacion_asigdosimTorax"+[i]);
            $('#ocupacion_asigdosimTorax'+[i]).select2({width: "100%",});
        }
        var ocu_cristalino = document.querySelectorAll('select[name="ocupacion_asigdosimCristalino[]"');
        for(var i = 0; i < ocu_cristalino.length; i++){
            ocu_cristalino[i].setAttribute("id", "ocupacion_asigdosimCristalino"+[i]);
            $('#ocupacion_asigdosimCristalino'+[i]).select2({width: "100%",});
        }
        var ocu_muñeca = document.querySelectorAll('select[name="ocupacion_asigdosimMuneca[]"');
        for(var i = 0; i < ocu_muñeca.length; i++){
            ocu_muñeca[i].setAttribute("id", "ocupacion_asigdosimMuneca"+[i]);
            $('#ocupacion_asigdosimMuneca'+[i]).select2({width: "100%",});
        }
        var ocu_dedo = document.querySelectorAll('select[name="ocupacion_asigdosimDedo[]"');
        for(var i = 0; i < ocu_dedo.length; i++){
            ocu_dedo[i].setAttribute("id", "ocupacion_asigdosimDedo"+[i]);
            $('#ocupacion_asigdosimDedo'+[i]).select2({width: "100%",});
        }
//////////////////////////////

    })

</script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>   
@if(session('clear')== 'ok')
    <script>
        Swal.fire(
        'ACTUALIZADO!',
        'SE HA ACTUALIZADO CON ÉXITO.',
        'success'
        )
        
    </script>
@endif  


<script type="text/javascript">
   
    function fechaultimodia(){
        var fecha = document.getElementById("primerDia_asigdosim").value;
        var fecha_inicio = new Date(fecha);
        fecha_inicio.setMinutes(fecha_inicio.getMinutes() + fecha_inicio.getTimezoneOffset());
        
        console.log("FECHA INICIO"+fecha_inicio);
        if('{{$contdosisededepto->contratodosimetriasede->dosimetriacontrato->periodo_recambio}}' == 'MENS'){
            var fecha_final_año = fecha_inicio.getFullYear();
            console.log(fecha_final_año);
            var mm = fecha_inicio.getMonth() + 2;
            var fecha_final_mes = (mm < 10 ? '0' : '')+mm;
            if(fecha_final_mes == 13){
                fecha_final_mes = '01' ;
            }
            console.log("MES "+fecha_final_mes);
            var dd = fecha_inicio.getDate();
            var fecha_final_dia = (dd < 10 ? '0' : '')+dd;
            console.log("DIA" + fecha_final_dia);
            var fecha_final = new Date(fecha_final_año+'-'+fecha_final_mes+'-'+fecha_final_dia);
            console.log("ESTA ES LA FECHA FINAL" + fecha_final);

            if(fecha_final_mes == 01){
                var fechaFinaly = fecha_final.getFullYear() + 1;
                console.log("AÑO"+fechaFinaly);
            }else{
                var fechaFinaly = fecha_final.getFullYear();
            }
            console.log(fechaFinaly);
            var fechaFinalm = fecha_final.getMonth()+1;
            var fechaFinalmm = (fechaFinalm < 10 ? '0' : '')+fechaFinalm;
            console.log(fechaFinalmm);
            var fechaFinald = fecha_final.getDate();
            var fechaFinaldd = (fechaFinald < 10 ? '0' : '')+fechaFinald;
            console.log(fechaFinaldd);
            var fechaFinalymd = fechaFinaly+'-'+fechaFinalmm+'-'+fechaFinaldd;
            console.log(fechaFinalymd);
            document.getElementById("ultimoDia_asigdosim").value = fechaFinalymd;
        }else if('{{$contdosisededepto->contratodosimetriasede->dosimetriacontrato->periodo_recambio}}' == 'TRIMS'){
            var fecha_final_año = fecha_inicio.getFullYear();
            console.log(fecha_final_año);
            var mm = fecha_inicio.getMonth() + 4;
            var fecha_final_mes = (mm < 10 ? '0' : '')+mm;
            if(fecha_final_mes == 13){
                fecha_final_mes = '01' ;
            }
            console.log("MES "+fecha_final_mes);
            var dd = fecha_inicio.getDate();
            var fecha_final_dia = (dd < 10 ? '0' : '')+dd;
            console.log("DIA" + fecha_final_dia);
            var fecha_final = new Date(fecha_final_año+'-'+fecha_final_mes+'-'+fecha_final_dia);
            console.log("ESTA ES LA FECHA FINAL" + fecha_final);

            if(fecha_final_mes == 01){
                var fechaFinaly = fecha_final.getFullYear() + 1;
                console.log("AÑO"+fechaFinaly);
            }else{
                var fechaFinaly = fecha_final.getFullYear();
            }
            console.log(fechaFinaly);
            var fechaFinalm = fecha_final.getMonth()+1;
            var fechaFinalmm = (fechaFinalm < 10 ? '0' : '')+fechaFinalm;
            console.log(fechaFinalmm);
            var fechaFinald = fecha_final.getDate();
            var fechaFinaldd = (fechaFinald < 10 ? '0' : '')+fechaFinald;
            console.log(fechaFinaldd);
            var fechaFinalymd = fechaFinaly+'-'+fechaFinalmm+'-'+fechaFinaldd;
            console.log(fechaFinalymd);
            document.getElementById("ultimoDia_asigdosim").value = fechaFinalymd;
        }
    };
    /* function changueArea(area){
        
        Swal.fire({
            title: 'DESEA CAMBIAR DE ÁREA EN UN DOSÍMETRO TIPO "AMBIENTAL"?',
            text: "EL CAMPO A CAMBIAR SE HABILITARÁ, SELECCIONE EL ÁREA NUEVA",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#1A9980',
            cancelButtonColor: '#d33',
            confirmButtonText: 'SI, SEGURO!'
        }).then((result) => {
            if (result.isConfirmed) {
                @foreach($dosiareamesant as $ant)
                    if('{{$ant->areadepartamentosede_id}}' == area){
                        $("#id_area_asigdosimArea{{$ant->areadepartamentosede_id}}").attr("disabled", false);
                        document.getElementById("id_area_asigdosimArea_mesant").remove();
                        
                    }
                @endforeach
            }
        })
    }
    function changueCaso(caso){
        alert(caso);
        Swal.fire({
            title: 'DESEA CAMBIAR EL TRABAJADOR DE UN DOSÍMETRO TIPO "CASO"?',
            text: "EL CAMPO A CAMBIAR SE HABILITARÁ, SELECCIONE EL TRABAJADOR NUEVO",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#1A9980',
            cancelButtonColor: '#d33',
            confirmButtonText: 'SI, SEGURO!'
        }).then((result) => {
            if (result.isConfirmed) {
                @foreach($dosicasomesant as $casoant)
                    if('{{$casoant->trabajador_id}}' == caso){
                        $("#id_trabajador_asigdosimCaso{{$casoant->trabajador_id}}").attr("disabled", false);
                        document.getElementById("id_trabajador_asigdosimCaso_mesant").remove();
                    }
                @endforeach
            }
        })
    }
    function changueTorax(torax){
        
        Swal.fire({
            title: 'DESEA CAMBIAR EL TRABAJADOR DE UN DOSÍMETRO TIPO "TÓRAX"?',
            text: "EL CAMPO A CAMBIAR SE HABILITARÁ, SELECCIONE EL TRABAJADOR NUEVO",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#1A9980',
            cancelButtonColor: '#d33',
            confirmButtonText: 'SI, SEGURO!'
        }).then((result) => {
            if (result.isConfirmed) {
                @foreach($dositoraxmesant as $toraxant)
                    if('{{$toraxant->trabajador_id}}' == torax){
                        $("#id_trabajador_asigdosimTorax{{$toraxant->trabajador_id}}").attr("disabled", false);
                        document.getElementById("id_trabajador_asigdosimTorax_mesant").remove();
                    }
                @endforeach
            }
        })
    }
    function changueCristalino(cristalino){
        
        Swal.fire({
            title: 'DESEA CAMBIAR EL TRABAJADOR DE UN DOSÍMETRO TIPO "CRISTALINO"?',
            text: "EL CAMPO A CAMBIAR SE HABILITARÁ, SELECCIONE EL TRABAJADOR NUEVO",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#1A9980',
            cancelButtonColor: '#d33',
            confirmButtonText: 'SI, SEGURO!'
        }).then((result) => {
            if (result.isConfirmed) {
                @foreach($dosicristalinomesant as $cristalinoant)
                    if('{{$cristalinoant->trabajador_id}}' == cristalino){
                        $("#id_trabajador_asigdosimCristalino{{$cristalinoant->trabajador_id}}").attr("disabled", false);
                        document.getElementById("id_trabajador_asigdosimCristalino_mesant").remove();
                    }
                @endforeach
            }
        })
    }
    function changueMuneca(muñeca){
        
        Swal.fire({
            title: 'DESEA CAMBIAR EL TRABAJADOR DE UN DOSÍMETRO TIPO "MUÑECA"?',
            text: "EL CAMPO A CAMBIAR SE HABILITARÁ, SELECCIONE EL TRABAJADOR NUEVO",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#1A9980',
            cancelButtonColor: '#d33',
            confirmButtonText: 'SI, SEGURO!'
        }).then((result) => {
            if (result.isConfirmed) {
                @foreach($dosimuñecamesant as $muñecant)
                    if('{{$muñecant->trabajador_id}}' == muñeca){
                        $("#id_trabajador_asigdosimMuneca{{$muñecant->trabajador_id}}").attr("disabled", false);
                        document.getElementById("id_trabajador_asigdosimMuneca_mesant").remove();
                    }
                @endforeach
            }
        })
    }
    function changueDedo(dedo){
        
        Swal.fire({
            title: 'DESEA CAMBIAR EL TRABAJADOR DE UN DOSÍMETRO TIPO "ANILLO"?',
            text: "EL CAMPO A CAMBIAR SE HABILITARÁ, SELECCIONE EL TRABAJADOR NUEVO",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#1A9980',
            cancelButtonColor: '#d33',
            confirmButtonText: 'SI, SEGURO!'
        }).then((result) => {
            if (result.isConfirmed) {
                @foreach($dosidedomesant as $dedoant)
                    if('{{$dedoant->persona_id}}' == dedo){
                        $("#id_trabajador_asigdosimDedo{{$dedoant->persona_id}}").attr("disabled", false);
                        document.getElementById("id_trabajador_asigdosimDedo_mesant").remove();
                        
                    }
                @endforeach
            }
        })
    } */

</script>

<script type="text/javascript">
    $(document).ready(function(){

        $('#limpiar_asig').click(function(e){
            e.preventDefault();
            Swal.fire({
                text: 'SEGURO QUE DESEA LIMPIAR LA INFORMACIÓN DE LAS ASIGNACIONES DEL PERÍODO ANTERIOR?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33    ',
                confirmButtonText: 'SI, SEGURO!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{route('asignadosicontratomn.clear',['asigdosicont' => $contdosisededepto->id_contdosisededepto, 'mesnumber' => $mesnumber] )}}";
                }
            })
        })
    })
</script>

<script type="text/javascript">
    $(document).ready(function(){
        $('#form-nueva-asignacion_mn').submit(function(e){
            e.preventDefault();

            ///////////////////////VALIDACION PARA LAS FECHAS/////////////////
            var fecha_inicio = document.getElementById("primerDia_asigdosim").value;
            if(fecha_inicio == ''){
                    /* return alert("FALTA SELECCIONAR ALGUN TRABAJADOR"); */
                    return Swal.fire({
                                title:"FALTA SELECCIONAR LA FECHA DEL PRIMER DÍA PARA EL PERIODO",
                                text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN DESEADA",
                                icon: 'error'
                            });
                    
            };
            var fecha_final = document.getElementById("ultimoDia_asigdosim").value;
            if(fecha_final == ''){
                    /* return alert("FALTA SELECCIONAR ALGUN TRABAJADOR"); */
                    return Swal.fire({
                                title:"FALTA SELECCIONAR LA FECHA DEL ULTIMO DÍA PARA EL PERIODO",
                                text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN DESEADA",
                                icon: 'error'
                            });
                    
            };
            /////////////////////VALIDACION PARA LOS DOSIMETROS/////////////////
            var dosimControlTorax = document.querySelectorAll('select[name="id_dosimetro_asigdosimControlTorax[]"]');
            console.log("ESTAS SON LOS  DOSIM CONTROL TORAX");
            console.log(dosimControlTorax);
            for(var i = 0; i < dosimControlTorax.length; i++){
                var values = dosimControlTorax[i].value;
                if(values == ''){
                    return Swal.fire({
                                title:"FALTA SELECCIONAR EL DOSÍMETRO DE TIPO CONTROL TÓRAX",
                                text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN DESEADA",
                                icon: 'error'
                            });
                    
                };
                for(var x = 0; x < dosimControlTorax.length; x++){
                    var valuesX = dosimControlTorax[x].value;
                    if(values == valuesX && i != x){
                        return Swal.fire({
                                title:"ALGUNOS DOSÍMETROS CONTROL TÓRAX SELECCIONADOS SE ENCUENTRAN REPETIDOS",
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
                                title:"FALTA SELECCIONAR EL DOSÍMETRO DE TIPO CONTROL CRISTALINO",
                                text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN DESEADA",
                                icon: 'error'
                            });
                    
                };
                for(var x = 0; x < dosimControlTorax.length; x++){
                    var valuesX = dosimControlTorax[x].value;
                    if(values == valuesX && i != x){
                        return Swal.fire({
                                title:"ALGUNOS DOSÍMETROS CONTROL CRISTALINO SELECCIONADOS SE ENCUENTRAN REPETIDOS",
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
                                title:"FALTA SELECCIONAR EL DOSÍMETRO DE TIPO CONTROL ANILLO",
                                text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN DESEADA",
                                icon: 'error'
                            });
                    
                };
                for(var x = 0; x < dosimControlDedo.length; x++){
                    var valuesX = dosimControlDedo[x].value;
                    if(values == valuesX && i != x){
                        return Swal.fire({
                                title:"ALGUNOS DOSÍMETROS CONTROL ANILLO SELECCIONADOS SE ENCUENTRAN REPETIDOS",
                                text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN CORRECTAMENTE",
                                icon: 'error'
                            });
                    }
                }
                for(var y = 0; y < dosimControlCristalino.length; y++){
                    var valuesCrist = dosimControlCristalino[y].value;
                    if(values == valuesCrist){
                        return Swal.fire({
                                title:"ALGUNOS DOSÍMETROS CONTROL ANILLO SELECCIONADOS SE ENCUENTRAN REPETIDOS CON LOS DOSÍMETROS DE CONTROL CRISTALINO",
                                text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN CORRECTAMENTE",
                                icon: 'error'
                            });
                    }
                }
            };

            var dosimArea = document.querySelectorAll('select[name="id_dosimetro_asigdosimArea[]"]');
            console.log("ESTAS SON LOS DOSIMTROS AREA");
            console.log(dosimArea);
            for(var i = 0; i < dosimArea.length; i++){
                var values = dosimArea[i].value;
                if(values == ''){
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
            };
            var dosimCaso = document.querySelectorAll('select[name="id_dosimetro_asigdosimCaso[]"]');
            console.log("ESTAS SON LOS DOSIMETROS CASO");
            console.log(dosimCaso);
            for(var i = 0; i < dosimCaso.length; i++){
                var values = dosimCaso[i].value;
                if(values == ''){
                    
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
            };
            var dosimTorax = document.querySelectorAll('select[name="id_dosimetro_asigdosimTorax[]"]');
            console.log("ESTAS SON LOS DOSIMETROS TORAX");
            console.log(dosimTorax);
            for(var i = 0; i < dosimTorax.length; i++){
                var values = dosimTorax[i].value;
                if(values == ''){
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
                                title:"ALGUNOS DOSÍMETROS DE CONTROL TÓRAX SELECCIONADOS SE ENCUENTRAN REPETIDOS CON LOS DOSÍMETROS DE UBICACIÓN TÓRAX",
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
                                title:"ALGUNOS DOSÍMETROS DE CONTROL ANILLO SELECCIONADOS SE ENCUENTRAN REPETIDOS CON LOS DOSIMETROS DE UBICACIÓN CRISTALINO",
                                text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN CORRECTAMENTE",
                                icon: 'error'
                            });
                    }
                }
            };
            var dosimMuneca = document.querySelectorAll('select[name="id_dosimetro_asigdosimMuneca[]"]');
            console.log("ESTAS SON LOS DOSIMETROS MUÑECA");
            console.log(dosimMuneca);
            for(var i = 0; i < dosimMuneca.length; i++){
                var values = dosimMuneca[i].value;
                if(values == ''){
                    return Swal.fire({
                                title:"FALTA SELECCIONAR EL DOSÍMETRO PARA UNO DE UBICACIÓN MUÑECA",
                                text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN DESEADA",
                                icon: 'error'
                            });
                    
                };
                for(var x = 0; x < dosimMuneca.length; x++){
                    var valuesX = dosimMuneca[x].value;
                    if(values == valuesX && i != x){
                        return Swal.fire({
                                title:"ALGUNOS DOSÍMETROS DE UBICACIÓN MUÑECA SELECCIONADOS SE ENCUENTRAN REPETIDOS",
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
                                title:"ALGUNOS DOSÍMETROS CUERPO ENTERO SE ENCUENTRAN REPETIDOS",
                                text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN CORRECTAMENTE",
                                icon: 'error'
                            }); 
                    }
                }
            };
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
            };
            /////////////////////VALIDACION PARA DOSIMETROS REPETIDOS ENTRE MUÑECA y (ANILLO, CRISTALINO) /////////////////
            var dosimMun = document.querySelectorAll('select[name="id_dosimetro_asigdosimMuneca[]"]');
            console.log("DOSIMETROS DE TIPO MUÑECA");
            console.log(dosimMun);
            for(var i = 0; i < dosimMun.length; i++){
                console.log("DOSIMETRO MUÑECA POSICION" +i);
                var valuesMun = dosimMun[i].value;
                console.log(valuesMun);
                var dosimAni = document.querySelectorAll('select[name="id_dosimetro_asigdosimDedo[]"]');
                console.log("DOSIMETROS DE TIPO ANILLO");
                console.log(dosimAni);
                for(var x = 0; x < dosimAni.length; x++){
                    console.log("DOSIMETRO ANILLO POSICION" +x);
                    var valuesAni = dosimAni[x].value;
                    console.log(valuesAni);
                    if(valuesMun == valuesAni){

                        return Swal.fire({
                                title:"ALGUNOS DOSÍMETROS EZCLIP SE ENCUENTRAN REPETIDOS",
                                text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN CORRECTAMENTE",
                                icon: 'error'
                            }); 
                    }
                }
            };
            for(var i = 0; i < dosimMun.length; i++){
                console.log("DOSIMETRO MUÑECA POSICION" +i);
                var valuesMun = dosimMun[i].value;
                console.log(valuesMun);
                var dosimCris = document.querySelectorAll('select[name="id_dosimetro_asigdosimCristalino[]"]');
                console.log("DOSIMETROS DE TIPO CRISTALINO");
                console.log(dosimCris);
                console.log("TAMAÑO DOSIMETRO CRISTALINO" +dosimCris.length)
                for(var x = 0; x < dosimCris.length; x++){
                    console.log("DOSIMETRO CRISTALINO POSICION" +x);
                    var valuesCris = dosimCris[x].value;
                    console.log(valuesCris);
                    if(valuesMun == valuesCris){
                        return Swal.fire({
                                title:"ALGUNOS DOSÍMETROS EZCLIP SE ENCUENTRAN REPETIDOS",
                                text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN CORRECTAMENTE",
                                icon: 'error'
                            });
                    }
                }
            };
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
            var holCristalino = document.querySelectorAll('select[name="id_holder_asigdosimCristalino[]"]');
            console.log("ESTAS SON LOS HOLDERS DE CRISTALINO");
            console.log(holCristalino);
            for(var i = 0; i < holCristalino.length; i++) {
                var values = holCristalino[i].value;
                if(values == ''){
                    /* alert("FALTA SELECCIONAR ALGUN HOLDER"); */
                    return Swal.fire({
                                title:"FALTA SELECCIONAR ALGÚN HOLDER PARA UN DOSIMETRO DE UBICACIÓN CRISTALINO",
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
            }; 
            var holAnillo = document.querySelectorAll('select[name="id_holder_asigdosimDedo[]"]');
            console.log("ESTAS SON LOS HOLDERS DE ANILLO");
            console.log(holAnillo);
            for(var i = 0; i < holAnillo.length; i++) {
                var values = holAnillo[i].value;
                if(values == ''){
                    /* alert("FALTA SELECCIONAR ALGUN HOLDER"); */
                    return Swal.fire({
                                title:"FALTA SELECCIONAR ALGÚN HOLDER PARA UN DOSÍMETRO DE UBICACIÓN ANILLO",
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
            var holMuneca = document.querySelectorAll('select[name="id_holder_asigdosimMuneca[]"]');
            console.log("ESTAS SON LOS HOLDERS DE ANILLO");
            console.log(holMuneca);
            for(var i = 0; i < holMuneca.length; i++) {
                var values = holMuneca[i].value;
                if(values == ''){
                    /* alert("FALTA SELECCIONAR ALGUN HOLDER"); */
                    return Swal.fire({
                                title:"FALTA SELECCIONAR ALGÚN HOLDER PARA UN DOSÍMETRO DE UBICACIÓN MUÑECA",
                                text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN DESEADA",
                                icon: 'error'
                            });
                };
                for(var x = 0; x < holMuneca.length; x++){
                    var valuesX = holMuneca[x].value;
                    if(values == valuesX && i != x){
                        return Swal.fire({
                                title:"ALGUNOS HOLDERS DE UBICACIÓN MUÑECA SELECCIONADOS SE ENCUENTRAN REPETIDOS",
                                text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN CORRECTAMENTE",
                                icon: 'error'
                            });
                    }
                }
            };  
            /////////////////////VALIDACION PARA LAS OCUPACIONES /////////////////
            var ocuControl = document.querySelectorAll('select[name="ocupacion_asigdosimControl[]"]');
            console.log("ESTAS SON LAS OCUPACIONES DE CONTROL");
            console.log(ocuControl);  
            for(var i = 0; i < ocuControl.length; i++) {
                var values = ocuControl[i].value;
                if(values == ''){
                    /* alert("FALTA SELECCIONAR ALGUN HOLDER"); */
                    return Swal.fire({
                                title:"FALTA SELECCIONAR LA OCUPACIÓN DEL DOSIMETRO CONTROL",
                                text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN DESEADA",
                                icon: 'error'
                            });
                }
            };
            var ocuArea = document.querySelectorAll('select[name="ocupacion_asigdosimArea[]"]');
            console.log("ESTAS SON LAS OCUPACIONES DE AREA");
            console.log(ocuArea);  
            for(var i = 0; i < ocuArea.length; i++) {
                var values = ocuArea[i].value;
                if(values == ''){
                    /* alert("FALTA SELECCIONAR ALGUN HOLDER"); */
                    return Swal.fire({
                                title:"FALTA SELECCIONAR ALGUNA OCUPACIÓN DE UN DOSÍMETRO CON UBICACIÓN ÁREA",
                                text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN DESEADA",
                                icon: 'error'
                            });
                }
            };
            var ocuCaso = document.querySelectorAll('select[name="ocupacion_asigdosimCaso[]"]');
            console.log("ESTAS SON LAS OCUPACIONES DE CASO");
            console.log(ocuCaso);  
            for(var i = 0; i < ocuCaso.length; i++) {
                var values = ocuCaso[i].value;
                if(values == ''){
                    /* alert("FALTA SELECCIONAR ALGUN HOLDER"); */
                    return Swal.fire({
                                title:"FALTA SELECCIONAR ALGUNA OCUPACIÓN DE UN DOSÍMETRO CON UBICACIÓN CASO",
                                text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN DESEADA",
                                icon: 'error'
                            });
                }
            };
            var ocuTorax = document.querySelectorAll('select[name="ocupacion_asigdosimTorax[]"]');
            console.log("ESTAS SON LAS OCUPACIONES DE TORAX");
            console.log(ocuTorax);  
            for(var i = 0; i < ocuTorax.length; i++) {
                var values = ocuTorax[i].value;
                if(values == ''){
                    /* alert("FALTA SELECCIONAR ALGUN HOLDER"); */
                    return Swal.fire({
                                title:"FALTA SELECCIONAR ALGUNA OCUPACIÓN DE UN DOSÍMETRO CON UBICACIÓN TÓRAX",
                                text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN DESEADA",
                                icon: 'error'
                            });
                }
            };
            var ocuCristalino = document.querySelectorAll('select[name="ocupacion_asigdosimCristalino[]"]');
            console.log("ESTAS SON LAS OCUPACIONES DE CRISTALINO");
            console.log(ocuCristalino);  
            for(var i = 0; i < ocuCristalino.length; i++) {
                var values = ocuCristalino[i].value;
                if(values == ''){
                    /* alert("FALTA SELECCIONAR ALGUN HOLDER"); */
                    return Swal.fire({
                                title:"FALTA SELECCIONAR ALGUNA OCUPACIÓN DE UN DOSÍMETRO CON UBICACIÓN CRISTALINO",
                                text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN DESEADA",
                                icon: 'error'
                            });
                }
            };
            var ocuMuneca = document.querySelectorAll('select[name="ocupacion_asigdosimMuneca[]"]');
            console.log("ESTAS SON LAS OCUPACIONES DE MUÑECA");
            console.log(ocuMuneca);  
            for(var i = 0; i < ocuMuneca.length; i++) {
                var values = ocuMuneca[i].value;
                if(values == ''){
                    /* alert("FALTA SELECCIONAR ALGUN HOLDER"); */
                    return Swal.fire({
                                title:"FALTA SELECCIONAR ALGUNA OCUPACIÓN DE UN DOSÍMETRO CON UBICACIÓN MUÑECA",
                                text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN DESEADA",
                                icon: 'error'
                            });
                }
            };
            var ocuAnillo = document.querySelectorAll('select[name="ocupacion_asigdosimDedo[]"]');
            console.log("ESTAS SON LAS OCUPACIONES DE ANILLO");
            console.log(ocuAnillo);  
            for(var i = 0; i < ocuAnillo.length; i++) {
                var values = ocuAnillo[i].value;
                if(values == ''){
                    /* alert("FALTA SELECCIONAR ALGUN HOLDER"); */
                    return Swal.fire({
                                title:"FALTA SELECCIONAR ALGUNA OCUPACIÓN DE UN DOSÍMETRO CON UBICACIÓN ANILLO",
                                text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN DESEADA",
                                icon: 'error'
                            });
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