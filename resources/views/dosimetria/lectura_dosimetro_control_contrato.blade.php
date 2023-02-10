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
    <h4 class="text-center" id="id_contrato"></h4>
<br>
<br>
<h3 class="text-center">
    LECTURA DE DOSÍMETRO TIPO CONTROL <br> DEL MES {{$dosicontasig->mes_asignacion}} (
    @if($dosicontasig->mes_asignacion == 1)
        @php
            $meses = ["01"=>'ENERO', "02"=>'FEBRERO', "03"=>'MARZO', "04"=>'ABRIL', "05"=>'MAYO', "06"=>'JUNIO', "07"=>'JULIO', "08"=>'AGOSTO', "09"=>'SEPTIEMBRE', "10"=>'OCTUBRE', "11"=>'NOVIEMBRE', "12"=>'DICIEMBRE'];
            echo $meses[date("m", strtotime($dosicontasig->contratodosimetriasede->dosimetriacontrato->fecha_inicio))]." DE ".date("Y", strtotime($dosicontasig->contratodosimetriasede->dosimetriacontrato->fecha_inicio)) ;
        @endphp
    @else
        <span id="mes{{$dosicontasig->mes_asignacion}}"></span>
    @endif
    )
</h3>
<br>
<div class="row">
        <div class="col"></div>
        <div class="col-11">
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
                            <BR>
                            <Label class="mx-5">LA SIGUIENTE ES INFORMACIÓN DE LA EMPRESA QUE FUE RELACIONA AL DOSÍMETRO DE TIPO CONTROL EN EL PROCESO DE ASIGNACIÓN:</Label>
                            <BR>
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
                                    <label for="floatingInputGrid"> <b>ESPECIALIDAD:</b> </label>
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
                                    <input type="text"  class="form-control" name="ocupLectDosimControl" id="ocupLectDosimControl" value="{{$dosicontasig->ocupacion}}" readonly>
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
                            {{-- <h4 class="card-title text-center pt-3">LECTURA DEL DOSÍMETRO TIPO {{$dosicontasig->dosimetro->tipo_dosimetro}} </h4> --}}
                            <h4 class="card-title text-center pt-5">CÓDIGO DEL DOSÍMETRO: {{$dosicontasig->dosimetro->codigo_dosimeter}}</h4>
                            <BR></BR>
                            <Label class="px-5">INGRESE LA INFORMACIÓN DE LA LECTURA DEL DOSÍMETRO ASIGNADO:</Label>
                            <BR></BR>
                            <div class="row">
                                <div class="col"></div>
                                <div class="col-10">
                                    <div class="card text-dark bg-light">
                                        <form class="m-4" id="form_save_lectura_dosim" name="form_save_lectura_dosim" action="{{route('lecturadosicontrol.save', $dosicontasig)}}" method="POST">
                                            
                                            @csrf

                                            @method('put')

                                            <input type="NUMBER" id="mes_asignacion" name="mes_asignacion" value="{{$dosicontasig->mes_asignacion}}" hidden>
                                            <input type="NUMBER" id="id_contratodosimetriasededepto" name="id_contratodosimetriasededepto" value="{{$dosicontasig->contdosisededepto_id}}" hidden>
                                            <div class="row g-2">
                                                <div class="col-md-4 mx-4">
                                                    
                                                    <div class="form-floating">
                                                        @if($dosicontasig->nota2 == 'TRUE'|| $dosicontasig->DNL == 'TRUE'|| $dosicontasig->EU == 'TRUE' || $dosicontasig->DSU =='TRUE' || $dosicontasig->DPL =='TRUE'|| $dosicontasig->measurement_date != '')
                                                            <input type="NUMBER" step="any" class="form-control" name="hp10_calc_dose" id="hp10_calc_dose_readonly" value="{{$dosicontasig->Hp10_calc_dose}}" readonly>
                                                        @else
                                                            <input type="NUMBER" step="any" class="form-control" name="hp10_calc_dose" id="hp10_calc_dose" value="{{$dosicontasig->Hp10_calc_dose}}">
                                                        @endif
                                                        <label for="floatingInputGrid">Hp10 CALC DOSE:</label>
                                                    </div>
                                                    <br>
                                                    <div class="form-floating">
                                                        @if($dosicontasig->nota2 == 'TRUE'|| $dosicontasig->DNL == 'TRUE'|| $dosicontasig->EU == 'TRUE' || $dosicontasig->DSU =='TRUE' || $dosicontasig->DPL =='TRUE'|| $dosicontasig->measurement_date != '')
                                                            <input type="NUMBER" step="any" class="form-control" name="hp3_calc_dose" id="hp3_calc_dose_readonly" value="{{$dosicontasig->Hp3_calc_dose}}" readonly>
                                                        @else
                                                            <input type="NUMBER" step="any" class="form-control" name="hp3_calc_dose" id="hp3_calc_dose" value="{{$dosicontasig->Hp3_calc_dose}}">
                                                        @endif
                                                        <label for="floatingInputGrid">Hp3 CALC DOSE:</label>
                                                    </div>
                                                    <br>
                                                    <div class="form-floating">
                                                        @if($dosicontasig->nota2 == 'TRUE'|| $dosicontasig->DNL == 'TRUE'|| $dosicontasig->EU == 'TRUE' || $dosicontasig->DSU =='TRUE' || $dosicontasig->DPL =='TRUE' || $dosicontasig->measurement_date != '')
                                                            <input type="NUMBER" step="any" class="form-control" name="hp007_calc_dose" id="hp007_calc_dose_readonly" value="{{$dosicontasig->Hp007_calc_dose}}" readonly>
                                                        @else
                                                            <input type="NUMBER" step="any" class="form-control" name="hp007_calc_dose" id="hp007_calc_dose" value="{{$dosicontasig->Hp007_calc_dose}}">
                                                        @endif
                                                        <label for="floatingInputGrid">Hp0.07 CALC DOSE:</label>
                                                    </div>
                                                    <br>
                                                    <div class="form-floating">
                                                        @if($dosicontasig->nota2 == 'TRUE'|| $dosicontasig->DNL == 'TRUE'|| $dosicontasig->EU == 'TRUE' || $dosicontasig->DSU =='TRUE' || $dosicontasig->DPL =='TRUE'|| $dosicontasig->measurement_date != '')
                                                            <input type="date" step="any" class="form-control" name="measurement_date"  id="measurement_date_readonly" value="{{$dosicontasig->measurement_date}}" readonly>
                                                        @else
                                                            <input type="date" step="any" class="form-control" name="measurement_date"  id="measurement_date" value="{{$dosicontasig->measurement_date}}">
                                                        @endif
                                                        <label for="floatingInputGrid">MEASUREMENT DATE:</label>
                                                    </div>
                                                </div>
                                                <div class="col-md mx-4">
                                                    @if($dosicontasig->nota2 == 'TRUE'|| $dosicontasig->DNL == 'TRUE'|| $dosicontasig->EU == 'TRUE' || $dosicontasig->DSU =='TRUE' || $dosicontasig->DPL =='TRUE'|| $dosicontasig->measurement_date != '')
                                                        <div class="form-check">
                                                            @if($dosicontasig->nota1 == 'TRUE')
                                                                <input class="form-check-input" type="checkbox" value="TRUE" id="" name="nota1" checked disabled>
                                                            @else
                                                                <input class="form-check-input" type="checkbox" value="TRUE" id="" name="nota1" disabled>
                                                            @endif
                                                            <label class="form-check-label" for="reverseCheck1">1 = Ninguna </label>
                                                        </div>
                                                        <div class="form-check">
                                                            @if($dosicontasig->nota2 == 'TRUE')
                                                                <input class="form-check-input" type="checkbox" value="TRUE" id="" name="nota2" checked disabled>
                                                            @else
                                                                <input class="form-check-input" type="checkbox" value="TRUE" id="" name="nota2" disabled>
                                                            @endif
                                                            <label class="form-check-label" for="reverseCheck1">2 = Extraviado</label>
                                                        </div>
                                                        <div class="form-check">
                                                            @if($dosicontasig->nota3 == 'TRUE')
                                                                <input class="form-check-input" type="checkbox" value="TRUE" id="" name="nota3" checked disabled>
                                                            @else
                                                                <input class="form-check-input" type="checkbox" value="TRUE" id="" name="nota3" disabled>
                                                            @endif
                                                            <label class="form-check-label" for="reverseCheck1">3 = Supera la dosis permitida</label>
                                                        </div>
                                                        <div class="form-check">
                                                            @if($dosicontasig->nota4 == 'TRUE')
                                                                <input class="form-check-input" type="checkbox" value="TRUE" id="" name="nota4" checked disabled>
                                                            @else
                                                                <input class="form-check-input" type="checkbox" value="TRUE" id="" name="nota4" disabled>
                                                            @endif
                                                            <label class="form-check-label" for="reverseCheck1">4 = Dosímetro reprocesado</label>
                                                        </div>
                                                        <div class="form-check">
                                                            @if($dosicontasig->nota5 == 'TRUE')
                                                                <input class="form-check-input" type="checkbox" value="TRUE" id="" name="nota5" checked disabled>
                                                            @else
                                                                <input class="form-check-input" type="checkbox" value="TRUE" id="" name="nota5" disabled>
                                                            @endif
                                                            <label class="form-check-label" for="reverseCheck1">5 = Control no utilizado en la evaluación</label> 
                                                        </div>
                                                        <div class="form-check">
                                                            @if($dosicontasig->nota6 == 'TRUE')
                                                                <input class="form-check-input" type="checkbox" value="TRUE" id="" name="nota6" checked disabled>
                                                            @else
                                                                <input class="form-check-input" type="checkbox" value="TRUE" id="" name="nota6" disabled>
                                                            @endif
                                                            <label class="form-check-label" for="reverseCheck1">6 = Dosímetro contaminado</label>
                                                        </div>
                                                        <div class="form-check">
                                                            @if($dosicontasig->DNL == 'TRUE')
                                                                <input class="form-check-input" type="checkbox" value="TRUE" id="" name="dnl"  checked disabled>
                                                            @else
                                                                <input class="form-check-input" type="checkbox" value="TRUE" id="" name="dnl"  disabled>
                                                            @endif
                                                            <label class="form-check-label" for="reverseCheck1">DNL = Dosímetro No Legible</label> 
                                                        </div>
                                                        <div class="form-check">
                                                            @if($dosicontasig->EU == 'TRUE')
                                                                <input class="form-check-input" type="checkbox" value="TRUE" id="" name="eu" checked disabled>
                                                            @else
                                                                <input class="form-check-input" type="checkbox" value="TRUE" id="" name="eu" disabled>
                                                            @endif
                                                            <label class="form-check-label" for="reverseCheck1"> EU = Dosímetro en Uso </label> 
                                                        </div>
                                                        <div class="form-check">
                                                            @if($dosicontasig->DPL == 'TRUE')
                                                                <input class="form-check-input" type="checkbox" value="TRUE" id="" name="dpl" checked disabled>
                                                            @else
                                                                <input class="form-check-input" type="checkbox" value="TRUE" id="" name="dpl" disabled>
                                                            @endif
                                                            <label class="form-check-label" for="reverseCheck1">DPL = Dosímetro en Proceso de Lectura</label> 
                                                        </div>
                                                        <div class="form-check">
                                                            @if($dosicontasig->DSU == 'TRUE')
                                                                <input class="form-check-input" type="checkbox" value="TRUE" id="" name="dsu" checked disabled>
                                                            @else
                                                                <input class="form-check-input" type="checkbox" value="TRUE" id="" name="dsu" disabled>
                                                            @endif
                                                            <label class="form-check-label" for="reverseCheck1">DSU = Dosímetro sin usar</label> 
                                                        </div>
                                                    @else
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" value="TRUE" id="nota1checked" name="nota1" checked>
                                                            <label class="form-check-label" for="reverseCheck1">1 = Ninguna </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" value="TRUE" id="extraviado" name="nota2">
                                                            <label class="form-check-label" for="reverseCheck1">2 = Extraviado</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" value="TRUE" id="" name="nota3">
                                                            <label class="form-check-label" for="reverseCheck1">3 = Supera la dosis permitida</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" value="TRUE" id="" name="nota4">
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
                                                    @if($dosicontasig->nota2 == 'TRUE'|| $dosicontasig->DNL == 'TRUE'|| $dosicontasig->EU == 'TRUE' || $dosicontasig->DSU =='TRUE' || $dosicontasig->DPL =='TRUE'|| $dosicontasig->measurement_date != '')
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
        for($i=0; $i<=13; $i++){
            var r = new Date(new Date(fecha).setMonth(fecha.getMonth()+$i));
            var fechaesp = meses[r.getMonth()] + ' DE ' + r.getUTCFullYear();
            console.log(fechaesp); 
            if('{{$dosicontasig->mes_asignacion}}' == ($i+1) ){  
            
                document.getElementById('mes{{$dosicontasig->mes_asignacion}}').innerHTML = fechaesp;

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
                $('#nota5checked').prop("checked", true);
                document.getElementById('hp007_calc_dose').disabled = true;
                document.getElementById('hp10_calc_dose').disabled = true;
                document.getElementById('measurement_date').disabled = true;
            }else{
                document.getElementById('hp007_calc_dose').disabled = false;
                document.getElementById('hp10_calc_dose').disabled = false;
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
                document.getElementById('measurement_date').disabled = true;
                
            }else{
                document.getElementById('hp007_calc_dose').disabled = false;
                document.getElementById('hp10_calc_dose').disabled = false;
                document.getElementById('measurement_date').disabled = false;
                
            }
        })
    })
    $(document).ready(function(){
        $('#eu_id').on('click', function(){
            var eu_id = $('#eu_id').prop("checked"); 
            
            
            if($.trim(eu_id) != 'false'){
                
                document.getElementById('hp007_calc_dose').disabled = true;
                document.getElementById('hp10_calc_dose').disabled = true;
                document.getElementById('measurement_date').disabled = true;
                
            }else{
                document.getElementById('hp007_calc_dose').disabled = false;
                document.getElementById('hp10_calc_dose').disabled = false;
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
                document.getElementById('measurement_date').disabled = true;
                
            }else{
                document.getElementById('hp007_calc_dose').disabled = false;
                document.getElementById('hp10_calc_dose').disabled = false;
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
                document.getElementById('measurement_date').disabled = true;
                
            }else{
                document.getElementById('hp007_calc_dose').disabled = false;
                document.getElementById('hp10_calc_dose').disabled = false;
                document.getElementById('measurement_date').disabled = false;
                
            }
        })
    })
    $(document).ready(function(){
        $('#hp10_calc_dose').on('change', function(){
            var hp10 = document.getElementById("hp10_calc_dose").value;
            var hp3 = document.getElementById("hp3_calc_dose").value = hp10;
            
        })
    })

</script>

<!-- <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
     $(document).ready(function(){
        $('#form_save_lectura_dosim').submit(function(){
            Swal.fire(
                'LA LUECTUA HA SIDO GUARDADA CON EXITO',
                'That thing is still around?',
                'success'
                )
        })
    }) 
</script> -->
@endsection