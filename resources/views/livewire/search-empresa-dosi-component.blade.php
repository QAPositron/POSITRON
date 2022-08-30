<div> 
    <div class="row"> 
        <div class="col"></div>
        <div class="col">
            <div class="card text-dark bg-light" style="max-width: 25rem;">
                <h3 class="pt-4 text-center">BUSCAR</h3>
                <form class="m-4"action="">
                    <label for="exampleFormControlInput1" class="form-label">PALABRA CLAVE: </label>
                    <div class="row">
                        <div class="col">
                            <input wire:model="search" class="form-control" type="text" name="busqueda" id="busqueda" placeholder="--BUSCAR--" autofocus style="text-transform:uppercase;">
                        </div>
                    </div>
                </form>
        
            </div>
        </div>
        <div class="col"></div>
    </div>
    <BR></BR>
    <h3 class="text-center">LISTADO DE EMPRESAS CON DOSIMETRÍA</h3>
    <div class="row">               
        <div class="col"></div>
        <div class="col-9">
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
                                <td class="align-middle"><a class="link-dark" href="{{route('contratosdosi.createlist', $empdosi->empresa_id)}}">{{$empdosi->nombre_empresa}}</a></td>
                                <td class="align-middle">{{$empdosi->empresa->tipo_identificacion_empresa}}</td>
                                <td class="align-middle">{{$empdosi->num_iden_empresa}} {{$empdosi->empresa->DV}}</td>
                                <td class="align-middle">{{$empdosi->numtotal_dosi_cuerpo_entero}}</td>
                                <td class="align-middle">{{$empdosi->numtotal_dosi_control}}</td>
                                <td class="align-middle">{{$empdosi->numtotal_dosi_ambiental}}</td>
                                <td class="align-middle">{{$empdosi->numtotal_dosi_ezclip}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col"></div>
    </div>
</div>
