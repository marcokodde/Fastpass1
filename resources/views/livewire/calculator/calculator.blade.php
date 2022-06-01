<div>
    <table width="100%%" id="header" height="5%">
        <tbody>
          <tr>
            <td height="103" ><p>
                <img src="{{asset('images/logo_ctc_calculator.png')}}" alt="" width="10%" id="logo" ></p>
            <p>&nbsp;</p></td>
          </tr>
        </tbody>
    </table>
    <div id="title" align="center">
        <h2 align="center">
            {{__('Interest Calculator')}}
        </h2>
        {{__('Enter the data to start')}}
    </div>
    <div align="center">
        <table width="526" cellspacing="10" cellpadding="10" align="center">
            <tbody>
                <tr>
                    <td width="482">
                        <h4>{{__("Vehicle Cost")}}</h4>
                        <input type="text"
                        wire:model="cost"
                        wire:change="calcular"
                        id="cost"
                        maxlength="15"
                        id="amount"
                        onkeydown="return filterFloat(event,this)">
                    </td>
                </tr>
                <tr>
                    <td>
                        <h4>{{__("Downpayment")}}:</h4>
                        <input type="text"
                        wire:model="downpayment"
                        wire:change="calcular"
                        maxlength="15"
                        id="downpayment"
                        onkeydown="return filterFloat(event,this)">
                    </td>
                </tr>
                <tr>
                    <td>
                        <h4>{{__("Rate")}}% :</h4>
                        <input type="number"
                        wire:model="rate"
                        wire:change="calcular"
                        min="1"
                        step="1"
                        id="rate"
                        class="w-1/2">
                    </td>
                </tr>
            
                <tr>
                    <td>
                        <h4>{{__("Term"). ' (' . __('Months') . ')'}} </h4>
                        <input type="number"
                        wire:model="plazo"
                        wire:change="calcular"
                        min="1"
                        max="99"
                        id="plazo"
                        class="w-1/2">
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <section>
        <div align="center" id="results">
            <h1>{{__('Results')}}</h1>
        </div>
        <br>
        <div align="center">
            <table width="800" class="comparation" cellspacing="none" border="none">
                <tbody>
                    <tr>
                        <td width="400" height="93" align="center" class="datos">
                            <h2>{{__('Others Agencies')}}</h2>
                        </td>
                        <td width="400" align="center" class="greendata">
                            <h2 id="whitein">{{__('0% Interest')}}</h2>
                        </td>
                    </tr>
                    {{-- Costo Vehiculo --}}
                    <tr>
                        <td class="datos" align="">
                            <h4>{{__("Vehicle Cost")}}:
                            </h4>
                            <h4>
                                {{ number_format($cost, 0, '.', ',')}}
                            </h4>
                        </td>
                        <td class="greendata" align="">
                            <h4 class="whitesub">{{__("Vehicle Cost")}}:
                            </h4>
                            <h4>
                                {{ number_format($cost, 0, '.', ',')}}
                            </h4>
                        </td>
                    </tr>
                    {{-- Enganche --}}
                    <tr>
                        <td class="datos"><h4>{{__("Downpayment")}}:</h4>
                            {{ number_format($downpayment, 0, '.', ',')}}
                        </td>
                        <td class="greendata" align="">
                            <h4 class="whitesub">{{__("Downpayment")}}:</h4>
                            <h4>
                                {{ number_format($ctc_downpayment,0, '.', ',')}}
                            </h4>
                        </td>
                    </tr>

                    {{-- Importe a financiar --}}
                    <tr>
                        <td class="datos">
                            <h4>{{__("Total Loan")}}:</h4>
                                {{ number_format($amount, 0, '.', ',')}}
                            </td>
                        <td class="greendata" align=""><h4 class="whitesub">{{__("Total Loan")}}:</h4>
                            <h4>
                                {{ number_format($ctc_amount, 0, '.', ',')}}
                            </h4>
                        </td>
                    </tr>
                    {{-- Pago Mensual --}}
                    <tr>
                        <td class="datos">
                            <h4>{{__("Monthly Payment")}}:</h4>
                            {{ number_format($others_amount_by_month, 2, '.', ',')}}
                            </td>
                        <td class="greendata" align=""><h4 class="whitesub">{{__("Monthly Payment")}}:</h4>
                            <h4>
                                {{ number_format($ctc_amount_by_month, 2, '.', ',')}}
                            </h4>
                        </td>
                    </tr>
                    {{-- Plazo en Meses --}}
                    <tr>
                        <td class="datos">
                            <h4>{{__("Months")}}:</h4>
                            {{ $plazo}}
                            </td>
                        <td class="greendata" align=""><h4 class="whitesub">{{__("Months")}}:</h4>
                            <h4>
                                {{ $ctc_plazo}}
                            </h4>
                        </td>
                    </tr>

                    {{--Pago Total --}}
                    <tr>
                        <td class="datos">
                            <h4>{{__("Full Payment")}}:</h4>
                            {{ number_format($others_amount_total, 2, '.', ',')}}
                            </td>
                        <td class="greendata" align=""><h4 class="whitesub">{{__("Full Payment")}}:</h4>
                            <h4>
                                {{ number_format($ctc_amount_total, 2, '.', ',')}}
                            </h4>
                        </td>
                    </tr>

                    {{-- Diferencia --}}
                    <tr>
                        <td class="datos">
                            <h4>{{__("You Pay More")}}:</h4>
                            ${{number_format($others_amount_total-$ctc_amount_total)}}
                            </td>
                        <td class="greendata" align=""><h4 class="whitesub">{{__("Payment you save")}}:</h4>
                            <h4>
                                ${{number_format($ctc_amount_total-$others_amount_total)}}
                            </h4>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>
    <section>
        <div align="center" id="results"> <h1>{{__('Benefits')}}</h1>
        </div>
        <br>
        <div class="benefits" align="center">
            <table width="700" align="center">
                <tbody class="text-center" >
                    <tr class="text-center" >
                        <td class="text-center"  align="center">
                            <div class="mx-auto text-center items-center">
                                <label class="block px-2 m-2 text-gray-700 text-lg font-pop">1) {{__("Based on the information entered")}}</label>
                                @if ($others_amount_total && $ctc_amount_total)
                                    <label class="block px-2 m-2 text-gray-700 text-2xl font-pop font-bold">{{__("You save a total of $") . number_format($others_amount_total-$ctc_amount_total) . ' ' . __('')}}</label>
                                @endif
    
                                <label class="block px-2 m-2 text-gray-700 text-lg font-pop">2) {{__("You will finish paying for your vehicle in") . $ctc_plazo . ' ' . __('Months')}}</label>
    
                                {{-- Diferencia de meses --}}
                                @if($diference_plazo)
                                    <label class="block px-2 m-2 text-gray-700 text-lg font-pop">{{__("You save"). ' ' . $diference_plazo . ' ' . __('Months of payments')}}</label>
                                @endif
    
                                @if ($ctc_downpayment && $downpayment)
                                    <label class="block px-2 m-2 text-gray-700 text-lg font-pop">3) {{__("Just paying $") . number_format($ctc_downpayment-$downpayment, 2, '.', ',') . ' ' . __('more hitch')}}</label>
                                @endif
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>
<br>
<div align="center">
    <h1>{{__('Start saving today!')}}</h1>
    <button>{{__('Find out if you apply')}}</button>
</div>
<br>
</div>
<script src="{{asset('js/calculadora.js')}}"></script>