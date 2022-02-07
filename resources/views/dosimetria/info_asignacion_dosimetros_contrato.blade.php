@extends('layouts.plantillabase')
@section('contenido')

<h3 class="text-center">{{$contdosisededepto->contratodosimetriasede->sede->empresa->nombre_empresa}} - {{$contdosisededepto->contratodosimetriasede->sede->nombre_sede}}</h3>
<br>
<h4 class="text-center">CONTRATO No. {{$contdosisededepto->contratodosimetriasede->dosimetriacontrato->codigo_contrato}}</h4>
<br>
<h4 class="text-center">
    TRABAJADORES ASIGNADOS AL MES {{ Request()->mesnumber  }} (
        @if(Request()->mesnumber == 1)
            <span>{{date("d-m-Y",strtotime($contdosisededepto->contratodosimetriasede->dosimetriacontrato->fecha_inicio))}}</span>
        @else
            <span>{{date("d-m-Y",strtotime($contdosisededepto->contratodosimetriasede->dosimetriacontrato->fecha_inicio."+ ".(30*(Request()->mesnumber-1))." days" ))}}</span>
        @endif )
</h4>
<br>
<br>
@if(count($trabjasignados)>0)
<div class="row g-2 mx-3">
    <div class="col-md">
        <div class="form-floating">

            <input value="{{$trabjasignados[0]->fecha_dosim_enviado}}" type="date" class="form-control" name="fecha_envio_dosim_asignado" id="fecha_envio_dosim_asignado" >
            <label for="floatingInputGrid">FECHA ENVIO</label>
        </div>
    </div>
    <div class="col-md">
        <div class="form-floating">
            <input value="{{$trabjasignados[0]->fecha_dosim_recibido}}" type="date" class="form-control" name="fecha_recibido_dosim_asignado" id="fecha_recibido_dosim_asignado" >
            <label for="floatingInputGrid">FECHA RECIBIDO</label>
        </div>
    </div>
    <div class="col-md">
        <div class="form-floating">
            <input value="{{$trabjasignados[0]->fecha_dosim_devuelto}}" type="date" class="form-control" name="fecha_devuelto_dosim_asignado" id="fecha_devuelto_dosim_asignado" >
            <label for="floatingInputGrid">FECHA DEVUELTO</label>
        </div>
    </div>
    <br>
    <br>
    <center>
        <button type="submit" class="btn colorQA">Editar fechas</button>
    </center>
</div>
@endif
<br>
<br>
<div class="row">
    <div class="col"></div>
    <div class="col-10">
        <div class="table table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr class="table-active text-center">
                        <th style='width: 16.90%'>TRABAJADOR</th>
                        <th>N. IDEN.</th>
                        <th>DOSÍMETRO</th>
                        <th style='width: 14.90%'>HOLDER</th>
                        <th style='width: 9.90%'>OCUPACIÓN</th>
                        <th style='width: 28.90%'>ACCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($dosicontrolasig as $dosicontasig)
                        <tr>
                            <td>CONTROL</td>
                            <td>N.A.</td>
                            <td>{{$dosicontasig->dosimetro->codigo_dosimeter}}</td>
                            <td>N.A.</td>
                            <td>{{$dosicontasig->ocupacion}}</td>
                            <td>
                                <div class="container p-1">
                                    <div class="row">
                                        <div class="col p-1 text-center ">
                                            <a href="" class="btn colorQA btn-sm">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen-fill mb-1" viewBox="0 0 16 16">
                                                <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001z"/>
                                                </svg> <br> EDITAR
                                            </a>
                                        </div>
                                        <div class="col-md p-1 ">
                                            <form id="form_eliminar_sede" name="form_eliminar_sede" action="" method="POST">
                                                @csrf
                                                @method('delete')
                                                <button class="btn btn-danger btn-sm" onclick="Eliminar(evt);" type="submit">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                                    </svg> <br> ELIMINAR
                                                </button>
                                            </form>
                                        </div>
                                        <div class="col-md p-1 ">
                                            <a href="{{route('lecturadosicontrol.create', $dosicontasig->id_dosicontrolcontdosisedes)}}" class="btn colorQA btn-sm">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-card-checklist" viewBox="0 0 16 16">
                                                <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                                                <path d="M7 5.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0zM7 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0z"/>
                                                </svg><br> LECTURA
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    @foreach($trabjasignados as $trabasig)
                        <tr>
                            <td>{{$trabasig->trabajador->primer_nombre_trabajador}} {{$trabasig->trabajador->segundo_nombre_trabajador}} {{$trabasig->trabajador->primer_apellido_trabajador}} {{$trabasig->trabajador->segundo_apellido_trabajador}}</td>
                            <td>{{$trabasig->trabajador->cedula_trabajador}}</td>
                            <td>{{$trabasig->dosimetro->codigo_dosimeter}}</td>
                            <td>
                                @if($trabasig->holder_id == '')
                                    N.A.
                                @else
                                    {{$trabasig->holder->codigo_holder}} - {{$trabasig->holder->tipo_holder}}
                                @endif
                            </td>
                            <td>{{$trabasig->ocupacion}}</td>
                            <td>
                                <div class="container p-1">
                                    <div class="row">
                                        <div class="col p-1 text-center">
                                            <button data-bs-toggle="modal" data-bs-target="#trabajadorEdit{{$trabasig->trabajador->id_trabajador}}" class="btn colorQA btn-sm">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen-fill mb-1" viewBox="0 0 16 16">
                                                <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001z"/>
                                                </svg> <br> EDITAR
                                            </button>
                                        </div>
                                        <div class="col-md p-1 ">

                                                <button data-bs-toggle="modal" data-bs-target="#trabajadorDelete{{$trabasig->trabajador->id_trabajador}}" class="btn btn-danger btn-sm" onclick="Eliminar(evt);" type="submit">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                                    </svg> <br> ELIMINAR
                                                </button>

                                        </div>
                                        <div class="col-md p-1 ">
                                            <a href="{{route('lecturadosi.create', $trabasig->id_trabajadordosimetro)}}" class="btn colorQA btn-sm">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-card-checklist" viewBox="0 0 16 16">
                                                <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                                                <path d="M7 5.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0zM7 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0z"/>
                                                </svg><br> LECTURA
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="col"></div>
</div>

<!-- Modal -->
@foreach($trabjasignados as $trab)
    <div class="modal fade" id="trabajadorDelete{{$trab->trabajador->id_trabajador}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">{{$trab->trabajador->primer_nombre_trabajador}} {{$trab->trabajador->segundo_nombre_trabajador}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="form_eliminar_dosimetro" name="form_eliminar_dosimetro" action="{{route('asignadosicontrato.deleteInfo', ['idWork' => $trab->trabajador->id_trabajador, 'contratoId' => $contdosisededepto->id_contdosisededepto, 'mesnumber'=>Request()->mesnumber ]  )}}" method="POST">
                    <div class="modal-body">
                        <span>¿Eliminar a este trabajador junto con su dosimetro asignado?</span>
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
@foreach($trabjasignados as $trab)
    <div class="modal fade" id="trabajadorEdit{{$trab->trabajador->id_trabajador}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">{{$trab->trabajador->primer_nombre_trabajador}} {{$trab->trabajador->segundo_nombre_trabajador}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="form_eliminar_dosimetro" name="form_editar_dosimetro" action="{{route('asignadosicontrato.updateInfo', ['idWork' => $trab->trabajador->id_trabajador, 'contratoId' => $contdosisededepto->id_contdosisededepto, 'mesnumber'=>Request()->mesnumber ]  )}}" method="POST">
                    <div class="modal-body">
                        <span>¿Editar el dosimetro de este trabajador?</span>
                        @csrf
                        @method('patch')
                        <br>
                        <br>
                        <span>Tenga en cuenta que esta acción varia en función de los dosimetros que aún queden disponibles
                        en el momento y de los tipos que haya contratado la empresa</span>
                        <br>
                        <br>
                        <table class="table table-sm table-bordered">
                            <tr>
                                <th class="text-center">Dosimetro</th>
                                <th class="text-center">Holder</th>
                                <th class="text-center">Ocupación</th>
                            </tr>
                            <tr>
                            <td>
                                <select class="form-select" name="id_dosimetro_asigdosim" id="id_dosimetro_asigdosim"  autofocus aria-label="Floating label select example">
                                    <option value="">--</option>
                                    <?php $cez=0; $cam=0; $cce=0; ?>
                                    @foreach($dosimetros as $dosi)
                                        @if($dosi->tipo_dosimetro == 'EZCLIP' && ($contdosisededepto->dosi_ezclip - $cez)>0)
                                            <?php $cez++; ?>
                                            <option onclick="count('EZCLIP')" change="saveTypeDosi({{$dosi->tipo_dosimetro}})" value ="{{$dosi->id_dosimetro}}">{{$dosi->codigo_dosimeter}} - {{$dosi->tipo_dosimetro}}</option>
                                        @elseif($dosi->tipo_dosimetro == 'CUERPO' && ($contdosisededepto->dosi_cuerpo_entero - $cce)>0)
                                            <?php $cce++; ?>
                                            <option change="saveTypeDosi({{$dosi->tipo_dosimetro}})" value ="{{$dosi->id_dosimetro}}">{{$dosi->codigo_dosimeter}} - {{$dosi->tipo_dosimetro}}</option>
                                        @elseif($dosi->tipo_dosimetro == 'AMBIENTAL' && ($contdosisededepto->dosi_ambiental - $cam)>0)
                                            <?php $cam++; ?>
                                            <option change="saveTypeDosi({{$dosi->tipo_dosimetro}})" value ="{{$dosi->id_dosimetro}}">{{$dosi->codigo_dosimeter}} - {{$dosi->tipo_dosimetro}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </td>
                                <td>
                                    <select class="form-select" name="id_holder_asigdosim" id="id_holder_asigdosim" autofocus aria-label="Floating label select example">
                                        @foreach($holders as $hol)

                                            <option value ="{{$hol->id_holder}}">{{$hol->codigo_holder}} - {{$hol->tipo_holder}}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <select class="form-select" name="ocupacion_asigdosim_control" id="ocupacion_asigdosim_control" autofocus style="text-transform:uppercase">
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
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn colorQA">Editar dosimetro</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach
@endsection
