@extends('layouts.plantillabase')
@section('contenido')
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
                            <input class="btn btn-primary " type="submit" id="submit" name="submit" value="BUSCAR">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col"></div>
    </div>
    
    <div class="row pt-5" id ="salida">
    <h3 class="text-center">TODOS LOS CONTACTOS</h3>
    <table class="table table-hover table-bordered">
        <thead>
            <th scope='col'  style='width: 18.60%'>SEDE</th>
            <th scope='col'  style='width: 18.60%'>EMPRESA</th>
            <th scope='col'  style='width: 18.60%'>CONTACTO</th>
            <th scope='col'>N. IDEN CONTACTO</th>
            <th scope='col'>GÉNERO</th>
            <th scope='col'>EMAIL</th>
            <th scope='col'>TELEFONO</th>
            <th scope='col'>PERFIL LABORAL</th>
            <th scope='col' style='width: 10.60%'>ACCIONES</th>
        </thead>
        @foreach($contactosede as $contsed)
            <tr>
                <td>{{$contsed->sede->empresa->nombre_empresa}}</td>
                <td>{{$contsed->sede->nombre_sede}}</td>
                <td>{{$contsed->contacto->primer_nombre_contacto}} {{$contsed->contacto->segundo_nombre_contacto}} {{$contsed->contacto->primer_apellido_contacto}} {{$contsed->contacto->segundo_apellido_contacto}}</td>
                <td>{{$contsed->contacto->cedula_contacto}}</td>
                <td>{{$contsed->contacto->genero_contacto}}</td>
                <td>{{$contsed->contacto->email_contacto}}</td>
                <td>{{$contsed->contacto->telefono_contacto}}</td>
                <td>{{$contsed->contacto->tipo_contacto}}</td>
                <td>
                    <div class="row">
                        <div class="col">
                            <a href="{{route('contactos.edit', $contsed->contacto_id)}}" class="btn btn-secondary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen-fill" viewBox="0 0 16 16">
                                <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001z"/>
                                </svg>
                            </a>
                        </div>
                        <div class="col">
                            <form  action="{{route('contactos.destroy', $contsed)}}" method="POST">
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
<script type="text/javascript">
    function Eliminar(evt) {
        evt.preventDefault();
    }
</script>
@endsection