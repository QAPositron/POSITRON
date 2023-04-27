@extends('layouts.app')
@extends('layouts.plantillabase')
@section('contenido')
<div class="row">
    <div class="col"></div>
    <div class="col-4">
        <div class="card text-dark bg-light">
            <h2 class="text-center mt-3">CREAR HOLDER</h2>
            <form class="m-4" id="form_create_holder" name="form_create_holder" action="{{route('holders.save')}}" method="POST">

                @csrf

                <div class="row g-2">
                    <label class="text-secondary">' * ' campo obligatorio</label>
                    <div class="col-md">
                        <div class="form-floating ">
                            <input type="text" class="form-control @error('codigo_holder') is-invalid @enderror"  name="codigo_holder" id="codigo_holder" value="{{old('codigo_holder')}}" autofocus style="text-transform:uppercase;">
                            <label for="floatingInputGrid">* CODIGO:</label>
                            @error('codigo_holder') <span class="invalid-feedback">*{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
                <br>
                <div class="row g-2">
                    <div class="col-md">
                        <div class="form-floating">
                            <select class="form-select @error('tipo_holder') is-invalid @enderror" name="tipo_holder" id="tipo_holder" value="{{old('tipo_holder')}}" autofocus style="text-transform:uppercase">
                                <option value="">--SELECCIONE--</option>
                                <option value="ANILLO" @if (old('tipo_holder') == "ANILLO") {{ 'selected' }} @endif>ANILLO</option>
                                <option value="EXTREM" @if (old('tipo_holder') == "EXTREM") {{ 'selected' }} @endif>EXTREMIDAD</option>
                                <option value="CRISTALINO" @if (old('tipo_holder') == "CRISTALINO") {{ 'selected' }} @endif>CRISTALINO</option>
                            </select>
                            <label for="floatingInputGrid">* TIPO:</label>
                            @error('tipo_holder') <span class="invalid-feedback">*{{ $message }}</span> @enderror

                        </div>
                    </div>
                </div>
                <br>
                <div class="row g-2">
                    <div class="col-md">
                        <div class="form-floating">
                            <select class="form-select @error('estado_holder') is-invalid @enderror" name="estado_holder" id="estado_holder"  value="{{old('estado_holder')}}" autofocus style="text-transform:uppercase">
                                <option value="">--SELECCIONE--</option>
                                <option value="STOCK" @if (old('estado_holder') == "STOCK") {{ 'selected' }} @endif selected>STOCK</option>
                                <option value="PERDIDO" @if (old('estado_holder') == "PERDIDO") {{ 'selected' }} @endif>PERDIDO</option>
                                <option value="DAÑADO" @if (old('estado_holder') == "DAÑADO") {{ 'selected' }} @endif>DAÑADO</option>
                                <option value="EN USO" @if (old('estado_holder') == "EN USO") {{ 'selected' }} @endif>EN USO</option>
                            </select>
                            <label for="floatingInputGrid">* ESTADO:</label>
                            @error('estado_holder') <span class="invalid-feedback">*{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
                <br>
                <div class="row ">
                    <div class="col"></div>
                    <div class="col d-grid gap-2">
                        <button class="btn colorQA" type="submit" id="boton-asignar" name="boton-asignar">GUARDAR</button>
                    </div>
                    <div class="col d-grid gap-2">
                        <a href="{{route('dosimetros.search')}}" class="btn btn-danger " type="button" id="cancelar" name="cancelar" role="button">CANCELAR</a>
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
        
        $('#form_create_holder').submit(function(e){
            e.preventDefault();
            Swal.fire({
                text: "DESEA GUARDAR ESTE HOLDER??",
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
@endsection 