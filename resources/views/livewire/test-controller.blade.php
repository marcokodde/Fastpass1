<div>

    <div class="grid items-center justify-center mx-auto px-4">
        {{-- <div class="items-center">
            <label class="block mx-auto text-gray-600 text-center font-oswald text-xl font-semibold mb-4">
                {{ __('Please select the extra amount for your down payment.') }}
            </label>
            <div class="col-md-6 mx-4 px-4 mb-4">
                <input type="radio" wire:model.lazy="downpayment" id="250" value="250" >    <label class="sm:text-xs md:text-base 2xl:text-xl" >$250</label>
                <input type="radio" wire:model.lazy="downpayment" id="500" value="500" >    <label class="sm:text-xs md:text-base 2xl:text-xl ml-2 mr-4" >$500</label>
                <input type="radio" wire:model.lazy="downpayment" id="750" value="750" >    <label class="sm:text-xs md:text-base 2xl:text-xl ml-2 mr-4" >$750</label>
                <input type="radio" wire:model.lazy="downpayment" id="1000" value="1000" >  <label class="sm:text-xs md:text-base 2xl:text-xl ml-2 mr-4" >$1,000</label>
                <input type="radio" wire:model.lazy="downpayment" id="1250" value="1250" >  <label class="sm:text-xs md:text-base 2xl:text-xl ml-2 mr-4" >$1,250</label>
                <input type="radio" wire:model.lazy="downpayment" id="1500" value="1500" >  <label class="sm:text-xs md:text-base 2xl:text-xl ml-2 mr-4" >$1,500</label>
                <input type="radio" wire:model.lazy="downpayment" id="1750" value="1750" >  <label class="sm:text-xs md:text-base 2xl:text-xl ml-2 mr-4" >$1,750</label>
                <input type="radio" wire:model.lazy="downpayment" id="2000" value="2000" >  <label class="sm:text-xs md:text-base 2xl:text-xl ml-2 mr-4" >$2,000</label>
                <hr class="border-2 border-gray-300">
            </div>
        </div> --}}

        {{-- <div class="items-center">
            <div class="col-md-6 mx-4 px-4 mb-4">
                <label class="block mx-auto text-gray-600 text-center font-oswald text-xl font-semibold mb-4">
                    Botones creados con un for
                </label>

                @for($min=250;$min<=2000;$min=$min +250)
                    <input type="radio"
                            wire:model.lazy="downpayment"
                            value="{{$min}}"
                            id="{{$min}}">
                    <label class="sm:text-xs md:text-base 2xl:text-xl ml-2 mr-4" >{{$min}}</label>
                @endfor
            </div>
        </div> --}}
        <div class="col-md-6 mx-4 px-4 mb-4">
            <label class="block mx-auto text-gray-600 text-center font-oswald text-xl font-semibold mb-4">
                SLIDER MIN
            </label>
            <div class="items-center">
                <div class="flex overflow-x-auto space-x-5  justify-between">
                    <label>{{ $izquierdo_valor}}</label><label class="ml-30">{{ $derecho_valor}}</label>
                </div>
                <div class="flex">
                    <input type="range"
                            wire:model.lazy="izquierdo_valor"
                            min="{{$izquierdo_minimo}}"
                            max="{{ $izquierdo_maximo}}"
                            step="{{$range_step}}"
                            list="tickmarks"
                            wire:change="actualiza_minimo_derecho"
                          >

                          <datalist id="tickmarks">
                          <option value="0" label="0%"></option>
                          <option value="10"></option>
                          <option value="20"></option>
                          <option value="30"></option>
                          <option value="40"></option>
                          <option value="50" label="50%"></option>
                          <option value="60"></option>
                          <option value="70"></option>
                          <option value="80"></option>
                          <option value="90"></option>
                          <option value="100" label="100%"></option>
                          </datalist>
                    <input type="range"
                          wire:model.lazy="derecho_valor"
                          min="{{$derecho_minimo}}"
                          max="{{$derecho_maximo}}"
                          step="{{$range_step}}"
                          wire:change="actualiza_maximo_izquierdo"
                          class="-ml-1 relative"
                        >

                </div>
                {{-- <div class="flex overflow-x-auto space-x-5 justify-between">
                    <label>{{ $izquierdo_minimo . '-' . $izquierdo_maximo}}</label><label class="ml-50">{{ $derecho_minimo . '-' . $derecho_maximo}}</label>
                </div> --}}
            </div>
        </div>


        {{-- <div class="col-md-6 mx-4 px-4 mb-4">
            <label class="block mx-auto text-gray-600 text-center font-oswald text-xl font-semibold mb-4">
                CAMPO TIPO NUMBER
            </label>
            <div class="items-center">
                <div class="flex items-center justify-center mt-4">
                   <label class="font-oswald text-xl font-semibold">{{ __('Amount to Additional Payment') }}</label>
                    <span>
                        <input type="number"
                                wire:model.lazy="downpayment"
                                list="downpayments"
                                min="{{env('APP_TO_PAYMENT_MIN',2000)}}"
                                max="{{env('APP_TO_PAYMENT_MAZ',2000)}}"
                                step="{{env('APP_TO_PAYMENT_RANGE',2000)}}"
                                class="ml-10"
                        >
                    </span>
                    <datalist id="downpayments">
                        @for($min=500;$min<=4000;$min=$min +500)
                            <option value="{{$min}}">
                        @endfor

                    </datalist>
                </div>
            </div>
        </div> --}}

        <br>

    </div>

</div>
