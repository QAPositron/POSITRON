@extends('layouts.plantillabase')
@section('contenido')

<div class="row">
    <div class="col"></div>
    <div class="col-8">
        <div class="card text-dark bg-light">
            <h2 class="text-center mt-3">ASIGNAR DOSÍMETRO</h2>
            <form class="m-4" action="" method="POST">

                @csrf

                <div class="row g-2">
                    <div class="col-md">
                        <div class="form-floating ">
                            <select class="form-select" name="id_empresa_asigdosim" id="id_empresa_asigdosim"  autofocus aria-label="Floating label select example">
                                <option value="">--SELECCIONE--</option>
                                @foreach($empresas as $emp)
                                    <option value ="{{ $emp->id_empresa}}">{{$emp->nombre_empresa}}</option>
                                @endforeach
                            </select>
                            <label for="floatingSelectGrid">EMPRESA:</label>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-floating">
                            <select class="form-select" name="id_sede_asigdosim" id="id_sede_asigdosim" autofocus aria-label="Floating label select example">
                            </select>
                            <label for="floatingSelectGrid">SEDE:</label>
                        </div>
                    </div>
                </div>
                <div class="row g-2">
                    <div class="col-md">
                        <div class="table table-responsive p-4 ">
                            <table class="table table-bordered">
                                <thead class="text-center">
                                    <th>DOSíMETROS</th>
                                    <th>CONTRATADOS</th>
                                    <th>ASIGNADOS</th>
                                    <th>PENDIENTES</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>AMBIENTE:</th>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th>CUERPO:</th>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th>EzCLIP:</th>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th>CONTROL:</th>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row g-2">
                    <div class="col-md">
                        <div class="form-floating">
                            <input type="date" class="form-control" name="primerDia_asigdosim" id="primerDia_asigdosim" >
                            <label for="floatingInputGrid">PRIMER DÍA</label>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-floating">
                            <input type="date" class="form-control" name="ultimoDia_asigdosim" id="ultimoDia_asigdosim" >
                            <label for="floatingInputGrid">ULTIMO DÍA:</label>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row g-2">
                    <div class="col-md">
                        <div class="form-floating">
                            <input type="date" class="form-control" name="ocupacion_asigdosim" id="ocupacion_asigdosim" >
                            <label for="floatingInputGrid">OCUPACIÓN</label>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-floating">
                            <input type="date" class="form-control" name="energia_asigdosim" id="energia_asigdosim" >
                            <label for="floatingInputGrid">ENERGÍA:</label>
                        </div>
                    </div>
                </div>
                <div class="row g-2">
                    <div class="col-md">
                        <div class="table table-responsive p-4 ">
                            <table class="table table-bordered">
                                <thead class="text-center">
                                    <th>NOMBRES</th>
                                    <th>APELLIDOS</th>
                                    <th style='width: 15.55%'>No. IDEN.</th>
                                    <th style='width: 20.60%'>DOSÍMETRO</th>
                                    <th style='width: 20.60%'>HOLDER</th>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                
            </form>
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
    
    $(document).ready(function(){

        
    
        $('#id_empresas').on('change', function(){
            var empresa_id = $(this).val();
            alert(empresa_id);
            if($.trim(empresa_id) != ''){
                $.get('prueba2',{empresa_id : empresa_id}, function(sedes){
                    console.log(sedes);
                    $('#id_sedes').empty();
                    $('#id_sedes').append("<option value=''>--SELECCIONE UNA SEDE--</option>");
                    $.each(sedes, function(index, value){
                        $('#id_sedes').append("<option value='"+ index + "'>" + value + "</option>");
                    })
                });
            }
        });
        $('#id_sedes').on('change', function(){
            var sede_id = $(this).val();
            alert(sede_id);
            if($.trim(sede_id) != ''){
                $.get('prueba3',{sede_id : sede_id}, function(trabajadores){
                    console.log(trabajadores);
                    $('#id_trabajadores').empty();
                    $('#id_trabajadores').append("<option value=''>--SELECCIONE TRABAJADOR--</option>");
                    $.each(trabajadores, function(index, value){
                        $('#id_trabajadores').append("<option value='"+ index + "'>" + value + "</option>");
                    })
                });
            }
        });

    })
</script>
<script type="text/javascript">
    function obtenerTrabaj(trabajador_id){

        alert('el valor obtenido es' +trabajador_id);

        if($.trim(trabajador_id) != ''){
            $.get('prueba4',{trabajador_id : trabajador_id}, function(tablatrabajador){
                console.log(tablatrabajador);
                /* $('#id_trabajadores').empty();
                $('#id_trabajadores').append("<option value=''>--SELECCIONE TRABAJADOR--</option>");
                $.each(trabajadores, function(index, value){
                    $('#id_trabajadores').append("<option value='"+ index + "'>" + value + "</option>");
                }) */ 
            });
        }
    }
    /* $('#envio').on('click', function(){
            var trabajador_id = $(this).val();
            alert (trabajador_id);
            if($.trim(trabajador_id) != ''){
                $.get('prueba4',{trabajador_id : trabajador_id}, function(tablatrabajador){
                    console.log(tablatrabajador);
                    $('#id_trabajadores').empty();
                    $('#id_trabajadores').append("<option value=''>--SELECCIONE TRABAJADOR--</option>");
                    $.each(trabajadores, function(index, value){
                        $('#id_trabajadores').append("<option value='"+ index + "'>" + value + "</option>");
                    }) 
                });
            }
    }); */
    
</script>
@endsection 