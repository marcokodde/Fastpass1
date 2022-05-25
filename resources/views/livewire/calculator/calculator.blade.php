<div class="mx-auto text-center items-center">
    <div class="grid lg:grid-cols-3 lg:gap-2 sm:grid-cols-1 sm:gap-1 mt-4">
        <div>
        </div>
        <div class="well center-block" style="border: 1px solid rgb(150, 146, 146);">
           {{-- Costo Vehículo --}}
            <div class="flex rounded-lg justify-between">
                <label for="cost"
                class="form-control inline px-2 m-2 text-gray-700 text-sm font-bold text-left">{{__("Vehicle Cost")}}:</label>
                <div class="col-12 col-md-6 col-lg-4">
                    <input type="text"
                    wire:model="cost"
                    wire:change="calcular"
                    id="cost"
                    maxlength="15"
                    id="amount"
                    class="text-right shadow m-1 appearance-none border rounded w-1/5 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    onkeydown="return filterFloat(event,this)"
                    >
                </div>
            </div>

            {{-- Enganche --}}
            <div class="flex rounded-lg justify-between">
                <label for="downpayment"
                class="inline px-2 m-2 text-gray-700 text-sm font-bold text-left">{{__("Downpayment")}}:</label>
                <div class="col-12 col-md-6 col-lg-4">
                    <input type="text"
                        wire:model="downpayment"
                        wire:change="calcular"
                        maxlength="15"
                        id="downpayment"
                        onkeydown="return filterFloat(event,this)"
                        class="text-right shadow m-1 appearance-none border rounded w-1/5 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    >
                </div>
            </div>

            {{-- Tasa de interés anual --}}
            <div class="flex rounded-lg justify-between">
                <label for="rate"
                    class="inline px-2 m-2 text-gray-700 text-sm font-bold text-left">{{__("Rate")}}% :</label>
                    <input type="number"
                        wire:model="rate"
                        wire:change="calcular"
                        min="1"
                        step="1"
                        id="rate"
                        class="text-right shadow m-1 appearance-none border rounded w-1/3 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    >
            </div>

            {{-- Plazo en meses --}}
            <div class="flex rounded-lg justify-between">
                <label  for="plazo"
                    class="inline px-2 m-2 text-gray-700 text-sm font-bold text-left">{{__("Term"). ' (' . __('Months') . ')'}} </label>
                    <input type="number"
                        wire:model="plazo"
                        wire:change="calcular"
                        min="1"
                        max="99"
                        id="plazo"
                        class="text-right shadow m-1 appearance-none border rounded w-1/3 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    >
            </div>
        </div>
        <div>
        </div>
    </div>
    <br>

    {{-- RESULTADOS --}}
    <div class="mx-auto items-center text-center">
        <div class="grid lg:grid-cols-4 lg:gap-2  sm:grid-cols-2 sm:gap-1">
            <div>
            </div>
            {{--  Columna 1 Otras Agencias --}}
             @include('livewire.calculator.results_others')

            {{--  Columna 2 CTC ahorro --}}

             @include('livewire.calculator.results_ctc')

            {{-- BENEFICIOS --}}
            <div>
            </div>
        </div>
        <br>
        <br>
        <div class="mx-auto text-center">
            <label class="block px-2 m-2 text-gray-700 text-2xl font-pop font-bold uppercase">{{__("Beneficios")}}</label>
            <label class="block px-2 m-2 text-gray-700 text-lg font-pop">{{__("En base a la informacion ingresada")}}</label>
            @if ($others_amount_total && $ctc_amount_total)
                <label class="block px-2 m-2 text-gray-700 text-2xl font-pop font-bold">{{__("Ahorras un total de $") . number_format($others_amount_total-$ctc_amount_total) . ' ' . __('')}}</label>
            @endif

            <label class="block px-2 m-2 text-gray-700 text-lg font-pop">{{__("Terminaras de pagar tu vehiculo en ") . $ctc_plazo . ' ' . __('Meses')}}</label>

            {{-- Diferencia de meses --}}
            @if($diference_plazo)
             <label class="block px-2 m-2 text-gray-700 text-lg font-pop">{{__("Te ahorras"). ' ' . $diference_plazo . ' ' . 'Meses de pagos'}}</label>

            @endif

            @if ($ctc_downpayment && $downpayment)
                 <label class="block px-2 m-2 text-gray-700 text-lg font-pop">{{__("Tan solo con pagar $") . number_format($ctc_downpayment-$downpayment, 2, '.', ',') . ' ' . __('mas de enganche')}}</label>
            @endif

            <label class="block px-2 m-2 text-gray-700 text-2xl font-pop font-bold">{{__("Comienza ahorrar hoy mismo")}}</label>
        </div>
        <button type="button"
            wire:click=""
            style="background-color: #36c947"
            class="button mx-2 px-8 py-4 mt-4  text-black font-semibold rounded-lg hover:text-white">
        {{__("Descubre si calificas")}}
    </div>
</div>
<script src="{{asset('js/calculadora.js')}}"></script>
