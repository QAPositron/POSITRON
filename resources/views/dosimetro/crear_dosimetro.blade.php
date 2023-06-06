@extends('layouts.app')
@extends('layouts.plantillabase')
@section('contenido')
<div class="row">
    <div class="col"></div>
    <div class="col-4">
        <div class="card text-dark bg-light">
            <h2 class="text-center mt-3">CREAR DOSÍMETRO</h2>
            {{-- @livewire('dosimetro-component') --}}
            <label class="text-secondary mx-4">' * ' campo obligatorio</label>
            <br>
            <div class="row g-2 mx-4">
                <div class="col-md">
                    <label >OPRIMA EL BOTON PARA INGRESAR EL CODIGO DE DOSÍMETRO:</label>
                </div>
                <div class="col-md-3 text-center p-0">
                    <button class="btn colorQA mt-1" onclick="agregarCodigo()">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z"/>
                        </svg>
                    </button>
                </div>
            </div>
            <form class="m-4" id="form_create_dosimetro" name="form_create_dosimetro" action="{{route('dosimetros.save')}}" method="POST">

                @csrf
                
                <div id="rowCodigo">
                    @if(count($errors) > 0)
                        @for ($i = 0; $i < count(old('codigo_dosimetro')); $i++)
                            <div class="row g-2" id="{{$i}}">
                                <div class="col-md">
                                    <div class="form-floating" >
                                        <input type="text" name="codigo_dosimetro[]" id="codigo_dosimetro" class="form-control @error('codigo_dosimetro.'.$i) is-invalid @enderror" value="{{old('codigo_dosimetro.'.$i)}}">
                                        <label for="floatingInputGrid">* CODIGO:</label>
                                        @error('codigo_dosimetro.'.$i) <span class="invalid-feedback">*{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-3  text-center">
                                    <button class="btn btn-danger mt-2" type="button" onclick="eliminarRow({{$i}})">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-trash " viewBox="0 0 16 16">
                                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                        </svg>
                                    </button>
                                </div>
                            </div><br>
                        @endfor
                    @endif
                </div>
                <div class="row g-2">
                    <div class="col-md">
                        <div class="form-floating" >
                            <select class="form-select @error('tipo_dosimetro') is-invalid @enderror" name="tipo_dosimetro" id="tipo_dosimetro" value="{{old('tipo_dosimetro')}}" autofocus style="text-transform:uppercase">
                                <option value="">--SELECCIONE--</option>
                                <option value="GENERAL" @if (old('tipo_dosimetro') == "GENERAL") {{ 'selected' }} @endif>GENERAL</option>
                                <option value="AMBIENTAL" @if (old('tipo_dosimetro') == "AMBIENTAL") {{ 'selected' }} @endif>AMBIENTAL</option>
                                <option value="EZCLIP" @if (old('tipo_dosimetro') == "EZCLIP") {{ 'selected' }} @endif>EZCLIP</option>
                            </select>
                            <label for="floatingInputGrid">* TIPO:</label>
                            @error('tipo_dosimetro') <span class="invalid-feedback">*{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
                <br>
                <div class="row g-2">
                    <div class="col-md">
                        <div class="form-floating">
                            <select class="form-select  @error('tecnologia_dosimetro') is-invalid @enderror" name="tecnologia_dosimetro" id="tecnologia_dosimetro" value="{{old('tecnologia_dosimetro')}}"  style="text-transform:uppercase">
                                <option value="">--SELECCIONE--</option>
                                <option value="OSL" @if (old('tecnologia_dosimetro') == "OSL") {{ 'selected' }} @endif selected>OSL</option>
                                <option value="TLD" @if (old('tecnologia_dosimetro') == "TDL") {{ 'selected' }} @endif>TLD</option>
                                <option value="ELECTRÓNICO" @if (old('tecnologia_dosimetro') == "ELECTRÓNICO") {{ 'selected' }} @endif>ELECTRÓNICO</option>
                            </select>
                            <label for="floatingInputGrid">* TECNOLOGÍA:</label>
                            @error('tecnologia_dosimetro') <span class="invalid-feedback">*{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
                <br>
                <div class="row g-2">
                    <div class="col-md">
                        <div class="form-floating">
                            <input type="date" name="fecha_ingre_serv_dosimetro" id="fecha_ingre_serv_dosimetro" class="form-control @error('fecha_ingre_serv_dosimetro') is-invalid @enderror" value="{{old('fecha_ingre_serv_dosimetro')}}" style="text-transform:uppercase;">
                            <label for="floatingInputGrid">* FECHA INGRESO AL SERVICIO:</label>
                            @error('fecha_ingre_serv_dosimetro') <span class="invalid-feedback">*{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
                <br>
                <div class="row g-2">
                    <div class="col-md">
                        <div class="form-floating">
                            <select class="form-select @error('estado_dosimetro') is-invalid @enderror" name="estado_dosimetro" id="estado_dosimetro" value="{{old('estado_dosimetro')}}"  style="text-transform:uppercase">
                                <option value="">--SELECCIONE--</option>
                                <option value="STOCK" @if (old('estado_dosimetro') == "STOCK") {{ 'selected' }} @endif selected>STOCK</option>
                                <option value="PERDIDO" @if (old('estado_dosimetro') == "PERDIDO") {{ 'selected' }} @endif>PERDIDO</option>
                                <option value="DAÑADO" @if (old('estado_dosimetro') == "DAÑADO") {{ 'selected' }} @endif>DAÑADO</option>
                                <option value="EN USO" @if (old('estado_dosimetro') == "EN USO") {{ 'selected' }} @endif>EN USO</option>
                            </select>
                            <label for="floatingInputGrid">* ESTADO DOSÍMETRO:</label>
                            @error('estado_dosimetro') <span class="invalid-feedback">*{{ $message }}</span> @enderror

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
        
        var fecha = new Date();
        document.getElementById("fecha_ingre_serv_dosimetro").value = fecha.toJSON().slice(0,10);

        $('#form_create_dosimetro').submit(function(e){
            e.preventDefault();
            Swal.fire({
                text: "DESEA GUARDAR ESTE DOSÍMETRO??",
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
    var inicio = 1;
    function agregarCodigo(){
        var codigo = `<div class="row g-2" id="codigo">
                        <div class="col-md">
                            <div class="form-floating">
                                <input type="text" name="codigo_dosimetro[]" id="codigo_dosimetro" class="form-control" value="" autofocus >
                                <label for="floatingInputGrid">* CODIGO:</label>
                            </div>
                        </div>
                        <div class="col-md-3  text-center">
                            <button class="btn btn-danger mt-2" type="button" onclick="eliminar(this)">
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-trash " viewBox="0 0 16 16">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                </svg>
                            </button>
                        </div>
                    </div><br>`;
        $("#rowCodigo").append(codigo);
    }
    function eliminar(codigo){
        $("#codigo").remove();
    }
    function eliminarRow(id){
        $("#"+id).remove();
    }
</script>
@endsection
