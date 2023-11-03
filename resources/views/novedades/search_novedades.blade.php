@extends('layouts.app')
@extends('layouts.plantillabase')
@section('contenido')

<div class="row">
    <div class="col">
        <div class="dropdown">
            <button class="btn colorQA dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
              CREAR NOVEDAD
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
              <li><a class="dropdown-item" href="{{route('novedadesdosimetria.nuevoDosimetro')}}">INGRESO DE DOSíMETRO</a></li>
              <li><a class="dropdown-item" href="{{route('novedadesdosimetria.retiroDosimetro')}}">RETIRO DE DOSíMETRO</a></li>
              <li><a class="dropdown-item" href="{{route('novedadesdosimetria.cambioTrabajador')}}">CAMBIO DE TRABAJADOR</a></li>
            </ul>
        </div>
    </div>
    <div class="col"></div>
</div>
<a type="button" class="btn btn-circle colorQA ir-arriba">
    <svg xmlns="http://www.w3.org/2000/svg" width="27" height="27" fill="currentColor" class="bi bi-arrow-up mt-1" viewBox="0 0 16 16">
        <path fill-rule="evenodd" d="M8 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L7.5 2.707V14.5a.5.5 0 0 0 .5.5z"/>
    </svg>
</a>
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
                    <h2 class="text-center" id="tituloEmpresa"></h2>
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
            $('#tituloEmpresa').html("");
            $('#tituloContrato').html("");
            $('#Tablas').html("");
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
            $('#Tablas').html("");
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
                        tituloEmpresa.innerHTML = "DOSIMETRÍA DE <br><i>"+value.nombre_empresa+"</i>";
                        var num = parseInt(value.codigo_contrato);
                        var n = num.toString().padStart(5,'0');
                        tituloContrato.innerHTML = "CONTRATO No."+n;
                        if(value.nombre_sede != check){
                            
                            $('#Tablas').append("<h4 class='text-center' id='tituloSede"+index+"'>"+value.nombre_sede+"</h4>");
                            check = value.nombre_sede;
                            
                            console.log("ESTE ES EL CHECK DE SEDE" +check);
                        }
                        if(value.id_contdosisededepto != chech && value.nombre_sede == check){
                            
                            let myTable= "<table class='table   table-bordered'><thead class='table-active text-center'><tr><th class='align-middle' colspan='4'>NOVEDADES - ESPECIALIDAD: "+value.nombre_departamento+"</th></tr>";
                            myTable+= "<th class='align-middle' style='width: 8.90%'>PERÍODO</th>";
                            myTable+="<th class='align-middle' style='width: 10.90%'>CODIGO</th>";
                            myTable+="<th class='align-middle'>OBSERVACIÓN</th>";
                            myTable+="<th class='align-middle' style='width: 12.90%'>ACCIONES</th>";
                            myTable+="</tr>";
                            myTable+="</thead>";
                            myTable+="<tbody id='tabla"+value.id_contdosisededepto+"'>";
                            myTable+="</tbody>";
                            
                            chech = value.id_contdosisededepto;
                            
                            $('#Tablas').append(myTable);

                            $.get('novedadesContDosim', {contdosisededepto_id: value.id_contdosisededepto}, function(novedadesCont){
                                console.log("ESTAS SON LAS NOVEDADES");
                                console.log(novedadesCont);
                                var id = [];
                                var cheq;
                                var periodo;
                                if(novedadesCont.length == 0){
                                    console.log("ES VACIO");
                                    var tr = `<tr><td class="text-center align-middle" colspan='4'>"NO HAY NOVEDADES"</td>
                                    </tr>`;
                                    $('#tabla'+value.id_contdosisededepto).append(tr);
                                }else{
                                    $.each(novedadesCont, function(index, value2){
                                        var arrayCambios =[];
                                        
                                        var num = parseInt(value2.codigo_novedad);
                                        var n = num.toString().padStart(5,'0');
                                        console.log("ESTE ES EL CODIGO" +n);
                                        var tr = `<tr><td class="text-center align-middle">`+value2.mes_asignacion+`</td>
                                            <td class="text-center align-middle">`+n+`</td>
                                            <td class=" align-middle" id='obs`+value2.id_novedadmesescontdosi+`'></td>
                                            <td class="text-center align-middle">
                                                <button class="btn btn-primary"  type="button" onclick="detalle('`+value2.id_novedadmesescontdosi+`', `+value2.contdosisededepto_id+`);">
                                                    Detalle
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-right mb-1" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
                                                    </svg>
                                                </button>
                                            </td>
                                        </tr>`;

                                        $('#tabla'+value2.contdosisededepto_id).append(tr);
                                        
                                        $.get('cambiosnovedadesContDosim', {novedad: value2.id_novedadmesescontdosi}, function(cambiosNov){
                                            console.log("cambios novedad");
                                            console.log(cambiosNov);
                                            $.each(cambiosNov, function(index, value3){
                                                console.log(value3.nota_cambiodosim);
                                                var td = value3.nota_cambiodosim+`<br>`;
                                                console.log(td);
                                                $('#obs'+value3.novedadmesescontdosidepto_id).append(td);
                                                /* arrayCambios.push(value3.nota_cambiodosim)
                                                document.getElementById("obs"+value3.novedadmesescontdosidepto_id).innerHTML = value3.nota_cambiodosim; */
                                            })
                                        })
                                    })
                                }
                            })
                        } 
                    })
                    
                });
            }
        });
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
    })
</script>
<script
    src="https://code.jquery.com/jquery-3.6.0.js"
    integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
    crossorigin="anonymous">
</script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
    function detalle(id, deptodosi){
        var host = window.location.host;
        var path = "http://"+host+"/POSITRON/public/novedades/"+id+"/"+deptodosi+"/detalleNovedad";
        
        window.open(path, '_self');
    }
</script>


@endsection()