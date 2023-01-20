@extends('layouts.plantillabase')
@section('contenido')
<div class="row">
    <div class="col">
        <a href="{{route('novedadesdosimetria.create')}}" class="btn colorQA ">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg mb-2" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z"/>
            </svg> CREAR NOVEDAD
        </a>
    </div>
    <div class="col"></div>
</div>
<br>
<div class="row">
    <div class="col">
        <div class="dropdown">
            <button class="btn colorQA dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
              CREAR NOVEDAD
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
              <li><a class="dropdown-item" href="{{route('novedadesdosimetria.nuevoDosimetro')}}">NUEVO DOSíMETRO</a></li>
              <li><a class="dropdown-item" href="{{route('novedadesdosimetria.retiroDosimetro')}}">RETIRO DE DOSíMETRO</a></li>
              <li><a class="dropdown-item" href="{{route('novedadesdosimetria.cambioTrabajador')}}">CAMBIO DE TRABAJADOR</a></li>
            </ul>
        </div>
    </div>
    <div class="col"></div>
</div>

<div class="row">
    <div class="col md"></div>
    <div class="col-md-6">
        <div class="card text-dark bg-light">
            <br>
            <h2 class="text-center">HISTORIAL DE NOVEDADES</h2>
            <br>
            <label class="px-4"> SELECCIONE LA EMPRESA Y EL CONTRATO CORRESPONDIENTE PARA VER SU HISTORIAL DE NOVEDADES: </label>
            <div class="row p-4">
                <div class="col-md"></div>
                <div class="col-md-5">
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
                    <div id="Tablas"></div>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
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
            var chech;
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
                        if(value.nombre_sede != check){
                            
                            $('#Tablas').append("<h4 class='text-center' id='tituloSede"+index+"'>"+value.nombre_sede+"</h4>");
                            check = value.nombre_sede;
                            
                            console.log("ESTE ES EL CHECK DE SEDE" +check);
                        }
                        if(value.nombre_departamento != chech && value.nombre_sede == check){
                            
                            let myTable= "<table class='table  table-bordered'><thead class='table-active text-center'><tr><th class='align-middle' style='width: 10.90%'>ESPECIALIDAD</th>";
                            myTable+= "<th class='align-middle' style='width: 8.90%'>MES ACTUAL</th>";
                            myTable+="<th class='align-middle' style='width: 10.90%'>No. DOSÍM. TÓRAX</th>";
                            myTable+="<th class='align-middle' style='width: 10.90%'>No. DOSÍM. CRISTALINO</th>";
                            myTable+="<th class='align-middle' style='width: 10.90%'>No. DOSÍM. ANILLO</th>";
                            myTable+="<th class='align-middle' style='width: 10.90%'>No. DOSÍM. MUÑECA</th>";
                            myTable+="<th class='align-middle' style='width: 10.90%'>No. DOSÍM. CONTROL</th>";
                            myTable+="<th class='align-middle' style='width: 10.90%'>No. DOSÍM. ÁREA</th>";
                            myTable+="<th class='align-middle' style='width: 10.90%'>No. DOSÍM. CASO</th>";
                            myTable+="</tr>";
                            myTable+="</thead>";
                            myTable+="<tr><td class='text-center align-middle'>"+value.nombre_departamento+"</td>";
                                chech = value.nombre_departamento;
                            myTable+="<td class='text-center align-middle'>"+value.mes_actual+"</td>";
                            myTable+="<td class='text-center align-middle'>"+value.dosi_torax+"</td>";
                            myTable+="<td class='text-center align-middle'>"+value.dosi_cristalino+"</td>";
                            myTable+="<td class='text-center align-middle'>"+value.dosi_dedo+"</td>";
                            myTable+="<td class='text-center align-middle'>"+value.dosi_muñeca+"</td>";
                            myTable+="<td class='text-center align-middle'>"+value.dosi_control+"</td>";
                            myTable+="<td class='text-center align-middle'>"+value.dosi_area+"</td>";
                            myTable+="<td class='text-center align-middle'>"+value.dosi_caso+"</td>";
                            myTable+="</tr>";
                            myTable+="<tr>";
                            myTable+="<td class='text-center align-middle p-4' colspan='9'>";
                                myTable+="<div id='detalleTabla"+value.id_contdosisededepto+"'></div>";
                            myTable+="</td>";
                            myTable+="</tr>";

                            $('#Tablas').append(myTable);

                            
                        } 
                        $.get('novedadesContDosim', {contrato_id: value.id_contratodosimetria}, function(novedadesCont){
                            console.log("ESTAS SON LAS NOVEDADES");
                            console.log(novedadesCont);
                            var cheq;
                            let Table= "<table class='table table-bordered'><thead class='table-active text-center'><tr><th class='align-middle' colspan='4'>NOVEDADES</th></tr>";
                            Table+="<tr><th class='align-middle' style='width: 12.90%'>MES</th>";
                            Table+="<th class='align-middle' style='width: 12.90%'>FECHA</th>";
                            Table+="<th class='align-middle'>OBSERVACIÓN</th>";
                            Table+="<th class='align-middle' style='width: 12.90%'>ACCIONES</th>";
                            Table+="</tr>";
                            Table+="</thead>";
                            var id = [];
                            $.each(novedadesCont, function(index, value2){
                                var fecha = new Date(value2.created_at);
                                var dia = fecha.getDate();
                                var mes = fecha.getMonth()+1;
                                var año = fecha.getFullYear();
                                id.push(value2.id_novedadmesescontdosi);
                                console.log(id);
                                console.log("ESTA ES EL ID NOVEDAD "+value2.id_novedadmesescontdosi);
                                if(value.id_contdosisededepto == value2.contdosisededepto_id && value2.nota_cambiodosim != cheq){
                                    Table+="<tr><td class='text-center align-middle'>"+value2.mes_asignacion+"</td>";
                                    Table+="<td class='text-center align-middle'>"+dia+"-"+mes+"-"+año+"</td>";    
                                    Table+="<td class='text-center align-middle'>"+value2.nota_cambiodosim+"</td>";
                                    Table+="<td class='text-center align-middle'>";
                                        Table+="<button class='btn btn-primary'  type='button' onclick='detalle("+value2.nota_cambiodosim+")';>";
                                            Table+="<svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' fill='currentColor' class='bi bi-info-lg pb-1' viewBox='0 0 16 16'>";
                                                Table+="<path d='m9.708 6.075-3.024.379-.108.502.595.108c.387.093.464.232.38.619l-.975 4.577c-.255 1.183.14 1.74 1.067 1.74.72 0 1.554-.332 1.933-.789l.116-.549c-.263.232-.65.325-.905.325-.363 0-.494-.255-.402-.704l1.323-6.208Zm.091-2.755a1.32 1.32 0 1 1-2.64 0 1.32 1.32 0 0 1 2.64 0Z'/>";
                                            Table+="</svg";
                                        Table+="</button></td>";
                                        
                                    Table+="</tr>";
                                    cheq = value2.nota_cambiodosim;
                                    $('#detalleTabla'+value.id_contdosisededepto).append(Table);
                                }
                            })
    
                        })
                    })
                    
                });
            }
        })

    })
</script>
<script
    src="https://code.jquery.com/jquery-3.6.0.js"
    integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
    crossorigin="anonymous">
</script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
    function detalle(nota){
        alert(+nota);
    }
</script>


@endsection()