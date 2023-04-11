@extends('layouts.app')
@extends('layouts.plantillabase')
@section('contenido')
<div class="row">
    <div class="col"></div>
    <div class="col-4">
        <div class="card text-dark bg-light">
            <h2 class="text-center mt-3">CREAR  PRODUCTO</h2>
            <form class="m-4" action="{{route('productos.save')}}" method="POST">

                @csrf

                <div class="row g-2">
                    <div class="col-md">
                        <div class="form-floating ">
                            <input type="text" class="form-control"  name="ref_producto" id="ref_producto" value="{{old('ref_producto')}}" autofocus style="text-transform:uppercase;">
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
                            <textarea class="form-control" name="concepto_producto" id="concepto_producto" value="{{old('concepto_producto')}}" autofocus style="text-transform:uppercase; height: 100px;"></textarea>
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
                            <input type="number" class="form-control"  name="v_unitario_producto" id="v_unitario_producto" value="{{old('v_unitario_producto')}}" autofocus style="text-transform:uppercase;">
                            <label for="floatingInputGrid"> VALOR UNITARIO:</label>
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
                                <option value="">--SELECCIONE--</option>
                                <option value="DOSIMETRÍA">DOSIMETRÍA</option>
                                <option value="CONTROLES DE CALIDAD">CONTROLES DE CALIDAD</option>
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
@endsection