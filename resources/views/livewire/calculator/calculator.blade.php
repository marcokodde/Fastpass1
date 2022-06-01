<div>
    <div class="mx-auto text-center items-center" id="header">
        <div align="center">
            <img src="{{asset('images/logo_ctc_calculator.png')}}" alt="" width="10%" id="logo">
        </div>
    </div>
    <div class="mx-auto text-center items-center justify-center">
        <h1 class="lg:text-5xl sm:text-lg">
            {{__('Interest Calculator')}}
        </h1>
        <label class="text-2xl font-pop">{{__('Enter the data to start')}}</label>
    </div>
    <br>

        <div class="grid lg:grid-cols-3 gap-1 sm:grid-cols-1">
            <div class="border-2 shadow border-collapse border-gray-600 m-8 py-4">
                {{-- Costo Vehículo --}}
                <div>
                    <h3 class="lg:text-3xl sm:text-sm">{{__("Vehicle Cost")}}</h3>
                    <input type="text"
                        wire:model="cost"
                        wire:change="calculate"
                        id="cost"
                        maxlength="15"
                        id="amount"
                        onkeydown="return filterFloat(event,this)">

                </div>

                {{-- Enganche --}}
                <div>
                    <h3 class="lg:text-3xl sm:text-sm">{{__("Downpayment")}}:</h3>
                    <input type="text"
                    wire:model="downpayment"
                    wire:change="calculate"
                    maxlength="15"
                    id="downpayment"
                    onkeydown="return filterFloat(event,this)">
                </div>

                {{-- Tasa de interés --}}
                <div>
                    <h3 class="lg:text-3xl sm:text-sm block">{{__("Rate")}}% :</h3>
                    <input type="number"
                    wire:model="rate"
                    wire:change="calculate"
                    min="1"
                    step="1"
                    id="rate"
                    class="w-1/2">
                </div>

                {{-- Plazo --}}
                <div>
                    <h3 class="lg:text-3xl sm:text-sm block">{{__("Term"). ' (' . __('Months') . ')'}} </h3>
                    <input type="number"
                    wire:model="plazo"
                    wire:change="calculate"
                    min="1"
                    max="99"
                    id="plazo"
                    class="w-1/2">
                </div>
            </div>

            {{--  Otras Agencias  --}}
            <div class="datos m-4 py-8">
                <label class="lg:text-3xl sm:text-sm">{{__('Others Agencies')}}</label>
                <hr class="border border-collapse border-white">
                <div class="datos">{{-- Costo Vehiculo --}}
                    <span class="text-lg font-normal">{{__("Vehicle Cost")}}:
                    </span>
                    <h5>
                        @if($cost) {{ number_format($cost, 0, '.', ',')}} @endif
                    </h5>
                </div>
                <hr class="border border-collapse border-white">
                <div class="datos">{{-- Enganche --}}
                    <span class="text-lg font-normal">{{__("Downpayment")}}:</span>
                    <h5>
                        @if($downpayment) {{ number_format($downpayment, 0, '.', ',')}} @endif
                    </h5>
                </div>
                <hr class="border border-collapse border-white">
                <div class="datos">{{-- Importe a financiar --}}
                    <span class="text-lg font-normal">{{__("Total Loan")}}:</span>
                    <h5>
                       @if($amount) {{ number_format($amount, 0, '.', ',')}} @endif
                    </h5>
                </div>
                <hr class="border border-collapse border-white">
                <div class="datos"> {{-- Pago Mensual --}}
                    <span class="text-lg font-normal">{{__("Monthly Payment")}}:</span>
                    <h5>
                        @if($others_amount_by_month) {{ number_format($others_amount_by_month, 2, '.', ',')}} @endif
                    </h5>
                </div>
                <hr class="border border-collapse border-white">
                <div class="datos"> {{-- Plazo en Meses --}}
                    <span class="text-lg font-normal">{{__("Months")}}:</span>
                    <h5>
                        @if($plazo) {{ $plazo}} @endif
                    </h5>
                </div>
                <hr class="border border-collapse border-white">
                <div class="datos"> {{--Pago Total --}}
                    <span class="text-lg font-normal">{{__("Full Payment")}}:</span>
                    <h5>
                        @if($others_amount_total) {{ number_format($others_amount_total, 2, '.', ',')}} @endif
                    </h5>
                </div>
                <hr class="border border-collapse border-white">
                <div class="datos">{{-- Diferencia --}}
                    <span class="text-lg font-normal">{{__("You Pay More")}}:</span>
                    <h5>
                        @if($others_amount_total-$ctc_amount_total)
                            ${{number_format($others_amount_total-$ctc_amount_total)}}
                        @endif
                    </h5>
                </div>
            </div>
            {{--  CTC 0 % Interes --}}
            <div  class="greendata m-4 py-8">
                <label class="lg:text-3xl sm:text-sm" id="whitein">{{__('0% Interest')}}</label>
                <hr class="border border-collapse border-white">
                <div class="greendata">{{-- Costo Vehiculo --}}
                    <span class="whitesub">{{__("Vehicle Cost")}}:
                    </span>
                    <h5>
                        @if($cost) {{ number_format($cost, 0, '.', ',')}} @endif

                    </h5>
                </div>
                <hr class="border border-collapse border-white">
                <div class="greendata">{{-- Enganche --}}
                    <span class="whitesub">{{__("Downpayment")}}:
                        <svg xmlns="http://www.w3.org/2000/svg" title="{{__('Add Downpayment')}}" class="h-5 w-5 inline" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                            <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" />
                        </svg>
                    </span>
                        <input type="text"
                        wire:model="editing"
                        wire:change="calculate"
                        maxlength="15"
                        onkeydown="return filterFloat(event,this)"
                        title="{{__('Add Downpayment')}}"
                        @if ($ctc_downpayment || $editing > $ctc_downpayment)
                            placeholder="{{ number_format($ctc_downpayment,0, '.', ',')}}"
                        @else
                            placeholder="{{ number_format($editing,0, '.', ',')}}"
                        @endif
                        class="form-control">
                </div>
                <hr class="border border-collapse border-white">
                <div class="greendata">{{-- Importe a financiar --}}
                    <span class="whitesub">{{__("Total Loan")}}:</span>
                    <h5>
                       @if($ctc_amount) {{ number_format($ctc_amount, 0, '.', ',')}} @endif
                    </h5>
                </div>
                <hr class="border border-collapse border-white">
                <div class="greendata" align=""> {{-- Pago Mensual --}}
                    <span class="whitesub">{{__("Monthly Payment")}}:</span>
                    <h5>
                       @if($ctc_amount_by_month) {{ number_format($ctc_amount_by_month, 2, '.', ',')}} @endif
                    </h5>
                </div>
                <hr class="border border-collapse border-white">
                <div class="greendata" align=""> {{-- Plazo en Meses --}}
                    <span class="whitesub">{{__("Months")}}:</span>
                    <h5>
                        @if($ctc_plazo) {{ $ctc_plazo}} @endif
                    </h5>
                </div>
                <hr class="border border-collapse border-white">
                <div class="greendata" align=""> {{--Pago Total --}}
                    <span class="whitesub">{{__("Full Payment")}}:</span>
                    <h5>
                       @if($ctc_amount_total) {{ number_format($ctc_amount_total, 2, '.', ',')}} @endif
                    </h5>
                </div>
                <hr class="border border-collapse border-white">
                <div class="greendata" align="">{{-- Diferencia --}}
                    <span class="whitesub">{{__("Payment you save")}}:</span>
                    <h5>
                        @if($ctc_amount_total-$others_amount_total)
                            ${{number_format($ctc_amount_total-$others_amount_total)}}
                        @endif
                    </h5>
                </div>
            </div>
        </div>

        @if($cost && $downpayment && $rate && $plazo)
            <section>
                <div class="mx-auto text-center items-center justify-center" id="results">
                    <h1 class="text-5xl">{{__('Benefits')}}</h1>
                </div>
                <br>
                <div class="mx-auto text-center items-center justify-center" style="background-color: #EDEDED;">
                        <label class="block px-2 m-2 text-gray-700 text-lg font-pop">1) {{__("Based on the aggregate information, you save ")}}:
                            @if ($others_amount_total && $ctc_amount_total)
                                <span class="font-bold text-black">${{ number_format($others_amount_total-$ctc_amount_total)}}</span>
                            @endif
                        </label>

                        <label class="block px-2 m-2 text-gray-700 text-lg font-pop">2) {{__("You will finish paying for your vehicle in")}}
                            <span class="font-bold text-black">{{ $ctc_plazo }} {{__(' Months')}}</span>
                        </label>

                        {{-- Diferencia de meses --}}
                        @if($diference_plazo != 0 )

                            <label class="block px-2 m-2 text-gray-700 text-lg font-pop">
                                3)
                                @if($diference_plazo > 1)
                                    {{__("You save"). ' ' . $diference_plazo . ' ' . __('Months of payments')}}
                                @else
                                    {{__("You save"). ' ' . $diference_plazo . ' ' . __('Month of payments')}}

                                @endif
                        {{-- @else
                            <label class="block px-2 m-2 text-black text-2xl font-bold font-pop"> {{__("You save")}} --}}
                        @endif

                        @if ($ctc_downpayment && $downpayment && $ctc_downpayment != $downpayment)
                            <label class="block px-2 m-2 text-gray-700 text-lg font-pop">
                                @if($diference_plazo != 0 )
                                    4)
                                @else
                                    3)
                                @endif
                                {{__("just by investing $") . number_format($ctc_downpayment-$downpayment) . ' ' . __('more down payment')}}</label>
                            </label>

                        @endif
                </div>
            </section>
            <br>
            <div align="center">
                <h1 class="text-5xl">{{__('Start saving today!')}}</h1>
                <button>{{__('Find out if you apply')}}</button>
            </div>
        @endif

        <br>
</div>

