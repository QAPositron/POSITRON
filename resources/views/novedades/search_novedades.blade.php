@extends('layouts.plantillabase')
@section('contenido')
<div class="row">
    <div class="col">
        <a href="{{-- {{route('empresas.create')}} --}}" class="btn colorQA ">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg mb-2" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z"/>
            </svg> CREAR NOVEDAD
        </a>
    </div>
    <div class="col"></div>
</div>

{{-- <div class="row pt-3">
    <div class="col-md"></div>
    <div class="col-md">
        <h2 class="text-center">HISTORIAL DE NOVEDADES</h2>
    </div>
    <div class="col-md"></div>
</div>
<br>
<br>
<br> --}}
<div class="row">
    <div class="col md"></div>
    <div class="col-md-6">
        <div class="card text-dark bg-light">
            <br>
            <h2 class="text-center">HISTORIAL DE NOVEDADES</h2>
            <br>
            <div class="row p-4">
                <label > SELECCIONE LA EMPRESA Y EL CONTRATO CORRESPONDIENTE PARA VER SU HISTORIAL DE NOVEDADES: </label>
                <div class="col-md"></div>
                <div class="col-md-5">
                    <br>
                    <div class="form-floating">
                        <select class="form-select" name="empresaDosimetria" id="empresaDosimetria" autofocus style="text-transform:uppercase">
                            <option value="">--SELECCIONE--</option>
                            @foreach($empresasDosi as $empdosi)
                                <option value="{{$empdosi->empresa_id}}">{{$empdosi->nombre_empresa}}</option>
                            @endforeach
                        </select>
                        <label for="floatingInputGrid">EMPRESA:</label>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-floating">
                        <select class="form-select" name="contratos_empresadosi" id="contratos_empresadosi" value="" autofocus style="text-transform:uppercase">
                            <option value="">--SELECCIONE--</option>
                        </select>
                        <label for="floatingInputGrid">CONTRATOS:</label>
                    </div>
                </div>
                <div class="col-md"></div>
            </div>
        </div>
    </div>
    <div class="col-md"></div>
</div>
<br><br>
<div class="row">
    <div class="col-md">
        <div id='infoContrato' style="display: none; position: relative;">
            <div class="row">
                <div class="col-md"></div>
                <div class="col-md-10">
                    <h3 class="text-center" id="tituloEmpresa"></h3>
                    <br>
                    <h4 class="text-center" id="tituloContrato"></h4>
                    <br>
                    <div id="titulosTablas"></div>
                </div>
                <div class="col-md"></div>
            </div>
        </div>
    </div>
</div>



<script
    src="https://code.jquery.com/jquery-3.6.0.js"
    integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
    crossorigin="anonymous">
</script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
    $(document).ready(function(){
        
        $('#empresaDosimetria').on('change', function(){
            var empresa_id = $(this).val();
            console.log(empresa_id);
            if($.trim(empresa_id) != ''){
                $.get('contratosDosim', {empresa_id: empresa_id}, function(contratos){
                    console.log("ESTOS SON LOS CONTRATOS");
                    console.log(contratos);
                    $('#contratos_empresadosi').empty();
                    $('#contratos_empresadosi').append("<option value=''>--SELECCIONE UN CONTRATO--</option>");
                    $.each(contratos, function(index, value){
                        console.log("id_contratodosimetria" +value.id_contratodosimetria);
                        var num = parseInt(value.codigo_contrato);
                        var n = num.toString().padStart(5,'0');
                        console.log("ESTE ES EL CODIGO" +n);
                        $('#contratos_empresadosi').append("<option value='"+ value.id_contratodosimetria + "'>" + n + "</option>");
                    })
                });
            }
        });
        $('#contratos_empresadosi').on('change', function(){
            infoContrato.style.display= "none";
            var contrato_id = $(this).val();
            var check;
            if($.trim(contrato_id) != ''){
                $.get('sedesEspcontDosi', {contrato_id: contrato_id}, function(sedesEsp){
                    console.log("ESTAS SON LAS SEDES Y ESP");
                    console.log(sedesEsp);
                    infoContrato.style.display= "block";
                    $.each(sedesEsp, function(index, value){
                        console.log("ESTE ES EL INDICE" +index);
                        tituloEmpresa.innerHTML = "DOSIMETRÍA DE <i>"+value.nombre_empresa+"</i>";
                        var num = parseInt(value.codigo_contrato);
                        var n = num.toString().padStart(5,'0');
                        tituloContrato.innerHTML = "CONTRATO No."+n;
                        /* let tituloSede = 0; */
                        if(value.nombre_sede != check){
                            
                            $('#titulosTablas').append("<h4 class='text-center' id='tituloSede"+index+"'>"+value.nombre_sede+"</h4>");
                            check = value.nombre_sede;
                            
                            console.log(check);
                            let myTable= "<table class='table  table-bordered'><thead class='table-active text-center'><tr><th class='align-middle' style='width: 10.90%'>ESPECIALIDAD</th>";
                            myTable+= "<th class='align-middle' style='width: 8.90%'>MES ACTUAL</th>";
                            myTable+="<th class='align-middle' style='width: 10.90%'>No. DOSÍM. TÓRAX</th>";
                            myTable+="<th class='align-middle' style='width: 10.90%'>No. DOSÍM. CRISTALINO</th>";
                            myTable+="<th class='align-middle' style='width: 10.90%'>No. DOSÍM. ANILLO</th>";
                            myTable+="<th class='align-middle' style='width: 10.90%'>No. DOSÍM. MUÑECA</th>";
                            myTable+="<th class='align-middle' style='width: 10.90%'>No. DOSÍM. CONTROL</th>";
                            myTable+="<th class='align-middle' style='width: 10.90%'>No. DOSÍM. ÁREA</th>";
                            myTable+="<th class='align-middle' style='width: 10.90%'>No. DOSÍM. CASO</th>";
                            myTable+="<th class='align-middle' style='width: 10.90%'>ACCIONES</th>";
                            myTable+="</tr>";
                            myTable+="<tbody><tr><td class='text-center align-middle'>"+value.nombre_departamento+"</td>";
                            myTable+="<td class='text-center align-middle'>"+value.mes_actual+"</td>";
                            myTable+="<td class='text-center align-middle'>"+value.dosi_torax+"</td>";
                            myTable+="<td class='text-center align-middle'>"+value.dosi_cristalino+"</td>";
                            myTable+="<td class='text-center align-middle'>"+value.dosi_dedo+"</td>";
                            myTable+="<td class='text-center align-middle'>"+value.dosi_muñeca+"</td>";
                            myTable+="<td class='text-center align-middle'>"+value.dosi_control+"</td>";
                            myTable+="<td class='text-center align-middle'>"+value.dosi_area+"</td>";
                            myTable+="<td class='text-center align-middle'>"+value.dosi_caso+"</td>";
                            myTable+="</td>";

                            $('#titulosTablas').append(myTable);

                        } 
                    })
                    /* $('#sedes_empresadosi').empty();
                    $('#sedes_empresadosi').append("<option value=''>--SELECCIONE UNA SEDE DEL CONTRATO--</option>");
                    $.each(sedes, function(index, value){
                        if(check != value){
                            $('#sedes_empresadosi').append("<option value='"+ index + "'>" + value + "</option>");
                            check = value; 
                        }
                    }) */
                });
            }
        })

    })
</script>

@endsection()