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
                        <form action="{{route('empresasdosi.save')}}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="col-md">
                                    <label class="text-center">AL SELECCIONAR UNA EMPRESA Y GUARDAR SE PODRAN CREAR CONTRATOS EN ELLA</label>
                                    <BR></BR>
                                    <div class="form-floating">
                                    <select class="form-select" name="id_empresa" id="id_empresa">
                                        <option value="">--SELECCIONE--</option>
                                        @foreach($empresa as $emp)
                                            <option value ="{{$emp->id_empresa}}">{{$emp->nombre_empresa}}</option>
                                        @endforeach
                                    </select>
                                    <label for="floatingSelectGrid">EMPRESA:</label>
                                    @error('id_sedes')
                                        <small>*{{$message}}</small>
                                    @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">CANCELAR</button>
                                <button type="submit" class="btn colorQA"  data-bs-dismiss="modal" >GUARDAR</button>
                            </div>
                        </form>
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
<script type="text/javascript">
    /* function obtenerEmpresa(idEmpresa){
        alert('el valor obtenido es' +idEmpresa);
        if($.trim(idEmpresa) != ''){
            $.get('prueba4',{idEmpresa : idEmpresa}, function(empresa){
                console.log(empresa);
                var emp = JSON.parse(empresa);
                $('#tbody_empresasdosi').prepend('<tr><td><a class="link-dark" href="">'+emp.nombre_empresa+'</a></td><td>'+emp.num_iden_empresa+ +emp.DV+'</td><td>--</td><td>--</td><td>--</td><td>--</td><td><button class="btn colorQA btn-sm"type="submit"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16"><path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/></svg></button></td></tr>');
            });
        }
    } */
</script>
@endsection()