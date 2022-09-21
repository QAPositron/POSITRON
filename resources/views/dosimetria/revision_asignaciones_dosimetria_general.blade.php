@extends('layouts.plantillabase')
@section('contenido')
<div class="row">
    <div class="col-md "></div>
    <div class="col-md-8 ">
        <h2 class="text-center">REVISIÓN DE DOSÍMETROS</h2>
    </div>
    <div class="col-md "></div>
</div>
<br>
<br>
<div class="row ">
    <div class="col-md"></div>
    <div class="col-md-5">
        <div class="row">
            <div class="col"></div>
            <div class="col-md-9">
                <div class="card text-dark bg-light" style="max-width: 25rem;">
                    <h3 class="pt-4 text-center">CÓDIGO DE LA  ETIQUETA </h3>
                    <br>
                    <div class="row">
                        <div class="col-md"></div>
                        <div class="col-md-8">
                            <input class="form-control" type="number" name="codigo_etiqueta" id="codigo_etiqueta" placeholder="-DIGITE UN CODIGO-" autofocus style="text-transform:uppercase;">
                        </div>
                        <div class="col-md"></div>
                    </div>
                    <br>
                </div>
            </div>
            <div class="col"></div>
        </div>
    </div>
    <div class="col-md-5">
        <div class="row">
            <div class="col"></div>
            <div class="col-md-9">
                <div class="card text-dark bg-light" style="max-width: 25rem;">
                    <h3 class="pt-4 text-center">CÓDIGO DEL DOSÍMETRO </h3>
                    <br>
                    <div class="row">
                        <div class="col-md"></div>
                        <div class="col-md-8">
                            <input class="form-control" type="number" name="codigo_dosimetro" id="codigo_dosimetro" placeholder="-DIGITE UN CODIGO-" autofocus style="text-transform:uppercase;">
                        </div>
                        <div class="col-md"></div>
                    </div>
                    <br>
                </div>
            </div>
            <div class="col"></div>
        </div>
    </div>
    <div class="col-md"></div>
</div>
<br>
<br>
<div class="row">
    <div class="col-md-8 px-1">
        
        <h4 class="text-center">INFORMACIÓN DE TODAS LAS ASIGNACIONES</h4>
        <div class="table table-responsive p-4">
            <table class="table table-sm table-bordered asignaciones ">
                <thead>
                    <tr class="table-active text-center ">
                        <th hidden> CODIGO</th>
                        <th class='align-middle py-4' >TRABAJADOR</th>
                        <th class='align-middle py-4' >No. IDEN.</th>
                        <th class='align-middle py-4' >DOSÍMETRO</th>
                        <th class='align-middle py-4' >HOLDER</th>
                        <th class='align-middle py-4' >UBICACIÓN</th>
                        <th class='align-middle py-4' >MES</th>
                        <th class='align-middle py-4' >EMPRESA</th>
                        <th class='align-middle py-4' >SEDE</th>
                    </tr>
                </thead>
                <tbody>
                    
                    @foreach($trabajdosiasig as $trabasig)
                        <tr id='{{$trabasig->id_trabajadordosimetro}}' class="text-center">
                            <td hidden>{{$trabasig->id_trabajadordosimetro}}</td>
                            <td class='align-middle py-3'>@if(!empty($trabasig->persona->primer_nombre_persona)){{$trabasig->persona->primer_nombre_persona}} {{substr($trabasig->persona->segundo_nombre_persona,0,1)}} {{$trabasig->persona->primer_apellido_persona}} {{$trabasig->persona->segundo_apellido_persona}}@endif </td>
                            <td class='align-middle py-3'>@if(!empty($trabasig->persona->cedula_persona)) {{$trabasig->persona->cedula_persona}}@endif </td>
                            <td class='align-middle py-3'>{{$trabasig->dosimetro->codigo_dosimeter}}</td>
                            <td class='align-middle py-3'>
                                @if($trabasig->holder_id == '')
                                    N.A.
                                @else
                                    {{$trabasig->holder->codigo_holder}}
                                @endif
                            </td>
                            <td class='align-middle py-3'>{{$trabasig->ubicacion}}</td>
                            <td class='align-middle py-3'>{{$trabasig->mes_asignacion}}</td>
                            <td class='align-middle py-3'>{{$trabasig->contratodosimetriasede->sede->empresa->nombre_empresa}}</td>
                            <td class='align-middle py-3'>{{$trabasig->contratodosimetriasede->sede->nombre_sede}}</td>
                        </tr>
                    @endforeach
                    
                </tbody>
            </table>
        </div>
        <br>
            
    </div>
    <div class="col-md-4 ">
        
        <h4 class="text-center">INFORMACIÓN DE TODOS LOS DOSÍMETROS</h4>
        <div class="table table-responsive">
            <table class="table table-sm table-bordered dosimetros">
                <thead>
                    <tr class="table-active text-center ">
                        <th class='align-middle py-2'>CODIGO</th>
                        <th class='align-middle py-2'>TIPO</th>
                        <th class='align-middle py-2'>TECNOL.</th>
                        <th class='align-middle py-2'>ESTADO</th>
                        <th class='align-middle py-2'>USO ACTUAL</th>
                       
                    </tr>
                </thead>
                <tbody>
                    @foreach($dosimetros as $dosi)
                        <tr id='{{$dosi->id_dosimetro}}' class="text-center" >
                            <td class='align-middle py-2'>{{$dosi->codigo_dosimeter}}</td>
                            <td class='align-middle py-2'>{{$dosi->tipo_dosimetro}}</td>
                            <td class='align-middle py-2'>{{$dosi->tecnologia_dosimetro}}</td>
                            <td class='align-middle py-2'>{{$dosi->estado_dosimetro}}</td>
                            <td class='align-middle  py-2'>{{$dosi->uso_dosimetro}}</td>
                            
                        </tr>
                    @endforeach
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
    $(document).ready( function ()  {
        @foreach($trabajdosiasig as $trabj)
            if('{{$trabj->revision}}' == 'TRUE'){
                let tr = document.getElementById('{{$trabj->id_trabajadordosimetro}}'); 
                tr.style.boxShadow = "0px 0px 10px 1px rgb(109, 250, 100)";
            }
        @endforeach
        var table1 = $('.asignaciones').DataTable({
            language: {
                "decimal": "",
                "emptyTable": "NO HAY REGISTROS",
                "info": "MOSTRANDO REGISTROS DEL  _START_ AL _END_ DE UN TOTAL DE  _TOTAL_ REGISTROS",
                "infoEmpty": "MOSTRANDO 0 to 0 DE 0 REGISTROS",
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
            "dom": 'lrtip'
        });
        
        $('#codigo_etiqueta', this).on('keyup change', function(){
            if(table1.column(0).search() !== this.value){
                table1
                    .column(0)
                    .search(this.value)
                    .draw();
            }
        });
            
        $('#codigo_etiqueta').on('change', function(){
            var codigo = $(this).val();
            console.log(codigo);
            var check = 0;
            @foreach($trabajdosiasig as $trabj)
                if(codigo == '{{$trabj->id_trabajadordosimetro}}' ){
                    check = 1;
                    console.log("si existe ese codigo");
                    /* let tr = document.getElementById('{{$trabj->id_trabajadordosimetro}}'); 
                    tr.style.boxShadow = "0px 0px 20px 5px rgb(109, 250, 100)"; */
                    Swal.fire({
                        icon: 'success',
                        title: 'CORRECTO!!',
                        text: 'SI EXISTE EL REGISTRO EN ESTE MES DEL CONTRATO',
                        showConfirmButton: false,
                        timer: 3000
                    })
                    document.getElementById("codigo_etiqueta").value = "";
                }
                
            @endforeach
            if(check == 0){
                console.log("no existe ese codigo");
                Swal.fire({
                    icon: 'error',
                    title: 'Error!!',
                    text: 'NO EXISTE ESTE REGISTRO PARA ESTE MES DEL CONTRATO',
                    showConfirmButton: false,
                    timer: 3000
                })
                document.getElementById("codigo_etiqueta").value = "";
            }
        })
           
        var table2 = $('.dosimetros').DataTable({
            language: {
                "decimal": "",
                "emptyTable": "NO HAY REGISTROS",
                "info": "MOSTRANDO REGISTROS DEL  _START_ AL _END_ DE UN TOTAL DE  _TOTAL_ REGISTROS",
                "infoEmpty": "MOSTRANDO 0 to 0 DE 0 REGISTROS",
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
            "dom": 'lrtip'
        });
        $('#codigo_dosimetro', this).on('keyup change', function(){
            if(table2.column(0).search() !== this.value){
                table2
                    .column(0)
                    .search(this.value)
                    .draw();
            }
        });
        $('#codigo_dosimetro').on('change', function(){
            var codigo_dosi = $(this).val();
            console.log(codigo_dosi);
            if(codigo_dosi != ''){

                $.get('dosimetro',{codigo_dosi : codigo_dosi}, function(dosimetro){
                    console.log(dosimetro);
                    if(dosimetro.length != 0 ){
                        
                        var cheq = 0;
                        @foreach($trabajdosiasig as $trabj)
                            if(dosimetro[0].codigo_dosimeter =='{{$trabj->dosimetro->codigo_dosimeter}}' && dosimetro[0].uso_dosimetro == '{{$trabj->ubicacion}}' && dosimetro[0].estado_dosimetro == 'EN USO'){
                                let tr = document.getElementById('{{$trabj->id_trabajadordosimetro}}'); 
                                tr.style.boxShadow = "0px 0px 10px 1px rgb(109, 250, 100)";
                                cheq = 1;
                                
                                Swal.fire({
                                    icon: 'success',
                                    title: 'CORRECTO!!',
                                    text: 'SI SE ENCUENTRA RELACIONADO ESTE DOSÍMETRO Y ADEMAS COINCIDE SU UBICACIÓN',
                                    showConfirmButton: false,
                                    timer: 4000
                                })
                                document.getElementById("codigo_dosimetro").value = "";
                                $.get('trabajadordosimetro', {id_trabajadordosimetro: '{{$trabj->id_trabajadordosimetro}}'}, function(trabajadordosi){
                                    console.log("SE HIZO EL CHECK"+trabajadordosi);
                                })
                            }
                        @endforeach
                        if(cheq == 0){
                            
                            Swal.fire({
                                icon: 'error',
                                title: 'ERROR!!',
                                text: 'NO SE ENCUENTRA RELACIONADO ESTE DOSÍMETRO',
                                showConfirmButton: false,
                                timer: 3000
                            })
                            document.getElementById("codigo_dosimetro").value = "";
                        }
                        console.log(cheq);
                    }else{
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!!',
                            text: 'NO EXISTE NINGUN DOSÍMETRO CON ESE CODIGO',
                            showConfirmButton: false,
                            timer: 3000
                        })
                        document.getElementById("codigo_dosimetro").value = " ";
                    }
                    
                })
            }

        })
        
    })
</script>
@endsection