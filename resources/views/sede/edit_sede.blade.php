@extends('layouts.plantillabase')
@section('contenido')
    <div class="row">
        <div class="col"></div>
        <div class="col-6">
            <div class="card text-dark bg-light" >
                <h2 class="text-center mt-3">EDITAR SEDE</h2>

                <form class="m-4" id='form_edit_sede' name='form_edit_sede' action="{{route('sedes.update', $sede)}}" method="POST">
                
                    @csrf

                    @method('put')

                    <div class="row g-2">
                        <div class="col-md">
                            <div class="form-floating text-wrap">
                                <input type="text" class="form-control"   name="empresas_id" id="empresas_id" value="{{old('empresas_id', $sede->empresa->nombre_empresa)}}" autofocus style="text-transform:uppercase;" disabled>
                                <input type="text" class="form-control"   name="id_empresa" id="id_empresa" value="{{old('id_empresa', $sede->empresa->id_empresa)}}" autofocus style="text-transform:uppercase;" hidden>
                                <label for="floatingSelectGrid">EMPRESA:</label>
                                @error('empresas_id')
                                    <small>*{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="form-floating text-wrap">
                                <input type="text" class="form-control"  name="nombre_sede" id="nombre_sede" value="{{old('nombre_sede', $sede->nombre_sede)}}" autofocus style="text-transform:uppercase;">
                                <label for="floatingInputGrid">NOMBRE DE LA SEDE:</label>
                                @error('nombre_sede')
                                    <small>*{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row g-2">
                        <div class="col-md">
                            <div class="form-group">
                                <label for="floatingInputGrid">DEPARTAMENTO:</label>
                                <select class="form-control"  name="departamento_sede" id="departamento_sede" value="{{old('departamento_sede')}}" autofocus style="text-transform:uppercase">
                                    <option value="{{ $sede->municipios->coldepartamento->id_departamentocol}}">--{{$sede->municipios->coldepartamento->nombre_deptocol}}--</option>
                                    @foreach($departamentoscol as $depacol)
                                        <option value="{{$depacol->id_departamentocol}}">{{$depacol->nombre_deptocol}}</option>
                                    @endforeach
                                </select>
                                @error('departamento_empresa')
                                    <small>*{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md" id="div_municipio">
                            <div class="spinner_municipio text-center" id="spinner_municipio">

                            </div>
                            <div class="form-group" id="municipio_empresa" name="municipio_empresa">
                                <label for="floatingInputGrid">MUNICIPIO:</label>
                                <select class="form-control" name="municipio_sede" id="municipio_sede" value="{{old('municipio_sede')}}" autofocus style="text-transform:uppercase">
                                    <option value="{{$sede->municipios->id_municipiocol}}">--{{$sede->municipios->nombre_municol}}--</option>
                                </select>
                                @error('municipio_sede')
                                    <small>*{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row g-2">
                        <div class="col-md">
                            <div class="form-floating text-wrap">
                                <input type="text" name="direccion_sede" id="direccion_sede" class="form-control" value="{{old('direccion_sede', $sede->direccion_sede)}}" autofocus style="text-transform:uppercase;">
                                <label for="">DIRECCIÓN:</label>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row g-2">
                        <h6 class="text-center">OBSERVE LAS ESPECIALIDADES EN LA SEDE Y AÑADA LA QUE DESEE </h6>
                        <div class="col"></div>
                        <div class="col-5 ">
                            <div class="table table-responsive">
                                <table class="table table-bordered">
                                    
                                    <tbody>
                                        @foreach($deptos as $dep)
                                            <tr class="text-center">
                                                <td>{{$dep->nombre_departamento}}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col"></div>
                    </div>
                    <div class="row g-2">
                        <div class="col-10">
                            <label for=""> AÑADIR ESPECIALIDADES:

                            </label>
                            <div class="form-floating">
                                <select class="form-select" id="multiple_select_depsede" name="multiple_select_depsede[]" autofocus aria-label="Floating label select example" multiple="true">
                                    <option value="ONCO">ONCO - ONCOLOGÍA</option>
                                    <option value="ODON">ODON - ODONTOLOGÍA</option>
                                    <option value="CIRJ">CIRJ - CIRUJIA</option>
                                    <option value="UCI">UCI - UCI</option>
                                </select>
                            </div>    
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col"></div>
                        <div class="col d-grid gap-2">
                            <button class="btn colorQA" type="submit" id="boton-guardar" name="boton-guardar">ACTUALIZAR</button>
                        </div>
                        <div class="col d-grid gap-2">
                            <a href="{{route('empresas.search')}}" class="btn btn-danger" type="button" id="cancelar" name="cancelar" role="button">CANCELAR</a>
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
    $(document).ready(() => {

        $('#multiple_select_depsede').select2({
            placeholder:"SELECCIONE LAS ESPECIALIDADES",
            tags: true,
            tokenSeparators: ['/',',',',',','," "]
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#departamento_sede').select2();
        $('#municipio_sede').select2();
    });
</script> 
    
<script type="text/javascript">
    $(document).ready(function() {
        $('#departamento_sede').on('change', function(){
            $('#municipio_empresa').fadeOut();
            $('#spinner_municipio').html('<div class="spinner-border text-secondary" id="spinner" role="status"></div>');
            var departamento_id = $(this).val();
            alert(departamento_id);
            var padre = document.getElementById("spinner_municipio");
            var hijo = document.getElementById("spinner");
            if($.trim(departamento_id) != ''){
                $.get('empresasdeptomuni', {departamento_id: departamento_id}, function(municipios){
                    console.log(municipios);
                    var remove = padre.removeChild(hijo);
                    $('#municipio_empresa').fadeIn();
                    $('#municipio_sede').empty();
                    $('#municipio_sede').append("<option value='{{$sede->municipios->id_municipiocol}}'>--{{$sede->municipios->nombre_municol}}--</option>");
                    $.each(municipios, function(index, value){
                        $('#municipio_sede').append("<option value='"+ index + "'>" + value + "</option>");
                    })
                });
            }
        });
    });
</script>


<script type="text/javascript">
    function eliminarDepto(depto, sede){
        var departamento = depto;
        var sed = sede;
        
            $.get('destroydepto', {departamento: departamento, sed: sed}, function(respuesta){
                console.log(respuesta);
                
            });
    }
</script>



<script type="text/javascript">
$(document).ready(function(){
    $('#form_edit_sede').submit(function(e){
        e.preventDefault();
        Swal.fire({
            text: 'SEGURO QUE DESEA ACTUALIZAR LA INFORMACIÓN DE ESTA SEDE?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#1A9980',
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