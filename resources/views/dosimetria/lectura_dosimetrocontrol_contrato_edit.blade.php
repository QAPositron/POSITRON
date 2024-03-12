@extends('layouts.app')
@extends('layouts.plantillabase')
@section('contenido') 
<div class="row">
    <div class="col-md position-fixed">
        <a type="button" class="btn btn-circle colorQA"  @if($item == 0) href="{{route('asignadosicontrato.info', ['asigdosicont' => $trabjasig->contdosisededepto_id, 'mesnumber' => $trabjasig->mes_asignacion, 'item'=>$item])}}" @else href="{{route('asignadosicontrato.info', ['asigdosicont' =>$trabjasig->novcontdosisededepto_id, 'mesnumber' => $trabjasig->mes_asignacion, 'item'=>$item])}}" @endif>
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
        <h3 class="text-center"><i>{{$trabjasig->contratodosimetriasede->sede->empresa->nombre_empresa}}</i>- SEDE: <i>{{$trabjasig->contratodosimetriasede->sede->nombre_sede}}</i> </h3>
        <h4 class="text-center">ESPECIALIDAD: {{$trabjasig->contratodosimetriasededepto->departamentosede->departamento->nombre_departamento}}</h4>    
    </div>
</div>
<br>
<h4 class="text-center" id="id_contrato"></h4>
<br>
<br>

<br>
<div class="row">
    <div class="col-md"></div>
    <div class="col-md-11">
        <div class="card">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs" id="infoLectura" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" href="#lectura" role="tab" aria-controls="lectura" aria-selected="true">LECTURA</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#infotrabajador" role="tab" aria-controls="infotrabajador" aria-selected="false">INFO TRABAJADOR</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"  href="#infocontrato" role="tab" aria-controls="infocontrato" aria-selected="false">INFO CONTRATO</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content mt-3">
                    <!-- //////////////////// PESTAÑA DE LECTURA//////////////// -->
                    <div class="tab-pane active" id="lectura" role="tabpanel" aria-labelledby="lectura-tab">
                        <br>
                        <h3 class="text-center">
                            EDITAR LECTURA DE DOSÍMETRO DEL PERÍODO {{$trabjasig->mes_asignacion}} <br>
                            (@if($trabjasig->mes_asignacion == 1)
                                @if($trabjasig->contratodosimetriasede->dosimetriacontrato->periodo_recambio == 'MENS')
                                    @php
                                        $meses = ["01"=>'ENERO', "02"=>'FEBRERO', "03"=>'MARZO', "04"=>'ABRIL', "05"=>'MAYO', "06"=>'JUNIO', "07"=>'JULIO', "08"=>'AGOSTO', "09"=>'SEPTIEMBRE', "10"=>'OCTUBRE', "11"=>'NOVIEMBRE', "12"=>'DICIEMBRE'];
                                        $inicio = $trabjasig->contratodosimetriasede->dosimetriacontrato->fecha_inicio;
                                        $fin = date("t-m-Y",strtotime($inicio));
                                        echo date("j", strtotime($inicio))." ".$meses[date("m", strtotime($inicio))]." DE ".date("Y", strtotime($inicio))." - ".date("t", strtotime($fin))." ".$meses[date("m", strtotime($fin))]." DE ".date("Y", strtotime($fin));
                                        /* echo $meses[date("m", strtotime($contdosisededepto->contratodosimetriasede->dosimetriacontrato->fecha_inicio))]." DE ".date("Y", strtotime($contdosisededepto->contratodosimetriasede->dosimetriacontrato->fecha_inicio)) ; */
                                    @endphp
                                @elseif($trabjasig->contratodosimetriasede->dosimetriacontrato->periodo_recambio == 'TRIMS')
                                    @php  
                                        $meses = ["01"=>'ENERO', "02"=>'FEBRERO', "03"=>'MARZO', "04"=>'ABRIL', "05"=>'MAYO', "06"=>'JUNIO', "07"=>'JULIO', "08"=>'AGOSTO', "09"=>'SEPTIEMBRE', "10"=>'OCTUBRE', "11"=>'NOVIEMBRE', "12"=>'DICIEMBRE'];
                                        $inicio = date($trabjasig->contratodosimetriasede->dosimetriacontrato->fecha_inicio);
                                        $fecha1 = date("t-m-Y",strtotime($inicio));
                                        $fecha2= date("t-m-Y",strtotime($fecha1."+ 2 month"));
                                        echo date("j", strtotime($inicio))." ".$meses[date("m", strtotime($inicio))]." DE ".date("Y", strtotime($inicio))." - ".date("j", strtotime($fecha2))." ".$meses[date("m", strtotime($fecha2))]." DE ".date("Y", strtotime($fecha2))
                                    @endphp
                                @elseif($trabjasig->contratodosimetriasede->dosimetriacontrato->periodo_recambio == 'BIMS')
                                    @php  
                                        $meses = ["01"=>'ENERO', "02"=>'FEBRERO', "03"=>'MARZO', "04"=>'ABRIL', "05"=>'MAYO', "06"=>'JUNIO', "07"=>'JULIO', "08"=>'AGOSTO', "09"=>'SEPTIEMBRE', "10"=>'OCTUBRE', "11"=>'NOVIEMBRE', "12"=>'DICIEMBRE'];
                                        $fecha1 = date($trabjasig->contratodosimetriasede->dosimetriacontrato->fecha_inicio);
                                        $fecha2_total = date("t-m-Y",strtotime($fecha1."+ 1 month"));
                                        echo date("j", strtotime($fecha1))." ".$meses[date("m", strtotime($fecha1))]." DE ".date("Y", strtotime($fecha1))." - ".date("j", strtotime($fecha2_total))." ".$meses[date("m", strtotime($fecha2_total))]." DE ".date("Y", strtotime($fecha2_total))
                                    @endphp
                                @endif
                            @else
                                <span id="mes{{$trabjasig->mes_asignacion}}"></span>
                            @endif
                            )
                        </h3>
                        <h4 class="card-title text-center">CÓDIGO DEL DOSÍMETRO: {{$trabjasig->dosimetro->codigo_dosimeter}} - UBICACIÓN: {{$trabjasig->ubicacion}}</h4>
                        <h4 class="card-title text-center">TRABAJADOR: {{$trabjasig->persona->primer_nombre_persona}} {{$trabjasig->persona->segundo_nombre_persona}} {{$trabjasig->persona->primer_apellido_persona}} {{$trabjasig->persona->segundo_apellido_persona}}</h4>
                        <BR></BR>
                        <Label class="mx-5">INGRESE LA INFORMACIÓN DE LA LECTURA DEL DOSÍMETRO ASIGNADO:</Label>
                        <BR></BR>
                        <div class="row">
                            <div class="col"></div>
                            <div class="col-10">
                                <div class="card text-dark bg-light">
                                    
                                    <form class="m-4" action="{{route('lecturadosi.save', ['lecdosi'=>$trabjasig, 'item'=>$item])}}" method="POST">
                                    
                                        @csrf

                                        @method('put')
                                        <input type="NUMBER" id="mes_asignacion" name="mes_asignacion" value="{{$trabjasig->mes_asignacion}}" hidden>
                                        <input type="NUMBER" id="id_contratodosimetriasededepto" name="id_contratodosimetriasededepto" value="{{$trabjasig->contdosisededepto_id}}" hidden>
                                        <input type="NUMBER" id="id_novedadcontratodosimetriasededepto" name="id_novedadcontratodosimetriasededepto" value="{{$trabjasig->novcontdosisededepto_id}}" hidden>
                                        <div class="row g-2">
                                            <div class="col-md-3 mx-4">
                                                @if($trabjasig->ubicacion == 'TORAX' || $trabjasig->ubicacion == 'CASO')
                                                    <div class="form-floating">
                                                        <input type="NUMBER" step="any" class="form-control" name="hp10_calc_dose" id="hp10_calc_dose" value="{{$trabjasig->Hp10_calc_dose}}">
                                                        <label for="floatingInputGrid">Hp10 CALC DOSE:</label>
                                                    </div>
                                                    <br>
                                                    <div class="form-floating">
                                                        <input type="NUMBER" step="any" class="form-control" name="hp007_calc_dose" id="hp007_calc_dose" value="{{$trabjasig->Hp007_calc_dose}}">
                                                        <label for="floatingInputGrid">Hp0.07 CALC DOSE:</label>
                                                    </div>
                                                    <br>
                                                    <div class="form-floating">
                                                        <input type="NUMBER" step="any" class="form-control" name="hp3_calc_dose" id="hp3_calc_dose" value="{{$trabjasig->Hp3_calc_dose}}">
                                                        <label for="floatingInputGrid">Hp3 CALC DOSE:</label>
                                                    </div>
                                                    <br>
                                                    <div class="form-floating">
                                                        <input type="date" class="form-control @error('measurement_date') is-invalid @enderror" name="measurement_date"  id="measurement_date" value="{{$trabjasig->measurement_date}}">
                                                        <label for="floatingInputGrid">MEASUREMENT DATE:</label>
                                                        @error('measurement_date') <span class="invalid-feedback">*{{ $message }}</span> @enderror
                                                    </div>
                                                @elseif($trabjasig->ubicacion == 'CRISTALINO')
                                                    <div class="form-floating">
                                                        <input type="NUMBER" step="any" class="form-control" name="hp3_calc_dose" id="hp3_calc_dose" value="{{$trabjasig->Hp3_calc_dose}}">
                                                        <label for="floatingInputGrid">Hp3 CALC DOSE:</label>
                                                    </div>
                                                    <br>
                                                    <div class="form-floating">
                                                        <input type="date" class="form-control @error('measurement_date') is-invalid @enderror" name="measurement_date"  id="measurement_date" value="{{$trabjasig->measurement_date}}">
                                                        <label for="floatingInputGrid">MEASUREMENT DATE:</label>
                                                        @error('measurement_date') <span class="invalid-feedback">*{{ $message }}</span> @enderror
                                                    </div>
                                                @elseif($trabjasig->ubicacion == 'ANILLO')
                                                    <div class="form-floating">
                                                        <input type="NUMBER" step="any" class="form-control" name="hp007_calc_dose" id="hp007_calc_dose" value="{{$trabjasig->Hp007_calc_dose}}">
                                                        <label for="floatingInputGrid">Hp0.07 CALC DOSE:</label>
                                                    </div>
                                                    <br>
                                                    <div class="form-floating">
                                                        <input type="date" class="form-control @error('measurement_date') is-invalid @enderror" name="measurement_date"  id="measurement_date" value="{{$trabjasig->measurement_date}}">
                                                        <label for="floatingInputGrid">MEASUREMENT DATE:</label>
                                                        @error('measurement_date') <span class="invalid-feedback">*{{ $message }}</span> @enderror
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="col-md mx-4">
                                                <label for="">DOSÍMETRO DE CONTROL {{ $dosicontrolasig->ubicacion}}:</label>
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
                                                    @elseif($dosicontrolasig->ubicacion == 'CRISTALINO')
                                                        <div class="col-md">
                                                            <div class="form-floating">
                                                                <input type="NUMBER" class="form-control" name="hp3_calc_dose_control" id="hp3_calc_dose_control_readonly" value="{{$dosicontrolasig->Hp3_calc_dose}}" readonly>
                                                                <label for="floatingInputGrid">Hp3 CALC DOSE:</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md"></div>
                                                        <div class="col-md"></div>
                                                    @elseif($dosicontrolasig->ubicacion == 'ANILLO')
                                                        <div class="col-md">
                                                            <div class="form-floating">
                                                                <input type="NUMBER" class="form-control" name="hp007_calc_dose_control" id="hp007_calc_dose_control_readonly" value="{{ $dosicontrolasig->Hp007_calc_dose}}" readonly>
                                                                <label for="floatingInputGrid">Hp0.07 CALC DOSE:</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md"></div>
                                                        <div class="col-md"></div>
                                                    @endif
                                                </div>
                                                <br>
                                                <div class="form-check">
                                                    @if($trabjasig->nota1 == 'TRUE')
                                                        <input class="form-check-input" type="checkbox" value="TRUE" id="" name="nota1" checked >
                                                    @else
                                                        <input class="form-check-input" type="checkbox" value="TRUE" id="" name="nota1">
                                                    @endif
                                                    <label class="form-check-label" for="reverseCheck1">1 = Ninguna </label>
                                                </div>
                                                <div class="form-check">
                                                    @if($trabjasig->nota2 == 'TRUE')
                                                        <input class="form-check-input" type="checkbox" value="TRUE" id="" name="nota2" checked>
                                                    @else
                                                        <input class="form-check-input" type="checkbox" value="TRUE" id="" name="nota2">
                                                    @endif
                                                    <label class="form-check-label" for="reverseCheck1">2 = Extraviado</label>
                                                </div>
                                                <div class="form-check">
                                                    @if($trabjasig->nota3 == 'TRUE')
                                                        <input class="form-check-input" type="checkbox" value="TRUE" id="" name="nota3" checked>
                                                    @else
                                                        <input class="form-check-input" type="checkbox" value="TRUE" id="" name="nota3">
                                                    @endif
                                                    <label class="form-check-label" for="reverseCheck1">3 = Supera la dosis permitida</label>
                                                </div>
                                                <div class="form-check">
                                                    @if($trabjasig->nota4 == 'TRUE')
                                                        <input class="form-check-input" type="checkbox" value="TRUE" id="" name="nota4" checked>
                                                    @else
                                                        <input class="form-check-input" type="checkbox" value="TRUE" id="" name="nota4">
                                                    @endif
                                                    <label class="form-check-label" for="reverseCheck1">4 = Dosímetro reprocesado</label>
                                                </div>
                                                <div class="form-check">
                                                    @if($trabjasig->nota5 == 'TRUE')
                                                        <input class="form-check-input" type="checkbox" value="TRUE" id="" name="nota5" checked>
                                                    @else
                                                        <input class="form-check-input" type="checkbox" value="TRUE" id="" name="nota5">
                                                    @endif
                                                    <label class="form-check-label" for="reverseCheck1">5 = Control no utilizado en la evaluación</label> 
                                                </div>
                                                <div class="form-check">
                                                    @if($trabjasig->nota6 == 'TRUE')
                                                        <input class="form-check-input" type="checkbox" value="TRUE" id="" name="nota6" checked>
                                                    @else
                                                        <input class="form-check-input" type="checkbox" value="TRUE" id="" name="nota6">
                                                    @endif
                                                    <label class="form-check-label" for="reverseCheck1">6 = Dosímetro contaminado</label>
                                                </div>
                                                <div class="form-check">
                                                    @if($trabjasig->DNL == 'TRUE')
                                                        <input class="form-check-input" type="checkbox" value="TRUE" id="" name="dnl"  checked>
                                                    @else
                                                        <input class="form-check-input" type="checkbox" value="TRUE" id="" name="dnl" >
                                                    @endif
                                                    <label class="form-check-label" for="reverseCheck1">DNL = Dosímetro No Legible</label> 
                                                </div>
                                                <div class="form-check">
                                                    @if($trabjasig->EU == 'TRUE')
                                                        <input class="form-check-input" type="checkbox" value="TRUE" id="" name="eu" checked>
                                                    @else
                                                        <input class="form-check-input" type="checkbox" value="TRUE" id="" name="eu">
                                                    @endif
                                                    <label class="form-check-label" for="reverseCheck1"> EU = Dosímetro en Uso </label> 
                                                </div>
                                                <div class="form-check">
                                                    @if($trabjasig->DPL == 'TRUE')
                                                        <input class="form-check-input" type="checkbox" value="TRUE" id="" name="dpl" checked>
                                                    @else
                                                        <input class="form-check-input" type="checkbox" value="TRUE" id="" name="dpl">
                                                    @endif
                                                    <label class="form-check-label" for="reverseCheck1">DPL = Dosímetro en Proceso de Lectura</label> 
                                                </div>
                                                <div class="form-check">
                                                    @if($trabjasig->DSU == 'TRUE')
                                                        <input class="form-check-input" type="checkbox" value="TRUE" id="" name="dsu" checked>
                                                    @else
                                                        <input class="form-check-input" type="checkbox" value="TRUE" id="" name="dsu">
                                                    @endif
                                                    <label class="form-check-label" for="reverseCheck1">DSU = Dosímetro sin usar</label> 
                                                </div>
                                            </div>
                                            
                                            
                                        </div>
                                        <br>
                                        
                                        <!-- ----------------BOTON--------------- -->
                                        <div class="row g-2">
                                            <div class="col-md"></div>
                                            <div class="col-md"></div>
                                            <div class="col-md d-grid gap-2">
                                                <input type="submit" class="btn colorQA mt-2" name="update" id="update" value="EDITAR">
                                            </div>
                                            <div class="col-md d-grid gap-2">
                                                <a class="btn btn-danger mt-2" type="button" id="cancelar" name="cancelar" @if($item == 0) href="{{route('asignadosicontrato.info', ['asigdosicont' => $trabjasig->contdosisededepto_id, 'mesnumber' =>$trabjasig->mes_asignacion, 'item'=>$item])}}" @else href="{{route('asignadosicontrato.info', ['asigdosicont' => $trabjasig->novcontdosisededepto_id, 'mesnumber' => $trabjasig->mes_asignacion, 'item'=>$item])}}" @endif  role="button">CANCELAR</a>
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
                    <!-- //////////////////// PESTAÑA DE INFO EMPRESA //////////////// -->
                    <div class="tab-pane" id="infotrabajador" role="tabpanel">
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
                                <input type="text"  class="form-control" name="ocupLectDosim" id="ocupLectDosim" value="{{$trabjasig->contratodosimetriasede->dosimetriacontrato->ocupacion}}" readonly>
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
        var numLec = '{{$trabjasig->contratodosimetriasede->dosimetriacontrato->numlecturas_año}}';
        var ultimoDiaPM = new Date(fecha.getFullYear(), fecha.getMonth() + 1, 1);
        console.log("ULTIMO DIA PRIMER MES:"+ ultimoDiaPM);
        if('{{$trabjasig->contratodosimetriasede->dosimetriacontrato->periodo_recambio}}' == 'MENS'){
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
                    if("{{$trabjasig->mes_asignacion}}" == xx){
                        document.getElementById('mes{{$trabjasig->mes_asignacion}}').innerHTML = fechaesp1+' - '+fechaesp2;
                        
                    }
                }
            }
        }else if('{{$trabjasig->contratodosimetriasede->dosimetriacontrato->periodo_recambio}}' == 'TRIMS'){
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
                for(var x=2; x<=numLec; x++){
                    console.log("ESTA ES LA X="+x);
                    if("{{$trabjasig->mes_asignacion}}" == xx){
                        document.getElementById('mes{{$trabjasig->mes_asignacion}}').innerHTML = fechaesp1+' - '+fechaesp2;
                        
                    }
                }
            }
        }else if('{{$trabjasig->contratodosimetriasede->dosimetriacontrato->periodo_recambio}}' == 'BIMS'){
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
                for(var x=2; x<=numLec; x++){
                    console.log("ESTA ES LA X="+x);
                    if("{{$trabjasig->mes_asignacion}}" == xx){
                        document.getElementById('mes{{$trabjasig->mes_asignacion}}').innerHTML = fechaesp1+' - '+fechaesp2;
                        
                    }
                }
            }
        }
    })
    
    $(document).ready(function(){
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
                var restahp3control = hp3 - '{{$dosicontrolasig->Hp3_calc_dose}}';
                if ( restahp3control >= 12.5){
                   /*  alert("es CRISTALINO y se paso de la dosis roja"+restahp3control);  */
                    let Divhp3 = document.getElementById("hp3_calc_dose");
                    Divhp3.classList.remove("dosisnaranja");
                    Divhp3.classList.add("dosisroja");
                    $('#nota1checked').prop("checked", false);
                    $('#nota3checked').prop("checked", true);
                }else{
                    /* alert("es CRISTALINO "+restahp3control);  */
                    let Divhp3 = document.getElementById("hp3_calc_dose");
                    Divhp3.classList.remove("dosisroja");
                    Divhp3.classList.remove("dosisnaranja");
                    Divhp3.classList.add("form-control:focus");
                    $('#nota1checked').prop("checked", true);
                    $('#nota3checked').prop("checked", false);
                }
                
            })
        }
        if('{{$trabjasig->ubicacion}}' == 'MUÑECA' || '{{$trabjasig->ubicacion}}' == 'ANILLO' || '{{$trabjasig->ubicacion}}' == 'TORAX'){
            $('#hp007_calc_dose').on('change', function(){
                var hp007 = document.getElementById("hp007_calc_dose").value;
                var restahp007control = hp007 - '{{$dosicontrolasig->Hp007_calc_dose}}';
                if (restahp007control >= 41.6 ){
                   /*  alert("es MUÑECA O ANILLO y se paso de la dosis naranja"+restahp007control); */
                    let Divhp007 = document.getElementById("hp007_calc_dose");
                    Divhp007.classList.remove("dosisroja");
                    Divhp007.classList.add("dosisnaranja");
                    $('#nota1checked').prop("checked", false);
                    $('#nota3checked').prop("checked", true);
                } else if(restahp007control >= 12){
                    /* alert("es MUÑECA O ANILLO y se paso de la dosis roja"+restahp007control); */
                    let Divhp007 = document.getElementById("hp007_calc_dose");
                    Divhp007.classList.remove("dosisnaranja");
                    Divhp007.classList.add("dosisroja");
                    $('#nota1checked').prop("checked", false);
                    $('#nota3checked').prop("checked", true);
                } else{
                    /* alert("es MUÑECA O ANILLO "+restahp007control); */
                    let Divhp007 = document.getElementById("hp007_calc_dose");
                    Divhp007.classList.remove("dosisroja");
                    Divhp007.classList.remove("dosisnaranja");
                    Divhp007.classList.add("form-control:focus");
                    $('#nota1checked').prop("checked", true);
                    $('#nota3checked').prop("checked", false);
                }
                
            })
        }
        if('{{$trabjasig->ubicacion}}' == 'TORAX' || '{{$trabjasig->ubicacion}}' == 'CASO'){
            $('#hp10_calc_dose').on('change', function(){
                var hp10 = document.getElementById("hp10_calc_dose").value;
                var restahp10control = hp10 - '{{$dosicontrolasig->Hp10_calc_dose}}';
                if (restahp10control >= 12) {
                    /* alert("es TORAX y se paso de la dosis roja"+hp10); */
                    let Divhp10 = document.getElementById("hp10_calc_dose");
                    Divhp10.classList.remove("dosisnaranja");
                    Divhp10.classList.add("dosisroja");
                    $('#nota1checked').prop("checked", false);
                    $('#nota3checked').prop("checked", true);
                }else if(restahp10control >= 1.67){
                    /* alert("es TORAX y se paso de la dosis naranja"+hp10); */
                    let Divhp10 = document.getElementById("hp10_calc_dose");
                    Divhp10.classList.remove("dosisroja");
                    Divhp10.classList.add("dosisnaranja");
                    $('#nota1checked').prop("checked", false);
                    $('#nota3checked').prop("checked", true);
                }else{
                    /* alert("es TORAX "+hp10); */
                    let Divhp10 = document.getElementById("hp10_calc_dose");
                    Divhp10.classList.remove("dosisroja");
                    Divhp10.classList.remove("dosisnaranja");
                    Divhp10.classList.add("form-control:focus");
                    $('#nota1checked').prop("checked", true);
                    $('#nota3checked').prop("checked", false);
                }
            })
        }; 
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
    });
    $(document).ready(function(){
        $('#hp10_calc_dose').on('keyup', function(){
            var hp10 = document.getElementById("hp10_calc_dose").value;
            var hp3 = document.getElementById("hp3_calc_dose").value = hp10;
        })
    })
</script>
@endsection