@extends('layouts.app')
@extends('layouts.plantillabase')
@section('contenido') 

<div class="row">
    <div class="col-md position-fixed">
        <a type="button" class="btn btn-circle colorQA"  @if($item == 0) href="{{route('asignadosicontrato.info', ['asigdosicont' => $dosiareasig->contdosisededepto_id, 'mesnumber' => $dosiareasig->mes_asignacion, 'item'=>$item])}}" @else href="{{route('asignadosicontrato.info', ['asigdosicont' =>$dosiareasig->novcontdosisededepto_id, 'mesnumber' => $dosiareasig->mes_asignacion, 'item'=>$item])}}" @endif>
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-arrow-left mt-1" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
            </svg>
        </a>
    </div>
</div>
<a type="button" class="btn btn-circle colorQA ir-arriba">
    <svg xmlns="http://www.w3.org/2000/svg" width="27" height="27" fill="currentColor" class="bi bi-arrow-up mt-1" viewBox="0 0 16 16">
        <path fill-rule="evenodd" d="M8 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L7.5 2.707V14.5a.5.5 0 0 0 .5.5z"/>
    </svg>
</a>
<div class="row">
    <div class="col-md">
        <h2 class="text-center">DOSIMETRÍA DE </h2> 
        <h3 class="text-center"><i>{{$dosiareasig->contratodosimetriasede->sede->empresa->nombre_empresa}}</i>- SEDE: <i>{{$dosiareasig->contratodosimetriasede->sede->nombre_sede}}</i> </h3>
        <h4 class="text-center">ESPECIALIDAD: {{$dosiareasig->contratodosimetriasededepto->departamentosede->departamento->nombre_departamento}}</h4>    
    </div>
</div>
<br>
<h4 class="text-center" id="id_contrato"></h4>
<br>
<h3 class="text-center">
    LECTURA DE DOSÍMETRO TIPO AMBIENTAL<br> PARA EL PERÍODO {{$dosiareasig->mes_asignacion}} (
    @if($dosiareasig->mes_asignacion == 1)
        @if($dosiareasig->contratodosimetriasede->dosimetriacontrato->periodo_recambio == 'MENS')
            @php
                $meses = ["01"=>'ENERO', "02"=>'FEBRERO', "03"=>'MARZO', "04"=>'ABRIL', "05"=>'MAYO', "06"=>'JUNIO', "07"=>'JULIO', "08"=>'AGOSTO', "09"=>'SEPTIEMBRE', "10"=>'OCTUBRE', "11"=>'NOVIEMBRE', "12"=>'DICIEMBRE'];
                $inicio = $dosiareasig->contratodosimetriasede->dosimetriacontrato->fecha_inicio;
                $fin = date("t-m-Y",strtotime($inicio));
                echo date("j", strtotime($inicio))." ".$meses[date("m", strtotime($inicio))]." DE ".date("Y", strtotime($inicio))." - ".date("t", strtotime($fin))." ".$meses[date("m", strtotime($fin))]." DE ".date("Y", strtotime($fin));
                /* echo $meses[date("m", strtotime($contdosisededepto->contratodosimetriasede->dosimetriacontrato->fecha_inicio))]." DE ".date("Y", strtotime($contdosisededepto->contratodosimetriasede->dosimetriacontrato->fecha_inicio)) ; */
            @endphp
        @elseif($dosiareasig->contratodosimetriasede->dosimetriacontrato->periodo_recambio == 'TRIMS')
            @php  
                $meses = ["01"=>'ENERO', "02"=>'FEBRERO', "03"=>'MARZO', "04"=>'ABRIL', "05"=>'MAYO', "06"=>'JUNIO', "07"=>'JULIO', "08"=>'AGOSTO', "09"=>'SEPTIEMBRE', "10"=>'OCTUBRE', "11"=>'NOVIEMBRE', "12"=>'DICIEMBRE'];
                $inicio = date($dosiareasig->contratodosimetriasede->dosimetriacontrato->fecha_inicio);
                $fecha1 = date("t-m-Y",strtotime($inicio));
                $fecha2= date("t-m-Y",strtotime($fecha1."+ 2 month"));
                echo date("j", strtotime($inicio))." ".$meses[date("m", strtotime($inicio))]." DE ".date("Y", strtotime($inicio))." - ".date("j", strtotime($fecha2))." ".$meses[date("m", strtotime($fecha2))]." DE ".date("Y", strtotime($fecha2))
            @endphp
        @elseif($dosiareasig->contratodosimetriasede->dosimetriacontrato->periodo_recambio == 'BIMS')
            @php  
                $meses = ["01"=>'ENERO', "02"=>'FEBRERO', "03"=>'MARZO', "04"=>'ABRIL', "05"=>'MAYO', "06"=>'JUNIO', "07"=>'JULIO', "08"=>'AGOSTO', "09"=>'SEPTIEMBRE', "10"=>'OCTUBRE', "11"=>'NOVIEMBRE', "12"=>'DICIEMBRE'];
                $fecha1 = date($dosiareasig->contratodosimetriasede->dosimetriacontrato->fecha_inicio);
                $fecha2_total = date("t-m-Y",strtotime($fecha1."+ 1 month"));
                echo date("j", strtotime($fecha1))." ".$meses[date("m", strtotime($fecha1))]." DE ".date("Y", strtotime($fecha1))." - ".date("j", strtotime($fecha2_total))." ".$meses[date("m", strtotime($fecha2_total))]." DE ".date("Y", strtotime($fecha2_total))
            @endphp
        @endif
    @else
        <span id="mes{{$dosiareasig->mes_asignacion}}"></span>
    @endif
    ) 
</h3>
<br>
<div class="row">
    <div class="col-md"></div>
    <div class="col-md-11">
        <div class="card">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs" id="infoLectura" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" href="#infoempresa" role="tab" aria-controls="infoempresa" aria-selected="true">INFO EMPRESA</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"  href="#infocontrato" role="tab" aria-controls="infocontrato" aria-selected="false">INFO CONTRATO</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="#lectura" role="tab" aria-controls="lectura" aria-selected="false">LECTURA</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content mt-3">
                    <!-- //////////////////// PESTAÑA DE INFO EMPRESA //////////////// -->
                    <div class="tab-pane active" id="infoempresa" role="tabpanel">
                        <h4 class="card-title text-center pt-3">INFORMACIÓN DE LA EMPRESA</h4>
                        <BR></BR>
                        <Label class="mx-5">LA SIGUIENTE ES INFORMACIÓN DE LA EMPRESA QUE FUE RELACIONADA AL DOSÍMETRO DE TIPO ÁREA EN EL PROCESO DE ASIGNACIÓN:</Label>
                        <BR></BR>
                        <div class="row">
                            <div class="col"></div>
                            <div class="col-md m-4">
                                <label for="floatingInputGrid"> <b>EMPRESA:</b> </label>
                                <input type="text"  class="form-control text-center" name="empresaLectDosimControl" id="empresaLectDosimControl" value="{{$dosiareasig->contratodosimetriasede->sede->empresa->nombre_empresa}}" readonly>
                                <br>
                                
                            </div>
                            <div class="col-md m-4">
                                <label for="floatingInputGrid"> <b>NÚM. IDEN.:</b> </label>
                                <input type="text" class="form-control text-center" name="numIdenEmpresaLectDosimControl" id="numIdenEmpresaLectDosimControl" value="{{$dosiareasig->contratodosimetriasede->sede->empresa->num_iden_empresa}}" readonly>
                                <br>
                               
                            </div>
                            <div class="col-md m-4">
                                <label for="floatingInputGrid"> <b>SEDE:</b> </label>
                                <input type="text"  class="form-control text-center" name="sedeLectDosimControl" id="sedeLectDosimControl" value="{{$dosiareasig->contratodosimetriasede->sede->nombre_sede}}" readonly>
                                <br>
                            </div>
                            <div class="col-md m-4">
                                <label for="floatingInputGrid"> <b>ESPECIALIDAD:</b> </label>
                                <input type="text"  class="form-control text-center" name="deptoLectDosimControl" id="deptoLectDosimControl" value="{{$dosiareasig->contratodosimetriasededepto->departamentosede->departamento->nombre_departamento}}" readonly>
                                <br>
                            </div>
                            <div class="col-md m-4">
                                <label for="floatingInputGrid"> <b>ÁREA:</b> </label>
                                <input type="text"  class="form-control text-center" name="deptoLectDosimArea" id="deptoLectDosimArea" value="{{$dosiareasig->areadepartamentosede->nombre_area}}" readonly>
                                <br>
                            </div>
                            <div class="col-md"></div>
                        </div>
                        <br>
                    </div>
                    <!-- //////////////////// PESTAÑA DE INFO CONTRATO //////////////// -->
                    <div class="tab-pane" id="infocontrato" role="tabpanel" aria-labelledby="infocontrato-tab">
                        <h4 class="card-title text-center pt-3">INFORMACIÓN DEL CONTRATO</h4>
                        <BR></BR>
                        <Label class="mx-5">LA SIGUIENTE ES INFORMACIÓN DEL CONTRATO QUE ES RELACIONADO AL DOSÍMETRO EN EL PROCESO DE ASIGNACIÓN:</Label>
                        <BR></BR>
                        <div class="row">
                            <div class="col m-4"></div>
                            <div class="col m-4">
                                <label for="floatingInputGrid"> <b>COD. DOSÍMETRO:</b> </label>
                                <input type="text"  class="form-control" name="codDosimLectDosimControl" id="codDosimLectDosimControl" value="{{$dosiareasig->dosimetro->codigo_dosimeter}}" readonly>
                                <br>
                                <label for="floatingInputGrid"> <b>PRIMER DÍA USO:</b> </label>
                                <input type="text" class="form-control" name="primDiaUsoLectDosimControl" id="primDiaUsoLectDosimControl" value="{{$dosiareasig->primer_dia_uso}}" readonly>
                                <br>
                                <label for="floatingInputGrid"> <b>OCUPACIÓN:</b> </label>
                                <input type="text"  class="form-control" name="ocupLectDosimControl" id="ocupLectDosimControl" value="{{$dosiareasig->contratodosimetriasede->dosimetriacontrato->ocupacion}}" readonly>
                            </div>
                            <div class="col m-4">
                                <label for="floatingInputGrid"> <b>TIPO DOSÍMETRO:</b></label>
                                <input type="text"  class="form-control" name="tipoDoimLectDosimControl" id="tipoDosimLectDosimControl" value="{{$dosiareasig->dosimetro->tipo_dosimetro}}" readonly>
                                <br>
                                <label for="floatingInputGrid"> <b>ULTIMO DÍA USO:</b> </label>
                                <input type="text"  class="form-control" name="ultDiaUsobLectDosimControl" id="ultDiaUsobLectDosimControl" value="{{$dosiareasig->ultimo_dia_uso}}" readonly>
                                <br>
                                <label for="floatingInputGrid"> <b>ENERGÍA:</b> </label>
                                <input type="text"  class="form-control" name="energiaLectDosimControl" id="energiaLectDosimControl" value="{{$dosiareasig->energia}}" readonly>
                            </div>
                            <div class="col-3 m-4">
                                <label for="floatingInputGrid"> <b>FECHA INGRESO AL SERVICIO:</b> </label>
                                <input type="text"  class="form-control" name="FIngServLectDosimControl" id="FIngServLectDosimControl" value="{{$dosiareasig->dosimetro->fecha_ingreso_servicio}}" readonly>
                                <br>
                                <label for="floatingInputGrid"> <b>PERIODO DE RECAMBIO:</b> </label>
                                <input type="text"  class="form-control" name="pRecamLectDosimControl" id="pRecamLectDosimControl" value="{{$dosiareasig->contratodosimetriasede->dosimetriacontrato->periodo_recambio}}" readonly>
                                <br>
                            </div>
                            <div class="col"></div>
                        </div>
                        <br>
                    </div>
                    <!-- //////////////////// PESTAÑA DE LECTURA//////////////// -->
                    <div class="tab-pane" id="lectura" role="tabpanel" aria-labelledby="lectura-tab">
                        <h4 class="card-title text-center pt-3">ÁREA: {{$dosiareasig->areadepartamentosede->nombre_area}} <br> CÓDIGO DEL DOSÍMETRO: {{$dosiareasig->dosimetro->codigo_dosimeter}}</h4>
                        
                        <br>
                        <Label class="px-5">INGRESE LA INFORMACIÓN DE LA LECTURA DEL DOSÍMETRO ASIGNADO:</Label>
                        <br>
                        <div class="row">
                            <div class="col"></div>
                            <div class="col-10">
                                <div class="card text-dark bg-light">
                                    <form class="m-4" id="form_save_lectura_dosim" name="form_save_lectura_dosim" action="{{route('lecturadosiarea.save', ['lecdosicont'=>$dosiareasig, 'item'=>$item])}}" method="POST">
                                        
                                        @csrf

                                        @method('put')

                                        <input type="NUMBER" id="mes_asignacion" name="mes_asignacion" value="{{$dosiareasig->mes_asignacion}}" hidden>
                                        <input type="NUMBER" id="id_contratodosimetriasededepto" name="id_contratodosimetriasededepto" value="{{$dosiareasig->contdosisededepto_id}}" hidden>
                                        <input type="NUMBER" id="id_novedadcontratodosimetriasededepto" name="id_novedadcontratodosimetriasededepto" value="{{$dosiareasig->novcontdosisededepto_id}}" hidden>
                                        <div class="row g-2">
                                            <div class="col-md-3 mx-4">
                                                
                                                <div class="form-floating">
                                                    @if($dosiareasig->nota2 == 'TRUE'|| $dosiareasig->DNL == 'TRUE'|| $dosiareasig->EU == 'TRUE' || $dosiareasig->DSU =='TRUE' || $dosiareasig->DPL =='TRUE'|| $dosiareasig->measurement_date != '')
                                                        <input type="NUMBER" class="form-control" name="hp10_calc_dose" id="hp10_calc_dose_readonly" value="{{$dosiareasig->Hp10_calc_dose}}" readonly>
                                                    @else
                                                        <input type="NUMBER" step="any" class="form-control" name="hp10_calc_dose" id="hp10_calc_dose" value="{{$dosiareasig->Hp10_calc_dose}}">
                                                    @endif
                                                    <label for="floatingInputGrid">Hp10 CALC DOSE:</label>
                                                </div>
                                                <br>
                                                <div class="form-floating">
                                                    @if($dosiareasig->nota2 == 'TRUE'|| $dosiareasig->DNL == 'TRUE'|| $dosiareasig->EU == 'TRUE' || $dosiareasig->DSU =='TRUE' || $dosiareasig->DPL =='TRUE'|| $dosiareasig->measurement_date != '')
                                                        <input type="NUMBER" class="form-control" name="hp007_calc_dose" id="hp007_calc_dose_readonly" value="{{$dosiareasig->Hp007_calc_dose}}" readonly>
                                                    @else
                                                        <input type="NUMBER" step="any" class="form-control" name="hp007_calc_dose" id="hp007_calc_dose" value="{{$dosiareasig->Hp007_calc_dose}}">
                                                    @endif
                                                    <label for="floatingInputGrid">Hp0.07 CALC DOSE:</label>
                                                </div>
                                                <br>
                                                <div class="form-floating">
                                                    @if($dosiareasig->nota2 == 'TRUE'|| $dosiareasig->DNL == 'TRUE'|| $dosiareasig->EU == 'TRUE' || $dosiareasig->DSU =='TRUE' || $dosiareasig->DPL =='TRUE'|| $dosiareasig->measurement_date != '')
                                                        <input type="NUMBER" step="any" class="form-control" name="hp3_calc_dose" id="hp3_calc_dose_readonly" value="{{$dosiareasig->Hp3_calc_dose}}" readonly>
                                                    @else
                                                        <input type="NUMBER" step="any" class="form-control" name="hp3_calc_dose" id="hp3_calc_dose" value="{{$dosiareasig->Hp3_calc_dose}}">
                                                    @endif
                                                    <label for="floatingInputGrid">Hp3 CALC DOSE:</label>
                                                </div>
                                                <br>
                                                <div class="form-floating">
                                                    @if($dosiareasig->nota2 == 'TRUE'|| $dosiareasig->DNL == 'TRUE'|| $dosiareasig->EU == 'TRUE' || $dosiareasig->DSU =='TRUE' || $dosiareasig->DPL =='TRUE'|| $dosiareasig->measurement_date != '')
                                                        <input type="date" class="form-control" name="measurement_date"  id="measurement_date_readonly" value="{{$dosiareasig->measurement_date}}" readonly>
                                                    @else
                                                        <input type="date" class="form-control @error('measurement_date') is-invalid @enderror" name="measurement_date"  id="measurement_date">
                                                    @endif
                                                    <label for="floatingInputGrid">MEASUREMENT DATE:</label>
                                                    @error('measurement_date') <span class="invalid-feedback">*{{ $message }}</span> @enderror
                                                </div>
                                            </div>
                                            <div class="col-md">
                                                <label for="">DOSÍMETRO DE CONTROL TRANSPORTE {{$dosicontrolasig->ubicacion}}:</label>
                                                <div class="row">
                                                    @if($dosicontrolasig->ubicacion == 'TORAX')
                                                        <div class="col-md">
                                                            <div class="form-floating">
                                                                <input type="NUMBER" class="form-control" name="hp10_calc_dose_control" id="hp10_calc_dose_control_readonly" value="{{ $dosicontrolasig->Hp10_calc_dose}}" readonly>
                                                                <label for="floatingInputGrid">Hp10 CALC DOSE:</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md">
                                                            <div class="form-floating">
                                                                <input type="NUMBER" class="form-control" name="hp007_calc_dose_control" id="hp007_calc_dose_control_readonly" value="{{ $dosicontrolasig->Hp007_calc_dose}}" readonly>
                                                                <label for="floatingInputGrid">Hp0.07 CALC DOSE:</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md">
                                                            <div class="form-floating">
                                                                <input type="NUMBER" class="form-control" name="hp3_calc_dose_control" id="hp3_calc_dose_control_readonly" value="{{$dosicontrolasig->Hp3_calc_dose}}" readonly>
                                                                <label for="floatingInputGrid">Hp3 CALC DOSE:</label>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                                <br>
                                                @if($dosiareasig->nota2 == 'TRUE'|| $dosiareasig->DNL == 'TRUE'|| $dosiareasig->EU == 'TRUE' || $dosiareasig->DSU =='TRUE' || $dosiareasig->DPL =='TRUE'|| $dosiareasig->measurement_date != '')
                                                    <div class="form-check">
                                                        @if($dosiareasig->nota1 == 'TRUE')
                                                            <input class="form-check-input" type="checkbox" value="TRUE" id="" name="nota1" checked disabled>
                                                        @else
                                                            <input class="form-check-input" type="checkbox" value="TRUE" id="" name="nota1" disabled>
                                                        @endif
                                                        <label class="form-check-label" for="reverseCheck1">1 = Ninguna </label>
                                                    </div>
                                                    <div class="form-check">
                                                        @if($dosiareasig->nota2 == 'TRUE')
                                                            <input class="form-check-input" type="checkbox" value="TRUE" id="" name="nota2" checked disabled>
                                                        @else
                                                            <input class="form-check-input" type="checkbox" value="TRUE" id="" name="nota2" disabled>
                                                        @endif
                                                        <label class="form-check-label" for="reverseCheck1">2 = Extraviado</label>
                                                    </div>
                                                    <div class="form-check">
                                                        @if($dosiareasig->nota3 == 'TRUE')
                                                            <input class="form-check-input" type="checkbox" value="TRUE" id="" name="nota3" checked disabled>
                                                        @else
                                                            <input class="form-check-input" type="checkbox" value="TRUE" id="" name="nota3" disabled>
                                                        @endif
                                                        <label class="form-check-label" for="reverseCheck1">3 = Supera la dosis permitida</label>
                                                    </div>
                                                    <div class="form-check">
                                                        @if($dosiareasig->nota4 == 'TRUE')
                                                            <input class="form-check-input" type="checkbox" value="TRUE" id="" name="nota4" checked disabled>
                                                        @else
                                                            <input class="form-check-input" type="checkbox" value="TRUE" id="" name="nota4" disabled>
                                                        @endif
                                                        <label class="form-check-label" for="reverseCheck1">4 = Dosímetro reprocesado</label>
                                                    </div>
                                                    <div class="form-check">
                                                        @if($dosiareasig->nota5 == 'TRUE')
                                                            <input class="form-check-input" type="checkbox" value="TRUE" id="" name="nota5" checked disabled>
                                                        @else
                                                            <input class="form-check-input" type="checkbox" value="TRUE" id="" name="nota5" disabled>
                                                        @endif
                                                        <label class="form-check-label" for="reverseCheck1">5 = Control no utilizado en la evaluación</label> 
                                                    </div>
                                                    <div class="form-check">
                                                        @if($dosiareasig->nota6 == 'TRUE')
                                                            <input class="form-check-input" type="checkbox" value="TRUE" id="" name="nota6" checked disabled>
                                                        @else
                                                            <input class="form-check-input" type="checkbox" value="TRUE" id="" name="nota6" disabled>
                                                        @endif
                                                        <label class="form-check-label" for="reverseCheck1">6 = Dosímetro contaminado</label> 
                                                    </div>
                                                    <div class="form-check">
                                                        @if($dosiareasig->DNL == 'TRUE')
                                                            <input class="form-check-input" type="checkbox" value="TRUE" id="" name="dnl"  checked disabled>
                                                        @else
                                                            <input class="form-check-input" type="checkbox" value="TRUE" id="" name="dnl"  disabled>
                                                        @endif
                                                        <label class="form-check-label" for="reverseCheck1">DNL = Dosímetro No Legible</label> 
                                                    </div>
                                                    <div class="form-check">
                                                        @if($dosiareasig->EU == 'TRUE')
                                                            <input class="form-check-input" type="checkbox" value="TRUE" id="" name="eu" checked disabled>
                                                        @else
                                                            <input class="form-check-input" type="checkbox" value="TRUE" id="" name="eu" disabled>
                                                        @endif
                                                        <label class="form-check-label" for="reverseCheck1"> EU = Dosímetro en Uso </label> 
                                                    </div>
                                                    <div class="form-check">
                                                        @if($dosiareasig->DPL == 'TRUE')
                                                            <input class="form-check-input" type="checkbox" value="TRUE" id="" name="dpl" checked disabled>
                                                        @else
                                                            <input class="form-check-input" type="checkbox" value="TRUE" id="" name="dpl" disabled>
                                                        @endif
                                                        <label class="form-check-label" for="reverseCheck1">DPL = Dosímetro en Proceso de Lectura</label> 
                                                    </div>
                                                    <div class="form-check">
                                                        @if($dosiareasig->DSU == 'TRUE')
                                                            <input class="form-check-input" type="checkbox" value="TRUE" id="" name="dsu" checked disabled>
                                                        @else
                                                            <input class="form-check-input" type="checkbox" value="TRUE" id="" name="dsu" disabled>
                                                        @endif
                                                        <label class="form-check-label" for="reverseCheck1">DSU = Dosímetro sin usar</label> 
                                                    </div>
                                                @else
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="TRUE" id="nota1checked" name="nota1">
                                                        <label class="form-check-label" for="reverseCheck1">1 = Ninguna</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="TRUE" id="extraviado" name="nota2">
                                                        <label class="form-check-label" for="reverseCheck1">2 = Extraviado</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="TRUE" id="nota3checked" name="nota3">
                                                        <label class="form-check-label" for="reverseCheck1">3 = Supera la dosis permitida</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="TRUE" id="nota4checked" name="nota4">
                                                        <label class="form-check-label" for="reverseCheck1">4 = Dosímetro reprocesado</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="TRUE" id="nota5checked" name="nota5">
                                                        <label class="form-check-label" for="reverseCheck1">5 = Control no utilizado en la evaluación </label> 
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="TRUE" id="nota6checked" name="nota6">
                                                        <label class="form-check-label" for="reverseCheck1">6 = Dosímetro contaminado</label> 
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="TRUE" id="dnl_id" name="dnl">
                                                        <label class="form-check-label" for="reverseCheck1">DNL = Dosímetro No Legible</label> 
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="TRUE" id="eu_id" name="eu">
                                                        <label class="form-check-label" for="reverseCheck1">EU = Dosímetro en Uso </label> 
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="TRUE" id="dpl_id" name="dpl">
                                                        <label class="form-check-label" for="reverseCheck1">DPL = Dosímetro en Proceso de Lectura</label> 
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="TRUE" id="dsu_id" name="dsu">
                                                        <label class="form-check-label" for="reverseCheck1">DSU = Dosímetro sin usar</label> 
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <br>
                                        
                                        
                                        <!-- ----------------BOTON--------------- -->
                                        <div class="row g-2">
                                            <div class="col-md"></div>
                                            <div class="col-md"></div>
                                            <div class="col-md d-grid gap-2">
                                                @if($dosiareasig->measurement_date !='')
                                                    <input type="submit" class="btn colorQA mt-2" name="update" id="update" value="GUARDAR" disabled>
                                                @else
                                                    <input type="submit" class="btn colorQA mt-2" name="update" id="update" value="GUARDAR" >
                                                @endif
                                            </div>
                                            <div class="col-md"></div>
                                            <div class="col-md"></div>
                                        </div>
                                    </form>
                                </div>  
                                <br>
                            </div>
                            <div class="col"></div>
                        </div> 
                    </div>
                </div>
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
<script type="text/javascript">

    $(document).ready(function(){
        var TDcontrato = document.getElementById("id_contrato");
        var num = parseInt('{{$dosiareasig->contratodosimetriasede->dosimetriacontrato->codigo_contrato}}');
        var n = num.toString().padStart(5,'0');
        console.log("ESTE ES EL CODIGO" +n);
        TDcontrato.innerHTML = "CONTRATO No."+n;

        // Creamos array con los meses del año
        const meses = ['ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO', 'JULIO', 'AGOSTO', 'SEPTIEMBRE', 'OCTUBRE', 'NOVIEMBRE', 'DICIEMBRE'];
        let fecha = new Date("{{$dosiareasig->contratodosimetriasede->dosimetriacontrato->fecha_inicio}}, 00:00:00");
        console.log(fecha);
        var numLec = '{{$dosiareasig->contratodosimetriasede->dosimetriacontrato->numlecturas_año}}';
        var ultimoDiaPM = new Date(fecha.getFullYear(), fecha.getMonth() + 1, 1);
        console.log("ULTIMO DIA PRIMER MES:"+ ultimoDiaPM);
        if('{{$dosiareasig->contratodosimetriasede->dosimetriacontrato->periodo_recambio}}' == 'MENS'){
            var xx = 1; 
            for(var i=0; i<=(numLec-2); i++){
                /* console.log("esta es la i="+i); */
                var r = new Date(new Date(ultimoDiaPM).setMonth(ultimoDiaPM.getMonth()+i));
                /* console.log("r1" +r); */
                var r2 = new Date(new Date(r).setMonth(r.getMonth()+1));
                var fechaesp = meses[r.getMonth()] + ' DE ' + r.getUTCFullYear();
                var r2final = new Date(new Date(r2).setDate(r.getDate()-1));
                /* console.log("r2 " +r2final); */
                var fechaesp1 = r.getDate()+' '+meses[r.getMonth()] + ' DE ' + r.getUTCFullYear();
                /* console.log(fechaesp1); */
                var fechaesp2 = (r2final.getDate()) +' '+ meses[r2final.getMonth()] + ' DE ' + r2final.getUTCFullYear(); 
                /* console.log(fechaesp2); */
                xx++;
                /* console.log("XX"+xx); */
                for(var x=2; x<=numLec; x++){
                    /* console.log("ESTA ES LA X="+x); */
                    if("{{$dosiareasig->mes_asignacion}}" == xx){
                        document.getElementById('mes{{$dosiareasig->mes_asignacion}}').innerHTML = fechaesp1+' - '+fechaesp2;
                        
                    }
                }
            }
        }else if('{{$dosiareasig->contratodosimetriasede->dosimetriacontrato->periodo_recambio}}' == 'TRIMS'){
            var xx = 1;
            for(var i=0; i<=(numLec+1); i= i+3){
                var ultimoDiaPM = new Date(fecha.getFullYear(), fecha.getMonth() + 3, 1);
                console.log("ULTIMO DIA PRIMER MES:"+ ultimoDiaPM);
                console.log("ESTA ES LA I = "+i);
                var r = new Date(new Date(ultimoDiaPM).setMonth(ultimoDiaPM.getMonth()+i));
                console.log("r1" +r);
                var r2 = new Date(new Date(r).setMonth(r.getMonth()+3));
                var r2final = new Date(new Date(r2).setDate(r.getDate()-1));
                console.log("r2 " +r2final);
                var fechaesp1 = r.getDate()+' '+meses[r.getMonth()] + ' DE ' + r.getUTCFullYear();
                console.log(fechaesp1);

                var fechaesp2 = (r2final.getDate()) +' '+ meses[r2final.getMonth()] + ' DE ' + r2final.getUTCFullYear(); 
                console.log(fechaesp2);
                xx++;
                console.log("XX"+xx);
                
                if("{{$dosiareasig->mes_asignacion}}" == xx){
                    document.getElementById('mes{{$dosiareasig->mes_asignacion}}').innerHTML = fechaesp1+' - '+fechaesp2;
                    
                }
                
            }
        }else if('{{$dosiareasig->contratodosimetriasede->dosimetriacontrato->periodo_recambio}}' == 'BIMS'){
            var xx = 1;
            for(var i=0; i<=(numLec+1); i= i+2){
                var ultimoDiaPM = new Date(fecha.getFullYear(), fecha.getMonth() + 2, 1);
                console.log("ULTIMO DIA PRIMER MES:"+ ultimoDiaPM);
                console.log("ESTA ES LA I = "+i);
                var r = new Date(new Date(ultimoDiaPM).setMonth(ultimoDiaPM.getMonth()+i));
                console.log("r1" +r);
                var r2 = new Date(new Date(r).setMonth(r.getMonth()+2));
                var r2final = new Date(new Date(r2).setDate(r.getDate()-1));
                console.log("r2 " +r2final);
                var fechaesp1 = r.getDate()+' '+meses[r.getMonth()] + ' DE ' + r.getUTCFullYear();
                console.log(fechaesp1);

                var fechaesp2 = (r2final.getDate()) +' '+ meses[r2final.getMonth()] + ' DE ' + r2final.getUTCFullYear(); 
                console.log(fechaesp2);
                xx++;
                console.log("XX"+xx);
                
                if("{{$dosiareasig->mes_asignacion}}" == xx){
                    document.getElementById('mes{{$dosiareasig->mes_asignacion}}').innerHTML = fechaesp1+' - '+fechaesp2;
                    
                }
                
            }
        }

        $('#infoLectura a').on('click', function (e) {
            e.preventDefault()
            $(this).tab('show')
        });
        $('#extraviado').on('click', function(){
            var extraviado_id = $('#extraviado').prop("checked"); 
            /* alert(extraviado_id); */
            /* var extraviado_id = $(this).val(); */
            
            if($.trim(extraviado_id) != 'false'){
                $('#nota1checked').prop("checked", false);
                document.getElementById('hp007_calc_dose').disabled = true;
                document.getElementById('hp10_calc_dose').disabled = true;
                document.getElementById('ezclip_calc_dose').disabled = true;
                document.getElementById('hp3_calc_dose').disabled = true;
                document.getElementById('measurement_date').disabled = true;
                
            }else{
                document.getElementById('hp007_calc_dose').disabled = false;
                document.getElementById('hp10_calc_dose').disabled = false;
                document.getElementById('ezclip_calc_dose').disabled = false;
                document.getElementById('hp3_calc_dose').disabled = false;
                document.getElementById('measurement_date').disabled = false;
                
            }
        });
        $('#dnl_id').on('click', function(){
            var dnl_id = $('#dnl_id').prop("checked"); 
            /* alert(extraviado_id); */
            /* var extraviado_id = $(this).val(); */
            
            if($.trim(dnl_id) != 'false'){
                
                document.getElementById('hp007_calc_dose').disabled = true;
                document.getElementById('hp10_calc_dose').disabled = true;
                document.getElementById('ezclip_calc_dose').disabled = true;
                document.getElementById('hp3_calc_dose').disabled = true;
                document.getElementById('measurement_date').disabled = true;
                
            }else{
                document.getElementById('hp007_calc_dose').disabled = false;
                document.getElementById('hp10_calc_dose').disabled = false;
                document.getElementById('ezclip_calc_dose').disabled = false;
                document.getElementById('hp3_calc_dose').disabled = false;
                document.getElementById('measurement_date').disabled = false;
                
            }
        });
        $('#eu_id').on('click', function(){
            var eu_id = $('#eu_id').prop("checked"); 
            /* alert(extraviado_id); */
            /* var extraviado_id = $(this).val(); */
            
            if($.trim(eu_id) != 'false'){
                
                document.getElementById('hp007_calc_dose').disabled = true;
                document.getElementById('hp10_calc_dose').disabled = true;
                document.getElementById('ezclip_calc_dose').disabled = true;
                document.getElementById('hp3_calc_dose').disabled = true;
                document.getElementById('measurement_date').disabled = true;
                
            }else{
                document.getElementById('hp007_calc_dose').disabled = false;
                document.getElementById('hp10_calc_dose').disabled = false;
                document.getElementById('ezclip_calc_dose').disabled = false;
                document.getElementById('hp3_calc_dose').disabled = false;
                document.getElementById('measurement_date').disabled = false;
                
            }
        });
        $('#dpl_id').on('click', function(){
            var dpl_id = $('#dpl_id').prop("checked"); 
            /* alert(extraviado_id); */
            /* var extraviado_id = $(this).val(); */
            
            if($.trim(dpl_id) != 'false'){
                
                document.getElementById('hp007_calc_dose').disabled = true;
                document.getElementById('hp10_calc_dose').disabled = true;
                document.getElementById('ezclip_calc_dose').disabled = true;
                document.getElementById('hp3_calc_dose').disabled = true;
                document.getElementById('measurement_date').disabled = true;
                
            }else{
                document.getElementById('hp007_calc_dose').disabled = false;
                document.getElementById('hp10_calc_dose').disabled = false;
                document.getElementById('ezclip_calc_dose').disabled = false;
                document.getElementById('hp3_calc_dose').disabled = false;
                document.getElementById('measurement_date').disabled = false;
                
            }
        });
        $('#dsu_id').on('click', function(){
            var dsu_id = $('#dsu_id').prop("checked"); 
            /* alert(extraviado_id); */
            /* var extraviado_id = $(this).val(); */
            
            if($.trim(dsu_id) != 'false'){
                
                document.getElementById('hp007_calc_dose').disabled = true;
                document.getElementById('hp10_calc_dose').disabled = true;
                document.getElementById('ezclip_calc_dose').disabled = true;
                document.getElementById('hp3_calc_dose').disabled = true;
                document.getElementById('measurement_date').disabled = true;
                
            }else{
                document.getElementById('hp007_calc_dose').disabled = false;
                document.getElementById('hp10_calc_dose').disabled = false;
                document.getElementById('ezclip_calc_dose').disabled = false;
                document.getElementById('hp3_calc_dose').disabled = false;
                document.getElementById('measurement_date').disabled = false;
                
            }
        });
        $('#nota3checked').on('click', function(){
            var nota3checked = $('#nota3checked').prop("checked"); 
            if($.trim(nota3checked) != 'false'){
                $('#nota1checked').prop("checked", false);
            }
        });
        $('#nota4checked').on('click', function(){
            var nota4checked = $('#nota4checked').prop("checked"); 
            if($.trim(nota4checked) != 'false'){
                $('#nota1checked').prop("checked", false);
            }
        });
        $('#nota5checked').on('click', function(){
            var nota5checked = $('#nota5checked').prop("checked"); 
            if($.trim(nota5checked) != 'false'){
                $('#nota1checked').prop("checked", false);
            }
        });
        $('#hp10_calc_dose').on('change', function(){
            var hp10 = document.getElementById("hp10_calc_dose").value;
           /*  alert("no hay dosimetro de control"+hp10) */
            if (hp10 >= 12) {
                /* alert("es AMBIENTAL y se paso de la dosis roja"+hp10); */
                let Divhp10 = document.getElementById("hp10_calc_dose");
                Divhp10.classList.remove("dosisnaranja");
                Divhp10.classList.add("dosisroja");
                $('#nota1checked').prop("checked", false);
                $('#nota3checked').prop("checked", true);
            }else if(hp10 >= 1.67){
               /*  alert("es AMBIENTAL y se paso de la dosis naranja"+hp10); */
                let Divhp10 = document.getElementById("hp10_calc_dose");
                Divhp10.classList.remove("dosisroja");
                Divhp10.classList.add("dosisnaranja");
                $('#nota1checked').prop("checked", false);
                $('#nota3checked').prop("checked", true);
            }else{
                /* alert("es AMBIENTAL "+hp10); */
                let Divhp10 = document.getElementById("hp10_calc_dose");
                Divhp10.classList.remove("dosisroja");
                Divhp10.classList.remove("dosisnaranja");
                Divhp10.classList.add("form-control:focus");
                $('#nota1checked').prop("checked", true);
                $('#nota3checked').prop("checked", false);
            }
        });
        $('#hp007_calc_dose').on('change', function(){
            var hp007 = document.getElementById("hp007_calc_dose").value;
            /* alert("no hay dosimetro de control"+hp007); */
            if(hp007 >= 12){
                /* alert("es AMBIENTAL y se paso de la dosis roja"+hp007); */
                let Divhp007 = document.getElementById("hp007_calc_dose");
                Divhp007.classList.remove("dosisnaranja");
                Divhp007.classList.add("dosisroja");
                $('#nota1checked').prop("checked", false);
                $('#nota3checked').prop("checked", true);
                
            }else if(hp007 >= 1.67 ){
                /*  alert("es AMBIENTAL y se paso de la dosis naranja"+hp007); */
                let Divhp007 = document.getElementById("hp007_calc_dose");
                Divhp007.classList.remove("dosisroja");
                Divhp007.classList.add("dosisnaranja");
                $('#nota1checked').prop("checked", false);
                $('#nota3checked').prop("checked", true);
            }else{
                /* alert("es AMBIENTAL "+hp007); */
                let Divhp007 = document.getElementById("hp007_calc_dose");
                Divhp007.classList.remove("dosisroja");
                Divhp007.classList.remove("dosisnaranja");
                Divhp007.classList.add("form-control:focus");
                /* $('#nota1checked').prop("checked", true); */
                $('#nota3checked').prop("checked", false);
            }
            
        });
        $('#hp10_calc_dose').on('keyup', function(){
            var hp10 = document.getElementById("hp10_calc_dose").value;
            var hp3 = document.getElementById("hp3_calc_dose").value = hp10;
        });
        var measurement = document.getElementById('measurement_date');
        if(measurement != null){

            var fechaMeasurement = new Date(); //Fecha actual
            var mes = fechaMeasurement.getMonth()+1; //obteniendo mes
            var dia = fechaMeasurement.getDate(); //obteniendo dia
            var ano = fechaMeasurement.getFullYear(); //obteniendo año
            if(dia<10){
                dia='0'+dia; //agrega cero si el menor de 10
            }
            if(mes<10){
                mes='0'+mes //agrega cero si el menor de 10
            }
            measurement.value=ano+"-"+mes+"-"+dia;
        }

        $('.ir-arriba').click(function(){
            $('body, html').animate({
                scrollTop: '0px'
            }, 300);
        });

        $(window).scroll(function(){
            if( $(this).scrollTop() > 0 ){
                $('.ir-arriba').slideDown(300);
            } else {
                $('.ir-arriba').slideUp(300);
            }
        });
    })
    
</script>


@endsection