@extends('layouts.plantillabase')
@section('contenido')
<div class="row">
    <div class="col"></div>
    <div class="col-6">
        <div class="card text-dark bg-light">
            <h2 class="text-center mt-3">CREAR TRABAJADOR</h2>
            @livewire('form-trabajador', ['empresa' => $empresa, 'sedes'=>$sedes])
            {{-- <livewire:form-trabajador :[empresa="$empresa", sedes="$sedes"] > --}}
            {{-- @livewire('form-trabajador') --}}

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
    $(document).ready(function(){
        $('#id_empresas').on('change', function(){
            var empresa_id = $(this).val();
            alert(empresa_id);
            if($.trim(empresa_id) != ''){
                $.get('prueba2',{empresa_id : empresa_id}, function(sedes){
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
{{-- <script type="text/javascript">
    $(document).ready(function(){
        $('.form_create_trabajador').submit(function(e){
            e.preventDefault();
            Swal.fire({
                text: "DESEA GUARDAR ESTE TRABAJADOR??",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'SI, SEGURO!'
                }).then((result) => {
                if (result.isConfirmed) {
                   
                    this.submit();
                }
            })
        })
    })
</script> --}}
@endsection 
