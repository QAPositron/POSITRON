<div>
    <form class="m-4 form_create_trabajador"  id="form_create_trabajador" name="form_create_trabajador" wire:submit.prevent="saveTrabajador">

        @csrf

        <div class="row g-2">
            <div class="col-md">
                <div class="form-floating text-wrap">
                    <input type="text" class="form-control" name="empresas_id" id="empresas_id" value="{{$nombre_empresa}}" autofocus style="text-transform:uppercase;" disabled>
                    <input wire:model="id_empresa" type="number" class="form-control @error('id_empresa') is-invalid @enderror"   name="id_empresas" id="id_empresas" hidden>
                    <label for="floatingSelectGrid">EMPRESA:</label>
                    @error('id_empresa') <span class="invalid-feedback">*{{ $message }}</span> @enderror
                    {{$id_empresa}}
                    
                </div>
            </div>
            <div class="col-md">
                <div class="form-floating">
                    <select wire:model="sede" class="form-select @error('sede') is-invalid @enderror" name="id_sedes" id="id_sedes">
                        <option value="{{old('id_sedes')}}">--SELECCIONE--</option>
                        @foreach($sedes as $sed)
                            <option value ="{{ $sed->id_sede }}">{{$sed->nombre_sede}}</option>
                        @endforeach
                    </select>
                    <label for="floatingSelectGrid">SEDE:</label>
                    @error('sede') <span class="invalid-feedback">*{{ $message }}</span> @enderror
                </div>
            </div>
        </div>
        <br>
        <div class="row g-2">
            <div class="col-md">
                <div class="form-floating text-wrap">
                    <input type="text" wire:model="primer_nombre" class="form-control  @error('primer_nombre') is-invalid @enderror"  name="primer_nombre_trabajador" id="primer_nombre_trabajador"  autofocus style="text-transform:uppercase;" value="{{old('primer_nombre_trabajador')}}">
                    <label for="floatingInputGrid">PRIMER NOMBRE:</label>
                    @error('primer_nombre') <span class="invalid-feedback">*{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="col-md">
                <div class="form-floating text-wrap">
                    <input type="text" wire:model="segundo_nombre" class="form-control @error('segundo_nombre') is-invalid @enderror"  name="segundo_nombre_trabajador" id="segundo_nombre_trabajador"  autofocus style="text-transform:uppercase;" value="{{old('segundo_nombre_trabajador')}}">
                    <label for="floatingInputGrid">SEGUNDO NOMBRE:</label>
                    @error('segundo_nombre') <span class="invalid-feedback">*{{ $message }}</span> @enderror
                </div>
            </div>
        </div>
        <br>
        <div class="row g-2">
            <div class="col-md">
                <div class="form-floating text-wrap">
                    <input type="text" wire:model="primer_apellido" class="form-control @error('primer_apellido') is-invalid @enderror"  name="primer_apellido_trabajador" id="primer_apellido_trabajador" autofocus style="text-transform:uppercase;">
                    <label for="floatingInputGrid">PRIMER APELLIDO:</label>
                    @error('primer_apellido') <span class="invalid-feedback">*{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="col-md">
                <div class="form-floating text-wrap">
                    <input type="text" wire:model="segundo_apellido" class="form-control  @error('segundo_apellido') is-invalid @enderror"  name="segundo_apellido_trabajador" id="segundo_apellido_trabajador" value="{{old('segundo_apellido_trabajador')}}" autofocus style="text-transform:uppercase;">
                    <label for="floatingInputGrid">SEGUNDO APELLIDO:</label>
                    @error('segundo_apellido') <span class="invalid-feedback">*{{ $message }}</span> @enderror
                </div>
            </div>
        </div>
        <br>
        <div class="row g-2">
            <div class="col-md">
                <div class="form-floating">
                    <select wire:model="tipo_identificación" class="form-select @error('tipo_identificación') is-invalid @enderror" name="tipoIden_trabajador" id="tipoIden_trabajador" value="{{old('tipoIden_trabajador')}}" autofocus style="text-transform:uppercase">
                        <option value="">--SELECCIONE--</option>
                        <option value="CÉDULA DE CIUDADANIA">CÉDULA DE CIUDADANIA</option>
                        <option value="TARJETA DE IDENTIDAD">TARJETA DE IDENTIDAD</option>
                        <option value="REGISTRO CIVIL">REGISTRO CIVIL</option>
                        <option value="PASAPORTE">PASAPORTE</option>
                        <option value="CÉDULA DE EXTRANJERÍA">CÉDULA DE EXTRANJERÍA</option>
                        <option value="TARJETA DE EXTRANJERÍA">TARJETA DE EXTRANJERÍA</option>
                        <option value="DOCUMENTO DE IDENTIFICACIÓN EXTRANJERO">DOCUMENTO DE IDENTIFICACIÓN EXTRANJERO</option>
                    </select>
                    <label for="floatingInputGrid">TIPO DE IDENTIFICACIÓN:</label>
                    @error('tipo_identificación') <span class="invalid-feedback">*{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="col-md">
                <div class="form-floating">
                    <input wire:model="cédula" type="number" class="form-control @error('cédula') is-invalid @enderror"  name="cedula_trabajador" id="cedula_trabajador" value="{{old('cedula_trabajador')}}" autofocus >
                    <label for="floatingInputGrid">CÉDULA:</label>
                    @error('cédula') <span class="invalid-feedback">*{{ $message }}</span> @enderror
                </div>
            </div>
        </div>
        <br>
        <div class="row g-2">
            <div class="col-md">
                <div class="form-floating text-wrap">
                    <select wire:model="género" class="form-select @error('género') is-invalid @enderror" name="genero_trabajador" id="genero_trabajador" style="text-transform:uppercase;">
                        <option value="{{old('genero_trabajador')}}">--SELECCIONE--</option>
                        <option value="F">FEMENINO</option>
                        <option value="M">MASCULINO</option>
                        <option value="O">OTRO</option>
                    </select>
                    <label for="floatingInputGrid">GÉNERO:</label>
                    @error('género') <span class="invalid-feedback">*{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="col-md">
                <div class="form-floating text-wrap">
                    <input wire:model="correo" type="email" class="form-control @error('correo') is-invalid @enderror" name="correo_trabajador" id="correo_trabajador" value="{{old('correo_trabajador')}}" autofocus style="text-transform:uppercase;">
                    <label for="">CORREO:</label>
                    @error('correo') <span class="invalid-feedback">*{{ $message }}</span> @enderror
                </div>
            </div>
        </div>
        <br>
        <div class="row g-2">
            <div class="col-md">
                <div class="form-floating text-wrap">
                    <input wire:model="teléfono" type="number" class="form-control @error('teléfono') is-invalid @enderror"  name="telefono_trabajador" id="telefono_trabajador" value="{{old('telefono_trabajador')}}" autofocus style="text-transform:uppercase;">
                    <label for="floatingInputGrid">TELÉFONO:</label>
                    @error('teléfono') <span class="invalid-feedback">*{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="col-md">
                <div class="form-floating text-wrap">
                    <select wire:model="perfil_laboral" class="form-select @error('perfil_laboral') is-invalid @enderror" name="tipo_trabajador" id="tipo_trabajador" style="text-transform:uppercase;" autofocus aria-label="Floating label select example">
                        <option value="{{old('tipo_trabajador')}}">--SELECCIONE--</option>
                        <option value="TOE">TOE: TRABAJADOR OCUPACIONALMENTE EXPUESTO</option>
                        <option value="OPR">OPR: OFICIAL DE PROTECCIÓN RADIOLÓGICA</option>
                        <option value="CASO">CASO: TRABAJADOR CON DOSIMETRO TIPO CASO</option>
                    </select>
                    <label for="">PERFIL LABORAL:</label>
                    @error('perfil_laboral') <span class="invalid-feedback">*{{ $message }}</span> @enderror
                </div>
            </div>
        </div>
        <br>
        
            
        <!---------BOTON------------->
        <div class="row">
            <div class="col"></div>
            <div class="col d-grid gap-2">
                <input class="btn colorQA" type="submit" id="boton-guardar" name="boton-guardar" value="GUARDAR">
            </div>
            <div class="col d-grid gap-2">
                <a href="{{route('empresas.info', $id_empresa)}}" class="btn btn-danger " type="button" id="cancelar" name="cancelar" role="button">CANCELAR</a>
            </div>
            <div class="col"></div>
        </div>
    </form>
</div>
