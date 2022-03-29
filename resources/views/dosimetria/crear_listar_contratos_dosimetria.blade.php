@extends('layouts.plantillabase')
@section('contenido').


<h3 class="text-center ">{{$empresa->nombre_empresa}}</h3>
<div class="row">
    <div class="col"></div>
    <div class="col"></div>
    <div class="col"></div>
    <div class="col">
        <button type="button" class="btn colorQA" data-bs-toggle="modal" data-bs-target="#nueva_empresaModal" >CREAR CONTRATO </button>
        <div class="modal fade" id="nueva_empresaModal" tabindex="-1" aria-labelledby="nueva_empresaModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title w-100 text-center" id="nueva_empresaModalLabel">CREAR CONTRATO PARA LA EMPRESA:{{$empresa->nombre_empresa}}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    @livewire('form-contrato-dosimetria', ['empresa' =>$empresa, 'sedes' =>$sedes, 'departamentos' =>$departamentos])
                   
                    
                </div>
            </div>
        </div>
    </div>
</div>
<BR></BR>
<div class="row">
    <div class="col"></div>
    <div class="col-9">
        <h4 class="text-center">LISTADO DE CONTRATOS</h4>
        <div class="table table-responsive p-4 ">
            <table class="table table-bordered">
                <thead class ="text-center">
                    <tr>
                        <th>No. CONTRATO</th>
                        <th style='width: 15.60%'>FECHA INICIO</th>
                        <th style='width: 15.60%'>FECHA FINALIZACIÓN</th>
                        <th>P. RECAMBIO</th>
                        <th>ACCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($dosimetriacontrato as $dosicont)
                        <tr>
                            <td><a class="link-dark" href="{{route('detallecontrato.create', $dosicont->id_contratodosimetria)}}">{{$dosicont->codigo_contrato}}</a></td>
                            <td>{{$dosicont->fecha_inicio}}</td>
                            <td>{{$dosicont->fecha_finalizacion}}</td>
                            <td>{{$dosicont->periodo_recambio}}</td>
                            <td>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="col"></div>
</div>
<script
src="https://code.jquery.com/jquery-3.6.0.js"
integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
crossorigin="anonymous">
</script>


<script type="text/javascript">
    function fechafinalcontrato(){
        var fecha_inicio = new Date(document.getElementById('fecha_inicio_contrato').value);
        alert(fecha_inicio);
        var fecha_final_año = fecha_inicio.getFullYear()+1;
        var mm = fecha_inicio.getMonth()+1;
        var fecha_final_mes = (mm < 10 ? '0' : '')+mm;
        var dd = fecha_inicio.getDate();
        var fecha_final_dia = (dd < 10 ? '0' : '')+dd;
        var fecha_final = fecha_final_año+'-'+fecha_final_mes+'-'+fecha_final_dia;
        console.log(fecha_final);
        document.getElementById("fecha_finalizacion_contrato").value = fecha_final;
    }



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
    })

    /////////////clonar departamento////////////
    function addDepa() {

        let clonadoDepto = document.querySelector('#clonarDepto');
        let clonDepto = clonadoDepto.cloneNode(true);

        console.log(contenidoDepto);
        contenidoDepto.appendChild(clonDepto).setAttribute("id", `depa${depaNumber}`);
        document.getElementById(`depa${depaNumber}`).removeAttribute("hidden");

        document.getElementById(`depa${depaNumber}`).querySelector(`#departamento_sede`)
            .setAttribute("name", `departamentos_sede${sedesNumber-1}[]`);

        document.getElementById(`depa${depaNumber}`).querySelector(`#num_dosi_ce_contrato_sede`)
            .setAttribute("name", `dosimetro_cuerpoEntero_sede${sedesNumber-1}[]`);

        document.getElementById(`depa${depaNumber}`).querySelector(`#num_dosi_ambiental_contrato_sede`)
            .setAttribute("name", `dosimetro_ambiental_sede${sedesNumber-1}[]`);

        document.getElementById(`depa${depaNumber}`).querySelector(`#num_dosi_caso_contrato_sede`)
            .setAttribute("name", `dosimetro_caso_sede${sedesNumber-1}[]`);

        document.getElementById(`depa${depaNumber}`).querySelector(`#num_dosi_ezclip_contrato_sede`)
            .setAttribute("name", `dosimetro_ezclip_sede${sedesNumber-1}[]`);

        depaNumber++;
        ///////////////
        /*


        num_dosi_ce_contrato_sede" class="form-control" autofocus >
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
            <input type="number" name="num_dosi_caso[]" id="num_dosi_caso_contrato_sede"
*/
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
                        $('#departamento_sede').append("<option value=''> --SELECCIONE UN DEPARTAMENTO-- </option>");
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
        console.log("hola")
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
        })
    })


    $(document).ready(function(){
        $('#codigo_contrato').on('change', function(){
            var codigo = $(this).val();
            alert(codigo);
        })
    })

</script>



@endsection
