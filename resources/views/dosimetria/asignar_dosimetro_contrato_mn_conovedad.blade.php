@extends('layouts.app')
@extends('layouts.plantillabase')
@section('contenido')
<a type="button" class="btn btn-circle colorQA ir-arriba">
    <svg xmlns="http://www.w3.org/2000/svg" width="27" height="27" fill="currentColor" class="bi bi-arrow-up mt-1" viewBox="0 0 16 16">
        <path fill-rule="evenodd" d="M8 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L7.5 2.707V14.5a.5.5 0 0 0 .5.5z"/>
    </svg>
</a>
<div class="row">
    <div class="col-md"></div>
    <div class="col-md-15">
        <div class="card text-dark bg-light">
            <br>
            <h2 class="text-center">ASIGNACIÓN DOSÍMETROS CON NOVEDAD</h2>
            <h3 class="text-center" id="nueva_empresaModalLabel"> <br><i>{{$contdosisededepto->contratodosimetriasede->sede->empresa->nombre_empresa}} - SEDE: {{$contdosisededepto->contratodosimetriasede->sede->nombre_sede}}</i> <br>
                ESP.: {{$contdosisededepto->departamentosede->departamento->nombre_departamento}} <br>
                PERÍODO {{$mesnumber}} ( <span id="mes{{$mesnumber}}"></span> ) 
            </h3>
            <form action="{{route('asignadosicontratomnNovedad.save', ['asigdosicont'=> $contdosisededepto->id_contdosisededepto, 'mesnumber'=>$mesnumber])}}" method="POST"  id="form-nueva-asignacion_mn_novedad" name="form-nueva-asignacion_mn_novedad" class="form-nueva-asignacion_mn m-4">
                @csrf
                <br>
                <div class="row g-2 mx-3">
                    <div class="col-md"></div>
                    <div class="col-md-6">    
                        <div class="table table-responsive">
                            <table class="table table-sm table-bordered">
                                <thead class="table-active">
                                    <tr class="text-center">
                                        <th colspan='10'>DOSíMETROS CONTRATADOS</th>
                                    </tr>
                                    <tr class="text-center">
                                        <th class="align-middle">TÓRAX</th>
                                        <th class="align-middle">CRISTALINO</th>
                                        <th class="align-middle">ANILLO</th>
                                        {{-- <th class="align-middle">MUÑECA</th> --}}
                                        <th class="align-middle">ÁREA</th>
                                        <th class="align-middle">CASO</th>
                                        @if($mescontdosisededepto->controlTransT_unicoCont != 'TRUE' && $mescontdosisededepto->controlTransC_unicoCont != 'TRUE' && $mescontdosisededepto->controlTransA_unicoCont != 'TRUE')
                                            <th class="align-middle">CONTROL TÓRAX</th>
                                            <th class="align-middle">CONTROL CRISTALINO</th>
                                            <th class="align-middle">CONTROL ANILLO</th>
                                        @endif
                                        <th class="align-middle">TOTAL</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center">{{$mescontdosisededepto->dosi_torax}}</td>
                                        <td class="text-center">{{$mescontdosisededepto->dosi_cristalino}}</td>
                                        <td class="text-center">{{$mescontdosisededepto->dosi_dedo}}</td>
                                        {{-- <td class="text-center">{{$mescontdosisededepto->dosi_muñeca}}</td> --}}
                                        <td class="text-center">{{$mescontdosisededepto->dosi_area}}</td>
                                        <td class="text-center">{{$mescontdosisededepto->dosi_caso}}</td>
                                        @if($mescontdosisededepto->controlTransT_unicoCont == 'TRUE' || $mescontdosisededepto->controlTransC_unicoCont == 'TRUE' || $mescontdosisededepto->controlTransA_unicoCont == 'TRUE')
                                            <td class="text-center">{{$mescontdosisededepto->dosi_torax + $mescontdosisededepto->dosi_cristalino + $mescontdosisededepto->dosi_dedo + $mescontdosisededepto->dosi_muñeca + $mescontdosisededepto->dosi_area + $mescontdosisededepto->dosi_caso}}</td>
                                        @else
                                            <td class="text-center">{{$mescontdosisededepto->dosi_control_torax}}</td>
                                            <td class="text-center">{{$mescontdosisededepto->dosi_control_cristalino}}</td>
                                            <td class="text-center">{{$mescontdosisededepto->dosi_control_dedo}}</td>
                                            <td class="text-center">{{$mescontdosisededepto->dosi_torax + $mescontdosisededepto->dosi_cristalino + $mescontdosisededepto->dosi_dedo + $mescontdosisededepto->dosi_muñeca + $mescontdosisededepto->dosi_area + $mescontdosisededepto->dosi_caso + $mescontdosisededepto->dosi_control_torax + $mescontdosisededepto->dosi_control_cristalino + $mescontdosisededepto->dosi_control_dedo}}</td>
                                        @endif
                                        {{-- <td class="text-center">{{$mescontdosisededepto->dosi_control_torax}}</td>
                                        <td class="text-center">{{$mescontdosisededepto->dosi_control_cristalino}}</td>
                                        <td class="text-center">{{$mescontdosisededepto->dosi_control_dedo}}</td> --}}
                                    </tr>
                                </tbody>
                                @if($mescontdosisededepto->controlTransT_unicoCont == 'TRUE' || $mescontdosisededepto->controlTransC_unicoCont == 'TRUE' || $mescontdosisededepto->controlTransA_unicoCont == 'TRUE')
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
                                        <td  colspan='2' >{{$mescontdosisededepto->controlTransT_unicoCont == 'TRUE' ? 1 : 0}}</td>
                                        <td  colspan='2' >{{$mescontdosisededepto->controlTransC_unicoCont == 'TRUE' ? 1 : 0}}</td>
                                        <td  colspan='2' >{{$mescontdosisededepto->controlTransA_unicoCont == 'TRUE' ? 1 : 0}}</td>   
                                    </tr>
                                </tfoot>
                            @endif
                            </table>
                            
                        </div>
                    </div>
                    <div class="col-md"></div>
                </div>
                <br>
                <div class="row g-2 mx-3">
                    <div class="col-md">
                        <div class="form-floating">
                            <input type="date" class="form-control" name="primerDia_asigdosim" id="primerDia_asigdosim" 
                            @if(!empty($asignacionesMes))
                                @foreach($asignacionesMes as $asigMes) value="{{$asigMes->primer_dia_uso}}" @break @endforeach
                            @else
                                @foreach($asignacionesAreaMes as $asigMes) value="{{$asigMes->primer_dia_uso}}" @break @endforeach
                            @endif>
                            <label for="floatingInputGrid">PRIMER DÍA</label>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-floating">
                            <input type="date" class="form-control " name="ultimoDia_asigdosim" id="ultimoDia_asigdosim" 
                            @if(!empty($asignacionesMes))
                                @foreach($asignacionesMes as $asigMes) value="{{$asigMes->ultimo_dia_uso}}" @break @endforeach
                            @else
                                @foreach($asignacionesAreaMes as $asigMes) value="{{$asigMes->ultimo_dia_uso}}" @break @endforeach
                            @endif>
                            <label for="floatingInputGrid">ULTIMO DÍA:</label>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-floating">
                            <input type="date" class="form-control" name="fecha_envio_dosim_asignado" id="fecha_envio_dosim_asignado" @foreach($asignacionesMes as $asigMes) value="{{$asigMes->fecha_dosim_enviado}}" @break @endforeach>
                            <label for="floatingInputGrid">FECHA ENVIO</label>
                            
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
                            <table  class="table table-bordered" id="tablaAsignacionDosimetrosmn">
                                <thead class="table-active text-center">
                                    <th style='width: 28.20%' >TRABAJADOR / ÁREA</th>
                                    <th style='width: 16.40%'>UBICACIÓN</th>
                                    <th style='width: 16.40%'>DOSÍMETRO</th>
                                    <th style='width: 16.40%'>HOLDER</th>
                                </thead>
                                <tbody>
                                    
                                    <input hidden name="mesNumber" id="mesNumber" value="{{$mesnumber}}">
                                    <input type="number" name="id_departamento_asigdosim" id="id_departamento_asigdosim" hidden value="{{$contdosisededepto->id_contdosisededepto}}">
                                    <input type="number" name="id_contrato_asigdosim_sede" id="id_contrato_asigdosim_sede" hidden value="{{$contdosisededepto->contratodosimetriasede_id}}">
                                    <input type="number" name="id_contrato_asigdosim" id="id_contrato_asigdosim" hidden value="{{$contdosisededepto->contratodosimetriasede->dosimetriacontrato->id_contratodosimetria}}">
                                    {{--///Filas creadas segun la cantidad de dosimetros tipo CONTROL asignados en UNA NOVEADAD DE NUEVOS DOSIMETROS PARA MES SIGUIENTE AL ACTUAL EN EL QUE FALTA ASOCIAR DOSIMETROS Y HOLDERS(este se convierte en actual)/////// --}}
                                    @foreach($dosicontrolToraxmesact as $dosicontrolTact)
                                        <tr>
                                            <input type="number" name="id_asigdosimControlTorax[]" id="id_asigdosimControlTorax" value="{{$dosicontrolTact->id_dosicontrolcontdosisedes}}" hidden >
                                            <td colspan='2' class='align-middle text-center'>CONTROL TÓRAX</td>
                                            <td class='align-middle'>
                                                <select class="form-select id_dosimetro_asigdosimControlTorax"  name="id_dosimetro_asigdosimControlTorax[]" id="id_dosimetro_asigdosimControlTorax" >
                                                    <option value="@if($dosicontrolTact->dosimetro_id != NULL){{$dosicontrolTact->dosimetro_id}}@endif">@if($dosicontrolTact->dosimetro_id == NULL) -- @else --{{$dosicontrolTact->dosimetro->codigo_dosimeter}}-- @endif</option>
                                                    @foreach($dosimLibresGeneral as $dosigenlib)
                                                        <option value="{{$dosigenlib->id_dosimetro}}">{{$dosigenlib->codigo_dosimeter}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td class='align-middle text-center'>N.A.</td>
                                        </tr>
                                    @endforeach
                                    @foreach($dosicontrolCristalinomesact as $dosicontrolCact)
                                        <tr>
                                            <input type="number" name="id_asigdosimControlCristalino[]" id="id_asigdosimControlCristalino" value="{{$dosicontrolCact->id_dosicontrolcontdosisedes}}" hidden >
                                            <td colspan='2' class='align-middle text-center'>CONTROL CRISTALINO</td>
                                            <td class='align-middle'>
                                                <select class="form-select id_dosimetro_asigdosimControlCristalino"  name="id_dosimetro_asigdosimControlCristalino[]" id="id_dosimetro_asigdosimControlCristalino" >
                                                    <option value="@if($dosicontrolCact->dosimetro_id != NULL){{$dosicontrolCact->dosimetro_id}}@endif">@if($dosicontrolCact->dosimetro_id == NULL) -- @else --{{$dosicontrolCact->dosimetro->codigo_dosimeter}}-- @endif</option>
                                                    @foreach($dosimLibresEzclip as $dosiEzlib)
                                                        <option value="{{$dosiEzlib->id_dosimetro}}">{{$dosiEzlib->codigo_dosimeter}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td class='align-middle'>
                                                <select class="form-select id_holder_asigdosimControlCristalino"  name="id_holder_asigdosimControlCristalino[]" id="id_holder_asigdosimControlCristalino" >
                                                    <option value="@if($dosicontrolCact->holder_id != NULL){{$dosicontrolCact->holder_id}}@endif">@if($dosicontrolCact->holder_id == NULL) -- @else --{{$dosicontrolCact->holder->codigo_holder}}-- @endif</option>
                                                    @foreach($holderLibresCristalino as $holLibC)
                                                        <option value="{{$holLibC->id_holder}}">{{$holLibC->codigo_holder}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                        </tr>
                                    @endforeach
                                    @foreach($dosicontrolDedomesact as $dosicontrolAact)
                                        <tr>
                                            <input type="number" name="id_asigdosimControlDedo[]" id="id_asigdosimControlDedo" value="{{$dosicontrolAact->id_dosicontrolcontdosisedes}}" hidden >
                                            <td colspan='2' class='align-middle text-center'>CONTROL ANILLO</td>
                                            <td class='align-middle'>
                                                <select class="form-select id_dosimetro_asigdosimControlDedo"  name="id_dosimetro_asigdosimControlDedo[]" id="id_dosimetro_asigdosimControlDedo" >
                                                    <option value="@if($dosicontrolAact->dosimetro_id != NULL){{$dosicontrolAact->dosimetro_id}}@endif">@if($dosicontrolAact->dosimetro_id == NULL) -- @else --{{$dosicontrolAact->dosimetro->codigo_dosimeter}}-- @endif</option>
                                                    @foreach($dosimLibresEzclip as $dosiEzlib)
                                                        <option value="{{$dosiEzlib->id_dosimetro}}">{{$dosiEzlib->codigo_dosimeter}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td class='align-middle'>
                                                <select class="form-select id_holder_asigdosimControlDedo"  name="id_holder_asigdosimControlDedo[]" id="id_holder_asigdosimControlDedo" >
                                                    <option value="@if($dosicontrolAact->holder_id != NULL){{$dosicontrolAact->holder_id}}@endif">@if($dosicontrolAact->holder_id == NULL) -- @else --{{$dosicontrolAact->holder->codigo_holder}}-- @endif</option>
                                                    @foreach($holderLibresAnillo as $holLibA)
                                                        <option value="{{$holLibA->id_holder}}">{{$holLibA->codigo_holder}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                        </tr>
                                    @endforeach
                                    
                                    @if(!empty($dosicontrolToraxUnicomesact[0]) && $dosicontrolToraxUnicomesact[0]->controlTransT_unicoCont == 'TRUE')
                                        <tr>
                                            <input type="number" name="id_asigdosimControlUnicoT[]" id="id_asigdosimControlUnicoT" value="{{$dosicontrolToraxUnicomesact[0]->id_dosicontrolcontdosisedes}}" hidden >
                                            <td colspan='2' class='align-middle text-center'>CONTROL TRANS. T.</td>
                                            <td class='align-middle'>
                                                <select class="form-select id_dosimetro_ControlToraxUnico"  name="id_dosimetro_ControlToraxUnico" id="id_dosimetro_ControlToraxUnico" @if($dosicontrolToraxUnicomesact[0]->dosimetro_uso != 'FALSE' && $dosicontrolToraxUnicomesact[0]->dosimetro_id != NULL){ disabled } @endif>
                                                    <option value="@if($dosicontrolToraxUnicomesact[0]->dosimetro_id != NULL){{$dosicontrolToraxUnicomesact[0]->dosimetro_id}}@endif">@if($dosicontrolToraxUnicomesact[0]->dosimetro_id == NULL) -- @else --{{$dosicontrolToraxUnicomesact[0]->dosimetro->codigo_dosimeter}}-- @endif</option>
                                                    @foreach($dosimLibresGeneral as $dosigenlib)
                                                        <option value="{{$dosigenlib->id_dosimetro}}">{{$dosigenlib->codigo_dosimeter}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td class='align-middle text-center'>N.A.</td>
                                        </tr>
                                    @endif
                                    
                                    @if(!empty($dosicontrolCristalinoUnicomesact[0]) && $dosicontrolCristalinoUnicomesact[0]->controlTransC_unicoCont == 'TRUE')
                                        <tr>
                                            <input type="number" name="id_asigdosimControlUnicoC[]" id="id_asigdosimControlUnicoC" value="{{$dosicontrolCristalinoUnicomesact[0]->id_dosicontrolcontdosisedes}}" hidden >
                                            <td colspan='2' class='align-middle text-center'>CONTROL TRANS. C.</td>
                                            <td class='align-middle'>
                                                <select class="form-select id_dosimetro_ControlCristalinoUnico"  name="id_dosimetro_ControlCristalinoUnico" id="id_dosimetro_ControlCristalinoUnico"  @if($dosicontrolCristalinoUnicomesact[0]->dosimetro_uso != 'FALSE' && $dosicontrolCristalinoUnicomesact[0]->dosimetro_id != NULL) { disabled } @endif>
                                                    <option value="@if($dosicontrolCristalinoUnicomesact[0]->dosimetro_id != NULL){{$dosicontrolCristalinoUnicomesact[0]->dosimetro_id}}@endif">@if($dosicontrolCristalinoUnicomesact[0]->dosimetro_id == NULL) -- @else --{{$dosicontrolCristalinoUnicomesact[0]->dosimetro->codigo_dosimeter}}-- @endif</option>
                                                    @foreach($dosimLibresEzclip as $dosiEzlib)
                                                        <option value="{{$dosiEzlib->id_dosimetro}}">{{$dosiEzlib->codigo_dosimeter}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td class='align-middle'>
                                                <select class="form-select id_holder_ControlCristalinoUnico"  name="id_holder_ControlCristalinoUnico[]" id="id_holder_ControlCristalinoUnico" @if($dosicontrolCristalinoUnicomesact[0]->dosimetro_uso != 'FALSE' && $dosicontrolCristalinoUnicomesact[0]->holder_id != NULL) { disabled } @endif>
                                                    <option value="@if($dosicontrolCristalinoUnicomesact[0]->holder_id != NULL){{$dosicontrolCristalinoUnicomesact[0]->holder_id}}@endif">@if($dosicontrolCristalinoUnicomesact[0]->holder_id == NULL) -- @else --{{$dosicontrolCristalinoUnicomesact[0]->holder->codigo_holder}}-- @endif</option>
                                                    @foreach($holderLibresAnillo as $holLibA)
                                                        <option value="{{$holLibA->id_holder}}">{{$holLibA->codigo_holder}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                        </tr>
                                    @endif
                                    
                                    @if(!empty($dosicontrolDedoUnicomesact[0]) && $dosicontrolDedoUnicomesact[0]->controlTransA_unicoCont == 'TRUE')
                                        <tr>
                                            <input type="number" name="id_asigdosimControlUnicoA[]" id="id_asigdosimControlUnicoA" value="{{$dosicontrolDedoUnicomesact[0]->id_dosicontrolcontdosisedes}}" hidden >
                                            <td colspan='2' class='align-middle text-center'>CONTROL TRANS. A.</td>
                                            <td class='align-middle'>
                                                <select class="form-select id_dosimetro_ControlDedoUnico"  name="id_dosimetro_ControlDedoUnico" id="id_dosimetro_ControlDedoUnico" @if($dosicontrolDedoUnicomesact[0]->dosimetro_uso != 'FALSE' && $dosicontrolDedoUnicomesact[0]->dosimetro_id != NULL) { disabled }  @endif>
                                                    <option value="@if($dosicontrolDedoUnicomesact[0]->dosimetro_id != NULL){{$dosicontrolDedoUnicomesact[0]->dosimetro_id}}@endif">@if($dosicontrolDedoUnicomesact[0]->dosimetro_id == NULL) -- @else --{{$dosicontrolDedoUnicomesact[0]->dosimetro->codigo_dosimeter}}-- @endif</option>
                                                    @foreach($dosimLibresEzclip as $dosiEzlib)
                                                        <option value="{{$dosiEzlib->id_dosimetro}}">{{$dosiEzlib->codigo_dosimeter}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td class='align-middle'>
                                                <select class="form-select id_holder_ControlDedoUnico"  name="id_holder_ControlDedoUnico[]" id="id_holder_ControlDedoUnico" @if($dosicontrolDedoUnicomesact[0]->dosimetro_uso != 'FALSE' && $dosicontrolDedoUnicomesact[0]->holder_id != NULL) { disabled }  @endif>
                                                    <option value="@if($dosicontrolDedoUnicomesact[0]->holder_id != NULL){{$dosicontrolDedoUnicomesact[0]->holder_id}}@endif">@if($dosicontrolDedoUnicomesact[0]->holder_id == NULL) -- @else --{{$dosicontrolDedoUnicomesact[0]->holder->codigo_holder}}-- @endif</option>
                                                    @foreach($holderLibresAnillo as $holLibA)
                                                        <option value="{{$holLibA->id_holder}}">{{$holLibA->codigo_holder}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                        </tr>
                                    @endif
                                    {{--///Filas creadas segun la cantidad de dosimetros tipo AREA asignados en UNA NOVEADAD DE NUEVOS DOSIMETROS PARA MES SIGUIENTE AL ACTUAL EN EL QUE FALTA ASOCIAR DOSIMETROS Y HOLDERS (este se convierte en actual)/////// --}}
                                    @foreach($dosiareamesact as $dosiareact)
                                        <tr>
                                            <td class='align-middle text-center'>
                                                <input type="number" name="id_dosiareaAsig[]" id="id_dosiareaAsig" value="{{$dosiareact->id_dosiareacontdosisedes}}" hidden >
                                                <select class="form-select id_area_asigdosimArea"  name="id_area_asigdosimArea[]" id="id_area_asigdosimArea{{$dosiareact->areadepartamentosede_id}}" disabled>
                                                    <option value="{{$dosiareact->areadepartamentosede_id}}">{{$dosiareact->areadepartamentosede->nombre_area}}</option>
                                                    @foreach($areaSede as $area)
                                                        @if($area->id_areadepartamentosede != $dosiareact->areadepartamentosede_id)
                                                            <option  value ="{{$area->id_areadepartamentosede}}">{{$area->nombre_area}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td class='align-middle text-center'>ÁREA</td>
                                            <td class='align-middle'>
                                                <select class="form-select id_dosimetro_asigdosimArea"  name="id_dosimetro_asigdosimArea[]" id="id_dosimetro_asigdosimArea">
                                                    <option value="@if($dosiareact->dosimetro_id != NULL){{$dosiareact->dosimetro_id}}@endif">@if($dosiareact->dosimetro_id == NULL)-- @else--{{$dosiareact->dosimetro->codigo_dosimeter}}--@endif</option>
                                                    @foreach($dosimLibresGeneral as $dosigenlib)
                                                        <option value="{{$dosigenlib->id_dosimetro}}">{{$dosigenlib->codigo_dosimeter}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td class='align-middle text-center'>N.A</td>
                                        </tr>
                                    @endforeach
                                    {{--///Filas creadas segun la cantidad de dosimetros tipo CASO asignados en UNA NOVEADAD DE NUEVOS DOSIMETROS PARA MES SIGUIENTE AL ACTUAL EN EL QUE FALTA ASOCIAR DOSIMETROS Y HOLDERS (este se convierte en actual)/////// --}}
                                    @foreach($dosicasomesact as $dosicasoact)
                                        <tr>
                                            <td class='align-middle text-center'>
                                                <input type="number" name="id_asigdosimCaso[]" id="id_asigdosimCaso" value="{{$dosicasoact->id_trabajadordosimetro}}" hidden>
                                                <select class="form-select"  name="id_trabajador_asigdosimCaso[]" id="id_trabajador_asigdosimCaso{{$dosicasoact->persona_id}}" disabled>
                                                    <option value="{{$dosicasoact->persona_id}}"> {{$dosicasoant->persona->primer_nombre_persona}} {{$dosicasoant->persona->segundo_nombre_persona}} {{$dosicasoant->persona->primer_apellido_persona}} {{$dosicasoant->persona->segundo_apellido_persona}}</option>
                                                    
                                                </select>
                                            </td>
                                            <td class='align-middle text-center'>CASO</td>
                                            <td class='align-middle'>
                                                <select class="form-select"  name="id_dosimetro_asigdosimCaso[]" id="id_dosimetro_asigdosimCaso">
                                                    <option value="@if($dosicasoact->dosimetro_id != NULL){{$dosicasoact->dosimetro_id}} @endif">@if($dosicasoact->dosimetro_id == NULL) -- @else--{{$dosicasoact->dosimetro->codigo_dosimeter}}--@endif</option>
                                                    @foreach($dosimLibresGeneral as $dosigenlib)
                                                        <option value="{{$dosigenlib->id_dosimetro}}">{{$dosigenlib->codigo_dosimeter}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td class='align-middle text-center'>N.A</td>
                                        </tr>   
                                    @endforeach
                                    {{--///Filas creadas segun la cantidad de dosimetros tipo TORAX asignados en UNA NOVEADAD DE NUEVOS DOSIMETROS PARA MES SIGUIENTE AL ACTUAL EN EL QUE FALTA ASOCIAR DOSIMETROS Y HOLDERS (este se convierte en actual)/////// --}}
                                    @foreach($dositoraxmesact as $dositoraxact)
                                        <tr>
                                            <td class='align-middle text-center'>
                                                <input type="number" name="id_asigdosimTorax[]" id="id_asigdosimTorax" value="{{$dositoraxact->id_trabajadordosimetro}}" hidden>
                                                <select class="form-select"  name="id_trabajador_asigdosimTorax[]" id="id_trabajador_asigdosimTorax{{$dositoraxact->persona_id}}" disabled>
                                                    <option value="{{$dositoraxact->persona_id}}">{{$dositoraxact->persona->primer_nombre_persona}} {{$dositoraxact->persona->segundo_nombre_persona}} {{$dositoraxact->persona->primer_apellido_persona}} {{$dositoraxact->persona->segundo_apellido_persona}}</option>
                                                    
                                                </select>
                                            </td>
                                            <td class='align-middle text-center'>TÓRAX</td>
                                            <td class='align-middle'>
                                                <select class="form-select"  name="id_dosimetro_asigdosimTorax[]" id="id_dosimetro_asigdosimTorax" >
                                                    <option value="@if($dositoraxact->dosimetro_id != NULL){{$dositoraxact->dosimetro_id}} @endif">@if($dositoraxact->dosimetro_id == NULL)--@else --{{$dositoraxact->dosimetro->codigo_dosimeter}}--@endif</option>
                                                    @foreach($dosimLibresGeneral as $dosigenlib)
                                                        <option value="{{$dosigenlib->id_dosimetro}}">{{$dosigenlib->codigo_dosimeter}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td class='align-middle text-center'>N.A</td>
                                        </tr>
                                    @endforeach
                                    {{--///Filas creadas segun la cantidad de dosimetros tipo CRISTALINO asignados en UNA NOVEADAD DE NUEVOS DOSIMETROS PARA MES SIGUIENTE AL ACTUAL EN EL QUE FALTA ASOCIAR DOSIMETROS Y HOLDERS (este se convierte en actual)/////// --}}
                                    @foreach($dosicristalinomesact as $dosicristalinoact)
                                        <tr>
                                            <td class='align-middle text-center'>
                                                <input type="number" name="id_asigdosimCristalino[]" id="id_asigdosimCristalino" value="{{$dosicristalinoact->id_trabajadordosimetro}}" hidden>
                                                <select class="form-select"  name="id_trabajador_asigdosimCristalino[]" id="id_trabajador_asigdosimCristalino{{$dosicristalinoact->persona_id}}" disabled>
                                                    <option value="{{$dosicristalinoact->persona_id}}">{{$dosicristalinoact->persona->primer_nombre_persona}} {{$dosicristalinoact->persona->segundo_nombre_persona}} {{$dosicristalinoact->persona->primer_apellido_persona}} {{$dosicristalinoact->persona->segundo_apellido_persona}}</option>
                                                    
                                                </select>
                                            </td>
                                            <td class='align-middle text-center'>CRISTALINO</td>
                                            <td class='align-middle'>
                                                <select class="form-select"  name="id_dosimetro_asigdosimCristalino[]" id="id_dosimetro_asigdosimCristalino">
                                                    <option value="@if($dosicristalinoact->dosimetro_id != NULL){{$dosicristalinoact->dosimetro_id}}@endif">@if($dosicristalinoact->dosimetro_id == NULL)--@else--{{$dosicristalinoact->dosimetro->codigo_dosimeter}}--@endif</option>
                                                    @foreach($dosimLibresEzclip as $dosiezcliplib)
                                                        <option value="{{$dosiezcliplib->id_dosimetro}}">{{$dosiezcliplib->codigo_dosimeter}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td class='align-middle'>
                                                <select class="form-select"  name="id_holder_asigdosimCristalino[]" id="id_holder_asigdosimCristalino" >
                                                    <option value="@if($dosicristalinoact->holder_id != NULL){{$dosicristalinoact->holder_id}}@endif">@if($dosicristalinoact->holder_id == NULL)--@else--{{$dosicristalinoact->holder->codigo_holder}}--@endif</option>
                                                    @foreach($holderLibresCristalino as $holibcris)
                                                        <option value="{{$holibcris->id_holder}}">{{$holibcris->codigo_holder}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                        </tr>
                                    @endforeach
                                    
                                    {{--///Filas creadas segun la cantidad de dosimetros tipo DEDO asignados en UNA NOVEADAD DE NUEVOS DOSIMETROS PARA MES SIGUIENTE AL ACTUAL EN EL QUE FALTA ASOCIAR DOSIMETROS Y HOLDERS (este se convierte en actual)/////// --}}
                                    @foreach($dosidedomesact as $dosidedoact)
                                        <tr>
                                            <td class='align-middle text-center'>
                                                <input type="number" name="id_asigdosimDedo[]" id="id_asigdosimDedo" value="{{$dosidedoact->id_trabajadordosimetro}}" hidden>
                                                <select class="form-select"  name="id_trabajador_asigdosimDedo[]" id="id_trabajador_asigdosimDedo{{$dosidedoact->persona_id}}" disabled>
                                                    <option value="{{$dosidedoact->persona_id}}">{{$dosidedoact->persona->primer_nombre_persona}} {{$dosidedoact->persona->segundo_nombre_persona}} {{$dosidedoact->persona->primer_apellido_persona}} {{$dosidedoact->persona->segundo_apellido_persona}}</option>
                                                    
                                                </select>
                                            </td>
                                            <td class='align-middle text-center'>ANILLO</td>
                                            <td class='align-middle'>
                                                <select class="form-select"  name="id_dosimetro_asigdosimDedo[]" id="id_dosimetro_asigdosimDedo"  >
                                                    <option value="@if($dosidedoact->dosimetro_id != NULL){{$dosidedoact->dosimetro_id}}@endif">@if($dosidedoact->dosimetro_id == NULL)-- @else--{{$dosidedoact->dosimetro->codigo_dosimeter}}--@endif</option>
                                                    @foreach($dosimLibresEzclip as $dosiezcliplib)
                                                        <option value="{{$dosiezcliplib->id_dosimetro}}">{{$dosiezcliplib->codigo_dosimeter}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td class='align-middle'>
                                                <select class="form-select"  name="id_holder_asigdosimDedo[]" id="id_holder_asigdosimDedo">
                                                    <option value="@if($dosidedoact->holder_id != NULL){{$dosidedoact->holder_id}}@endif">@if($dosidedoact->holder_id == NULL )--@else--{{$dosidedoact->holder->codigo_holder}}--@endif</option>
                                                    @foreach($holderLibresAnillo as $holibanillo)
                                                        <option value="{{$holibanillo->id_holder}}">{{$holibanillo->codigo_holder}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                        </tr>
                                    @endforeach
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
            </form>
                    {{-- <div class="col">
                        <div class="d-grid gap-2 col-6 mx-auto">
                            <a href="{{route('asignadosicontratomn.clear',['asigdosicont' => $contdosisededepto->id_contdosisededepto, 'mesnumber' => $mesnumber] )}}" class="btn btn-primary limpiar_asig"  type="button" id="limpiar_asig" name="limpiar_asig" role="button">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                    <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                                </svg> <br> LIMPIAR ASIGNACIONES
                            </a>
                        </div>
                    </div> --}}
            
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
    $(document).ready(function(){
         // Creamos array con los meses del año
        const meses = ['ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO', 'JULIO', 'AGOSTO', 'SEPTIEMBRE', 'OCTUBRE', 'NOVIEMBRE', 'DICIEMBRE'];
        let fecha = new Date("{{$contdosisededepto->contratodosimetriasede->dosimetriacontrato->fecha_inicio}}, 00:00:00");
        console.log(fecha);
        var numLec = '{{$contdosisededepto->contratodosimetriasede->dosimetriacontrato->numlecturas_año}}';
        if('{{$contdosisededepto->contratodosimetriasede->dosimetriacontrato->periodo_recambio}}' == 'MENS'){
            var xx = 1; 
            for(var i=0; i<=(numLec-2); i++){
                /* console.log("esta es la i="+i); */
                var ultimoDiaPM = new Date(fecha.getFullYear(), fecha.getMonth() + 1, 1);
                console.log("ULTIMO DIA PRIMER MES:"+ ultimoDiaPM);
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
                        var r1mes = r.getMonth()+1; //obteniendo mes del primer dia del periodo
                        var r1dia = r.getDate(); //obteniendo dia del primer dia del periodo
                        var r1ano = r.getFullYear(); //obteniendo año del primer dia del periodo
                        if(r1dia<10){
                            r1dia ='0'+r1dia; //agrega cero si el menor de 10 del primer dia del periodo
                        }
                        if(r1mes<10){
                            r1mes='0'+r1mes //agrega cero si el menor de 10 del primer dia del periodo
                        }
                        document.getElementById("primerDia_asigdosim").value = r1ano+"-"+r1mes+"-"+r1dia;
                        //////////
                        var r2mes = r2final.getMonth()+1; //obteniendo mes del ultimo dia del periodo
                        var r2dia = r2final.getDate(); //obteniendo dia del ultimo dia del periodo
                        var r2ano = r2final.getFullYear(); //obteniendo año del ultimo dia del periodo
                        if(r2dia<10){
                            r2dia ='0'+r2dia; //agrega cero si el menor de 10 del ultimo dia del periodo
                        }
                        if(r2mes<10){
                            r2mes='0'+r2mes //agrega cero si el menor de 10 del ultimo dia del periodo
                        }
                        document.getElementById("ultimoDia_asigdosim").value = r2ano+"-"+r2mes+"-"+r2dia;
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
                console.log("XX"+xx);
                
                if("{{$mesnumber}}" == xx){
                    document.getElementById('mes{{$mesnumber}}').innerHTML = fechaesp1+' - '+fechaesp2;
                    var r1mes = r.getMonth()+1; //obteniendo mes del primer dia del periodo
                    var r1dia = r.getDate(); //obteniendo dia del primer dia del periodo
                    var r1ano = r.getFullYear(); //obteniendo año del primer dia del periodo
                    if(r1dia<10){
                        r1dia ='0'+r1dia; //agrega cero si el menor de 10 del primer dia del periodo
                    }
                    if(r1mes<10){
                        r1mes='0'+r1mes //agrega cero si el menor de 10 del primer dia del periodo
                    }
                    document.getElementById("primerDia_asigdosim").value = r1ano+"-"+r1mes+"-"+r1dia;
                    //////////
                    var r2mes = r2final.getMonth()+1; //obteniendo mes del ultimo dia del periodo
                    var r2dia = r2final.getDate(); //obteniendo dia del ultimo dia del periodo
                    var r2ano = r2final.getFullYear(); //obteniendo año del ultimo dia del periodo
                    if(r2dia<10){
                        r2dia ='0'+r2dia; //agrega cero si el menor de 10 del ultimo dia del periodo
                    }
                    if(r2mes<10){
                        r2mes='0'+r2mes //agrega cero si el menor de 10 del ultimo dia del periodo
                    }
                    document.getElementById("ultimoDia_asigdosim").value = r2ano+"-"+r2mes+"-"+r2dia;
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
                    var r1mes = r.getMonth()+1; //obteniendo mes del primer dia del periodo
                    var r1dia = r.getDate(); //obteniendo dia del primer dia del periodo
                    var r1ano = r.getFullYear(); //obteniendo año del primer dia del periodo
                    if(r1dia<10){
                        r1dia ='0'+r1dia; //agrega cero si el menor de 10 del primer dia del periodo
                    }
                    if(r1mes<10){
                        r1mes='0'+r1mes //agrega cero si el menor de 10 del primer dia del periodo
                    }
                    document.getElementById("primerDia_asigdosim").value = r1ano+"-"+r1mes+"-"+r1dia;
                    //////////
                    var r2mes = r2final.getMonth()+1; //obteniendo mes del ultimo dia del periodo
                    var r2dia = r2final.getDate(); //obteniendo dia del ultimo dia del periodo
                    var r2ano = r2final.getFullYear(); //obteniendo año del ultimo dia del periodo
                    if(r2dia<10){
                        r2dia ='0'+r2dia; //agrega cero si el menor de 10 del ultimo dia del periodo
                    }
                    if(r2mes<10){
                        r2mes='0'+r2mes //agrega cero si el menor de 10 del ultimo dia del periodo
                    }
                    document.getElementById("ultimoDia_asigdosim").value = r2ano+"-"+r2mes+"-"+r2dia;
                }
                
            }
        };

        $('.ir-arriba').click(function(){
            $('body, html').animate({
                scrollTop: '0px'
            }, 300);
        });
    
        $(window).scroll(function(){
            if( $(this).scrollTop() > 0 ){
                $('.ir-arriba').slideDown(300);
            } else {
                $('.ir-arriba').slideUp(300);
            }
        });

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
        /* var holder_muñeca = document.querySelectorAll('select[name="id_holder_asigdosimMuneca[]"');
        for(var i = 0; i < holder_muñeca.length; i++){
            holder_muñeca[i].setAttribute("id", "id_holder_asigdosimMuneca"+[i]);
            $('#id_holder_asigdosimMuneca'+[i]).select2({width: "100%",});
        } */
        var holder_dedo = document.querySelectorAll('select[name="id_holder_asigdosimDedo[]"');
        for(var i = 0; i < holder_dedo.length; i++){
            holder_dedo[i].setAttribute("id", "id_holder_asigdosimDedo"+[i]);
            $('#id_holder_asigdosimDedo'+[i]).select2({width: "100%",});
        }   
    });

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
             /////////////////////VALIDACION PARA LOS DOSIMETROS CONTROL /////////////////
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
                for(var x = 0; x < dosimControlCristalino.length; x++){
                    var valuesX = dosimControlCristalino[x].value;
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
            /////VALIDACION DOSIMETROS CONTROL TRANSPORTE UNICO//////
            var dosimControlUniTorax = document.querySelectorAll('select[name="id_dosimetro_ControlToraxUnico"]');
            console.log("ESTAS SON LOS  DOSIM CONTROL TORAX UNICOS");
            console.log(dosimControlUniTorax);
            for(var i = 0; i < dosimControlUniTorax.length; i++){
                var values = dosimControlUniTorax[i].value;
                if(values == ''){
                    return Swal.fire({
                                title:"FALTA SELECCIONAR EL DOSÍMETRO DE TIPO CONTROL TRANSPORTE TÓRAX",
                                text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN DESEADA",
                                icon: 'error'
                            });
                    
                };
            };
            var dosimControlUniCristalino = document.querySelectorAll('select[name="id_dosimetro_ControlCristalinoUnico"]');
            console.log("ESTAS SON LOS  DOSIM CONTROL CRISTALINO UNICOS");
            console.log(dosimControlUniCristalino);
            for(var i = 0; i < dosimControlUniCristalino.length; i++){
                var values = dosimControlUniCristalino[i].value;
                if(values == ''){
                    return Swal.fire({
                                title:"FALTA SELECCIONAR EL DOSÍMETRO DE TIPO CONTROL TRANSPORTE CRISTALINO",
                                text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN DESEADA",
                                icon: 'error'
                            });
                    
                };
            };
            var dosimControlUniAnillo = document.querySelectorAll('select[name="id_dosimetro_ControlDedoUnico"]');
            console.log("ESTAS SON LOS  DOSIM CONTROL ANILLO UNICOS");
            console.log(dosimControlUniAnillo);
            for(var i = 0; i < dosimControlUniAnillo.length; i++){
                var values = dosimControlUniAnillo[i].value;
                if(values == ''){
                    return Swal.fire({
                                title:"FALTA SELECCIONAR EL DOSÍMETRO DE TIPO CONTROL TRANSPORTE ANILLO",
                                text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN DESEADA",
                                icon: 'error'
                            });
                    
                };
                for(var y = 0; y < dosimControlUniCristalino.length; y++){
                    var valuesCrist = dosimControlUniCristalino[y].value;
                    if(values == valuesCrist){
                        return Swal.fire({
                                title:"ALGUNOS DOSÍMETROS DE CONTROL TRANSPORTE ANILLO SELECCIONADOS SE ENCUENTRAN REPETIDOS CON LOS DOSÍMETROS DE CONTROL TRANSPORTE CRISTALINO ",
                                text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN CORRECTAMENTE",
                                icon: 'error'
                            });
                    }
                }
            };
            for(var i = 0; i < dosimControlUniCristalino.length; i++){
                var values = dosimControlUniCristalino[i].value;
                for(var y = 0; y < dosimControlUniAnillo.length; y++){
                    var valuesDedo = dosimControlUniAnillo[y].value;
                    if(values == valuesDedo){
                        return Swal.fire({
                                title:"ALGUNOS DOSÍMETROS DE CONTROL TRANSPORTE CRISTALINO SELECCIONADOS SE ENCUENTRAN REPETIDOS CON LOS DOSIMETROS DE UBICACIÓN CONTROL TRANSPORTE ANILLO",
                                text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN CORRECTAMENTE",
                                icon: 'error'
                            });
                    }
                }
            };
            for(var i = 0; i < dosimControlUniAnillo.length; i++){
                var values = dosimControlUniAnillo[i].value;
                for(var y = 0; y < dosimControlUniCristalino.length; y++){
                    var valuesCrist = dosimControlUniCristalino[y].value;
                    if(values == valuesCrist){
                        return Swal.fire({
                                title:"ALGUNOS DOSÍMETROS DE CONTROL TRANSPORTE ANILLO SELECCIONADOS SE ENCUENTRAN REPETIDOS CON LOS DOSÍMETROS DE UBICACIÓN CONTROL TRANSPORTE CRISTALINO",
                                text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN CORRECTAMENTE",
                                icon: 'error'
                            });
                    }
                }
            };
            
            /////////////////////VALIDACION PARA LOS DOSIMETROS /////////////////
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
                for(var x = 0; x < dosimControlUniTorax.length; x++){
                    var valuesX = dosimControlUniTorax[x].value;
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
                for(var x = 0; x < dosimControlUniTorax.length; x++){
                    var valuesX = dosimControlUniTorax[x].value;
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
                for(var y = 0; y < dosimControlUniTorax.length; y++){
                    var valuesTorax = dosimControlUniTorax[y].value;
                    if(values == valuesTorax){
                        return Swal.fire({
                                title:"ALGUNOS DOSÍMETROS DE CONTROL TRANSPORTE TÓRAX SELECCIONADOS SE ENCUENTRAN REPETIDOS CON LOS DOSÍMETROS DE UBICACIÓN TÓRAX",
                                text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN CORRECTAMENTE",
                                icon: 'error'
                            });
                    }
                }
                for(var y = 0; y < dosimArea.length; y++){
                    var valuesArea = dosimArea[y].value;
                    if(values == valuesArea){
                        return Swal.fire({
                                title:"ALGUNOS DOSÍMETROS TÓRAX SELECCIONADOS SE ENCUENTRAN REPETIDOS CON LOS DOSÍMETROS DE UBICACIÓN AMBIENTAL",
                                text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN CORRECTAMENTE",
                                icon: 'error'
                            });
                    }
                }
                for(var y = 0; y < dosimCaso.length; y++){
                    var valuesCaso = dosimCaso[y].value;
                    if(values == valuesCaso){
                        return Swal.fire({
                                title:"ALGUNOS DOSÍMETROS TÓRAX SELECCIONADOS SE ENCUENTRAN REPETIDOS CON LOS DOSÍMETROS DE UBICACIÓN CASO",
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
                for(var y = 0; y < dosimControlUniCristalino.length; y++){
                    var valuesCrist = dosimControlUniCristalino[y].value;
                    if(values == valuesCrist){
                        return Swal.fire({
                                title:"ALGUNOS DOSÍMETROS DE CONTROL TRANSPORTE CRISTALINO SELECCIONADOS SE ENCUENTRAN REPETIDOS CON LOS DOSÍMETROS DE UBICACIÓN CRISTALINO",
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
                for(var y = 0; y < dosimControlUniAnillo.length; y++){
                    var valuesDedo = dosimControlUniAnillo[y].value;
                    if(values == valuesDedo){
                        return Swal.fire({
                                title:"ALGUNOS DOSÍMETROS DE CONTROL TRANSPORTE ANILLO SELECCIONADOS SE ENCUENTRAN REPETIDOS CON LOS DOSIMETROS DE UBICACIÓN CRISTALINO",
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
                for(var y = 0; y < dosimControlUniAnillo.length; y++){
                    var valuesDedo = dosimControlUniAnillo[y].value;
                    if(values == valuesDedo){
                        return Swal.fire({
                                title:"ALGUNOS DOSÍMETROS DE CONTROL TRANSPORTE ANILLO SELECCIONADOS SE ENCUENTRAN REPETIDOS CON LOS DOSÍMETROS DE UBICACIÓN ANILLO",
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
                for(var y = 0; y < dosimControlUniCristalino.length; y++){
                    var valuesCrist = dosimControlUniCristalino[y].value;
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