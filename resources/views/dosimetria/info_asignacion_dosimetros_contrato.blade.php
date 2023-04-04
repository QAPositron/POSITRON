@extends('layouts.app')
@extends('layouts.plantillabase')
@section('contenido')

<div class="row">
    <div class="col-md ">
        <a type="button" class="btn btn-circle colorQA" href="{{route('detallesedecont.create', $contdosisededepto->id_contdosisededepto)}}">
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-arrow-left mt-1" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
            </svg>
        </a>
    </div>
    <div class="col-md-9">
        <h2 class="text-center">DOSIMETRÍA DE </h2>
        <h3 class="text-center"><i>{{$contdosisededepto->contratodosimetriasede->sede->empresa->nombre_empresa}}</i>- SEDE: <i>{{$contdosisededepto->contratodosimetriasede->sede->nombre_sede}}</i> </h3>
        <h3 class="text-center">ESPECIALIDAD: <i>{{$contdosisededepto->departamentosede->departamento->nombre_departamento}}</i> </h3>
    </div>
    <div class="col-md"></div>
</div>
<br>
<h4 class="text-center" id="id_contrato"></h4>
<br>

<br>
<h3 class="text-center">
    TRABAJADORES ASIGNADOS AL PERÍODO {{ Request()->mesnumber  }} (
        @if(Request()->mesnumber == 1)
            @php
                $meses = ["01"=>'ENERO', "02"=>'FEBRERO', "03"=>'MARZO', "04"=>'ABRIL', "05"=>'MAYO', "06"=>'JUNIO', "07"=>'JULIO', "08"=>'AGOSTO', "09"=>'SEPTIEMBRE', "10"=>'OCTUBRE', "11"=>'NOVIEMBRE', "12"=>'DICIEMBRE'];
                echo $meses[date("m", strtotime($contdosisededepto->contratodosimetriasede->dosimetriacontrato->fecha_inicio))]." DE ".date("Y", strtotime($contdosisededepto->contratodosimetriasede->dosimetriacontrato->fecha_inicio)) ;
            @endphp
        @else
            <span id="mes{{Request()->mesnumber}}"></span>
        @endif 
    )
</h3>
<br>

@if(count($trabjasignados)>0 || count($dosicontrolasig)>0)
    <form id="edit_fecha_contasig" name="edit_fecha_contasig" action="{{route('asignadosicontrato.updatefechas', ['id'=>$contdosisededepto->id_contdosisededepto, 'mesnumber'=> Request()->mesnumber])}}" method="POST">
        @csrf
        @method('put')
        <div class="row g-2 mx-3">
            <div class="col-md">
                <div class="form-floating">
                    <input value="{{$trabjasignados->isEmpty() ? $dosicontrolasig[0]->fecha_dosim_enviado : $trabjasignados[0]->fecha_dosim_enviado}}" type="date" class="form-control" name="fecha_envio_dosim_asignado" id="fecha_envio_dosim_asignado" >
                    <label for="floatingInputGrid">FECHA ENVIO</label>
                </div>
            </div>
            <div class="col-md">
                <div class="form-floating">
                    <input value="{{$trabjasignados->isEmpty() ? $dosicontrolasig[0]->fecha_dosim_recibido : $trabjasignados[0]->fecha_dosim_recibido}}" type="date" class="form-control" name="fecha_recibido_dosim_asignado" id="fecha_recibido_dosim_asignado" >
                    <label for="floatingInputGrid">FECHA RECIBIDO</label>
                </div>
            </div>
            <div class="col-md">
                <div class="form-floating">
                    <input value="{{$trabjasignados->isEmpty() ? $dosicontrolasig[0]->fecha_dosim_devuelto : $trabjasignados[0]->fecha_dosim_devuelto}}" type="date" class="form-control" name="fecha_devuelto_dosim_asignado" id="fecha_devuelto_dosim_asignado" >
                    <label for="floatingInputGrid">FECHA DEVUELTO</label>
                </div>
            </div>
        </div>
        <br>
        <br>
        <div class="row">
            <div class="col-md"></div>
            <div class="col-md text-center">
                <button type="submit" class="btn colorQA" style="width: 200px">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill mb-1" viewBox="0 0 16 16">
                        <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                    </svg> EDITAR FECHAS
                </button>
            </div>
           
            <div class="col-md"></div>
        </div>
    </form>
@endif
<br>
<br>
<div class="row">
    <div class="col-md bg-danger"></div>
    <div class="col-md-12">
        <div class="table table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr class="table-active text-center">
                        <th rowspan="2" class='align-middle' style='width: 8.0%'>TRABAJADOR</th>
                        <th rowspan="2" class='align-middle' style='width: 4.90%'>N. IDEN.</th>
                        <th rowspan="2" class='align-middle' style='width: 7.90%'>DOSÍM.</th>
                        <th rowspan="2" class='align-middle' style='width: 4.90%'>HOLDER</th>
                        <th rowspan="2" class='align-middle' style='width: 2.90%'>OCUP.</th>
                        <th rowspan="2" class='align-middle' style='width: 4.90%'>UBI.</th>
                        <th colspan="2" class='align-middle' style='width: 4.90%'>Hp(10)</th>
                        <th colspan="2" class='align-middle' style='width: 4.90%'>Hp(3)</th>
                        <th colspan="2" class='align-middle' style='width: 4.90%'>Hp(0.07)</th>
                        <th rowspan="2" class='align-middle' style='width: 4.90%'>NOTAS</th>
                        <th rowspan="2" class='align-middle' style='width: 10.0%' >ACCIONES</th>
                    </tr>
                    <tr class="table-active text-center">
                        <th class='align-middle' style='width: 3.90%'>MED.</th>
                        <th class='align-middle' style='width: 3.90%'>LEC.</th>
                        <th class='align-middle' style='width: 3.90%'>MED.</th>
                        <th class='align-middle' style='width: 3.90%'>LEC.</th>
                        <th class='align-middle' style='width: 3.90%'>MED.</th>
                        <th class='align-middle' style='width: 3.90%'>LEC.</th>
                    </tr>
                </thead>
                <tbody>
                    @if($dosicontrolToraxasig->isEmpty() || $dosicontrolCristalinoasig->isEmpty() || $dosicontrolDedoasig->isEmpty())
                        
                        {{--@foreach($dosiareasignados as $dosiareasig)
                            <tr>
                                <td class='align-middle'>{{$dosiareasig->areadepartamentosede->nombre_area}}</td>
                                <td class='align-middle'>N.A.</td>
                                <td class='align-middle'>{{$dosiareasig->dosimetro->codigo_dosimeter}}</td>
                                <td class='align-middle'>N.A.</td>
                                <td class='align-middle'>{{$dosiareasig->ocupacion}}</td>
                                <td class='align-middle'>ÁREA</td>
                                <td class='align-middle'>{{$dosiareasig->measurement_date}}</td>
                                <td class='align-middle'>{{$dosiareasig->verification_date}}</td>
                                <td class='align-middle'>{{$dosiareasig->verification_required_on_or_before}}</td>
                                <td class='align-middle'>{{$dosiareasig->remaining_days_available_for_use}}</td>
                                <td class='align-middle'>
                                    @for($i=1; $i<=5; $i++)
                                        @if($dosiareasig->{"nota$i"} == 'TRUE')
                                            {{$i}})
                                        @endif 
                                    @endfor
                                    @if($dosiareasig->DNL == 'TRUE')
                                        {{'DNL'}}
                                    @endif
                                </td>
                                <td>
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md p-1">
                                                <a href="{{route('lecturadosiarea.create', $dosiareasig->id_dosiareacontdosisedes)}}" class="btn colorQA btn-sm">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-card-checklist" viewBox="0 0 16 16">
                                                    <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                                                    <path d="M7 5.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0zM7 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0z"/>
                                                    </svg><br> LECTURA
                                                </a>
                                            </div>
                                            <div class="col-md p-1">
                                                <form id="form_eliminar_asigcontrol" name="form_eliminar_asigcontrol" action="" method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="btn btn-danger btn-sm" type="submit">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                                        </svg> <br> ELIMINAR
                                                    </button>
                                                </form>
                                            </div>
                                            <div class="col p-1 text-center">
                                                <a href="" class="btn colorQA btn-sm">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                                        <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                                    </svg> <br> EDITAR
                                                </a>
                                            </div>
                                        </div>  
                                    </div>
                                </td>
                            </tr>
                        @endforeach --}}
                        @foreach($trabjasignados as $trabasig)
                            <tr id='{{$trabasig->id_trabajadordosimetro}}'>
                                <td class='align-middle'>@if(!empty($trabasig->persona->primer_nombre_persona)){{$trabasig->persona->primer_nombre_persona}} {{$trabasig->persona->segundo_nombre_persona}} {{$trabasig->persona->primer_apellido_persona}} {{$trabasig->persona->segundo_apellido_persona}}@endif </td>
                                <td class='align-middle text-center'>@if(!empty($trabasig->persona->cedula_persona)) {{$trabasig->persona->cedula_persona}}@endif </td>
                                <td class='align-middle text-center'>{{$trabasig->dosimetro->codigo_dosimeter}}</td>
                                <td class='align-middle text-center'>
                                    @if($trabasig->holder_id == '')
                                        N.A.
                                    @else
                                        {{$trabasig->holder->codigo_holder}}
                                    @endif
                                </td>
                                <td class='align-middle text-center'>{{$trabasig->ocupacion}}</td>
                                <td class='align-middle text-center'>{{$trabasig->ubicacion}}</td>
                                <td class='align-middle text-center'>
                                    @if($trabasig->nota2 == 'TRUE')
                                        {{'NP'}}
                                    @elseif($trabasig->DNL == 'TRUE')
                                        {{'DNL'}}
                                    @elseif($trabasig->EU == 'TRUE')
                                        {{'EU'}}
                                    @elseif($trabasig->DPL == 'TRUE')
                                        {{'DPL'}}
                                    @elseif($trabasig->DSU == 'TRUE')
                                        {{'DSU'}}
                                    @else
                                        {{$trabasig->Hp10_calc_dose}}
                                    @endif
                                </td>
                                <td class='align-middle text-center'></td>
                                <td class='align-middle text-center'>
                                    @if($trabasig->nota2 == 'TRUE')
                                        {{'NP'}}
                                    @elseif($trabasig->DNL == 'TRUE')
                                        {{'DNL'}}
                                    @elseif($trabasig->EU == 'TRUE')
                                        {{'EU'}}
                                    @elseif($trabasig->DPL == 'TRUE')
                                        {{'DPL'}}
                                    @elseif($trabasig->DSU == 'TRUE')
                                        {{'DSU'}}
                                    @else
                                        {{$trabasig->Hp3_calc_dose}}
                                    @endif
                                </td>
                                <td class='align-middle text-center'></td>
                                <td class='align-middle text-center'>
                                    @if($trabasig->nota2 == 'TRUE')
                                        {{'NP'}}
                                    @elseif($trabasig->DNL == 'TRUE')
                                        {{'DNL'}}
                                    @elseif($trabasig->EU == 'TRUE')
                                        {{'EU'}}
                                    @elseif($trabasig->DPL == 'TRUE')
                                        {{'DPL'}}
                                    @elseif($trabasig->DSU == 'TRUE')
                                        {{'DSU'}}
                                    @else
                                        {{$trabasig->Hp007_calc_dose}}
                                    @endif
                                </td>
                                <td class='align-middle'></td>
                                <td class='align-middle text-center'>
                                    @for($i=1; $i<=6; $i++)
                                        @if($trabasig->{"nota$i"} == 'TRUE')
                                            {{$i}})
                                        @endif 
                                    @endfor
                                </td>
                                <td class='align-middle text-center'>
                                    <div class="row px-2">
                                        <div class="col-md text-center p-0 m-0">
                                            <a href="{{route('lecturadosi.create', $trabasig->id_trabajadordosimetro )}}" class="btn colorQA btn-sm">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-card-checklist" viewBox="0 0 16 16">
                                                <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                                                <path d="M7 5.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0zM7 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0z"/>
                                                </svg><br> LECTURA
                                            </a>
                                        </div>
                                        <div class="col-md text-center p-0 m-0">
                                            <a href="{{route('lecturadosi.edit', $trabasig->id_trabajadordosimetro)}}" class="btn colorQA btn-sm">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                                    <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                                </svg><br> EDITAR
                                            </a>
                                        </div>
                                        {{-- <div class="col-md text-center p-0 m-0">
                                            <form id="form_eliminar_trabajadorasig" name="form_eliminar_trabajadorasig" class="form_eliminar_trabajadorasig" action="{{route('asigdosicont.destroyInfoTrabajador', $trabasig->id_trabajadordosimetro)}}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <button class="btn btn-danger btn-sm" type="submit">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                                    </svg> <br> ELIMINAR
                                                </button>
                                            </form>
                                        </div> --}}
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        @foreach($dosicontrolToraxasig as $dosicontToraxasig)
                            <tr id="C{{$dosicontToraxasig->id_dosicontrolcontdosisedes}}">
                                <td class='align-middle'><b>CONTROL TÓRAX</b> </td>
                                <td class='align-middle text-center'><b>N.A.</b> </td>
                                <td class='align-middle text-center'><b>{{$dosicontToraxasig->dosimetro->codigo_dosimeter}}</b> </td>
                                <td class='align-middle text-center'><b>N.A.</b></td>
                                <td class='align-middle text-center'><b>{{$dosicontToraxasig->ocupacion}}</b></td>
                                <td class='align-middle text-center'><b>CONTROL TÓRAX</b></td>
                                <td colspan="2" class='align-middle text-center'>
                                    @if($dosicontToraxasig->nota2 == 'TRUE')
                                        <b>{{'NP'}}</b>
                                    @elseif($dosicontToraxasig->DNL == 'TRUE')
                                        <b>{{'DNL'}}</b>
                                    @elseif($dosicontToraxasig->EU == 'TRUE')
                                        <b>{{'EU'}}</b>
                                    @elseif($dosicontToraxasig->DPL == 'TRUE')
                                        <b>{{'DPL'}}</b>
                                    @elseif($dosicontToraxasig->DSU == 'TRUE')
                                        <b>{{'DSU'}}</b>
                                    @else
                                        <b>{{$dosicontToraxasig->Hp10_calc_dose}}</b>
                                    @endif
                                </td>
                                <td colspan="2" class='align-middle text-center'>
                                    @if($dosicontToraxasig->nota2 == 'TRUE')
                                        <b>{{'NP'}}</b>
                                    @elseif($dosicontToraxasig->DNL == 'TRUE')
                                        <b>{{'DNL'}}</b>
                                    @elseif($dosicontToraxasig->EU == 'TRUE')
                                        <b>{{'EU'}}</b>
                                    @elseif($dosicontToraxasig->DPL == 'TRUE')
                                        <b>{{'DPL'}}</b>
                                    @elseif($dosicontToraxasig->DSU == 'TRUE')
                                        <b>{{'DSU'}}</b>
                                    @else
                                        <b>{{$dosicontToraxasig->Hp3_calc_dose}}</b>
                                    @endif
                                </td>
                                <td colspan="2" class='align-middle text-center'>
                                    @if($dosicontToraxasig->nota2 == 'TRUE')
                                        <b>{{'NP'}}</b>
                                    @elseif($dosicontToraxasig->DNL == 'TRUE')
                                        <b>{{'DNL'}}</b>
                                    @elseif($dosicontToraxasig->EU == 'TRUE')
                                        <b>{{'EU'}}</b>
                                    @elseif($dosicontToraxasig->DPL == 'TRUE')
                                        <b>{{'DPL'}}</b>
                                    @elseif($dosicontToraxasig->DSU == 'TRUE')
                                        <b>{{'DSU'}}</b>
                                    @else
                                        <b>{{$dosicontToraxasig->Hp007_calc_dose}}</b>
                                    @endif
                                </td>
                                {{-- <td class='align-middle'></td> --}}
                                <td class='align-middle text-center'>
                                    @for($i=1; $i<=6; $i++)
                                        @if($dosicontToraxasig->{"nota$i"} == 'TRUE')
                                            <b>{{$i}})</b>
                                        @endif 
                                    @endfor
                                </td>
                                <td class='align-middle text-center'>
                                    <div class="row px-2">
                                        <div class="col-md m-0 p-0">
                                            <a href="{{route('lecturadosicontrol.create', $dosicontToraxasig->id_dosicontrolcontdosisedes)}}" class="btn colorQA btn-sm">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-card-checklist" viewBox="0 0 16 16">
                                                <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                                                <path d="M7 5.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0zM7 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0z"/>
                                                </svg><br> LECTURA
                                            </a> 
                                        </div>
                                        <div class="col-md m-0 p-0">
                                            <a href="{{route('lecturadosicontrol.edit', $dosicontToraxasig->id_dosicontrolcontdosisedes)}}" class="btn colorQA btn-sm">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                                    <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                                </svg> <br> EDITAR
                                            </a>
                                        </div>
                                        {{-- <div class="col-md m-0 p-0">
                                            <form id="form_eliminar_asigcontrol" name="form_eliminar_asigcontrol" action="{{route('asigdosicont.destroyInfoControl',  $dosicontToraxasig->id_dosicontrolcontdosisedes)}}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <button class="btn btn-danger btn-sm" type="submit">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                                    </svg> <br> ELIMINAR
                                                </button>
                                            </form>
                                        </div> --}}
                                    </div>  
                                </td>
                            </tr>
                            {{--@foreach($dosiareasignados as $dosiareasig)
                                <tr>
                                    <td class='align-middle'>{{$dosiareasig->areadepartamentosede->nombre_area}}</td>
                                    <td class='align-middle'>N.A.</td>
                                    <td class='align-middle'>{{$dosiareasig->dosimetro->codigo_dosimeter}}</td>
                                    <td class='align-middle'>N.A.</td>
                                    <td class='align-middle'>{{$dosiareasig->ocupacion}}</td>
                                    <td class='align-middle'>ÁREA</td>
                                    <td class='align-middle'>{{$dosiareasig->measurement_date}}</td>
                                    <td class='align-middle'>{{$dosiareasig->verification_date}}</td>
                                    <td class='align-middle'>{{$dosiareasig->verification_required_on_or_before}}</td>
                                    <td class='align-middle'>{{$dosiareasig->remaining_days_available_for_use}}</td>
                                    <td class='align-middle'>
                                        @for($i=1; $i<=5; $i++)
                                            @if($dosiareasig->{"nota$i"} == 'TRUE')
                                                {{$i}})
                                            @endif 
                                        @endfor
                                        @if($dosiareasig->DNL == 'TRUE')
                                            {{'DNL'}}
                                        @endif
                                    </td>
                                    <td>
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md p-1">
                                                    <a href="{{route('lecturadosiarea.create', $dosiareasig->id_dosiareacontdosisedes)}}" class="btn colorQA btn-sm">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-card-checklist" viewBox="0 0 16 16">
                                                        <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                                                        <path d="M7 5.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0zM7 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0z"/>
                                                        </svg><br> LECTURA
                                                    </a>
                                                </div>
                                                <div class="col-md p-1">
                                                    <form id="form_eliminar_asigcontrol" name="form_eliminar_asigcontrol" action="" method="POST">
                                                        @csrf
                                                        @method('delete')
                                                        <button class="btn btn-danger btn-sm" type="submit">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                                            </svg> <br> ELIMINAR
                                                        </button>
                                                    </form>
                                                </div>
                                                <div class="col p-1 text-center">
                                                    <a href="" class="btn colorQA btn-sm">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                                            <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                                        </svg> <br> EDITAR
                                                    </a>
                                                </div>
                                            </div>  
                                        </div>
                                    </td>
                                </tr>
                            @endforeach --}}
                            @foreach($trabjasignados as $trabasig)
                                @if($trabasig->ubicacion == 'TORAX')
                                    <tr id='{{$trabasig->id_trabajadordosimetro}}'>
                                        <td class='align-middle'>@if(!empty($trabasig->persona->primer_nombre_persona)){{$trabasig->persona->primer_nombre_persona}} {{$trabasig->persona->segundo_nombre_persona}} {{$trabasig->persona->primer_apellido_persona}} {{$trabasig->persona->segundo_apellido_persona}}@endif </td>
                                        <td class='align-middle text-center'>@if(!empty($trabasig->persona->cedula_persona)) {{$trabasig->persona->cedula_persona}}@endif </td>
                                        <td class='align-middle text-center'>{{$trabasig->dosimetro->codigo_dosimeter}}</td>
                                        <td class='align-middle text-center'>
                                            @if($trabasig->holder_id == '')
                                                N.A.
                                            @else
                                                {{$trabasig->holder->codigo_holder}}
                                            @endif
                                        </td>
                                        <td class='align-middle text-center'>{{$trabasig->ocupacion}}</td>
                                        <td class='align-middle text-center'>{{$trabasig->ubicacion}}</td>
                                        <td class='align-middle text-center'>
                                            @if($trabasig->nota2 == 'TRUE')
                                                {{'NP'}}
                                            @elseif($trabasig->DNL == 'TRUE')
                                                {{'DNL'}}
                                            @elseif($trabasig->EU == 'TRUE')
                                                {{'EU'}}
                                            @elseif($trabasig->DPL == 'TRUE')
                                                {{'DPL'}}
                                            @elseif($trabasig->DSU == 'TRUE')
                                                {{'DSU'}}
                                            @else
                                                {{$trabasig->Hp10_calc_dose}}
                                            @endif
                                        </td>
                                        <td class='align-middle text-center'>
                                            {{$trabasig->Hp10_calc_dose - $dosicontToraxasig->Hp10_calc_dose}}
                                        </td>
                                        <td class='align-middle text-center'>
                                            @if($trabasig->nota2 == 'TRUE')
                                                {{'NP'}}
                                            @elseif($trabasig->DNL == 'TRUE')
                                                {{'DNL'}}
                                            @elseif($trabasig->EU == 'TRUE')
                                                {{'EU'}}
                                            @elseif($trabasig->DPL == 'TRUE')
                                                {{'DPL'}}
                                            @elseif($trabasig->DSU == 'TRUE')
                                                {{'DSU'}}
                                            @else
                                                {{$trabasig->Hp3_calc_dose}}
                                            @endif
                                        </td>
                                        <td class='align-middle text-center'>
                                        </td>
                                        <td class='align-middle text-center'>
                                            @if($trabasig->nota2 == 'TRUE')
                                                {{'NP'}}
                                            @elseif($trabasig->DNL == 'TRUE')
                                                {{'DNL'}}
                                            @elseif($trabasig->EU == 'TRUE')
                                                {{'EU'}}
                                            @elseif($trabasig->DPL == 'TRUE')
                                                {{'DPL'}}
                                            @elseif($trabasig->DSU == 'TRUE')
                                                {{'DSU'}}
                                            @else
                                                {{$trabasig->Hp007_calc_dose}}
                                            @endif
                                        </td>
                                        <td class='align-middle text-center'>
                                            {{$trabasig->Hp007_calc_dose - $dosicontToraxasig->Hp007_calc_dose}}
                                        </td>
                                        <td class='align-middle text-center'>
                                            @for($i=1; $i<=6; $i++)
                                                @if($trabasig->{"nota$i"} == 'TRUE')
                                                    {{$i}})
                                                @endif 
                                            @endfor
                                        </td>
                                        <td class='align-middle text-center '>
                                            <div class="row px-2">
                                                <div class="col-md p-0 m-0">
                                                    <a href="{{route('lecturadosicontrl.create', ['lecdosi'=>$trabasig->id_trabajadordosimetro, 'lecdosicontrol'=>$dosicontToraxasig->id_dosicontrolcontdosisedes])}}" class="btn colorQA btn-sm">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-card-checklist" viewBox="0 0 16 16">
                                                        <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                                                        <path d="M7 5.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0zM7 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0z"/>
                                                        </svg><br> LECTURA
                                                    </a>
                                                </div>
                                                <div class="col-md p-0 m-0">
                                                    <a href="{{route('lecturadosi.edit', $trabasig->id_trabajadordosimetro)}}" class="btn colorQA btn-sm">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                                            <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                                        </svg><br> EDITAR
                                                    </a>
                                                </div>
                                                {{-- <div class="col-md p-0 m-0">
                                                    <form id="form_eliminar_trabajadorasig" name="form_eliminar_trabajadorasig" class="form_eliminar_trabajadorasig" action="{{route('asigdosicont.destroyInfoTrabajador', $trabasig->id_trabajadordosimetro)}}" method="POST">
                                                        @csrf
                                                        @method('delete')
                                                        <button class="btn btn-danger btn-sm" type="submit">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                                            </svg> <br> ELIMINAR
                                                        </button>
                                                    </form>
                                                </div> --}}
                                            </div>
                                            
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        @endforeach
                        @foreach($dosicontrolCristalinoasig as $dosicontCristalinoasig)
                            <tr id="C{{$dosicontCristalinoasig->id_dosicontrolcontdosisedes}}">
                                <td class='align-middle'> <b>CONTROL CRISTALINO</b> </td>
                                <td class='align-middle text-center'><b>N.A.</b></td>
                                <td class='align-middle text-center'><b>{{$dosicontCristalinoasig->dosimetro->codigo_dosimeter}}</b></td>
                                <td class='align-middle text-center'><b>{{$dosicontCristalinoasig->holder->codigo_holder}}</b></td>
                                <td class='align-middle text-center'><b>{{$dosicontCristalinoasig->ocupacion}}</b></td>
                                <td class='align-middle text-center'><b>CONTROL CRISTALINO</b></td>
                                <td colspan="2" class='align-middle text-center'>
                                    @if($dosicontCristalinoasig->nota2 == 'TRUE')
                                        <b>{{'NP'}}</b>
                                    @elseif($dosicontCristalinoasig->DNL == 'TRUE')
                                        <b>{{'DNL'}}</b>
                                    @elseif($dosicontCristalinoasig->EU == 'TRUE')
                                        <b>{{'EU'}}</b>
                                    @elseif($dosicontCristalinoasig->DPL == 'TRUE')
                                        <b>{{'DPL'}}</b>
                                    @elseif($dosicontCristalinoasig->DSU == 'TRUE')
                                        <b>{{'DSU'}}</b>
                                    @else
                                        <b>{{$dosicontCristalinoasig->Hp10_calc_dose}}</b>
                                    @endif
                                </td>
                                <td colspan="2" class='align-middle text-center'>
                                    @if($dosicontCristalinoasig->nota2 == 'TRUE')
                                        <b>{{'NP'}}</b>
                                    @elseif($dosicontCristalinoasig->DNL == 'TRUE')
                                        <b>{{'DNL'}}</b>
                                    @elseif($dosicontCristalinoasig->EU == 'TRUE')
                                        <b>{{'EU'}}</b>
                                    @elseif($dosicontCristalinoasig->DPL == 'TRUE')
                                        <b>{{'DPL'}}</b>
                                    @elseif($dosicontCristalinoasig->DSU == 'TRUE')
                                        <b>{{'DSU'}}</b>
                                    @else
                                        <b>{{$dosicontCristalinoasig->Hp3_calc_dose}}</b>
                                    @endif
                                </td>
                                <td colspan="2" class='align-middle text-center'>
                                    @if($dosicontCristalinoasig->nota2 == 'TRUE')
                                        <b>{{'NP'}}</b>
                                    @elseif($dosicontCristalinoasig->DNL == 'TRUE')
                                        <b>{{'DNL'}}</b>
                                    @elseif($dosicontCristalinoasig->EU == 'TRUE')
                                        <b>{{'EU'}}</b>
                                    @elseif($dosicontCristalinoasig->DPL == 'TRUE')
                                        <b>{{'DPL'}}</b>
                                    @elseif($dosicontCristalinoasig->DSU == 'TRUE')
                                        <b>{{'DSU'}}</b>
                                    @else
                                        <b>{{$dosicontCristalinoasig->Hp007_calc_dose}}</b>
                                    @endif
                                </td>
                                {{-- <td class='align-middle'></td> --}}
                                <td class='align-middle text-center'>
                                    @for($i=1; $i<=6; $i++)
                                        @if($dosicontCristalinoasig->{"nota$i"} == 'TRUE')
                                            <b>{{$i}})</b>
                                        @endif 
                                    @endfor
                                </td>
                                <td class='align-middle text-center'>
                                    <div class="row px-2">
                                        <div class="col-md m-0 p-0">
                                            <a href="{{route('lecturadosicontrol.create', $dosicontCristalinoasig->id_dosicontrolcontdosisedes)}}" class="btn colorQA btn-sm">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-card-checklist" viewBox="0 0 16 16">
                                                <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                                                <path d="M7 5.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0zM7 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0z"/>
                                                </svg><br> LECTURA
                                            </a> 
                                        </div>
                                        <div class="col-md m-0 p-0">
                                            <a href="{{route('lecturadosicontrol.edit', $dosicontCristalinoasig->id_dosicontrolcontdosisedes)}}" class="btn colorQA btn-sm">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                                    <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                                </svg> <br> EDITAR
                                            </a>
                                        </div>
                                        {{-- <div class="col-md m-0 p-0">
                                            <form id="form_eliminar_asigcontrol" name="form_eliminar_asigcontrol" action="{{route('asigdosicont.destroyInfoControl',  $dosicontCristalinoasig->id_dosicontrolcontdosisedes)}}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <button class="btn btn-danger btn-sm" type="submit">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                                    </svg> <br> ELIMINAR
                                                </button>
                                            </form>
                                        </div> --}}
                                    </div>  
                                </td>
                            </tr>
                            @foreach($trabjasignados as $trabasig)
                                @if($trabasig->ubicacion == 'CRISTALINO')
                                    <tr id='{{$trabasig->id_trabajadordosimetro}}'>
                                        <td class='align-middle'>@if(!empty($trabasig->persona->primer_nombre_persona)){{$trabasig->persona->primer_nombre_persona}} {{$trabasig->persona->segundo_nombre_persona}} {{$trabasig->persona->primer_apellido_persona}} {{$trabasig->persona->segundo_apellido_persona}}@endif </td>
                                        <td class='align-middle text-center'>@if(!empty($trabasig->persona->cedula_persona)) {{$trabasig->persona->cedula_persona}}@endif </td>
                                        <td class='align-middle text-center'>{{$trabasig->dosimetro->codigo_dosimeter}}</td>
                                        <td class='align-middle text-center'>
                                            @if($trabasig->holder_id == '')
                                                N.A.
                                            @else
                                                {{$trabasig->holder->codigo_holder}}
                                            @endif
                                        </td>
                                        <td class='align-middle text-center'>{{$trabasig->ocupacion}}</td>
                                        <td class='align-middle text-center'>{{$trabasig->ubicacion}}</td>
                                        <td class='align-middle text-center'>
                                            @if($trabasig->nota2 == 'TRUE')
                                                {{'NP'}}
                                            @elseif($trabasig->DNL == 'TRUE')
                                                {{'DNL'}}
                                            @elseif($trabasig->EU == 'TRUE')
                                                {{'EU'}}
                                            @elseif($trabasig->DPL == 'TRUE')
                                                {{'DPL'}}
                                            @elseif($trabasig->DSU == 'TRUE')
                                                {{'DSU'}}
                                            @else
                                                {{$trabasig->Hp10_calc_dose}}
                                            @endif
                                        </td>
                                        <td class='align-middle text-center'></td>
                                        <td class='align-middle text-center'>
                                            @if($trabasig->nota2 == 'TRUE')
                                                {{'NP'}}
                                            @elseif($trabasig->DNL == 'TRUE')
                                                {{'DNL'}}
                                            @elseif($trabasig->EU == 'TRUE')
                                                {{'EU'}}
                                            @elseif($trabasig->DPL == 'TRUE')
                                                {{'DPL'}}
                                            @elseif($trabasig->DSU == 'TRUE')
                                                {{'DSU'}}
                                            @else
                                                {{$trabasig->Hp3_calc_dose}}
                                            @endif
                                        </td>
                                        <td class='align-middle text-center'>
                                            {{$trabasig->Hp3_calc_dose-$dosicontCristalinoasig->Hp3_calc_dose}}
                                        </td>
                                        <td class='align-middle text-center'>
                                            @if($trabasig->nota2 == 'TRUE')
                                                {{'NP'}}
                                            @elseif($trabasig->DNL == 'TRUE')
                                                {{'DNL'}}
                                            @elseif($trabasig->EU == 'TRUE')
                                                {{'EU'}}
                                            @elseif($trabasig->DPL == 'TRUE')
                                                {{'DPL'}}
                                            @elseif($trabasig->DSU == 'TRUE')
                                                {{'DSU'}}
                                            @else
                                                {{$trabasig->Hp007_calc_dose}}
                                            @endif
                                        </td>
                                        <td class='align-middle text-center'></td>
                                        <td class='align-middle text-center'>
                                            @for($i=1; $i<=6; $i++)
                                                @if($trabasig->{"nota$i"} == 'TRUE')
                                                    {{$i}})
                                                @endif 
                                            @endfor
                                        </td>
                                        <td class='align-middle text-center '>
                                            <div class="row px-2">
                                                <div class="col-md p-0 m-0">
                                                    <a href="{{route('lecturadosicontrl.create', ['lecdosi'=>$trabasig->id_trabajadordosimetro, 'lecdosicontrol'=>$dosicontCristalinoasig->id_dosicontrolcontdosisedes])}}" class="btn colorQA btn-sm">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-card-checklist" viewBox="0 0 16 16">
                                                        <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                                                        <path d="M7 5.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0zM7 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0z"/>
                                                        </svg><br> LECTURA
                                                    </a>
                                                </div>
                                                <div class="col-md p-0 m-0">
                                                    <a href="{{route('lecturadosi.edit', $trabasig->id_trabajadordosimetro)}}" class="btn colorQA btn-sm">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                                            <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                                        </svg><br> EDITAR
                                                    </a>
                                                </div>
                                                {{-- <div class="col-md p-0 m-0">
                                                    <form id="form_eliminar_trabajadorasig" name="form_eliminar_trabajadorasig" class="form_eliminar_trabajadorasig" action="{{route('asigdosicont.destroyInfoTrabajador', $trabasig->id_trabajadordosimetro)}}" method="POST">
                                                        @csrf
                                                        @method('delete')
                                                        <button class="btn btn-danger btn-sm" type="submit">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                                            </svg> <br> ELIMINAR
                                                        </button>
                                                    </form>
                                                </div> --}}
                                            </div>
                                            
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        @endforeach
                        @foreach($dosicontrolDedoasig as $dosicontDedoasig)
                            <tr id="C{{$dosicontDedoasig->id_dosicontrolcontdosisedes}}">
                                <td class='align-middle'><b>CONTROL ANILLO</b></td>
                                <td class='align-middle text-center'><b>N.A.</b></td>
                                <td class='align-middle text-center'><b>{{$dosicontDedoasig->dosimetro->codigo_dosimeter}}</b></td>
                                <td class='align-middle text-center'><b>{{$dosicontDedoasig->holder->codigo_holder}}</b></td>
                                <td class='align-middle text-center'><b>{{$dosicontDedoasig->ocupacion}}</b></td>
                                <td class='align-middle text-center'><b>CONTROL ANILLO</b></td>
                                <td colspan="2" class='align-middle text-center'>
                                    @if($dosicontDedoasig->nota2 == 'TRUE')
                                        <b>{{'NP'}}</b>
                                    @elseif($dosicontDedoasig->DNL == 'TRUE')
                                        <b>{{'DNL'}}</b>
                                    @elseif($dosicontDedoasig->EU == 'TRUE')
                                        <b>{{'EU'}}</b>
                                    @elseif($dosicontDedoasig->DPL == 'TRUE')
                                        <b>{{'DPL'}}</b>
                                    @elseif($dosicontDedoasig->DSU == 'TRUE')
                                        <b>{{'DSU'}}</b>
                                    @else
                                        <b>{{$dosicontDedoasig->Hp10_calc_dose}}</b>
                                    @endif
                                </td>
                                <td colspan="2" class='align-middle text-center'>
                                    @if($dosicontDedoasig->nota2 == 'TRUE')
                                        <b>{{'NP'}}</b>
                                    @elseif($dosicontDedoasig->DNL == 'TRUE')
                                        <b>{{'DNL'}}</b>
                                    @elseif($dosicontDedoasig->EU == 'TRUE')
                                        <b>{{'EU'}}</b>
                                    @elseif($dosicontDedoasig->DPL == 'TRUE')
                                        <b>{{'DPL'}}</b>
                                    @elseif($dosicontDedoasig->DSU == 'TRUE')
                                        <b>{{'DSU'}}</b>
                                    @else
                                        <b>{{$dosicontDedoasig->Hp3_calc_dose}}</b>
                                    @endif
                                </td>
                                <td colspan="2" class='align-middle text-center'>
                                    @if($dosicontDedoasig->nota2 == 'TRUE')
                                        <b>{{'NP'}}</b>
                                    @elseif($dosicontDedoasig->DNL == 'TRUE')
                                        <b>{{'DNL'}}</b>
                                    @elseif($dosicontDedoasig->EU == 'TRUE')
                                        <b>{{'EU'}}</b>
                                    @elseif($dosicontDedoasig->DPL == 'TRUE')
                                        <b>{{'DPL'}}</b>
                                    @elseif($dosicontDedoasig->DSU == 'TRUE')
                                        <b>{{'DSU'}}</b>
                                    @else
                                        <b>{{$dosicontDedoasig->Hp007_calc_dose}}</b>
                                    @endif
                                </td>
                                {{-- <td class='align-middle'></td> --}}
                                <td class='align-middle text-center'>
                                    @for($i=1; $i<=6; $i++)
                                        @if($dosicontDedoasig->{"nota$i"} == 'TRUE')
                                            <b>{{$i}})</b>
                                        @endif 
                                    @endfor
                                </td>
                                <td class='align-middle text-center'>
                                    <div class="row px-2">
                                        <div class="col-md m-0 p-0">
                                            <a href="{{route('lecturadosicontrol.create', $dosicontDedoasig->id_dosicontrolcontdosisedes)}}" class="btn colorQA btn-sm">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-card-checklist" viewBox="0 0 16 16">
                                                <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                                                <path d="M7 5.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0zM7 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0z"/>
                                                </svg><br> LECTURA
                                            </a> 
                                        </div>
                                        <div class="col-md m-0 p-0">
                                            <a href="{{route('lecturadosicontrol.edit', $dosicontDedoasig->id_dosicontrolcontdosisedes)}}" class="btn colorQA btn-sm">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                                    <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                                </svg> <br> EDITAR
                                            </a>
                                        </div>
                                        {{-- <div class="col-md m-0 p-0">
                                            <form id="form_eliminar_asigcontrol" name="form_eliminar_asigcontrol" action="{{route('asigdosicont.destroyInfoControl',  $dosicontDedoasig->id_dosicontrolcontdosisedes)}}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <button class="btn btn-danger btn-sm" type="submit">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                                    </svg> <br> ELIMINAR
                                                </button>
                                            </form>
                                        </div> --}}
                                    </div>  
                                </td>
                            </tr>
                            @foreach($trabjasignados as $trabasig)
                                @if($trabasig->ubicacion == 'ANILLO')
                                    <tr id='{{$trabasig->id_trabajadordosimetro}}'>
                                        <td class='align-middle'>@if(!empty($trabasig->persona->primer_nombre_persona)){{$trabasig->persona->primer_nombre_persona}} {{$trabasig->persona->segundo_nombre_persona}} {{$trabasig->persona->primer_apellido_persona}} {{$trabasig->persona->segundo_apellido_persona}}@endif </td>
                                        <td class='align-middle text-center'>@if(!empty($trabasig->persona->cedula_persona)) {{$trabasig->persona->cedula_persona}}@endif </td>
                                        <td class='align-middle text-center'>{{$trabasig->dosimetro->codigo_dosimeter}}</td>
                                        <td class='align-middle text-center'>
                                            @if($trabasig->holder_id == '')
                                                N.A.
                                            @else
                                                {{$trabasig->holder->codigo_holder}}
                                            @endif
                                        </td>
                                        <td class='align-middle text-center'>{{$trabasig->ocupacion}}</td>
                                        <td class='align-middle text-center'>{{$trabasig->ubicacion}}</td>
                                        
                                        <td class='align-middle text-center'>
                                            @if($trabasig->nota2 == 'TRUE')
                                                {{'NP'}}
                                            @elseif($trabasig->DNL == 'TRUE')
                                                {{'DNL'}}
                                            @elseif($trabasig->EU == 'TRUE')
                                                {{'EU'}}
                                            @elseif($trabasig->DPL == 'TRUE')
                                                {{'DPL'}}
                                            @elseif($trabasig->DSU == 'TRUE')
                                                {{'DSU'}}
                                            @else
                                                {{$trabasig->Hp10_calc_dose}}
                                            @endif
                                        </td>
                                        <td class='align-middle text-center'></td>
                                        <td class='align-middle text-center'>
                                            @if($trabasig->nota2 == 'TRUE')
                                                {{'NP'}}
                                            @elseif($trabasig->DNL == 'TRUE')
                                                {{'DNL'}}
                                            @elseif($trabasig->EU == 'TRUE')
                                                {{'EU'}}
                                            @elseif($trabasig->DPL == 'TRUE')
                                                {{'DPL'}}
                                            @elseif($trabasig->DSU == 'TRUE')
                                                {{'DSU'}}
                                            @else
                                                {{$trabasig->Hp3_calc_dose}}
                                            @endif
                                        </td>
                                        <td class='align-middle text-center'></td>
                                        <td class='align-middle text-center'>
                                            @if($trabasig->nota2 == 'TRUE')
                                                {{'NP'}}
                                            @elseif($trabasig->DNL == 'TRUE')
                                                {{'DNL'}}
                                            @elseif($trabasig->EU == 'TRUE')
                                                {{'EU'}}
                                            @elseif($trabasig->DPL == 'TRUE')
                                                {{'DPL'}}
                                            @elseif($trabasig->DSU == 'TRUE')
                                                {{'DSU'}}
                                            @else
                                                {{$trabasig->Hp007_calc_dose}}
                                            @endif
                                        </td>
                                        <td class='align-middle text-center'>
                                            {{$trabasig->Hp007_calc_dose - $dosicontDedoasig->Hp007_calc_dose}}
                                        </td>
                                        <td class='align-middle text-center'>
                                            @for($i=1; $i<=6; $i++)
                                                @if($trabasig->{"nota$i"} == 'TRUE')
                                                    {{$i}})
                                                @endif 
                                            @endfor
                                        </td>
                                        <td class='align-middle text-center '>
                                            <div class="row px-2">
                                                <div class="col-md p-0 m-0">
                                                    <a href="{{route('lecturadosicontrl.create', ['lecdosi'=>$trabasig->id_trabajadordosimetro, 'lecdosicontrol'=>$dosicontDedoasig->id_dosicontrolcontdosisedes])}}" class="btn colorQA btn-sm">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-card-checklist" viewBox="0 0 16 16">
                                                        <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                                                        <path d="M7 5.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0zM7 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0z"/>
                                                        </svg><br> LECTURA
                                                    </a>
                                                </div>
                                                <div class="col-md p-0 m-0">
                                                    <a href="{{route('lecturadosi.edit', $trabasig->id_trabajadordosimetro)}}" class="btn colorQA btn-sm">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                                            <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                                        </svg><br> EDITAR
                                                    </a>
                                                </div>
                                                {{-- <div class="col-md p-0 m-0">
                                                    <form id="form_eliminar_trabajadorasig" name="form_eliminar_trabajadorasig" class="form_eliminar_trabajadorasig" action="{{route('asigdosicont.destroyInfoTrabajador', $trabasig->id_trabajadordosimetro)}}" method="POST">
                                                        @csrf
                                                        @method('delete')
                                                        <button class="btn btn-danger btn-sm" type="submit">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                                            </svg> <br> ELIMINAR
                                                        </button>
                                                    </form>
                                                </div> --}}
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-md bg-secondary"></div>
    
</div>
<br>
<br>
<div class="row">
    <div class="col-md"></div>
    <div class="col-md-8 ">
        <div class="alert alert-info" role="alert">
            <h4 class="alert-heading"> <b>OBSERVACIONES:</b> </h4>
            @php
                $nota3 = 'vacio';
                $nota5 = 'vacio';
                $nota6 = 'vacio';
            @endphp
            @foreach($trabjasignados as $trabasig)
                @php
                    if($trabasig->nota3 == 'TRUE' &&  $trabasig->nota3 != $nota3){
                        echo "<p>- SE RECOMIENDA REVISAR EL LIMITE DE LAS DOSIS PERMITIDAS</p>";
                        $nota3 = $trabasig->nota3;
                    }
                    if($trabasig->nota5 == 'TRUE' && $trabasig->nota5 != $nota5){
                        echo "<p>- CONTROL NO UTILIZADO EN LA EVALUACIÓN</p>";
                        $nota5 = $trabasig->nota5;
                    }
                    if($trabasig->nota6 == 'TRUE' &&  $trabasig->nota6 != $nota6){
                        echo "<p>-  DOSÍMETRO CONTAMINADO CON MATERIAL RADIOACTIVO SE RECOMIENDA HACER INVESTIGACIÓN</p>";
                        $nota6 = $trabasig->nota6;  
                    }

                @endphp
            @endforeach
            @if(!empty($observacionesDelMes))
                @foreach($observacionesDelMes as $observaciones)
                    @if($observaciones->nota_cambiodosim != null)
                        <p>- {{$observaciones->nota_cambiodosim}}</p>
                    @endif
                @endforeach
            @endif
            <br>
            <div class="row">
                <div class="col-md"></div>
                <div class="col-md d-grid gap-2">
                    <button type="button" class="btn colorQA" data-bs-toggle="modal" data-bs-target="#nueva_observacionModal" >NUEVA OBSERVACIÓN</button>
                    <div class="modal fade" id="nueva_observacionModal" tabindex="-1" aria-labelledby="nueva_observacionModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title w-100 text-center" id="nueva_observacionModalLabel">NUEVA OBSERVACIÓN</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{route('asigdosicont.saveObservacionMesAsigdosim')}}" method="POST" id="form_crear_observacionmes" name="form_crear_observacionmes" class="form_crear_observacionmes">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="col-md">
                                            <label class="text-center">INGRESE LAS OBSERVACIONES O NOTAS PERTINENTES AL PERÍODO:</label>
                                            <textarea class="form-control" name="nota_cambio_dosimetros" id="nota_cambio_dosimetros" rows="3" autofocus style="text-transform:uppercase"></textarea> 
                                            <input type="number" hidden value="{{$mesnumber}}" name="mesnumber" id="mesnumber">
                                            <input type="number" hidden value="{{$contdosisededepto->id_contdosisededepto}}" name="id_contdosisededepto" id="id_contdosisededepto">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">CANCELAR</button>
                                        <button type="submit" class="btn colorQA"  data-bs-dismiss="modal" >GUARDAR</button>
                                    </div>
                                </form>
                            </div> 
                        </div>
                    </div>
                </div>
                <div class="col-md"></div>
            </div>

        </div>
    </div>
    <div class="col-md"></div>
</div>



<script
src="https://code.jquery.com/jquery-3.6.0.js"
integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
crossorigin="anonymous">
</script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if(session('actualizar')== 'ok')
    <script>
        Swal.fire(
        'ACTUALIZADO!',
        'SE HA ACTUALIZADO LA LECTURA DEL DOSÍMETRO CON ÉXITO.',
        'success'
        )
    </script>
@endif

@if(session('eliminar')== 'ok')
    <script>
        Swal.fire(
        'ELIMINADO!',
        'SE HA ELIMINADO CON ÉXITO.',
        'success'
        )
    </script>
@endif
@if(session('actualizado')== 'ok')
    <script>
        Swal.fire(
        'ACTUALIZADO!',
        'SE HA ACTUALIZADO CON ÉXITO.',
        'success'
        )
    </script>
@endif
@if(session('crear')== 'ok')
    <script>
        Swal.fire(
        'GUARDADO!',
        'SE HA GUARDADO CON ÉXITO.',
        'success'
        )
    </script>
@endif

<script type="text/javascript">
    $(document).ready(function(){
        var TDcontrato = document.getElementById("id_contrato");
        var num = parseInt('{{$contdosisededepto->contratodosimetriasede->dosimetriacontrato->codigo_contrato}}');
        var n = num.toString().padStart(5,'0');
        console.log("ESTE ES EL CODIGO" +n);
           
        TDcontrato.innerHTML = "CONTRATO No."+n;
        $('#form_eliminar_asigcontrol').submit(function(e){
            e.preventDefault();
            Swal.fire({
                text: "SEGURO QUE DESEA ELIMINAR ESTA ASIGNACIÓN DEL DOSÍMETRO DE CONTROL??",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#1A9980',
                cancelButtonColor: '#d33',
                confirmButtonText: 'SI, SEGURO!'
                }).then((result) => {
                if (result.isConfirmed) {
                   
                    this.submit();
                }
            })
        })

        $('.form_eliminar_trabajadorasig').submit(function(e){
            e.preventDefault();
            Swal.fire({
                text: "SEGURO QUE DESEA ELIMINAR ESTA ASIGNACIÓN??",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#1A9980',
                cancelButtonColor: '#d33',
                confirmButtonText: 'SI, SEGURO!'
                }).then((result) => {
                if (result.isConfirmed) {
                   
                    this.submit();
                }
            })
        })

        $('#edit_fecha_contasig').submit(function(e){
            e.preventDefault();
            Swal.fire({
                text: "SEGURO QUE DESEA ACTUALIZAR LAS FECHAS DE SEGUIMIENTO?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#1A9980',
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

<script type="text/javascript">
    $(document).ready(function(){
        // Creamos array con los meses del año
        const meses = ['ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO', 'JULIO', 'AGOSTO', 'SEPTIEMBRE', 'OCTUBRE', 'NOVIEMBRE', 'DICIEMBRE'];
        let fecha = new Date("{{$contdosisededepto->contratodosimetriasede->dosimetriacontrato->fecha_inicio}}, 00:00:00");
        console.log(fecha);
        for($i=1; $i<=13; $i++){
            var r = new Date(new Date(fecha).setMonth(fecha.getMonth()+$i));
            var fechaesp = meses[r.getMonth()] + ' DE ' + r.getUTCFullYear();
            console.log(fechaesp); 
            
            if('{{ Request()->mesnumber}}' == ($i+1) ){  
            
                document.getElementById('mes{{ Request()->mesnumber}}').innerHTML = fechaesp;

            } 
        }
       
        
        if('{{$dosicontrolToraxasig}}' != '[]' ||  '{{$dosicontrolCristalinoasig}}'!= '[]' || '{{$dosicontrolDedoasig}}' != '[]'){
            /* alert('hay dosimetro de control torax'); */
            @foreach($trabjasignados as $trab)
                if('{{$trab->Hp10_calc_dose}}' != 'NULL'){
                    @foreach($dosicontrolToraxasig as $contTorax)
                        var resta = '{{$trab->Hp10_calc_dose}}' - '{{$contTorax->Hp10_calc_dose}}';
                        if('{{$trab->ubicacion}}' == 'TORAX' && resta >= 1.67){
                            /* alert('ALERTA ROJA TORAX'+resta); */
                            let trhp10 = document.getElementById('{{$trab->id_trabajadordosimetro}}');
                            console.log("HP3"+trhp10);
                            trhp10.classList.add("trdosisroja");
                        }
                    @endforeach
                }
                if('{{$trab->Hp3_calc_dose}}' != 'NULL'){
                    @foreach($dosicontrolCristalinoasig as $contCrist)
                        var resta = '{{$trab->Hp3_calc_dose}}' - '{{$contCrist->Hp3_calc_dose}}';
                        if('{{$trab->ubicacion}}' == 'CRISTALINO' && resta >= 12.5){
                            /* alert('ALERTA ROJA CRISTALINO'+resta); */
                            let trhp3 = document.getElementById('{{$trab->id_trabajadordosimetro}}');
                            console.log("HP3"+trhp3);
                            trhp3.classList.add("trdosisroja");
                        }
                    @endforeach
                }
                if('{{$trab->Hp007_calc_dose}}'!= 'NULL'){
                    @foreach($dosicontrolToraxasig as $contTorax)
                        var resta = '{{$trab->Hp007_calc_dose}}' - '{{$contTorax->Hp007_calc_dose}}';
                        if('{{$trab->ubicacion}}' == 'TORAX' && resta >= 41.6){
                            /* alert('ALERTA ROJA torax'); */
                            let trhp007 = document.getElementById('{{$trab->id_trabajadordosimetro}}');
                            trhp007.classList.add("trdosisroja");
                        }
                    @endforeach
                    @foreach($dosicontrolDedoasig as $contAnillo)
                    var resta = '{{$trab->Hp007_calc_dose}}' - '{{$contAnillo->Hp007_calc_dose}}';
                        if('{{$trab->ubicacion}}'== 'ANILLO' && resta >= 41.6){
                            /* alert('ALERTA ROJA ANILLO'); */
                            let trhp007 = document.getElementById('{{$trab->id_trabajadordosimetro}}');
                            trhp007.classList.add("trdosisroja");
                        }
                    @endforeach
                }
            @endforeach
        }else{
            /* alert('no hay dosimetro de control'); */
            @foreach($trabjasignados as $trab)
            
                if('{{$trab->Hp10_calc_dose}}' != 'NULL'){
                    
                    if('{{$trab->ubicacion}}' == 'TORAX' && '{{$trab->Hp10_calc_dose}}' >= 1.67){
                        /* alert('ALERTA ROJA TORAX'); */
                        let trhp10 = document.getElementById('{{$trab->id_trabajadordosimetro}}');
                        console.log("HP3"+trhp10);
                        trhp10.classList.add("trdosisroja");
                    }
                }
                if('{{$trab->Hp3_calc_dose}}' != 'NULL'){
                    
                    if('{{$trab->ubicacion}}' == 'CRISTALINO' && '{{$trab->Hp3_calc_dose}}' >= 12.5){
                        /* alert('ALERTA ROJA CRISTALINO'); */
                        let trhp3 = document.getElementById('{{$trab->id_trabajadordosimetro}}');
                        console.log("HP3"+trhp3);
                        trhp3.classList.add("trdosisroja");
                    }
                }
                if('{{$trab->Hp007_calc_dose}}'!= 'NULL'){
                    
                    if('{{$trab->ubicacion}}' == 'MUÑECA' && '{{$trab->Hp007_calc_dose}}' >= 41.6){
                        /* alert('ALERTA ROJA MUÑECA'); */
                        let trhp007 = document.getElementById('{{$trab->id_trabajadordosimetro}}');
                        trhp007.classList.add("trdosisroja");
                    }
                    if('{{$trab->ubicacion}}'== 'ANILLO' && '{{$trab->Hp007_calc_dose}}' >= 41.6){
                        /* alert('ALERTA ROJA DEDO'); */
                        let trhp007 = document.getElementById('{{$trab->id_trabajadordosimetro}}');
                        trhp007.classList.add("trdosisroja");
                    }
                    
                }
            @endforeach
        }
        
            
        
        
        
    });
</script>


@endsection
