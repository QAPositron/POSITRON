@extends('layouts.app')
@extends('layouts.plantillabase')
@section('contenido')

    <div class="row">
        <div class="col"></div>
        <div class="col-12">
            <div class="card text-dark bg-light">
                <h2 class="text-center mt-3" id="nueva_empresaModalLabel">CREAR CONTRATO DE DOSIMETRÍA<br> PARA LA EMPRESA <br> {{$empresa->nombre_empresa}}</h2>
            
                <form class="m-4" action="{{route('contratosdosi.save')}}"  method="POST" id="form_contrato_dosi">
                    @csrf
                    
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md">
                                <div class="form-floating my-3" id="codigo_contrato">
                                    <input type="text" name="empresa_contrato" hidden id="empresa_contrato" value="{{$empresa->id_empresa}}">
                                    
                                    <input type="number" name="codigo_contrato" id="codigo_contrato_input" value="" class="form-control @error('codigo_contrato') is-invalid @enderror" readonly>
                                    <label for="floatingInputGrid">CODIGO:</label>
                                    @error('codigo_contrato')
                                        <small class="invalid-feedback">*{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-floating my-3" id="periodo_recambio_contrato">
                                    <select class="form-select @error('periodo_recambio_contrato') is-invalid @enderror" name="periodo_recambio_contrato" id="periodo_recambio_contrato_select"  autofocus>
                                        <option value="">--SELECCIONE--</option>
                                        <option value="MENS">MENSUAL</option>
                                        <option value="SEMS">SEMESTRAL</option>
                                        <option value="BIMS">BIMESTRAL</option>
                                        <option value="TRIMS">TRIMESTRAL</option>
                                    </select>
                                    <label for="floatingInputGrid">PERIODO DE RECAMBIO:</label>
                                    @error('periodo_recambio_contrato')
                                        <small class="invalid-feedback">*{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md">
                                <div class="form-floating my-3" id="fecha_inicio_contrato">
                                    <input type="date" name="fecha_inicio_contrato" id="fecha_inicio_contrato_input" class="form-control @error('fecha_inicio_contrato') is-invalid @enderror" onchange="fechafinalcontrato();" autofocus>
                                    <label for="floatingInputGrid">FECHA DE INICIO:</label>
                                    @error('fecha_inicio_contrato')
                                        <small class="invalid-feedback">*{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-floating my-3" id="fecha_finalizacion_contrato">
                                    <input type="date" name="fecha_finalizacion_contrato" id="fecha_finalizacion_contrato_input" class="form-control @error('fecha_finalizacion_contrato') is-invalid @enderror" autofocus >
                                    <label for="floatingInputGrid" >FECHA DE FINALIZACIÓN</label>
                                    @error('fecha_finalizacion_contrato')
                                        <small class="invalid-feedback">*{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
        
                    </div>
                    <div class="col-md">
                        <hr>
                        <label class="text-center ms-4">ASIGNE A ESTE CONTRATO A UNA O MÁS SEDES :</label>
        
                        <div class="row mt-2">
                            <div class="col-md text-center">
                                <button onclick="readySede()" class="btn btn-sm colorQA" id="agregar">AGREGAR SEDE </button>
                                <button type="button" class="btn btn-sm bg-danger" id="agregar" onclick="deleteElement()">ELIMINAR SEDE </button>
                            </div>
                        </div>
                        <br>
                        <div hidden class="container-fluid" id="clonar">
                            <div class="rounded  m-3 p-3 border border-light active">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-floating my-3">
                                            <select class="form-select @error('id_sede') is-invalid @enderror" id="id_sede">
                                                <option value="">--SELECCIONE--</option>
                                                @foreach($sedes as $sed)
                                                    <option value ="{{$sed->id_sede}}">{{$sed->nombre_sede}}</option>
                                                @endforeach
                                            </select>
                                            <?php
                                            $value = null;
                                            ?>
                                            <label for="floatingSelectGrid">SEDE:</label>
                                            @error('id_sede')
                                                <small class="invalid-feedback">*{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md mt-4">
                                        <button onclick="addDepa()" type="button" class="btn btn-sm colorQA" id="agregarDepto1">AGREGAR ESP.</button>
                                    </div>
                                    <div class="col-md mt-4">
                                        <button type="button" class="btn btn-sm bg-danger" id="agregar1" onclick="deleteDepa()">ELIMINAR ESP.</button>
                                    </div>
                                    <div class="col-md"></div>
                                    <div class="col-md"></div>
                                    <div class="col-md"></div>
                                    <div class="col-md"></div>
                                </div>
                                <div hidden id="clonarDepto">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-floating mt-4">
                                                <select class="form-select"  id="departamento_sede">
                                                    <option value="">--SELECCIONE--</option>
                                                    @foreach($departamentos as $depa)
                                                        <option value ="{{$depa->id_departamentosede}}">{{$depa->nombre_departamento}}</option>
                                                    @endforeach
                                                </select>
                                                <label for="floatingSelectGrid">ESPECIALIDAD:</label>
                                            </div>
                                        </div>
                                        <div class="col-md">
                                            <label for="" class="text-center">No. DOSÍM. TÓRAX</label>
                                            <input type="number" id="num_dosi_torax_contrato_sede"  class="form-control text-center" autofocus >
                                        </div>
                                        <div class="col-md">
                                            <label for="" class="text-center">No. DOSÍM. CRISTALINO</label>
                                            <input type="number"  id="num_dosi_cristalino_contrato_sede"  class="form-control text-center" autofocus>
                                        </div>
                                        <div class="col-md">
                                            <label for="" class="text-center">No. DOSÍM. ANILLO</label>
                                            <input type="number"  id="num_dosi_dedo_contrato_sede" class="form-control text-center" autofocus>
                                        </div>
                                        <div class="col-md">
                                            <label for="" class="text-center">No. DOSÍM. MUÑECA</label>
                                            <input type="number"  id="num_dosi_muneca_contrato_sede"  class="form-control text-center" autofocus>
                                        </div>
                                        <div class="col-md">
                                            <label for="" class="text-center">No. DOSÍM. ÁREA</label>
                                            <input type="number" id="num_dosi_area_contrato_sede"  class="form-control text-center" autofocus >
                                        </div>
                                        <div class="col-md">
                                            <label for="" class="text-center">No. DOSÍM. CASO</label>
                                            <input type="number" id="num_dosi_caso_contrato_sede"  class="form-control text-center" autofocus >
                                        </div>
                                        
                                        <input type="number"  id="primer_mes_asignacion" name="primer_mes_asignacion" class="form-control text-center" value="1" hidden>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md"></div>
                                        <div class="col-md"></div>
                                        <div class="col-md"></div>
                                        <div class="col-md"></div>
                                        <div class="col-md-2 text-center">
                                            <label for="" class="text-center">No. DOSÍM. CONTROL TÓRAX</label>
                                            <input class="form-check-input" type="checkbox" value="TRUE"  id="num_dosi_control_torax_contrato_sede" name="num_dosi_control_torax_contrato_sede">
                                        </div>
                                        <div class="col-md-2 text-center">
                                            <label for="" class="text-center">No. DOSÍM. CONTROL CRISTALINO</label>
                                            <input class="form-check-input" type="checkbox" value="TRUE"  id="num_dosi_control_cristalino_contrato_sede" name="num_dosi_control_cristalino_contrato_sede">

                                        </div>
                                        <div class="col-md-2 text-center">
                                            <label for="" class="text-center">No. DOSÍM. CONTROL ANILLO</label>
                                            <input class="form-check-input" type="checkbox" value="TRUE"  id="num_dosi_control_dedo_contrato_sede" name="num_dosi_control_dedo_contrato_sede">
                                        </div>
                                        <div class="col-md"></div>
                                    </div>
                                    <br>
                                </div>
                                <div class="" id="contenedorDepto0">
        
                                </div>
                            </div>
                        </div>
        
                        <div id="contenedor">
        
                        </div>
                        
                        
                        <div class="row">
                            <div class="col"></div>
                            <div class="col d-grid gap-2">
                                <button class="btn colorQA"  type="submit" id="boton-guardar" name="boton-guardar" >GUARDAR</button>
                            </div>
                            <div class="col d-grid gap-2">
                                <a href="{{route('contratosdosi.createlist', $empresa->id_empresa)}}" class="btn btn-danger " type="button" id="cancelar" name="cancelar" role="button">CANCELAR</a>
                            </div>
                            <div class="col"></div>
                        </div>
                    </div>        
                    
                </form>
            </div>
            <br>
        </div>
        <div class="col"></div>
    </div>


<script
src="https://code.jquery.com/jquery-3.6.0.js"
integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
crossorigin="anonymous">
</script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
    function fechafinalcontrato(){
        var fecha_inicio = new Date(document.getElementById('fecha_inicio_contrato_input').value);
        /* alert(fecha_inicio); */
        var fecha_final_año = fecha_inicio.getFullYear()+1;
        var mm = fecha_inicio.getMonth()+1;
        var fecha_final_mes = (mm < 10 ? '0' : '')+mm;
        var dd = fecha_inicio.getDate();
        var fecha_final_dia = (dd < 10 ? '0' : '')+dd;
        var fecha_final = fecha_final_año+'-'+fecha_final_mes+'-'+fecha_final_dia;
        console.log(fecha_final);
        document.getElementById("fecha_finalizacion_contrato_input").value = fecha_final;
    };

    let sedesNumber = 1;
    let depaNumber = 1;
    let agregar = document.getElementById('agregar');
    let contenido = document.getElementById('contenedor');

    let agregarDepto = document.getElementById('agregarDepto1');
    let contenidoDepto = null;


    /////////// clonar Sede /////////// 
    agregar.addEventListener('click', e =>{
        e.preventDefault();
        let clonado = document.querySelector('#clonar');
        let clon = clonado.cloneNode(true);


        contenido.appendChild(clon).setAttribute("id", `${sedesNumber}`);
        contenido.appendChild(clon).setAttribute("class", `${sedesNumber}`);
        document.getElementById(`${sedesNumber}`).removeAttribute("hidden");
        document.getElementById(`${sedesNumber}`).querySelector('#contenedorDepto0')
            .setAttribute("id", `contenedorDeptoSede${sedesNumber}`);
        document.getElementById(`${sedesNumber}`).querySelector('#id_sede')
            .setAttribute("id", `id_sede${sedesNumber}`);
        document.getElementById(`${sedesNumber}`).querySelector(`#id_sede${sedesNumber}`)
            .setAttribute("name", `id_sede${sedesNumber}[]`);
        console.log(document.getElementById(`${sedesNumber}`).querySelector(`#contenedorDeptoSede${sedesNumber}`))
        contenidoDepto= document.getElementById(`contenedorDeptoSede${sedesNumber}`)
        sedesNumber ++;
    });
    console.log("**");
    console.log(sedesNumber);
    /////////////clonar departamento////////////
    function addDepa() {

        let clonadoDepto = document.querySelector('#clonarDepto');
        let clonDepto = clonadoDepto.cloneNode(true);

        console.log(contenidoDepto);
        contenidoDepto.appendChild(clonDepto).setAttribute("id", `depa${depaNumber}`);
        document.getElementById(`depa${depaNumber}`).removeAttribute("hidden");
        
        document.getElementById(`depa${depaNumber}`).querySelector(`#departamento_sede`)
            .setAttribute("name", `departamentos_sede${sedesNumber-1}[]`);

        document.getElementById(`depa${depaNumber}`).querySelector(`#num_dosi_control_torax_contrato_sede`)
            .setAttribute("name", `dosimetro_control_torax_sede${sedesNumber-1}[]`);

        document.getElementById(`depa${depaNumber}`).querySelector(`#num_dosi_control_cristalino_contrato_sede`)
            .setAttribute("name", `dosimetro_control_cristalino_sede${sedesNumber-1}[]`);

        document.getElementById(`depa${depaNumber}`).querySelector(`#num_dosi_control_dedo_contrato_sede`)
            .setAttribute("name", `dosimetro_control_dedo_sede${sedesNumber-1}[]`);

        document.getElementById(`depa${depaNumber}`).querySelector(`#num_dosi_torax_contrato_sede`)
            .setAttribute("name", `dosimetro_torax_sede${sedesNumber-1}[]`);

        document.getElementById(`depa${depaNumber}`).querySelector(`#num_dosi_area_contrato_sede`)
            .setAttribute("name", `dosimetro_area_sede${sedesNumber-1}[]`);

        document.getElementById(`depa${depaNumber}`).querySelector(`#num_dosi_caso_contrato_sede`)
            .setAttribute("name", `dosimetro_caso_sede${sedesNumber-1}[]`);

        /* document.getElementById(`depa${depaNumber}`).querySelector(`#num_dosi_ezclip_contrato_sede`)
            .setAttribute("name", `dosimetro_ezclip_sede${sedesNumber-1}[]`); */
            
        document.getElementById(`depa${depaNumber}`).querySelector(`#num_dosi_cristalino_contrato_sede`)
            .setAttribute("name", `dosimetro_cristalino_sede${sedesNumber-1}[]`);

        document.getElementById(`depa${depaNumber}`).querySelector(`#num_dosi_muneca_contrato_sede`)
            .setAttribute("name", `dosimetro_muneca_sede${sedesNumber-1}[]`);

        document.getElementById(`depa${depaNumber}`).querySelector(`#num_dosi_dedo_contrato_sede`)
            .setAttribute("name", `dosimetro_dedo_sede${sedesNumber-1}[]`);
        depaNumber++;
        ///////////////
        
    }

    function readySede() {
        $(document).ready(function () {
            $(`#id_sede${sedesNumber-1}`).change(function () {
                //alert('hi')
                let sede_id = $(this).val();

                if ($.trim(sede_id) != '') {
                    $.get('contratodosidepa', {sede_id: sede_id}, function (depas) {
                        console.log('departamentos', depas)
                        $('#departamento_sede').empty();
                        $('#departamento_sede').append("<option value=''> --SELECCIONE-- </option>");
                        $.each(JSON.parse(depas), function (index, value) {
                            $('#departamento_sede').append("<option value='" + value.id_departamentosede + "'>" + value.nombre_departamento + "</option>")
                        })
                    });
                }
            });
        });
    }

    function deleteElement() {
        if (sedesNumber == 1){
        }else {
            sedesNumber--;
            if(sedesNumber >0) {
                parentNode = document.getElementsByClassName('contenedorMoreSedes');
                parentNodeLength = parentNode.length;
                document.getElementById(`${sedesNumber}`).remove();
            }
        }
    }
    function deleteDepa() {
        console.log("hola");
        if(depaNumber ==1 ) {

        }else {
            depaNumber--;
            if(depaNumber>0) {
                document.getElementById(`depa${depaNumber}`).remove();

                //  document.getElementById('clonarDepto').remove();
            }
        }
    }
    $(document).ready(function(){
        $('#id_sede').on('change', function(){
            var sede_id = $(this).val();
            alert(sede_id);
            if($.trim(sede_id) != ''){
                $.get('contratodosidepa', {sede_id : sede_id}, function(depas){
                    console.log(depas);
                });
            }
        });
        
        var num = parseInt('{{empty($codigocontratoant->codigo_contrato) ? 0 : $codigocontratoant->codigo_contrato}}')+1;
        var n = num.toString().padStart(5,'0');
        console.log("ESTE ES EL CODIGO" +n);
        
        document.getElementById("codigo_contrato_input").value = n;
        
        

    })
    $(document).ready(function(){

        $('#form_contrato_dosi').submit(function(e){
            e.preventDefault();
            ///////////////////////VALIDACION PARA EL PERIODO OBLIGATORIO//////////
            var periodo= document.getElementById("periodo_recambio_contrato_select").value;
            console.log("ESTE ES EL PERIODO" + periodo);
            if(periodo == ''){
                return Swal.fire({
                                title:"FALTA SELECCIONAR EL PERIODO DE RECAMBIO",
                                text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN DESEADA",
                                icon: 'error'
                            });
            };
            ///////////////////////VALIDACION PARA LAS FECHAS OBLIGATORIAS//////////
            var fecha_inicio = document.getElementById("fecha_inicio_contrato_input").value;
            console.log("ESTAS SON LAS " + fecha_inicio);
            if(fecha_inicio == ''){
                return Swal.fire({
                                title:"FALTA SELECCIONAR LA FECHA DE INGRESO",
                                text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN DESEADA",
                                icon: 'error'
                            });
            };
            var fecha_finalizacion = document.getElementById("fecha_finalizacion_contrato_input").value;
            console.log("ESTAS SON LAS OBSERVACIONES" + fecha_finalizacion);
            if(fecha_finalizacion == ''){
                return Swal.fire({
                                title:"FALTA SELECCIONAR LA FECHA  DE FINALIZACIÓN",
                                text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN DESEADA",
                                icon: 'error'
                            });
            };
            /////////////////////// VALIDACION PARA LA SEDE OBLIGATORIA///////////////////
            var arraySedes = [];
            for(var i = 0; i < 20; i++){
                var sedes = document.querySelectorAll('select[id="id_sede'+i+'"]');
                if(sedes.length != 0){
                    arraySedes.push(sedes);
                }
            };
            console.log("este es el array");
            console.log(arraySedes);
            console.log(arraySedes.length);

            if(arraySedes.length == '0'){
                return Swal.fire({
                            title:"FALTA AGREGAR O AÑADIR UNA SEDE",
                            text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN DESEADA",
                            icon: 'error'
                        });
            };
            for(var i = 0; i < arraySedes.length; i++){
                var sedes = document.querySelectorAll('select[name="id_sede'+(i+1)+'[]"]');
                console.log(sedes);
                for(var x = 0; x < sedes.length; x++) {
                    var values = sedes[x].value;
                    console.log("ESTOS SON LOS VALORES DE LA SEDES" +values);
                    if(values == ''){
                        return Swal.fire({
                                    title:"FALTA SELECCIONAR ALGUNA SEDE",
                                    text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN DESEADA",
                                    icon: 'error'
                                });
                    }
                }
            }
            /////////////////////////// VALIDACION PARA LAS ESPECIALIDADES OBLIGATORIAS Y PARA LA CANTIDAD DE DOSIMETROS OBLIGATORIOS///////////////////
            for(var i = 0; i < arraySedes.length; i++){
                var departamentoSede = document.querySelectorAll('select[name="departamentos_sede'+(i+1)+'[]"]');
                console.log(departamentoSede);
                console.log("ESTAS SON LOS DEPARTAMENTOS"+ i + "ESTE ES EL TAMAÑO" +departamentoSede.length);
                if(departamentoSede.length >= 2){
                    for(var x = 0; x < departamentoSede.length; x++) {
                        var values = departamentoSede[x].value;
                        console.log("PARA EL VALIR MAYOR A UNO"+values);
                        if(values == ''){
                            return Swal.fire({
                                        title:"FALTA SELECCIONAR ALGUNA ESPECIALIDAD",
                                        text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN DESEADA",
                                        icon: 'error'
                                    });
                        }
                    }
                }else{
                    var values = departamentoSede[0].value;
                    console.log("PARA EL VALIR MENOR A UNO"+values);
                    if(values == ''){
                        return Swal.fire({
                                    title:"FALTA SELECCIONAR ALGUNA ESPECIALIDAD",
                                    text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN DESEADA",
                                    icon: 'error'
                                });
                    }
                };
                var dosimetros_torax = document.querySelectorAll('input[name="dosimetro_torax_sede'+(i+1)+'[]"]');
                console.log(dosimetros_torax);
                console.log("ESTAS SON LOS DOSIMETROS TORAX DE LA SEDE"+ (i+1) + "ESTE ES EL TAMAÑO" +dosimetros_torax.length);
                var dosimetros_cristalino = document.querySelectorAll('input[name="dosimetro_cristalino_sede'+(i+1)+'[]"]');
                console.log(dosimetros_cristalino);
                console.log("ESTAS SON LOS DOSIMETROS CRISTALINO DE LA SEDE"+ (i+1) + "ESTE ES EL TAMAÑO" +dosimetros_cristalino.length);
                var dosimetros_dedo = document.querySelectorAll('input[name="dosimetro_dedo_sede'+(i+1)+'[]"]');
                console.log(dosimetros_dedo);
                console.log("ESTAS SON LOS DOSIMETROS DEDO DE LA SEDE"+ (i+1) + "ESTE ES EL TAMAÑO" +dosimetros_dedo.length);
                var dosimetros_muneca = document.querySelectorAll('input[name="dosimetro_muneca_sede'+(i+1)+'[]"]');
                console.log(dosimetros_muneca);
                console.log("ESTAS SON LOS DOSIMETROS MUÑECA DE LA SEDE"+ (i+1) + "ESTE ES EL TAMAÑO" +dosimetros_muneca.length);
                var dosimetros_control_torax = document.querySelectorAll('input[name="dosimetro_control_torax_sede'+(i+1)+'[]"]');
                console.log(dosimetros_control_torax);
                console.log("ESTAS SON LOS DOSIMETROS CONTROL TORAX DE LA SEDE"+ (i+1) + "ESTE ES EL TAMAÑO" +dosimetros_control_torax.length);
                var dosimetros_area = document.querySelectorAll('input[name="dosimetro_area_sede'+(i+1)+'[]"]');
                console.log(dosimetros_area);
                console.log("ESTAS SON LOS DOSIMETROS AREA DE LA SEDE"+ (i+1) + "ESTE ES EL TAMAÑO" +dosimetros_area.length);
                var dosimetros_caso = document.querySelectorAll('input[name="dosimetro_caso_sede'+(i+1)+'[]"]');
                console.log(dosimetros_caso);
                console.log("ESTAS SON LOS DOSIMETROS CASO DE LA SEDE"+ (i+1) + "ESTE ES EL TAMAÑO" +dosimetros_caso.length);

                if(dosimetros_torax.length >= 2 && dosimetros_cristalino.length >= 2 && dosimetros_dedo.length >= 2 && dosimetros_muneca.length >=2 && dosimetros_control_torax.length >=2 && dosimetros_area.length >=2 && dosimetros_caso.length >=2){
                    for(var x = 0; x < dosimetros_torax.length; x++) {
                        var valuesTorax = dosimetros_torax[x].value;
                        var valuesCristalino = dosimetros_cristalino[x].value;
                        var valuesDedo = dosimetros_dedo[x].value;
                        var valuesMuneca = dosimetros_muneca[x].value;
                        var valuesControlTorax = dosimetros_control_torax[x].value;
                        var valuesArea = dosimetros_area[x].value;
                        var valuesCaso = dosimetros_caso[x].value;

                        console.log("DOSIMETROS TORAX PARA EL VALOR MAYOR A UNO"+valuesTorax);
                        console.log("DOSIMETROS CRISTALINO PARA EL VALOR MAYOR A UNO"+valuesCristalino);
                        console.log("DOSIMETROS DEDO PARA EL VALOR MAYOR A UNO"+valuesDedo);
                        console.log("DOSIMETROS MUÑECA PARA EL VALOR MAYOR A UNO"+valuesMuneca);
                        console.log("DOSIMETROS CONTROL PARA EL VALOR MAYOR A UNO"+valuesControlTorax);
                        console.log("DOSIMETROS AREA PARA EL VALOR MAYOR A UNO"+valuesArea);
                        console.log("DOSIMETROS CASO PARA EL VALOR MAYOR A UNO"+valuesCaso);
                        if(valuesTorax == '' && valuesCristalino == '' && valuesDedo == '' && valuesMuneca == '' && valuesControlTorax == '' && valuesArea == '' && valuesCaso == ''){
                            return Swal.fire({
                                        title:"FALTA INGRESAR LA CANTIDAD DE DOSÍMETROS EN ALGUNA ESPECIALIDAD",
                                        text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN DESEADA",
                                        icon: 'error'
                                    });
                        }
                        
                    }
                }else{
                    var valuesTorax = dosimetros_torax[0].value;
                    console.log("DOSIMETROS TORAX PARA EL VALIR MENOR A UNO"+valuesTorax);
                    var valuesCristalino = dosimetros_cristalino[0].value;
                    console.log("DOSIMETROS CRISTALINO PARA EL VALIR MENOR A UNO"+valuesCristalino);
                    var valuesDedo = dosimetros_dedo[0].value;
                    console.log("DOSIMETROS DEDO PARA EL VALIR MENOR A UNO"+valuesDedo);
                    var valuesMuneca = dosimetros_muneca[0].value;
                    console.log("DOSIMETROS MUNECA PARA EL VALIR MENOR A UNO"+valuesMuneca);
                    var valuesControlTorax = dosimetros_control_torax[0].value;
                    console.log("DOSIMETROS CONTROL PARA EL VALIR MENOR A UNO"+valuesControlTorax);
                    var valuesArea = dosimetros_area[0].value;
                    console.log("DOSIMETROS AREA PARA EL VALIR MENOR A UNO"+valuesArea);
                    var valuesCaso = dosimetros_caso[0].value;
                    console.log("DOSIMETROS CASO PARA EL VALIR MENOR A UNO"+valuesCaso);
                    if(valuesTorax == '' && valuesCristalino == '' && valuesDedo == '' && valuesMuneca == '' && valuesControlTorax == '' && valuesArea == '' && valuesCaso == ''){
                        return Swal.fire({
                                    title:"FALTA INGRESAR LA CANTIDAD DE DOSÍMETROS EN ALGUNA ESPECIALIDAD",
                                    text: "VERIFIQUE LAS CASILLAS Y SELECCIONE LA INFORMACIÓN DESEADA",
                                    icon: 'error'
                                });
                    }
                }
            }
            ////////////////////////////////////////////////////////////////////////////////
            
            Swal.fire({
                text: "SEGURO QUE DESEA GUARDAR ESTE CONTRATO DE DOSIMETRÍA??",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#1A9980',
                cancelButtonColor: '#d33',
                confirmButtonText: 'SI, SEGURO!'
                }).then((result) => {
                if (result.isConfirmed) {
                    var contrato = document.getElementById("codigo_contrato_input").value;
                    var host = window.location.host;
                    var path = "http://"+host+"/POSITRON/public/contratodosimetria/"+contrato+"/pdf";
                    
                    this.submit();
                    window.open(path, '_blank');
                }
            })
        })
    })
</script>
@endsection