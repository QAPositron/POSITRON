@extends('layouts.plantillabase')
@section('contenido')
<div class="row">
    <div class="col"></div>
    <div class="col-15">
        <div class="card text-dark bg-light">
            <h2 class="text-center mt-3">ASIGNAR DOSÍMETRO</h2>
            <h3 class="text-center">PERÍODO {{ Request()->mesnumber  }} </h3>
            <h3 class="text-center">DEPARTAMENTO {{ $contdosisededepto->departamentosede->nombre_departamento }} </h3>
            
            <form class="m-4" action="{{route('asignadosicontrato.save')}}" method="POST">
                @csrf
                <input hidden name="mesNumber1" id="mesNumber1" value="{{ Request()->mesnumber  }}" />
                <div class="row g-2 mx-3">
                    <div class="col-md">
                        <div class="form-floating ">
                            <input type="text" class="form-control" name="id_empresa_asigdosim" id="id_empresa_asigdosim" value="{{ $contdosisededepto->contratodosimetriasede->sede->empresa->id_empresa}}" hidden>
                            <input type="text" class="form-control" name="nombre_empresa_asigdosim" id="nombre_empresa_asigdosim" value="{{$contdosisededepto->contratodosimetriasede->sede->empresa->nombre_empresa}}" readonly>
                            <label for="floatingSelectGrid">EMPRESA:</label>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-floating">
                            <input type="text" class="form-control" name="id_sede_asigdosim" id="id_sede_asigdosim" value="{{$contdosisededepto->contratodosimetriasede->sede->id_sede}}" hidden>
                            <input type="text" class="form-control" name="nombre_sede_asigdosim" id="nombre_sede_asigdosim" value="{{$contdosisededepto->contratodosimetriasede->sede->nombre_sede}}" readonly>
                            <label for="floatingSelectGrid">SEDE:</label>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row g-2 mx-3">
                    <div class="col-md">
                        <div class="table table-responsive">
                            <table class="table table-sm table-bordered">
                                <thead class="text-center">
                                    <th colspan="4" style="font-size: 20px">CONTRATO No. {{$contdosisededepto->contratodosimetriasede->dosimetriacontrato->codigo_contrato}}</th>
                                </thead>
                                <tbody>
                                    <tr class="text-center">
                                        <th>DOSíMETROS</th>
                                        <th>CONTRATADOS</th>
                                        <th>ASIGNADOS</th>
                                        <th>PENDIENTES</th>
                                    </tr>
                                    <tr>
                                        <th>C. ENTERO:</th>
                                        <td class="text-center">{{$contdosisededepto->dosi_cuerpo_entero}}</td>
                                        <td class="text-center">{{$dosimetrosCuerpoEnteroAsignados + $dosimetroControlCuerpoAsignados}}</td>
                                        <td class="text-center">{{$contdosisededepto->dosi_cuerpo_entero - $dosimetrosCuerpoEnteroAsignados - $dosimetroControlCuerpoAsignados}}</td>
                                    </tr>
                                    <tr>
                                        <th>AMBIENTE:</th>
                                        <td class="text-center">{{$contdosisededepto->dosi_ambiental}}</td>
                                        <td class="text-center">{{$dosimetrosAmbienteAsignados + $dosimetrosControlAmbientalAsignados}}</td>
                                        <td class="text-center">{{$contdosisededepto->dosi_ambiental - $dosimetrosAmbienteAsignados - $dosimetrosControlAmbientalAsignados}}</td>
                                    </tr>
                                    <tr>
                                        <th>CONTROL:</th>
                                        <td class="text-center">{{$contdosisededepto->dosi_control}}</td>
                                        <td class="text-center">{{$dosimetrosControlAsignados}}</td>
                                        <td class="text-center">{{$contdosisededepto->dosi_control - $dosimetrosControlAsignados}}</td>
                                    </tr>
                                    <tr>
                                        <th>EzCLIP:</th>
                                        <td class="text-center">{{$contdosisededepto->dosi_ezclip}}</td>
                                        <td class="text-center">
                                            {{$dosimetrosEzClipAsignados}}
                                        </td>
                                        <td class="text-center">
                                            {{$contdosisededepto->dosi_ezclip - $dosimetrosEzClipAsignados}}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row g-2 mx-3">
                    <div class="col-md">
                        <div class="form-floating">
                            @if(count($dosimetrosControl)>0)
                                <input disabled value="{{$dosimetrosControl[0]['primer_dia_uso']}}" type="date" class="form-control @error('primerDia_asigdosim') is-invalid @enderror" name="primerDia_asigdosim" id="primerDia_asigdosim" >
                                <label for="floatingInputGrid">PRIMER DÍA</label>
                                @error('primerDia_asigdosim')
                                    <small class="invalid-feedback">*{{$message}}</small>
                                @enderror
                            @else
                                <input type="date" class="form-control @error('primerDia_asigdosim') is-invalid @enderror" name="primerDia_asigdosim" id="primerDia_asigdosim" >
                                <label for="floatingInputGrid">PRIMER DÍA</label>
                                @error('primerDia_asigdosim')
                                    <small class="invalid-feedback">*{{$message}}</small>
                                @enderror
                            @endif
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-floating">
                            @if(count($dosimetrosControl)>0)
                                <input disabled value="{{$dosimetrosControl[0]['ultimo_dia_uso']}}" type="date" class="form-control @error('ultimoDia_asigdosim') is-invalid @enderror" name="ultimoDia_asigdosim" id="ultimoDia_asigdosim" >
                                <label for="floatingInputGrid">ULTIMO DÍA:</label>
                                @error('ultimoDia_asigdosim')
                                    <small class="invalid-feedback">*{{$message}}</small>
                                @enderror
                            @else
                                <input type="date" class="form-control @error('ultimoDia_asigdosim') is-invalid @enderror" name="ultimoDia_asigdosim" id="ultimoDia_asigdosim" >
                                <label for="floatingInputGrid">ULTIMO DÍA:</label>
                                @error('ultimoDia_asigdosim')
                                    <small class="invalid-feedback">*{{$message}}</small>
                                @enderror
                            @endif
                        </div>
                    </div>
                </div>
                <br>
                <div class="row g-2 mx-3">
                    <div class="col-md">
                        <div class="form-floating">
                            <input type="date" class="form-control @error('fecha_envio_dosim_asignado') is-invalid @enderror" name="fecha_envio_dosim_asignado" id="fecha_envio_dosim_asignado" >
                            <label for="floatingInputGrid">FECHA ENVIO</label>
                            @error('fecha_envio_dosim_asignado')
                                <small class="invalid-feedback">*{{$message}}</small>
                            @enderror
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
                            <br>
                            <table class="table table-bordered" id="tablaDosimetros">
                                <thead class="text-center">
                                    <th>NOMBRES</th>
                                    <th>APELLIDOS</th>
                                    <th style='width: 10.20%'>No. IDEN.</th>
                                    <th style='width: 16.40%'>DOSÍMETRO</th>
                                    <th style='width: 16.40%'>HOLDER</th>
                                    <th style='width: 20.60%'>OCUPACIÓN</th>
                                    <th>ACCIONES</th>
                                </thead>    
                                <tbody> 
                                    @if (count($dosimetrosControl) > 0)
                                        @foreach($dosimetrosControl as $control)
                                            <tr>
                                                <td>
                                                    <input type="number" name="id_departamento_asigdosim_control" id="id_departamento_asigdosim_control" hidden value="{{$contdosisededepto->id_contdosisededepto}}">

                                                    <input type="number" name="id_contrato_asigdosim_control" id="id_contrato_asigdosim_control" hidden value="{{$contdosisededepto->id_contdosisededepto}}">
                                                    <input type="number" name="id_contrato_asigdosim_control_sede" id="id_contrato_asigdosim_control_sede" hidden value="{{$contdosisededepto->contratodosimetriasede_id}}">
                                                    N.A.
                                                </td>

                                                <td colspan="2">CONTROL</td>
                                                <td>
                                                    <select class="form-select" data-placeholder="Select" name="id_dosimetro_asigdosim_control[]" id="id_dosimetro_asigdosim_control{{$control->dosimetro_id}}" autofocus aria-label="Floating label select example">
                                                        @foreach($dosimetros as $dosi)
                                                            @if($control->dosimetro_id == $dosi->id_dosimetro)
                                                                <option selected  value ="{{$dosi->id_dosimetro}}">{{$dosi->codigo_dosimeter}} - {{$dosi->tipo_dosimetro}}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                    @error('id_dosimetro_asigdosim_control')
                                                        <small>*{{$message}}</small>
                                                    @enderror
                                                </td>
                                                <td class="text-center">N.A.</td>
                                                <td>
                                                    <select class="form-select" name="ocupacion_asigdosim_control[]" id="ocupacion_asigdosim_control{{$control->dosimetro_id}}" autofocus style="text-transform:uppercase">
                                                        @foreach($dosimetros as $dosi)
                                                            @if($control->ocupacion=='T' &&  $control->dosimetro_id == $dosi->id_dosimetro)
                                                                <option selected  value="T">TELETERAPIA</option>
                                                            @elseif($control->ocupacion=='B' &&  $control->dosimetro_id == $dosi->id_dosimetro)
                                                                <option selected  value="B">BRAQUITERAPIA</option>
                                                            @elseif($control->ocupacion=='N' &&  $control->dosimetro_id == $dosi->id_dosimetro)
                                                                <option selected  value="N">MEDICINA NUCLEAR</option>
                                                            @elseif($control->ocupacion=='G' &&  $control->dosimetro_id == $dosi->id_dosimetro)
                                                                <option selected  value="G">GAMAGRAFIA INDUSTRIAL</option>
                                                            @elseif($control->ocupacion=='F' &&  $control->dosimetro_id == $dosi->id_dosimetro)
                                                                <option selected  value="F">MEDIDORES FIJOS</option>
                                                            @elseif($control->ocupacion=='I' &&  $control->dosimetro_id == $dosi->id_dosimetro)
                                                                <option selected  value="I">INVESTIGACIÓN</option>
                                                            @elseif($control->ocupacion=='D' &&  $control->dosimetro_id == $dosi->id_dosimetro)
                                                                <option selected  value="D">DENSÍMETRO NUCLEAR</option>
                                                            @elseif($control->ocupacion=='M' && $control->dosimetro_id == $dosi->id_dosimetro)
                                                                <option selected  value="M">MEDIDORES MÓVILES</option>
                                                            @elseif($control->ocupacion=='E' && $control->dosimetro_id == $dosi->id_dosimetro)
                                                                <option selected  value="E">DOCENCIA</option>
                                                            @elseif($control->ocupacion=='P' && $control->dosimetro_id == $dosi->id_dosimetro)
                                                                <option selected  value="P">PERFILAJE Y REGISTRO</option>
                                                            @elseif($control->ocupacion=='TR' && $control->dosimetro_id == $dosi->id_dosimetro)
                                                                <option selected  value="T">TRAZADORES</option>
                                                            @elseif($control->ocupacion=='H' && $control->dosimetro_id == $dosi->id_dosimetro)
                                                                <option selected  value="H">HEMODINAMIA</option>
                                                            @elseif($control->ocupacion=='X' && $control->dosimetro_id == $dosi->id_dosimetro)
                                                                <option selected  value="X">RX PERIAPICALES</option>
                                                            @elseif($control->ocupacion=='R' && $control->dosimetro_id == $dosi->id_dosimetro)
                                                                <option selected  value="R">RADIODIAGNÓSTICO</option>
                                                            @elseif($control->ocupacion=='S' && $control->dosimetro_id == $dosi->id_dosimetro)
                                                                <option selected  value="S">FLUOROSCOPÍA</option>
                                                            @elseif($control->ocupacion=='AM' && $control->dosimetro_id == $dosi->id_dosimetro)
                                                                <option selected  value="AM">APLICACIONES MÉDICAS</option>
                                                            @elseif($control->ocupacion=='AI' && $control->dosimetro_id == $dosi->id_dosimetro)
                                                                <option selected  value="AI">APLICACIONES INDUSTRIALES</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                    @error('ocupacion_asigdosim_control')
                                                    <small>*{{$message}}</small>
                                                    @enderror
                                                </td>
                                                <td>
                                                    <button data-bs-toggle="modal" data-bs-target="#dosimetroControl{{$control->id_dosicontrolcontdosisedes}}" class="btn btn-danger btn-sm" type="button">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                                        </svg>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @elseif(count($dosimetrosControlAsignadosAnteriores)>0)
                                        @foreach($dosimetrosControlAsignadosAnteriores as $control)
                                            <tr>
                                                <td>
                                                    <input type="number" name="id_departamento_asigdosim_control" id="id_departamento_asigdosim_control" hidden value="{{$contdosisededepto->id_contdosisededepto}}">

                                                    <input type="number" name="id_contrato_asigdosim_control" id="id_contrato_asigdosim_control" hidden value="{{$contdosisededepto->id_contdosisededepto}}">
                                                    <input type="number" name="id_contrato_asigdosim_control_sede" id="id_contrato_asigdosim_control_sede" hidden value="{{$contdosisededepto->contratodosimetriasede_id }}">
                                                    N.A.
                                                </td>

                                                <td colspan="2">CONTROL</td>
                                                <td>
                                                    <select class="form-select" name="id_dosimetro_asigdosim_control[]" id="id_dosimetro_asigdosim_control{{$control->dosimetro_id}}"  autofocus aria-label="Floating label select example">
                                                        @foreach($dosimetros as $dosi)>

                                                        @if( $control->dosimetro_id == $dosi->id_dosimetro  )
                                                            <option selected  value ="{{$dosi->id_dosimetro}}">{{$dosi->codigo_dosimeter}} - {{$dosi->tipo_dosimetro}}</option>
                                                        @endif
                                                        @endforeach
                                                    </select>
                                                    @error('id_dosimetro_asigdosim_control')
                                                    <small>*{{$message}}</small>
                                                    @enderror
                                                </td>
                                                <td class="text-center">N.A.</td>
                                                <td>

                                                    <select class="form-select" name="ocupacion_asigdosim_control[]" id="ocupacion_asigdosim_control{{$control->dosimetro_id}}" autofocus style="text-transform:uppercase">
                                                        @foreach($dosimetros as $dosi)
                                                            @if($control->ocupacion=='T' &&  $control->dosimetro_id == $dosi->id_dosimetro)
                                                                <option selected  value="T">TELETERAPIA</option>
                                                            @elseif($control->ocupacion=='B' &&  $control->dosimetro_id == $dosi->id_dosimetro)
                                                                <option selected  value="B">BRAQUITERAPIA</option>
                                                            @elseif($control->ocupacion=='N' &&  $control->dosimetro_id == $dosi->id_dosimetro)
                                                                <option selected  value="N">MEDICINA NUCLEAR</option>
                                                            @elseif($control->ocupacion=='G' &&  $control->dosimetro_id == $dosi->id_dosimetro)
                                                                <option selected  value="G">GAMAGRAFIA INDUSTRIAL</option>
                                                            @elseif($control->ocupacion=='F' &&  $control->dosimetro_id == $dosi->id_dosimetro)
                                                                <option selected  value="F">MEDIDORES FIJOS</option>
                                                            @elseif($control->ocupacion=='I' &&  $control->dosimetro_id == $dosi->id_dosimetro)
                                                                <option selected  value="I">INVESTIGACIÓN</option>
                                                            @elseif($control->ocupacion=='D' &&  $control->dosimetro_id == $dosi->id_dosimetro)
                                                                <option selected  value="D">DENSÍMETRO NUCLEAR</option>
                                                            @elseif($control->ocupacion=='M' && $control->dosimetro_id == $dosi->id_dosimetro)
                                                                <option selected  value="M">MEDIDORES MÓVILES</option>
                                                            @elseif($control->ocupacion=='E' && $control->dosimetro_id == $dosi->id_dosimetro)
                                                                <option selected  value="E">DOCENCIA</option>
                                                            @elseif($control->ocupacion=='P' && $control->dosimetro_id == $dosi->id_dosimetro)
                                                                <option selected  value="P">PERFILAJE Y REGISTRO</option>
                                                            @elseif($control->ocupacion=='TR' && $control->dosimetro_id == $dosi->id_dosimetro)
                                                                <option selected  value="T">TRAZADORES</option>
                                                            @elseif($control->ocupacion=='H' && $control->dosimetro_id == $dosi->id_dosimetro)
                                                                <option selected  value="H">HEMODINAMIA</option>
                                                            @elseif($control->ocupacion=='X' && $control->dosimetro_id == $dosi->id_dosimetro)
                                                                <option selected  value="X">RX PERIAPICALES</option>
                                                            @elseif($control->ocupacion=='R' && $control->dosimetro_id == $dosi->id_dosimetro)
                                                                <option selected  value="R">RADIODIAGNÓSTICO</option>
                                                            @elseif($control->ocupacion=='S' && $control->dosimetro_id == $dosi->id_dosimetro)
                                                                <option selected  value="S">FLUOROSCOPÍA</option>
                                                            @elseif($control->ocupacion=='AM' && $control->dosimetro_id == $dosi->id_dosimetro)
                                                                <option selected  value="AM">APLICACIONES MÉDICAS</option>
                                                            @elseif($control->ocupacion=='AI' && $control->dosimetro_id == $dosi->id_dosimetro)
                                                                <option selected  value="AI">APLICACIONES INDUSTRIALES</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                    @error('ocupacion_asigdosim_control')
                                                    <small>*{{$message}}</small>
                                                    @enderror
                                                </td>
                                                <td>
                                                    <button data-bs-toggle="modal" data-bs-target="#dosimetroControl{{$control->id_dosicontrolcontdosisedes}}" class="btn btn-danger btn-sm" type="button">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                                        </svg>
                                                    </button>

                                                </td>

                                            </tr>

                                        @endforeach
                                    @else
                                        @for($i=0; $i<$contdosisededepto->dosi_control-count($dosimetrosControl); $i++)
                                            <tr>

                                                <td>
                                                    <input type="number" name="id_departamento_asigdosim_control" id="id_departamento_asigdosim_control" hidden value="{{$contdosisededepto->id_contdosisededepto}}">

                                                    <input type="number" name="id_contrato_asigdosim_control" id="id_contrato_asigdosim_control" hidden value="{{$contdosisededepto->id_contdosisededepto}}">
                                                    <input type="number" name="id_contrato_asigdosim_control_sede" id="id_contrato_asigdosim_control_sede" hidden value="{{$contdosisededepto->contratodosimetriasede_id }}">
                                                    N.A.
                                                </td>

                                                <td colspan="2">CONTROL</td>
                                                <td>
                                                    <?php $c=0; ?>
                                                    @if (count($dosimetrosControl) > 0)
                                                            <?php $c++; ?>
                                                    <select class="form-select" name="id_dosimetro_asigdosim_control[]" id="id_dosimetro_asigdosim_control{{$i}}"  autofocus aria-label="Floating label select example">
                                                        @foreach($dosimetrosControl as $control)
                                                        @foreach($dosimetros as $dosi)

                                                            @if( $control->dosimetro_id == $dosi->id_dosimetro && $i==$dosimetrosControl)
                                                            <option>{{$c}}</option>
                                                            <option selected  value ="{{$dosi->id_dosimetro}}">{{$dosi->codigo_dosimeter}} - {{$dosi->tipo_dosimetro}}</option>
                                                            @endif
                                                        @endforeach
                                                        @endforeach
                                                    </select>

                                                    @else
                                                        <select class="form-select" name="id_dosimetro_asigdosim_control[]" id="id_dosimetro_asigdosim_control{{$i}}"  autofocus aria-label="Floating label select example">
                                                            <option value ="">--</option>
                                                            <?php $cez=0; $cam=0; $cce=0; ?>
                                                            @foreach($dosimetros as $dosi)

                                                                @if($dosi->tipo_dosimetro == 'CONTROL' && $dosi->estado_dosimetro== 'STOCK' )
                                                                    <?php $cce++; ?>
                                                                <option value ="{{$dosi->id_dosimetro}}">{{$dosi->codigo_dosimeter}} - {{$dosi->tipo_dosimetro}}</option>
                                                                @endif
                                                            @endforeach

                                                        </select>
                                                    @endif


                                                    @error('id_dosimetro_asigdosim_control')
                                                        <small>*{{$message}}</small>
                                                    @enderror
                                                </td>
                                                <td class="text-center">N.A.</td>
                                                <td>
                                                    @if (count($dosimetrosControl) > 0)

                                                        <select class="form-select" name="ocupacion_asigdosim_control[]" id="ocupacion_asigdosim_control{{$control->dosimetro_id}}" autofocus style="text-transform:uppercase">
                                                            @foreach($dosimetrosControl as $control)
                                                                @if($control->ocupacion=='T')
                                                                    <option selected hidden value="T">TELETERAPIA</option>
                                                                    @elseif($control->ocupacion=='B')
                                                                    <option selected hidden value="B">BRAQUITERAPIA</option>
                                                                    @elseif($control->ocupacion=='N')
                                                                    <option selected hidden value="N">MEDICINA NUCLEAR</option>
                                                                    @elseif($control->ocupacion=='G')
                                                                    <option selected hidden value="G">GAMAGRAFIA INDUSTRIAL</option>
                                                                    @elseif($control->ocupacion=='F')
                                                                    <option selected hidden value="F">MEDIDORES FIJOS</option>
                                                                    @elseif($control->ocupacion=='I')
                                                                    <option selected hidden value="I">INVESTIGACIÓN</option>
                                                                    @elseif($control->ocupacion=='D')
                                                                    <option selected hidden value="D">DENSÍMETRO NUCLEAR</option>
                                                                    @elseif($control->ocupacion=='M')
                                                                    <option selected hidden value="M">MEDIDORES MÓVILES</option>
                                                                    @elseif($control->ocupacion=='E')
                                                                    <option selected hidden value="E">DOCENCIA</option>
                                                                    @elseif($control->ocupacion=='P')
                                                                    <option selected hidden value="P">PERFILAJE Y REGISTRO</option>
                                                                    @elseif($control->ocupacion=='T')
                                                                    <option selected hidden value="T">TRAZADORES</option>
                                                                    @elseif($control->ocupacion=='H')
                                                                    <option selected hidden value="H">HEMODINAMIA</option>
                                                                    @elseif($control->ocupacion=='RX')
                                                                    <option selected hidden value="X">RX PERIAPICALES</option>
                                                                    @elseif($control->ocupacion=='R')
                                                                    <option selected hidden value="R">RADIODIAGNÓSTICO</option>
                                                                    @elseif($control->ocupacion=='S')
                                                                    <option selected hidden value="S">FLUOROSCOPÍA</option>
                                                                    @elseif($control->ocupacion=='AM')
                                                                    <option selected hidden value="AM">APLICACIONES MÉDICAS</option>
                                                                    @elseif($control->ocupacion=='AI')
                                                                    <option selected hidden value="AI">APLICACIONES INDUSTRIALES</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    @else

                                                        <select class="form-select" name="ocupacion_asigdosim_control[]" id="ocupacion_asigdosim_control{{$i}}" autofocus style="text-transform:uppercase">
                                                            <option value="">--</option>
                                                            <option value="T">TELETERAPIA</option>
                                                            <option value="B">BRAQUITERAPIA</option>
                                                            <option value="N">MEDICINA NUCLEAR</option>
                                                            <option value="G">GAMAGRAFIA INDUSTRIAL</option>
                                                            <option value="F">MEDIDORES FIJOS</option>
                                                            <option value="I">INVESTIGACIÓN</option>
                                                            <option value="D">DENSÍMETRO NUCLEAR</option>
                                                            <option value="M">MEDIDORES MÓVILES</option>
                                                            <option value="E">DOCENCIA</option>
                                                            <option value="P">PERFILAJE Y REGISTRO</option>
                                                            <option value="T">TRAZADORES</option>
                                                            <option value="H">HEMODINAMIA</option>
                                                            <option value="X">RX PERIAPICALES</option>
                                                            <option value="R">RADIODIAGNÓSTICO</option>
                                                            <option value="S">FLUOROSCOPÍA</option>
                                                            <option value="AM">APLICACIONES MÉDICAS</option>
                                                            <option value="AI">APLICACIONES INDUSTRIALES</option>
                                                        </select>

                                                    @endif
                                                    @error('ocupacion_asigdosim_control')
                                                        <small>*{{$message}}</small>
                                                    @enderror
                                                </td>
                                                <td>
                                                    @foreach($dosimetrosControl as $control)

                                                    <button data-bs-toggle="modal" data-bs-target="#dosimetroControl{{$control->id_dosicontrolcontdosisedes}}" class="btn btn-danger btn-sm" type="button">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                                        </svg>
                                                    </button>

                                                </td>
                                                @endforeach
                                            </tr>
                                        @endfor
                                    @endif
                                    <?php $ct = 0; ?>

                                    @foreach($trabajadores as $trab)
                                        @if(Request()->mesnumber > 1)
                                        @foreach($trabajadoresAsignadosAntes as $trabAntes)
                                            @if($trab->trabajador->id_trabajador == $trabAntes->trabajador_id)
                                        <?php $ct++ ?>

                                        <tr id="trabajador{{$trab->trabajador->id_trabajador}}">
                                            <td>
                                                <input type="number" name="id_trabajador_asigdosim[]" id="id_trabajador_asigdosim" hidden value="{{$trab->trabajador->id_trabajador}}">
                                                <input type="number" name="id_contrato_asigdosim" id="id_contrato_asigdosim" hidden value="{{$contdosisededepto->id_contdosisededepto}}">
                                                <input type="number" name="id_contrato_asigdosim_sede" id="id_contrato_asigdosim_sede" hidden value="{{$contdosisededepto->contratodosimetriasede_id}}">
                                                {{$trab->trabajador->primer_nombre_trabajador}} {{$trab->trabajador->segundo_nombre_trabajador}}
                                            </td>
                                            <td>
                                                {{$trab->trabajador->primer_apellido_trabajador}} {{$trab->trabajador->segundo_apellido_trabajador}}
                                            </td>
                                            <td>{{$trab->trabajador->cedula_trabajador}}</td>
                                            <td>
                                                <select onChange="changeTest(this)" class="form-select" name="id_dosimetro_asigdosim[]" id="id_dosimetro_asigdosim{{$trab->trabajador->id_trabajador}}"  autofocus aria-label="Floating label select example" >
                                                    @if(count($dosimetrosTrabajadoresMes)>0)

                                                    @elseif(count($dosimetrosTrabajadores)>0)

                                                        @foreach($dosimetrosTrabajadores as $dosiT)
                                                            @foreach($dosimetrosDisponibles as $dosi)

                                                                @if($dosiT['dosimetro_id'] == $dosi['id_dosimetro'] && $trab->trabajador->id_trabajador == $dosiT->trabajador_id
                                                                                       && $dosiT->dosimetro_uso == 'TRUE')
                                                                    <option change="saveTypeDosi({{$dosi->tipo_dosimetro}})" value ="{{$dosi->id_dosimetro}}">{{$dosi->codigo_dosimeter}} - {{$dosi->tipo_dosimetro}}</option>
                                                                @endif

                                                            @endforeach
                                                        @endforeach

                                                    @else

                                                    <option value="">--</option>
                                                        @foreach($dosimetros as $dosi)
                                                            @if($dosi->tipo_dosimetro != 'CONTROL' && $dosi->estado_dosimetro== 'STOCK' )
                                                                <option change="saveTypeDosi({{$dosi->tipo_dosimetro}})" value ="{{$dosi->id_dosimetro}}">{{$dosi->codigo_dosimeter}} - {{$dosi->tipo_dosimetro}}</option>
                                                            @endif
                                                        @endforeach

                                                        @endif
                                                </select>
                                                @error('id_dosimetro_asigdosim')
                                                    <small>*{{$message}}</small>
                                                @enderror
                                            </td>
                                            <td>

                                                <select class="form-select" name="id_holder_asigdosim[]" id="id_holder_asigdosim{{$trab->trabajador->id_trabajador}}" autofocus aria-label="Floating label select example">
                                                    <option value ="">N.A.</option>
                                                    @if(count($dosimetrosTrabajadores)>0)

                                                        @foreach($dosimetrosTrabajadores as $dosiT)
                                                            @foreach($holdersDisponibles as $hol)

                                                                @if($dosiT['holder_id'] == $hol['id_holder'] && $trab->trabajador->id_trabajador == $dosiT->trabajador_id
                                                                            &&  $dosiT->dosimetro_uso == 'TRUE')
                                                                    <option selected  value ="{{$hol->id_holder}}"><?php echo $hol->codigo_holder.' - '.$hol->tipo_holder; ?></option>
                                                                    @endif

                                                            @endforeach
                                                    @endforeach

                                                    @else
                                                        <option value="">--</option>
                                                        @foreach($holders as $hol)
                                                            @if($hol->estado_holder=='STOCK')
                                                            <option value ="{{$hol->id_holder}}">{{$hol->codigo_holder}} - {{$hol->tipo_holder}}</option>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </select>
                                                @error('id_holder_asigdosim')
                                                    <small>*{{$message}}</small>
                                                @enderror
                                            </td>
                                            <td>
                                                @if(count($dosimetrosTrabajadores)>0)

                                                    <select class="form-select" name="ocupacion_asigdosim[]" id="ocupacion_asigdosim{{$trab->trabajador->id_trabajador}}" autofocus style="text-transform:uppercase">
                                                        @foreach($dosimetrosTrabajadores as $dosiT)
                                                        @if($dosiT->ocupacion=='T' && $trab->trabajador->id_trabajador == $dosiT->trabajador_id && $dosiT->dosimetro_uso == 'TRUE')
                                                        <option selected  value="T">TELETERAPIA</option>
                                                        @elseif($dosiT->ocupacion=='B' && $trab->trabajador->id_trabajador == $dosiT->trabajador_id && $dosiT->dosimetro_uso == 'TRUE')
                                                        <option selected  value="B">BRAQUITERAPIA</option>
                                                        @elseif($dosiT->ocupacion=='N' && $trab->trabajador->id_trabajador == $dosiT->trabajador_id && $dosiT->dosimetro_uso == 'TRUE')
                                                        <option selected  value="N">MEDICINA NUCLEAR</option>
                                                        @elseif($dosiT->ocupacion=='G' && $trab->trabajador->id_trabajador == $dosiT->trabajador_id && $dosiT->dosimetro_uso == 'TRUE')
                                                        <option selected  value="G">GAMAGRAFIA INDUSTRIAL</option>
                                                        @elseif($dosiT->ocupacion=='F' && $trab->trabajador->id_trabajador == $dosiT->trabajador_id && $dosiT->dosimetro_uso == 'TRUE')
                                                        <option selected  value="F">MEDIDORES FIJOS</option>
                                                        @elseif($dosiT->ocupacion=='I' && $trab->trabajador->id_trabajador == $dosiT->trabajador_id && $dosiT->dosimetro_uso == 'TRUE')
                                                        <option selected  value="I">INVESTIGACIÓN</option>
                                                        @elseif($dosiT->ocupacion=='D' && $trab->trabajador->id_trabajador == $dosiT->trabajador_id && $dosiT->dosimetro_uso == 'TRUE')
                                                        <option selected  value="D">DENSÍMETRO NUCLEAR</option>
                                                        @elseif($dosiT->ocupacion=='M' && $trab->trabajador->id_trabajador == $dosiT->trabajador_id && $dosiT->dosimetro_uso == 'TRUE')
                                                        <option selected  value="M">MEDIDORES MÓVILES</option>
                                                        @elseif($dosiT->ocupacion=='E' && $trab->trabajador->id_trabajador == $dosiT->trabajador_id && $dosiT->dosimetro_uso == 'TRUE')
                                                        <option selected  value="E">DOCENCIA</option>
                                                        @elseif($dosiT->ocupacion=='P' && $trab->trabajador->id_trabajador == $dosiT->trabajador_id && $dosiT->dosimetro_uso == 'TRUE')
                                                        <option selected  value="P">PERFILAJE Y REGISTRO</option>
                                                        @elseif($dosiT->ocupacion=='T' && $trab->trabajador->id_trabajador == $dosiT->trabajador_id && $dosiT->dosimetro_uso == 'TRUE')
                                                        <option selected  value="T">TRAZADORES</option>
                                                        @elseif($dosiT->ocupacion=='H' && $trab->trabajador->id_trabajador == $dosiT->trabajador_id && $dosiT->dosimetro_uso == 'TRUE')
                                                        <option selected  value="H">HEMODINAMIA</option>
                                                        @elseif($dosiT->ocupacion=='X' && $trab->trabajador->id_trabajador == $dosiT->trabajador_id && $dosiT->dosimetro_uso == 'TRUE')
                                                        <option selected  value="X">RX PERIAPICALES</option>
                                                        @elseif($dosiT->ocupacion=='R' && $trab->trabajador->id_trabajador == $dosiT->trabajador_id && $dosiT->dosimetro_uso == 'TRUE')
                                                        <option selected  value="R">RADIODIAGNÓSTICO</option>
                                                        @elseif($dosiT->ocupacion=='S' && $trab->trabajador->id_trabajador == $dosiT->trabajador_id && $dosiT->dosimetro_uso == 'TRUE')
                                                        <option selected  value="S">FLUOROSCOPÍA</option>
                                                        @elseif($dosiT->ocupacion=='AM' && $trab->trabajador->id_trabajador == $dosiT->trabajador_id && $dosiT->dosimetro_uso == 'TRUE')
                                                        <option selected  value="AM">APLICACIONES MÉDICAS</option>
                                                        @elseif($dosiT->ocupacion=='AI' && $trab->trabajador->id_trabajador == $dosiT->trabajador_id && $dosiT->dosimetro_uso == 'TRUE')
                                                        <option selected  value="AI">APLICACIONES INDUSTRIALES</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                    @error('ocupacion_asigdosim')
                                                    <small>*{{$message}}</small>
                                                    @enderror

                                                    @else
                                                    <select class="form-select" name="ocupacion_asigdosim[]" id="ocupacion_asigdosim{{$trab->trabajador->id_trabajador}}" autofocus style="text-transform:uppercase">
                                                        <option value="">--</option>
                                                        <option value="T">TELETERAPIA</option>
                                                        <option value="B">BRAQUITERAPIA</option>
                                                        <option value="N">MEDICINA NUCLEAR</option>
                                                        <option value="G">GAMAGRAFIA INDUSTRIAL</option>
                                                        <option value="F">MEDIDORES FIJOS</option>
                                                        <option value="I">INVESTIGACIÓN</option>
                                                        <option value="D">DENSÍMETRO NUCLEAR</option>
                                                        <option value="M">MEDIDORES MÓVILES</option>
                                                        <option value="E">DOCENCIA</option>
                                                        <option value="P">PERFILAJE Y REGISTRO</option>
                                                        <option value="T">TRAZADORES</option>
                                                        <option value="H">HEMODINAMIA</option>
                                                        <option value="X">RX PERIAPICALES</option>
                                                        <option value="R">RADIODIAGNÓSTICO</option>
                                                        <option value="S">FLUOROSCOPÍA</option>
                                                        <option value="AM">APLICACIONES MÉDICAS</option>
                                                        <option value="AI">APLICACIONES INDUSTRIALES</option>
                                                    </select>
                                                    @error('ocupacion_asigdosim')
                                                    <small>*{{$message}}</small>
                                                    @enderror
                                                    @endif

                                            </td>
                                            <td>
                                                <button data-bs-toggle="modal" data-bs-target="#dosimetros{{$trab->trabajador->id_trabajador}}" class="btn btn-danger btn-sm" type="button">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                                    </svg>
                                                </button>

                                                <button data-bs-toggle="modal" data-bs-target="#trabajadorDelete{{$trab->trabajador->id_trabajador}}" class="btn btn-danger btn-sm" type="button">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-x" viewBox="0 0 16 16">
                                                    <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                                                    <path fill-rule="evenodd" d="M12.146 5.146a.5.5 0 0 1 .708 0L14 6.293l1.146-1.147a.5.5 0 0 1 .708.708L14.707 7l1.147 1.146a.5.5 0 0 1-.708.708L14 7.707l-1.146 1.147a.5.5 0 0 1-.708-.708L13.293 7l-1.147-1.146a.5.5 0 0 1 0-.708z"/>
                                                </svg>
                                                </button>


                                            </td>
                                        </tr>


                                            @endif
                                    @endforeach

                                        @else
                                            <tr id="trabajador{{$trab->trabajador->id_trabajador}}">
                                                <td>
                                                    <input type="number" name="id_trabajador_asigdosim[]" id="id_trabajador_asigdosim" hidden value="{{$trab->trabajador->id_trabajador}}">
                                                    <input type="number" name="id_contrato_asigdosim" id="id_contrato_asigdosim" hidden value="{{$contdosisededepto->id_contdosisededepto}}">
                                                    <input type="number" name="id_contrato_asigdosim_sede" id="id_contrato_asigdosim_sede" hidden value="{{$contdosisededepto->contratodosimetriasede_id}}">
                                                    {{$trab->trabajador->primer_nombre_trabajador}} {{$trab->trabajador->segundo_nombre_trabajador}}
                                                </td>
                                                <td>
                                                    {{$trab->trabajador->primer_apellido_trabajador}} {{$trab->trabajador->segundo_apellido_trabajador}}
                                                </td>
                                                <td>{{$trab->trabajador->cedula_trabajador}}</td>
                                                <td>
                                                    <select onChange="changeTest(this)" class="form-select" name="id_dosimetro_asigdosim[]" id="id_dosimetro_asigdosim{{$trab->trabajador->id_trabajador}}"  autofocus aria-label="Floating label select example" >
                                                        @if(count($dosimetrosTrabajadoresMes)>0)

                                                        @elseif(count($dosimetrosTrabajadores)>0)

                                                            @foreach($dosimetrosTrabajadores as $dosiT)
                                                                @foreach($dosimetrosDisponibles as $dosi)

                                                                    @if($dosiT['dosimetro_id'] == $dosi['id_dosimetro'] && $trab->trabajador->id_trabajador == $dosiT->trabajador_id
                                                                                           && $dosiT->dosimetro_uso == 'TRUE')
                                                                        <option change="saveTypeDosi({{$dosi->tipo_dosimetro}})" value ="{{$dosi->id_dosimetro}}">{{$dosi->codigo_dosimeter}} - {{$dosi->tipo_dosimetro}}</option>
                                                                    @endif

                                                                @endforeach
                                                            @endforeach

                                                        @else

                                                            <option value="">--</option>
                                                            @foreach($dosimetros as $dosi)
                                                                @if($dosi->tipo_dosimetro != 'CONTROL' && $dosi->estado_dosimetro== 'STOCK' )
                                                                    <option change="saveTypeDosi({{$dosi->tipo_dosimetro}})" value ="{{$dosi->id_dosimetro}}">{{$dosi->codigo_dosimeter}} - {{$dosi->tipo_dosimetro}}</option>
                                                                @endif
                                                            @endforeach

                                                        @endif
                                                    </select>
                                                    @error('id_dosimetro_asigdosim')
                                                    <small>*{{$message}}</small>
                                                    @enderror
                                                </td>
                                                <td>

                                                    <select class="form-select" name="id_holder_asigdosim[]" id="id_holder_asigdosim{{$trab->trabajador->id_trabajador}}" autofocus aria-label="Floating label select example">
                                                        <option value ="">N.A.</option>
                                                        @if(count($dosimetrosTrabajadores)>0)

                                                            @foreach($dosimetrosTrabajadores as $dosiT)
                                                                @foreach($holdersDisponibles as $hol)

                                                                    @if($dosiT['holder_id'] == $hol['id_holder'] && $trab->trabajador->id_trabajador == $dosiT->trabajador_id
                                                                                &&  $dosiT->dosimetro_uso == 'TRUE')
                                                                        <option selected  value ="{{$hol->id_holder}}"><?php echo $hol->codigo_holder.' - '.$hol->tipo_holder; ?></option>
                                                                    @endif

                                                                @endforeach
                                                            @endforeach

                                                        @else
                                                            <option value="">--</option>
                                                            @foreach($holders as $hol)
                                                                @if($hol->estado_holder=='STOCK')
                                                                    <option value ="{{$hol->id_holder}}">{{$hol->codigo_holder}} - {{$hol->tipo_holder}}</option>
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                    @error('id_holder_asigdosim')
                                                    <small>*{{$message}}</small>
                                                    @enderror
                                                </td>
                                                <td>
                                                    @if(count($dosimetrosTrabajadores)>0)

                                                        <select class="form-select" name="ocupacion_asigdosim[]" id="ocupacion_asigdosim{{$trab->trabajador->id_trabajador}}" autofocus style="text-transform:uppercase">
                                                            @foreach($dosimetrosTrabajadores as $dosiT)
                                                                @if($dosiT->ocupacion=='T' && $trab->trabajador->id_trabajador == $dosiT->trabajador_id && $dosiT->dosimetro_uso == 'TRUE')
                                                                    <option selected  value="T">TELETERAPIA</option>
                                                                @elseif($dosiT->ocupacion=='B' && $trab->trabajador->id_trabajador == $dosiT->trabajador_id && $dosiT->dosimetro_uso == 'TRUE')
                                                                    <option selected  value="B">BRANQUITERAPIA</option>
                                                                @elseif($dosiT->ocupacion=='N' && $trab->trabajador->id_trabajador == $dosiT->trabajador_id && $dosiT->dosimetro_uso == 'TRUE')
                                                                    <option selected  value="N">MEDICINA NUCLEAR</option>
                                                                @elseif($dosiT->ocupacion=='G' && $trab->trabajador->id_trabajador == $dosiT->trabajador_id && $dosiT->dosimetro_uso == 'TRUE')
                                                                    <option selected  value="G">GAMAGRAFIA INDUSTRIAL</option>
                                                                @elseif($dosiT->ocupacion=='F' && $trab->trabajador->id_trabajador == $dosiT->trabajador_id && $dosiT->dosimetro_uso == 'TRUE')
                                                                    <option selected  value="F">MEDIDORES FIJOS</option>
                                                                @elseif($dosiT->ocupacion=='I' && $trab->trabajador->id_trabajador == $dosiT->trabajador_id && $dosiT->dosimetro_uso == 'TRUE')
                                                                    <option selected  value="I">INVESTIGACIÓN</option>
                                                                @elseif($dosiT->ocupacion=='D' && $trab->trabajador->id_trabajador == $dosiT->trabajador_id && $dosiT->dosimetro_uso == 'TRUE')
                                                                    <option selected  value="D">DENSÍMETRO NUCLEAR</option>
                                                                @elseif($dosiT->ocupacion=='M' && $trab->trabajador->id_trabajador == $dosiT->trabajador_id && $dosiT->dosimetro_uso == 'TRUE')
                                                                    <option selected  value="M">MEDIDORES MÓVILES</option>
                                                                @elseif($dosiT->ocupacion=='E' && $trab->trabajador->id_trabajador == $dosiT->trabajador_id && $dosiT->dosimetro_uso == 'TRUE')
                                                                    <option selected  value="E">DOCENCIA</option>
                                                                @elseif($dosiT->ocupacion=='P' && $trab->trabajador->id_trabajador == $dosiT->trabajador_id && $dosiT->dosimetro_uso == 'TRUE')
                                                                    <option selected  value="P">PERFILAJE Y REGISTRO</option>
                                                                @elseif($dosiT->ocupacion=='T' && $trab->trabajador->id_trabajador == $dosiT->trabajador_id && $dosiT->dosimetro_uso == 'TRUE')
                                                                    <option selected  value="T">TRAZADORES</option>
                                                                @elseif($dosiT->ocupacion=='H' && $trab->trabajador->id_trabajador == $dosiT->trabajador_id && $dosiT->dosimetro_uso == 'TRUE')
                                                                    <option selected  value="H">HEMODINAMIA</option>
                                                                @elseif($dosiT->ocupacion=='X' && $trab->trabajador->id_trabajador == $dosiT->trabajador_id && $dosiT->dosimetro_uso == 'TRUE')
                                                                    <option selected  value="X">RX PERIAPICALES</option>
                                                                @elseif($dosiT->ocupacion=='R' && $trab->trabajador->id_trabajador == $dosiT->trabajador_id && $dosiT->dosimetro_uso == 'TRUE')
                                                                    <option selected  value="R">RADIODIAGNÓSTICO</option>
                                                                @elseif($dosiT->ocupacion=='S' && $trab->trabajador->id_trabajador == $dosiT->trabajador_id && $dosiT->dosimetro_uso == 'TRUE')
                                                                    <option selected  value="S">FLUOROSCOPÍA</option>
                                                                @elseif($dosiT->ocupacion=='AM' && $trab->trabajador->id_trabajador == $dosiT->trabajador_id && $dosiT->dosimetro_uso == 'TRUE')
                                                                    <option selected  value="AM">APLICACIONES MÉDICAS</option>
                                                                @elseif($dosiT->ocupacion=='AI' && $trab->trabajador->id_trabajador == $dosiT->trabajador_id && $dosiT->dosimetro_uso == 'TRUE')
                                                                    <option selected  value="AI">APLICACIONES INDUSTRIALES</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                        @error('ocupacion_asigdosim')
                                                        <small>*{{$message}}</small>
                                                        @enderror

                                                    @else
                                                        <select class="form-select" name="ocupacion_asigdosim[]" id="ocupacion_asigdosim{{$trab->trabajador->id_trabajador}}" autofocus style="text-transform:uppercase">
                                                            <option value="">--</option>
                                                            <option value="T">TELETERAPIA</option>
                                                            <option value="B">BRANQUITERAPIA</option>
                                                            <option value="N">MEDICINA NUCLEAR</option>
                                                            <option value="G">GAMAGRAFIA INDUSTRIAL</option>
                                                            <option value="F">MEDIDORES FIJOS</option>
                                                            <option value="I">INVESTIGACIÓN</option>
                                                            <option value="D">DENSÍMETRO NUCLEAR</option>
                                                            <option value="M">MEDIDORES MÓVILES</option>
                                                            <option value="E">DOCENCIA</option>
                                                            <option value="P">PERFILAJE Y REGISTRO</option>
                                                            <option value="T">TRAZADORES</option>
                                                            <option value="H">HEMODINAMIA</option>
                                                            <option value="X">RX PERIAPICALES</option>
                                                            <option value="R">RADIODIAGNÓSTICO</option>
                                                            <option value="S">FLUOROSCOPÍA</option>
                                                            <option value="AM">APLICACIONES MÉDICAS</option>
                                                            <option value="AI">APLICACIONES INDUSTRIALES</option>
                                                        </select>
                                                        @error('ocupacion_asigdosim')
                                                        <small>*{{$message}}</small>
                                                        @enderror
                                                    @endif

                                                </td>
                                                <td>
                                                    <button data-bs-toggle="modal" data-bs-target="#dosimetros{{$trab->trabajador->id_trabajador}}" class="btn btn-danger btn-sm" type="button">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                                        </svg>
                                                    </button>

                                                    <button data-bs-toggle="modal" data-bs-target="#trabajadorDelete{{$trab->trabajador->id_trabajador}}" class="btn btn-danger btn-sm" type="button">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-x" viewBox="0 0 16 16">
                                                            <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                                                            <path fill-rule="evenodd" d="M12.146 5.146a.5.5 0 0 1 .708 0L14 6.293l1.146-1.147a.5.5 0 0 1 .708.708L14.707 7l1.147 1.146a.5.5 0 0 1-.708.708L14 7.707l-1.146 1.147a.5.5 0 0 1-.708-.708L13.293 7l-1.147-1.146a.5.5 0 0 1 0-.708z"/>
                                                        </svg>
                                                    </button>


                                                </td>
                                            </tr>
                                            @endif

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
                                <button onclick="e.preventDefault()" id="assignBtn" class="btn colorQA"  type="submit">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-save" viewBox="0 0 16 16">
                                    <path d="M2 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H9.5a1 1 0 0 0-1 1v7.293l2.646-2.647a.5.5 0 0 1 .708.708l-3.5 3.5a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L7.5 9.293V2a2 2 0 0 1 2-2H14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h2.5a.5.5 0 0 1 0 1H2z"/>
                                </svg> <br> GUARDAR ASIGNACIÓN
                                </button>
                        </div>
                    </div>
                    <div class="col">
                        <div class="d-grip gap-2 col-6 mx-auto">
                            <button data-bs-toggle="modal" data-bs-target="#añadirTrabajador" type="button" class="btn colorQA">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-person-plus text-center" viewBox="0 0 16 16">
                                    <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                                    <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
                                </svg> <br> AÑADIR TRABAJADOR
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
        </div>
    </div>
    <div class="col"></div>
    <!-- Modal -->
    <div class="modal fade" id="añadirTrabajador" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Añade un trabajador faltante aqui</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="form_añadir_trabajador_sede" name="form_añadir_trabajador_sede" action="{{route('trabajadorSede.create', ['mesnumber'=>Request()->mesnumber] )}}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-floating">
                            <select class="form-select" name="id_sede_asigdosim" id="id_sede_asigdosim" autofocus aria-label="Floating label select example">
                                <option value ="{{$contdosisededepto->contratodosimetriasede->sede->id_sede}}">{{$contdosisededepto->contratodosimetriasede->sede->nombre_sede}}</option>
                            </select>
                            <label for="floatingSelectGrid">SEDE:</label>
                        </div>
                        <input hidden name="contratoId" id="contratoId" value="{{$contdosisededepto->contratodosimetriasede_id}}">
                        <input hidden name="mesnumber" id="mesnumber" value="{{Request()->mesnumber}}">

                        <br>
                        <span>Busca el nombre del trabajador que deseas añadir</span>
                        <br>
                        <br>
                        <input type="text" id="myInputCourse" onkeyup='tableSearchWork()' placeholder="Buscar trabajador por nombre">
                        <br>
                        <br>
                        <table id="myTableCourse" class="table table-bordered">
                            <th>Nombre</th>
                            <th>Apellidos</th>
                            <th>Documento de identidad</th>
                            <th>Añadir</th>
                            <?php $c=0 ?>
                                @foreach($trabajadores as $work)
                                    <?php $c++; ?>
                                <tr>
                            <td>
                                {{$work->trabajador->primer_nombre_trabajador}} {{$work->trabajador->segundo_nombre_trabajador}}
                            </td>
                            <td>
                                {{$work->trabajador->primer_apellido_trabajador}} {{$work->trabajador->segundo_apellido_trabajador}}
                            </td>
                            <td>
                                {{$work->trabajador->cedula_trabajador}}

                            </td>
                                    <td>
                                        <button data-bs-dismiss="modal" type="button" onclick="
                                            addTrabajador({{$work->trabajador->id_trabajador}},{{json_encode($work->trabajador->primer_nombre_trabajador)}},{{json_encode($work->trabajador->segundo_nombre_trabajador)}},{{json_encode($work->trabajador->primer_apellido_trabajador)}},{{json_encode($work->trabajador->segundo_apellido_trabajador)}},{{$work->trabajador->cedula_trabajador}})" class="btn colorQA">Aceptar</button>

                                    </td>
                                </tr>
                                @endforeach

                        </table>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal -->
    @foreach($trabajadores as $trab)
    <div class="modal fade" id="trabajadorDelete{{$trab->trabajador->id_trabajador}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">{{$trab->trabajador->primer_nombre_trabajador}} {{$trab->trabajador->segundo_nombre_trabajador}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="form_eliminar_trabajador_sede" name="form_eliminar_dosimetro" action="{{route('trabajadorSede.destroy', ['idWork' => $trab->trabajador->id_trabajador, 'contratoId' => $contdosisededepto->id_contdosisededepto, 'mesnumber'=>Request()->mesnumber ]  )}}" method="POST">
                    <div class="modal-body">
                        <span>¿Eliminar este trabajador?</span>
                        @csrf
                        @method('delete')
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                        <button onclick="deleteTrabajador('trabajador{{$trab->trabajador->id_trabajador}}')" type="button" data-bs-dismiss="modal" class="btn colorQA">Eliminar trabajdor</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach

@foreach($trabajadores as $trab)
    <!-- Modal -->
    <div class="modal fade" id="dosimetros{{$trab->trabajador->id_trabajador}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">{{$trab->trabajador->primer_nombre_trabajador}} {{$trab->trabajador->segundo_nombre_trabajador}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="form_eliminar_dosimetro" name="form_eliminar_dosimetro" action="{{route('dosimetroWork.destroy', ['idWork' => $trab->trabajador->id_trabajador, 'contratoId' => $contdosisededepto->id_contdosisededepto , 'mesnumber'=>Request()->mesnumber ]  )}}" method="POST">
                    <div class="modal-body">
                        <span>¿Eliminar el dosimetro asignado a este trabajador?</span>
                        @csrf
                        @method('delete')
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn colorQA">Eliminar dosimetro</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach


    @foreach($dosimetrosControlAsignadosAnteriores as $dosicontrol)
        <!-- Modal -->
            <div class="modal fade" id="dosimetroControl{{$dosicontrol->id_dosicontrolcontdosisedes}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Quitar este dosimetro de control </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                       <form id="form_eliminar_dosimetro" name="form_eliminar_dosimetro" action="{{route('dosimetroControl.destroy', ['idDosiControl' => $dosicontrol->id_dosicontrolcontdosisedes, 'contratoId' => $contdosisededepto->id_contdosisededepto, 'mesnumber'=>(Request()->mesnumber-1)]  )}}" method="POST">
                            <div class="modal-body">
                                <span>¿Eliminar el dosimetro asignado a este dosimetro de control?</span>
                                @csrf
                                @method('delete')
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn colorQA">Eliminar dosimetro</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    @endforeach
</div>
<br>
    <script
        src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous">
    </script>
   
   {{-- <script src="https://unpkg.com/@popperjs/core@2"></script> --}}
    <script type="text/javascript">
        $(document).ready(function() {

            @foreach($trabajadores as $trab)
            $('#id_dosimetro_asigdosim{{$trab->trabajador->id_trabajador}}').select2();
            $('#id_holder_asigdosim{{$trab->trabajador->id_trabajador}}').select2();
            $('#ocupacion_asigdosim{{$trab->trabajador->id_trabajador}}').select2();
            console.log({{$trab->trabajador->id_trabajador}})
            @endforeach
            @foreach($dosimetrosControl as $control)
            $('#id_dosimetro_asigdosim_control{{$control->dosimetro_id}}').select2();
            $('#ocupacion_asigdosim_control{{$control->dosimetro_id}}').select2();
            @endforeach

            @for($i=0; $i<$contdosisededepto->dosi_control-count($dosimetrosControl); $i++)
            $('#id_dosimetro_asigdosim_control{{$i}}').select2();
            $('#ocupacion_asigdosim_control{{$i}}').select2();
            @endfor
        });
       function deleteTrabajador(id) {
           document.getElementById(id).remove();
       }
       function deleteTrabajadorAfterAdd(id) {
           document.getElementById(`trabajador${id}`).remove()
       }
       function addTrabajador(id, primerNombre, segundoNombre, primerApellido, segundoApellido, cedula) {

           var fila = document.createElement("tr");
           fila.setAttribute("id", `trabajador${id}`)
           let inputTrab = document.createElement("input")
           inputTrab.setAttribute("name", "id_trabajador_asigdosim[]")
           inputTrab.setAttribute("hidden", "true")
           inputTrab.setAttribute("value", `${id}`)
            let nombresTd = document.createElement("td")
           let nonresTdData = document.createTextNode(`${primerNombre} ${segundoNombre}`);
           nombresTd.appendChild(nonresTdData);

           let apellidosTd = document.createElement("td")
           let apellidosTdData = document.createTextNode(`${primerApellido} ${segundoApellido}`);
           apellidosTd.appendChild(apellidosTdData);

           let cedulaTd = document.createElement("td")
           let cedulaTdData = document.createTextNode(`${cedula}`);
           cedulaTd.appendChild(cedulaTdData);

          let selectDosimetrosTd = document.createElement("td")
               let selectDosimetros = document.createElement("select")
               selectDosimetros.setAttribute("class", "form-select")
           selectDosimetros.setAttribute("name", "id_dosimetro_asigdosim[]")
           selectDosimetros.setAttribute("id", `id_dosimetro_asigdosim${id}`)

           let arrayOptionsDosimetros = []
           let contadorDosimetro= 0;
           @foreach($dosimetros as $dosi)
           @if($dosi->tipo_dosimetro != 'CONTROL' && $dosi->estado_dosimetro=='STOCK' )
               contadorDosimetro++
           arrayOptionsDosimetros.push(document.createElement("option"));
           arrayOptionsDosimetros[contadorDosimetro-1].setAttribute("value", "{{$dosi->id_dosimetro}}")
           arrayOptionsDosimetros[contadorDosimetro-1].innerText = "{{$dosi->codigo_dosimeter}} - {{$dosi->tipo_dosimetro}}"

           @endif
           @endforeach
               for(let i=0; i<arrayOptionsDosimetros.length; i++) {
                   selectDosimetros.appendChild(arrayOptionsDosimetros[i])
           }

           selectDosimetrosTd.appendChild(selectDosimetros)

           let selectHoldersTd = document.createElement("td")
           let selectHolders = document.createElement("select")
           selectHolders.setAttribute("class", "form-select")
           selectHolders.setAttribute("name", "id_holder_asigdosim[]")
           selectHolders.setAttribute("id", `id_holder_asigdosim${id}`)


           let optionHolderNull = document.createElement("option")
           optionHolderNull.setAttribute("value", "")
           optionHolderNull.innerText = "N.A."
           selectHolders.appendChild(optionHolderNull)

           let contador=0;
           let arrayOptions = []
           @foreach($holders as $hol)

           @if($hol->estado_holder=='STOCK')
               contador++;
           arrayOptions.push(document.createElement("option"));
           arrayOptions[contador-1].setAttribute("value", "{{$hol->id_holder}}")
          arrayOptions[contador-1].innerText = "{{$hol->codigo_holder}} - {{$hol->tipo_holder}}"
           @endif

           @endforeach
           for (let i=0; i<arrayOptions.length; i++) {
               selectHolders.appendChild(arrayOptions[i])
           }

               selectHoldersTd.appendChild(selectHolders)

           let ocupacionesTd = document.createElement("td")
           let selectOcupaciones = document.createElement("select")
           selectOcupaciones.setAttribute("name", "ocupacion_asigdosim[]")
           selectOcupaciones.setAttribute("id", `ocupacion_asigdosim${id}`)
           selectOcupaciones.setAttribute("class", "form-select")
           let ocupacion1=document.createElement("option")
           ocupacion1.innerText="--"
           let ocupacion2=document.createElement("option")
           ocupacion2.innerText="TELETERAPIA"
           ocupacion2.setAttribute("value","T")
           let ocupacion3=document.createElement("option")
           ocupacion3.innerText="BRANQUITERAPIA"
           ocupacion3.setAttribute("value", "B")
           let ocupacion4=document.createElement("option")
           ocupacion4.innerText="MEDICINA NUCLEAR"
           ocupacion4.setAttribute("value","N")
           let ocupacion5=document.createElement("option")
           ocupacion5.innerText="GRAMAFIA INDUSTRIAL"
           ocupacion5.setAttribute("value", "G")
           let ocupacion6=document.createElement("option")
           ocupacion6.innerText="MEDIDORES FIJOS"
           ocupacion6.setAttribute("value", "F")
           let ocupacion7=document.createElement("option")
           ocupacion7.innerText="INVESTIGACIÓN"
           ocupacion7.setAttribute("value", "I")
           let ocupacion8=document.createElement("option")
           ocupacion8.innerText="DENSÍMETRO NUCLEAR"
           ocupacion8.setAttribute("value","D")
           let ocupacion9=document.createElement("option")
           ocupacion9.innerText="MEDIDORES MÓVILES"
           ocupacion9.setAttribute("value", "M")
           let ocupacion10=document.createElement("option")
           ocupacion10.innerText="DOCENCIA"
           ocupacion10.setAttribute("value","E")
           let ocupacion11=document.createElement("option")
           ocupacion11.innerText="PERFILAJE Y REGISTRO"
           ocupacion11.setAttribute("value","P")
           let ocupacion12=document.createElement("option")
           ocupacion12.innerText="TRAZADORES"
           ocupacion12.setAttribute("value", "T")
           let ocupacion13=document.createElement("option")
           ocupacion13.innerText="HEMODINAMIA"
           ocupacion13.setAttribute("value","H")
           let ocupacion14=document.createElement("option")
           ocupacion14.innerText="RX PERIAPICALES"
           ocupacion14.setAttribute("value", "X")
           let ocupacion15=document.createElement("option")
           ocupacion15.innerText="RADIODIAGNÓSTICO"
           ocupacion15.setAttribute("value", "R")
           let ocupacion16=document.createElement("option")
           ocupacion16.innerText="FLUOROSCOPÍA"
           ocupacion16.setAttribute("value", "S")
           let ocupacion17=document.createElement("option")
           ocupacion17.innerText="APLICACIONES MÉDICAS"
           ocupacion17.setAttribute("value", "AM")
           let ocupacion18=document.createElement("option")
           ocupacion18.innerText="APLICACIONES INDUSTRIALES"
           ocupacion18.setAttribute("value", "AI")

           selectOcupaciones.append(
               ocupacion1,
               ocupacion2,
               ocupacion3,
               ocupacion4,
               ocupacion5,
               ocupacion6,
               ocupacion7,
               ocupacion8,
               ocupacion9,
               ocupacion10,
               ocupacion11,
               ocupacion12,
               ocupacion13,
               ocupacion14,
               ocupacion15,
               ocupacion16,
               ocupacion17,
               ocupacion18,
               )
           ocupacionesTd.appendChild(selectOcupaciones)

           let btnQuitar = document.createElement("button")
           btnQuitar.setAttribute("style", "border: none; background-color: #d9534f; border-radius: 5rem; width:2rem;")
          // btnQuitar.setAttribute("onclick", `deleteTrabajador(${id})`)
           btnQuitar.onclick = function () {
               deleteTrabajadorAfterAdd(id);
           }
           btnQuitar.setAttribute("type", "button")
           btnQuitar.innerText="X"


           let actionsTd = document.createElement("td")

           actionsTd.appendChild(btnQuitar)
           
           fila.appendChild(inputTrab);
           fila.appendChild(nombresTd);
           fila.appendChild(apellidosTd);
           fila.appendChild(cedulaTd);
           fila.appendChild(selectDosimetrosTd);
           fila.appendChild(selectHoldersTd);
           fila.appendChild(ocupacionesTd);
           fila.appendChild(actionsTd);

           var element = document.getElementById("tablaDosimetros");
           element.appendChild(fila);
           $(document).ready(function() {
               $(`#id_dosimetro_asigdosim${id}`).select2();
               $(`#id_holder_asigdosim${id}`).select2();
               $(`#ocupacion_asigdosim${id}`).select2();
           });

       }
       function count(obj) {
           window.alert(obj.options[obj.selectedIndex].value);
       }
           function tableSearchWork() {
               let input, filter, table, tr, td, txtValue;

               //Intialising Variables
               input = document.getElementById("myInputCourse");
               filter = input.value.toUpperCase();
               table = document.getElementById("myTableCourse");
               tr = table.getElementsByTagName("tr");

               for (let i = 0; i < tr.length; i++) {
                   td = tr[i].getElementsByTagName("td")[0];
                   if (td) {
                       txtValue = td.textContent || td.innerText;
                       if (txtValue.toUpperCase().indexOf(filter) > -1) {
                           tr[i].style.display = "";
                       } else {
                           tr[i].style.display = "none";
                       }
                   }
               }
           }

        /* var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
        var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
            return new bootstrap.Popover(popoverTriggerEl);
        }); */


        $(document).ready(function() {
            $('[data-bs-toggle="popover"]').popover({
                
                trigger: 'hover'
            });
        })
    </script>
@endsection
