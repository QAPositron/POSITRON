@extends('layouts.plantillabase')
@section('contenido')
<div class="row">
    <div class="col">
        <a href="{{route('empresas.create')}}" class="btn colorQA btn-sm">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
            </svg> CREAR EMPRESA
        </a>
    </div>
    <div class="col"></div>
</div>

    
<div class="row pt-3" id ="salida">
    <h2 class="text-center">TODAS LAS EMPRESAS</h2>
    <BR></BR>
    <table class="table table-responsive hover table-bordered" id="empresas">
        <thead class="table-active text-center">
            <th scope='col'  style='width: 18.60%'>NOMBRE</th>
            <th scope='col'>TIPO IDENTIFICACIÓN</th>
            <th scope='col'>N. IDENTIFICACIÓN</th>
            <th scope='col'>CIUDAD</th>
            <th scope='col'>DIRECCIÓN</th>
            <th scope='col'>EMAIL</th>
            <th scope='col' style='width: 12.60%'>ACCIONES</th>
        </thead>
        @foreach($empresa as $emp)
            <tr>
                <td class="align-middle"><a class="link-dark" href="{{route('empresas.info', $emp->id_empresa)}}">{{$emp->nombre_empresa}}</a></td>
                <td class="align-middle">{{$emp->tipo_identificacion_empresa}}</td>
                <td class="align-middle text-center">{{$emp->num_iden_empresa}}  {{$emp->DV}}</td>
                <td class="align-middle text-center">{{$emp->municipios->nombre_municol}}</td>
                <td class="align-middle text-center">{{$emp->direccion_empresa}}</td>
                <td class="align-middle text-center">{{$emp->email_empresa}}</td>
                <td class="align-middle text-center">
                    <div class="row">
                        <div class="col">
                            <a href="{{route('empresas.edit', $emp->id_empresa)}}" class="btn colorQA">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill mb-1" viewBox="0 0 16 16">
                                    <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                </svg>
                            </a>
                        </div>
                        <div class="col">
                            <form id="form_eliminar_empresa" name="form_eliminar_empresa" action="{{route('empresas.destroy', $emp)}}" method="POST">
                                @csrf  
                                @method('delete')
                                <button class="btn btn-danger" onclick="Eliminar(evt);" type="submit">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
    </table>
</div>
<script
src="https://code.jquery.com/jquery-3.6.0.js"
integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
crossorigin="anonymous">
</script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('guardar')== 'ok')
    <script>
        Swal.fire(
        'GUARDADA!',
        'SE HA GUARDADO CON ÉXITO.',
        'success'
        )
    </script>
@endif
@if(session('actualizar')== 'ok')
    <script>
        Swal.fire(
        'ACTUALIZADA!',
        'SE HA ACTUALIZADO CON ÉXITO.',
        'success'
        )
    </script>
@endif
@if(session('eliminar')== 'ok')
    <script>
        Swal.fire(
        'ELIMINADO!',
        'SE HA ELIMINADO CON ÉXITO.',
        'success'
        )
    </script>
@endif
<script type="text/javascript">
    $(document).ready(function(){

        $('#form_eliminar_empresa').submit(function(e){
            e.preventDefault();
            Swal.fire({
                text: "SEGURO QUE DESEA ELIMINAR ESTA EMPRESA??",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'SI, SEGURO!'
                }).then((result) => {
                if (result.isConfirmed) {
                   
                    this.submit();
                }
            })
        })
        $('#empresas').DataTable({
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
        });
    })
</script>


@endsection()