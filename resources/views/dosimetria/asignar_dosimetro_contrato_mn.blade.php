@extends('layouts.plantillabase')
@section('contenido')
<div class="row">
    <div class="col-md"></div>
    <div class="col-md-15">
        <div class="card text-dark bg-light">
            <br>
            <h3 class="modal-title w-100 text-center" id="nueva_empresaModalLabel">ASIGNACIÓN DOSÍMETROS <br> <i>{{$contdosisededepto->contratodosimetriasede->sede->empresa->nombre_empresa}} - SEDE: {{$contdosisededepto->contratodosimetriasede->sede->nombre_sede}}</i> <br>MES {{$mesnumber}} ( <span id="mes{{$mesnumber}}"></span> ) <br> ESPECIALIDAD: {{$contdosisededepto->departamentosede->nombre_departamento}} </h3>
            <form action="{{route('asignadosicontratomn.save', ['asigdosicont'=> $contdosisededepto->id_contdosisededepto, 'mesnumber'=>$mesnumber])}}" method="POST"  id="form-nueva-asignacion_mn" name="form-nueva-asignacion_mn" class="form-nueva-asignacion_mn m-4">
                @csrf
                <div class="row g-2 mx-3">
                    <div class="col-md">    
                        <div class="table table-responsive">
                            <table class="table table-sm table-bordered">
                                <thead>
                                    <tr class="text-center">
                                        <th>DOSíMETROS</th>
                                        <th>CONTRATADOS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>CONTROL:</th>
                                        <td class="text-center">{{$mescontdosisededepto->dosi_control}}</td>
                                    </tr>
                                    <tr>
                                        <th>TÓRAX:</th>
                                        <td class="text-center">{{$mescontdosisededepto->dosi_torax}}</td>
                                    </tr>
                                    <tr>
                                        <th>ÁREA:</th>
                                        <td class="text-center">{{$mescontdosisededepto->dosi_area}}</td>
                                    </tr>
                                    <tr>
                                        <th>CASO:</th>
                                        <td class="text-center">{{$mescontdosisededepto->dosi_caso}}</td>
                                    </tr>
                                    <tr>
                                        <th>CRISTALINO:</th>
                                        <td class="text-center">{{$mescontdosisededepto->dosi_cristalino}}</td>
                                    </tr>
                                    <tr>
                                        <th>MUÑECA:</th>
                                        <td class="text-center">{{$mescontdosisededepto->dosi_muñeca}}</td>
                                    </tr>
                                    <tr>
                                        <th>DEDO:</th>
                                        <td class="text-center">{{$mescontdosisededepto->dosi_dedo}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row g-2 mx-3">
                    <div class="col-md">
                        <div class="form-floating">
                            <input value="" type="date" class="form-control @error('primerDia_asigdosim') is-invalid @enderror" name="primerDia_asigdosim" id="primerDia_asigdosim" >
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
                                <thead class="text-center">
                                    <th style='width: 28.20%' >TRABAJADOR / ÁREA</th>
                                    <th style='width: 16.40%'>UBICACIÓN</th>
                                    <th style='width: 16.40%'>DOSÍMETRO</th>
                                    <th style='width: 16.40%'>HOLDER</th>
                                    <th style='width: 20.60%'>OCUPACIÓN</th>
                                    <th style='width: 16.60%'>ACCIONES</th>
                                </thead>
                                <tbody>
                                    <input hidden name="mesNumber1" id="mesNumber1" value="{{$mesnumber}}">
                                    <input type="number" name="id_departamento_asigdosim" id="id_departamento_asigdosim" hidden value="{{$contdosisededepto->id_contdosisededepto}}">
                                    <input type="number" name="id_contrato_asigdosim_sede" id="id_contrato_asigdosim_sede" hidden value="{{$contdosisededepto->contratodosimetriasede_id}}">
                                    
                                    {{--///Filas creadas segun la cantidad de dosimetros tipo control asignados en EL MES ANTERIOR QUE CAMBIA SI SE MODIFICAN LAS CANTIDADES EN EL MODULO DE NOVEDADES/////// --}}
                                    @foreach($dosicontrolmesant as $dosicontrolant)
                                        <tr>
                                            <td colspan='2' class='align-middle'>CONTROL</td>
                                            <td class='align-middle'>
                                                <select class="form-select id_dosimetro_asigdosimControl"  name="id_dosimetro_asigdosimControl[]" id="id_dosimetro_asigdosimControl" @if($dosicontrolant->dosimetro_uso != 'FALSE') { disabled } @endif>
                                                    <option value="@if($dosicontrolant->dosimetro_uso != 'FALSE') {{$dosicontrolant->dosimetro_id}} @endif"> @if($dosicontrolant->dosimetro_uso != 'FALSE') {{$dosicontrolant->dosimetro->codigo_dosimeter}} @else ---- @endif</option>
                                                    @foreach($dosimLibresGeneral as $dosigenlib)
                                                        <option value="{{$dosigenlib->id_dosimetro}}">{{$dosigenlib->codigo_dosimeter}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td class='align-middle'>N.A.</td>
                                            <td>
                                                <select class="form-select ocupacion_asigdosimControl" name="ocupacion_asigdosimControl[]" id="ocupacion_asigdosimControl" style="text-transform:uppercase" @if($dosicontrolant->dosimetro_uso != 'FALSE') { disabled } @endif>
                                                    @if($dosicontrolant->dosimetro_uso != 'FALSE')
                                                        @if($dosicontrolant->ocupacion=='T')
                                                            <option selected hidden value="T">TELETERAPIA</option>
                                                            @elseif($dosicontrolant->ocupacion=='BQ')
                                                            <option selected hidden value="BQ">BRAQUITERAPIA</option>
                                                            @elseif($dosicontrolant->ocupacion=='MN')
                                                            <option selected hidden value="MN">MEDICINA NUCLEAR</option>
                                                            @elseif($dosicontrolant->ocupacion=='GM')
                                                            <option selected hidden value="GM">GAMAGRAFIA INDUSTRIAL</option>
                                                            @elseif($dosicontrolant->ocupacion=='MF')
                                                            <option selected hidden value="MF">MEDIDORES FIJOS</option>
                                                            @elseif($dosicontrolant->ocupacion=='IV')
                                                            <option selected hidden value="IV">INVESTIGACIÓN</option>
                                                            @elseif($dosicontrolant->ocupacion=='DN')
                                                            <option selected hidden value="DN">DENSÍMETRO NUCLEAR</option>
                                                            @elseif($dosicontrolant->ocupacion=='MM')
                                                            <option selected hidden value="MM">MEDIDORES MÓVILES</option>
                                                            @elseif($dosicontrolant->ocupacion=='E')
                                                            <option selected hidden value="E">DOCENCIA</option>
                                                            @elseif($dosicontrolant->ocupacion=='PR')
                                                            <option selected hidden value="PR">PERFILAJE Y REGISTRO</option>
                                                            @elseif($dosicontrolant->ocupacion=='TR')
                                                            <option selected hidden value="TR">TRAZADORES</option>
                                                            @elseif($dosicontrolant->ocupacion=='HD')
                                                            <option selected hidden value="HD">HEMODINAMIA</option>
                                                            @elseif($dosicontrolant->ocupacion=='OD')
                                                            <option selected hidden value="OD">RAYOS X ODONTOLÓGICO</option>
                                                            @elseif($dosicontrolant->ocupacion=='RX')
                                                            <option selected hidden value="RX">RADIODIAGNÓSTICO</option>
                                                            @elseif($dosicontrolant->ocupacion=='FL')
                                                            <option selected hidden value="FL">FLUOROSCOPÍA</option>
                                                            @elseif($dosicontrolant->ocupacion=='AM')
                                                            <option selected hidden value="AM">APLICACIONES MÉDICAS</option>
                                                            @elseif($dosicontrolant->ocupacion=='AI')
                                                            <option selected hidden value="AI">APLICACIONES INDUSTRIALES</option>
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
                                            <td></td>
                                        </tr>
                                    @endforeach
                                    {{-- ///Filas creadas SI LA CANTIDAD DE DOSIMETROS tipo CONTROL asignados ES MODIFICADA EN EL MES ACTUAL/////// --}}
                                    @if($mescontdosisededepto->mes_asignacion == $mesnumber || $mescontdosisededepto->mes_asignacion <= $mesnumber)
                                        @for($i=1; $i<=($mescontdosisededepto->dosi_control - count($dosicontrolmesant)); $i++)
                                            <tr>
                                                <td colspan='2' class='align-middle'>CONTROL</td>
                                                <td class='align-middle'>
                                                    <select class="form-select id_dosimetro_asigdosimControl"  name="id_dosimetro_asigdosimControl[]" id="id_dosimetro_asigdosimControl" autofocus aria-label="Floating label select example">
                                                        <option value="">----</option>
                                                        @foreach($dosimLibresGeneral as $dosigenlib)
                                                            <option value="{{$dosigenlib->id_dosimetro}}">{{$dosigenlib->codigo_dosimeter}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td class='align-middle'>N.A.</td>
                                                <td>
                                                    <select class="form-select ocupacion_asigdosimControl" name="ocupacion_asigdosimControl[]" id="ocupacion_asigdosimControl" autofocus style="text-transform:uppercase">
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
                                                <td></td>
                                            </tr>
                                        @endfor
                                    @endif
                                    {{-- ///FIN DE LA CREACION DE LAS Filas creadas SI LA CANTIDAD DE DOSIMETROS tipo  CONTROL/////// --}}
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
                                            <td>ÁREA</td>
                                            <td>
                                                <select class="form-select id_dosimetro_asigdosimArea"  name="id_dosimetro_asigdosimArea[]" id="id_dosimetro_asigdosimArea" @if($dosiareant->dosimetro_uso != 'FALSE') { disabled } @endif>
                                                    <option value="@if($dosiareant->dosimetro_uso != 'FALSE'){{$dosiareant->dosimetro_id}}@endif">@if($dosiareant->dosimetro_uso != 'FALSE'){{$dosiareant->dosimetro->codigo_dosimeter}} @else ---- @endif</option>
                                                    @foreach($dosimLibresAmbiental as $dosiamblib)
                                                        <option value="{{$dosiamblib->id_dosimetro}}">{{$dosiamblib->codigo_dosimeter}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>N.A</td>
                                            <td>
                                                <select class="form-select" name="ocupacion_asigdosimArea[]" id="ocupacion_asigdosimArea" style="text-transform:uppercase" @if($dosiareant->dosimetro_uso != 'FALSE') { disabled } @endif>
                                                    @if($dosiareant->dosimetro_uso != 'FALSE')
                                                        @if($dosiareant->ocupacion=='T')
                                                            <option selected hidden value="T">TELETERAPIA</option>
                                                            @elseif($dosiareant->ocupacion=='BQ')
                                                            <option selected hidden value="BQ">BRAQUITERAPIA</option>
                                                            @elseif($dosiareant->ocupacion=='MN')
                                                            <option selected hidden value="MN">MEDICINA NUCLEAR</option>
                                                            @elseif($dosiareant->ocupacion=='GM')
                                                            <option selected hidden value="GM">GAMAGRAFIA INDUSTRIAL</option>
                                                            @elseif($dosiareant->ocupacion=='MF')
                                                            <option selected hidden value="MF">MEDIDORES FIJOS</option>
                                                            @elseif($dosiareant->ocupacion=='IV')
                                                            <option selected hidden value="IV">INVESTIGACIÓN</option>
                                                            @elseif($dosiareant->ocupacion=='DN')
                                                            <option selected hidden value="DN">DENSÍMETRO NUCLEAR</option>
                                                            @elseif($dosiareant->ocupacion=='MM')
                                                            <option selected hidden value="MM">MEDIDORES MÓVILES</option>
                                                            @elseif($dosiareant->ocupacion=='E')
                                                            <option selected hidden value="E">DOCENCIA</option>
                                                            @elseif($dosiareant->ocupacion=='PR')
                                                            <option selected hidden value="PR">PERFILAJE Y REGISTRO</option>
                                                            @elseif($dosiareant->ocupacion=='TR')
                                                            <option selected hidden value="TR">TRAZADORES</option>
                                                            @elseif($dosiareant->ocupacion=='HD')
                                                            <option selected hidden value="HD">HEMODINAMIA</option>
                                                            @elseif($dosiareant->ocupacion=='OD')
                                                            <option selected hidden value="OD">RAYOS X ODONTOLÓGICO</option>
                                                            @elseif($dosiareant->ocupacion=='RX')
                                                            <option selected hidden value="RX">RADIODIAGNÓSTICO</option>
                                                            @elseif($dosiareant->ocupacion=='FL')
                                                            <option selected hidden value="FL">FLUOROSCOPÍA</option>
                                                            @elseif($dosiareant->ocupacion=='AM')
                                                            <option selected hidden value="AM">APLICACIONES MÉDICAS</option>
                                                            @elseif($dosiareant->ocupacion=='AI')
                                                            <option selected hidden value="AI">APLICACIONES INDUSTRIALES</option>
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
                                            <td>
                                                <button id="changeArea" class="btn colorQA"  type="button" onclick="changueArea('{{$dosiareant->areadepartamentosede_id}}');">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-x" viewBox="0 0 16 16">
                                                        <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                                                        <path fill-rule="evenodd" d="M12.146 5.146a.5.5 0 0 1 .708 0L14 6.293l1.146-1.147a.5.5 0 0 1 .708.708L14.707 7l1.147 1.146a.5.5 0 0 1-.708.708L14 7.707l-1.146 1.147a.5.5 0 0 1-.708-.708L13.293 7l-1.147-1.146a.5.5 0 0 1 0-.708z"/>
                                                    </svg>
                                                </button>
                                            </td>
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
                                                <td>ÁREA</td>
                                                <td>
                                                    <select class="form-select id_dosimetro_asigdosimArea"  name="id_dosimetro_asigdosimArea[]" id="id_dosimetro_asigdosimArea" autofocus aria-label="Floating label select example">
                                                        <option value="">----</option>
                                                        @foreach($dosimLibresAmbiental as $dosiamblib)
                                                            <option value="{{$dosiamblib->id_dosimetro}}">{{$dosiamblib->codigo_dosimeter}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>N.A</td>
                                                <td>
                                                    <select class="form-select" name="ocupacion_asigdosimArea[]" id="ocupacion_asigdosimArea" autofocus style="text-transform:uppercase">
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
                                                <td>
                                                    <button id="changeArea" class="btn colorQA"  type="button" onclick="changueArea('{{$dosiareant->areadepartamentosede_id}}');">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-x" viewBox="0 0 16 16">
                                                            <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                                                            <path fill-rule="evenodd" d="M12.146 5.146a.5.5 0 0 1 .708 0L14 6.293l1.146-1.147a.5.5 0 0 1 .708.708L14.707 7l1.147 1.146a.5.5 0 0 1-.708.708L14 7.707l-1.146 1.147a.5.5 0 0 1-.708-.708L13.293 7l-1.147-1.146a.5.5 0 0 1 0-.708z"/>
                                                        </svg>
                                                    </button>
                                                </td>
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
                                            <td>CASO</td>
                                            <td>
                                                <select class="form-select"  name="id_dosimetro_asigdosimCaso[]" id="id_dosimetro_asigdosimCaso" @if($dosicasoant->dosimetro_uso != 'FALSE') { disabled } @endif>
                                                    <option value="@if($dosicasoant->dosimetro_uso != 'FALSE') {{$dosicasoant->dosimetro_id}} @endif">@if($dosicasoant->dosimetro_uso != 'FALSE') {{$dosicasoant->dosimetro->codigo_dosimeter}} @else ---- @endif</option>
                                                    @foreach($dosimLibresGeneral as $dosigenlib)
                                                        <option value="{{$dosigenlib->id_dosimetro}}">{{$dosigenlib->codigo_dosimeter}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>N.A</td>
                                            <td>
                                                <select class="form-select" name="ocupacion_asigdosimCaso[]" id="ocupacion_asigdosimCaso" style="text-transform:uppercase" @if($dosicasoant->dosimetro_uso != 'FALSE') { disabled } @endif>
                                                    @if($dosicasoant->dosimetro_uso != 'FALSE')
                                                        @if($dosicasoant->ocupacion=='T')
                                                            <option selected hidden value="T">TELETERAPIA</option>
                                                            @elseif($dosicasoant->ocupacion=='BQ')
                                                            <option selected hidden value="BQ">BRAQUITERAPIA</option>
                                                            @elseif($dosicasoant->ocupacion=='MN')
                                                            <option selected hidden value="MN">MEDICINA NUCLEAR</option>
                                                            @elseif($dosicasoant->ocupacion=='GM')
                                                            <option selected hidden value="GM">GAMAGRAFIA INDUSTRIAL</option>
                                                            @elseif($dosicasoant->ocupacion=='MF')
                                                            <option selected hidden value="MF">MEDIDORES FIJOS</option>
                                                            @elseif($dosicasoant->ocupacion=='IV')
                                                            <option selected hidden value="IV">INVESTIGACIÓN</option>
                                                            @elseif($dosicasoant->ocupacion=='DN')
                                                            <option selected hidden value="DN">DENSÍMETRO NUCLEAR</option>
                                                            @elseif($dosicasoant->ocupacion=='MM')
                                                            <option selected hidden value="MM">MEDIDORES MÓVILES</option>
                                                            @elseif($dosicasoant->ocupacion=='E')
                                                            <option selected hidden value="E">DOCENCIA</option>
                                                            @elseif($dosicasoant->ocupacion=='PR')
                                                            <option selected hidden value="PR">PERFILAJE Y REGISTRO</option>
                                                            @elseif($dosicasoant->ocupacion=='TR')
                                                            <option selected hidden value="TR">TRAZADORES</option>
                                                            @elseif($dosicasoant->ocupacion=='HD')
                                                            <option selected hidden value="HD">HEMODINAMIA</option>
                                                            @elseif($dosicasoant->ocupacion=='OD')
                                                            <option selected hidden value="OD">RAYOS X ODONTOLÓGICO</option>
                                                            @elseif($dosicasoant->ocupacion=='RX')
                                                            <option selected hidden value="RX">RADIODIAGNÓSTICO</option>
                                                            @elseif($dosicasoant->ocupacion=='FL')
                                                            <option selected hidden value="FL">FLUOROSCOPÍA</option>
                                                            @elseif($dosicasoant->ocupacion=='AM')
                                                            <option selected hidden value="AM">APLICACIONES MÉDICAS</option>
                                                            @elseif($dosicasoant->ocupacion=='AI')
                                                            <option selected hidden value="AI">APLICACIONES INDUSTRIALES</option>
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
                                            <td>
                                                <button id="changeCaso" class="btn btn-danger"  type="button" onclick="changueCaso('{{$dosicasoant->persona_id}}');">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-x" viewBox="0 0 16 16">
                                                        <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                                                        <path fill-rule="evenodd" d="M12.146 5.146a.5.5 0 0 1 .708 0L14 6.293l1.146-1.147a.5.5 0 0 1 .708.708L14.707 7l1.147 1.146a.5.5 0 0 1-.708.708L14 7.707l-1.146 1.147a.5.5 0 0 1-.708-.708L13.293 7l-1.147-1.146a.5.5 0 0 1 0-.708z"/>
                                                    </svg>
                                                </button>
                                            </td>
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
                                                <td>CASO</td>
                                                <td>
                                                    <select class="form-select"  name="id_dosimetro_asigdosimCaso[]" id="id_dosimetro_asigdosimCaso" autofocus aria-label="Floating label select example">
                                                        <option value="">----</option>
                                                        @foreach($dosimLibresGeneral as $dosigenlib)
                                                            <option value="{{$dosigenlib->id_dosimetro}}">{{$dosigenlib->codigo_dosimeter}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>N.A</td>
                                                <td>
                                                    <select class="form-select" name="ocupacion_asigdosimCaso[]" id="ocupacion_asigdosimCaso" autofocus style="text-transform:uppercase">
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
                                                <td>
                                                    <button id="changeCaso" class="btn btn-danger"  type="button" onclick="changueCaso('{{$dosicasoant->persona_id}}');">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-x" viewBox="0 0 16 16">
                                                            <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                                                            <path fill-rule="evenodd" d="M12.146 5.146a.5.5 0 0 1 .708 0L14 6.293l1.146-1.147a.5.5 0 0 1 .708.708L14.707 7l1.147 1.146a.5.5 0 0 1-.708.708L14 7.707l-1.146 1.147a.5.5 0 0 1-.708-.708L13.293 7l-1.147-1.146a.5.5 0 0 1 0-.708z"/>
                                                        </svg>
                                                    </button>
                                                </td>
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
                                            <td>TÓRAX</td>
                                            <td>
                                                <select class="form-select"  name="id_dosimetro_asigdosimTorax[]" id="id_dosimetro_asigdosimTorax" @if($dositoraxant->dosimetro_uso != 'FALSE') { disabled } @endif>
                                                    <option value="@if($dositoraxant->dosimetro_uso != 'FALSE') {{$dositoraxant->dosimetro_id}}@endif">@if($dositoraxant->dosimetro_uso != 'FALSE') {{$dositoraxant->dosimetro->codigo_dosimeter}} @else ---- @endif</option>
                                                    @foreach($dosimLibresGeneral as $dosigenlib)
                                                        <option value="{{$dosigenlib->id_dosimetro}}">{{$dosigenlib->codigo_dosimeter}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>N.A</td>
                                            <td>
                                                <select class="form-select" name="ocupacion_asigdosimTorax[]" id="ocupacion_asigdosimTorax" style="text-transform:uppercase" @if($dositoraxant->dosimetro_uso != 'FALSE') { disabled } @endif>
                                                    @if($dositoraxant->dosimetro_uso != 'FALSE')
                                                        @if($dositoraxant->ocupacion=='T')
                                                            <option selected hidden value="T">TELETERAPIA</option>
                                                            @elseif($dositoraxant->ocupacion=='BQ')
                                                            <option selected hidden value="BQ">BRAQUITERAPIA</option>
                                                            @elseif($dositoraxant->ocupacion=='MN')
                                                            <option selected hidden value="MN">MEDICINA NUCLEAR</option>
                                                            @elseif($dositoraxant->ocupacion=='GM')
                                                            <option selected hidden value="GM">GAMAGRAFIA INDUSTRIAL</option>
                                                            @elseif($dositoraxant->ocupacion=='MF')
                                                            <option selected hidden value="MF">MEDIDORES FIJOS</option>
                                                            @elseif($dositoraxant->ocupacion=='IV')
                                                            <option selected hidden value="IV">INVESTIGACIÓN</option>
                                                            @elseif($dositoraxant->ocupacion=='DN')
                                                            <option selected hidden value="DN">DENSÍMETRO NUCLEAR</option>
                                                            @elseif($dositoraxant->ocupacion=='MM')
                                                            <option selected hidden value="MM">MEDIDORES MÓVILES</option>
                                                            @elseif($dositoraxant->ocupacion=='E')
                                                            <option selected hidden value="E">DOCENCIA</option>
                                                            @elseif($dositoraxant->ocupacion=='PR')
                                                            <option selected hidden value="PR">PERFILAJE Y REGISTRO</option>
                                                            @elseif($dositoraxant->ocupacion=='TR')
                                                            <option selected hidden value="TR">TRAZADORES</option>
                                                            @elseif($dositoraxant->ocupacion=='HD')
                                                            <option selected hidden value="HD">HEMODINAMIA</option>
                                                            @elseif($dositoraxant->ocupacion=='OD')
                                                            <option selected hidden value="OD">RAYOS X ODONTOLÓGICO</option>
                                                            @elseif($dositoraxant->ocupacion=='RX')
                                                            <option selected hidden value="RX">RADIODIAGNÓSTICO</option>
                                                            @elseif($dositoraxant->ocupacion=='FL')
                                                            <option selected hidden value="FL">FLUOROSCOPÍA</option>
                                                            @elseif($dositoraxant->ocupacion=='AM')
                                                            <option selected hidden value="AM">APLICACIONES MÉDICAS</option>
                                                            @elseif($dositoraxant->ocupacion=='AI')
                                                            <option selected hidden value="AI">APLICACIONES INDUSTRIALES</option>
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
                                            <td>
                                                <button id="changeTorax" class="btn btn-danger"  type="button" onclick="changueTorax('{{$dositoraxant->persona_id}}');">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-x" viewBox="0 0 16 16">
                                                        <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                                                        <path fill-rule="evenodd" d="M12.146 5.146a.5.5 0 0 1 .708 0L14 6.293l1.146-1.147a.5.5 0 0 1 .708.708L14.707 7l1.147 1.146a.5.5 0 0 1-.708.708L14 7.707l-1.146 1.147a.5.5 0 0 1-.708-.708L13.293 7l-1.147-1.146a.5.5 0 0 1 0-.708z"/>
                                                    </svg>
                                                </button>
                                            </td>
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
                                                <td>TÓRAX</td>
                                                <td>
                                                    <select class="form-select"  name="id_dosimetro_asigdosimTorax[]" id="id_dosimetro_asigdosimTorax" autofocus aria-label="Floating label select example">
                                                        <option value="">----</option>
                                                        @foreach($dosimLibresGeneral as $dosigenlib)
                                                            <option value="{{$dosigenlib->id_dosimetro}}">{{$dosigenlib->codigo_dosimeter}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>N.A</td>
                                                <td>
                                                    <select class="form-select" name="ocupacion_asigdosimTorax[]" id="ocupacion_asigdosimTorax" autofocus style="text-transform:uppercase">
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
                                                <td>
                                                    <button id="changeTorax" class="btn btn-danger"  type="button" onclick="changueTorax('{{$dositoraxant->persona_id}}');">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-x" viewBox="0 0 16 16">
                                                            <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                                                            <path fill-rule="evenodd" d="M12.146 5.146a.5.5 0 0 1 .708 0L14 6.293l1.146-1.147a.5.5 0 0 1 .708.708L14.707 7l1.147 1.146a.5.5 0 0 1-.708.708L14 7.707l-1.146 1.147a.5.5 0 0 1-.708-.708L13.293 7l-1.147-1.146a.5.5 0 0 1 0-.708z"/>
                                                        </svg>
                                                    </button>
                                                </td>
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
                                            <td>CRISTALINO</td>
                                            <td>
                                                <select class="form-select"  name="id_dosimetro_asigdosimCristalino[]" id="id_dosimetro_asigdosimCristalino" @if($dosicristalinoant->dosimetro_uso != 'FALSE') { disabled } @endif>
                                                    <option value="@if($dosicristalinoant->dosimetro_uso != 'FALSE'){{$dosicristalinoant->dosimetro_id}}@endif">@if($dosicristalinoant->dosimetro_uso != 'FALSE'){{$dosicristalinoant->dosimetro->codigo_dosimeter}} @else ---- @endif</option>
                                                    @foreach($dosimLibresEzclip as $dosiezcliplib)
                                                        <option value="{{$dosiezcliplib->id_dosimetro}}">{{$dosiezcliplib->codigo_dosimeter}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <select class="form-select"  name="id_holder_asigdosimCristalino[]" id="id_holder_asigdosimCristalino" @if($dosicristalinoant->dosimetro_uso != 'FALSE') { disabled } @endif>
                                                    <option value="@if($dosicristalinoant->dosimetro_uso != 'FALSE'){{$dosicristalinoant->holder_id}}@endif">@if($dosicristalinoant->dosimetro_uso != 'FALSE'){{$dosicristalinoant->holder->codigo_holder}}@else ---- @endif</option>
                                                    @foreach($holderLibresCristalino as $holibcris)
                                                        <option value="{{$holibcris->id_holder}}">{{$holibcris->codigo_holder}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <select class="form-select" name="ocupacion_asigdosimCristalino[]" id="ocupacion_asigdosimCristalino" @if($dosicristalinoant->dosimetro_uso != 'FALSE') { disabled } @endif>
                                                    @if($dosicristalinoant->dosimetro_uso != 'FALSE')
                                                        @if($dosicristalinoant->ocupacion=='T')
                                                            <option selected hidden value="T">TELETERAPIA</option>
                                                            @elseif($dosicristalinoant->ocupacion=='BQ')
                                                            <option selected hidden value="BQ">BRAQUITERAPIA</option>
                                                            @elseif($dosicristalinoant->ocupacion=='MN')
                                                            <option selected hidden value="MN">MEDICINA NUCLEAR</option>
                                                            @elseif($dosicristalinoant->ocupacion=='GM')
                                                            <option selected hidden value="GM">GAMAGRAFIA INDUSTRIAL</option>
                                                            @elseif($dosicristalinoant->ocupacion=='MF')
                                                            <option selected hidden value="MF">MEDIDORES FIJOS</option>
                                                            @elseif($dosicristalinoant->ocupacion=='IV')
                                                            <option selected hidden value="IV">INVESTIGACIÓN</option>
                                                            @elseif($dosicristalinoant->ocupacion=='DN')
                                                            <option selected hidden value="DN">DENSÍMETRO NUCLEAR</option>
                                                            @elseif($dosicristalinoant->ocupacion=='MM')
                                                            <option selected hidden value="MM">MEDIDORES MÓVILES</option>
                                                            @elseif($dosicristalinoant->ocupacion=='E')
                                                            <option selected hidden value="E">DOCENCIA</option>
                                                            @elseif($dosicristalinoant->ocupacion=='PR')
                                                            <option selected hidden value="PR">PERFILAJE Y REGISTRO</option>
                                                            @elseif($dosicristalinoant->ocupacion=='TR')
                                                            <option selected hidden value="TR">TRAZADORES</option>
                                                            @elseif($dosicristalinoant->ocupacion=='HD')
                                                            <option selected hidden value="HD">HEMODINAMIA</option>
                                                            @elseif($dosicristalinoant->ocupacion=='OD')
                                                            <option selected hidden value="OD">RAYOS X ODONTOLÓGICO</option>
                                                            @elseif($dosicristalinoant->ocupacion=='RX')
                                                            <option selected hidden value="RX">RADIODIAGNÓSTICO</option>
                                                            @elseif($dosicristalinoant->ocupacion=='FL')
                                                            <option selected hidden value="FL">FLUOROSCOPÍA</option>
                                                            @elseif($dosicristalinoant->ocupacion=='AM')
                                                            <option selected hidden value="AM">APLICACIONES MÉDICAS</option>
                                                            @elseif($dosicristalinoant->ocupacion=='AI')
                                                            <option selected hidden value="AI">APLICACIONES INDUSTRIALES</option>
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
                                            <td>
                                                <button id="changeCristalino" class="btn btn-danger"  type="button" onclick="changueCristalino('{{$dosicristalinoant->persona_id}}');">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-x" viewBox="0 0 16 16">
                                                        <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                                                        <path fill-rule="evenodd" d="M12.146 5.146a.5.5 0 0 1 .708 0L14 6.293l1.146-1.147a.5.5 0 0 1 .708.708L14.707 7l1.147 1.146a.5.5 0 0 1-.708.708L14 7.707l-1.146 1.147a.5.5 0 0 1-.708-.708L13.293 7l-1.147-1.146a.5.5 0 0 1 0-.708z"/>
                                                    </svg>
                                                </button>
                                            </td>
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
                                                <td>CRISTALINO</td>
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
                                                <td>
                                                    <select class="form-select" name="ocupacion_asigdosimCristalino[]" id="ocupacion_asigdosimCristalino" autofocus style="text-transform:uppercase">
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
                                                <td>
                                                    <button id="changeCristalino" class="btn btn-danger"  type="button" onclick="changueCristalino('{{$dosicristalinoant->persona_id}}');">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-x" viewBox="0 0 16 16">
                                                            <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                                                            <path fill-rule="evenodd" d="M12.146 5.146a.5.5 0 0 1 .708 0L14 6.293l1.146-1.147a.5.5 0 0 1 .708.708L14.707 7l1.147 1.146a.5.5 0 0 1-.708.708L14 7.707l-1.146 1.147a.5.5 0 0 1-.708-.708L13.293 7l-1.147-1.146a.5.5 0 0 1 0-.708z"/>
                                                        </svg>
                                                    </button>
                                                </td>
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
                                            <td>MUÑECA</td>
                                            <td>
                                                <select class="form-select"  name="id_dosimetro_asigdosimMuneca[]" id="id_dosimetro_asigdosimMuneca" @if($dosimuñecant->dosimetro_uso != 'FALSE') { disabled } @endif>
                                                    <option value="@if($dosimuñecant->dosimetro_uso != 'FALSE'){{$dosimuñecant->dosimetro_id}}@endif">@if($dosimuñecant->dosimetro_uso != 'FALSE'){{$dosimuñecant->dosimetro->codigo_dosimeter}}@else ---- @endif</option>
                                                    @foreach($dosimLibresEzclip as $dosiezcliplib)
                                                        <option value="{{$dosiezcliplib->id_dosimetro}}">{{$dosiezcliplib->codigo_dosimeter}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <select class="form-select"  name="id_holder_asigdosimMuneca[]" id="id_holder_asigdosimMuneca" @if($dosimuñecant->dosimetro_uso != 'FALSE') { disabled } @endif>
                                                    <option value="@if($dosimuñecant->dosimetro_uso != 'FALSE'){{$dosimuñecant->holder_id}}@endif">@if($dosimuñecant->dosimetro_uso != 'FALSE'){{$dosimuñecant->holder->codigo_holder}}@else ---- @endif</option>
                                                    @foreach($holderLibresExtrem as $holibexm)
                                                        <option value="{{$holibexm->id_holder}}">{{$holibexm->codigo_holder}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <select class="form-select" name="ocupacion_asigdosimMuneca[]" id="ocupacion_asigdosimMuneca"  style="text-transform:uppercase" @if($dosimuñecant->dosimetro_uso != 'FALSE') { disabled } @endif>
                                                    @if($dosimuñecant->dosimetro_uso != 'FALSE')
                                                        @if($dosimuñecant->ocupacion=='T')
                                                            <option selected hidden value="T">TELETERAPIA</option>
                                                            @elseif($dosimuñecant->ocupacion=='BQ')
                                                            <option selected hidden value="BQ">BRAQUITERAPIA</option>
                                                            @elseif($dosimuñecant->ocupacion=='MN')
                                                            <option selected hidden value="MN">MEDICINA NUCLEAR</option>
                                                            @elseif($dosimuñecant->ocupacion=='GM')
                                                            <option selected hidden value="GM">GAMAGRAFIA INDUSTRIAL</option>
                                                            @elseif($dosimuñecant->ocupacion=='MF')
                                                            <option selected hidden value="MF">MEDIDORES FIJOS</option>
                                                            @elseif($dosimuñecant->ocupacion=='IV')
                                                            <option selected hidden value="IV">INVESTIGACIÓN</option>
                                                            @elseif($dosimuñecant->ocupacion=='DN')
                                                            <option selected hidden value="DN">DENSÍMETRO NUCLEAR</option>
                                                            @elseif($dosimuñecant->ocupacion=='MM')
                                                            <option selected hidden value="MM">MEDIDORES MÓVILES</option>
                                                            @elseif($dosimuñecant->ocupacion=='E')
                                                            <option selected hidden value="E">DOCENCIA</option>
                                                            @elseif($dosimuñecant->ocupacion=='PR')
                                                            <option selected hidden value="PR">PERFILAJE Y REGISTRO</option>
                                                            @elseif($dosimuñecant->ocupacion=='TR')
                                                            <option selected hidden value="TR">TRAZADORES</option>
                                                            @elseif($dosimuñecant->ocupacion=='HD')
                                                            <option selected hidden value="HD">HEMODINAMIA</option>
                                                            @elseif($dosimuñecant->ocupacion=='OD')
                                                            <option selected hidden value="OD">RAYOS X ODONTOLÓGICO</option>
                                                            @elseif($dosimuñecant->ocupacion=='RX')
                                                            <option selected hidden value="RX">RADIODIAGNÓSTICO</option>
                                                            @elseif($dosimuñecant->ocupacion=='FL')
                                                            <option selected hidden value="FL">FLUOROSCOPÍA</option>
                                                            @elseif($dosimuñecant->ocupacion=='AM')
                                                            <option selected hidden value="AM">APLICACIONES MÉDICAS</option>
                                                            @elseif($dosimuñecant->ocupacion=='AI')
                                                            <option selected hidden value="AI">APLICACIONES INDUSTRIALES</option>
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
                                            <td>
                                                <button id="changeMuneca" class="btn btn-danger"  type="button" onclick="changueMuneca('{{$dosimuñecant->persona_id}}');">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-x" viewBox="0 0 16 16">
                                                        <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                                                        <path fill-rule="evenodd" d="M12.146 5.146a.5.5 0 0 1 .708 0L14 6.293l1.146-1.147a.5.5 0 0 1 .708.708L14.707 7l1.147 1.146a.5.5 0 0 1-.708.708L14 7.707l-1.146 1.147a.5.5 0 0 1-.708-.708L13.293 7l-1.147-1.146a.5.5 0 0 1 0-.708z"/>
                                                    </svg>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    {{-- ///Filas creadas SI LA CANTIDAD DE DOSIMETROS tipo MUÑECA asignados ES MODIFICADA EN EL MES ACTUAL/////// --}}
                                    @if($mescontdosisededepto->mes_asignacion == $mesnumber || $mescontdosisededepto->mes_asignacion <= $mesnumber)
                                        @for($i=1; $i<=($mescontdosisededepto->dosi_muñeca - count($dosimuñecamesant)); $i++)
                                            <tr>
                                                <td>
                                                    <select class="form-select"  name="id_trabajador_asigdosimMuneca[]" id="id_trabajador_asigdosimMuneca" autofocus aria-label="Floating label select example">
                                                        <option value="">----</option>
                                                        {{-- @foreach($trabajadoreSede as $trabsed)
                                                            <option value="{{$trabsed->trabajador->id_trabajador}}">{{$trabsed->trabajador->primer_nombre_trabajador}} {{$trabsed->trabajador->segundo_nombre_trabajador}} {{$trabsed->trabajador->primer_apellido_trabajador}} {{$trabsed->trabajador->segundo_apellido_trabajador}}</option>
                                                        @endforeach --}}
                                                        @foreach($personaSede as $persed)
                                                            <option value="{{$persed->id_persona}}">{{$persed->primer_nombre_persona}} {{$persed->segundo_nombre_persona}} {{$persed->primer_apellido_persona}} {{$persed->segundo_apellido_persona}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>MUÑECA</td>
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
                                                <td>
                                                    <select class="form-select" name="ocupacion_asigdosimMuneca[]" id="ocupacion_asigdosimMuneca" autofocus style="text-transform:uppercase">
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
                                                <td>
                                                    <button id="changeMuneca" class="btn btn-danger"  type="button" onclick="changueMuneca('{{$dosimuñecant->persona_id}}');">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-x" viewBox="0 0 16 16">
                                                            <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                                                            <path fill-rule="evenodd" d="M12.146 5.146a.5.5 0 0 1 .708 0L14 6.293l1.146-1.147a.5.5 0 0 1 .708.708L14.707 7l1.147 1.146a.5.5 0 0 1-.708.708L14 7.707l-1.146 1.147a.5.5 0 0 1-.708-.708L13.293 7l-1.147-1.146a.5.5 0 0 1 0-.708z"/>
                                                        </svg>
                                                    </button>
                                                </td>
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
                                            <td>DEDO</td>
                                            <td>
                                                <select class="form-select"  name="id_dosimetro_asigdosimDedo[]" id="id_dosimetro_asigdosimDedo"  @if($dosidedoant->dosimetro_uso != 'FALSE') { disabled } @endif>
                                                    <option value="@if($dosidedoant->dosimetro_uso != 'FALSE'){{$dosidedoant->dosimetro_id}}@endif">@if($dosidedoant->dosimetro_uso != 'FALSE'){{$dosidedoant->dosimetro->codigo_dosimeter}}@else ---- @endif</option>
                                                    @foreach($dosimLibresEzclip as $dosiezcliplib)
                                                        <option value="{{$dosiezcliplib->id_dosimetro}}">{{$dosiezcliplib->codigo_dosimeter}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <select class="form-select"  name="id_holder_asigdosimDedo[]" id="id_holder_asigdosimDedo" @if($dosidedoant->dosimetro_uso != 'FALSE') { disabled } @endif >
                                                    <option value="@if($dosidedoant->dosimetro_uso != 'FALSE'){{$dosidedoant->holder_id}}@endif">@if($dosidedoant->dosimetro_uso != 'FALSE'){{$dosidedoant->holder->codigo_holder}}@else ---- @endif</option>
                                                    @foreach($holderLibresAnillo as $holibanillo)
                                                        <option value="{{$holibanillo->id_holder}}">{{$holibanillo->codigo_holder}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <select class="form-select" name="ocupacion_asigdosimDedo[]" id="ocupacion_asigdosipDedo" @if($dosidedoant->dosimetro_uso != 'FALSE') { disabled } @endif>
                                                    @if($dosidedoant->dosimetro_uso != 'FALSE')
                                                        @if($dosidedoant->ocupacion=='T')
                                                            <option selected hidden value="T">TELETERAPIA</option>
                                                            @elseif($dosidedoant->ocupacion=='BQ')
                                                            <option selected hidden value="BQ">BRAQUITERAPIA</option>
                                                            @elseif($dosidedoant->ocupacion=='MN')
                                                            <option selected hidden value="MN">MEDICINA NUCLEAR</option>
                                                            @elseif($dosidedoant->ocupacion=='GM')
                                                            <option selected hidden value="GM">GAMAGRAFIA INDUSTRIAL</option>
                                                            @elseif($dosidedoant->ocupacion=='MF')
                                                            <option selected hidden value="MF">MEDIDORES FIJOS</option>
                                                            @elseif($dosidedoant->ocupacion=='IV')
                                                            <option selected hidden value="IV">INVESTIGACIÓN</option>
                                                            @elseif($dosidedoant->ocupacion=='DN')
                                                            <option selected hidden value="DN">DENSÍMETRO NUCLEAR</option>
                                                            @elseif($dosidedoant->ocupacion=='MM')
                                                            <option selected hidden value="MM">MEDIDORES MÓVILES</option>
                                                            @elseif($dosidedoant->ocupacion=='E')
                                                            <option selected hidden value="E">DOCENCIA</option>
                                                            @elseif($dosidedoant->ocupacion=='PR')
                                                            <option selected hidden value="PR">PERFILAJE Y REGISTRO</option>
                                                            @elseif($dosidedoant->ocupacion=='TR')
                                                            <option selected hidden value="TR">TRAZADORES</option>
                                                            @elseif($dosidedoant->ocupacion=='HD')
                                                            <option selected hidden value="HD">HEMODINAMIA</option>
                                                            @elseif($dosidedoant->ocupacion=='OD')
                                                            <option selected hidden value="OD">RAYOS X ODONTOLÓGICO</option>
                                                            @elseif($dosidedoant->ocupacion=='RX')
                                                            <option selected hidden value="RX">RADIODIAGNÓSTICO</option>
                                                            @elseif($dosidedoant->ocupacion=='FL')
                                                            <option selected hidden value="FL">FLUOROSCOPÍA</option>
                                                            @elseif($dosidedoant->ocupacion=='AM')
                                                            <option selected hidden value="AM">APLICACIONES MÉDICAS</option>
                                                            @elseif($dosidedoant->ocupacion=='AI')
                                                            <option selected hidden value="AI">APLICACIONES INDUSTRIALES</option>
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
                                            <td>
                                                <button id="changeDedo" class="btn btn-danger"  type="button" onclick="changueDedo('{{$dosidedoant->persona_id}}');">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-x" viewBox="0 0 16 16">
                                                        <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                                                        <path fill-rule="evenodd" d="M12.146 5.146a.5.5 0 0 1 .708 0L14 6.293l1.146-1.147a.5.5 0 0 1 .708.708L14.707 7l1.147 1.146a.5.5 0 0 1-.708.708L14 7.707l-1.146 1.147a.5.5 0 0 1-.708-.708L13.293 7l-1.147-1.146a.5.5 0 0 1 0-.708z"/>
                                                    </svg>
                                                </button>
                                            </td>
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
                                                <td>DEDO</td>
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
                                                <td>
                                                    <select class="form-select" name="ocupacion_asigdosimDedo[]" id="ocupacion_asigdosipDedo" autofocus style="text-transform:uppercase">
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
                                                <td>
                                                    <button id="changeDedo" class="btn btn-danger"  type="button" onclick="changueDedo('{{$dosidedoant->persona_id}}');">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-x" viewBox="0 0 16 16">
                                                            <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                                                            <path fill-rule="evenodd" d="M12.146 5.146a.5.5 0 0 1 .708 0L14 6.293l1.146-1.147a.5.5 0 0 1 .708.708L14.707 7l1.147 1.146a.5.5 0 0 1-.708.708L14 7.707l-1.146 1.147a.5.5 0 0 1-.708-.708L13.293 7l-1.147-1.146a.5.5 0 0 1 0-.708z"/>
                                                        </svg>
                                                    </button>
                                                </td>
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
        let fecha = new Date("{{$contdosisededepto->contratodosimetriasede->dosimetriacontrato->fecha_inicio}}");
        /* fecha.setMinutes(fecha.getMinutes() + fecha.getTimezoneOffset()); */
        console.log(fecha);
        for($i=0; $i<=13; $i++){
            var r = new Date(new Date(fecha).setMonth(fecha.getMonth()+$i));
            var fechaesp = meses[r.getMonth()] + ' DE ' + r.getUTCFullYear();
            console.log(fechaesp); 
            if("{{$mesnumber}}" == $i){
                
                document.getElementById('mes{{$mesnumber}}').innerHTML = fechaesp;
            } 
        }
            
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
   

    function changueArea(area){
        
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
            title: 'DESEA CAMBIAR EL TRABAJADOR DE UN DOSÍMETRO TIPO "DEDO"?',
            text: "EL CAMPO A CAMBIAR SE HABILITARÁ, SELECCIONE EL TRABAJADOR NUEVO",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#1A9980',
            cancelButtonColor: '#d33',
            confirmButtonText: 'SI, SEGURO!'
        }).then((result) => {
            if (result.isConfirmed) {
                @foreach($dosidedomesant as $dedoant)
                    if('{{$dedoant->trabajador_id}}' == dedo){
                        $("#id_trabajador_asigdosimDedo{{$dedoant->trabajador_id}}").attr("disabled", false);
                        document.getElementById("id_trabajador_asigdosimDedo_mesant").remove();
                        
                    }
                @endforeach
            }
        })
    }

</script>

<script type="text/javascript">
    $(document).ready(function(){

        $('#limpiar_asig').click(function(e){
            e.preventDefault();
            Swal.fire({
                text: 'SEGURO QUE DESEA LIMPIAR LA INFORMACIÓN DE LAS ASIGNACIONES DEL MES ANTERIOR?',
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