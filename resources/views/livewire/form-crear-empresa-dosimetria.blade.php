<div>
    <form wire:submit.prevent="saveEmpresa" id="form_crear_empresadosi" name="form_crear_empresadosi" class="form_crear_empresadosi">
        @csrf 
        <div class="modal-body">
            <div class="col-md">
                <label class="text-center">AL SELECCIONAR UNA EMPRESA Y GUARDAR SE PODRAN CREAR CONTRATOS EN ELLA</label>
                <br>
                <br>
                <div class="form-floating text-center" wire:ignore>
                    <select  wire:model="empresa" class="form-select" name="id_empresa" id="id_empresa" >
                        <option value="">--SELECCIONE--</option>
                        @foreach($empresas as $emp)
                            <option value ="{{$emp->id_empresa}}">{{$emp->nombre_empresa}}</option>
                        @endforeach
                    </select>
                    <br>
                </div>
                
            </div>
            <br>
            <div class="col-md">
                @error('empresa') <span class="error">{{ $message }}</span> @enderror
                
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">CANCELAR</button>
            <button type="submit" class="btn colorQA"  data-bs-dismiss="modal" >GUARDAR</button>
        </div>
    </form>
</div>

<script>
    document.addEventListener('livewire:load', function(){
        $('#id_empresa').select2({width: "80%", theme: "classic", dropdownParent: $("#nueva_empresaModal")});
        $('#id_empresa').on('change', function(){
            @this.set('empresa', this.value);
        })
    })
    
</script>
 