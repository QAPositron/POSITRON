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
              <li><a class="dropdown-item" href="{{route('novedadesdosimetria.cambioTrabajador')}}">CAMBIO DE TRABAJADOR/ÁREA</a></li>
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
                    <div class="form-group">
                        <label for="floatingInputGrid">EMPRESA:</label>
                        <select class="form-select" name="empresaDosimetria" id="empresaDosimetria" autofocus style="text-transform:uppercase">
                            <option value="">--SELECCIONE--</option>
                            @foreach($empresasDosi as $empdosi)
                                <option value="{{$empdosi->empresa_id}}">{{$empdosi->nombre_empresa}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="floatingInputGrid">CONTRATOS:</label>
                        <select class="form-select" name="contratos_empresadosi" id="contratos_empresadosi" value="" autofocus style="text-transform:uppercase">
                            <option value="">--SELECCIONE--</option>
                        </select>
                    </div>
                </div>
                
                <div class="col-md"></div>
            </div>
        </div>
    </div>
    <div class="col-md text-center">
        <a type="button" class="btn btn-circle colorQA mt-5">
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-file-earmark-pdf pt-1" viewBox="0 0 16 16" target="_blank" onclick="alertreporte();">
                <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z"/>
                <path d="M4.603 14.087a.81.81 0 0 1-.438-.42c-.195-.388-.13-.776.08-1.102.198-.307.526-.568.897-.787a7.68 7.68 0 0 1 1.482-.645 19.697 19.697 0 0 0 1.062-2.227 7.269 7.269 0 0 1-.43-1.295c-.086-.4-.119-.796-.046-1.136.075-.354.274-.672.65-.823.192-.077.4-.12.602-.077a.7.7 0 0 1 .477.365c.088.164.12.356.127.538.007.188-.012.396-.047.614-.084.51-.27 1.134-.52 1.794a10.954 10.954 0 0 0 .98 1.686 5.753 5.753 0 0 1 1.334.05c.364.066.734.195.96.465.12.144.193.32.2.518.007.192-.047.382-.138.563a1.04 1.04 0 0 1-.354.416.856.856 0 0 1-.51.138c-.331-.014-.654-.196-.933-.417a5.712 5.712 0 0 1-.911-.95 11.651 11.651 0 0 0-1.997.406 11.307 11.307 0 0 1-1.02 1.51c-.292.35-.609.656-.927.787a.793.793 0 0 1-.58.029zm1.379-1.901c-.166.076-.32.156-.459.238-.328.194-.541.383-.647.547-.094.145-.096.25-.04.361.01.022.02.036.026.044a.266.266 0 0 0 .035-.012c.137-.056.355-.235.635-.572a8.18 8.18 0 0 0 .45-.606zm1.64-1.33a12.71 12.71 0 0 1 1.01-.193 11.744 11.744 0 0 1-.51-.858 20.801 20.801 0 0 1-.5 1.05zm2.446.45c.15.163.296.3.435.41.24.19.407.253.498.256a.107.107 0 0 0 .07-.015.307.307 0 0 0 .094-.125.436.436 0 0 0 .059-.2.095.095 0 0 0-.026-.063c-.052-.062-.2-.152-.518-.209a3.876 3.876 0 0 0-.612-.053zM8.078 7.8a6.7 6.7 0 0 0 .2-.828c.031-.188.043-.343.038-.465a.613.613 0 0 0-.032-.198.517.517 0 0 0-.145.04c-.087.035-.158.106-.196.283-.04.192-.03.469.046.822.024.111.054.227.09.346z"/>
            </svg>
        </a>
        <br>
        REPORTE
    </div>
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
        $(document).on('select2:open', () => {
            document.querySelector('.select2-search__field').focus();
        });
        $('#empresaDosimetria').select2({width: "100%", theme: "classic"});
        $('#contratos_empresadosi').select2({width: "100%", theme: "classic"});
        
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
            var temp1;
            var temp2;
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
                            
                            let myTable= "<table class='table   table-bordered'><thead class='table-active text-center'><tr><th class='align-middle' colspan='5'>NOVEDADES - ESPECIALIDAD: "+value.nombre_departamento+"</th></tr>";
                            myTable+= "<th class='align-middle'>PERÍODO</th>";
                            myTable+="<th class='align-middle' style='width: 10.90%'>CODIGO</th>";
                            myTable+="<th class='align-middle'>OBSERVACIÓN</th>";
                            myTable+="<th class='align-middle' style='width: 12.90%'>ACCIONES</th>";
                            myTable+="<th class='align-middle' style='width: 8.90%'>SELECCIONE</th>";
                            myTable+="</tr>";
                            myTable+="</thead>";
                            myTable+="<tbody id='tabla"+value.id_contdosisededepto+"'>";
                            myTable+="</tbody>";
                            
                            chech = value.id_contdosisededepto;
                            
                            $('#Tablas').append(myTable);
                            

                            $.get('novedadesContDosim', {contratodosimetria: contrato_id, contdosisededepto: value.id_contdosisededepto}, function(novedadesCont){
                                console.log("ESTAS SON LAS NOVEDADES DE ESE CONTRATO SEGUN EL DEPARTAMENTO");
                                console.log(novedadesCont);
                                var id = [];
                                var periodo;
                                var fecha_inicio;
                                var fecha_final;
                                if(novedadesCont.length == 0){
                                    console.log("ES VACIO");
                                    var tr = `<tr><td class="text-center align-middle" colspan='5'>"NO HAY NOVEDADES"</td>
                                    </tr>`;
                                    $('#tabla'+value.id_contdosisededepto).append(tr);
                                }else{
                                    $.each(novedadesCont, function(index, value2){
                                        var periodo;
                                        ///obtener la fecha del periodo en que se hizo la novedad/////
                                        const meses = ['ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO', 'JULIO', 'AGOSTO', 'SEPTIEMBRE', 'OCTUBRE', 'NOVIEMBRE', 'DICIEMBRE'];
                                        let fecha = new Date(value2.fecha_inicio);
                                        var fechaF = new Date(fecha.setMinutes(fecha.getMinutes() + fecha.getTimezoneOffset()));
                                        console.log("ESTA ES LA FECHA DE INICIO=");
                                        console.log(fechaF);
                                        var numLec = value2.numlecturas_año;
                                        
                                        if(value2.periodo_recambio == 'MENS'){
                                            var xx = 1; 
                                            for(var i=0; i<=(numLec-2); i++){
                                                var ultimoDiaPM = new Date(fecha.getFullYear(), fecha.getMonth() + 1, 1);
                                                console.log("ULTIMO DIA PRIMER MES:"+ ultimoDiaPM);
                                                var ultimoDiaPMF = new Date(ultimoDiaPM);
                                                ultimoDiaPMF.setDate(ultimoDiaPMF.getDate()-1);
                                                console.log(ultimoDiaPMF);
                                                console.log("esta es la i="+i);
                                                var r = new Date(new Date(ultimoDiaPM).setMonth(ultimoDiaPM.getMonth()+i));
                                                console.log("r1" +r);
                                                var r2 = new Date(new Date(r).setMonth(r.getMonth()+1));
                                                var fechaesp = meses[r.getMonth()] + ' DE ' + r.getUTCFullYear();
                                                var r2final = new Date(new Date(r2).setDate(r.getDate()-1));
                                                console.log("r2 " +r2final);
                                                var fechaesp1 = r.getDate()+' '+meses[r.getMonth()] + ' DE ' + r.getUTCFullYear();
                                                console.log(fechaesp1);
                                                var fechaesp2 = (r2final.getDate()) +' '+ meses[r2final.getMonth()] + ' DE ' + r2final.getUTCFullYear(); 
                                                console.log(fechaesp2);
                                                xx++;
                                                console.log("XX ="+xx);
                                                if(value2.mes_asignacion == 1){
                                                    console.log("entro al mes 1 = ");
                                                    periodo = value2.mes_asignacion+" - "+fechaF.getDate()+' '+meses[fechaF.getMonth()] + ' DE ' + fechaF.getUTCFullYear()+" al <br>"+ultimoDiaPMF.getDate()+' '+meses[ultimoDiaPMF.getMonth()] + ' DE ' + ultimoDiaPMF.getUTCFullYear();
                                                }else if(value2.mes_asignacion == xx){
                                                    console.log("entro al mes xx = ");
                                                    document.getElementById('periodo')
                                                    periodo = value2.mes_asignacion+" - "+fechaesp1+" al <br>"+fechaesp2;
                                                    console.log("periodo = "+periodo);
                                                }
                                                
                                            }
                                        }else if(value2.periodo_recambio == 'TRIMS'){
                                            var xx = 1;
                                            for(var i=0; i<=numLec; i= i+3){
                                                var ultimoDiaPM = new Date(fechaF.getFullYear(), fechaF.getMonth() + 3, 1);
                                                console.log("ULTIMO DIA PRIMER MES:"+ ultimoDiaPM);
                                                var ultimoDiaPMF = new Date(ultimoDiaPM);
                                                ultimoDiaPMF.setDate(ultimoDiaPMF.getDate()-1);
                                                console.log(ultimoDiaPMF);
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
                                                console.log("XX ="+xx);
                                                if(value2.mes_asignacion == 1){
                                                    console.log("entro al mes 1 = ");
                                                    periodo = value2.mes_asignacion+" - "+fechaF.getDate()+' '+meses[fechaF.getMonth()] + ' DE ' + fechaF.getUTCFullYear()+" al <br>"+ultimoDiaPMF.getDate()+' '+meses[ultimoDiaPMF.getMonth()] + ' DE ' + ultimoDiaPMF.getUTCFullYear();
                                                }else if(value2.mes_asignacion == xx){
                                                    console.log("entro al mes xx = ");
                                                    document.getElementById('periodo')
                                                    periodo = value2.mes_asignacion+" - "+fechaesp1+" al <br>"+fechaesp2;
                                                    console.log("periodo = "+periodo);
                                                }
                                            }
                                        }else if(value2.periodo_recambio == 'BIMS'){
                                            var xx = 1;
                                            for(var i=0; i<=(numLec+2); i= i+2){
                                                var ultimoDiaPM = new Date(fecha.getFullYear(), fecha.getMonth() + 2, 1);
                                                console.log("ULTIMO DIA PRIMER MES:"+ ultimoDiaPM);
                                                var ultimoDiaPMF = new Date(ultimoDiaPM);
                                                ultimoDiaPMF.setDate(ultimoDiaPMF.getDate()-1);
                                                console.log(ultimoDiaPMF);
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
                                                if(value2.mes_asignacion == 1){
                                                    console.log("entro al mes 1 = ");
                                                    periodo = value2.mes_asignacion+" - "+fechaF.getDate()+' '+meses[fechaF.getMonth()] + ' DE ' + fechaF.getUTCFullYear()+" al <br>"+ultimoDiaPMF.getDate()+' '+meses[ultimoDiaPMF.getMonth()] + ' DE ' + ultimoDiaPMF.getUTCFullYear();
                                                }else if(value2.mes_asignacion == xx){
                                                    console.log("entro al mes xx = ");
                                                    document.getElementById('periodo')
                                                    periodo = value2.mes_asignacion+" - "+fechaesp1+" al <br>"+fechaesp2;
                                                    console.log("periodo = "+periodo);
                                                }
                                            } 
                                        }
                                        var num = parseInt(value2.codigo_novedad);
                                        var n = num.toString().padStart(5,'0');
                                        console.log("ESTE ES EL CODIGO" +n);
                                        console.log("novedad_id="+value2.id_novedad);
                                        var tr = `<tr><td class="text-center align-middle" id ="periodo`+value2.mes_asignacion+`" style='width: 20%'>`+periodo+`</td>
                                                <td class="text-center align-middle">`+n+`</td>
                                                <td class=" align-middle" id='obs`+value2.id_novedadmesescontdosi+`'></td>
                                                <td class="text-center align-middle" style='width: 5%'" id='detalle`+value2.id_novedadmesescontdosi+`'></td>
                                                <td class="text-center align-middle justify-content-center>
                                                    <div class="form-check">
                                                        <input class="form-check-input text-center align-middle" type="checkbox" value="TRUE" id="`+value2.id_novedad+`" name="checkbox">
                                                    </div>     
                                                </td>
                                            </tr>`;
                                        $('#tabla'+value2.contdosisededepto_id).append(tr);
                                        
                                        $.get('cambiosnovedadesContDosim', {novedadmesescontdosi: value2.id_novedadmesescontdosi}, function(cambiosNov){
                                            console.log("cambios novedad");
                                            console.log(cambiosNov);
                                            $.each(cambiosNov, function(index, value3){
                                                console.log(value3.nota_cambiodosim);
                                                var td ='- '+value3.nota_cambiodosim+'.'+`<br>`;
                                                console.log(td);
                                                $('#obs'+value3.novedadmesescontdosidepto_id).append(td);
                                                var buttonDetalle = ` <button class="btn btn-primary"  type="button" onclick="detalle('`+value3.id_cambionovedadmeses+`', 0);">
                                                        Detalle
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-right mb-1" viewBox="0 0 16 16">
                                                        <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
                                                        </svg>
                                                    </button>`;
                                                $('#detalle'+value3.novedadmesescontdosidepto_id).append(buttonDetalle);
                                            })
                                        });
                                    });
                                }
                            })
                        } 
                    })
                    
                });
                $.get('sedesNovEspcontDosi', {contrato: contrato_id}, function(sedesNovEsp){
                    console.log("ESTAS SON LAS SEDES Y SUB ESPECIALIDADES");
                    console.log(sedesNovEsp);
                    infoContrato.style.display= "block";
                    $.each(sedesNovEsp, function(index, valor){
                        if(valor.nombre_sede != temp1){
                            $('#Tablas').append("<h4 class='text-center' id='tituloSede"+index+"'>"+valor.nombre_sede+"</h4>");
                            temp1 = valor.nombre_sede;
                            console.log("ESTE ES EL CHECK DE SEDE" +temp1);
                        }
                        if(valor.id_contdosisededepto != temp2 && valor.nombre_sede == temp1){
                            
                            let myTable= "<table class='table   table-bordered'><thead class='table-active text-center'><tr><th class='align-middle' colspan='5'>NOVEDADES - SUB-ESPECIALIDAD: "+valor.nombre_departamento+"</th></tr>";
                            myTable+= "<th class='align-middle'>PERÍODO</th>";
                            myTable+="<th class='align-middle' style='width: 10.90%'>CODIGO</th>";
                            myTable+="<th class='align-middle'>OBSERVACIÓN</th>";
                            myTable+="<th class='align-middle' style='width: 12.90%'>ACCIONES</th>";
                            myTable+="<th class='align-middle' style='width: 8.90%'>SELECCIONE</th>";
                            myTable+="</tr>";
                            myTable+="</thead>";
                            myTable+="<tbody id='tablasubesp"+valor.id_novcontdosisededepto+"'>";
                            myTable+="</tbody>";
                            
                            temp2 = valor.id_contdosisededepto;
                            
                            $('#Tablas').append(myTable);

                            $.get('novedadesSubEspContDosim', {contratodosimetria: contrato_id, novcontdosisededepto: valor.id_novcontdosisededepto}, function(novedadesSubEspCont){
                                console.log("ESTAS SON LAS NOVEDADES DE ESE CONTRATO SEGUN EL DEPARTAMENTO NUEVO POR NOVEDAD");
                                console.log(novedadesSubEspCont);
                                var id = [];
                                var periodo;
                                var fecha_inicio;
                                var fecha_final;
                                if(novedadesSubEspCont.length == 0){
                                    console.log("ES VACIO");
                                    var tr = `<tr><td class="text-center align-middle" colspan='5'>"NO HAY NOVEDADES DE SUB-ESPECIALIDADES"</td>
                                    </tr>`;
                                    $('#tablasubesp'+valor.id_novcontdosisededepto).append(tr);
                                }else{
                                    $.each(novedadesSubEspCont, function(index, valor2){
                                        var periodo;
                                        ///obtener la fecha del periodo en que se hizo la novedad/////
                                        const meses = ['ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO', 'JULIO', 'AGOSTO', 'SEPTIEMBRE', 'OCTUBRE', 'NOVIEMBRE', 'DICIEMBRE'];
                                        let fecha = new Date(valor2.fecha_inicio);
                                        var fechaF = new Date(fecha.setMinutes(fecha.getMinutes() + fecha.getTimezoneOffset()));
                                        console.log("ESTA ES LA FECHA DE INICIO=");
                                        console.log(fechaF);
                                        var numLec = valor2.numlecturas_año;
                                        
                                        if(valor2.periodo_recambio == 'MENS'){
                                            var xx = 1; 
                                            for(var i=0; i<=(numLec-2); i++){
                                                var ultimoDiaPM = new Date(fecha.getFullYear(), fecha.getMonth() + 1, 1);
                                                console.log("ULTIMO DIA PRIMER MES:"+ ultimoDiaPM);
                                                var ultimoDiaPMF = new Date(ultimoDiaPM);
                                                ultimoDiaPMF.setDate(ultimoDiaPMF.getDate()-1);
                                                console.log(ultimoDiaPMF);
                                                console.log("esta es la i="+i);
                                                var r = new Date(new Date(ultimoDiaPM).setMonth(ultimoDiaPM.getMonth()+i));
                                                console.log("r1" +r);
                                                var r2 = new Date(new Date(r).setMonth(r.getMonth()+1));
                                                var fechaesp = meses[r.getMonth()] + ' DE ' + r.getUTCFullYear();
                                                var r2final = new Date(new Date(r2).setDate(r.getDate()-1));
                                                console.log("r2 " +r2final);
                                                var fechaesp1 = r.getDate()+' '+meses[r.getMonth()] + ' DE ' + r.getUTCFullYear();
                                                console.log(fechaesp1);
                                                var fechaesp2 = (r2final.getDate()) +' '+ meses[r2final.getMonth()] + ' DE ' + r2final.getUTCFullYear(); 
                                                console.log(fechaesp2);
                                                xx++;
                                                console.log("XX ="+xx);
                                                if(valor2.mes_asignacion == 1){
                                                    console.log("entro al mes 1 = ");
                                                    periodo = valor2.mes_asignacion+" - "+fechaF.getDate()+' '+meses[fechaF.getMonth()] + ' DE ' + fechaF.getUTCFullYear()+" al <br>"+ultimoDiaPMF.getDate()+' '+meses[ultimoDiaPMF.getMonth()] + ' DE ' + ultimoDiaPMF.getUTCFullYear();
                                                }else if(valor2.mes_asignacion == xx){
                                                    console.log("entro al mes xx = ");
                                                    document.getElementById('periodo')
                                                    periodo = valor2.mes_asignacion+" - "+fechaesp1+" al <br>"+fechaesp2;
                                                    console.log("periodo = "+periodo);
                                                }
                                                
                                            }
                                        }else if(valor2.periodo_recambio == 'TRIMS'){
                                            var xx = 1;
                                            for(var i=0; i<=numLec; i= i+3){
                                                var ultimoDiaPM = new Date(fechaF.getFullYear(), fechaF.getMonth() + 3, 1);
                                                console.log("ULTIMO DIA PRIMER MES:"+ ultimoDiaPM);
                                                var ultimoDiaPMF = new Date(ultimoDiaPM);
                                                ultimoDiaPMF.setDate(ultimoDiaPMF.getDate()-1);
                                                console.log(ultimoDiaPMF);
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
                                                console.log("XX ="+xx);
                                                if(valor2.mes_asignacion == 1){
                                                    console.log("entro al mes 1 = ");
                                                    periodo = valor2.mes_asignacion+" - "+fechaF.getDate()+' '+meses[fechaF.getMonth()] + ' DE ' + fechaF.getUTCFullYear()+" al <br>"+ultimoDiaPMF.getDate()+' '+meses[ultimoDiaPMF.getMonth()] + ' DE ' + ultimoDiaPMF.getUTCFullYear();
                                                }else if(valor2.mes_asignacion == xx){
                                                    console.log("entro al mes xx = ");
                                                    document.getElementById('periodo')
                                                    periodo = valor2.mes_asignacion+" - "+fechaesp1+" al <br>"+fechaesp2;
                                                    console.log("periodo = "+periodo);
                                                }
                                            }
                                        }else if(valor2.periodo_recambio == 'BIMS'){
                                            var xx = 1;
                                            for(var i=0; i<=(numLec+2); i= i+2){
                                                var ultimoDiaPM = new Date(fecha.getFullYear(), fecha.getMonth() + 2, 1);
                                                console.log("ULTIMO DIA PRIMER MES:"+ ultimoDiaPM);
                                                var ultimoDiaPMF = new Date(ultimoDiaPM);
                                                ultimoDiaPMF.setDate(ultimoDiaPMF.getDate()-1);
                                                console.log(ultimoDiaPMF);
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
                                                if(valor2.mes_asignacion == 1){
                                                    console.log("entro al mes 1 = ");
                                                    periodo = valor2.mes_asignacion+" - "+fechaF.getDate()+' '+meses[fechaF.getMonth()] + ' DE ' + fechaF.getUTCFullYear()+" al <br>"+ultimoDiaPMF.getDate()+' '+meses[ultimoDiaPMF.getMonth()] + ' DE ' + ultimoDiaPMF.getUTCFullYear();
                                                }else if(valor2.mes_asignacion == xx){
                                                    console.log("entro al mes xx = ");
                                                    document.getElementById('periodo')
                                                    periodo = valor2.mes_asignacion+" - "+fechaesp1+" al <br>"+fechaesp2;
                                                    console.log("periodo = "+periodo);
                                                }
                                            } 
                                        }
                                        var num = parseInt(valor2.codigo_novedad);
                                        var n = num.toString().padStart(5,'0');
                                        console.log("ESTE ES EL CODIGO" +n);
                                        console.log("novedad_id="+valor2.id_novedad);
                                        var tr = `<tr><td class="text-center align-middle" id ="periodo`+valor2.mes_asignacion+`" style='width: 20%'>`+periodo+`</td>
                                                <td class="text-center align-middle">`+n+`</td>
                                                <td class=" align-middle" id='subespobs`+valor2.id_novedadmesescontdosi+`'></td>
                                                <td class="text-center align-middle" style='width: 5%'" id='subespdetalle`+valor2.id_novedadmesescontdosi+`'></td>
                                                <td class="text-center align-middle justify-content-center>
                                                    <div class="form-check">
                                                        <input class="form-check-input text-center align-middle" type="checkbox" value="TRUE" id="`+valor2.id_novedad+`" name="checkbox">
                                                    </div>     
                                                </td>
                                            </tr>`;
                                        $('#tablasubesp'+valor2.novcontdosisededepto_id).append(tr);
                                        
                                        $.get('cambiosnovedadesContDosim', {novedadmesescontdosi: valor2.id_novedadmesescontdosi}, function(cambiosNov){
                                            console.log("cambios novedad");
                                            console.log(cambiosNov);
                                            $.each(cambiosNov, function(index, valor3){
                                                console.log(valor3.nota_cambiodosim);
                                                var td ='- '+valor3.nota_cambiodosim+'.'+`<br>`;
                                                console.log(td);
                                                $('#subespobs'+valor3.novedadmesescontdosidepto_id).append(td);
                                                var buttonDetalle = ` <button class="btn btn-primary"  type="button" onclick="detalle('`+valor3.id_cambionovedadmeses+`', 1);">
                                                        Detalle
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-right mb-1" viewBox="0 0 16 16">
                                                        <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
                                                        </svg>
                                                    </button>`;
                                                $('#subespdetalle'+valor3.novedadmesescontdosidepto_id).append(buttonDetalle);
                                            })
                                        });
                                    });
                                }
                            })
                        } 
                    })
                })
                
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

    function detalle(id,item){
        
        var host = window.location.host;
        var path = "http://"+host+"/POSITRON/public/novedades/"+id+"/"+item+"/detalleNovedad";
        
        window.open(path, '_self');
    }
    function alertreporte(){
        var checkbox = document.querySelectorAll('input[name="checkbox"]');
        console.log("CHECKBOX");
        console.log(checkbox);
        var falso = 0;
        var novedades = new Array();
        for(var x = 0; x < checkbox.length; x++){
            var valuesCheck = checkbox[x].checked;
            console.log(valuesCheck);
            if(valuesCheck == true){
                console.log("ES VERDADERO= "+checkbox[x].id);
                novedades.push(checkbox[x].id);
            }else{
                falso ++;
            }
        }
        if(falso == checkbox.length){
            Swal.fire({
                icon: "error",
                title: "Error",
                text: "SELECCIONE AL MENOS UNA NOVEDAD",
            });
        }
        var contrato = document.getElementById('contratos_empresadosi').value;
        console.log("CONTRATO");
        console.log(contrato);
        if(novedades != null){
            var host = window.location.host; 
            var path = "http://"+host+"/POSITRON/public/reporteNov/"+novedades+"/"+contrato+"/"+0+"/pdf";
            window.open(path, '_blank');
        }
    }
</script>


@endsection()