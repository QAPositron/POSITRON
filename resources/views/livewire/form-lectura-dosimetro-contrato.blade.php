<div>
    <form class="m-4" action="{{route('lecturadosi.save', $trabjasig)}}" wire:submit.prevent="saveFormDosimcontrato" method="POST">
                                        
        @csrf

        @method('put')
        <input type="NUMBER" wire:model="mes_asignacion" id="mes_asignacion" name="mes_asignacion" value="{{$trabjasig->mes_asignacion}}" hidden>
        <input type="NUMBER" wire:model="id_contratodosimetriasededepto" id="id_contratodosimetriasededepto" name="id_contratodosimetriasededepto" value="{{$trabjasig->contdosisededepto_id}}" hidden>
        <div class="row g-2">
            <div class="col-md mx-4">
                <div class="form-floating">
                    {{$nota2}}
                    @if($trabjasig->measurement_date != '')
                    <input wire:model="hp007_calc_dose" type="NUMBER" class="form-control" name="hp007_calc_dose" id="hp007_calc_dose" value="{{$trabjasig->Hp007_calc_dose}}" readonly>
                    @else
                    <input wire:model="hp007_calc_dose" type="NUMBER" step="any" class="form-control" name="hp007_calc_dose" id="hp007_calc_dose" value="{{$trabjasig->Hp007_calc_dose}}">
                    @endif
                    <label for="floatingInputGrid">Hp007 CALC DOSE:</label>
                </div>
            </div>
            <div class="col-md mx-4">
                <div class="form-floating">
                    @if($trabjasig->measurement_date != '')
                    <input wire:model="hp007_background_dose" type="NUMBER" class="form-control" name="hp007_background_dose" id="hp007_background_dose" value="{{$trabjasig->Hp007_background_dose}}" readonly>
                    @else
                    <input wire:model="hp007_background_dose" type="NUMBER" step="any" class="form-control" name="hp007_background_dose" id="hp007_background_dose" value="{{$trabjasig->Hp007_background_dose}}">
                    @endif
                    <label for="floatingInputGrid">Hp007 BACKGROUND DOSE:</label>
                </div>
            </div>
            <div class="col-md mx-4">
                <div class="form-floating">
                    @if($trabjasig->measurement_date != '')
                    <input wire:model="hp007_raw_dose" type="NUMBER" class="form-control" name="hp007_raw_dose" id="hp007_raw_dose" value="{{$trabjasig->Hp007_raw_dose}}" readonly>
                    @else
                    <input wire:model="hp007_raw_dose" type="NUMBER" step="any" class="form-control" name="hp007_raw_dose" id="hp007_raw_dose" value="{{$trabjasig->Hp007_raw_dose}}">
                    @endif
                    <label for="floatingInputGrid">Hp007 RAW DOSE:</label>
                </div>
            </div>
        </div>
        <br>
        <div class="row g-2">
            <div class="col-md mx-4">
                <div class="form-floating">
                    @if($trabjasig->measurement_date != '')
                    <input wire:model="hp10_calc_dose" type="NUMBER" class="form-control" name="hp10_calc_dose" id="hp10_calc_dose" value="{{$trabjasig->Hp10_calc_dose}}" readonly>
                    @else
                    <input wire:model="hp10_calc_dose" type="NUMBER" step="any" class="form-control" name="hp10_calc_dose" id="hp10_calc_dose" value="{{$trabjasig->Hp10_calc_dose}}">
                    @endif
                    <label for="floatingInputGrid">Hp10 CALC DOSE:</label>
                </div>
            </div>
            <div class="col-md mx-4">
                <div class="form-floating">
                    @if($trabjasig->measurement_date != '')
                    <input wire:model="hp10_background_dose" type="NUMBER" class="form-control"  name="hp10_background_dose" id="hp10_background_dose" value="{{$trabjasig->Hp10_background_dose}}" readonly>
                    @else
                    <input wire:model="hp10_background_dose" type="NUMBER" step="any" class="form-control"  name="hp10_background_dose" id="hp10_background_dose" value="{{$trabjasig->Hp10_background_dose}}">
                    @endif
                    <label for="floatingInputGrid">Hp10 BACKGROUND DOSE:</label>
                </div>
            </div>
            <div class="col-md mx-4">
                <div class="form-floating">
                    @if($trabjasig->measurement_date != '')
                    <input  wire:model="hp10_raw_dose" type="NUMBER" class="form-control" name="hp10_raw_dose" id="hp10_raw_dose" value="{{$trabjasig->Hp10_raw_dose}}" readonly>
                    @else
                    <input  wire:model="hp10_raw_dose" type="NUMBER" step="any" class="form-control" name="hp10_raw_dose" id="hp10_raw_dose" value="{{$trabjasig->Hp10_raw_dose}}">
                    @endif
                    <label for="floatingInputGrid">Hp10 RAW DOSE:</label>
                </div>
            </div>
        </div>
        <br>
        <div class="row g-2">
            <div class="col-md mx-4">
                <div class="form-floating">
                    @if($trabjasig->measurement_date != '')
                    <input wire:model="ezclip_calc_dose" type="NUMBER" class="form-control" name="ezclip_calc_dose" id="ezclip_calc_dose" value="{{$trabjasig->Ezclip_calc_dose}}" readonly>
                    @else
                    <input wire:model="ezclip_calc_dose" type="NUMBER" step="any" class="form-control" name="ezclip_calc_dose" id="ezclip_calc_dose" value="{{$trabjasig->Ezclip_calc_dose}}">
                    @endif
                    <label for="floatingInputGrid">EzClip CALC DOSE:</label>
                </div>
            </div>
            <div class="col-md mx-4">
                <div class="form-floating">
                    @if($trabjasig->measurement_date != '')
                    <input wire:model="ezclip_background_dose" type="NUMBER" class="form-control" name="ezclip_background_dose" id="ezclip_background_dose" value="{{$trabjasig->Ezclip_background_dose}}" readonly>
                    @else
                    <input wire:model="ezclip_background_dose" type="NUMBER" step="any" class="form-control" name="ezclip_background_dose" id="ezclip_background_dose" value="{{$trabjasig->Ezclip_background_dose}}">
                    @endif
                    <label for="floatingInputGrid">EzClip BACKGROUND DOSE:</label>
                </div>
            </div>
            <div class="col-md mx-4">
                <div class="form-floating">
                    @if($trabjasig->measurement_date != '')
                    <input wire:model="ezclip_raw_dose" type="NUMBER" class="form-control" name="ezclip_raw_dose" id="ezclip_raw_dose" value="{{$trabjasig->Ezclip_raw_dose}}" readonly>
                    @else
                    <input wire:model="ezclip_raw_dose" type="NUMBER" step="any" class="form-control" name="ezclip_raw_dose" id="ezclip_raw_dose" value="{{$trabjasig->Ezclip_raw_dose}}">
                    @endif
                    <label for="floatingInputGrid">EzClip RAW DOSE:</label>
                </div>
            </div>
        </div>
        <br>
        <div class="row g-2">
            <div class="col-md mx-4">
                <div class="form-floating">
                    @if($trabjasig->measurement_date != '')
                    <input wire:model="hp3_calc_dose" type="NUMBER" class="form-control" name="hp3_calc_dose" id="hp3_calc_dose" value="{{$trabjasig->Hp3_calc_dose}}" readonly>
                    @else
                    <input wire:model="hp3_calc_dose" type="NUMBER" step="any" class="form-control" name="hp3_calc_dose" id="hp3_calc_dose" value="{{$trabjasig->Hp3_calc_dose}}">
                    @endif
                    <label for="floatingInputGrid">Hp3 CALC DOSE:</label>
                </div>
            </div>
            <div class="col-md mx-4">
                <div class="form-floating">
                    @if($trabjasig->measurement_date != '')
                    <input wire:model="hp3_background_dose" type="NUMBER" class="form-control" name="hp3_background_dose" id="hp3_background_dose" value="{{$trabjasig->Hp3_background_dose}}" readonly>
                    @else
                    <input wire:model="hp3_background_dose" type="NUMBER" step="any" class="form-control" name="hp3_background_dose" id="hp3_background_dose" value="{{$trabjasig->Hp3_background_dose}}">
                    @endif
                    <label for="floatingInputGrid">Hp3 BACKGROUND DOSE:</label>
                </div>
            </div>
            <div class="col-md mx-4">
                <div class="form-floating">
                    @if($trabjasig->measurement_date != '')
                    <input wire:model="hp3_raw_dose" type="NUMBER" class="form-control" name="hp3_raw_dose" id="hp3_raw_dose" value="{{$trabjasig->Hp3_raw_dose}}" readonly>
                    @else
                    <input wire:model="hp3_raw_dose" type="NUMBER" step="any" class="form-control" name="hp3_raw_dose" id="hp3_raw_dose" value="{{$trabjasig->Hp3_raw_dose}}">
                    @endif
                    <label for="floatingInputGrid">Hp3 RAW DOSE:</label>
                </div>
            </div>
        </div>
        <br>
        <div class="row g-2">
            <div class="col-md mx-4">
                <div class="form-floating">
                    @if($trabjasig->measurement_date != '')
                    <input wire:model="measurement_date"  type="date" class="form-control" name="measurement_date"  id="measurement_date" value="{{$trabjasig->measurement_date}}" readonly>
                    @else
                    <input wire:model="measurement_date" type="date" class="form-control" name="measurement_date"  id="measurement_date" value="{{$trabjasig->measurement_date}}">
                    @endif
                    <label for="floatingInputGrid">MEASUREMENT DATE:</label>
                </div>
            </div>
            <div class="col-md mx-4">
                <div class="form-floating">
                    @if($trabjasig->measurement_date != '')
                    <input wire:model="zeroLevel_date" type="date" class="form-control" name="zeroLevel_date" id="zeroLevel_date" value="{{$trabjasig->zero_level_date}}" readonly>
                    @else
                    <input wire:model="zeroLevel_date" type="date" class="form-control" name="zeroLevel_date" id="zeroLevel_date" value="{{$trabjasig->zero_level_date}}">
                    @endif
                    <label for="floatingInputGrid">ZERO LEVEL DATE:</label>
                </div>
            </div>
            <div class="col-md mx-4">
                <div class="form-floating">
                    @if($trabjasig->measurement_date != '')
                    <input wire:model="h10_cal_dose" type="NUMBER" class="form-control" name="h10_cal_dose" id="h10_cal_dose" value="{{$trabjasig->H_10_calc_dose}}" readonly>
                    @else
                    <input wire:model="h10_cal_dose" type="NUMBER" step="any" class="form-control" name="h10_cal_dose" id="h10_cal_dose" value="{{$trabjasig->H_10_calc_dose}}">
                    @endif
                    <label for="floatingInputGrid">H*(10) CALC DOSE:</label>
                </div>
            </div>
        </div>
        <br>
        <div class="row g-2">
            <div class="col-4 mx-4 ">
                <div class="form-floating">
                    @if($trabjasig->measurement_date != '')
                    <input wire:model="verification_Date" type="date" class="form-control" name="verification_Date" id="verification_Date" value="{{$trabjasig->verification_date}}" readonly>
                    @else
                    <input wire:model="verification_Date" type="date" class="form-control" name="verification_Date" id="verification_Date" value="{{$trabjasig->verification_date}}">
                    @endif
                    <label for="floatingInputGrid">VERIFICATION DATE:</label>
                </div>
            </div>
            <div class="col mx-4 ">
                <div class="form-floating">
                    @if($trabjasig->measurement_date != '')
                    <input wire:model="verification_required_before" type="date" class="form-control" name="verification_required_before" id="verification_required_before" value="{{$trabjasig->verification_required_on_or_before}}" readonly>
                    @else
                    <input wire:model="verification_required_before" type="date" class="form-control" name="verification_required_before" id="verification_required_before" value="{{$trabjasig->verification_required_on_or_before}}">
                    @endif
                    <label for="floatingInputGrid">VERIFICATION REQUIRED ON OR BEFORE:</label>
                </div>
            </div>
            
        </div>
        <br>
        <div class="row g-2">
            <div class="col-5 mx-4">
                <div class="form-floating">
                    @if($trabjasig->measurement_date != '')
                    <input wire:model="remaining_days_available_use" type="NUMBER" class="form-control" name="remaining_days_available_use" id="remaining_days_available_use" value="{{$trabjasig->remaining_days_available_for_use}}" readonly>
                    @else
                    <input wire:model="remaining_days_available_use" type="NUMBER" step="any" class="form-control" name="remaining_days_available_use" id="remaining_days_available_use" value="{{$trabjasig->remaining_days_available_for_use}}">
                    @endif
                    <label for="floatingInputGrid">REMAINING DAYS AVAILABLE FOR USE:</label>
                </div>
            </div>
            <div class="col-md">
                @if($trabjasig->measurement_date != '')
                    <div class="form-check">
                        @if($trabjasig->nota1 == 'TRUE')
                            <input wire:model="nota1" class="form-check-input" type="checkbox" value="TRUE" id="nota1" name="nota1" checked disabled>
                        @else
                            <input wire:model="nota1" class="form-check-input" type="checkbox" value="TRUE" id="nota1" name="nota1" disabled>
                        @endif
                        <label class="form-check-label" for="reverseCheck1">1 = Ninguna </label>
                    </div>
                    <div class="form-check">
                        @if($trabjasig->nota2 == 'TRUE')
                            <input wire:model="nota2" class="form-check-input" type="checkbox" value="TRUE" id="nota2" name="nota2" checked disabled>
                        @else
                            <input wire:model="nota2" class="form-check-input" type="checkbox" value="TRUE" id="nota2" name="nota2" disabled>
                        @endif
                        <label class="form-check-label" for="reverseCheck1">2 = Extraviado</label>
                    </div>
                    <div class="form-check">
                        @if($trabjasig->nota3 == 'TRUE')
                            <input wire:model="nota3" class="form-check-input" type="checkbox" value="TRUE" id="nota3" name="nota3" checked disabled>
                        @else
                            <input wire:model="nota3"  class="form-check-input" type="checkbox" value="TRUE" id="nota3" name="nota3" disabled>
                        @endif
                        <label class="form-check-label" for="reverseCheck1">3 = Supera la dosis permitida</label>
                    </div>
                    <div class="form-check">
                        @if($trabjasig->nota4 == 'TRUE')
                            <input wire:model="nota4" class="form-check-input" type="checkbox" value="TRUE" id="nota4" name="nota4" checked disabled>
                        @else
                            <input wire:model="nota4" class="form-check-input" type="checkbox" value="TRUE" id="nota4" name="nota4" disabled>
                        @endif
                        <label class="form-check-label" for="reverseCheck1">4 = Dosímetro reprocesado</label>
                    </div>
                    <div class="form-check">
                        @if($trabjasig->nota5 == 'TRUE')
                            <input wire:model="nota5" class="form-check-input" type="checkbox" value="TRUE" id="nota5" name="nota5" checked disabled>
                        @else
                            <input wire:model="nota5" class="form-check-input" type="checkbox" value="TRUE" id="nota5" name="nota5" disabled>
                        @endif
                        <label class="form-check-label" for="reverseCheck1">5 = Control no utilizado en la evaluación</label> 
                    </div>
                @else
                    <div class="form-check">
                        <input wire:model="nota1" class="form-check-input" type="checkbox" value="TRUE" id="nota1" name="nota1" checked>
                        <label class="form-check-label" for="reverseCheck1">
                            1 = Ninguna
                        </label>
                    </div>
                    <div class="form-check">
                        <input wire:model="nota2" class="form-check-input" type="checkbox" value="TRUE" id="nota2" name="nota2" wire:click="$emit('bloquearCampos({{$nota2}})')" >
                        <label class="form-check-label" for="reverseCheck1">
                            2 = Extraviado
                        </label>
                    </div>
                    <div class="form-check">
                        <input wire:model="nota3" class="form-check-input" type="checkbox" value="TRUE" id="nota3" name="nota3">
                        <label class="form-check-label" for="reverseCheck1">
                            3 = Supera la dosis permitida
                        </label>
                    </div>
                    <div class="form-check">
                        <input wire:model="nota4" class="form-check-input" type="checkbox" value="TRUE" id="nota4" name="nota4">
                        <label class="form-check-label" for="reverseCheck1">
                            4 = Dosímetro reprocesado
                        </label>
                    </div>
                    <div class="form-check">
                        <input wire:model="nota5" class="form-check-input" type="checkbox" value="TRUE" id="nota5" name="nota5">
                        <label class="form-check-label" for="reverseCheck1">
                            5 = Control no utilizado en la evaluación 
                        </label> 
                    </div>
                @endif
               
                
                
                
                
            </div>
        </div>
        
        <br>
        <!-- ----------------BOTON--------------- -->
        <div class="row g-2">
            <div class="col-md"></div>
            <div class="col-md"></div>
            <div class="col-md d-grid gap-2">
                @if($trabjasig->measurement_date != '')
                <input type="submit" class="btn colorQA mt-2" name="update" id="update" value="GUARDAR" disabled>
                @else
                <input type="submit" class="btn colorQA mt-2" name="update" id="update" value="GUARDAR">
                @endif
            </div>
            <div class="col-md"></div>
            <div class="col-md"></div>
        </div>
        
    </form>
</div>

<script
    src="https://code.jquery.com/jquery-3.6.0.js"
    integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
    crossorigin="anonymous">
</script>
<script>
    window.onload = function(){
        Livewire.on('campos', (nota2) => {
            alert("SE BLOQUEARAN LOS CAMPOS"+nota2);
        })
    }
</script>
{{-- <script type="text/javascript">
    $(document).ready(function() {
        @if($nota2 == 'TRUE')
            alert({{$nota2}});
        @endif
        
    })
    
</script> --}}
