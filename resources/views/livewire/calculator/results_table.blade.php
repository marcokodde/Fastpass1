<div class="h-96 w-96 border-2 border-collapse border-gray-500" style="border: 2px solid #000;">
    <table class="table table-bordered">
        <thead>
          <tr>
            <th></th>
            <th>{{__("Other  Dealers")}}</th>
            <th>{{__("0% Interest Program")}}</th>
          </tr>
        </thead>
        <tbody>
            {{-- Costo Vehiculo --}}
          <tr class="border-2">
            <td>{{__("Vehicle Cost")}}</td>
            <td class="text-right">{{ number_format($cost, 0, '.', ',')}}</td>
            <td class="text-right">{{ number_format($cost, 0, '.', ',')}}</td>
          </tr>

          {{-- Enganche --}}
          <tr>
            <td>{{__("Downpayment")}}</td>
            <td class="text-right">{{ number_format($downpayment, 0, '.', ',')}}</td>
            <td class="text-right">{{ number_format($ctc_downpayment,0, '.', ',')}}</td>
          </tr>

          {{-- Importe a financiar --}}
          <tr>
            <td>{{__("Total Loan")}}</td>
            <td class="text-right">{{ number_format($amount, 0, '.', ',')}}</td>
            <td class="text-right">{{ number_format($ctc_amount, 0, '.', ',')}}</td>
          </tr>

          {{-- Pago Mensual --}}
          <tr>
            <td>{{__("Monthly Payment")}}</td>
            <td class="text-right">{{ number_format($others_amount_by_month, 2, '.', ',')}}</td>
            <td class="text-right">{{ number_format($ctc_amount_by_month, 2, '.', ',')}}</td>
          </tr>

          {{-- Plazo en Meses --}}
          <tr>
            <td>{{__("Months")}}</td>
            <td class="text-right">{{ $plazo}}</td>
            <td class="text-right">{{ $ctc_plazo}}</td>
          </tr>

          {{--Pago Total --}}
          <tr>
            <td >{{__("Full Payment")}}</td>
            <td class="text-right">{{ number_format($others_amount_total, 2, '.', ',')}}</td>
            <td class="text-right">{{ number_format($ctc_amount_total, 2, '.', ',')}}</td>
          </tr>

          {{-- Diferencia --}}
          <tr>
            <td>{{__("Full Payment")}}</td>
            <td class="text-white bg-red-600 rounded text-lg font-bold text-right">${{number_format($others_amount_total-$ctc_amount_total)}}</td>
            <td class="text-white bg-green-600 rounded text-lg font-bold text-right">${{number_format($ctc_amount_total-$others_amount_total)}}</td>
          </tr>

        </tbody>
      </table>

</div>
