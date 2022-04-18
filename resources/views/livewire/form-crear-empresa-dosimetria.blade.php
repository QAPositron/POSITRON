<div>
    <form action="{{route('empresasdosi.save')}}" method="POST" wire:submit.prevent="saveEmpresa" id="form_crear_empresadosi" name="form_crear_empresadosi" class="form_crear_empresadosi">
        @csrf
        <div class="modal-body">
            <div class="col-md">
                <label class="text-center">AL SELECCIONAR UNA EMPRESA Y GUARDAR SE PODRAN CREAR CONTRATOS EN ELLA</label>
                <BR></BR>
                <div class="form-floating">
                    <select wire:model="empresa" class="form-select @error('empresa') is-invalid @enderror" name="id_empresa" id="id_empresa">
                        <option value="">--SELECCIONE--</option>
                        @foreach($empresas as $emp)
                            <option value ="{{$emp->id_empresa}}">{{$emp->nombre_empresa}}</option>
                        @endforeach
                    </select>
                    <label for="floatingSelectGrid">EMPRESA:</label>
                    @error('empresa') <span class="invalid-feedback">*{{ $message }}</span> @enderror
                </div>
                
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">CANCELAR</button>
            <button type="submit" class="btn colorQA"  data-bs-dismiss="modal" >GUARDAR</button>
        </div>
    </form>
</div>
