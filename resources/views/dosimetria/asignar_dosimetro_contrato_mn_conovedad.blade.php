@extends('layouts.app')
@extends('layouts.plantillabase')
@section('contenido')
<div class="row">
    <div class="col-md"></div>
    <div class="col-md-15">
        <div class="card text-dark bg-light">
            <h2 class="modal-title w-100 text-center">ASIGNACIÓN DE DOSÍMETROS DESPUÉS DE NOVEDAD</h2>
            <h3 class="modal-title w-100 text-center" id="nueva_empresaModalLabel"><i>{{$contdosisededepto->contratodosimetriasede->sede->empresa->nombre_empresa}} - SEDE: {{$contdosisededepto->contratodosimetriasede->sede->nombre_sede}}</i> <br>MES {{$mesnumber}} ( <span id="mes{{$mesnumber}}"></span> ), ESPECIALIDAD: {{$contdosisededepto->departamentosede->departamento->nombre_departamento}} </h3>
            <form action="{{route('asignadosicontratomnNovedad.save', ['asigdosicont'=> $contdosisededepto->id_contdosisededepto, 'mesnumber'=>$mesnumber])}}" method="POST"  id="form-nueva-asignacion_mn" name="form-nueva-asignacion_mn" class="form-nueva-asignacion_mn m-4">
                @csrf
                <br>
                <div class="row g-2 mx-3">
                    <div class="col-md"></div>
                    <div class="col-md-6">    
                        <div class="table table-responsive">
                            <table class="table table-sm table-bordered">
                                <thead class="table-active">
                                    <tr class="text-center">
                                        <th colspan='7'>DOSíMETROS CONTRATADOS</th>
                                    </tr>
                                    <tr class="text-center">
                                        <th>TÓRAX</th>
                                        <th>CRISTALINO</th>
                                        <th>ANILLO</th>
                                        <th>MUÑECA</th>
                                        <th>CONTROL</th>
                                        <th>ÁREA</th>
                                        <th>CASO</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center">{{$mescontdosisededepto->dosi_torax}}</td>
                                        <td class="text-center">{{$mescontdosisededepto->dosi_cristalino}}</td>
                                        <td class="text-center">{{$mescontdosisededepto->dosi_dedo}}</td>
                                        <td class="text-center">{{$mescontdosisededepto->dosi_muñeca}}</td>
                                        <td class="text-center">{{$mescontdosisededepto->dosi_control}}</td>
                                        <td class="text-center">{{$mescontdosisededepto->dosi_area}}</td>
                                        <td class="text-center">{{$mescontdosisededepto->dosi_caso}}</td>
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
                            <input type="date" class="form-control" name="primerDia_asigdosim" id="primerDia_asigdosim" @foreach($asignacionesMes as $asigMes) value="{{$asigMes->primer_dia_uso}}" @break @endforeach>
                            <label for="floatingInputGrid">PRIMER DÍA</label>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-floating">
                            <input type="date" class="form-control " name="ultimoDia_asigdosim" id="ultimoDia_asigdosim" @foreach($asignacionesMes as $asigMes) value="{{$asigMes->ultimo_dia_uso}}" @break @endforeach>
                            <label for="floatingInputGrid">ULTIMO DÍA:</label>
                        </div>
                    </div>
                </div> 
                <br>   
                <div class="row g-2 mx-3">
                    <div class="col-md">
                        <div class="form-floating">
                            <input type="date" class="form-control" name="fecha_envio_dosim_asignado" id="fecha_envio_dosim_asignado" @foreach($asignacionesMes as $asigMes) value="{{$asigMes->fecha_dosim_enviado}}" @break @endforeach>
                            <label for="floatingInputGrid">FECHA ENVIO</label>
                            
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-floating">
                            <input type="date" class="form-control" name="fecha_recibido_dosim_asignado" id="fecha_recibido_dosim_asignado" @foreach($asignacionesMes as $asigMes) value="{{$asigMes->fecha_dosim_recibido}}" @break @endforeach>
                            <label for="floatingInputGrid">FECHA RECIBIDO</label>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-floating">
                            <input type="date" class="form-control" name="fecha_devuelto_dosim_asignado" id="fecha_devuelto_dosim_asignado" @foreach($asignacionesMes as $asigMes) value="{{$asigMes->fecha_dosim_devuelto}}" @break @endforeach>
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
                                    <input hidden name="mesNumber" id="mesNumber" value="{{$mesnumber}}">
                                    <input type="number" name="id_departamento_asigdosim" id="id_departamento_asigdosim" hidden value="{{$contdosisededepto->id_contdosisededepto}}">
                                    <input type="number" name="id_contrato_asigdosim_sede" id="id_contrato_asigdosim_sede" hidden value="{{$contdosisededepto->contratodosimetriasede_id}}">
                                    {{--///Filas creadas segun la cantidad de dosimetros tipo CONTROL asignados en UNA NOVEADAD DE NUEVOS DOSIMETROS PARA MES SIGUIENTE AL ACTUAL EN EL QUE FALTA ASOCIAR DOSIMETROS Y HOLDERS(este se convierte en actual)/////// --}}

                                    @foreach($dosicontrolmesact as $dosicontrolact)
                                        <tr>
                                            <input type="number" name="id_dosicontrolAsig[]" id="id_dosicontrolAsig" value="{{$dosicontrolact->id_dosicontrolcontdosisedes}}" hidden >
                                            <td colspan='2' class='align-middle'>CONTROL</td>
                                            <td class='align-middle'>
                                                <select class="form-select id_dosimetro_asigdosimControl"  name="id_dosimetro_asigdosimControl[]" id="id_dosimetro_asigdosimControl" >
                                                    <option value="@if($dosicontrolact->dosimetro_id != NULL){{$dosicontrolact->dosimetro_id}}@endif">@if($dosicontrolact->dosimetro_id == NULL) -- @else --{{$dosicontrolact->dosimetro->codigo_dosimeter}}-- @endif</option>
                                                    @foreach($dosimLibresGeneral as $dosigenlib)
                                                        <option value="{{$dosigenlib->id_dosimetro}}">{{$dosigenlib->codigo_dosimeter}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td class='align-middle'>N.A.</td>
                                            <td>
                                                <select class="form-select ocupacion_asigdosimControl" name="ocupacion_asigdosimControl[]" id="ocupacion_asigdosimControl" style="text-transform:uppercase" >
                                                    {{-- <option value="{{$dosicontrolact->dosimetro_id}}"> {{$dosicontrolact->dosimetro->codigo_dosimeter}}</option> --}}
                                                    @if($dosicontrolact->ocupacion != NULL)    
                                                        @if($dosicontrolact->ocupacion=='T')
                                                            <option selected hidden value="T">--TELETERAPIA--</option>
                                                            @elseif($dosicontrolact->ocupacion=='BQ')
                                                            <option selected hidden value="BQ">--BRAQUITERAPIA--</option>
                                                            @elseif($dosicontrolact->ocupacion=='MN')
                                                            <option selected hidden value="MN">--MEDICINA NUCLEAR--</option>
                                                            @elseif($dosicontrolact->ocupacion=='GM')
                                                            <option selected hidden value="GM">--GAMAGRAFIA INDUSTRIAL--</option>
                                                            @elseif($dosicontrolact->ocupacion=='MF')
                                                            <option selected hidden value="MF">--MEDIDORES FIJOS--</option>
                                                            @elseif($dosicontrolact->ocupacion=='IV')
                                                            <option selected hidden value="IV">--INVESTIGACIÓN--</option>
                                                            @elseif($dosicontrolact->ocupacion=='DN')
                                                            <option selected hidden value="DN">--DENSÍMETRO NUCLEAR--</option>
                                                            @elseif($dosicontrolact->ocupacion=='MM')
                                                            <option selected hidden value="MM">--MEDIDORES MÓVILES--</option>
                                                            @elseif($dosicontrolact->ocupacion=='E')
                                                            <option selected hidden value="E">--DOCENCIA--</option>
                                                            @elseif($dosicontrolact->ocupacion=='PR')
                                                            <option selected hidden value="PR">--PERFILAJE Y REGISTRO--</option>
                                                            @elseif($dosicontrolact->ocupacion=='TR')
                                                            <option selected hidden value="TR">--TRAZADORES--</option>
                                                            @elseif($dosicontrolact->ocupacion=='HD')
                                                            <option selected hidden value="HD">--HEMODINAMIA--</option>
                                                            @elseif($dosicontrolact->ocupacion=='OD')
                                                            <option selected hidden value="OD">--RAYOS X ODONTOLÓGICO--</option>
                                                            @elseif($dosicontrolact->ocupacion=='RX')
                                                            <option selected hidden value="RX">--RADIODIAGNÓSTICO--</option>
                                                            @elseif($dosicontrolact->ocupacion=='FL')
                                                            <option selected hidden value="FL">--FLUOROSCOPÍA--</option>
                                                            @elseif($dosicontrolact->ocupacion=='AM')
                                                            <option selected hidden value="AM">--APLICACIONES MÉDICAS--</option>
                                                            @elseif($dosicontrolact->ocupacion=='AI')
                                                            <option selected hidden value="AI">--APLICACIONES INDUSTRIALES--</option>
                                                        @endif
                                                    @else  
                                                        <option value="">----</option>
                                                        <option value="T"> TELETERAPIA</option>
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
                                                        <option value="FL">FLUOROSCOPIA</option>
                                                        <option value="AM">APLICACIONES MÉDICAS</option>
                                                        <option value="AI">APLICACIONES INDUSTRIALES</option>
                                                    @endif
                                                </select>
                                            </td>
                                        </tr>
                                    @endforeach
                                    {{--///Filas creadas segun la cantidad de dosimetros tipo AREA asignados en UNA NOVEADAD DE NUEVOS DOSIMETROS PARA MES SIGUIENTE AL ACTUAL EN EL QUE FALTA ASOCIAR DOSIMETROS Y HOLDERS (este se convierte en actual)/////// --}}
                                    @foreach($dosiareamesact as $dosiareact)
                                        <tr>
                                            <td>
                                                <input type="number" name="id_dosiareaAsig[]" id="id_dosiareaAsig" value="{{$dosiareact->id_dosiareacontdosisedes}}" hidden >
                                                <select class="form-select id_area_asigdosimArea"  name="id_area_asigdosimArea[]" id="id_area_asigdosimArea{{$dosiareact->areadepartamentosede_id}}" disabled>
                                                    <option value="{{$dosiareact->areadepartamentosede_id}}">--{{$dosiareact->areadepartamentosede->nombre_area}}--</option>
                                                    @foreach($areaSede as $area)
                                                        @if($area->id_areadepartamentosede != $dosiareact->areadepartamentosede_id)
                                                            <option  value ="{{$area->id_areadepartamentosede}}">{{$area->nombre_area}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>ÁREA</td>
                                            <td>
                                                <select class="form-select id_dosimetro_asigdosimArea"  name="id_dosimetro_asigdosimArea[]" id="id_dosimetro_asigdosimArea">
                                                    <option value="@if($dosiareact->dosimetro_id != NULL){{$dosiareact->dosimetro_id}}@endif">@if($dosiareact->dosimetro_id == NULL)-- @else--{{$dosiareact->dosimetro->codigo_dosimeter}}--@endif</option>
                                                    @foreach($dosimLibresAmbiental as $dosiamblib)
                                                        <option value="{{$dosiamblib->id_dosimetro}}">{{$dosiamblib->codigo_dosimeter}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>N.A</td>
                                            <td>
                                                <select class="form-select" name="ocupacion_asigdosimArea[]" id="ocupacion_asigdosimArea" style="text-transform:uppercase" @if($dosiareant->dosimetro_uso != 'FALSE') { disabled } @endif>
                                                    @if($dosiareact->ocupacion != NULL)    
                                                        @if($dosiareact->ocupacion=='T')
                                                            <option selected hidden value="T">--TELETERAPIA--</option>
                                                            @elseif($dosiareact->ocupacion=='BQ')
                                                            <option selected hidden value="BQ">--BRAQUITERAPIA--</option>
                                                            @elseif($dosiareact->ocupacion=='MN')
                                                            <option selected hidden value="MN">--MEDICINA NUCLEAR--</option>
                                                            @elseif($dosiareact->ocupacion=='GM')
                                                            <option selected hidden value="GM">--GAMAGRAFIA INDUSTRIAL--</option>
                                                            @elseif($dosiareact->ocupacion=='MF')
                                                            <option selected hidden value="MF">--MEDIDORES FIJOS--</option>
                                                            @elseif($dosiareact->ocupacion=='IV')
                                                            <option selected hidden value="IV">--INVESTIGACIÓN--</option>
                                                            @elseif($dosiareact->ocupacion=='DN')
                                                            <option selected hidden value="DN">--DENSÍMETRO NUCLEAR--</option>
                                                            @elseif($dosiareact->ocupacion=='MM')
                                                            <option selected hidden value="MM"-->MEDIDORES MÓVILES--</option>
                                                            @elseif($dosiareact->ocupacion=='E')
                                                            <option selected hidden value="E">--DOCENCIA--</option>
                                                            @elseif($dosiareact->ocupacion=='PR')
                                                            <option selected hidden value="PR">--PERFILAJE Y REGISTRO--</option>
                                                            @elseif($dosiareact->ocupacion=='TR')
                                                            <option selected hidden value="TR">--TRAZADORES--</option>
                                                            @elseif($dosiareact->ocupacion=='HD')
                                                            <option selected hidden value="HD">--HEMODINAMIA--</option>
                                                            @elseif($dosiareact->ocupacion=='OD')
                                                            <option selected hidden value="OD">--RAYOS X ODONTOLÓGICO--</option>
                                                            @elseif($dosiareact->ocupacion=='RX')
                                                            <option selected hidden value="RX">--RADIODIAGNÓSTICO--</option>
                                                            @elseif($dosiareact->ocupacion=='FL')
                                                            <option selected hidden value="FL">--FLUOROSCOPÍA--</option>
                                                            @elseif($dosiareact->ocupacion=='AM')
                                                            <option selected hidden value="AM">--APLICACIONES MÉDICAS--</option>
                                                            @elseif($dosiareact->ocupacion=='AI')
                                                            <option selected hidden value="AI">--APLICACIONES INDUSTRIALES--</option>
                                                        @endif
                                                    @else
                                                        <option value="">----</option>
                                                        <option value="T"> TELETERAPIA</option>
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
                                                        <option value="FL">FLUOROSCOPIA</option>
                                                        <option value="AM">APLICACIONES MÉDICAS</option>
                                                        <option value="AI">APLICACIONES INDUSTRIALES</option>
                                                    @endif
                                                </select>
                                            </td>
                                        </tr>
                                    @endforeach
                                    {{--///Filas creadas segun la cantidad de dosimetros tipo CASO asignados en UNA NOVEADAD DE NUEVOS DOSIMETROS PARA MES SIGUIENTE AL ACTUAL EN EL QUE FALTA ASOCIAR DOSIMETROS Y HOLDERS (este se convierte en actual)/////// --}}
                                    @foreach($dosicasomesact as $dosicasoact)
                                        <tr>
                                            <td>
                                                <input type="number" name="id_asigdosimCaso[]" id="id_asigdosimCaso" value="{{$dosicasoact->id_trabajadordosimetro}}" hidden>
                                                <select class="form-select"  name="id_trabajador_asigdosimCaso[]" id="id_trabajador_asigdosimCaso{{$dosicasoact->persona_id}}" disabled>
                                                    <option value="{{$dosicasoact->persona_id}}"> {{$dosicasoant->persona->primer_nombre_persona}} {{$dosicasoant->persona->segundo_nombre_persona}} {{$dosicasoant->persona->primer_apellido_persona}} {{$dosicasoant->persona->segundo_apellido_persona}}</option>
                                                    
                                                </select>
                                            </td>
                                            <td>CASO</td>
                                            <td>
                                                <select class="form-select"  name="id_dosimetro_asigdosimCaso[]" id="id_dosimetro_asigdosimCaso">
                                                    <option value="@if($dosicasoact->dosimetro_id != NULL){{$dosicasoact->dosimetro_id}} @endif">@if($dosicasoact->dosimetro_id == NULL) -- @else--{{$dosicasoact->dosimetro->codigo_dosimeter}}--@endif</option>
                                                    @foreach($dosimLibresGeneral as $dosigenlib)
                                                        <option value="{{$dosigenlib->id_dosimetro}}">{{$dosigenlib->codigo_dosimeter}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>N.A</td>
                                            <td>
                                                <select class="form-select" name="ocupacion_asigdosimCaso[]" id="ocupacion_asigdosimCaso" style="text-transform:uppercase" >
                                                    @if($dosicasoact->ocupacion != NULL)    
                                                        @if($dosicasoact->ocupacion=='T')
                                                            <option selected hidden value="T">--TELETERAPIA--</option>
                                                            @elseif($dosicasoact->ocupacion=='BQ')
                                                            <option selected hidden value="BQ">--BRAQUITERAPIA--</option>
                                                            @elseif($dosicasoact->ocupacion=='MN')
                                                            <option selected hidden value="MN">--MEDICINA NUCLEAR--</option>
                                                            @elseif($dosicasoact->ocupacion=='GM')
                                                            <option selected hidden value="GM">--GAMAGRAFIA INDUSTRIAL--</option>
                                                            @elseif($dosicasoact->ocupacion=='MF')
                                                            <option selected hidden value="MF">--MEDIDORES FIJOS--</option>
                                                            @elseif($dosicasoact->ocupacion=='IV')
                                                            <option selected hidden value="IV">--INVESTIGACIÓN--</option>
                                                            @elseif($dosicasoact->ocupacion=='DN')
                                                            <option selected hidden value="DN">--DENSÍMETRO NUCLEAR--</option>
                                                            @elseif($dosicasoact->ocupacion=='MM')
                                                            <option selected hidden value="MM">--MEDIDORES MÓVILES--</option>
                                                            @elseif($dosicasoact->ocupacion=='E')
                                                            <option selected hidden value="E">--DOCENCIA--</option>
                                                            @elseif($dosicasoact->ocupacion=='PR')
                                                            <option selected hidden value="PR">--PERFILAJE Y REGISTRO--</option>
                                                            @elseif($dosicasoact->ocupacion=='TR')
                                                            <option selected hidden value="TR">--TRAZADORES--</option>
                                                            @elseif($dosicasoact->ocupacion=='HD')
                                                            <option selected hidden value="HD">--HEMODINAMIA--</option>
                                                            @elseif($dosicasoact->ocupacion=='OD')
                                                            <option selected hidden value="OD">--RAYOS X ODONTOLÓGICO--</option>
                                                            @elseif($dosicasoact->ocupacion=='RX')
                                                            <option selected hidden value="RX">--RADIODIAGNÓSTICO--</option>
                                                            @elseif($dosicasoact->ocupacion=='FL')
                                                            <option selected hidden value="FL">--FLUOROSCOPÍA--</option>
                                                            @elseif($dosicasoact->ocupacion=='AM')
                                                            <option selected hidden value="AM">--APLICACIONES MÉDICAS--</option>
                                                            @elseif($dosicasoact->ocupacion=='AI')
                                                            <option selected hidden value="AI">--APLICACIONES INDUSTRIALES--</option>
                                                        @endif
                                                    @else
                                                        <option value="">----</option>
                                                        <option value="T"> TELETERAPIA</option>
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
                                                        <option value="FL">FLUOROSCOPIA</option>
                                                        <option value="AM">APLICACIONES MÉDICAS</option>
                                                        <option value="AI">APLICACIONES INDUSTRIALES</option>
                                                    @endif
                                                </select>
                                            </td>
                                        </tr>   
                                    @endforeach
                                    {{--///Filas creadas segun la cantidad de dosimetros tipo TORAX asignados en UNA NOVEADAD DE NUEVOS DOSIMETROS PARA MES SIGUIENTE AL ACTUAL EN EL QUE FALTA ASOCIAR DOSIMETROS Y HOLDERS (este se convierte en actual)/////// --}}
                                    @foreach($dositoraxmesact as $dositoraxact)
                                        <tr>
                                            <td>
                                                <input type="number" name="id_asigdosimTorax[]" id="id_asigdosimTorax" value="{{$dositoraxact->id_trabajadordosimetro}}" hidden>
                                                <select class="form-select"  name="id_trabajador_asigdosimTorax[]" id="id_trabajador_asigdosimTorax{{$dositoraxact->persona_id}}" disabled>
                                                    <option value="{{$dositoraxact->persona_id}}">{{$dositoraxact->persona->primer_nombre_persona}} {{$dositoraxact->persona->segundo_nombre_persona}} {{$dositoraxact->persona->primer_apellido_persona}} {{$dositoraxact->persona->segundo_apellido_persona}}</option>
                                                    
                                                </select>
                                            </td>
                                            <td>TÓRAX</td>
                                            <td>
                                                <select class="form-select"  name="id_dosimetro_asigdosimTorax[]" id="id_dosimetro_asigdosimTorax" >
                                                    <option value="@if($dositoraxact->dosimetro_id != NULL){{$dositoraxact->dosimetro_id}} @endif">@if($dositoraxact->dosimetro_id == NULL)--@else --{{$dositoraxact->dosimetro->codigo_dosimeter}}--@endif</option>
                                                    @foreach($dosimLibresGeneral as $dosigenlib)
                                                        <option value="{{$dosigenlib->id_dosimetro}}">{{$dosigenlib->codigo_dosimeter}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>N.A</td>
                                            <td>
                                                <select class="form-select" name="ocupacion_asigdosimTorax[]" id="ocupacion_asigdosimTorax" style="text-transform:uppercase">
                                                    @if($dositoraxact->ocupacion != NULL)    
                                                        @if($dositoraxact->ocupacion=='T')
                                                            <option selected hidden value="T">--TELETERAPIA--</option>
                                                            @elseif($dositoraxact->ocupacion=='BQ')
                                                            <option selected hidden value="BQ"-->BRAQUITERAPIA--</option>
                                                            @elseif($dositoraxact->ocupacion=='MN')
                                                            <option selected hidden value="MN">--MEDICINA NUCLEAR--</option>
                                                            @elseif($dositoraxact->ocupacion=='GM')
                                                            <option selected hidden value="GM">--GAMAGRAFIA INDUSTRIAL--</option>
                                                            @elseif($dositoraxact->ocupacion=='MF')
                                                            <option selected hidden value="MF">--MEDIDORES FIJOS--</option>
                                                            @elseif($dositoraxact->ocupacion=='IV')
                                                            <option selected hidden value="IV">--INVESTIGACIÓN--</option>
                                                            @elseif($dositoraxact->ocupacion=='DN')
                                                            <option selected hidden value="DN">--DENSÍMETRO NUCLEAR--</option>
                                                            @elseif($dositoraxact->ocupacion=='MM')
                                                            <option selected hidden value="MM">--MEDIDORES MÓVILES--</option>
                                                            @elseif($dositoraxact->ocupacion=='E')
                                                            <option selected hidden value="E">--DOCENCIA--</option>
                                                            @elseif($dositoraxact->ocupacion=='PR')
                                                            <option selected hidden value="PR">--PERFILAJE Y REGISTRO--</option>
                                                            @elseif($dositoraxact->ocupacion=='TR')
                                                            <option selected hidden value="TR">--TRAZADORES--</option>
                                                            @elseif($dositoraxact->ocupacion=='HD')
                                                            <option selected hidden value="HD">--HEMODINAMIA--</option>
                                                            @elseif($dositoraxact->ocupacion=='OD')
                                                            <option selected hidden value="OD">--RAYOS X ODONTOLÓGICO--</option>
                                                            @elseif($dositoraxact->ocupacion=='RX')
                                                            <option selected hidden value="RX">--RADIODIAGNÓSTICO--</option>
                                                            @elseif($dositoraxact->ocupacion=='FL')
                                                            <option selected hidden value="FL">--FLUOROSCOPÍA--</option>
                                                            @elseif($dositoraxact->ocupacion=='AM')
                                                            <option selected hidden value="AM">--APLICACIONES MÉDICAS--</option>
                                                            @elseif($dositoraxact->ocupacion=='AI')
                                                            <option selected hidden value="AI">--APLICACIONES INDUSTRIALES--</option>
                                                        @endif
                                                    @else
                                                        <option value="">----</option>
                                                        <option value="T"> TELETERAPIA</option>
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
                                                        <option value="FL">FLUOROSCOPIA</option>
                                                        <option value="AM">APLICACIONES MÉDICAS</option>
                                                        <option value="AI">APLICACIONES INDUSTRIALES</option>
                                                    @endif
                                                </select>
                                            </td>
                                           
                                        </tr>
                                    @endforeach
                                    {{--///Filas creadas segun la cantidad de dosimetros tipo CRISTALINO asignados en UNA NOVEADAD DE NUEVOS DOSIMETROS PARA MES SIGUIENTE AL ACTUAL EN EL QUE FALTA ASOCIAR DOSIMETROS Y HOLDERS (este se convierte en actual)/////// --}}
                                    @foreach($dosicristalinomesact as $dosicristalinoact)
                                        <tr>
                                            <td>
                                                <input type="number" name="id_asigdosimCristalino[]" id="id_asigdosimCristalino" value="{{$dosicristalinoact->id_trabajadordosimetro}}" hidden>
                                                <select class="form-select"  name="id_trabajador_asigdosimCristalino[]" id="id_trabajador_asigdosimCristalino{{$dosicristalinoact->persona_id}}" disabled>
                                                    <option value="{{$dosicristalinoact->persona_id}}">{{$dosicristalinoact->persona->primer_nombre_persona}} {{$dosicristalinoact->persona->segundo_nombre_persona}} {{$dosicristalinoact->persona->primer_apellido_persona}} {{$dosicristalinoact->persona->segundo_apellido_persona}}</option>
                                                    
                                                </select>
                                            </td>
                                            <td>CRISTALINO</td>
                                            <td>
                                                <select class="form-select"  name="id_dosimetro_asigdosimCristalino[]" id="id_dosimetro_asigdosimCristalino">
                                                    <option value="@if($dosicristalinoact->dosimetro_id != NULL){{$dosicristalinoact->dosimetro_id}}@endif">@if($dosicristalinoact->dosimetro_id == NULL)--@else--{{$dosicristalinoact->dosimetro->codigo_dosimeter}}--@endif</option>
                                                    @foreach($dosimLibresEzclip as $dosiezcliplib)
                                                        <option value="{{$dosiezcliplib->id_dosimetro}}">{{$dosiezcliplib->codigo_dosimeter}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <select class="form-select"  name="id_holder_asigdosimCristalino[]" id="id_holder_asigdosimCristalino" >
                                                    <option value="@if($dosicristalinoact->holder_id != NULL){{$dosicristalinoact->holder_id}}@endif">@if($dosicristalinoact->holder_id == NULL)--@else--{{$dosicristalinoact->holder->codigo_holder}}--@endif</option>
                                                    @foreach($holderLibresCristalino as $holibcris)
                                                        <option value="{{$holibcris->id_holder}}">{{$holibcris->codigo_holder}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <select class="form-select" name="ocupacion_asigdosimCristalino[]" id="ocupacion_asigdosimCristalino">
                                                    @if($dosicristalinoact->ocupacion != NULL)
                                                        @if($dosicristalinoact->ocupacion=='T')
                                                            <option selected hidden value="T">--TELETERAPIA--</option>
                                                            @elseif($dosicristalinoact->ocupacion=='BQ')
                                                            <option selected hidden value="BQ">--BRAQUITERAPIA--</option>
                                                            @elseif($dosicristalinoact->ocupacion=='MN')
                                                            <option selected hidden value="MN">--MEDICINA NUCLEAR--</option>
                                                            @elseif($dosicristalinoact->ocupacion=='GM')
                                                            <option selected hidden value="GM">--GAMAGRAFIA INDUSTRIAL--</option>
                                                            @elseif($dosicristalinoact->ocupacion=='MF')
                                                            <option selected hidden value="MF">--MEDIDORES FIJOS--</option>
                                                            @elseif($dosicristalinoact->ocupacion=='IV')
                                                            <option selected hidden value="IV">--INVESTIGACIÓN--</option>
                                                            @elseif($dosicristalinoact->ocupacion=='DN')
                                                            <option selected hidden value="DN">--DENSÍMETRO NUCLEAR--</option>
                                                            @elseif($dosicristalinoact->ocupacion=='MM')
                                                            <option selected hidden value="MM">--MEDIDORES MÓVILES--</option>
                                                            @elseif($dosicristalinoact->ocupacion=='E')
                                                            <option selected hidden value="E">--DOCENCIA--</option>
                                                            @elseif($dosicristalinoact->ocupacion=='PR')
                                                            <option selected hidden value="PR">--PERFILAJE Y REGISTRO--</option>
                                                            @elseif($dosicristalinoact->ocupacion=='TR')
                                                            <option selected hidden value="TR">--TRAZADORES--</option>
                                                            @elseif($dosicristalinoact->ocupacion=='HD')
                                                            <option selected hidden value="HD">--HEMODINAMIA--</option>
                                                            @elseif($dosicristalinoact->ocupacion=='OD')
                                                            <option selected hidden value="OD">--RAYOS X ODONTOLÓGICO--</option>
                                                            @elseif($dosicristalinoact->ocupacion=='RX')
                                                            <option selected hidden value="RX">--RADIODIAGNÓSTICO--</option>
                                                            @elseif($dosicristalinoact->ocupacion=='FL')
                                                            <option selected hidden value="FL">--FLUOROSCOPÍA--</option>
                                                            @elseif($dosicristalinoact->ocupacion=='AM')
                                                            <option selected hidden value="AM">--APLICACIONES MÉDICAS--</option>
                                                            @elseif($dosicristalinoact->ocupacion=='AI')
                                                            <option selected hidden value="AI">--APLICACIONES INDUSTRIALES--</option>
                                                        @endif
                                                    @endif    
                                                    <option value="">----</option>
                                                    <option value="T"> TELETERAPIA</option>
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
                                                    <option value="FL">FLUOROSCOPIA</option>
                                                    <option value="AM">APLICACIONES MÉDICAS</option>
                                                    <option value="AI">APLICACIONES INDUSTRIALES</option>
                                                </select>
                                            </td>
                                        </tr>
                                    @endforeach
                                    {{--///Filas creadas segun la cantidad de dosimetros tipo MUÑECA asignados en UNA NOVEADAD DE NUEVOS DOSIMETROS PARA MES SIGUIENTE AL ACTUAL EN EL QUE FALTA ASOCIAR DOSIMETROS Y HOLDERS (este se convierte en actual)/////// --}}
                                    @foreach($dosimuñecamesact as $dosimuñecact)
                                        <tr>
                                            <td>
                                                <input type="number" name="id_asigdosimMuneca[]" id="id_asigdosimMuneca" value="{{$dosimuñecact->id_trabajadordosimetro}}" hidden>
                                                <select class="form-select"  name="id_trabajador_asigdosimMuneca[]" id="id_trabajador_asigdosimMuneca{{$dosimuñecact->persona_id}}" disabled>
                                                    <option value="{{$dosimuñecact->persona_id}}"> {{$dosimuñecact->persona->primer_nombre_persona}} {{$dosimuñecact->persona->segundo_nombre_persona}} {{$dosimuñecact->persona->primer_apellido_persona}} {{$dosimuñecact->persona->segundo_apellido_persona}}</option>
                                                    
                                                </select>
                                            </td>
                                            <td>MUÑECA</td>
                                            <td>
                                                <select class="form-select"  name="id_dosimetro_asigdosimMuneca[]" id="id_dosimetro_asigdosimMuneca">
                                                    <option value="@if($dosimuñecact->dosimetro_id != NULL){{$dosimuñecact->dosimetro_id}}@endif">@if($dosimuñecact->dosimetro_id == NULL)--@else--{{$dosimuñecact->dosimetro->codigo_dosimeter}}--@endif</option>
                                                    @foreach($dosimLibresEzclip as $dosiezcliplib)
                                                        <option value="{{$dosiezcliplib->id_dosimetro}}">{{$dosiezcliplib->codigo_dosimeter}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <select class="form-select"  name="id_holder_asigdosimMuneca[]" id="id_holder_asigdosimMuneca">
                                                    <option value="@if($dosimuñecact->holder_id != NULL){{$dosimuñecact->holder_id}}@endif">@if($dosimuñecact->holder_id == NULL)--@else--{{$dosimuñecact->holder->codigo_holder}}--@endif</option>
                                                    @foreach($holderLibresExtrem as $holibexm)
                                                        <option value="{{$holibexm->id_holder}}">{{$holibexm->codigo_holder}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <select class="form-select" name="ocupacion_asigdosimMuneca[]" id="ocupacion_asigdosimMuneca"  style="text-transform:uppercase">
                                                    @if($dosimuñecact->ocupacion != NULL)
                                                        @if($dosimuñecact->ocupacion=='T')
                                                            <option selected hidden value="T">--TELETERAPIA--</option>
                                                            @elseif($dosimuñecact->ocupacion=='BQ')
                                                            <option selected hidden value="BQ">--BRAQUITERAPIA--</option>
                                                            @elseif($dosimuñecact->ocupacion=='MN')
                                                            <option selected hidden value="MN">--MEDICINA NUCLEAR--</option>
                                                            @elseif($dosimuñecact->ocupacion=='GM')
                                                            <option selected hidden value="GM">--GAMAGRAFIA INDUSTRIAL--</option>
                                                            @elseif($dosimuñecact->ocupacion=='MF')
                                                            <option selected hidden value="MF">--MEDIDORES FIJOS--</option>
                                                            @elseif($dosimuñecact->ocupacion=='IV')
                                                            <option selected hidden value="IV">--INVESTIGACIÓN--</option>
                                                            @elseif($dosimuñecact->ocupacion=='DN')
                                                            <option selected hidden value="DN">--DENSÍMETRO NUCLEAR--</option>
                                                            @elseif($dosimuñecact->ocupacion=='MM')
                                                            <option selected hidden value="MM">--MEDIDORES MÓVILES--</option>
                                                            @elseif($dosimuñecact->ocupacion=='E')
                                                            <option selected hidden value="E">--DOCENCIA--</option>
                                                            @elseif($dosimuñecact->ocupacion=='PR')
                                                            <option selected hidden value="PR">--PERFILAJE Y REGISTRO--</option>
                                                            @elseif($dosimuñecact->ocupacion=='TR')
                                                            <option selected hidden value="TR">--TRAZADORES--</option>
                                                            @elseif($dosimuñecact->ocupacion=='HD')
                                                            <option selected hidden value="HD">--HEMODINAMIA--</option>
                                                            @elseif($dosimuñecact->ocupacion=='OD')
                                                            <option selected hidden value="OD">--RAYOS X ODONTOLÓGICO--</option>
                                                            @elseif($dosimuñecact->ocupacion=='RX')
                                                            <option selected hidden value="RX">--RADIODIAGNÓSTICO--</option>
                                                            @elseif($dosimuñecact->ocupacion=='FL')
                                                            <option selected hidden value="FL">--FLUOROSCOPÍA--</option>
                                                            @elseif($dosimuñecact->ocupacion=='AM')
                                                            <option selected hidden value="AM">--APLICACIONES MÉDICAS--</option>
                                                            @elseif($dosimuñecact->ocupacion=='AI')
                                                            <option selected hidden value="AI">--APLICACIONES INDUSTRIALES--</option>
                                                        @endif
                                                    @else
                                                        <option value="">----</option>
                                                        <option value="T"> TELETERAPIA</option>
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
                                                        <option value="FL">FLUOROSCOPIA</option>
                                                        <option value="AM">APLICACIONES MÉDICAS</option>
                                                        <option value="AI">APLICACIONES INDUSTRIALES</option>
                                                    @endif
                                                </select>
                                            </td>
                                        </tr>
                                    @endforeach
                                    {{--///Filas creadas segun la cantidad de dosimetros tipo DEDO asignados en UNA NOVEADAD DE NUEVOS DOSIMETROS PARA MES SIGUIENTE AL ACTUAL EN EL QUE FALTA ASOCIAR DOSIMETROS Y HOLDERS (este se convierte en actual)/////// --}}
                                    @foreach($dosidedomesact as $dosidedoact)
                                        <tr>
                                            <td>
                                                <input type="number" name="id_asigdosimDedo[]" id="id_asigdosimDedo" value="{{$dosidedoact->id_trabajadordosimetro}}" hidden>
                                                <select class="form-select"  name="id_trabajador_asigdosimDedo[]" id="id_trabajador_asigdosimDedo{{$dosidedoact->persona_id}}" disabled>
                                                    <option value="{{$dosidedoact->persona_id}}">{{$dosidedoact->persona->primer_nombre_persona}} {{$dosidedoact->persona->segundo_nombre_persona}} {{$dosidedoact->persona->primer_apellido_persona}} {{$dosidedoact->persona->segundo_apellido_persona}}</option>
                                                    
                                                </select>
                                            </td>
                                            <td>ANILLO</td>
                                            <td>
                                                <select class="form-select"  name="id_dosimetro_asigdosimDedo[]" id="id_dosimetro_asigdosimDedo"  >
                                                    <option value="@if($dosidedoact->dosimetro_id != NULL){{$dosidedoact->dosimetro_id}}@endif">@if($dosidedoact->dosimetro_id == NULL)-- @else--{{$dosidedoact->dosimetro->codigo_dosimeter}}--@endif</option>
                                                    @foreach($dosimLibresEzclip as $dosiezcliplib)
                                                        <option value="{{$dosiezcliplib->id_dosimetro}}">{{$dosiezcliplib->codigo_dosimeter}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <select class="form-select"  name="id_holder_asigdosimDedo[]" id="id_holder_asigdosimDedo">
                                                    <option value="@if($dosidedoact->holder_id != NULL){{$dosidedoact->holder_id}}@endif">@if($dosidedoact->holder_id == NULL )--@else--{{$dosidedoact->holder->codigo_holder}}--@endif</option>
                                                    @foreach($holderLibresAnillo as $holibanillo)
                                                        <option value="{{$holibanillo->id_holder}}">{{$holibanillo->codigo_holder}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <select class="form-select" name="ocupacion_asigdosimDedo[]" id="ocupacion_asigdosipDedo">
                                                    @if($dosidedoact->ocupacion != NULL)
                                                        @if($dosidedoact->ocupacion=='T')
                                                            <option selected hidden value="T">--TELETERAPIA--</option>
                                                            @elseif($dosidedoact->ocupacion=='BQ')
                                                            <option selected hidden value="BQ">--BRAQUITERAPIA--</option>
                                                            @elseif($dosidedoact->ocupacion=='MN')
                                                            <option selected hidden value="MN">--MEDICINA NUCLEAR--</option>
                                                            @elseif($dosidedoact->ocupacion=='GM')
                                                            <option selected hidden value="GM">--GAMAGRAFIA INDUSTRIAL--</option>
                                                            @elseif($dosidedoact->ocupacion=='MF')
                                                            <option selected hidden value="MF">--MEDIDORES FIJOS--</option>
                                                            @elseif($dosidedoact->ocupacion=='IV')
                                                            <option selected hidden value="IV">--INVESTIGACIÓN--</option>
                                                            @elseif($dosidedoact->ocupacion=='DN')
                                                            <option selected hidden value="DN">--DENSÍMETRO NUCLEAR--</option>
                                                            @elseif($dosidedoact->ocupacion=='MM')
                                                            <option selected hidden value="MM">--MEDIDORES MÓVILES--</option>
                                                            @elseif($dosidedoact->ocupacion=='E')
                                                            <option selected hidden value="E">--DOCENCIA--</option>
                                                            @elseif($dosidedoact->ocupacion=='PR')
                                                            <option selected hidden value="PR">--PERFILAJE Y REGISTRO--</option>
                                                            @elseif($dosidedoact->ocupacion=='TR')
                                                            <option selected hidden value="TR">--TRAZADORES--</option>
                                                            @elseif($dosidedoact->ocupacion=='HD')
                                                            <option selected hidden value="HD">--HEMODINAMIA--</option>
                                                            @elseif($dosidedoact->ocupacion=='OD')
                                                            <option selected hidden value="OD">--RAYOS X ODONTOLÓGICO--</option>
                                                            @elseif($dosidedoact->ocupacion=='RX')
                                                            <option selected hidden value="RX">--RADIODIAGNÓSTICO--</option>
                                                            @elseif($dosidedoact->ocupacion=='FL')
                                                            <option selected hidden value="FL">--FLUOROSCOPÍA--</option>
                                                            @elseif($dosidedoact->ocupacion=='AM')
                                                            <option selected hidden value="AM">--APLICACIONES MÉDICAS--</option>
                                                            @elseif($dosidedoact->ocupacion=='AI')
                                                            <option selected hidden value="AI">--APLICACIONES INDUSTRIALES--</option>
                                                        @endif
                                                    @else
                                                        <option value="">----</option>
                                                        <option value="T"> TELETERAPIA</option>
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
                                                        <option value="FL">FLUOROSCOPIA</option>
                                                        <option value="AM">APLICACIONES MÉDICAS</option>
                                                        <option value="AI">APLICACIONES INDUSTRIALES</option>
                                                    @endif
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
        for($i=0; $i<=13; $i++){
            var r = new Date(new Date(fecha).setMonth(fecha.getMonth()+$i));
            var fechaesp = meses[r.getMonth()] + ' DE ' + r.getUTCFullYear();
            console.log(r + fechaesp + "ESTA ES LA I"+($i+1)); 
            if("{{$mesnumber}}" == ($i+1)){
                
                document.getElementById('mes{{$mesnumber}}').innerHTML = fechaesp;
            } 
        }
            
    })

</script>
<script type="text/javascript">
   
    function fechaultimodia(){
        var fecha = document.getElementById("primerDia_asigdosim").value;
        var fecha_inicio = new Date(fecha);
        fecha_inicio.setMinutes(fecha_inicio.getMinutes() + fecha_inicio.getTimezoneOffset());
        alert(fecha_inicio);
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
        }
    };
    $(document).ready(function(){
        $('#form-nueva-asignacion_mn').submit(function(e){
            e.preventDefault();
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