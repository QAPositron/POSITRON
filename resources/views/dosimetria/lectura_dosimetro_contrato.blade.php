@extends('layouts.plantillabase')
@section('contenido')

<br>
<h3 class="text-center">LECTURA DE DOSÍMETRO - CONTRATO No. {{$trabjasig->contratodosimetriasede->dosimetriacontrato->codigo_contrato}}</h3>
<BR></BR>
    <div class="row">
        <div class="col"></div>
        <div class="col-11">
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
                                <div class="col"></div>
                                <div class="col">
                                    <label for="floatingInputGrid"> <b>EMPRESA:</b> </label>
                                    <input type="text" class="form-control" name="empresaLectDosim" id="empresaLectDosim" value="{{$trabjasig->contratodosimetriasede->sede->empresa->nombre_empresa}}" readonly>
                                    <br>
                                    <label for="floatingInputGrid"> <b>NOMBRES:</b> </label>
                                    <input type="text"  class="form-control" name="nombrestrabLectDosim" id="nombrestrabLectDosim" value="{{$trabjasig->trabajador->primer_nombre_trabajador}} {{$trabjasig->trabajador->segundo_nombre_trabajador}}" readonly>
                                    <br>
                                    <label for="floatingInputGrid"> <b>CEDULA:</b> </label>
                                    <input type="text" style="width: 130px;" class="form-control" name="cedulatrabLectDosim" id="cedulatrabLectDosim" value="{{$trabjasig->trabajador->cedula_trabajador}}" readonly>
                                </div>
                                <div class="col">
                                    <label for="floatingInputGrid"> <b>NÚM. IDEN.:</b> </label>
                                    <input type="text" style="width: 120px;" class="form-control" name="numIdenEmpresaLectDosim" id="numIdenEmpresaLectDosim" value="{{$trabjasig->contratodosimetriasede->sede->empresa->num_iden_empresa}}" readonly>
                                    <br>
                                    <label for="floatingInputGrid"> <b>APELLIDOS:</b> </label>
                                    <input type="text" class="form-control" name="apellidostrabLectDosim" id="apellidostrabLectDosim" value="{{$trabjasig->trabajador->primer_apellido_trabajador}} {{$trabjasig->trabajador->segundo_apellido_trabajador}}" readonly>
                                    <br>
                                    <label for="floatingInputGrid"> <b>EMAIL:</b> </label>
                                    <input type="text"  class="form-control" name="correotrabLectDosim" id="correotrabLectDosim" value="{{$trabjasig->trabajador->email_trabajador}}" readonly>
                                </div>
                                <div class="col">
                                    <label for="floatingInputGrid"> <b>SEDE:</b> </label>
                                    <input type="text"  class="form-control" name="sedeLectDosim" id="sedeLectDosim" value="{{$trabjasig->contratodosimetriasede->sede->nombre_sede}}" readonly>
                                    <br>
                                    <label for="floatingInputGrid"> <b>GÉNERO:</b> </label>
                                    <input type="text" style="width: 130px;" class="form-control" name="generoLectDosim" id="generoLectDosim" value="{{$trabjasig->trabajador->genero_trabajador}}" readonly>
                                    <br>
                                    <label for="floatingInputGrid"> <b>TELÉFONO:</b> </label>
                                    <input type="text" style="width: 150px;" class="form-control" name="telefonotrabLectDosim" id="telefonotrabLectDosim" value="{{$trabjasig->trabajador->telefono_trabajador}}" readonly>
                                </div>
                                <div class="col"></div>
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
                            <h4 class="card-title text-center pt-3">LECTURA DOSÍMETRO ASIGNADO</h4>
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

                                            <div class="row g-2">
                                                <div class="col-md mx-4">
                                                    <div class="form-floating">
                                                        <input type="text" class="form-control" name="hp007_calc_dose" id="hp007_calc_dose">
                                                        <label for="floatingInputGrid">Hp007 CALC DOSE:</label>
                                                    </div>
                                                </div>
                                                <div class="col-md mx-4">
                                                    <div class="form-floating">
                                                        <input type="text" class="form-control" name="hp007_background_dose" id="hp007_background_dose">
                                                        <label for="floatingInputGrid">Hp007 BACKGROUND DOSE:</label>
                                                    </div>
                                                </div>
                                                <div class="col-md mx-4">
                                                    <div class="form-floating">
                                                        <input type="text" class="form-control" name="hp007_raw_dose" id="hp007_raw_dose">
                                                        <label for="floatingInputGrid">Hp007 RAW DOSE:</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row g-2">
                                                <div class="col-md mx-4">
                                                    <div class="form-floating">
                                                        <input type="text" class="form-control" name="hp10_calc_dose" id="hp10_calc_dose">
                                                        <label for="floatingInputGrid">Hp10 CALC DOSE:</label>
                                                    </div>
                                                </div>
                                                <div class="col-md mx-4">
                                                    <div class="form-floating">
                                                        <input type="text" class="form-control"  name="hp10_background_dose" id="hp10_background_dose">
                                                        <label for="floatingInputGrid">Hp10 BACKGROUND DOSE:</label>
                                                    </div>
                                                </div>
                                                <div class="col-md mx-4">
                                                    <div class="form-floating">
                                                        <input type="text" class="form-control" name="hp10_raw_dose" id="hp10_raw_dose">
                                                        <label for="floatingInputGrid">Hp10 RAW DOSE:</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row g-2">
                                                <div class="col-md mx-4">
                                                    <div class="form-floating">
                                                        <input type="text" class="form-control" name="ezclip_calc_dose" id="ezclip_calc_dose">
                                                        <label for="floatingInputGrid">EzClip CALC DOSE:</label>
                                                    </div>
                                                </div>
                                                <div class="col-md mx-4">
                                                    <div class="form-floating">
                                                        <input type="text" class="form-control" name="ezclip_background_dose" id="ezclip_background_dose">
                                                        <label for="floatingInputGrid">EzClip BACKGROUND DOSE:</label>
                                                    </div>
                                                </div>
                                                <div class="col-md mx-4">
                                                    <div class="form-floating">
                                                        <input type="text" class="form-control" name="ezclip_raw_dose" id="ezclip_raw_dose">
                                                        <label for="floatingInputGrid">EzClip RAW DOSE:</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row g-2">
                                                <div class="col-md mx-4">
                                                    <div class="form-floating">
                                                        <input type="text" class="form-control" name="hp3_calc_dose" id="hp3_calc_dose">
                                                        <label for="floatingInputGrid">Hp3 CALC DOSE:</label>
                                                    </div>
                                                </div>
                                                <div class="col-md mx-4">
                                                    <div class="form-floating">
                                                        <input type="text" class="form-control" name="hp3_background_dose" id="hp3_background_dose">
                                                        <label for="floatingInputGrid">Hp3 BACKGROUND DOSE:</label>
                                                    </div>
                                                </div>
                                                <div class="col-md mx-4">
                                                    <div class="form-floating">
                                                        <input type="text" class="form-control" name="hp3_raw_dose" id="hp3_raw_dose">
                                                        <label for="floatingInputGrid">Hp3 RAW DOSE:</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row g-2">
                                                <div class="col-md mx-4">
                                                    <div class="form-floating">
                                                        <input type="date" class="form-control" name="measurement_date"  id="measurement_date">
                                                        <label for="floatingInputGrid">MEASUREMENT DATE:</label>
                                                    </div>
                                                </div>
                                                <div class="col-md mx-4">
                                                    <div class="form-floating">
                                                        <input type="date" class="form-control" name="zeroLevel_date" id="zeroLevel_date">
                                                        <label for="floatingInputGrid">ZERO LEVEL DATE:</label>
                                                    </div>
                                                </div>
                                                <div class="col-md mx-4">
                                                    <div class="form-floating">
                                                        <input type="text" class="form-control" name="h10_cal_dose" id="h10_cal_dose">
                                                        <label for="floatingInputGrid">H*(10) CALC DOSE:</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row g-2">
                                                <div class="col-4 mx-4 ">
                                                    <div class="form-floating">
                                                        <input type="date" class="form-control" name="verification_Date" id="verification_Date">
                                                        <label for="floatingInputGrid">VERIFICATION DATE:</label>
                                                    </div>
                                                </div>
                                                <div class="col mx-4 ">
                                                    <div class="form-floating">
                                                        <input type="date" class="form-control" name="verification_required_before" id="verification_required_before">
                                                        <label for="floatingInputGrid">VERIFICATION REQUIRED ON OR BEFORE:</label>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            <br>
                                            <div class="row g-2">
                                                <div class="col-5 mx-4">
                                                    <div class="form-floating">
                                                        <input type="numeric" class="form-control" name="remaining_days_available_use" id="remaining_days_available_use">
                                                        <label for="floatingInputGrid">REMAINING DAYS AVAILABLE FOR USE:</label>
                                                    </div>
                                                </div>
                                                <div class="col"></div>
                                                <div class="col"></div>
                                            </div>
                                            <br>
                                            <!-- ----------------BOTON--------------- -->
                                            <div class="row g-2">
                                                <div class="col-md"></div>
                                                <div class="col-md"></div>
                                                <div class="col-md d-grid gap-2">
                                                    <input type="submit" class="btn colorQA mt-2" name="update" id="update" value="GUARDAR">
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
@endsection