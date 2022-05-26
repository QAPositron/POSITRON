@extends('layouts.plantillabase')
@section('contenido')

<div class="row">
    <div class="col">
        <a href="{{route('contactos.create')}}" class="btn colorQA btn-sm m-4">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
            </svg> CREAR CONTACTO
        </a>
    </div>
    <div class="col"></div>
</div>

<div class="row ">
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
                            <input class="btn colorQA " type="submit" id="submit" name="submit" value="BUSCAR">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col"></div>
    </div>
    
    <div class="row pt-5" id ="salida">
    <h3 class="text-center">TODOS LOS CONTACTOS</h3>
    <br>
    <br>
    <table class="table table-hover table-bordered">
        <thead class='table-active text-center'>
            {{-- <th scope='col'  style='width: 18.60%'>SEDE</th>
            <th scope='col'  style='width: 18.60%'>EMPRESA</th> --}}
            <th class="align-middle" scope='col'  style='width: 18.60%'>CONTACTO</th>
            <th class="align-middle" scope='col'>TIPO IDEN</th>
            <th class="align-middle" scope='col'>N. IDEN CONTACTO</th>
            <th class="align-middle" scope='col'>GÉNERO</th>
            <th class="align-middle" scope='col'>EMAIL</th>
            <th class="align-middle" scope='col'>TELEFONO</th>
            <th class="align-middle" scope='col'>PERFIL LABORAL</th>
            <th class="align-middle" scope='col'>EMPRESA - SEDE RELACIONADAS</th>
            <th class="align-middle" scope='col' style='width: 9.60%'>ACCIONES</th>
        </thead>
        @foreach($contactosede as $contsed)
            <tr>
                {{-- <td>{{$contsed->sede->empresa->nombre_empresa}}</td>
                <td>{{$contsed->sede->nombre_sede}}</td> --}}
                <td class="align-middle">{{$contsed->primer_nombre_contacto}} {{$contsed->segundo_nombre_contacto}} {{$contsed->primer_apellido_contacto}} {{$contsed->segundo_apellido_contacto}}</td>
                <td class="align-middle">{{$contsed->tipo_iden_contacto}}</td>
                <td class="text-center align-middle">{{$contsed->cedula_contacto}}</td>
                <td class="align-middle">{{$contsed->genero_contacto}}</td>
                <td class="align-middle">{{$contsed->correo_contacto}}</td>
                <td class="align-middle">{{$contsed->telefono_contacto}}</td>
                <td class="align-middle">
                    {{$contsed->profesion_contacto}}
                    <br> 
                    @if($contsed->lider_ava == 'TRUE')
                        <B>(LIDER A. VIRTUAL)</B>
                        <br>
                    @endif
                    @if($contsed->lider_dosimetria == 'TRUE')
                        <B>(LIDER DOSIMETRÍA)</B>
                    @endif
                </td>
                <td class="text-center align-middle">
                    @if($contsed->nombre_empresa == '' && $contsed->nombre_sede == '')
                        {{-- <i>NO HAY RELACION CON EMPRESAS Y SEDES</i>  --}}
                    @else
                       <b> {{$contsed->nombre_empresa}}</b> - {{$contsed->nombre_sede}}
                       @endif
                </td>
                    <td  class="align-middle">
                        <div class="row">
                        <div class="col">
                            <a href="{{route('contactos.edit', $contsed->id_contacto)}}" class="btn btn-secondary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill mb-1" viewBox="0 0 16 16">
                                    <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                </svg>
                            </a>
                        </div>
                        <div class="col">
                            <form class="form_eliminar_contacto" id="form_eliminar_contacto" name="form_eliminar_contacto" action="{{route('contactos.destroy', $contsed->id_contacto)}}" method="POST">
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
        'GUARDADO!',
        'SE HA GUARDADO CON ÉXITO.',
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
        $('.form_eliminar_contacto').submit(function(e){
            e.preventDefault();
            Swal.fire({
                text: "SEGURO QUE DESEA ELIMINAR ESTE CONTACTO??",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'SI!'
                }).then((result) => {
                if (result.isConfirmed) {
                    
                    this.submit();
                }
            })
        })
    })
</script>
@endsection