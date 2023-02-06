@extends('layouts.app')
@extends('layouts.plantillabase')
@section('contenido')

    <div class="row justify-content-center">
        <div class="col-md-8">
            <br>
            <div class="card">
                <div class="card-header text-center"> <b>{{ __('BIENVENIDO AL MODULO DE DOSIMETRIA') }}</b> </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <i>{{ __('HA INGRESADO EXITOSAMENTE!') }}</i> 
                </div>
            </div>
        </div>
    </div>

@endsection
