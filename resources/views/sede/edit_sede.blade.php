@extends('layouts.plantillabase')
@section('contenido')
    <div class="row">
        <div class="col"></div>
        <div class="col-6">
            <div class="card text-dark bg-light" >
                <h2 class="text-center mt-3">EDITAR SEDE</h2>

                <form class="m-4" id='form_edit_sede' name='form_edit_sede' action="{{route('sedes.update', $sede)}}" method="POST">
                
                    @csrf

                    @method('put')

                    <div class="row g-2">
                        <div class="col-md">
                            <div class="form-floating text-wrap">
                                <input type="text" class="form-control"   name="empresas_id" id="empresas_id" value="{{old('empresas_id', $sede->empresa->nombre_empresa)}}" autofocus style="text-transform:uppercase;" disabled>
                                <label for="floatingSelectGrid">EMPRESA:</label>
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="form-floating text-wrap">
                                <input type="text" class="form-control"  name="nombre_sede" id="nombre_sede" value="{{old('nombre_sede', $sede->nombre_sede)}}" autofocus style="text-transform:uppercase;">
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
                                <input type="text" class="form-control"   name="municipio_sede" id="municipio_sede" value="{{old('municipio_sede', $sede->municipios->nombre_municol)}}" autofocus style="text-transform:uppercase;">
                                <label for="floatingInputGrid">MUNICIPIO:</label>
                                @error('municipio_sede')
                                    <small>*{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="form-floating text-wrap">
                                <input type="text" class="form-control"   name="departamento_sede" id="departamento_sede" value="{{old('departamento_sede', $sede->municipios->coldepartamento->nombre_deptocol)}}"  autofocus style="text-transform:uppercase;">
                                <label for="floatingInputGrid">DEPARTAMENTO:</label>
                                @error('departamento_sede')
                                    <small>*{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="form-floating text-wrap">
                        <input type="text" name="direccion_sede" id="direccion_sede" class="form-control" value="{{old('direccion_sede', $sede->direccion_sede)}}" autofocus style="text-transform:uppercase;">
                        <label for="">DIRECCIÓN:</label>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col"></div>
                        <div class="col d-grid gap-2">
                            <button class="btn colorQA" type="submit" id="boton-guardar" name="boton-guardar">ACTUALIZAR</button>
                        </div>
                        <div class="col d-grid gap-2">
                            <a href="{{route('empresas.search')}}" class="btn btn-danger" type="button" id="cancelar" name="cancelar" role="button">CANCELAR</a>
                        </div>
                        <div class="col"></div>
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
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>   
       
<script type="text/javascript">
$(document).ready(function(){
    $('#form_edit_sede').submit(function(e){
        e.preventDefault();
        Swal.fire({
            text: 'SEGURO QUE DESEA ACTUALIZAR LA INFORMACIÓN DE ESTA SEDE?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'SI!'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                'ACTUALIZADA!',
                'SE HA ACTUALIZADO LA SEDE.',
                'success'
                )
                this.submit(); 
            }
        })
    })
})
</script> 
@endsection