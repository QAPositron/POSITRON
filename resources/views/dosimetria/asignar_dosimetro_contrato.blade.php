@extends('layouts.plantillabase')
@section('contenido')
<div class="row">
    <div class="col"></div>
    <div class="col-9">
        <div class="card text-dark bg-light">
            <h2 class="text-center mt-3">ASIGNAR DOSÍMETRO</h2>
            <h3 class="text-center">MES {{ Request()->mesnumber  }}</h3>
            <form class="m-4" action="{{route('asignadosicontrato.save')}}" method="POST">
                @csrf
                <div class="row g-2 mx-3">
                    <div class="col-md">
                        <div class="form-floating ">
                            <select class="form-select" name="id_empresa_asigdosim" id="id_empresa_asigdosim"  autofocus aria-label="Floating label select example" >
                                <option value ="{{ $contdosisede->dosimetriacontrato->empresa->id_empresa}}">{{$contdosisede->dosimetriacontrato->empresa->nombre_empresa}}</option>
                            </select>
                            <label for="floatingSelectGrid">EMPRESA:</label>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-floating">
                            <select class="form-select" name="id_sede_asigdosim" id="id_sede_asigdosim" autofocus aria-label="Floating label select example">
                            <option value ="{{ $contdosisede->sede->id_sede}}">{{$contdosisede->sede->nombre_sede}}</option>
                            </select>
                            <label for="floatingSelectGrid">SEDE:</label>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row g-2 mx-5">
                    <div class="col-md">
                        <div class="table table-responsive">
                            <table class="table table-sm table-bordered">
                                <thead class="text-center">
                                    <th colspan="4">CONTRATO No. {{$contdosisede->dosimetriacontrato->codigo_contrato}}</th>
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
                                        <td class="text-center">{{$contdosisede->dosi_cuerpo_entero}}</td>
                                        <td class="text-center">{{$dosimetrosCuerpoEnteroAsignados + $dosimetroControlCuerpoAsignados}}</td>
                                        <td class="text-center">{{ $contdosisede->dosi_cuerpo_entero - $dosimetrosCuerpoEnteroAsignados - $dosimetroControlCuerpoAsignados}}</td>
                                    </tr>
                                    <tr>
                                        <th>AMBIENTE:</th>
                                        <td class="text-center">{{$contdosisede->dosi_ambiental}}</td>
                                        <td class="text-center">{{$dosimetrosAmbienteAsignados + $dosimetrosControlAmbientalAsignados}}</td>
                                        <td class="text-center">{{$contdosisede->dosi_ambiental - $dosimetrosAmbienteAsignados - $dosimetrosControlAmbientalAsignados}}</td>
                                    </tr>
                                    <tr>
                                        <th>CONTROL:</th>
                                        <td class="text-center">{{$contdosisede->dosi_control}}</td>
                                        <td class="text-center">{{$dosimetrosControlAsignados}}</td>
                                        <td class="text-center">{{$contdosisede->dosi_control - $dosimetrosControlAsignados}}</td>
                                    </tr>
                                    <tr>
                                        <th>EzCLIP:</th>
                                        <td class="text-center">{{$contdosisede->dosi_ezclip}}</td>
                                        <td>
                                            <center>
                                            {{$dosimetrosEzClipAsignados + $dosimetroControlEzclipAsignados}}
                                            </center>
                                        </td>
                                        <td>
                                            <center>
                                            {{$contdosisede->dosi_ezclip - $dosimetrosEzClipAsignados - $dosimetroControlEzclipAsignados}}
                                            </center>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row g-2 mx-3">
                    <div class="col-md">
                        <div class="form-floating">
                            <input type="date" class="form-control" name="primerDia_asigdosim" id="primerDia_asigdosim" >
                            <label for="floatingInputGrid">PRIMER DÍA</label>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-floating">
                            <input type="date" class="form-control" name="ultimoDia_asigdosim" id="ultimoDia_asigdosim" >
                            <label for="floatingInputGrid">ULTIMO DÍA:</label>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row g-2 mx-3">
                    <div class="col-md">
                        <div class="form-floating">
                            <input type="text" class="form-control" name="energia_asigdosim" id="energia_asigdosim" value="FOTONES" readonly>
                            <label for="floatingInputGrid">ENERGÍA:</label>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-floating">
                            <input type="text" class="form-control" name="periodorecambio_asigdosim" id="periodorecambio_asigdosim" value="{{$contdosisede->dosimetriacontrato->periodo_recambio}}" readonly>
                            <label for="floatingInputGrid">PERIODO RECAMBIO:</label>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row g-2 mx-3">
                    <div class="col-md">
                        <div class="table table-responsive">
                            <center>
                            <button data-bs-toggle="modal" data-bs-target="#añadirTrabajador" type="button" class="btn colorQA">
                                <center>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-plus" viewBox="0 0 16 16">
                                    <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                                    <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
                                </svg>
                                </center>
                            </button>
                            </center>
                            <br>
                            <table class="table table-bordered">
                                <thead class="text-center">
                                    <th>NOMBRES</th>
                                    <th>APELLIDOS</th>
                                    <th style='width: 10.20%'>No. IDEN.</th>
                                    <th style='width: 16.40%'>DOSÍMETRO</th>
                                    <th style='width: 16.40%'>HOLDER</th>
                                    <th style='width: 16.60%'>OCUPACIÓN</th>
                                    <th>ACCIONES</th>
                                </thead>
                                <tbody>
                                @if (count($dosimetrosControl) > 0)
                                    @foreach($dosimetrosControl as $control)

                                        <tr>

                                            <td>
                                                <input type="number" name="id_sede_asigdosim_control" id="id_sede_asigdosim_control" hidden value="{{$contdosisede->sede_id}}">

                                                <input type="number" name="id_contrato_asigdosim_control" id="id_contrato_asigdosim_control" hidden value="{{$contdosisede->id_contratodosimetriasede}}">
                                                N.A.
                                            </td>

                                            <td colspan="2">CONTROL</td>
                                            <td>
                                                    <select class="form-select" name="id_dosimetro_asigdosim_control[]" id="id_dosimetro_asigdosim_control"  autofocus aria-label="Floating label select example">

                                                            @foreach($dosimetros as $dosi)>

                                                            @if( $control->dosimetro_id == $dosi->id_dosimetro  )
                                                                <option selected  value ="{{$dosi->id_dosimetro}}">{{$dosi->codigo_dosimeter}}--{{$dosi->tipo_dosimetro}}</option>
                                                            @endif

                                                        @endforeach
                                                    </select>


                                                @error('id_dosimetro_asigdosim_control')
                                                <small>*{{$message}}</small>
                                                @enderror
                                            </td>
                                            <td class="text-center">N.A.</td>
                                            <td>

                                                    <select class="form-select" name="ocupacion_asigdosim_control[]" id="ocupacion_asigdosim_control" autofocus style="text-transform:uppercase">
                                                        @foreach($dosimetros as $dosi)
                                                            @if($control->ocupacion=='T' &&  $control->dosimetro_id == $dosi->id_dosimetro)
                                                                <option selected  value="T">TELETERAPIA</option>
                                                            @elseif($control->ocupacion=='B' &&  $control->dosimetro_id == $dosi->id_dosimetro)
                                                                <option selected  value="B">BRANQUITERAPIA</option>
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
                                    @for($i=0; $i<$contdosisede->dosi_control-count($dosimetrosControl); $i++)
                                        <tr>

                                            <td>
                                                <input type="number" name="id_sede_asigdosim_control" id="id_sede_asigdosim_control" hidden value="{{$contdosisede->sede_id}}">

                                                <input type="number" name="id_contrato_asigdosim_control" id="id_contrato_asigdosim_control" hidden value="{{$contdosisede->id_contratodosimetriasede}}">
                                                N.A.
                                            </td>

                                            <td colspan="2">CONTROL</td>
                                            <td>
                                                <?php $c=0; ?>
                                                @if (count($dosimetrosControl) > 0)
                                                        <?php $c++; ?>
                                                <select class="form-select" name="id_dosimetro_asigdosim_control[]" id="id_dosimetro_asigdosim_control"  autofocus aria-label="Floating label select example">
                                                    @foreach($dosimetrosControl as $control)
                                                    @foreach($dosimetros as $dosi)>

                                                        @if( $control->dosimetro_id == $dosi->id_dosimetro && $i==$dosimetrosControl)
                                                        <option>{{$c}}</option>
                                                        <option selected  value ="{{$dosi->id_dosimetro}}">{{$dosi->codigo_dosimeter}}--{{$dosi->tipo_dosimetro}}</option>
                                                        @endif
                                                    @endforeach
                                                    @endforeach
                                                </select>

                                                @else
                                                    <select class="form-select" name="id_dosimetro_asigdosim_control[]" id="id_dosimetro_asigdosim_control"  autofocus aria-label="Floating label select example">
                                                        <option value ="">--</option>
                                                        <?php $cez=0; $cam=0; $cce=0; ?>
                                                        @foreach($dosimetros as $dosi)
                                                            @if($dosi->tipo_dosimetro == 'EZCLIP' && ($contdosisede->dosi_ezclip - $cez)>0)
                                                                <?php $cez++; ?>
                                                            <option value ="{{$dosi->id_dosimetro}}">{{$dosi->codigo_dosimeter}}--{{$dosi->tipo_dosimetro}}</option>
                                                            @elseif($dosi->tipo_dosimetro == 'CUERPO' && ($contdosisede->dosi_cuerpo_entero - $cce)>0)
                                                                <?php $cce++; ?>
                                                                    <option value ="{{$dosi->id_dosimetro}}">{{$dosi->codigo_dosimeter}}--{{$dosi->tipo_dosimetro}}</option>
                                                            @elseif($dosi->tipo_dosimetro == 'AMBIENTAL' && ($contdosisede->dosi_ambiental - $cam)>0)
                                                                <?php $cam++; ?>
                                                                    <option value ="{{$dosi->id_dosimetro}}">{{$dosi->codigo_dosimeter}}--{{$dosi->tipo_dosimetro}}</option>

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

                                                        <select class="form-select" name="ocupacion_asigdosim_control[]" id="ocupacion_asigdosim_control" autofocus style="text-transform:uppercase">
                                                            @foreach($dosimetrosControl as $control)
                                                           @if($control->ocupacion=='T')
                                                            <option selected hidden value="T">TELETERAPIA</option>
                                                               @elseif($control->ocupacion=='B')
                                                            <option selected hidden value="B">BRANQUITERAPIA</option>
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

                                                    <select class="form-select" name="ocupacion_asigdosim_control[]" id="ocupacion_asigdosim_control" autofocus style="text-transform:uppercase">
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
                                        <?php $ct++ ?>

                                        <tr id="trabajador{{$trab->trabajador->id_trabajador}}">
                                            <td>
                                                <input type="number" name="id_trabajador_asigdosim[]" id="id_trabajador_asigdosim" hidden value="{{$trab->trabajador->id_trabajador}}">
                                                <input type="number" name="id_contrato_asigdosim" id="id_contrato_asigdosim" hidden value="{{$contdosisede->id_contratodosimetriasede}}">
                                                {{$trab->trabajador->primer_nombre_trabajador}} {{$trab->trabajador->segundo_nombre_trabajador}}
                                            </td>
                                            <td>
                                                {{$trab->trabajador->primer_apellido_trabajador}} {{$trab->trabajador->segundo_apellido_trabajador}}
                                            </td>
                                            <td>{{$trab->trabajador->cedula_trabajador}}</td>
                                            <td>
                                                <select onChange="changeTest(this)" class="form-select" name="id_dosimetro_asigdosim[]" id="id_dosimetro_asigdosim"  autofocus aria-label="Floating label select example" >
                                                    @if(count($dosimetrosTrabajadores)>0)

                                                        @foreach($dosimetrosTrabajadores as $dosiT)
                                                    @foreach($dosimetrosDisponibles as $dosi)

                                                                @if($dosiT['dosimetro_id'] == $dosi['id_dosimetro'] && $trab->trabajador->id_trabajador == $dosiT->trabajador_id)
                                                        <option change="saveTypeDosi({{$dosi->tipo_dosimetro}})" value ="{{$dosi->id_dosimetro}}">{{$dosi->codigo_dosimeter}} -- {{$dosi->tipo_dosimetro}}</option>
                                                                @endif

                                                    @endforeach
                                                        @endforeach

                                                    @else
                                                        <option value="">--</option>
                                                    <?php $cez=0; $cam=0; $cce=0; ?>
                                                        @foreach($dosimetros as $dosi)
                                                            @if($dosi->tipo_dosimetro == 'EZCLIP' && ($contdosisede->dosi_ezclip - $cez)>0)
                                                                <?php $cez++; ?>
                                                            <option onclick="count('EZCLIP')" change="saveTypeDosi({{$dosi->tipo_dosimetro}})" value ="{{$dosi->id_dosimetro}}">{{$dosi->codigo_dosimeter}} -- {{$dosi->tipo_dosimetro}}</option>
                                                            @elseif($dosi->tipo_dosimetro == 'CUERPO' && ($contdosisede->dosi_cuerpo_entero - $cce)>0)
                                                                <?php $cce++; ?>
                                                                <option change="saveTypeDosi({{$dosi->tipo_dosimetro}})" value ="{{$dosi->id_dosimetro}}">{{$dosi->codigo_dosimeter}} -- {{$dosi->tipo_dosimetro}}</option>
                                                            @elseif($dosi->tipo_dosimetro == 'AMBIENTAL' && ($contdosisede->dosi_ambiental - $cam)>0)
                                                                <?php $cam++; ?>
                                                                <option change="saveTypeDosi({{$dosi->tipo_dosimetro}})" value ="{{$dosi->id_dosimetro}}">{{$dosi->codigo_dosimeter}} -- {{$dosi->tipo_dosimetro}}</option>
                                                            @endif
                                                        @endforeach

                                                        @endif
                                                </select>
                                                @error('id_dosimetro_asigdosim')
                                                    <small>*{{$message}}</small>
                                                @enderror
                                            </td>
                                            <td>

                                                <select class="form-select" name="id_holder_asigdosim[]" id="id_holder_asigdosim" autofocus aria-label="Floating label select example">
                                                    <!-- <option value ="">N.A.</option> -->
                                                    @if(count($dosimetrosTrabajadores)>0)

                                                        @foreach($dosimetrosTrabajadores as $dosiT)
                                                            @foreach($holdersDisponibles as $hol)

                                                                @if($dosiT['holder_id'] == $hol['id_holder'] && $trab->trabajador->id_trabajador == $dosiT->trabajador_id)
                                                                    <option selected  value ="{{$hol->id_holder}}"><?php echo $hol->codigo_holder; ?></option>
                                                                    @endif

                                                            @endforeach
                                                    @endforeach

                                                    @else
                                                        <option value="">--</option>
                                                        @foreach($holders as $hol)

                                                            <option value ="{{$hol->id_holder}}">{{$hol->codigo_holder}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                                @error('id_holder_asigdosim')
                                                    <small>*{{$message}}</small>
                                                @enderror
                                            </td>
                                            <td>
                                                @if(count($dosimetrosTrabajadores)>0)

                                                    <select class="form-select" name="ocupacion_asigdosim[]" id="ocupacion_asigdosim" autofocus style="text-transform:uppercase">
                                                        @foreach($dosimetrosTrabajadores as $dosiT)
                                                        @if($dosiT->ocupacion=='T' && $trab->trabajador->id_trabajador == $dosiT->trabajador_id)
                                                        <option selected  value="T">TELETERAPIA</option>
                                                        @elseif($dosiT->ocupacion=='B' && $trab->trabajador->id_trabajador == $dosiT->trabajador_id)
                                                        <option selected  value="B">BRANQUITERAPIA</option>
                                                        @elseif($dosiT->ocupacion=='N' && $trab->trabajador->id_trabajador == $dosiT->trabajador_id)
                                                        <option selected  value="N">MEDICINA NUCLEAR</option>
                                                        @elseif($dosiT->ocupacion=='G' && $trab->trabajador->id_trabajador == $dosiT->trabajador_id)
                                                        <option selected  value="G">GAMAGRAFIA INDUSTRIAL</option>
                                                        @elseif($dosiT->ocupacion=='F' && $trab->trabajador->id_trabajador == $dosiT->trabajador_id)
                                                        <option selected  value="F">MEDIDORES FIJOS</option>
                                                        @elseif($dosiT->ocupacion=='I' && $trab->trabajador->id_trabajador == $dosiT->trabajador_id)
                                                        <option selected  value="I">INVESTIGACIÓN</option>
                                                        @elseif($dosiT->ocupacion=='D' && $trab->trabajador->id_trabajador == $dosiT->trabajador_id)
                                                        <option selected  value="D">DENSÍMETRO NUCLEAR</option>
                                                        @elseif($dosiT->ocupacion=='M' && $trab->trabajador->id_trabajador == $dosiT->trabajador_id)
                                                        <option selected  value="M">MEDIDORES MÓVILES</option>
                                                        @elseif($dosiT->ocupacion=='E' && $trab->trabajador->id_trabajador == $dosiT->trabajador_id)
                                                        <option selected  value="E">DOCENCIA</option>
                                                        @elseif($dosiT->ocupacion=='P' && $trab->trabajador->id_trabajador == $dosiT->trabajador_id)
                                                        <option selected  value="P">PERFILAJE Y REGISTRO</option>
                                                        @elseif($dosiT->ocupacion=='T' && $trab->trabajador->id_trabajador == $dosiT->trabajador_id)
                                                        <option selected  value="T">TRAZADORES</option>
                                                        @elseif($dosiT->ocupacion=='H' && $trab->trabajador->id_trabajador == $dosiT->trabajador_id)
                                                        <option selected  value="H">HEMODINAMIA</option>
                                                        @elseif($dosiT->ocupacion=='X' && $trab->trabajador->id_trabajador == $dosiT->trabajador_id)
                                                        <option selected  value="X">RX PERIAPICALES</option>
                                                        @elseif($dosiT->ocupacion=='R' && $trab->trabajador->id_trabajador == $dosiT->trabajador_id)
                                                        <option selected  value="R">RADIODIAGNÓSTICO</option>
                                                        @elseif($dosiT->ocupacion=='S' && $trab->trabajador->id_trabajador == $dosiT->trabajador_id)
                                                        <option selected  value="S">FLUOROSCOPÍA</option>
                                                        @elseif($dosiT->ocupacion=='AM' && $trab->trabajador->id_trabajador == $dosiT->trabajador_id)
                                                        <option selected  value="AM">APLICACIONES MÉDICAS</option>
                                                        @elseif($dosiT->ocupacion=='AI' && $trab->trabajador->id_trabajador == $dosiT->trabajador_id)
                                                        <option selected  value="AI">APLICACIONES INDUSTRIALES</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                    @error('ocupacion_asigdosim')
                                                    <small>*{{$message}}</small>
                                                    @enderror

                                                    @else
                                                    <select class="form-select" name="ocupacion_asigdosim[]" id="ocupacion_asigdosim" autofocus style="text-transform:uppercase">
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
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z"/>
                                </svg>ASIGNAR
                            </button>
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
                                <option value ="{{ $contdosisede->sede->id_sede}}">{{$contdosisede->sede->nombre_sede}}</option>
                            </select>
                            <label for="floatingSelectGrid">SEDE:</label>
                        </div>
                        <input hidden name="contratoId" id="contratoId" value="{{$contdosisede->id_contratodosimetriasede}}">
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
                                @foreach($allWorks as $work)
                                    <?php $c++; ?>
                                <tr>
                            <td>
                                {{$work->primer_nombre_trabajador}} {{$work->segundo_nombre_trabajador}}
                            </td>
                            <td>
                                {{$work->primer_apellido_trabajador}} {{$work->segundo_apellido_trabajador}}
                            </td>
                            <td>
                                {{$work->cedula_trabajador}}

                            </td>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="idTrabajador" id="idTrabajador" value="{{$work->id_trabajador}}" >
                                            <label class="form-check-label" for="exampleRadios1">
                                                Seleccionar
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach

                        </table>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn colorQA">Aceptar</button>
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
                <form id="form_eliminar_trabajador_sede" name="form_eliminar_dosimetro" action="{{route('trabajadorSede.destroy', ['idWork' => $trab->trabajador->id_trabajador, 'contratoId' => $contdosisede->id_contratodosimetriasede, 'mesnumber'=>Request()->mesnumber ]  )}}" method="POST">
                    <div class="modal-body">
                        <span>¿Eliminar este trabajador?</span>
                        @csrf
                        @method('delete')
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn colorQA">Eliminar trabajdor</button>
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
                <form id="form_eliminar_dosimetro" name="form_eliminar_dosimetro" action="{{route('dosimetroWork.destroy', ['idWork' => $trab->trabajador->id_trabajador, 'contratoId' => $contdosisede->id_contratodosimetriasede, 'mesnumber'=>Request()->mesnumber ]  )}}" method="POST">
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


    @foreach($dosimetrosControl as $dosicontrol)
        <!-- Modal -->
            <div class="modal fade" id="dosimetroControl{{$dosicontrol->id_dosicontrolcontdosisedes}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Quitar este dosimetro de control </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                       <form id="form_eliminar_dosimetro" name="form_eliminar_dosimetro" action="{{route('dosimetroControl.destroy', ['idDosiControl' => $dosicontrol->id_dosicontrolcontdosisedes, 'contratoId' => $contdosisede->id_contratodosimetriasede, 'mesnumber'=>Request()->mesnumber]  )}}" method="POST">
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
    <script>
       function deleteTrabajador(id) {
           console.log(id);
           document.getElementById(id).remove();
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

    </script>
@endsection
