@extends('layouts.plantillabase')
@section('contenido')
<div class="row">
    <div class="col"></div>
    <div class="col-4">
        <div class="card text-dark bg-light">
            <h2 class="text-center mt-3">EDITAR HOLDER</h2>
            <form class="m-4" id="form_edit_holder" name="form_edit_holder" action="{{route('holders.update', $holder)}}" method="POST">

                @csrf

                @method('put')

                <div class="row g-2">
                    <div class="col-md">
                        <div class="form-floating ">
                            <input type="number" class="form-control"  name="codigo_holder" id="codigo_holder" value="{{old('codigo_holder', $holder->codigo_holder)}}" autofocus style="text-transform:uppercase;">
                            <label for="floatingInputGrid"> CODIGO HOLDER:</label>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row g-2">
                    <div class="col-md">
                        <div class="form-floating ">
                            <select class="form-select" name="tipo_holder" id="tipo_holder" value="{{old('tipo_holder', $holder->tipo_holder)}}" autofocus style="text-transform:uppercase">
                                <option value="{{$holder->tipo_holder}}">{{old('tipo_holder', $holder->tipo_holder)}}</option>
                                <option value="ANILLO">ANILLO</option>
                                <option value="EXTREM.">EXTREMIDAD</option>
                                <option value="CRISTALINO">CRISTALINO</option>
                            </select>
                            <label for="floatingInputGrid"> TIPO HOLDER:</label>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row g-2">
                    <div class="col-md">
                        <div class="form-floating ">
                            <select class="form-select" name="estado_holder" id="estado_holder" value="{{old('estado_holder')}}" autofocus style="text-transform:uppercase">
                                <option value="{{$holder->estado_holder}}">{{old('estado_holder', $holder->estado_holder)}}</option>
                                <option value="STOCK">STOCK</option>
                                <option value="PERDIDO">PERDIDO</option>
                                <option value="DAÑADO">DAÑADO</option>
                                <option value="EN USO">EN USO</option>
                            </select>
                            <label for="floatingInputGrid"> ESTADO:</label>
                            @error('estado_holder')
                                <small>*{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <BR></BR>
                <div class="row ">
                    <div class="col"></div>
                    <div class="col d-grid gap-2">
                        <button class="btn colorQA " type="submit" id="boton-guardar" name="boton-guardar">ACTUALIZAR</button>
                    </div>
                    <div class="col d-grid gap-2">
                        <a href="{{route('empresas.search')}}" class="btn btn-danger " type="button" id="cancelar" name="cancelar" role="button">CANCELAR</a>
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
    $('#form_edit_holder').submit(function(e){
        e.preventDefault();
        Swal.fire({
            text: 'SEGURO QUE DESEA ACTUALIZAR LA INFORMACIÓN DE ESTE HOLDER?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'SI!'
        }).then((result) => {
            if (result.isConfirmed) {
               /*  Swal.fire(
                'ACTUALIZADA!',
                'SE HA ACTUALIZADO UNA EMPRESA.',
                'success'
                ) */
                this.submit(); 
            }
        })
    })
})
</script>
@endsection 