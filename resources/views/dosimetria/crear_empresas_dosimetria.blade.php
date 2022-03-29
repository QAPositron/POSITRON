@extends('layouts.plantillabase')
@section('contenido')
    <div class="row">
        <div class="col"></div>
        <div class="col"></div>
        <div class="col"></div>
        <div class="col">
            <button type="button" class="btn colorQA" data-bs-toggle="modal" data-bs-target="#nueva_empresaModal" >NUEVA EMPRESA</button>
            <div class="modal fade" id="nueva_empresaModal" tabindex="-1" aria-labelledby="nueva_empresaModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title w-100 text-center" id="nueva_empresaModalLabel">NUEVA EMPRESA</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        @livewire('form-crear-empresa-dosimetria', ['empresas' => $empresas])
                    </div> 
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col"></div>
        <div class="col">
            <div class="card text-dark bg-light" style="max-width: 25rem;">
                <h3 class="pt-4 text-center">BUSCAR</h3>
                <form class="m-4"action="">
                    <label for="exampleFormControlInput1" class="form-label">PALABRA CLAVE: </label>
                    <div class="row">
                        <div class="col-8">
                            <input class="form-control" type="text" name="busqueda" id="busqueda" placeholder="--BUSCAR--" autofocus style="text-transform:uppercase;">
                        </div>
                        <div class="col">
                            
                                <input class="btn colorQA" type="submit" id="submit" name="submit"  value="BUSCAR">
                            
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col"></div>
    </div>
    <BR></BR>
    <h4 class="text-center">LISTADO DE EMPRESAS - DOSÍMETROS</h4>
    <div class="row">
        <div class="col"></div>
        <div class="col-12">
            <div class="table table-responsive p-4 ">
                <table class="table table-bordered">
                    <thead class ="text-center">
                        <tr>
                            <th >EMPRESA</th>
                            <th style='width: 15.60%'>TIPO. IDEN</th>
                            <th style='width: 13.60%'>No. IDEN</th>
                            <th style='width: 10.60%'>DOSIM. CUERPO E.</th>
                            <th style='width: 10.60%'>DOSIM. CONTROL</th>
                            <th style='width: 10.60%'>DOSIM. AMBIENTAL</th>
                            <th style='width: 9.60%'>DOSIM. EzCLIP</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($empresaDosi as $empdosi)
                            <tr>
                                <td><a class="link-dark" href="{{route('contratosdosi.createlist', $empdosi->empresa_id)}}">{{$empdosi->empresa->nombre_empresa}}</a></td>
                                <td>{{$empdosi->empresa->tipo_identificacion_empresa}}</td>
                                <td>{{$empdosi->empresa->num_iden_empresa}} {{$empdosi->empresa->DV}}</td>
                                <td>{{$empdosi->numtotal_dosi_cuerpo_entero}}</td>
                                <td>{{$empdosi->numtotal_dosi_control}}</td>
                                <td>{{$empdosi->numtotal_dosi_ambiental}}</td>
                                <td>{{$empdosi->numtotal_dosi_ezclip}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col"></div>
    </div>

<script
    src="https://code.jquery.com/jquery-3.6.0.js"
    integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
    crossorigin="anonymous">
</script>


@endsection()