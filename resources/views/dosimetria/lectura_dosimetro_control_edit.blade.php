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
    <div class="col-md-6">
        <h3 class="text-center">EDITAR LA LECTURA DEL DOSÍMETRO TIPO CONTROL </h3>
        <h3 class="text-center">ESPECIALIDAD: {{$dosicontasig->contratodosimetriasededepto->departamentosede->nombre_departamento}}" - CONTRATO No. {{$dosicontasig->contratodosimetriasede->dosimetriacontrato->codigo_contrato}} - MES {{$dosicontasig->mes_asignacion}}</h3>
    </div>
    <div class="col-md"></div>
</div>
<br>

<BR></BR>

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
                                    <input type="text"  class="form-control text-center" name="deptoLectDosimControl" id="deptoLectDosimControl" value="{{$dosicontasig->contratodosimetriasededepto->departamentosede->nombre_departamento}}" readonly>
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
                                                    <div class="form-floating">
                                                        <input type="NUMBER" step="any" class="form-control" name="hp007_calc_dose" id="hp007_calc_dose" value="{{$dosicontasig->Hp007_calc_dose}}">
                                                        <label for="floatingInputGrid">Hp007 CALC DOSE:</label>
                                                    </div>
                                                    <br>
                                                    <div class="form-floating">
                                                        <input type="NUMBER" step="any" class="form-control" name="hp10_calc_dose" id="hp10_calc_dose" value="{{$dosicontasig->Hp10_calc_dose}}">
                                                        <label for="floatingInputGrid">Hp10 CALC DOSE:</label>
                                                    </div>
                                                    <br>
                                                    <div class="form-floating">
                                                        <input type="NUMBER" step="any" class="form-control" name="hp3_calc_dose" id="hp3_calc_dose" value="{{$dosicontasig->Hp3_calc_dose}}">
                                                        <label for="floatingInputGrid">Hp3 CALC DOSE:</label>
                                                    </div>
                                                    <br>
                                                    <div class="form-floating">
                                                        <input type="date" class="form-control" name="measurement_date"  id="measurement_date" value="{{$dosicontasig->measurement_date}}">
                                                        <label for="floatingInputGrid">MEASUREMENT DATE:</label>
                                                    </div>
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
                                                    <a class="btn btn-danger mt-2" type="button" id="cancelar" name="cancelar" href="{{route('asignadosicontrato.info', ['asigdosicont' => $trabjasig->contdosisededepto_id, 'mesnumber' => $trabjasig->mes_asignacion ])}}"  role="button">CANCELAR</a>
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