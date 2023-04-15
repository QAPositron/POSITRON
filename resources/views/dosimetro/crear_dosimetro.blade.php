@extends('layouts.app')
@extends('layouts.plantillabase')
@section('contenido')
<div class="row">
    <div class="col"></div>
    <div class="col-4">
        <div class="card text-dark bg-light">
            <h2 class="text-center mt-3">CREAR DOSIMETRO</h2>

            <form class="m-4" id="form_create_dosimetro" name="form_create_dosimetro" action="{{route('dosimetros.save')}}" method="POST">

                @csrf

                <div class="row g-2">

                    <div class="col-md">
                        <div class="form-floating" >
                            <select class="form-select" name="tipo_dosimetro" id="tipo_dosimetro" value="{{old('tipo_dosimetro')}}" autofocus style="text-transform:uppercase">
                                <option value="">--SELECCIONE--</option>
                                <option value="GENERAL">GENERAL</option>
                                <option value="AMBIENTAL">AMBIENTAL</option>
                                <option value="EZCLIP">EZCLIP</option>
                            </select>
                            <label for="floatingInputGrid">TIPO:</label>
                            @error('tipo_dosimetro')
                                <small>*{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <br>
                <div class="row g-2">
                    <div class="col-md">
                        <div class="form-floating">
                            <select class="form-select" name="tecnologia_dosimetro" id="tecnologia_dosimetro" value="{{old('tecnologia_dosimetro')}}" autofocus  style="text-transform:uppercase">
                                <option value="">--SELECCIONE--</option>
                                <option value="OSL">OSL</option>
                                <option value="TLD">TLD</option>
                                <option value="ELECTRÓNICO">ELECTRÓNICO</option>
                            </select>
                            <label for="floatingInputGrid">TECNOLOGÍA:</label>
                            @error('tecnologia_dosimetro')
                                <small>*{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <br>
                <div class="row g-2">
                    <div class="col-md">
                        <div class="form-floating" >
                            <input type="numeric" name="codigo_dosimetro" id="codigo_dosimetro" class="form-control" value="{{old('codigo_dosimetro')}}" autofocus >
                            <label for="floatingInputGrid">CODIGO:</label>
                            @error('codigo_dosimetro')
                                <small>*{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <br>
                <div class="row g-2">
                    <div class="col-md">
                        <div class="form-floating">
                            <input type="date" name="fecha_ingre_serv_dosimetro" id="fecha_ingre_serv_dosimetro" class="form-control" value="{{old('fecha_ingre_serv_dosimetro')}}" autofocus style="text-transform:uppercase;">
                            <label for="floatingInputGrid">FECHA INGRESO AL SERVICIO:</label>
                            @error('fecha_ingre_serv_dosimetro')
                                <small>*{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <br>
                <div class="row g-2">
                    <div class="col-md">
                        <div class="form-floating">
                            <select class="form-select" name="estado_dosimetro" id="estado_dosimetro" value="{{old('estado_dosimetro')}}" autofocus  style="text-transform:uppercase">
                                <option value="">--SELECCIONE--</option>
                                <option value="STOCK">STOCK</option>
                                <option value="PERDIDO">PERDIDO</option>
                                <option value="DAÑADO">DAÑADO</option>
                                <option value="EN USO">EN USO</option>
                            </select>
                            <label for="floatingInputGrid">ESTADO DOSÍMETRO:</label>
                            @error('estado_dosimetro')
                                <small>*{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <br>
                 <!---------BOTON------------->
                <div class="row">
                    <div class="col"></div>
                    <div class="col d-grid gap-2">
                        <button class="btn colorQA" type="submit" id="boton-guardar" name="boton-guardar">GUARDAR</button>
                    </div>
                    <div class="col d-grid gap-2">
                        <a href="{{route('dosimetros.search')}}" class="btn btn-danger " type="button" id="cancelar" name="cancelar" role="button">CANCELAR</a>
                    </div>
                    <div class="col"></div>
                </div>
            </form>
        </div>
        <br>
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
        $('#form_create_dosimetro').submit(function(e){
            e.preventDefault();
            Swal.fire({
                text: "DESEA GUARDAR ESTE DOSIÍMETRO??",
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
