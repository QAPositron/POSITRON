@extends('layouts.plantillabase')
@section('contenido')
<div class="row">
    <div class="col-md "></div>
    <div class="col-md-8 ">
        <h2 class="text-center">REVISIÓN DE DOSÍMETROS</h2>
    </div>
    <div class="col-md text-center">
        <a type="button" class="btn btn-circle colorQA" href="">
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-file-earmark-pdf pt-1" viewBox="0 0 16 16">
                <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z"/>
                <path d="M4.603 14.087a.81.81 0 0 1-.438-.42c-.195-.388-.13-.776.08-1.102.198-.307.526-.568.897-.787a7.68 7.68 0 0 1 1.482-.645 19.697 19.697 0 0 0 1.062-2.227 7.269 7.269 0 0 1-.43-1.295c-.086-.4-.119-.796-.046-1.136.075-.354.274-.672.65-.823.192-.077.4-.12.602-.077a.7.7 0 0 1 .477.365c.088.164.12.356.127.538.007.188-.012.396-.047.614-.084.51-.27 1.134-.52 1.794a10.954 10.954 0 0 0 .98 1.686 5.753 5.753 0 0 1 1.334.05c.364.066.734.195.96.465.12.144.193.32.2.518.007.192-.047.382-.138.563a1.04 1.04 0 0 1-.354.416.856.856 0 0 1-.51.138c-.331-.014-.654-.196-.933-.417a5.712 5.712 0 0 1-.911-.95 11.651 11.651 0 0 0-1.997.406 11.307 11.307 0 0 1-1.02 1.51c-.292.35-.609.656-.927.787a.793.793 0 0 1-.58.029zm1.379-1.901c-.166.076-.32.156-.459.238-.328.194-.541.383-.647.547-.094.145-.096.25-.04.361.01.022.02.036.026.044a.266.266 0 0 0 .035-.012c.137-.056.355-.235.635-.572a8.18 8.18 0 0 0 .45-.606zm1.64-1.33a12.71 12.71 0 0 1 1.01-.193 11.744 11.744 0 0 1-.51-.858 20.801 20.801 0 0 1-.5 1.05zm2.446.45c.15.163.296.3.435.41.24.19.407.253.498.256a.107.107 0 0 0 .07-.015.307.307 0 0 0 .094-.125.436.436 0 0 0 .059-.2.095.095 0 0 0-.026-.063c-.052-.062-.2-.152-.518-.209a3.876 3.876 0 0 0-.612-.053zM8.078 7.8a6.7 6.7 0 0 0 .2-.828c.031-.188.043-.343.038-.465a.613.613 0 0 0-.032-.198.517.517 0 0 0-.145.04c-.087.035-.158.106-.196.283-.04.192-.03.469.046.822.024.111.054.227.09.346z"/>
            </svg>
        </a>
        <br>
        REPORTE
    </div>
</div>
<br>
<br>
<div class="row">
    <div class="col-md"></div>
    <div class="col-md-5">
        <div class="card text-dark bg-light">
            <div class="row">
                <div class="col-md m-3">
                    <h5 class="pt-4 text-center">CÓDIGO DE LA ETIQUETA </h5>
                    <br>
                    <input class="form-control" type="number" name="codigo_etiqueta" id="codigo_etiqueta" placeholder="-DIGITE UN CODIGO-" autofocus >
                </div>
                <div class="col-md m-3">
                    <h5 class="pt-4 text-center">CÓDIGO DEL DOSÍMETRO </h5>
                    <br>
                    <input class="form-control" type="number" name="codigo_dosimetro" id="codigo_dosimetro" placeholder="-DIGITE UN CODIGO-" autofocus >
                </div>
            </div>
            
            <div class="row">
                <div class="col-md"></div>
                <div class="col-md-6 ">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="dosi_control" name="dosi_control" checked>
                        <label class="form-check-label" for="defaultCheck1">    
                            DOSIMETRO DE CONTROL
                        </label>
                    </div>
                </div>
                <div class="col-md"></div>
            </div>
            <br>
        </div>
    </div>
    <div class="col-md"></div>
</div>
<br>
<br>
<div class="row">
    <div class="col-7 px-1">
        <div class="card">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs" id="todasAasignaciones" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" href="#control" role="tab" aria-controls="control" aria-selected="true">CONTROL</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"  href="#todas" role="tab" aria-controls="todas" aria-selected="false">TODAS</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <!-- //////////////////// PESTAÑA DE EMPRESA //////////////// -->
                <div class="tab-content mt-3">
                    <div class="tab-pane active" id="control" role="tabpanel">  
                        <h4 class="card-title text-center">INFORMACIÓN DE TODAS LAS ASIGNACIONES DE DOSÍMETRO CONTROL</h4>
                        <div class="table table-responsive p-4 m-1">
                            <table class="table table-bordered asignacionesControl" style="font-size: 13px;">
                                <thead>
                                    <tr class="table-active text-center">
                                        <th class='align-middle py-4' style="width: 10%;">CONTROL</th>
                                        <th class='align-middle py-4' >DOSÍM.</th>
                                        {{-- <th class='align-middle py-4' >HOLDER</th> --}}
                                        {{-- <th class='align-middle py-4' >UBIC.</th> --}}
                                        <th class='align-middle py-4' >CONT.</th>
                                        <th class='align-middle py-4' >MES</th>
                                        <th class='align-middle py-4' >EMPRESA</th>
                                        <th class='align-middle py-4' >SEDE</th>
                                        <th class='align-middle py-4' >ESP.</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table>
                        </div>    
                    </div>
                    <!-- //////////////////// PESTAÑA DE SEDES //////////////// -->
                    <div class="tab-pane" id="todas" role="tabpanel" aria-labelledby="todas-tab">
                        <h4 class="card-title text-center">INFORMACIÓN DE TODAS LAS ASIGNACIONES</h4>
                        <div class="table table-responsive p-2">
                            <table class="table table-bordered asignaciones" style="font-size: 12px;">
                                <thead>
                                    <tr class="table-active text-center">
                                        <th class='align-middle py-4' style="width: 10%;">TRABAJADOR</th>
                                        <th class='align-middle py-4' >DOSÍM.</th>
                                        <th class='align-middle py-4' >HOLDER</th>
                                        <th class='align-middle py-4' >UBIC.</th>
                                        <th class='align-middle py-4' >CONT.</th>
                                        <th class='align-middle py-4' >MES</th>
                                        <th class='align-middle py-4' >EMPRESA</th>
                                        <th class='align-middle py-4' >SEDE</th>
                                        <th class='align-middle py-4' >ESP.</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table>
                        </div>
                            
                    </div>
                </div>
            </div>
        </div>    
        
        <br>
            
    </div>
    <div class="col-5">
        
        <h4 class="text-center">ASIGNACIONES REVISADAS</h4>
        <div class="table table-responsive pt-2">
            <table class="table table-sm table-bordered" style="font-size: 13px;">
                <thead>
                    <tr class="table-active text-center ">
                        <th class='align-middle py-4' style="width: 20%;">TRABJ</th>
                        <th class='align-middle py-4' >DOSÍM.</th>
                        <th class='align-middle py-4' >UBIC.</th>
                        <th class='align-middle py-4' >CONT.</th>
                        <th class='align-middle py-4' >MES</th>
                        <th class='align-middle py-4' >EMP.</th>
                        <th class='align-middle py-4' >SEDE</th>
                        <th class='align-middle py-4' >ESP.</th>
                    </tr>
                </thead>
                <tbody id="tbody_asignacionesok">
                    
                    
                    
                </tbody>
            </table>
        </div>
        <br>
        
    </div>
    
</div>
<script
src="https://code.jquery.com/jquery-3.6.0.js"
integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
crossorigin="anonymous">
</script>
<script type="text/javascript">
    $(document).ready( function () {
            $('#todasAasignaciones a').on('click', function (e) {
                e.preventDefault()
                $(this).tab('show')
            })
            var table2 = $('.asignaciones').DataTable({
                "destroy":true,
                "ajax":{
                    "url":"asignaciones",
                    "dataSrc":""
                },
                "columns":[
                    
                    {"data": 'primer_nombre_persona', className: "text-center py-3 align-middle",
                        "render": function ( data, type, row ) {
                        // esto es lo que se va a renderizar como html
                            if(row.segundo_nombre_persona == null)
                                return `${row.primer_nombre_persona} ${row.primer_apellido_persona} ${row.segundo_apellido_persona}`; 
                            else {
                                return `${row.primer_nombre_persona} ${row.segundo_nombre_persona} ${row.primer_apellido_persona} ${row.segundo_apellido_persona}`;
                            }   
                        }
                    },
                    {"data": 'codigo_dosimeter', className: "text-center py-3 align-middle"},
                    {"data": 'codigo_holder', className: "text-center py-3 align-middle",
                        "render": function ( data, type, row ) {
                        // esto es lo que se va a renderizar como html
                            if(row.codigo_holder == null)
                                return `N.A.`; 
                            else {
                                return `${row.codigo_holder}`;
                            }   
                        }
                    },
                    {"data": 'ubicacion', className: "text-center py-3 align-middle"},
                    {"data": 'codigo_contrato', className: "text-center py-3 align-middle"},
                    {"data": 'mes_asignacion', className: "text-center py-3 align-middle"},
                    {"data": 'nombre_empresa', className: "text-center py-3 align-middle"},
                    {"data": 'nombre_sede', className: "text-center py-3 align-middle"},
                    {"data": 'nombre_departamento', className: "text-center py-3 align-middle"}
    
                ],
                "rowId": function(a) {
                    return a.id_trabajadordosimetro;
                },
                language: {
                    "decimal": "",
                    "emptyTable": "NO HAY REGISTROS",
                    "info": "MOSTRANDO REGISTROS DEL  _START_ AL _END_ DE UN TOTAL DE  _TOTAL_ REGISTROS",
                    "infoEmpty": "MOSTRANDO 0 DE 0 REGISTROS",
                    "infoFiltered": "(FILTRADO DE UN TOTAL DE _MAX_ REGISTROS)",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "MOSTRAR _MENU_ REGISTROS",
                    "loadingRecords": "CARGANDO...",
                    "processing": "PROCESANDO...",
                    "search": "BUSCAR:",
                    "zeroRecords": "NO SE ENCONTRARON RESULTADOS",
                    "paginate": {
                        "first": "PRIMERO",
                        "last": "ÚLTIMO",
                        "next": "SIGUIENTE",
                        "previous": "ANTERIOR"
                    }   
                },
                orderCellsTop :true,
                fixedHeader:true,
                "dom": 'lrtip',
                "lengthChange": false
            });
        
        
            var table1 = $('.asignacionesControl').DataTable({
                "ajax":{
                    "url":"asignacionesControl",
                    "dataSrc":""
                },
                "columns":[
                    
                    
                    {"data": 'id_dosicontrolcontdosisedes', className: "text-center py-3 align-middle",
                        "render": function ( data, type, row ) {
                        // esto es lo que se va a renderizar como html
                            return `CONTROL`;
                        }
                    },
                    {"data": 'codigo_dosimeter', className: "text-center py-3 align-middle"},
                    {"data": 'codigo_contrato', className: "text-center py-3 align-middle"},
                    {"data": 'mes_asignacion', className: "text-center py-3 align-middle"},
                    {"data": 'nombre_empresa', className: "text-center py-3 align-middle"},
                    {"data": 'nombre_sede', className: "text-center py-3 align-middle"},
                    {"data": 'nombre_departamento', className: "text-center py-3 align-middle"}
    
                ],
                "rowId": function(a) {
                    return a.id_dosicontrolcontdosisedes;
                },
                language: {
                    "decimal": "",
                    "emptyTable": "NO HAY REGISTROS",
                    "info": "MOSTRANDO REGISTROS DEL  _START_ AL _END_ DE UN TOTAL DE  _TOTAL_ REGISTROS",
                    "infoEmpty": "MOSTRANDO 0 DE 0 REGISTROS",
                    "infoFiltered": "(FILTRADO DE UN TOTAL DE _MAX_ REGISTROS)",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "MOSTRAR _MENU_ REGISTROS",
                    "loadingRecords": "CARGANDO...",
                    "processing": "PROCESANDO...",
                    "search": "BUSCAR:",
                    "zeroRecords": "NO SE ENCONTRARON RESULTADOS",
                    "paginate": {
                        "first": "PRIMERO",
                        "last": "ÚLTIMO",
                        "next": "SIGUIENTE",
                        "previous": "ANTERIOR"
                    }   
                },
                orderCellsTop :true,
                fixedHeader:true,
                "dom": 'lrtip',
                "lengthChange": false
            })
        
        $('#codigo_etiqueta', this).on('keyup change', function(){
            console.log("ESTE ES EL BUSCADOR"); 
            console.log( this.value);
            if(table2.column(1).search() !== this.value){
                table2
                    .column(1)
                    .search(this.value)
                    .draw();
            }
            
        });

        $('#codigo_etiqueta', this).on('keyup change', function(){
            if(table1.column(1).search() !== this.value){
                table1
                    .column(1)
                    .search(this.value)
                    .draw();
            }
        });

        
        $('#dosi_control').on('change', function(){
            var codigoEtiq = document.querySelector('#codigo_etiqueta').value;
            const js = document.querySelector('#dosi_control').checked;
            console.log("ESTADO INICIAL"+js);
            console.log("codigo etiqueta con checkbox estado inicial"+codigoEtiq+js);
            
            if(js){
            
                consultarDosiControl();
            }else{
               
                consultarTrabDosi();
            }
        })
        function consultarDosiControl(){
            
            var codigoDosi = document.getElementById('codigo_dosimetro').value; 
            console.log(codigoDosi);
            if(codigoDosi != ''){
                $.get('dosimetro',{codigo_dosi : codigoDosi}, function(dosimetro){
                    console.log(dosimetro);
                    if(dosimetro.length != 0){
                        var check = 0;
                        var codigoEtiq = document.getElementById("codigo_etiqueta").value;
                        console.log(check);
                        @foreach($dosicontrolasig as $dosicont)
                            if(codigoEtiq == codigoDosi && codigoDosi == '{{$dosicont->codigo_dosimeter}}'){
                                console.log("SI SE HIZO MATCH CONTROL");
                                check = 1;
                                Swal.fire({
                                    icon: 'success',
                                    title: 'CORRECTO!!',
                                    text: 'SI SE ENCUENTRA RELACIONADO ESTE DOSÍMETRO DE CONTROL Y ADEMAS COINCIDE LA UBICACIÓN Y ESTADO',
                                    showConfirmButton: false,
                                    timer: 6000
                                })
    
                                document.getElementById("codigo_dosimetro").value = "";
                                /* document.getElementById("codigo_etiqueta").value = ""; */
                                /* document.querySelector('#dosi_control').disabled= false; */
                                $.get('controldosimetro', {id_dosicontrolcontdosisedes: '{{$dosicont->id_dosicontrolcontdosisedes}}'}, function(dosicontrol){
                                    console.log("SE HIZO EL CHECK CONTROL"+dosicontrol);
                                    console.log(dosicontrol);
                                    var tr = `<tr class="text-center">
                                                <td class='align-middle'>CONTROL</td>
                                                <td class='align-middle'>{{$dosicont->codigo_dosimeter}}</td>
                                                <td class='align-middle'>CONTROL</td>
                                                <td class='align-middle'>{{$dosicont->codigo_contrato}}</td>
                                                <td class='align-middle'>{{$dosicont->mes_asignacion}}</td>
                                                <td class='align-middle'>{{$dosicont->nombre_empresa}}</td>
                                                <td class='align-middle'>{{$dosicont->nombre_sede}}</td>
                                                <td class='align-middle'>{{$dosicont->nombre_departamento}}</td>
                                            </tr>`;
                                    $("#tbody_asignacionesok").append(tr);
                                    var fila = document.getElementById('{{$dosicont->id_dosicontrolcontdosisedes}}');
                                    table1.ajax.reload(null, false);
                                   /*  $('#codigo_etiqueta').val('').change(); */
                                   /* table1.row(fila).remove().draw(); */ 
                                })
                            }
                        @endforeach  
                        console.log(check);
                        if(check == 0){
                            console.log("NO SE HIZO MATCH CONTROL");
                            Swal.fire({
                                icon: 'error',
                                title: 'ERROR!!',
                                text: 'NO SE ENCUENTRA RELACIONADO ESTE DOSÍMETRO DE CONTROL',
                                showConfirmButton: false,
                                timer: 6000
                            })
                            document.getElementById("codigo_dosimetro").value = "";
                            document.getElementById("codigo_etiqueta").value = "";
                            /* document.querySelector('#dosi_control').disabled= false; */
                        }
                    }else{
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!!',
                            text: 'NO EXISTE NINGUN DOSÍMETRO CON ESE CODIGO',
                            showConfirmButton: false,
                            timer: 6000
                        })
                        document.getElementById("codigo_dosimetro").value = "";
                        document.getElementById("codigo_etiqueta").value = "";
                        /* document.querySelector('#dosi_control').disabled= false; */
                        console.log("NO EXISTE ESTE DOSIMETRO");
                    }
                })
            }
        }
        function consultarTrabDosi(codigoEtiq){
            var codigoDosi = document.getElementById('codigo_dosimetro').value; 
            console.log(codigoDosi);
            if(codigoDosi != ''){
                $.get('dosimetro',{codigo_dosi : codigoDosi}, function(dosimetro){
                    console.log(dosimetro);
                    if(dosimetro.length != 0){
                        var check = 0;
                         /* var codigoEtiq = document.getElementById("codigo_etiqueta").value; */
                        console.log(check);
                        console.log(codigoEtiq);
                        @foreach($trabajdosiasig as $trabj)
                            /* if(codigoEtiq == codigoDosi && codigoDosi == '{{$trabj->codigo_dosimeter}}' && dosimetro[0].uso_dosimetro == '{{$trabj->ubicacion}}' && dosimetro[0].estado_dosimetro == 'EN USO' ){ */
                            
                            if(codigoEtiq == codigoDosi && codigoDosi == '{{$trabj->codigo_dosimeter}}'){
                                console.log("SI SE HIZO MATCH");
                                check = 1;
                                Swal.fire({
                                    icon: 'success',
                                    title: 'CORRECTO!!',
                                    text: 'SI SE ENCUENTRA RELACIONADO ESTE DOSÍMETRO Y ADEMAS COINCIDE LA UBICACIÓN Y ESTADO',
                                    showConfirmButton: false,
                                    timer: 4000
                                })
                                var tr = `<tr class="text-center">
                                                <td class='align-middle'>{{$trabj->primer_nombre_persona}} {{substr($trabj->segundo_nombre_persona,0,1)}} {{$trabj->primer_apellido_persona}} {{$trabj->segundo_apellido_persona}}</td>
                                                <td class='align-middle'>{{$trabj->codigo_dosimeter}}</td>
                                                <td class='align-middle'>{{$trabj->ubicacion}}</td>
                                                <td class='align-middle'>{{$trabj->codigo_contrato}}</td>
                                                <td class='align-middle'>{{$trabj->mes_asignacion}}</td>
                                                <td class='align-middle'>{{$trabj->nombre_empresa}}</td>
                                                <td class='align-middle'>{{$trabj->nombre_sede}}</td>
                                                <td class='align-middle'>{{$trabj->nombre_departamento}}</td>
                                            </tr>`;
                                $("#tbody_asignacionesok").append(tr);
                                $('#codigo_etiqueta').focus();
                                
                                
                                $.get('trabajdosimetro', {id_trabajadordosimetro: '{{$trabj->id_trabajadordosimetro}}'}, function(trabajadordosimetro){
                                    console.log("SE HIZO EL CHECK"+trabajadordosimetro);
                                    console.log(trabajadordosimetro);
                                   
                                });
                                table2.clear().draw();
                                
                                
                                table2.ajax.reload(null, false);
                                
                            }
                        @endforeach  
                        console.log(check);

                        if(check == 0){
                            console.log("NO SE HIZO MATCH");
                            Swal.fire({
                                icon: 'error',
                                title: 'ERROR!!',
                                text: 'NO SE ENCUENTRA RELACIONADO ESTE DOSÍMETRO',
                                showConfirmButton: false,
                                timer: 3000
                            })
                            document.getElementById("codigo_dosimetro").value = "";
                            document.getElementById("codigo_etiqueta").value = "";
                            
                        }
                    }else{
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!!',
                            text: 'NO EXISTE NINGUN DOSÍMETRO CON ESE CODIGO',
                            showConfirmButton: false,
                            timer: 3000
                        })
                        document.getElementById("codigo_dosimetro").value = "";
                        document.getElementById("codigo_etiqueta").value = "";
                        
                        console.log("NO EXISTE");
                    }
                })
                
                document.getElementById("codigo_dosimetro").value = "";
                document.getElementById("codigo_etiqueta").value = "";
            }
        }
        $('#codigo_etiqueta').on('change', function(){
            var codigoEtiq = document.querySelector('#codigo_etiqueta').value;
            const js = document.querySelector('#dosi_control').checked;
            console.log("ESTADO INICIAL"+js);
            console.log("codigo etiqueta con checkbox estado inicial"+codigoEtiq+js);
            console.log('CODIGO ETIQUETA' + codigoEtiq);
            document.getElementById("codigo_dosimetro").value = "";
            
            if(js){
                console.log("ENTRO AL IF DE LA FUNCION ETIQUETA");
                consultarDosiControl();
            }else{
                console.log("ESTTRO AL IF DE LA FUNCION ETIQUETA NORMAL");
                consultarTrabDosi(codigoEtiq);
            }
        })
           
        $('#codigo_dosimetro').on('change', function(){
            var codigoEtiq = document.querySelector('#codigo_etiqueta').value;
            const js = document.querySelector('#dosi_control').checked;
            console.log("ESTADO INICIAL"+js);
            console.log("codigo etiqueta con checkbox estado inicial"+codigoEtiq+js);
           /*  document.querySelector('#dosi_control').disabled= true; */
            if(js){
                console.log("ENTRO AL IF DE LA FUNCION DOSIMETRO");
                consultarDosiControl();
            }else{
                console.log("ESTTRO AL IF DE LA FUNCION DOSIMETRO NORMAL");
                consultarTrabDosi(codigoEtiq);
                console.log("SALIO DEL IF DE LA FUNCION DOSIMETRO NORMAL");
            }
            
        });
    })
</script>
@endsection