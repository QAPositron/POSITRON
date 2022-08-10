@extends('layouts.plantillabase')
@section('contenido')
<div class="row">
    <div class="col"></div>
    <div class="col-8">
        <div class="card text-dark bg-light">
            <h2 class="text-center mt-3">EDITAR CONTACTO</h2>
            
            <form class="m-4" id='form_edit_contacto' name='form_edit_contacto' action="{{route('contactos.update', $contacto)}}" method="POST">

            @csrf
            
            @method('put') 

                
                <br>
                
                <div class="row g-2">
                    <div class="col-md">
                        <div class="form-floating text-wrap">
                            <input type="text" class="form-control"  name="primer_nombre_contacto" id="primer_nombre_contacto"  value="{{old('primer_nombre_contacto', $contacto->primer_nombre_contacto)}}" autofocus style="text-transform:uppercase;">
                            <label for="floatingInputGrid">PRIMER NOMBRE:</label>
                            @error('primer_nombre_contacto')
                                <small>*{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-floating text-wrap">
                            <input type="text" class="form-control"  name="segundo_nombre_contacto" id="segundo_nombre_contacto" value="{{old('segundo_nombre_contacto', $contacto->segundo_nombre_contacto)}}" autofocus style="text-transform:uppercase;">
                            <label for="floatingInputGrid">SEGUNDO NOMBRE:</label>
                            @error('segundo_nombre_contacto')
                                <small>*{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <br>
                <div class="row g-2">
                    <div class="col-md">
                        <div class="form-floating text-wrap">
                            <input type="text" class="form-control"  name="primer_apellido_contacto" id="primer_apellido_contacto" value="{{old('primer_apellido_contacto',  $contacto->primer_apellido_contacto)}}" autofocus style="text-transform:uppercase;">
                            <label for="floatingInputGrid">PRIMER APELLIDO:</label>
                            @error('primer_apellido_contacto')
                                <small>*{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-floating text-wrap">
                            <input type="text" class="form-control"  name="segundo_apellido_contacto" id="segundo_apellido_contacto" value="{{old('segundo_apellido_contacto', $contacto->segundo_apellido_contacto)}}" autofocus style="text-transform:uppercase;">
                            <label for="floatingInputGrid">SEGUNDO APELLIDO:</label>
                            @error('segundo_apellido_contacto')
                                <small>*{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <br>
                <div class="row g-2">
                    <div class="col-md">
                        <div class="form-floating">
                            <select class="form-select" name="tipoIden_contacto" id="tipoIden_contacto" autofocus style="text-transform:uppercase">
                                <option value="{{old('tipoIden_contacto', $contacto->tipo_iden_contacto)}}">--{{$contacto->tipo_iden_contacto}}--</option>
                                <option value="CÉDULA DE CIUDADANIA">CÉDULA DE CIUDADANIA</option>
                                <option value="TARJETA DE IDENTIDAD">TARJETA DE IDENTIDAD</option>
                                <option value="REGISTRO CIVIL">REGISTRO CIVIL</option>
                                <option value="TARJETA DE EXTRANJERÍA">TARJETA DE EXTRANJERÍA</option>
                                <option value="DOCUMENTO DE IDENTIFICACIÓN EXTRANJERO">DOCUMENTO DE IDENTIFICACIÓN EXTRANJERO</option>
                                <option value="CÉDULA DE EXTRANJERÍA">CÉDULA DE EXTRANJERÍA</option>
                                <option value="PASAPORTE">PASAPORTE</option>
                            </select>
                            <label for="floatingInputGrid">TIPO DE IDENTIFICACIÓN:</label>
                            @error('tipoIden_contacto')
                                <small>*{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-floating text-wrap">
                            <input type="text" class="form-control"  name="cedula_contacto" id="cedula_contacto" value="{{old('cedula_contacto', $contacto->cedula_contacto)}}" autofocus style="text-transform:uppercase;">
                            <label for="floatingInputGrid">CÉDULA:</label>
                            @error('cedula_contacto')
                                <small>*{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <br>
                <div class="row g-2">
                    <div class="col-md">
                        <div class="form-floating text-wrap">
                            <select class="form-select" name="genero_contacto" id="genero_contacto" style="text-transform:uppercase;">
                                <option value="{{old('genero_contacto', $contacto->genero_contacto)}}">--{{$contacto->genero_contacto}}--</option>
                                <option value="femenino">FEMENINO</option>
                                <option value="masculino">MASCULINO</option>
                                <option value="otro">OTRO</option>
                            </select>
                            <label for="floatingInputGrid">GÉNERO:</label>
                            @error('genero_contacto')
                                <small>*{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-floating text-wrap">
                            <input type="email" class="form-control" name="correo_contacto" id="correo_contacto" value="{{old('correo_contacto', $contacto->correo_contacto)}}" autofocus style="text-transform:uppercase;">
                            <label for="">CORREO:</label>
                            @error('correo_contacto')
                                <small>*{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <br>
                <div class="row g-2">
                    <div class="col-md">
                        <div class="form-floating text-wrap">
                            <input type="numeric" class="form-control"  name="telefono_contacto" id="telefono_contacto" value="{{old('telefono_contacto', $contacto->telefono_contacto)}}" autofocus style="text-transform:uppercase;">
                            <label for="floatingInputGrid">TELÉFONO:</label>
                            @error('telefono_contacto')
                                <small>*{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-floating">
                            <select class="form-select" name="profesion_contacto" id="profesion_contacto" style="text-transform:uppercase;">
                                <option value="{{old('tipo_contacto', $contacto->profesion_contacto)}}">--{{$contacto->profesion_contacto}}--</option>
                                <option value="SEGURIDAD Y SALUD EN EL TRABAJO">SEGURIDAD Y SALUD EN EL TRABAJO</option>
                                <option value="CALIDAD">CALIDAD</option>
                                <option value="BIOMÉDICA">BIOMÉDICA</option>
                                <option value="OFICIAL DE PROTECCIÓN READIOLÓGICA">OFICIAL DE PROTECCIÓN RADIOLÓGICA</option>
                                <option value="FÍSICA MÉDICA">FÍSICA MÉDICA</option>
                                <option value="CONTABILIDAD">CONTABILIDAD</option>
                                <option value="SUBGERENCIA">SUBGERENCIA</option>
                                <option value="GERENCIA">GERENCIA</option>
                            </select>
                            <label for="">PERFIL LABORAL:</label>
                            @error('profesion_contacto')
                                <small>*{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <br>
                
                @if(count($contactosede)== 0)
                    
                    <label for="">SELECCIONE SI DESEA RELACIONAR ESTE CONTACTO A UNA EMPRESA Y SUS SEDES</label>
                    <br>
                    <br>
                    <div class="row g-2">
                        <div class="col-md">
                            <div class="form-floating">
                                <select  class="form-select" name="id_empresas" id="id_empresas">
                                    <option value="">--SELECCIONE--</option>
                                    @foreach($empresas as $emp)
                                        <option value ="{{ $emp->id_empresa }}">{{$emp->nombre_empresa}}</option>
                                    @endforeach
                                </select>
                                <label for="floatingSelectGrid">EMPRESA:</label>
                                @error('id_empresas')
                                    <small>*{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md">
                            <label for="floatingSelectGrid">SEDE:</label>
                            <div class="form-floating">
                                <select class="form-select" id="id_sedes" name="id_sedes[]" autofocus aria-label="Floating label select example"  multiple="true">
                                    
                                </select>
                                @error('id_sedes')
                                <small>*{{$message}}</small>
                            @enderror
                            </div>
                        </div>
                    </div>
                @else
                    <label for="">LA SIGUIENTES SON LAS EMPRESAS Y SEDES RELACIONADAS</label>
                    <br>
                    @foreach($contactosede as $contsede)
                        <div class="row g-2">
                            <div class="col-md">
                                <div class="form-floating text-wrap">
                                    <input type="text" class="form-control"  name="id_empresas" id="id_empresas"  value="{{old('id_empresas', $contsede->nombre_empresa)}}" autofocus style="text-transform:uppercase;" disabled>
                                    <label for="floatingSelectGrid">EMPRESA:</label>
                                    @error('id_empresas')
                                        <small>*{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md" >
                                <div class="spinner_contacto text-center" id="spinner_contacto">

                                </div>
                                <div class="form-floating contacto_empresa" id="contacto_empresa" name="contacto_empresa">
                                    <input type="text" class="form-control" name="id_sedesArray" id="id_sedesArray" value="{{old('id_sedes', $contsede->nombre_sede)}}" autofocus style="text-transform:uppercase;" disabled>
                                    <label for="floatingSelectGrid">SEDE:</label>
                                    @error('id_sedes')
                                        <small>*{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <br>
                        
                    @endforeach
                @endif
                <br>
                <label for="">A CONTINUACIÓN, MODIFIQUE SI ESTE CONTACTO ES EL LÍDER O ENCARGADO DE LOS SERVICIOS O SI NO HAY CAMBIOS NO SELECCIONE:</label>
                <div class="row g-2">
                    <div class="col-md"></div>
                    <div class="col-md text-center">
                        <div class="form-check">
                            <input class="form-check-input " type="checkbox" value="TRUE" id="lider_ava" name="lider_ava" @if($contacto->lider_ava == 'TRUE') checked @endif>
                            <label class="form-check-label" for="defaultCheck1">
                                AULA VIRTUAL
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="TRUE" id="lider_dosimetria" name="lider_dosimetria" @if($contacto->lider_dosimetria == 'TRUE') checked @endif>
                            <label class="form-check-label" for="defaultCheck1">
                                DOSIMETRÍA
                            </label>
                        </div>
                    </div>
                    <div class="col-md"></div>
                </div>
                <br>
                <!---------BOTON------------->
                <div class="row">
                    <div class="col"></div>
                    <div class="col d-grid gap-2">
                        <button class="btn colorQA" type="submit" id="boton-guardar" name="boton-guardar">ACTUALIZAR </button>
                    </div>
                    <div class="col d-grid gap-2">
                        <a href="{{route('contactos.search')}}" class="btn btn-danger " type="button" id="cancelar" name="cancelar" role="button">CANCELAR</a>
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
        $('#id_empresas').on('change', function(){
            $('#contacto_empresa').fadeOut();
            $('#spinner_contacto').html('<div class="spinner-border text-secondary" id="spinner" role="status"></div>');
            var empresa_id = $(this).val();
            /* alert (empresa_id); */
            var padre = document.getElementById("spinner_contacto");
            var hijo = document.getElementById("spinner");
            if($.trim(empresa_id) != ''){
                $.get('selectsedes',{empresa_id : empresa_id}, function(sedes){
                    console.log(sedes);
                    $('#id_sedes').empty();
                    $('#id_sedes').append("<option value=''>--SELECCIONE UNA SEDE--</option>");
                    $.each(sedes, function(index, value){
                        $('#id_sedes').append("<option value='"+ index + "'>" + value + "</option>");
                    })
                });
            }

        });
    })
</script>
<script type="text/javascript">
    $(document).ready(() => {

        $('#id_sedes').select2({
            placeholder:"SELECCIONE LAS SEDES",
            tags: true,
            tokenSeparators: ['/',',',',',','," "]
        });
    });
</script>
<script type="text/javascript">
$(document).ready(function(){
    $('#form_edit_contacto').submit(function(e){
        e.preventDefault();
        Swal.fire({
            text: 'SEGURO QUE DESEA ACTUALIZAR LA INFORMACION DE ESTE CONTACTO',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'SI!'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                'ACTUALIZADO!',
                'SE HA ACTUALIZADO EL CONTACTO.',
                'success'
                )
                this.submit(); 
            }
        })
    })
})
</script>
@endsection()