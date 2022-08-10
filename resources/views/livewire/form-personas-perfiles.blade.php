<div>
    <form action="{{route('perfiles.save')}}" method="POST"  id="form_crear_perfil" name="form_crear_perfil" >
        @csrf
        <div class="modal-body">
            <div class="col-md">
                <label class="text-center">INGRESE EL NOMBRE DEL PERFIL LABORAL QUE DESEA GUARDAR:</label>
                <br>
                <div class="form-floating">
                    <input wire:model="nombre_perfil_laboral" type="text" class="form-control @error('nombre_perfil_laboral') is-invalid @enderror" name="nombre_perfil_laboral" id="nombre_perfil_laboral" autofocus style="text-transform:uppercase">
                    <label for="floatingSelectGrid">PERFIL LABORAL:</label>
                    @error('nombre_perfil_laboral')
                        <span class="invalid-feedback">*{{ $message }}</span>
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
