@extends('layouts.app')
@extends('layouts.plantillabase')
@section('contenido')
<div class="row">
    <div class="col"></div>
    <div class="col-4">
        <div class="card text-dark bg-light">
            <h2 class="text-center mt-3">EDITAR DOSÍMETRO</h2>
            
            <form class="m-4" id="form_edit_dosimetro" name="form_edit_dosimetro" action="{{route('dosimetros.update', $dosimetro)}}" method="POST">
                
                @csrf

                @method('put')

                <div class="row g-2">
                    <label class="text-secondary">' * ' campo obligatorio</label>
                    <div class="col-md">
                        <div class="form-floating">
                            <select class="form-select @error('tipo_dosimetro') is-invalid @enderror" name="tipo_dosimetro" id="tipo_dosimetro" autofocus style="text-transform:uppercase">
                                <option value="{{old('tipo_dosimetro', $dosimetro->tipo_dosimetro)}}">--{{old('tipo_dosimetro', $dosimetro->tipo_dosimetro)}}--</option>
                                @if($dosimetro->tipo_dosimetro == 'GENERAL')
                                    <option value="EZCLIP" @if (old('tipo_dosimetro') == "EZCLIP") {{ 'selected' }} @endif>EZCLIP</option>
                                    <option value="AMBIENTAL" @if (old('tipo_dosimetro') == "AMBIENTAL") {{ 'selected' }} @endif>AMBIENTAL</option>
                                @elseif($dosimetro->tipo_dosimetro == 'AMBIENTAL')
                                    <option value="GENERAL" @if (old('tipo_dosimetro') == "GENERAL") {{ 'selected' }} @endif>GENERAL</option>
                                    <option value="EZCLIP" @if (old('tipo_dosimetro') == "EZCLIP") {{ 'selected' }} @endif>EZCLIP</option>
                                @elseif($dosimetro->tipo_dosimetro == 'EZCLIP')
                                    <option value="GENERAL" @if (old('tipo_dosimetro') == "GENERAL") {{ 'selected' }} @endif>GENERAL</option>
                                    <option value="AMBIENTAL" @if (old('tipo_dosimetro') == "AMBIENTAL") {{ 'selected' }} @endif>AMBIENTAL</option>
                                @endif
                                
                            </select>
                            <label for="floatingInputGrid">* TIPO</label>
                            @error('tipo_dosimetro') <span class="invalid-feedback">*{{ $message }}</span> @enderror

                        </div>
                    </div>
                </div>
                <br>
                <div class="row g-2">
                    <div class="col-md">
                        <div class="form-floating">
                            <select class="form-select @error('tecnologia_dosimetro') is-invalid @enderror" name="tecnologia_dosimetro" id="tecnologia_dosimetro" autofocus  style="text-transform:uppercase">
                                <option value="{{old('tecnologia_dosimetro', $dosimetro->tecnologia_dosimetro)}}">--{{old('tecnologia_dosimetro', $dosimetro->tecnologia_dosimetro)}}--</option>
                                @if($dosimetro->tecnologia_dosimetro == 'OSL')
                                    <option value="TLD" @if (old('tecnologia_dosimetro') == "TLD") {{ 'selected' }} @endif>TLD</option>
                                    <option value="ELECTRÓNICO" @if (old('tecnologia_dosimetro') == "ELECTRÓNICO") {{ 'selected' }} @endif>ELECTRÓNICO</option>  
                                @elseif($dosimetro->tecnologia_dosimetro == 'TLD')
                                    <option value="OSL" @if (old('tecnologia_dosimetro') == "OSL") {{ 'selected' }} @endif>OSL</option>
                                    <option value="ELECTRÓNICO" @if (old('tecnologia_dosimetro') == "ELECTRÓNICO") {{ 'selected' }} @endif>ELECTRÓNICO</option>
                                @elseif($dosimetro->tecnologia_dosimetro == 'ELECTRÓNICO') 
                                    <option value="TLD" @if (old('tecnologia_dosimetro') == "TLD") {{ 'selected' }} @endif>TLD</option>
                                    <option value="OSL" @if (old('tecnologia_dosimetro') == "OSL") {{ 'selected' }} @endif>OSL</option>
                                @endif
                                
                            </select>
                            <label for="floatingInputGrid">* TECNOLOGÍA DOSÍMETRO:</label>
                            @error('tecnologia_dosimetro') <span class="invalid-feedback">*{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
                <br>
                <div class="row g-2">
                    <div class="col-md">
                        <div class="form-floating" >
                            <input type="numeric" name="codigo_dosimetro" id="codigo_dosimetro" class="form-control @error('codigo_dosimetro') is-invalid @enderror" value="{{old('codigo_dosimetro', $dosimetro->codigo_dosimeter)}}" autofocus >
                            <label for="floatingInputGrid">* CODIGO DOSÍMETRO:</label>
                            @error('codigo_dosimetro') <span class="invalid-feedback">*{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
                <br>
                <div class="row g-2">
                    <div class="col-md">
                        <div class="form-floating">
                            <input type="date" name="fecha_ingre_serv_dosimetro" id="fecha_ingre_serv_dosimetro" class="form-control @error('fecha_ingre_serv_dosimetro') is-invalid @enderror" value="{{old('fecha_ingre_serv_dosimetro', $dosimetro->fecha_ingreso_servicio)}}" autofocus style="text-transform:uppercase;"> 
                            <label for="floatingInputGrid">* FECHA INGRESO AL SERVICIO:</label>
                            @error('fecha_ingre_serv_dosimetro') <span class="invalid-feedback">*{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
                <br>
                <div class="row g-2">
                    <div class="col-md">
                        <div class="form-floating">
                            <select class="form-select @error('estado_dosimetro') is-invalid @enderror" name="estado_dosimetro" id="estado_dosimetro" value="{{old('estado_dosimetro')}}" autofocus  style="text-transform:uppercase">
                                <option value="{{old('estado_dosimetro',$dosimetro->estado_dosimetro)}}">--{{old('estado_dosimetro', $dosimetro->estado_dosimetro)}}--</option>
                                @if($dosimetro->estado_dosimetro =='STOCK')
                                    <option value="PERDIDO" @if (old('estado_dosimetro') == "PERDIDO") {{ 'selected' }} @endif>PERDIDO</option>
                                    <option value="DAÑADO" @if (old('estado_dosimetro') == "DAÑADO") {{ 'selected' }} @endif>DAÑADO</option>
                                    <option value="EN USO" @if (old('estado_dosimetro') == "EN USO") {{ 'selected' }} @endif>EN USO</option>
                                @elseif($dosimetro->estado_dosimetro =='PERDIDO')
                                    <option value="STOCK" @if (old('estado_dosimetro') == "STOCK") {{ 'selected' }} @endif>STOCK</option>
                                    <option value="DAÑADO" @if (old('estado_dosimetro') == "DAÑADO") {{ 'selected' }} @endif>DAÑADO</option>
                                    <option value="EN USO" @if (old('estado_dosimetro') == "EN USO") {{ 'selected' }} @endif>EN USO</option>
                                @elseif($dosimetro->estado_dosimetro =='DAÑADO')
                                    <option value="STOCK" @if (old('estado_dosimetro') == "STOCK") {{ 'selected' }} @endif>STOCK</option>
                                    <option value="PERDIDO" @if (old('estado_dosimetro') == "PERDIDO") {{ 'selected' }} @endif>PERDIDO</option>
                                    <option value="EN USO" @if (old('estado_dosimetro') == "EN USO") {{ 'selected' }} @endif>EN USO</option>
                                @elseif($dosimetro->estado_dosimetro =='EN USO')
                                    <option value="STOCK" @if (old('estado_dosimetro') == "STOCK") {{ 'selected' }} @endif>STOCK</option>
                                    <option value="PERDIDO" @if (old('estado_dosimetro') == "PERDIDO") {{ 'selected' }} @endif>PERDIDO</option>
                                    <option value="DAÑADO" @if (old('estado_dosimetro') == "DAÑADO") {{ 'selected' }} @endif>DAÑADO</option>
                                @endif
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
                        <button class="btn colorQA " type="submit" id="boton-guardar" name="boton-guardar" >ACTUALIZAR</button>
                    </div>
                    <div class="col d-grid gap-2">
                        <a href="{{route('dosimetros.search')}}" class="btn btn-danger" type="button" id="cancelar" name="cancelar" role="button">CANCELAR</a>
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
    $('#form_edit_dosimetro').submit(function(e){
        e.preventDefault();
        Swal.fire({
            text: 'SEGURO QUE DESEA ACTUALIZAR LA INFORMACIÓN DE ESTE DOSÍMETRO?',
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