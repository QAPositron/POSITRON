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
                PERÍODO {{$mesnumber}}
                @if($contdosisededepto->contratodosimetriasede->dosimetriacontrato->periodo_recambio == 'MENS')
                    ( <span>
                        @php  
                            $meses = ["01"=>'ENERO', "02"=>'FEBRERO', "03"=>'MARZO', "04"=>'ABRIL', "05"=>'MAYO', "06"=>'JUNIO', "07"=>'JULIO', "08"=>'AGOSTO', "09"=>'SEPTIEMBRE', "10"=>'OCTUBRE', "11"=>'NOVIEMBRE', "12"=>'DICIEMBRE'];
                            $fecha1 = $meses[date("m", strtotime($contdosisededepto->contratodosimetriasede->dosimetriacontrato->fecha_inicio))]." DE ".date("Y", strtotime($contdosisededepto->contratodosimetriasede->dosimetriacontrato->fecha_inicio));
                             
                            echo $fecha1;
                        @endphp
                    </span> )
                @elseif($contdosisededepto->contratodosimetriasede->dosimetriacontrato->periodo_recambio == 'TRIMS')
                    ( <span>
                        @php  
                            $meses = ["01"=>'ENERO', "02"=>'FEBRERO', "03"=>'MARZO', "04"=>'ABRIL', "05"=>'MAYO', "06"=>'JUNIO', "07"=>'JULIO', "08"=>'AGOSTO', "09"=>'SEPTIEMBRE', "10"=>'OCTUBRE', "11"=>'NOVIEMBRE', "12"=>'DICIEMBRE'];
                            $fecha1 = date("j",strtotime($contdosisededepto->contratodosimetriasede->dosimetriacontrato->fecha_inicio))." ".$meses[date("m", strtotime($contdosisededepto->contratodosimetriasede->dosimetriacontrato->fecha_inicio))]." DE ".date("Y", strtotime($contdosisededepto->contratodosimetriasede->dosimetriacontrato->fecha_inicio));
                            $fecha2_parcial =  date("j-m-Y",strtotime($contdosisededepto->contratodosimetriasede->dosimetriacontrato->fecha_inicio."+ 3 month"));
                            $fecha2_total = date("j-m-Y",strtotime($fecha2_parcial."- 1 days")); 
                            echo $fecha1." - ".date("j", strtotime($fecha2_total))." ".$meses[date("m", strtotime($fecha2_total))]." DE ".date("Y", strtotime($fecha2_total))
                        @endphp
                    </span> )
                @endif
                , ESP.: {{$contdosisededepto->departamentosede->departamento->nombre_departamento}} 
            </h3>
            <form action="{{route('asignadosicontratom1.save', ['asigdosicont'=> $contdosisededepto->id_contdosisededepto, 'mesnumber'=>$mesnumber])}}" method="POST"  id="form-nueva-asignacion" name="form-nueva-asignacion" class="form-nueva-asignacion m-4">
                @csrf
                
                {{-- <label class="text-center mx-5">INGRESE LA INFORMACIÓN CORRESPONDIENTE PARA REALIZAR LAS ASIGNACIONES QUE ESTAN PENDIENTES EN EL CONTRATO DE DOSIMETRÍA:</label> --}}
                
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
                                        <td class="text-center">{{$contdosisededepto->dosi_torax}}</td>
                                        <td class="text-center">{{$contdosisededepto->dosi_cristalino}}</td>
                                        <td class="text-center">{{$contdosisededepto->dosi_dedo}}</td>
                                        <td class="text-center">{{$contdosisededepto->dosi_muñeca}}</td>
                                        <td class="text-center">{{$contdosisededepto->dosi_area}}</td>
                                        <td class="text-center">{{$contdosisededepto->dosi_caso}}</td>
                                        <td class="text-center">{{$contdosisededepto->dosi_control_torax}}</td>
                                        <td class="text-center">{{$contdosisededepto->dosi_control_cristalino}}</td>
                                        <td class="text-center">{{$contdosisededepto->dosi_control_dedo}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md"></div>

                </div>
                 
                <div class="row g-2 mx-3">
                    <div class="col-md">
                        <div class="form-floating">
                            <input value="" type="date" class="form-control @error('primerDia_asigdosim') is-invalid @enderror" name="primerDia_asigdosim" id="primerDia_asigdosim" onchange="fechaultimodia();" >
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
                            <table class="table table-bordered" id="tablaAsignacionDosimetrosm1">
                                <thead class=" table-active text-center">
                                    <th style='width: 28.20%'>TRABAJADOR / ÁREA</th>
                                    <th style='width: 16.40%'>UBICACIÓN</th>
                                    <th style='width: 16.40%'>DOSÍMETRO</th>
                                    <th style='width: 16.40%'>HOLDER</th>
                                    <th style='width: 16.60%'>OCUPACIÓN</th>
                                </thead> 
                                <tbody>
                                    
                                    <input hidden name="mesNumber1" id="mesNumber1" value="{{$mesnumber}}">
                                    <input type="number" name="id_departamento_asigdosim" id="id_departamento_asigdosim" hidden value="{{$contdosisededepto->id_contdosisededepto}}">
                                    <input type="number" name="id_contrato_asigdosim_sede" id="id_contrato_asigdosim_sede" hidden value="{{$contdosisededepto->contratodosimetriasede_id}}">
                                        
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
                                            <td>
                                                <select class="form-select ocupacion_asigdosimControlTorax" name="ocupacion_asigdosimControlTorax[]" id="ocupacion_asigdosimControlTorax" autofocus style="text-transform:uppercase">
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
                                            <td>
                                                <select class="form-select ocupacion_asigdosimControlCristalino" name="ocupacion_asigdosimControlCristalino[]" id="ocupacion_asigdosimControlCristalino" autofocus style="text-transform:uppercase">
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
                                            <td>
                                                <select class="form-select ocupacion_asigdosimControlDedo" name="ocupacion_asigdosimControlDedo[]" id="ocupacion_asigdosimControlDedo" autofocus style="text-transform:uppercase">
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
                                                        @foreach($dosimLibresAmbiental as $dosiamblib)
                                                            <option value="{{$dosiamblib->id_dosimetro}}">{{$dosiamblib->codigo_dosimeter}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td class='align-middle text-center'>N.A</td>
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
                                            </tr>
                                        @endif
                                    @endfor  

                                    {{-- ///Filas creadas segun la cantidad de dosimetros tipo EXTREMIDAD  que falten por asignar en el primer mes/////// --}}
                                    @for($i=1; $i<=$contdosisededepto->dosi_muñeca; $i++)
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
                                            </tr>
                                        @endif
                                    @endfor 
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
        $('#ocupacion_asigdosimControlTorax').select2({width: "100%",});
        $('#id_dosimetro_asigdosimControlCristalino').select2({width: "100%",});
        $('#id_holder_asigdosimControlCristalino').select2({width: "100%",});
        $('#ocupacion_asigdosimControlCristalino').select2({width: "100%",});
        $('#id_dosimetro_asigdosimControlDedo').select2({width: "100%",});
        $('#id_holder_asigdosimControlDedo').select2({width: "100%",});
        $('#ocupacion_asigdosimControlDedo').select2({width: "100%",});
        
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

    });
    function fechaultimodia(){
        var fecha = document.getElementById("primerDia_asigdosim").value;
        var fecha_inicio = new Date(fecha);
        fecha_inicio.setMinutes(fecha_inicio.getMinutes() + fecha_inicio.getTimezoneOffset());
        alert(fecha_inicio);
        if('{{$contdosisededepto->contratodosimetriasede->dosimetriacontrato->periodo_recambio}}' == 'MENS'){
            var fecha_final_año = fecha_inicio.getFullYear();
            var mm = fecha_inicio.getMonth() + 2;
            var fecha_final_mes = (mm < 10 ? '0' : '')+mm;
            if(fecha_final_mes == 13){
                fecha_final_mes = '01' ;
            } 
            var dd = fecha_inicio.getDate();
            /* console.log(dd); */
            var fecha_final_dia = (dd < 10 ? '0' : '')+dd;
            var fecha_final = new Date(fecha_final_año+'-'+fecha_final_mes+'-'+fecha_final_dia);
            
            console.log(fecha_final);
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
            var mm = fecha_inicio.getMonth() + 4;
            var fecha_final_mes = (mm < 10 ? '0' : '')+mm;
            if(fecha_final_mes == 13){
                fecha_final_mes = '01' ;
            } 
            var dd = fecha_inicio.getDate();
            
          
            var fecha_final_dia = (dd < 10 ? '0' : '')+dd;
            var fecha_final = new Date(fecha_final_año+'-'+fecha_final_mes+'-'+fecha_final_dia);
            
            console.log(fecha_final);
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
            /////////////////////VALIDACION PARA LOS DOSIMETROS  /////////////////
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
            }
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
            }
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
            }


            var dosimArea = document.querySelectorAll('select[name="id_dosimetro_asigdosimArea[]"]');
            console.log("ESTAS SON LOS DOSIMTROS AREA");
            console.log(dosimArea);
            for(var i = 0; i < dosimArea.length; i++){
                var values = dosimArea[i].value;
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
            }
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
            }
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
            }
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
            }
            var dosimMuneca = document.querySelectorAll('select[name="id_dosimetro_asigdosimMuneca[]"]');
            console.log("ESTAS SON LOS DOSIMETROS MUÑECA");
            console.log(dosimMuneca);
            for(var i = 0; i < dosimMuneca.length; i++){
                var values = dosimMuneca[i].value;
                if(values == ''){
                    /* return alert("FALTA SELECCIONAR ALGUN TRABAJADOR"); */
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
            }

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
            var holMuneca = document.querySelectorAll('select[name="id_holder_asigdosimMuneca[]"]');
            console.log("ESTAS SON LOS HOLDERS DE ANILLO");
            console.log(holMuneca);
            for(var i = 0; i < holMuneca.length; i++) {
                var values = holMuneca[i].value;
                if(values == ''){
                    /* alert("FALTA SELECCIONAR ALGUN HOLDER"); */
                    return Swal.fire({
                                title:"FALTA SELECCIONAR ALGÚN HOLDER PARA DOSÍMETRO DE UBICACIÓN MUÑECA",
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
                                title:"FALTA SELECCIONAR ALGUNA OCUPACIÓN DE DOSIMETRO CONTROL",
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