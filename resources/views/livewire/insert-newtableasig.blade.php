<div>
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}
    <h4 class="text-center">ASIGNACIONES REVISADAS</h4>
    <div class="table table-responsive pt-2">
        <table class="table table-sm table-bordered" style="font-size: 13px;">
            <thead>
                <tr class="table-active text-center ">
                    <th class='align-middle py-4' style="width: 20%;">TRABJ</th>
                    <th class='align-middle py-4' >DOSÍM.</th>
                    <th class='align-middle py-4' >UBIC.</th>
                    {{-- <th class='align-middle py-4' >CONT.</th> --}}
                    <th class='align-middle py-4' >MES</th>
                    <th class='align-middle py-4' >EMP.</th>
                    <th class='align-middle py-4' >SEDE</th>
                    <th class='align-middle py-4' >ESP.</th>
                </tr>
            </thead>
            <tbody id="tbody_asignacionesok">
                
                
                
            </tbody>
        </table>
    </div>
</div>
<script
src="https://code.jquery.com/jquery-3.6.0.js"
integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
crossorigin="anonymous">
</script>
<script type="text/javascript">
    $(document).ready( function () {

        Livewire.on('newtr', function($id){
            @foreach($trabajdosiasig as $trabj)
                if('{{$trabj->id_trabajadordosimetro}}' == $id){

                    var tr = `<tr class="text-center">
                                    <td class='align-middle'>{{$trabj->persona->primer_nombre_persona}} {{substr($trabj->persona->segundo_nombre_persona,0,1)}} {{$trabj->persona->primer_apellido_persona}} {{$trabj->persona->segundo_apellido_persona}}</td>
                                    <td class='align-middle'>{{$trabj->codigo_dosimeter}}</td>
                                    <td class='align-middle'>{{$trabj->ubicacion}}</td>
                                    <td class='align-middle'>{{$trabj->mes_asignacion}}</td>
                                    
                                </tr>`;
    
                    $("#tbody_asignacionesok").append(tr);
                }
            @endforeach
        })
    })
</script>