@extends('layouts.plantillabase')
@section('contenido')
    <script
        src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous">
    </script>
<div class="row">
    <div class="col"></div>
    <div class="col-7">
        <div class="card text-dark bg-light">
            <h3 class="text-center mt-3">...CONTINUACIÓN DEL CONTRATO CREADO</h3>
            <h3 class="text-center mt-3">PARA LA EMPRESA: {{$dosimetriacontrato->empresa->nombre_empresa}}</h3>
            <form class="m-4" action="" method="POST">
                <Label class="m-3">AGREGUE O ELIMINE LAS SEDES QUE ESTAN SUBCRITAS A ESE CONTRATO, IGUAL CON LOS DEPARTAMENTOS DE CADA SEDE</Label>
                <!-- <h6 class=" m-3">AGREGUE O ELIMINE LAS SEDES QUE ESTAN SUBCRITAS A ESE CONTRATO, IGUAL CON LOS DEPARTAMENTOS DE CADA SEDE</h6> -->
                <div class="row mt-2">
                    <div class="col-md text-center">
                        <button onclick="readySede()"  class="btn btn-sm colorQA" id="agregar">AGREGAR SEDE </button>
                        <button type="button" class="btn btn-sm bg-danger" id="agregar" onclick="deleteElement()">ELIMINAR SEDE </button>
                    </div>
                </div>
                <br>
                <div hidden class="container-fluid" id="clonar">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-floating my-3">
                                <select class="form-select" name="id_sede[]" id="id_sede">
                                    <option value="">--SELECCIONE UNA SEDE--</option>
                                    @foreach($sedes as $sed)
                                        <option value ="{{$sed->id_sede}}">{{$sed->nombre_sede}}</option>
                                    @endforeach
                                </select>
                                <?php
                                $value = null;
                                ?>
                                <label for="floatingSelectGrid">SEDE:</label>
                                @error('id_sede')
                                <small>*{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md mt-4">
                            <button onclick="addDepa()" type="button" class="btn btn-sm colorQA" id="agregarDepto1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                </svg>
                            </button>
                        </div>
                        <div class="col-md mt-4">
                            <button type="button" class="btn btn-sm bg-danger" id="agregar1" onclick="deleteDepa()">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-dash-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                    <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z"/>
                                </svg>
                            </button>
                        </div>
                        <div class="col-md"></div>
                        <div class="col-md"></div>
                        <div class="col-md"></div>
                        <div class="col-md"></div>
                    </div>
                    <div hidden id="clonarDepto">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-floating mt-4">
                                    <select class="form-select" name="departamento_sede[]" id="departamento_sede1">
                                        <option value="">--SELECCIONE--</option>
                                        @foreach($departamentos as $depa)
                                            <option value ="{{$depa->id_departamentosede}}">{{$depa->nombre_departamento}}</option>
                                        @endforeach
                                    </select>
                                    <label for="floatingSelectGrid">DEPARTAMENTO:</label>
                                    @error('id_sede')
                                    <small>*{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md">
                                <label for="" class="text-center">No. DOSÍM. C. ENTERO</label>
                                <input type="number" name="num_dosi_ce[]" id="num_dosi_ce_contrato_sede" class="form-control" autofocus >
                                @error('num_dosi_ce_contrato_sede')
                                <small>*{{$message}}</small>
                                @enderror
                            </div>
                            <div class="col-md">
                                <label for="" class="text-center">No. DOSÍM. AMBIENTAL</label>
                                <input type="number" name="num_dosi_ambiental[]" id="num_dosi_ambiental_contrato_sede" class="form-control" autofocus >
                                @error('num_dosi_ambiental_contrato_sede')
                                <small>*{{$message}}</small>
                                @enderror
                            </div>
                            <div class="col-md">
                                <label for="" class="text-center">No. DOSÍM. CASO</label>
                                <input type="number" name="num_dosi_caso[]" id="num_dosi_caso_contrato_sede" class="form-control" autofocus >
                                @error('num_dosi_caso_contrato_sede')
                                <small>*{{$message}}</small>
                                @enderror
                            </div>
                            <div class="col-md">
                                <label for="" class="text-center">No. DOSÍM. EZCLIP</label>
                                <input type="number" name="num_dosi_ezclip[]" id="num_dosi_ezclip_contrato_sede" class="form-control" autofocus >
                                @error('num_dosi_ezclip_contrato_sede')
                                <small>*{{$message}}</small>
                                @enderror
                            </div>

                        </div>
                    </div>
                    <div hidden id="clonarDepto1">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-floating mt-4">
                                    <select class="form-select" name="departamento_sede[]" id="departamento_sede">
                                        <option value="">--SELECCIONE--</option>
                                        @foreach($departamentos as $depa)
                                            <option value ="{{$depa->id_departamentosede}}">{{$depa->nombre_departamento}}</option>
                                        @endforeach
                                    </select>
                                    <label for="floatingSelectGrid">DEPARTAMENTO:</label>
                                    @error('id_sede')
                                    <small>*{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md">
                                <label for="" class="text-center">No. DOSÍM. C. ENTERO</label>
                                <input type="number" name="num_dosi_ce[]" id="num_dosi_ce_contrato_sede" class="form-control" autofocus >
                                @error('num_dosi_ce_contrato_sede')
                                <small>*{{$message}}</small>
                                @enderror
                            </div>
                            <div class="col-md">
                                <label for="" class="text-center">No. DOSÍM. AMBIENTAL</label>
                                <input type="number" name="num_dosi_ambiental[]" id="num_dosi_ambiental_contrato_sede" class="form-control" autofocus >
                                @error('num_dosi_ambiental_contrato_sede')
                                <small>*{{$message}}</small>
                                @enderror
                            </div>
                            <div class="col-md">
                                <label for="" class="text-center">No. DOSÍM. CASO</label>
                                <input type="number" name="num_dosi_caso[]" id="num_dosi_caso_contrato_sede" class="form-control" autofocus >
                                @error('num_dosi_caso_contrato_sede')
                                <small>*{{$message}}</small>
                                @enderror
                            </div>
                            <div class="col-md">
                                <label for="" class="text-center">No. DOSÍM. EZCLIP</label>
                                <input type="number" name="num_dosi_ezclip[]" id="num_dosi_ezclip_contrato_sede" class="form-control" autofocus >
                                @error('num_dosi_ezclip_contrato_sede')
                                <small>*{{$message}}</small>
                                @enderror
                            </div>

                        </div>
                    </div>
                    <div class="" id="contenedorDepto0">

                    </div>
                </div>

                <div id="contenedor">

                </div>
                <br>
                <div class="card-footer text-end bg-transparent">

                    <button type="submit" class="btn colorQA">GUARDAR</button>
                </div>
            </form>


        </div>
    </div>
    <div class="col"></div>
</div>

<script type="text/javascript">
  /*  function readyFirstSede() {
        $(document).ready(function () {
            console.log('me siento listo')
            $("#id_sede1").on('change', function () {
                var sede_id = $(this).val();
                alert(sede_id);
            })
        })
    }*/

    function changeDepa() {


          //  $('#id_sede1').on('change', function () {
              //  var sede_id = $(this).val();
             //   alert(sede_id);
                /*
                if ($.trim(sede_id) != '') {
                    $.get('contratodosidepa', {sede_id: sede_id}, function (depas) {
                        console.log(depas)
                        $('#departamento_sede1').empty();
                        $('#departamento_sede1').append("<option value=''> --SELECCIONE UN DEPARTAMENTO-- </option>");
                        $.each(depas, function (index, value) {
                            $('#departamento_sede1').append("<option value='" + index + "'>" + value + "</option>")
                        })
                    });
                }
                */

           // })
    }
</script>
<script type="text/javascript">
    let sedesNumber = 1;
    let depaNumber = 1;
    let agregar = document.getElementById('agregar');
    let contenido = document.getElementById('contenedor');

    let agregarDepto = document.getElementById('agregarDepto1');
    let contenidoDepto = null;

    $(document).ready(function () {

        $('#id_sede').on('change', function () {
            console.log('hola cambie de sede')
        });
        $('#id_sede').change(function() {alert('ok');});


       console.log( $('#id_sede').val());
    })
    function readySede() {
        $(document).ready(function () {
            $(`#id_sede${sedesNumber-1}`).change(function () {
                let sede_id = $(this).val();

                if ($.trim(sede_id) != '') {
                    $.get('contratodosidepa', {sede_id: sede_id}, function (depas) {
                        console.log(depas)
                        $('#departamento_sede1').empty();
                        $('#departamento_sede1').append("<option value=''> --SELECCIONE UN DEPARTAMENTO-- </option>");
                        $.each(JSON.parse(depas), function (index, value) {
                            $('#departamento_sede1').append("<option value='" + value.id_departamentosede + "'>" + value.nombre_departamento + "</option>")
                        })
                        $('#departamento_sede').empty();
                        $('#departamento_sede').append("<option value=''> --SELECCIONE UN DEPARTAMENTO-- </option>");
                        $.each(JSON.parse(depas), function (index, value) {
                            $('#departamento_sede').append("<option value='" + value.id_departamentosede + "'>" + value.nombre_departamento + "</option>")
                        })
                    });
                }
            });
          /*  $(`#id_sede1`).change(function () {
                alert('ok');
            });
            $(`#id_sede2`).change(function () {
                alert('ok');
            });
            $(`#id_sede3`).change(function () {
                alert('ok');
            });*/
        });
    }
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
        console.log(document.getElementById(`${sedesNumber}`).querySelector(`#contenedorDeptoSede${sedesNumber}`))
        contenidoDepto= document.getElementById(`contenedorDeptoSede${sedesNumber}`)
        sedesNumber ++;
    })

    /////////////clonar departamento////////////
    function addDepa() {
        let clonadoDepto = document.querySelector('#clonarDepto');
        let clonDepto = clonadoDepto.cloneNode(true);

        console.log(contenidoDepto);
        contenidoDepto.appendChild(clonDepto).setAttribute("id", `depa${depaNumber}`);
        document.getElementById(`depa${depaNumber}`).removeAttribute("hidden");
        depaNumber++;

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
        if(depaNumber ==1 ) {

        }else {
            depaNumber--;
            if(depaNumber>0) {
                document.getElementById(`depa${depaNumber}`).remove();
            }
        }
    }

</script>
@endsection
