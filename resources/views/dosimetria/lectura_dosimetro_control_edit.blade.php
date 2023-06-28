@extends('layouts.app')
@extends('layouts.plantillabase')
@section('contenido')
<div class="row">
    <div class="col-md">
        <a type="button" class="btn btn-circle colorQA" href="{{route('asignadosicontrato.info', ['asigdosicont' => $dosicontasig->contdosisededepto_id, 'mesnumber' => $dosicontasig->mes_asignacion ])}}">
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-arrow-left mt-1" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
            </svg>
        </a>
    </div>
    <div class="col-md-9">
        <h2 class="text-center">DOSIMETRÍA DE </h2>
        <h3 class="text-center"><i>{{$dosicontasig->contratodosimetriasede->sede->empresa->nombre_empresa}}</i>- SEDE: <i>{{$dosicontasig->contratodosimetriasede->sede->nombre_sede}}</i> </h3>
        <h4 class="text-center">ESPECIALIDAD: {{$dosicontasig->contratodosimetriasededepto->departamentosede->departamento->nombre_departamento}}</h4>
    </div>
    <div class="col-md"></div>
</div>
<br>
<br>
    <h4 class="text-center" id="id_contrato"></h4>
<br>
<br>
<h3 class="text-center">
    EDITAR LECTURA DE DOSÍMETRO TIPO CONTROL {{$dosicontasig->ubicacion}}<br>
    DEL PERÍODO {{$dosicontasig->mes_asignacion}} (
    @if($dosicontasig->mes_asignacion == 1)
        @if($dosicontasig->contratodosimetriasede->dosimetriacontrato->periodo_recambio == 'MENS')
            @php
                $meses = ["01"=>'ENERO', "02"=>'FEBRERO', "03"=>'MARZO', "04"=>'ABRIL', "05"=>'MAYO', "06"=>'JUNIO', "07"=>'JULIO', "08"=>'AGOSTO', "09"=>'SEPTIEMBRE', "10"=>'OCTUBRE', "11"=>'NOVIEMBRE', "12"=>'DICIEMBRE'];
                $inicio = $dosicontasig->contratodosimetriasede->dosimetriacontrato->fecha_inicio;
                $fin = date("t-m-Y",strtotime($inicio));
                echo date("j", strtotime($inicio))." ".$meses[date("m", strtotime($inicio))]." DE ".date("Y", strtotime($inicio))." - ".date("t", strtotime($fin))." ".$meses[date("m", strtotime($fin))]." DE ".date("Y", strtotime($fin));
                /* echo $meses[date("m", strtotime($contdosisededepto->contratodosimetriasede->dosimetriacontrato->fecha_inicio))]." DE ".date("Y", strtotime($contdosisededepto->contratodosimetriasede->dosimetriacontrato->fecha_inicio)) ; */
            @endphp
        @elseif($dosicontasig->contratodosimetriasede->dosimetriacontrato->periodo_recambio == 'TRIMS')
            @php  
                $meses = ["01"=>'ENERO', "02"=>'FEBRERO', "03"=>'MARZO', "04"=>'ABRIL', "05"=>'MAYO', "06"=>'JUNIO', "07"=>'JULIO', "08"=>'AGOSTO', "09"=>'SEPTIEMBRE', "10"=>'OCTUBRE', "11"=>'NOVIEMBRE', "12"=>'DICIEMBRE'];
                $inicio = date($dosicontasig->contratodosimetriasede->dosimetriacontrato->fecha_inicio);
                $fecha1 = date("t-m-Y",strtotime($inicio));
                $fecha2= date("t-m-Y",strtotime($fecha1."+ 2 month"));
                echo date("j", strtotime($inicio))." ".$meses[date("m", strtotime($inicio))]." DE ".date("Y", strtotime($inicio))." - ".date("j", strtotime($fecha2))." ".$meses[date("m", strtotime($fecha2))]." DE ".date("Y", strtotime($fecha2))
            @endphp
        @elseif($dosicontasig->contratodosimetriasede->dosimetriacontrato->periodo_recambio == 'BIMS')
            @php  
                $meses = ["01"=>'ENERO', "02"=>'FEBRERO', "03"=>'MARZO', "04"=>'ABRIL', "05"=>'MAYO', "06"=>'JUNIO', "07"=>'JULIO', "08"=>'AGOSTO', "09"=>'SEPTIEMBRE', "10"=>'OCTUBRE', "11"=>'NOVIEMBRE', "12"=>'DICIEMBRE'];
                $fecha1 = date($dosicontasig->contratodosimetriasede->dosimetriacontrato->fecha_inicio);
                $fecha2_total = date("t-m-Y",strtotime($fecha1."+ 1 month"));
                echo date("j", strtotime($fecha1))." ".$meses[date("m", strtotime($fecha1))]." DE ".date("Y", strtotime($fecha1))." - ".date("j", strtotime($fecha2_total))." ".$meses[date("m", strtotime($fecha2_total))]." DE ".date("Y", strtotime($fecha2_total))
            @endphp
        @endif
    @else
        <span id="mes{{$dosicontasig->mes_asignacion}}"></span>
    @endif
    )
</h3>
<br>
<div class="row">
        <div class="col"></div>
        <div class="col-11">
            <div class="card ">
                <div class="card-header ">
                    <ul class="nav nav-tabs card-header-tabs" id="infoLectura" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" href="#infoempresa" role="tab" aria-controls="infoempresa" aria-selected="true">INFO EMPRESA</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"  href="#infocontrato" role="tab" aria-controls="infocontrato" aria-selected="false">INFO CONTRATO</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link link-danger" href="#lectura" role="tab" aria-controls="lectura" aria-selected="false">LECTURA</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content mt-3">
                        <!-- //////////////////// PESTAÑA DE INFO EMPRESA //////////////// -->
                        <div class="tab-pane active" id="infoempresa" role="tabpanel">
                            <h4 class="card-title text-center pt-3">INFORMACIÓN DE LA EMPRESA</h4>
                            <BR></BR>
                            <Label class="mx-5">LA SIGUIENTE ES INFORMACIÓN DE LA EMPRESA QUE FUE RELACIONA AL DOSÍMETRO DE TIPO CONTROL EN EL PROCESO DE ASIGNACIÓN:</Label>
                            <BR></BR>
                            <div class="row">
                                <div class="col"></div>
                                <div class="col-md m-4">
                                    <label for="floatingInputGrid"> <b>EMPRESA:</b> </label>
                                    <input type="text"  class="form-control text-center" name="empresaLectDosimControl" id="empresaLectDosimControl" value="{{$dosicontasig->contratodosimetriasede->sede->empresa->nombre_empresa}}" readonly>
                                    <br>
                                    
                                </div>
                                <div class="col-md m-4">
                                    <label for="floatingInputGrid"> <b>NÚM. IDEN.:</b> </label>
                                    <input type="text" class="form-control text-center" name="numIdenEmpresaLectDosimControl" id="numIdenEmpresaLectDosimControl" value="{{$dosicontasig->contratodosimetriasede->sede->empresa->num_iden_empresa}}" readonly>
                                    <br>
                                   
                                </div>
                                <div class="col-md m-4">
                                    <label for="floatingInputGrid"> <b>SEDE:</b> </label>
                                    <input type="text"  class="form-control text-center" name="sedeLectDosimControl" id="sedeLectDosimControl" value="{{$dosicontasig->contratodosimetriasede->sede->nombre_sede}}" readonly>
                                    <br>
                                </div>
                                <div class="col-md m-4">
                                    <label for="floatingInputGrid"> <b>DEPARTAMENTO:</b> </label>
                                    <input type="text"  class="form-control text-center" name="deptoLectDosimControl" id="deptoLectDosimControl" value="{{$dosicontasig->contratodosimetriasededepto->departamentosede->departamento->nombre_departamento}}" readonly>
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
                                    <input type="text"  class="form-control" name="codDosimLectDosimControl" id="codDosimLectDosimControl" value="{{$dosicontasig->dosimetro->codigo_dosimeter}}" readonly>
                                    <br>
                                    <label for="floatingInputGrid"> <b>PRIMER DÍA USO:</b> </label>
                                    <input type="text" class="form-control" name="primDiaUsoLectDosimControl" id="primDiaUsoLectDosimControl" value="{{$dosicontasig->primer_dia_uso}}" readonly>
                                    <br>
                                    <label for="floatingInputGrid"> <b>OCUPACIÓN:</b> </label>
                                    <input type="text"  class="form-control" name="ocupLectDosimControl" id="ocupLectDosimControl" value="{{$dosicontasig->contratodosimetriasede->dosimetriacontrato->ocupacion}}" readonly>
                                </div>
                                <div class="col m-4">
                                    <label for="floatingInputGrid"> <b>TIPO DOSÍMETRO:</b></label>
                                    <input type="text"  class="form-control" name="tipoDoimLectDosimControl" id="tipoDosimLectDosimControl" value="{{$dosicontasig->dosimetro->tipo_dosimetro}}" readonly>
                                    <br>
                                    <label for="floatingInputGrid"> <b>ULTIMO DÍA USO:</b> </label>
                                    <input type="text"  class="form-control" name="ultDiaUsobLectDosimControl" id="ultDiaUsobLectDosimControl" value="{{$dosicontasig->ultimo_dia_uso}}" readonly>
                                    <br>
                                    <label for="floatingInputGrid"> <b>ENERGÍA:</b> </label>
                                    <input type="text"  class="form-control" name="energiaLectDosimControl" id="energiaLectDosimControl" value="{{$dosicontasig->energia}}" readonly>
                                </div>
                                <div class="col-3 m-4">
                                    <label for="floatingInputGrid"> <b>FECHA INGRESO AL SERVICIO:</b> </label>
                                    <input type="text"  class="form-control" name="FIngServLectDosimControl" id="FIngServLectDosimControl" value="{{$dosicontasig->dosimetro->fecha_ingreso_servicio}}" readonly>
                                    <br>
                                    <label for="floatingInputGrid"> <b>PERIODO DE RECAMBIO:</b> </label>
                                    <input type="text"  class="form-control" name="pRecamLectDosimControl" id="pRecamLectDosimControl" value="{{$dosicontasig->contratodosimetriasede->dosimetriacontrato->periodo_recambio}}" readonly>
                                    <br>
                                </div>
                                <div class="col"></div>
                            </div>
                            <br>
                        </div>
                        <!-- //////////////////// PESTAÑA DE LECTURA//////////////// -->
                        <div class="tab-pane" id="lectura" role="tabpanel" aria-labelledby="lectura-tab">
                            {{-- <h4 class="card-title text-center pt-3">LECTURA DE DOSÍMETRO TIPO {{$dosicontasig->dosimetro->tipo_dosimetro}} ASIGNADO AL MES {{$dosicontasig->mes_asignacion}}</h4> --}}
                            <h4 class="card-title text-center">CÓDIGO DEL DOSÍMETRO: {{$dosicontasig->dosimetro->codigo_dosimeter}}</h4>
                            <BR></BR>
                            <Label class="mx-5">MODIFIQUE LA INFORMACIÓN DE LA LECTURA DEL DOSÍMETRO ASIGNADO:</Label>
                            <BR></BR>
                            <div class="row">
                                <div class="col"></div>
                                <div class="col-10">
                                    <div class="card text-dark bg-light">
                                        <form class="m-4" id="form_edit_save_lectura_dosim" name="form_edit_save_lectura_dosim" action="{{route('lecturadosicontrol.save', $dosicontasig )}}" method="POST">
                                            
                                            @csrf

                                            @method('put')

                                            <input type="NUMBER" id="mes_asignacion" name="mes_asignacion" value="{{$dosicontasig->mes_asignacion}}" hidden>
                                            <input type="NUMBER" id="id_contratodosimetriasededepto" name="id_contratodosimetriasededepto" value="{{$dosicontasig->contdosisededepto_id}}" hidden>
                                            <div class="row g-2">
                                                <div class="col-md-4 mx-4">
                                                    @if($dosicontasig->ubicacion == 'TORAX')
                                                        <div class="form-floating">
                                                            <input type="NUMBER" step="any" class="form-control" name="hp10_calc_dose" id="hp10_calc_dose" value="{{$dosicontasig->Hp10_calc_dose}}">
                                                            <label for="floatingInputGrid">Hp10 CALC DOSE:</label>
                                                        </div>
                                                        <br>
                                                        <div class="form-floating">
                                                            <input type="NUMBER" step="any" class="form-control" name="hp007_calc_dose" id="hp007_calc_dose" value="{{$dosicontasig->Hp007_calc_dose}}">
                                                            <label for="floatingInputGrid">Hp007 CALC DOSE:</label>
                                                        </div>
                                                        <br>
                                                        <div class="form-floating">
                                                            <input type="date" class="form-control" name="measurement_date"  id="measurement_date" value="{{$dosicontasig->measurement_date}}">
                                                            <label for="floatingInputGrid">MEASUREMENT DATE:</label>
                                                        </div>
                                                    @elseif($dosicontasig->ubicacion == 'CRISTALINO')
                                                        <div class="form-floating">
                                                            <input type="NUMBER" step="any" class="form-control" name="hp3_calc_dose" id="hp3_calc_dose" value="{{$dosicontasig->Hp3_calc_dose}}">
                                                            <label for="floatingInputGrid">Hp3 CALC DOSE:</label>
                                                        </div>
                                                        <br>
                                                        <div class="form-floating">
                                                            <input type="date" class="form-control" name="measurement_date"  id="measurement_date" value="{{$dosicontasig->measurement_date}}">
                                                            <label for="floatingInputGrid">MEASUREMENT DATE:</label>
                                                        </div>
                                                    @elseif($dosicontasig->ubicacion == 'ANILLO')
                                                        <div class="form-floating">
                                                            <input type="NUMBER" step="any" class="form-control" name="hp007_calc_dose" id="hp007_calc_dose" value="{{$dosicontasig->Hp007_calc_dose}}">
                                                            <label for="floatingInputGrid">Hp007 CALC DOSE:</label>
                                                        </div>
                                                        <br>
                                                        <div class="form-floating">
                                                            <input type="date" class="form-control" name="measurement_date"  id="measurement_date" value="{{$dosicontasig->measurement_date}}">
                                                            <label for="floatingInputGrid">MEASUREMENT DATE:</label>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="col-md mx-4">
                                                   
                                                    <div class="form-check">
                                                        @if($dosicontasig->nota1 == 'TRUE')
                                                            <input class="form-check-input" type="checkbox" value="TRUE" id="" name="nota1" checked>
                                                        @else
                                                            <input class="form-check-input" type="checkbox" value="TRUE" id="" name="nota1">
                                                        @endif
                                                        <label class="form-check-label" for="reverseCheck1">1 = Ninguna </label>
                                                    </div>
                                                    <div class="form-check">
                                                        @if($dosicontasig->nota2 == 'TRUE')
                                                            <input class="form-check-input" type="checkbox" value="TRUE" id="" name="nota2" checked >
                                                        @else
                                                            <input class="form-check-input" type="checkbox" value="TRUE" id="" name="nota2">
                                                        @endif
                                                        <label class="form-check-label" for="reverseCheck1">2 = Extraviado</label>
                                                    </div>
                                                    <div class="form-check">
                                                        @if($dosicontasig->nota3 == 'TRUE')
                                                            <input class="form-check-input" type="checkbox" value="TRUE" id="" name="nota3" checked>
                                                        @else
                                                            <input class="form-check-input" type="checkbox" value="TRUE" id="" name="nota3">
                                                        @endif
                                                        <label class="form-check-label" for="reverseCheck1">3 = Supera la dosis permitida</label>
                                                    </div>
                                                    <div class="form-check">
                                                        @if($dosicontasig->nota4 == 'TRUE')
                                                            <input class="form-check-input" type="checkbox" value="TRUE" id="" name="nota4" checked>
                                                        @else
                                                            <input class="form-check-input" type="checkbox" value="TRUE" id="" name="nota4">
                                                        @endif
                                                        <label class="form-check-label" for="reverseCheck1">4 = Dosímetro reprocesado</label>
                                                    </div>
                                                    <div class="form-check">
                                                        @if($dosicontasig->nota5 == 'TRUE')
                                                            <input class="form-check-input" type="checkbox" value="TRUE" id="" name="nota5" checked>
                                                        @else
                                                            <input class="form-check-input" type="checkbox" value="TRUE" id="" name="nota5">
                                                        @endif
                                                        <label class="form-check-label" for="reverseCheck1">5 = Control no utilizado en la evaluación</label> 
                                                    </div>
                                                    <div class="form-check">
                                                        @if($dosicontasig->DNL == 'TRUE')
                                                            <input class="form-check-input" type="checkbox" value="TRUE" id="" name="dnl"  checked>
                                                        @else
                                                            <input class="form-check-input" type="checkbox" value="TRUE" id="" name="dnl">
                                                        @endif
                                                        <label class="form-check-label" for="reverseCheck1">DNL = Dosímetro No Legible</label> 
                                                    </div>
                                                    <div class="form-check">
                                                        @if($dosicontasig->EU == 'TRUE')
                                                            <input class="form-check-input" type="checkbox" value="TRUE" id="" name="eu" checked>
                                                        @else
                                                            <input class="form-check-input" type="checkbox" value="TRUE" id="" name="eu">
                                                        @endif
                                                        <label class="form-check-label" for="reverseCheck1"> EU = Dosímetro en Uso </label> 
                                                    </div>
                                                    <div class="form-check">
                                                        @if($dosicontasig->DPL == 'TRUE')
                                                            <input class="form-check-input" type="checkbox" value="TRUE" id="" name="dpl" checked>
                                                        @else
                                                            <input class="form-check-input" type="checkbox" value="TRUE" id="" name="dpl">
                                                        @endif
                                                        <label class="form-check-label" for="reverseCheck1">DPL = Dosímetro en Proceso de Lectura</label> 
                                                    </div>
                                                    <div class="form-check">
                                                        @if($dosicontasig->DSU == 'TRUE')
                                                            <input class="form-check-input" type="checkbox" value="TRUE" id="" name="dsu" checked>
                                                        @else
                                                            <input class="form-check-input" type="checkbox" value="TRUE" id="" name="dsu">
                                                        @endif
                                                        <label class="form-check-label" for="reverseCheck1">DSU = Dosímetro sin usar</label> 
                                                    </div>
                                                   
                                                </div>
                                            </div>
                                            <br>
                                            {{-- <div class="row g-2">
                                                <div class="col-md mx-4">
                                                    <div class="form-floating">
                                                        <input type="NUMBER" step="any" class="form-control" name="hp10_calc_dose" id="hp10_calc_dose" value="{{$dosicontasig->Hp10_calc_dose}}">
                                                        <label for="floatingInputGrid">Hp10 CALC DOSE:</label>
                                                    </div>
                                                </div>
                                                <div class="col-md mx-4">
                                                    <div class="form-floating">
                                                        <input type="NUMBER" step="any" class="form-control"  name="hp10_background_dose" id="hp10_background_dose" value="{{$dosicontasig->Hp10_background_dose}}">
                                                        <label for="floatingInputGrid">Hp10 BACKGROUND DOSE:</label>
                                                    </div>
                                                </div>
                                                <div class="col-md mx-4">
                                                    <div class="form-floating">
                                                        <input type="NUMBER" step="any" class="form-control" name="hp10_raw_dose" id="hp10_raw_dose" value="{{$dosicontasig->Hp10_raw_dose}}">
                                                        <label for="floatingInputGrid">Hp10 RAW DOSE:</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row g-2">
                                                <div class="col-md mx-4">
                                                    <div class="form-floating">
                                                        <input type="NUMBER" step="any" class="form-control" name="ezclip_calc_dose" id="ezclip_calc_dose" value="{{$dosicontasig->Ezclip_calc_dose}}">
                                                        <label for="floatingInputGrid">EzClip CALC DOSE:</label>
                                                    </div>
                                                </div>
                                                <div class="col-md mx-4">
                                                    <div class="form-floating">
                                                        <input type="NUMBER" step="any" class="form-control" name="ezclip_background_dose" id="ezclip_background_dose" value="{{$dosicontasig->Ezclip_background_dose}}">
                                                        <label for="floatingInputGrid">EzClip BACKGROUND DOSE:</label>
                                                    </div>
                                                </div>
                                                <div class="col-md mx-4">
                                                    <div class="form-floating">
                                                        <input type="NUMBER" step="any" class="form-control" name="ezclip_raw_dose" id="ezclip_raw_dose" value="{{$dosicontasig->Ezclip_raw_dose}}">
                                                        <label for="floatingInputGrid">EzClip RAW DOSE:</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row g-2">
                                                <div class="col-md mx-4">
                                                    <div class="form-floating">
                                                        <input type="NUMBER" step="any" class="form-control" name="hp3_calc_dose" id="hp3_calc_dose" value="{{$dosicontasig->Hp3_calc_dose}}">
                                                        <label for="floatingInputGrid">Hp3 CALC DOSE:</label>
                                                    </div>
                                                </div>
                                                <div class="col-md mx-4">
                                                    <div class="form-floating">
                                                        <input type="NUMBER" step="any" class="form-control" name="hp3_background_dose" id="hp3_background_dose" value="{{$dosicontasig->Hp3_background_dose}}">
                                                        <label for="floatingInputGrid">Hp3 BACKGROUND DOSE:</label>
                                                    </div>
                                                </div>
                                                <div class="col-md mx-4">
                                                    <div class="form-floating">
                                                        <input type="NUMBER" step="any" class="form-control" name="hp3_raw_dose" id="hp3_raw_dose" value="{{$dosicontasig->Hp3_raw_dose}}">
                                                        <label for="floatingInputGrid">Hp3 RAW DOSE:</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row g-2">
                                                <div class="col-md mx-4">
                                                    <div class="form-floating">
                                                        <input type="date" class="form-control" name="measurement_date"  id="measurement_date" value="{{$dosicontasig->measurement_date}}">
                                                        <label for="floatingInputGrid">MEASUREMENT DATE:</label>
                                                    </div>
                                                </div>
                                                <div class="col-md mx-4">
                                                    <div class="form-floating">
                                                        <input type="date" class="form-control" name="zeroLevel_date" id="zeroLevel_date" value="{{$dosicontasig->zero_level_date}}">
                                                        <label for="floatingInputGrid">ZERO LEVEL DATE:</label>
                                                    </div>
                                                </div>
                                                <div class="col-md mx-4">
                                                    <div class="form-floating">
                                                        <input type="NUMBER" step="any" class="form-control" name="h10_cal_dose" id="h10_cal_dose" value="{{$dosicontasig->H_10_calc_dose}}">
                                                        <label for="floatingInputGrid">H*(10) CALC DOSE:</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row g-2">
                                                <div class="col-4 mx-4 ">
                                                    <div class="form-floating">
                                                        <input type="date" class="form-control" name="verification_Date" id="verification_Date" value="{{$dosicontasig->verification_date}}">
                                                        <label for="floatingInputGrid">VERIFICATION DATE:</label>
                                                    </div>
                                                </div>
                                                <div class="col mx-4 ">
                                                    <div class="form-floating">
                                                        <input type="date" class="form-control" name="verification_required_before" id="verification_required_before" value="{{$dosicontasig->verification_required_on_or_before}}">
                                                        <label for="floatingInputGrid">VERIFICATION REQUIRED ON OR BEFORE:</label>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            <br>
                                            <div class="row g-2">
                                                <div class="col-5 mx-4">
                                                    <div class="form-floating">
                                                        <input type="NUMBER" class="form-control" name="remaining_days_available_use" id="remaining_days_available_use" value="{{$dosicontasig->remaining_days_available_for_use}}">
                                                        <label for="floatingInputGrid">REMAINING DAYS AVAILABLE FOR USE:</label>
                                                    </div>
                                                </div>
                                                @if($dosicontasig->dosimetro->estado_dosimetro == 'EN LECTURA' || $dosicontasig->dosimetro->estado_dosimetro == 'EN USO')
                                                    <div class="col">
                                                        <label for="">A CONTINUACIÓN, SELECCIONE SI DESEA QUE EL DOSÍMETRO CAMBIE DEL ESTADO "EN LECTURA" A "EN STOCK": </label>
                                                        <BR></BR>
                                                        <div class="row">
                                                            <div class="col"></div>
                                                            <div class="col-6">
                                                                <div class="form-check">
                                                                    <input class="form-check-input " type="checkbox" value="TRUE" id="estado_uso" name="estado_uso">
                                                                    <label class="form-check-label" for="defaultCheck1">
                                                                        DOSÍMETRO EN STOCK
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col"></div>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                            <br> --}}
                                            <!-- ----------------BOTON--------------- -->
                                            <div class="row g-2">
                                                <div class="col-md"></div>
                                                <div class="col-md"></div>
                                                <div class="col-md d-grid gap-2">
                                                    <input type="submit" class="btn colorQA mt-2" name="update" id="update" value="EDITAR">
                                                </div>
                                                <div class="col-md d-grid gap-2">
                                                    <a class="btn btn-danger mt-2" type="button" id="cancelar" name="cancelar" href="{{route('asignadosicontrato.info', ['asigdosicont' => $dosicontasig->contdosisededepto_id, 'mesnumber' => $dosicontasig->mes_asignacion ])}}"  role="button">CANCELAR</a>
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
        <div class="col"></div>
    </div>
    <BR></BR> 


<script
src="https://code.jquery.com/jquery-3.6.0.js"
integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
crossorigin="anonymous">
</script>
<script type="text/javascript">
    $(document).ready(function(){
        
        var TDcontrato = document.getElementById("id_contrato");
        var num = parseInt('{{$dosicontasig->contratodosimetriasede->dosimetriacontrato->codigo_contrato}}');
        var n = num.toString().padStart(5,'0');
        console.log("ESTE ES EL CODIGO" +n);
        TDcontrato.innerHTML = "CONTRATO No."+n;

        
        // Creamos array con los meses del año
        const meses = ['ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO', 'JULIO', 'AGOSTO', 'SEPTIEMBRE', 'OCTUBRE', 'NOVIEMBRE', 'DICIEMBRE'];
        let fecha = new Date("{{$dosicontasig->contratodosimetriasede->dosimetriacontrato->fecha_inicio}}, 00:00:00");
        console.log(fecha);
        var numLec = '{{$dosicontasig->contratodosimetriasede->dosimetriacontrato->numlecturas_año}}';
        var ultimoDiaPM = new Date(fecha.getFullYear(), fecha.getMonth() + 1, 1);
        console.log("ULTIMO DIA PRIMER MES:"+ ultimoDiaPM);
        if('{{$dosicontasig->contratodosimetriasede->dosimetriacontrato->periodo_recambio}}' == 'MENS'){
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
                    if("{{$dosicontasig->mes_asignacion}}" == xx){
                        document.getElementById('mes{{$dosicontasig->mes_asignacion}}').innerHTML = fechaesp1+' - '+fechaesp2;
                        
                    }
                }
            }
        }else if('{{$dosicontasig->contratodosimetriasede->dosimetriacontrato->periodo_recambio}}' == 'TRIMS'){
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
               
                if("{{$dosicontasig->mes_asignacion}}" == xx){
                    document.getElementById('mes{{$dosicontasig->mes_asignacion}}').innerHTML = fechaesp1+' - '+fechaesp2;
                    
                }
                
            }
        }else if('{{$dosicontasig->contratodosimetriasede->dosimetriacontrato->periodo_recambio}}' == 'BIMS'){
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
                
                if("{{$dosicontasig->mes_asignacion}}" == xx){
                    document.getElementById('mes{{$dosicontasig->mes_asignacion}}').innerHTML = fechaesp1+' - '+fechaesp2;
                    
                }
                
            }
        }

        $('#infoLectura a').on('click', function (e) {
            e.preventDefault()
            $(this).tab('show')
        })
    })
</script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#form_edit_save_lectura_dosim').submit(function(e){
            e.preventDefault();
            Swal.fire({
                text: "SEGURO QUE DESEA MODIFICAR LA LECTURA DE ESTE DOSIMETRO?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'SI!'
                }).then((result) => {
                if (result.isConfirmed) {
                    
                    this.submit(); 
                }
            })
           
        })
    })
</script>
@endsection