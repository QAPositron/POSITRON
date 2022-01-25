@extends('layouts.plantillabase')
@section('contenido')

<h3 class="text-center">{{$contdosisede->sede->empresa->nombre_empresa}} - {{$contdosisede->sede->nombre_sede}}</h3>
<br>
<h4 class="text-center">CONTRATO No. {{$contdosisede->dosimetriacontrato->codigo_contrato}}</h4>
<br>
<h4 class="text-center">TRABAJADORES ASIGNADOS</h4>

<div class="row">
    <div class="col"></div>
    <div class="col-9">
        <div class="table table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr class="table-active text-center">
                        <th>TRABAJADOR</th>
                        <th>N. IDEN.</th>
                        <th>DOSÍMETRO</th>
                        <th style='width: 14.90%'>HOLDER</th>
                        <th>OCUPACIÓN</th>
                        <th style='width: 25.90%'>ACCIONES</th>
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
@endsection