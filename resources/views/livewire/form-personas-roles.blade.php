<div>
    <form action="{{route('roles.save')}}" method="POST"  id="form_crear_rol" name="form_crear_rol" >
        @csrf
        <div class="modal-body">
            <div class="col-md">
                <label class="text-center">INGRESE EL NOMBRE DEL ROL QUE DESEA GUARDAR:</label>
                <br>
                <div class="form-floating">
                    <input wire:model="nombre_rol" type="text"class="form-control @error('nombre_rol') is-invalid @enderror" name="nombre_rol" id="nombre_rol" autofocus style="text-transform:uppercase">
                    <label for="floatingSelectGrid">ROL:</label>
                    @error('nombre_rol')
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
