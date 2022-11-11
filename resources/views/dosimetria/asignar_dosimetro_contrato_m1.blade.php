@extends('layouts.plantillabase')
@section('contenido')
<div class="row">
    <div class="col-md"></div>
    <div class="col-md-15">
        <div class="card text-dark bg-light">
            <br>
            <h2 class="text-center">ASIGNACIÓN DOSÍMETROS</h2>
            <h3 class="text-center" id="nueva_empresaModalLabel"> <br> <i>{{$contdosisededepto->contratodosimetriasede->sede->empresa->nombre_empresa}} - SEDE: {{$contdosisededepto->contratodosimetriasede->sede->nombre_sede}}</i> <br>
                MES {{$mesnumber}}
                ( <span>
                    @php  
                        $meses = ["01"=>'ENERO', "02"=>'FEBRERO', "03"=>'MARZO', "04"=>'ABRIL', "05"=>'MAYO', "06"=>'JUNIO', "07"=>'JULIO', "08"=>'AGOSTO', "09"=>'SEPTIEMBRE', "10"=>'OCTUBRE', "11"=>'NOVIEMBRE', "12"=>'DICIEMBRE'];
                        echo $meses[date("m", strtotime($contdosisededepto->contratodosimetriasede->dosimetriacontrato->fecha_inicio))]." DE ".date("Y", strtotime($contdosisededepto->contratodosimetriasede->dosimetriacontrato->fecha_inicio));
                    @endphp
                </span> ), ESPECIALIDAD: {{$contdosisededepto->departamentosede->departamento->nombre_departamento}} 
            </h3>
            <form action="{{route('asignadosicontratom1.save', ['asigdosicont'=> $contdosisededepto->id_contdosisededepto, 'mesnumber'=>$mesnumber])}}" method="POST"  id="form-nueva-asignacion" name="form-nueva-asignacion" class="form-nueva-asignacion m-4">
                @csrf
                
                {{-- <label class="text-center mx-5">INGRESE LA INFORMACIÓN CORRESPONDIENTE PARA REALIZAR LAS ASIGNACIONES QUE ESTAN PENDIENTES EN EL CONTRATO DE DOSIMETRÍA:</label> --}}
                
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
                                        <td class="text-center">{{$contdosisededepto->dosi_torax}}</td>
                                        <td class="text-center">{{$contdosisededepto->dosi_cristalino}}</td>
                                        <td class="text-center">{{$contdosisededepto->dosi_dedo}}</td>
                                        <td class="text-center">{{$contdosisededepto->dosi_muñeca}}</td>
                                        <td class="text-center">{{$contdosisededepto->dosi_control}}</td>
                                        <td class="text-center">{{$contdosisededepto->dosi_area}}</td>
                                        <td class="text-center">{{$contdosisededepto->dosi_caso}}</td>
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
                                        
                                    {{-- ///Filas creadas segun la cantidad de dosimetros tipo control DEL primer mes/////// --}}
                                    @for($i=1; $i<=$contdosisededepto->dosi_control; $i++)
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
                                                            {{-- @foreach($trabajadoreSede as $trabsed)
                                                                <option value="{{$trabsed->trabajador->id_trabajador}}">{{$trabsed->trabajador->primer_nombre_trabajador}} {{$trabsed->trabajador->segundo_nombre_trabajador}} {{$trabsed->trabajador->primer_apellido_trabajador}} {{$trabsed->trabajador->segundo_apellido_trabajador}}</option>
                                                            @endforeach --}}
                                                            @foreach($personaSede as $persed)
                                                                <option value="{{$persed->id_persona}}">{{$persed->primer_nombre_persona}} {{$persed->segundo_nombre_persona}} {{$persed->primer_apellido_persona}} {{$persed->segundo_apellido_persona}} - ({{$persed->nombre_rol}})</option>
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
                                                            {{-- @foreach($trabajadoreSede as $trabsed)
                                                                <option value="{{$trabsed->trabajador->id_trabajador}}">{{$trabsed->trabajador->primer_nombre_trabajador}} {{$trabsed->trabajador->segundo_nombre_trabajador}} {{$trabsed->trabajador->primer_apellido_trabajador}} {{$trabsed->trabajador->segundo_apellido_trabajador}}</option>
                                                            @endforeach --}}
                                                            @foreach($personaSede as $persed)
                                                                <option value="{{$persed->id_persona}}">{{$persed->primer_nombre_persona}} {{$persed->segundo_nombre_persona}} {{$persed->primer_apellido_persona}} {{$persed->segundo_apellido_persona}} - ({{$persed->nombre_rol}})</option>
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
                                                            {{-- @foreach($trabajadoreSede as $trabsed)
                                                                <option value="{{$trabsed->trabajador->id_trabajador}}">{{$trabsed->trabajador->primer_nombre_trabajador}} {{$trabsed->trabajador->segundo_nombre_trabajador}} {{$trabsed->trabajador->primer_apellido_trabajador}} {{$trabsed->trabajador->segundo_apellido_trabajador}}</option>
                                                            @endforeach --}}
                                                            @foreach($personaSede as $persed)
                                                                <option value="{{$persed->id_persona}}">{{$persed->primer_nombre_persona}} {{$persed->segundo_nombre_persona}} {{$persed->primer_apellido_persona}} {{$persed->segundo_apellido_persona}}- ({{$persed->nombre_rol}})</option>
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
                                                            {{-- @foreach($trabajadoreSede as $trabsed)
                                                                <option value="{{$trabsed->trabajador->id_trabajador}}">{{$trabsed->trabajador->primer_nombre_trabajador}} {{$trabsed->trabajador->segundo_nombre_trabajador}} {{$trabsed->trabajador->primer_apellido_trabajador}} {{$trabsed->trabajador->segundo_apellido_trabajador}}</option>
                                                            @endforeach --}}
                                                            @foreach($personaSede as $persed)
                                                                <option value="{{$persed->id_persona}}">{{$persed->primer_nombre_persona}} {{$persed->segundo_nombre_persona}} {{$persed->primer_apellido_persona}} {{$persed->segundo_apellido_persona}} - ({{$persed->nombre_rol}})</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>ANILLO</td>
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
        $('#id_dosimetro_asigdosimControl').select2();
        $('#ocupacion_asigdosimControl').select2();
        $('#id_area_asigdosimArea').select2();
        $('#id_dosimetro_asigdosimArea').select2();
        $('#ocupacion_asigdosimArea').select2();
        document.getElementById("primerDia_asigdosim").value = '{{$contdosisededepto->contratodosimetriasede->dosimetriacontrato->fecha_inicio}}';

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
        }
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
        }
    };
</script>

<script type="text/javascript">
    $(document).ready(function(){
        $('#form-nueva-asignacion').submit(function(e){
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