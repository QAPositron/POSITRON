@extends('layouts.plantillabase')
@section('contenido')
<br>
<div class="row">
    <div class="col"></div>
    <div class="col/6">
        <div class="card text-dark bg-light">
            <form class="m-4" action="" method="POST">
                @csrf
                <label>EMPRESA:</label>
                <select class="form-select" name="id_empresas" id="id_empresas"  autofocus aria-label="Floating label select example">
                    <option value="">--SELECCIONE--</option>
                    @foreach($empresas as $emp)
                        <option value ="{{ $emp->id_empresa }}">{{$emp->nombre_empresa}}</option>
                    @endforeach
                </select>
                <select class="form-select" name="id_sedes" id="id_sedes">
                </select>
            </form>
            <form action="">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="checkbox1">
                    <label for="checkbox1" class="custom-control-label" > 1Check this custom checkbox</label>
                    <div class="invalid-feedback">Example invalid feedback text</div>
                </div>
            </form>
            <form action="">
                <div class="form-check">
                    <input class="form-ckeck-input" type="checkbox"  id="customCheck1" name="customCheck1">
                    <label class="form-ckeck-label" for="customCheck1">2Check this custom checkbox</label>
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
        /* const $empresa = document.querySelector("#id_empresas");
        const $sede = document.querySelector("#id_sedes");
        
        $empresa.addEventListener('change', function(){
            const codEmpresa = $empresa.value
            alert(codEmpresa);
            const sendDatos = {
                'codigoEmp' : codEmpresa,
            }
            
            cargarSedes(sendDatos);
        }); */
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
        /* function cargarSedes(sendDatos) {
        $.ajax({
            type: "GET",
            url: "prueba2",
            data: sendDatos,
            success: function (sedes) {
                console.log(sedes);
                $sede.empty();
                $sede.append("<option value=''>--SELECCIONE UNA SEDE--</option>");
                $.each(sedes, function(index, value){
                    $sede.append("<option value='" + index +" '>"+ value +"</option>");
                })
                 const sedes = JSON.parse(response);
                let template = '<option class="form-control" selected disabled>--SELECCIONE--</option>'

                sedes.forEach(sede => {
                template += `<option value="${sede.i    dSede}">${sede.nombreSede}</option>`;
                })
                $sede.innerHTML= template;
            }
        }); */
    })

    
</script>