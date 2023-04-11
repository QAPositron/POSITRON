@extends('layouts.app')
@extends('layouts.plantillabase')
@section('contenido')
<div class="row">
    <div class="col"></div>
    <div class="col-4">
        <div class="card text-dark bg-light">
            <h2 class="text-center mt-3">EDITAR  PRODUCTO</h2>
            <form class="m-4" action="{{route('productos.update', $producto)}}" method="POST" id="form_edit_producto" name="form_edit_producto">

                @csrf
                @method('put')
                <div class="row g-2">
                    <div class="col-md">
                        <div class="form-floating ">
                            <input type="text" class="form-control"  name="ref_producto" id="ref_producto" value="{{old('ref_producto', $producto->referencia)}}" autofocus style="text-transform:uppercase;">
                            <label for="floatingInputGrid"> REFERENCIA</label>
                            @error('ref_producto')
                                <small>*{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <br>
                <div class="row g-2">
                    <div class="col-md">
                        <div class="form-floating">
                            <textarea class="form-control" name="concepto_producto" id="concepto_producto" autofocus style="text-transform:uppercase; height: 100px;">{{old('concepto_producto', $producto->concepto)}}</textarea>
                            <label for="floatingTextarea">CONCEPTO</label>
                            @error('concepto_producto')
                                <small>*{{$message}}</small>
                            @enderror
                          </div>
                    </div>
                </div>
                <br>
                <div class="row g-2">
                    <div class="col-md">
                        <div class="form-floating ">
                            @php $number = number_format($producto->valor_unitario, 0, ',', '.'); @endphp
                            <input type="number" class="form-control"  name="v_unitario_producto" id="v_unitario_producto" value="{{old('concepto_producto', $number )}}"  autofocus style="text-transform:uppercase;">
                            <label for="floatingInputGrid"> VALOR UNITARIO $</label>
                            @error('v_unitario_producto')
                                <small>*{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <br>
                <div class="row g-2">
                    <div class="col-md">
                        <div class="form-group">
                            <label for="floatingInputGrid"> CATEGORÍA</label>
                            <select class="form-select" name="categoria_producto" id="categoria_producto" value="{{old('categoria_producto')}}" autofocus style="text-transform:uppercase">
                                <option value="{{$producto->categoria}}">{{old('categoria_producto', $producto->categoria)}}</option>
                                @if($producto->categoria == 'DOSIMETRÍA')
                                    <option value="CONTROLES DE CALIDAD">CONTROLES DE CALIDAD</option>
                                @else
                                    <option value="DOSIMETRÍA">DOSIMETRÍA</option>
                                @endif
                            </select>
                            @error('categoria_producto')
                                <small>*{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <br>
                
                <br>
                <div class="row ">
                    <div class="col"></div>
                    <div class="col d-grid gap-2">
                        <button class="btn colorQA" type="submit">GUARDAR</button>
                    </div>
                    <div class="col d-grid gap-2">
                        <a href="{{route('productos.search')}}" class="btn btn-danger " type="button" id="cancelar" name="cancelar" role="button">CANCELAR</a>
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
    $('#form_edit_producto').submit(function(e){
        e.preventDefault();
        Swal.fire({
            text: 'SEGURO QUE DESEA ACTUALIZAR LA INFORMACIÓN DE ESTE PRODUCTO?',
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
    });
    
    $("#v_unitario_producto").change(function () {
        var number = $(this).val();
        var format = new Intl.NumberFormat('de-DE').format(number);
        document.getElementById("v_unitario_producto").value = format;
    });
    
})
</script>
@endsection