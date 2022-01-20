@extends('layouts.plantillabase')
@section('contenido')
<div class="row">
    <div class="col"></div>
    <div class="col-9">
        <div class="card text-dark bg-light">
            <h2 class="text-center mt-3">ASIGNAR DOSÍMETRO</h2>
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
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th>AMBIENTE:</th>
                                        <td class="text-center">{{$contdosisede->dosi_ambiental}}</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th>CONTROL:</th>
                                        <td class="text-center">{{$contdosisede->dosi_control}}</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th>EzCLIP:</th>
                                        <td class="text-center">{{$contdosisede->dosi_ezclip}}</td>
                                        <td></td>
                                        <td></td>
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
                            <table class="table table-bordered">
                                <thead class="text-center">
                                    <th>NOMBRES</th>
                                    <th>APELLIDOS</th>
                                    <th style='width: 10.20%'>No. IDEN.</th>
                                    <th style='width: 16.40%'>DOSÍMETRO</th>
                                    <th style='width: 16.40%'>HOLDER</th>
                                    <th style='width: 16.60%'>OCUPACIÓN</th>
                                </thead>
                                <tbody>
                                    @for($i=0; $i<$contdosisede->dosi_control; $i++)
                                        <tr>
                                            <td>
                                                <input type="number" name="id_sede_asigdosim_control" id="id_sede_asigdosim_control" hidden value="{{$contdosisede->sede_id}}">
                                                
                                                <input type="number" name="id_contrato_asigdosim_control" id="id_contrato_asigdosim_control" hidden value="{{$contdosisede->id_contratodosimetriasede}}">
                                                N.A.
                                            </td>
                                            <td colspan="2">CONTROL</td>
                                            <td>
                                                <select class="form-select" name="id_dosimetro_asigdosim_control[]" id="id_dosimetro_asigdosim_control"  autofocus aria-label="Floating label select example">
                                                    <option value ="">--</option>
                                                    @foreach($dosimetros as $dosi)
                                                        <option value ="{{$dosi->id_dosimetro}}">{{$dosi->codigo_dosimeter}}</option>
                                                    @endforeach
                                                </select>
                                                @error('id_dosimetro_asigdosim_control')
                                                    <small>*{{$message}}</small>
                                                @enderror
                                            </td>
                                            <td class="text-center">N.A.</td>
                                            <td>
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
                                                @error('ocupacion_asigdosim_control')
                                                    <small>*{{$message}}</small>
                                                @enderror
                                            </td>
                                        </tr>
                                    @endfor
                                    @foreach($trabajadores as $trab)
                                        <tr>
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
                                                <select class="form-select" name="id_dosimetro_asigdosim[]" id="id_dosimetro_asigdosim"  autofocus aria-label="Floating label select example" >
                                                    <option value ="">--</option>
                                                    @foreach($dosimetros as $dosi)
                                                        <option value ="{{$dosi->id_dosimetro}}">{{$dosi->codigo_dosimeter}}</option>
                                                    @endforeach
                                                </select>
                                                @error('id_dosimetro_asigdosim')
                                                    <small>*{{$message}}</small>
                                                @enderror
                                            </td>
                                            <td>
                                                <select class="form-select" name="id_holder_asigdosim[]" id="id_holder_asigdosim" autofocus aria-label="Floating label select example">
                                                    <option value ="">N.A.</option>
                                                    <!-- <option value ="">N.A.</option> -->
                                                    @foreach($holders as $hol)
                                                        <option value ="{{$hol->id_holder}}">{{$hol->codigo_holder}}</option>
                                                    @endforeach
                                                </select>
                                                @error('id_holder_asigdosim')
                                                    <small>*{{$message}}</small>
                                                @enderror
                                            </td>
                                            <td>
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
                            <button class="btn colorQA"  type="submit">
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
</div>
<br>
@endsection