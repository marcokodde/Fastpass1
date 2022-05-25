<div class="mx-auto text-center items-center">
    <div class="grid lg:grid-cols-3 lg:gap-2 sm:grid-cols-1 sm:gap-1 mt-4">
        <div>
        </div>
        <div class="well center-block" style="border: 1px solid rgb(150, 146, 146);">
            <div class="flex rounded-lg justify-between">
                <label for="cost"
                class="form-control inline px-2 m-2 text-gray-700 text-sm font-bold text-left">{{__("Costo del Vehiculo:")}}</label>
                <div class="col-12 col-md-6 col-lg-4">
                    <input type="text"
                    wire:model="cost"
                    wire:change="calcular"
                    id="cost"
                    maxlength="15"
                    id="amount"
                    class="shadow m-1 appearance-none border rounded w-1/5 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    onkeydown="return filterFloat(event,this)"
                    >
                </div>
            </div>

            <div class="flex rounded-lg justify-between">
                <label for="downpayment"
                class="inline px-2 m-2 text-gray-700 text-sm font-bold text-left">{{__("Enganche:")}}</label>
                <div class="col-12 col-md-6 col-lg-4">
                    <input type="text"
                        wire:model="downpayment"
                        wire:change="calcular"
                        maxlength="15"
                        id="downpayment"
                        onkeydown="return filterFloat(event,this)"
                        class="shadow m-1 appearance-none border rounded w-1/5 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    >
                </div>
            </div>

            <div class="flex rounded-lg justify-between">
                <label for="rate"
                    class="inline px-2 m-2 text-gray-700 text-sm font-bold text-left">{{__("%Interes:")}}</label>
                    <input type="number"
                        wire:model="rate"
                        wire:change="calcular"
                        min="1"
                        step="1"
                        id="rate"
                        class="shadow m-1 appearance-none border rounded w-1/3 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    >
            </div>

            <div class="flex rounded-lg justify-between">
                <label  for="plazo"
                    class="inline px-2 m-2 text-gray-700 text-sm font-bold text-left">{{__("Plazo:")}}</label>
                    <input type="number"
                        wire:model="plazo"
                        wire:change="calcular"
                        min="1"
                        max="99"
                        id="plazo"
                        class="shadow m-1 appearance-none border rounded w-1/3 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    >
            </div>
        </div>
        <div>
        </div>
    </div>
    <br>
    <div class="mx-auto items-center text-center">
        <div class="grid lg:grid-cols-4 lg:gap-2  sm:grid-cols-2 sm:gap-1">
            <div>
            </div>
            {{--  Columna 1 Otras Agencias --}}
            <div class="h-96 w-96 border-2 border-collapse border-gray-500" style="border: 2px solid #000;">
                <label class="inline px-2 m-2 text-gray-700 text-lg font-pop font-semibold mb-4">{{__("Otras Agencias")}}</label>

                <div class="flex rounded-lg justify-between">
                    <label class="inline px-2 m-2 text-gray-700 text-sm font-bold">{{__("Total Prestamo")}}</label>
                    <label> {{ number_format($amount, 2, '.', ',')}} </label>
                </div>
                <div class="flex rounded-lg justify-between">
                    <label class="inline px-2 m-2 text-gray-700 text-sm font-bold text-left">{{__("Pago Mensual")}}</label>
                    <label> {{ number_format($others_amount_by_month, 2, '.', ',')}} </label>
                </div>

                <div class="flex rounded-lg justify-between">
                    <label class="inline px-2 m-2 text-gray-700 text-sm font-bold text-left">{{__("Meses:")}}</label>
                    <label> {{ $plazo}} </label>
                </div>
                <div class="flex rounded-lg justify-between">
                    <label class="inline px-2 m-2 text-gray-700 text-sm font-bold text-left">{{__("Enganche:")}}</label>
                    @if ($downpayment)
                        <label> {{ number_format($downpayment, 2, '.', ',')}} </label>
                    @endif
                </div>
                <div class="flex rounded-lg justify-between">
                    <label class="inline px-2 m-2 text-gray-700 text-sm font-bold text-left">{{__("Pago Mensual:")}}</label>
                    @if ($downpayment)
                        <label> {{ number_format($others_amount_by_month, 2, '.', ',')}} </label>
                    @endif
                </div>

                <div class="flex rounded-lg justify-between">
                    <label class="inline px-2 m-2 text-gray-700 text-sm font-bold text-left">{{__("PAGO TOTAL:")}}</label>
                    @if($others_amount_total)
                    <label> {{ number_format($others_amount_total, 2, '.', ',')}} </label>
                    @endif
                </div>

                <div class="flex text-white rounded justify-between mt-4">
                    <label class="inline px-2 m-2 text-white bg-red-600 rounded text-lg font-bold text-left">{{__("Pagas de Mas")}}:</label>
                    <label class="inline px-2 m-2 text-white  rounded-lg text-lg bg-red-600 font-bold text-left">${{number_format($others_amount_total-$ctc_amount_total)}}</label>
                </div>
            </div>

            {{--  Columna 2 CTC ahorro --}}
            <div class="h-96 w-96 border-2 border-collapse border-gray-500" style="border: 2px solid #000;">
                <label class="inline px-2 m-2 text-gray-700 text-lg font-pop font-semibold mb-4">{{__("Programa 0% de Interes")}}</label>

                <div class="flex rounded-lg justify-between">
                    <label class="inline px-2 m-2 text-gray-700 text-sm font-bold text-left">{{__("Total Prestamo:")}}</label>
                    @if ($ctc_amount)
                        <label> {{ number_format($ctc_amount, 2, '.', ',')}} </label>
                    @endif
                </div>

                <div class="flex rounded-lg justify-between">
                    <label class="inline px-2 m-2 text-gray-700 text-sm font-bold text-left">{{__("Pago Mensual:")}}</label>
                    @if($ctc_amount_by_month)
                        <label> {{ number_format($ctc_amount_by_month, 2, '.', ',')}} </label>
                    @endif
                </div>

                <div class="flex rounded-lg justify-between">
                    <label class="inline px-2 m-2 text-gray-700 text-sm font-bold text-left">{{__("Meses:")}}</label>
                    <label class="inline px-2 m-2 text-gray-700 text-sm font-bold text-left">{{$ctc_plazo}}</label>

                </div>

                <div class="flex rounded-lg justify-between">
                    <label for="ctc_downpayment"
                    class="inline px-2 m-2 text-gray-700 text-sm font-bold text-left">{{__("Enganche:")}}</label>
                    <div class="col-12 col-md-6 col-lg-4">
                        <input type="text"
                            wire:model="ctc_downpayment"
                            wire:change="calcular"
                            maxlength="15"
                            id="ctc_downpayment"
                            onkeydown="return filterFloat(event,this)"
                            class="shadow m-1 appearance-none border rounded w-1/5 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        >
                    </div>
                </div>
                <div class="flex rounded-lg justify-between">
                    <label class="inline px-2 m-2 text-gray-700 text-sm font-bold text-left">{{__("Pago de Intereses:")}}</label>
                    @if ($ctc_amount_total && $cost)
                        <label> {{ number_format($ctc_amount_total - $cost, 2, '.', ',')}}</label>
                    @endif
                </div>

                <div class="flex rounded-lg justify-between">
                    <label class="inline px-2 m-2 text-gray-700 text-sm font-bold text-left">{{__("TOTAL PAGADO:")}}</label>
                    @if ($ctc_amount_total)
                        <label> {{ number_format($ctc_amount_total, 2, '.', ',')}}</label>
                    @endif
                </div>

                <div class="flex rounded justify-between  mt-4">
                    <label class="inline px-2 m-2 text-white bg-green-600 rounded text-lg font-bold text-left">{{__("Ahorras")}}:</label>
                    <label class="inline px-2 m-2 text-black  rounded text-lg font-bold text-left">${{number_format($others_amount_total-$ctc_amount_total)}}</label>
                </div>
            </div>
            <div>
            </div>
        </div>
        <br>
        <br>
        <div class="mx-auto text-center">
            <label class="block px-2 m-2 text-gray-700 text-2xl font-pop font-bold uppercase">{{__("Beneficios")}}</label>
            <label class="block px-2 m-2 text-gray-700 text-lg font-pop">{{__("En base a la informacion ingresada")}}</label>
            @if ($others_amount_total)
                <label class="block px-2 m-2 text-gray-700 text-2xl font-pop font-bold">{{__("Ahorras un total de $") . number_format($others_amount_total-$ctc_amount_total) . ' ' . __('')}}</label>
            @endif
            <label class="block px-2 m-2 text-gray-700 text-lg font-pop">{{__("Terminaras de pagar tu vehiculo en ") . $ctc_plazo . ' ' . __('Meses')}}</label>
            <label class="block px-2 m-2 text-gray-700 text-lg font-pop">{{__("Te ahorras 12 Meses de pagos")}}</label>
            @if ($ctc_downpayment && $downpayment)
                <label class="block px-2 m-2 text-gray-700 text-lg font-pop">{{__("Tan solo con pagar $") . $ctc_downpayment-$downpayment . ' ' . __('mas de enganche')}}</label>
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