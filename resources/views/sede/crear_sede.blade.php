@extends('layouts.plantillabase')
@section('contenido')
<div class="row">

    <div class="col"></div>
    <div class="col-6">
        <div class="card text-dark bg-light" >
            <h2 class="text-center mt-3">CREAR SEDE</h2>

            <form class="m-4" action="{{route('sedes.save')}}" method="POST">
            
                @csrf

                <div class="row g-2">
                    <div class="col-md">
                        <div class="form-floating text-wrap">
                            <select class="form-select" name="id_empresa" id="id_empresa" autofocus aria-label="Floating label select example">
                                <option value="{{$empresa->id_empresa}}">{{$empresa->nombre_empresa}}</option>
                            </select>
                            <label for="floatingSelectGrid">EMPRESA:</label>
                            @error('id_empresa')
                                <small>*{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-floating text-wrap">
                            <input type="text" class="form-control"  name="nombre_sede" id="nombre_sede"  autofocus style="text-transform:uppercase;">
                            <label for="floatingInputGrid">NOMBRE DE LA SEDE:</label>
                            @error('nombre_sede')
                                <small>*{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <br>
                <div class="row g-2">
                    <div class="col-md">
                        <div class="form-floating text-wrap">
                            <input type="text" class="form-control"   name="municipio_sede" id="municipio_sede"  autofocus style="text-transform:uppercase;">
                            <label for="floatingInputGrid">MUNICIPIO:</label>
                            @error('municipio_sede')
                                <small>*{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-floating text-wrap">
                            <input type="text" class="form-control"   name="departamento_sede" id="departamento_sede" autofocus style="text-transform:uppercase;">
                            <label for="floatingInputGrid">DEPARTAMENTO:</label>
                            @error('departamento_sede')
                                <small>*{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <br>
                <div class="form-floating text-wrap">
                    <input type="text" name="direccion_sede" id="direccion_sede" class="form-control"  autofocus style="text-transform:uppercase;">
                    <label for="">DIRECCIÓN:</label>
                </div>
                <br>
                <div class="row">
                    <div class="col"></div>
                    <div class="col d-grid gap-2">
                        <input class="btn btn-primary " type="submit" id="boton-guardar" name="boton-guardar" value="GUARDAR">
                    </div>
                    <div class="col"></div>
                </div>
            </form>
        </div>
    </div>
    <div class="col"></div>    
</div>
@endsection 