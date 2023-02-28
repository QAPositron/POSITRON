@extends('layouts.app')
@extends('layouts.plantillabase')
@section('contenido') 
<div class="row">
    <div class="col-md">
        <a type="button" class="btn btn-circle colorQA" href="{{route('asignadosicontrato.info', ['asigdosicont' => $trabjasig->contdosisededepto_id, 'mesnumber' => $trabjasig->mes_asignacion ])}}">
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-arrow-left mt-1" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
            </svg>
        </a>
    </div>
    {{-- <div class="col-md-6">
        <h3 class="text-center">xxxxLECTURA DE DOSÍMETRO </h3>
        <h3 class="text-center">ESPECIALIDAD: {{$trabjasig->contratodosimetriasededepto->departamentosede->departamento->nombre_departamento}} <br> CONTRATO No. {{$trabjasig->contratodosimetriasede->dosimetriacontrato->codigo_contrato}} - MES {{$trabjasig->mes_asignacion}}</h3>
    </div> --}}
    <div class="col-md-9">
        <h2 class="text-center">DOSIMETRÍA DE </h2> 
        <h3 class="text-center"><i>{{$trabjasig->contratodosimetriasede->sede->empresa->nombre_empresa}}</i>- SEDE: <i>{{$trabjasig->contratodosimetriasede->sede->nombre_sede}}</i> </h3>
        <h4 class="text-center">ESPECIALIDAD: {{$trabjasig->contratodosimetriasededepto->departamentosede->departamento->nombre_departamento}}</h4>    
    </div>
    <div class="col-md"></div>
</div>
<br>
<h4 class="text-center" id="id_contrato"></h4>
<br>
<h3 class="text-center">
    LECTURA DE DOSÍMETRO <br> DEL MES {{$trabjasig->mes_asignacion}} (
    @if($trabjasig->mes_asignacion == 1)
        @php
            $meses = ["01"=>'ENERO', "02"=>'FEBRERO', "03"=>'MARZO', "04"=>'ABRIL', "05"=>'MAYO', "06"=>'JUNIO', "07"=>'JULIO', "08"=>'AGOSTO', "09"=>'SEPTIEMBRE', "10"=>'OCTUBRE', "11"=>'NOVIEMBRE', "12"=>'DICIEMBRE'];
            echo $meses[date("m", strtotime($trabjasig->contratodosimetriasede->dosimetriacontrato->fecha_inicio))]." DE ".date("Y", strtotime($trabjasig->contratodosimetriasede->dosimetriacontrato->fecha_inicio)) ;
        @endphp
    @else
        <span id="mes{{$trabjasig->mes_asignacion}}"></span>
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
                        <a class="nav-link active" href="#infotrabajador" role="tab" aria-controls="infotrabajador" aria-selected="true">INFO TRABAJADOR</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"  href="#infocontrato" role="tab" aria-controls="infocontrato" aria-selected="false">INFO CONTRATO</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#lectura" role="tab" aria-controls="lectura" aria-selected="false">LECTURA</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content mt-3">
                    <!-- //////////////////// PESTAÑA DE INFO EMPRESA //////////////// -->
                    <div class="tab-pane active" id="infotrabajador" role="tabpanel">
                        <h4 class="card-title text-center pt-3">INFORMACIÓN DEL TRABAJADOR</h4>
                        <BR></BR>
                        <Label class="mx-5">LA SIGUIENTE ES INFORMACIÓN DE LA EMPRESA Y EL TRABAJADOR, QUE FUERON RELACIONADOS AL DOSÍMETRO EN EL PROCESO DE ASIGNACIÓN:</Label>
                        <BR></BR>
                        <div class="row">
                            <div class="col-md "></div>
                            <div class="col-md-2  m-4">
                                <label for="floatingInputGrid"> <b>EMPRESA:</b> </label>
                                <input type="text" class="form-control" name="empresaLectDosim" id="empresaLectDosim" value="{{$trabjasig->contratodosimetriasede->sede->empresa->nombre_empresa}}" readonly>
                                <br>
                                <label for="floatingInputGrid"> <b>NOMBRES:</b> </label>
                                <input type="text"  class="form-control" name="nombrestrabLectDosim" id="nombrestrabLectDosim" value="{{$trabjasig->persona->primer_nombre_persona}} {{$trabjasig->persona->segundo_nombre_persona}}" readonly>
                                <br>
                                <label for="floatingInputGrid"> <b>EMAIL:</b> </label>
                                <input type="text"  class="form-control" name="correotrabLectDosim" id="correotrabLectDosim" value="{{$trabjasig->persona->correo_persona}}" readonly>
                            </div>
                            <div class="col-md-2 m-4">
                                <label for="floatingInputGrid"> <b>NÚM. IDEN.:</b> </label>
                                <input type="text" style="width: 120px;" class="form-control" name="numIdenEmpresaLectDosim" id="numIdenEmpresaLectDosim" value="{{$trabjasig->contratodosimetriasede->sede->empresa->num_iden_empresa}}" readonly>
                                <br>
                                <label for="floatingInputGrid"> <b>APELLIDOS:</b> </label>
                                <input type="text" class="form-control" name="apellidostrabLectDosim" id="apellidostrabLectDosim" value="{{$trabjasig->persona->primer_apellido_persona}} {{$trabjasig->persona->segundo_apellido_persona}}" readonly>
                                <br>
                                <label for="floatingInputGrid"> <b>TELÉFONO:</b> </label>
                                <input type="text" style="width: 150px;" class="form-control" name="telefonotrabLectDosim" id="telefonotrabLectDosim" value="{{$trabjasig->persona->telefono_persona}}" readonly>
                            </div>
                            <div class="col m-4">
                                <label for="floatingInputGrid"> <b>SEDE:</b> </label>
                                <input type="text"  class="form-control" name="sedeLectDosim" id="sedeLectDosim" value="{{$trabjasig->contratodosimetriasede->sede->nombre_sede}}" readonly>
                                <br>
                                <label for="floatingInputGrid"> <b>GÉNERO:</b> </label>
                                <input type="text" style="width: 130px;" class="form-control" name="generoLectDosim" id="generoLectDosim" value="{{$trabjasig->persona->genero_persona}}" readonly>
                                
                            </div>
                            <div class="col-md-2 m-4">
                                <label for="floatingInputGrid"> <b>ESPECIALIDAD:</b> </label>
                                <input type="text"  class="form-control text-center" name="deptoLectDosim" id="deptoLectDosim" value="{{$trabjasig->contratodosimetriasededepto->departamentosede->departamento->nombre_departamento}}" readonly>
                                <br>
                                <label for="floatingInputGrid"> <b>CEDULA:</b> </label>
                                <input type="text"  class="form-control" name="cedulatrabLectDosim" id="cedulatrabLectDosim" value="{{$trabjasig->persona->cedula_persona}}" readonly>
                            </div>
                            <div class="col-md m-4"></div>
                        </div>
                        <br>
                    </div>
                    <!-- //////////////////// PESTAÑA DE INFO CONTRATO //////////////// -->
                    <div class="tab-pane" id="infocontrato" role="tabpanel" aria-labelledby="infocontrato-tab">
                        <h4 class="card-title text-center pt-3">INFORMACIÓN DEL CONTRATO</h4>
                        <BR></BR>
                        <Label class="mx-5">LA SIGUIENTE ES INFORMACIÓN DEL CONTRATO QUE ES RAELACIONADO AL DOSÍMETRO EN EL PROCESO DE ASIGNACIÓN:</Label>
                        <BR></BR>
                        <div class="row">
                            <div class="col"></div>
                            <div class="col">
                                <label for="floatingInputGrid"> <b>CODIGO DOSÍMETRO:</b> </label>
                                <input type="text" style="width: 120px;" class="form-control" name="codDosimLectDosim" id="codDosimLectDosim" value="{{$trabjasig->dosimetro->codigo_dosimeter}}" readonly>
                                <br>
                                <label for="floatingInputGrid"> <b>PRIMER DÍA USO:</b> </label>
                                <input type="text" style="width: 180px;" class="form-control" name="primDiaUsoLectDosim" id="primDiaUsoLectDosim" value="{{$trabjasig->primer_dia_uso}}" readonly>
                                <br>
                                <label for="floatingInputGrid"> <b>OCUPACIÓN:</b> </label>
                                <input type="text"  class="form-control" name="ocupLectDosim" id="ocupLectDosim" value="{{$trabjasig->ocupacion}}" readonly>
                            </div>
                            <div class="col">
                                <label for="floatingInputGrid"> <b>TIPO DOSÍMETRO:</b></label>
                                <input type="text" style="width: 120px;" class="form-control" name="tipoDoimLectDosim" id="tipoDosimLectDosim" value="{{$trabjasig->dosimetro->tipo_dosimetro}}" readonly>
                                <br>
                                <label for="floatingInputGrid"> <b>ULTIMO DÍA USO:</b> </label>
                                <input type="text" style="width: 200px;" class="form-control" name="ultDiaUsobLectDosim" id="ultDiaUsobLectDosim" value="{{$trabjasig->ultimo_dia_uso}}" readonly>
                                <br>
                                <label for="floatingInputGrid"> <b>UBICACIÓN:</b></label>
                                <input type="text"  class="form-control" name="ubicacionLectDosim" id="ubicacionLectDosim" value="{{$trabjasig->ubicacion}}" readonly>
                            </div>
                            <div class="col-3">
                                <label for="floatingInputGrid"> <b>FECHA INGRESO AL SERVICIO:</b> </label>
                                <input type="text" style="width: 120px;" class="form-control" name="FIngServLectDosim" id="FIngServLectDosim" value="{{$trabjasig->dosimetro->fecha_ingreso_servicio}}" readonly>
                                <br>
                                <label for="floatingInputGrid"> <b>PERIODO DE RECAMBIO:</b> </label>
                                <input type="text" style="width: 130px;" class="form-control" name="pRecamLectDosim" id="pRecamLectDosim" value="{{$trabjasig->contratodosimetriasede->dosimetriacontrato->periodo_recambio}}" readonly>
                                <br>
                                <label for="floatingInputGrid"> <b>ENERGÍA:</b> </label>
                                <input type="text" style="width: 150px;" class="form-control" name="energiaLectDosim" id="energiaLectDosim" value="{{$trabjasig->energia}}" readonly>
                            </div>
                            <div class="col"></div>
                        </div>
                        <br>
                    </div>
                    <!-- //////////////////// PESTAÑA DE LECTURA//////////////// -->
                    <div class="tab-pane" id="lectura" role="tabpanel" aria-labelledby="lectura-tab">
                        
                        <h4 class="card-title text-center pt-3">CÓDIGO DEL DOSÍMETRO: {{$trabjasig->dosimetro->codigo_dosimeter}} - UBICACIÓN: {{$trabjasig->ubicacion}}</h4>
                        <h4 class="card-title text-center">TRABAJADOR: {{$trabjasig->persona->primer_nombre_persona}} {{$trabjasig->persona->segundo_nombre_persona}} {{$trabjasig->persona->primer_apellido_persona}} {{$trabjasig->persona->segundo_apellido_persona}}</h4>
                        <BR></BR>
                        <Label class="mx-5">INGRESE LA INFORMACIÓN DE LA LECTURA DEL DOSÍMETRO ASIGNADO:</Label>
                        <BR></BR>
                        <div class="row">
                            <div class="col"></div>
                            <div class="col-10">
                                <div class="card text-dark bg-light">
                                    
                                    <form class="m-4" action="{{route('lecturadosi.save', $trabjasig)}}" method="POST">
                                    
                                        @csrf

                                        @method('put')
                                        <input type="NUMBER" id="mes_asignacion" name="mes_asignacion" value="{{$trabjasig->mes_asignacion}}" hidden>
                                        <input type="NUMBER" id="id_contratodosimetriasededepto" name="id_contratodosimetriasededepto" value="{{$trabjasig->contdosisededepto_id}}" hidden>
                                        <div class="row g-2">
                                            <div class="col-md-3 mx-4">
                                                <div class="form-floating">
                                                    @if($trabjasig->nota2 == 'TRUE'|| $trabjasig->DNL == 'TRUE'|| $trabjasig->EU == 'TRUE' || $trabjasig->DSU =='TRUE' || $trabjasig->DPL =='TRUE'|| $trabjasig->measurement_date != '')
                                                        <input type="NUMBER" class="form-control" name="hp10_calc_dose" id="hp10_calc_dose_readonly" value="{{$trabjasig->Hp10_calc_dose}}" readonly>
                                                    @else
                                                        <input type="NUMBER" step="any" class="form-control" name="hp10_calc_dose" id="hp10_calc_dose" value="{{$trabjasig->Hp10_calc_dose}}">
                                                    @endif
                                                    <label for="floatingInputGrid">Hp10 CALC DOSE:</label>
                                                </div>
                                                <br>
                                                <div class="form-floating">
                                                    @if($trabjasig->nota2 == 'TRUE'|| $trabjasig->DNL == 'TRUE'|| $trabjasig->EU == 'TRUE' || $trabjasig->DSU =='TRUE' || $trabjasig->DPL =='TRUE'|| $trabjasig->measurement_date != '')
                                                        <input type="NUMBER" class="form-control" name="hp3_calc_dose" id="hp3_calc_dose_readonly" value="{{$trabjasig->Hp3_calc_dose}}" readonly>
                                                    @else
                                                        <input type="NUMBER" step="any" class="form-control" name="hp3_calc_dose" id="hp3_calc_dose" value="{{$trabjasig->Hp3_calc_dose}}">
                                                    @endif
                                                    <label for="floatingInputGrid">Hp3 CALC DOSE:</label>
                                                </div>
                                                <br>
                                                <div class="form-floating">
                                                    @if($trabjasig->nota2 == 'TRUE'|| $trabjasig->DNL == 'TRUE'|| $trabjasig->EU == 'TRUE' || $trabjasig->DSU =='TRUE' || $trabjasig->DPL =='TRUE'|| $trabjasig->measurement_date != '')
                                                        <input type="NUMBER" class="form-control" name="hp007_calc_dose" id="hp007_calc_dose_readonly" value="{{$trabjasig->Hp007_calc_dose}}" readonly>
                                                    @else
                                                        <input type="NUMBER" step="any" class="form-control" name="hp007_calc_dose" id="hp007_calc_dose" value="{{$trabjasig->Hp007_calc_dose}}">
                                                    @endif
                                                    <label for="floatingInputGrid">Hp007 CALC DOSE:</label>
                                                </div>
                                                <br>
                                                <div class="form-floating">
                                                    @if($trabjasig->nota2 == 'TRUE'|| $trabjasig->DNL == 'TRUE'|| $trabjasig->EU == 'TRUE' || $trabjasig->DSU =='TRUE' || $trabjasig->DPL =='TRUE'|| $trabjasig->measurement_date != '')
                                                        <input type="NUMBER" class="form-control" name="ezclip_calc_dose" id="ezclip_calc_dose_readonly" value="{{$trabjasig->Ezclip_calc_dose}}" readonly>
                                                    @else
                                                        <input type="NUMBER" step="any" class="form-control" name="ezclip_calc_dose" id="ezclip_calc_dose" value="{{$trabjasig->Ezclip_calc_dose}}">
                                                    @endif
                                                    <label for="floatingInputGrid">EzClip CALC DOSE:</label>
                                                </div>
                                                <br>
                                                <div class="form-floating">
                                                    @if($trabjasig->nota2 == 'TRUE'|| $trabjasig->DNL == 'TRUE'|| $trabjasig->EU == 'TRUE' || $trabjasig->DSU =='TRUE' || $trabjasig->DPL =='TRUE'|| $trabjasig->measurement_date != '')
                                                        <input type="date" class="form-control" name="measurement_date"  id="measurement_date_readonly" value="{{$trabjasig->measurement_date}}" readonly>
                                                    @else
                                                        <input type="date" class="form-control @error('measurement_date') is-invalid @enderror" name="measurement_date"  id="measurement_date" value="{{$trabjasig->measurement_date}}">
                                                    @endif
                                                    <label for="floatingInputGrid">MEASUREMENT DATE:</label>
                                                    @error('measurement_date') <span class="invalid-feedback">*{{ $message }}</span> @enderror
                                                </div>
                                            </div>
                                            <div class="col-md mx-4">
                                                
                                                @if($trabjasig->nota2 == 'TRUE'|| $trabjasig->DNL == 'TRUE'|| $trabjasig->EU == 'TRUE' || $trabjasig->DSU =='TRUE' || $trabjasig->DPL =='TRUE'|| $trabjasig->measurement_date != '')
                                                    <div class="form-check">
                                                        @if($trabjasig->nota1 == 'TRUE')
                                                            <input class="form-check-input" type="checkbox" value="TRUE" id="" name="nota1" checked disabled>
                                                        @else
                                                            <input class="form-check-input" type="checkbox" value="TRUE" id="" name="nota1" disabled>
                                                        @endif
                                                        <label class="form-check-label" for="reverseCheck1">1 = Ninguna </label>
                                                    </div>
                                                    <div class="form-check">
                                                        @if($trabjasig->nota2 == 'TRUE')
                                                            <input class="form-check-input" type="checkbox" value="TRUE" id="" name="nota2" checked disabled>
                                                        @else
                                                            <input class="form-check-input" type="checkbox" value="TRUE" id="" name="nota2" disabled>
                                                        @endif
                                                        <label class="form-check-label" for="reverseCheck1">2 = Extraviado</label>
                                                    </div>
                                                    <div class="form-check">
                                                        @if($trabjasig->nota3 == 'TRUE')
                                                            <input class="form-check-input" type="checkbox" value="TRUE" id="" name="nota3" checked disabled>
                                                        @else
                                                            <input class="form-check-input" type="checkbox" value="TRUE" id="" name="nota3" disabled>
                                                        @endif
                                                        <label class="form-check-label" for="reverseCheck1">3 = Supera la dosis permitida</label>
                                                    </div>
                                                    <div class="form-check">
                                                        @if($trabjasig->nota4 == 'TRUE')
                                                            <input class="form-check-input" type="checkbox" value="TRUE" id="" name="nota4" checked disabled>
                                                        @else
                                                            <input class="form-check-input" type="checkbox" value="TRUE" id="" name="nota4" disabled>
                                                        @endif
                                                        <label class="form-check-label" for="reverseCheck1">4 = Dosímetro reprocesado</label>
                                                    </div>
                                                    <div class="form-check">
                                                        @if($trabjasig->nota5 == 'TRUE')
                                                            <input class="form-check-input" type="checkbox" value="TRUE" id="" name="nota5" checked disabled>
                                                        @else
                                                            <input class="form-check-input" type="checkbox" value="TRUE" id="" name="nota5" disabled>
                                                        @endif
                                                        <label class="form-check-label" for="reverseCheck1">5 = Control no utilizado en la evaluación</label> 
                                                    </div>
                                                    <div class="form-check">
                                                        @if($trabjasig->nota6 == 'TRUE')
                                                            <input class="form-check-input" type="checkbox" value="TRUE" id="" name="nota6" checked disabled>
                                                        @else
                                                            <input class="form-check-input" type="checkbox" value="TRUE" id="" name="nota6" disabled>
                                                        @endif
                                                        <label class="form-check-label" for="reverseCheck1">6 = Dosímetro contaminado</label> 
                                                    </div>
                                                    <div class="form-check">
                                                        @if($trabjasig->DNL == 'TRUE')
                                                            <input class="form-check-input" type="checkbox" value="TRUE" id="" name="dnl"  checked disabled>
                                                        @else
                                                            <input class="form-check-input" type="checkbox" value="TRUE" id="" name="dnl"  disabled>
                                                        @endif
                                                        <label class="form-check-label" for="reverseCheck1">DNL = Dosímetro No Legible</label> 
                                                    </div>
                                                    <div class="form-check">
                                                        @if($trabjasig->EU == 'TRUE')
                                                            <input class="form-check-input" type="checkbox" value="TRUE" id="" name="eu" checked disabled>
                                                        @else
                                                            <input class="form-check-input" type="checkbox" value="TRUE" id="" name="eu" disabled>
                                                        @endif
                                                        <label class="form-check-label" for="reverseCheck1"> EU = Dosímetro en Uso </label> 
                                                    </div>
                                                    <div class="form-check">
                                                        @if($trabjasig->DPL == 'TRUE')
                                                            <input class="form-check-input" type="checkbox" value="TRUE" id="" name="dpl" checked disabled>
                                                        @else
                                                            <input class="form-check-input" type="checkbox" value="TRUE" id="" name="dpl" disabled>
                                                        @endif
                                                        <label class="form-check-label" for="reverseCheck1">DPL = Dosímetro en Proceso de Lectura</label> 
                                                    </div>
                                                    <div class="form-check">
                                                        @if($trabjasig->DSU == 'TRUE')
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
                                                        <input class="form-check-input" type="checkbox" value="TRUE" id="nota5checked" name="nota5" checked>
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
                                                @if($trabjasig->measurement_date != '')
                                                <input type="submit" class="btn colorQA mt-2" name="update" id="update" value="GUARDAR" disabled>
                                                @else
                                                <input type="submit" class="btn colorQA mt-2" name="update" id="update" value="GUARDAR">
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
<br>


<script
src="https://code.jquery.com/jquery-3.6.0.js"
integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
crossorigin="anonymous">
</script>
<script type="text/javascript">
    $(document).ready(function(){
        var TDcontrato = document.getElementById("id_contrato");
        var num = parseInt('{{$trabjasig->contratodosimetriasede->dosimetriacontrato->codigo_contrato}}');
        var n = num.toString().padStart(5,'0');
        console.log("ESTE ES EL CODIGO" +n);
        TDcontrato.innerHTML = "CONTRATO No."+n;

        // Creamos array con los meses del año
        const meses = ['ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO', 'JULIO', 'AGOSTO', 'SEPTIEMBRE', 'OCTUBRE', 'NOVIEMBRE', 'DICIEMBRE'];
        let fecha = new Date("{{$trabjasig->contratodosimetriasede->dosimetriacontrato->fecha_inicio}}, 00:00:00");
        console.log(fecha);
        for($i=1; $i<=13; $i++){
            var r = new Date(new Date(fecha).setMonth(fecha.getMonth()+$i));
            var fechaesp = meses[r.getMonth()] + ' DE ' + r.getUTCFullYear();
            console.log(fechaesp); 
            if('{{$trabjasig->mes_asignacion}}' == ($i+1) ){  
            
                document.getElementById('mes{{$trabjasig->mes_asignacion}}').innerHTML = fechaesp;

            } 
        }

        $('#infoLectura a').on('click', function (e) {
            e.preventDefault()
            $(this).tab('show')
        })
    })
    $(document).ready(function(){
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
        })
    })
    $(document).ready(function(){
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
        })
    })
    $(document).ready(function(){
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
        })
    })  
    $(document).ready(function(){
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
        })
    }) 
    $(document).ready(function(){
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
        })
    })
    $(document).ready(function(){
        $('#nota3checked').on('click', function(){
            var nota3checked = $('#nota3checked').prop("checked"); 
            if($.trim(nota3checked) != 'false'){
                $('#nota1checked').prop("checked", false);
            }
        })
        $('#nota4checked').on('click', function(){
            var nota4checked = $('#nota4checked').prop("checked"); 
            if($.trim(nota4checked) != 'false'){
                $('#nota1checked').prop("checked", false);
            }
        })
        $('#nota5checked').on('click', function(){
            var nota5checked = $('#nota5checked').prop("checked"); 
            if($.trim(nota5checked) != 'false'){
                $('#nota1checked').prop("checked", false);
            }
        })
    }) 
    $(document).ready(function(){
        
        if('{{$trabjasig->ubicacion}}' == 'CRISTALINO'){
            $('#hp3_calc_dose').on('change', function(){
                var hp3 = document.getElementById("hp3_calc_dose").value;
                if (hp3 >= 12.5){
                    alert("es CRISTALINO y se paso de la dosis roja"+hp3);
                    let Divhp3 = document.getElementById("hp3_calc_dose");
                    Divhp3.classList.remove("dosisnaranja");
                    Divhp3.classList.add("dosisroja");
                    $('#nota1checked').prop("checked", false);
                    $('#nota3checked').prop("checked", true);
                }else{
                    alert("es CRISTALINO "+hp3);
                    let Divhp3 = document.getElementById("hp3_calc_dose");
                    Divhp3.classList.remove("dosisroja");
                    Divhp3.classList.remove("dosisnaranja");
                    Divhp3.classList.add("form-control:focus");
                    /* $('#nota1checked').prop("checked", true); */
                    $('#nota3checked').prop("checked", false);
                }
            })
        }
        if('{{$trabjasig->ubicacion}}' == 'MUÑECA' || '{{$trabjasig->ubicacion}}' == 'DEDO'){
            $('#hp007_calc_dose').on('change', function(){
                var hp007 = document.getElementById("hp007_calc_dose").value;
                alert("no hay dosimetro de control"+hp007);
                if (hp007 >= 41.6 ){
                    alert("es MUÑECA O DEDO y se paso de la dosis naranja"+hp007);
                    let Divhp007 = document.getElementById("hp007_calc_dose");
                    Divhp007.classList.remove("dosisroja");
                    Divhp007.classList.add("dosisnaranja");
                    $('#nota1checked').prop("checked", false);
                    $('#nota3checked').prop("checked", true);
                } else if(hp007 >= 12){
                    alert("es MUÑECA O DEDO y se paso de la dosis roja"+hp007);
                    let Divhp007 = document.getElementById("hp007_calc_dose");
                    Divhp007.classList.remove("dosisnaranja");
                    Divhp007.classList.add("dosisroja");
                    $('#nota1checked').prop("checked", false);
                    $('#nota3checked').prop("checked", true);
                }else{
                    alert("es MUÑECA O DEDO "+hp007);
                    let Divhp007 = document.getElementById("hp007_calc_dose");
                    Divhp007.classList.remove("dosisroja");
                    Divhp007.classList.remove("dosisnaranja");
                    Divhp007.classList.add("form-control:focus");
                    /* $('#nota1checked').prop("checked", true); */
                    $('#nota3checked').prop("checked", false);
                }
               
            })
        }
        if('{{$trabjasig->ubicacion}}' == 'TORAX' || '{{$trabjasig->ubicacion}}' == 'CASO'){
            $('#hp10_calc_dose').on('change', function(){
                var hp10 = document.getElementById("hp10_calc_dose").value;
                alert("no hay dosimetro de control"+hp10)
                if (hp10 >= 12) {
                    alert("es TORAX y se paso de la dosis roja"+hp10);
                    let Divhp10 = document.getElementById("hp10_calc_dose");
                    Divhp10.classList.remove("dosisnaranja");
                    Divhp10.classList.add("dosisroja");
                    $('#nota1checked').prop("checked", false);
                    $('#nota3checked').prop("checked", true);
                }else if(hp10 >= 1.67){
                    alert("es TORAX y se paso de la dosis naranja"+hp10);
                    let Divhp10 = document.getElementById("hp10_calc_dose");
                    Divhp10.classList.remove("dosisroja");
                    Divhp10.classList.add("dosisnaranja");
                    $('#nota1checked').prop("checked", false);
                    $('#nota3checked').prop("checked", true);
                }else{
                    alert("es TORAX "+hp10);
                    let Divhp10 = document.getElementById("hp10_calc_dose");
                    Divhp10.classList.remove("dosisroja");
                    Divhp10.classList.remove("dosisnaranja");
                    Divhp10.classList.add("form-control:focus");
                    /* $('#nota1checked').prop("checked", true); */
                    $('#nota3checked').prop("checked", false);
                }
            })
        } 
    })
    $(document).ready(function(){
        if('{{$trabjasig->ubicacion}}' == 'TORAX' || '{{$trabjasig->ubicacion}}' == 'CASO'){
            $('#hp10_calc_dose').on('change', function(){
                var hp10 = document.getElementById("hp10_calc_dose").value;
                var hp3 = document.getElementById("hp3_calc_dose").value = hp10;
            })
        }
    }) 
</script>
@endsection