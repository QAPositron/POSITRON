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
<div class="row">
    <div class="col"></div>
    <div class="col">
        <div class="card text-dark bg-light" style="max-width: 25rem;">
            <h3 class="pt-4 text-center">BUSCAR</h3>
            <form class="m-4"action="">
                <label for="exampleFormControlInput1" class="form-label">PALABRA CLAVE: </label>
                <div class="row">
                    <div class="col-8">
                        <input class="form-control" type="text" name="busqueda" id="busqueda" placeholder="--BUSCAR--" autofocus style="text-transform:uppercase;">
                    </div>
                    <div class="col">
                        <input class="btn colorQA" type="submit" id="submit" name="submit" value="BUSCAR">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="col"></div>
</div>
    
<div class="row pt-5" id ="salida">
    <h3 class="text-center">TODAS LAS EMPRESAS</h3>
    <BR></BR>
    <table class="table table-responsive hover table-bordered">
        <thead class="table-active text-center">
            <th scope='col'  style='width: 18.60%'>NOMBRE</th>
            <th scope='col'>N. IDENTIFICACIÓN</th>
            <th scope='col'>TIPO IDENTIFICACIÓN</th>
            <th scope='col'>CIUDAD</th>
            <th scope='col'>DIRECCIÓN</th>
            <th scope='col'>EMAIL</th>
            <th scope='col' style='width: 9.60%'>ACCIONES</th>
        </thead>
        @foreach($empresa as $emp)
            <tr>
                <td><a class="link-dark" href="{{route('empresas.info', $emp->id_empresa)}}">{{$emp->nombre_empresa}}</a></td>
                <td>{{$emp->num_iden_empresa}}  {{$emp->DV}}</td>
                <td>{{$emp->tipo_identificacion_empresa}}</td>
                <td>{{$emp->municipios->nombre_municol}}</td>
                <td>{{$emp->direccion_empresa}}</td>
                <td>{{$emp->email_empresa}}</td>
                <td>
                    <div class="row">
                        <div class="col">
                            <a href="{{route('empresas.edit', $emp->id_empresa)}}" class="btn colorQA">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen-fill" viewBox="0 0 16 16">
                                <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001z"/>
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
    })
</script>


@endsection()