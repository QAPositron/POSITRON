@extends('layouts.plantillabase')
@section('contenido')
<div class="row">
    <div class="col"></div>
    <div class="col-4">
        <div class="card text-dark bg-light">
            <h2 class="text-center mt-3">CREAR HOLDER</h2>
            <form class="m-4" action="{{route('holders.save')}}" method="POST">

                @csrf

                <div class="row g-2">
                    <div class="col-md">
                        <div class="form-floating ">
                            <input type="number" class="form-control"  name="codigo_holder" id="codigo_holder" value="{{old('codigo_holder')}}" autofocus style="text-transform:uppercase;">
                            <label for="floatingInputGrid"> CODIGO:</label>
                            @error('codigo_holder')
                                <small>*{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <br>
                <div class="row g-2">
                    <div class="col-md">
                        <div class="form-floating">
                            <select class="form-select" name="tipo_holder" id="tipo_holder" value="{{old('tipo_holder')}}" autofocus style="text-transform:uppercase">
                                <option value="">--SELECCIONE--</option>
                                <option value="ANILLO">ANILLO</option>
                                <option value="PULCERA">PULCERA</option>
                                <option value="CRISTALINO">CRISTALINO</option>
                            </select>
                            <label for="floatingInputGrid"> TIPO:</label>
                            @error('tipo_holder')
                                <small>*{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <br>
                <div class="row g-2">
                    <div class="col-md">
                        <div class="form-floating ">
                            <select class="form-select  form-select-solid" name="estado_holder" id="estado_holder" data-control="select2" data-placeholder="Select an option" value="{{old('estado_holder')}}" autofocus style="text-transform:uppercase">
                                <option value="">--SELECCIONE--</option>
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
                        <button class="btn btn-primary " type="submit" id="boton-asignar" name="boton-asignar">GUARDAR</button>
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
<script>
    $(document).ready(function() {
        $('#estado_holder').select2();
        $('#tipo_holder').select2();
    });
</script>
@endsection 