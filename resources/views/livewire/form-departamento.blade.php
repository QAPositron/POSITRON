<div>
    {{-- Stop trying to control. --}}
    <form action="{{route('departamento.save')}}" method="POST"  id="form_crear_depto" name="form_crear_depto" >
        @csrf
        <div class="modal-body">
            <div class="col-md">
                <label class="text-center">INGRESE EL NOMBRE DE LA ESPECIALIDAD QUE DESEA GUARDAR:</label>
                <br>
                <div class="form-floating">
                    <input wire:model="nombre_especialidad" type="text"class="form-control @error('nombre_especialidad') is-invalid @enderror" name="nombre_especialidad" id="nombre_especialidad" autofocus style="text-transform:uppercase">
                    <label for="floatingSelectGrid">ESPECIALIDAD:</label>
                    @error('nombre_especialidad')
                    <span class="invalid-feedback">*{{ $message }}</span>
                    @enderror
                    {{$nombre_especialidad}}
                </div>
                
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">CANCELAR</button>
            <button type="submit" class="btn colorQA"  data-bs-dismiss="modal" >GUARDAR</button>
        </div>
    </form>
</div>
