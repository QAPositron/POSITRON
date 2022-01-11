@extends('layouts.plantillabase')
@section('contenido')
<!-- <div>
  <label for="form_name">First name:</label><br>
  <input type="text" id="form_name" name="name"><br>
  <label for="form_surname">Last name:</label><br>
  <input type="text" id="form_surname" name="surname"><br><br>
  <button onclick='proccess();'>confirm</button>
</div> -->
<br>
<div id="mensaje"></div>
<label>EMPRESA:</label>
<select class="form-select" name="id_empresas" id="id_empresas"  autofocus aria-label="Floating label select example">
    <option value="">--SELECCIONE--</option>
    @foreach($empresas as $emp)
        <option value ="{{ $emp->id_empresa }}">{{$emp->nombre_empresa}}</option>
    @endforeach
</select>
<select class="form-select" name="id_sedes" id="id_sedes">
</select>

<!--  <button onclick='proccess();'>mostrar</button> -->
<!-- <script src="https://unpkg.com/axios/dist/axios.min.js"></script>-->
<!--- JQUERY--->
<!-- <script
src="https://code.jquery.com/jquery-3.6.0.js"
integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
crossorigin="anonymous">
</script> -->

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script type="text/javascript">
    var $empresa = document.querySelector('#id_empresas');
    var $sede = document.querySelector('#id_sedes');
    var mensaje = document.getElementById('mensaje');
    
    $empresa.addEventListener('change', function(){
        const codEmpresa = $empresa.value
        
        cargarSedes(codEmpresa);
    });
    
    function cargarSedes(codEmpresa){
        var laravelToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        var $sedes = [];
        axios.post('prueba',{
            'empresa_id': codEmpresa
        }).then(function(response){
            $sedes = response.data;
           /*  var objsede = JSON.parse($sedes); */
            console.log($sedes);

            let template = '<option class="form-control" selected disabled>--SELECCIONE SEDE--</option>';
           
            for( i in $sedes){
                template += console.log('<option value="'+$sedes[i].id_sede+'">'+$sedes[i].nombre_sede+'</option>');
                mensaje.innerHTML = console.log('<option value="'+$sedes[i].id_sede+'">'+$sedes[i].nombre_sede+'</option>');
                /* $sede.innerHTML ='<option value="'+$sedes[i].id_sede+'">'+$sedes[i].nombre_sede+'</option>'; */
            } 
            $sede.innerHTML= template;
            /* $sedes.forEach(sede => {
                template += `<option value="${sede.idSede}">${sede.nombreSede}</option>`;
            })
            /* $sede.innerHTML= template; */
            /* for(var i = 0; i < $sedes.lenght; i++){
                console.log($sedes[i].nombre_sede);
                /* template += `<option value='sedes'>${sede.nombreSede}</option>`; 
            } 
             
            $sede.innerHTML= template; */
                /* const sedes = JSON.parse(response);
                let template = '<option class="form-control" selected disabled>--SELECCIONE SEDE--</option>'

                sedes.forEach(sede => {
                template += `<option value="${sede.idSede}">${sede.nombreSede}</option>`;
                })
                $sede.innerHTML= template; */ 
        }).catch(function (error) {
            console.log(error);
        });
    }
</script>
<!-- 
<script type="text/javascript">
    /* $(document).ready(function(){
        var $empresa = document.querySelector('#id_empresas')
        var $sede = document.querySelector('#id_sedes')

        function cargarSedes(sendDatos){
            axios.post('prueba',{
                sendDatos
            }).then(function(response){
                console.log(response); 
                const sedes = JSON.parse(response);
                let template = '<option class="form-control" selected disabled>--SELECCIONE SEDE--</option>'

                sedes.forEach(sede => {
                template += `<option value="${sede.idSede}">${sede.nombreSede}</option>`;
                })
                $sede.innerHTML= template;
            })
        }
        $empresa.addEventListener('change', function(){
        const codEmpresa = $empresa.value
        console.log(codEmpresa);
        const sendDatos = {
            'codigoEmp' : codEmpresa,
        }

        cargarSedes(sendDatos);
    });
    }) */
    
 
   /*  function proccess(){
        var laravelToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const $option = document.getElementById("empresa").value;
        /* alert(option), */
        /* axios.post('prueba',{
            'empresa_id': $option
        })
        .then(function (response) { */
            /* return response,json(); */
            /* console.log(response.data); */
            /* var sedes = response.data; */
            /* const sedes = JSON.parse(response);
            let template = '<option selected disabled>--SELECCIONE--</option>'

            sedes.forEach(sede => {
                template += `<option value="${sede.idSede}">${sede.nombreSede}</option>`;
                })
                $sede.innerHTML= template; */
            /* for(let i in sede){
                document.getElementById("sede").innerHTML ='<option value="'+sede[i].id_sede+'">'+sede[i].nombre_sede+'</option>';
                 
            } */
           /*  console.log(sede); */
        /* })
        .catch(function (error) {
            console.log(error);
        }); */
    /* } */
    /* function proccess(){
        var laravelToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        axios.post('prueba',{
            'name':"luis"
        })
        .then(function (response) {
            console.log(response.data);
        })
        .catch(function (error) {
            console.log(error);
        });
    } */

</script> -->

@endsection 