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
    <h3 class="text-center">TODAS LAS SEDES</h3>
    <table class="table table-hover table-bordered">
        <thead>
            <th scope='col'  style='width: 18.60%'>SEDE</th>
            <th scope='col'  style='width: 18.60%'>EMPRESA</th>
            <th scope='col'>TIPO IDENTIFICACIÓN</th>
            <th scope='col'>N. IDENTIFICACIÓN</th>
            <th scope='col'>MUNICIPIO</th>
            <th scope='col'>DEPARTAMENTO</th>
            <th scope='col'>DIRECCIÓN</th>
            <th scope='col' style='width: 9.60%'>ACCIONES</th>
        </thead>
        @foreach($sedes as $sed)
            <tr>
                <td>{{$sed->nombre_sede}}</td>
                <td>{{$sed->empresa->nombre_empresa}}</td>
                <td>{{$sed->empresa->tipo_identificacion_empresa}}</td>
                <td>{{$sed->empresa->num_iden_empresa}}</td>
                <td>{{$sed->municipio_sede}}</td>
                <td>{{$sed->departamento_sede}}</td>
                <td>{{$sed->direccion_sede}}</td>
                <td>
                    <div class="row">
                        <div class="col">
                            <a href="{{route('sedes.edit', $sed->id_sede)}}" class="btn btn-secondary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill mb-1" viewBox="0 0 16 16">
                                    <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                </svg>
                            </a>
                        </div>
                        <div class="col">
                            <form  action="{{route('sedes.destroy', $sed)}}" method="POST">
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

@endsection()