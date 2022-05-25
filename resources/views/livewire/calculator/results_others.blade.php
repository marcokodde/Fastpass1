<div class="h-96 w-96 border-2 border-collapse border-gray-500" style="border: 2px solid #000;">
    <label class="inline px-2 m-2 text-gray-700 text-lg font-pop font-semibold mb-4">{{__("Other  Dealers")}}</label>

    <div class="flex rounded-lg justify-between">
        <label class="inline px-2 m-2 text-gray-700 text-sm font-bold">{{__("Vehicle Cost")}}</label>
        <label> {{ number_format($cost, 2, '.', ',')}} </label>
    </div>

    <div class="flex rounded-lg justify-between">
        <label class="inline px-2 m-2 text-gray-700 text-sm font-bold">{{__("Downpayment")}}</label>
        <label> {{ number_format($downpayment, 2, '.', ',')}} </label>
    </div>

    <div class="flex rounded-lg justify-between">
        <label class="inline px-2 m-2 text-gray-700 text-sm font-bold">{{__("Total Loan")}}</label>
        <label> {{ number_format($amount, 2, '.', ',')}} </label>
    </div>
    <div class="flex rounded-lg justify-between">
        <label class="inline px-2 m-2 text-gray-700 text-sm font-bold text-left">{{__("Monthly Payment")}}</label>
        <label> {{ number_format($others_amount_by_month, 2, '.', ',')}} </label>
    </div>

    <div class="flex rounded-lg justify-between">
        <label class="inline px-2 m-2 text-gray-700 text-sm font-bold text-left">{{__("Months")}}</label>
        <label> {{ $plazo}} </label>
    </div>

    <div class="flex rounded-lg justify-between">
        <label class="inline px-2 m-2 text-gray-700 text-sm font-bold text-left">{{__("Full Payment")}}</label>
        @if($others_amount_total)
        <label> {{ number_format($others_amount_total, 2, '.', ',')}} </label>
        @endif
    </div>

    <div class="flex text-white rounded justify-between mt-4">
        <label class="inline px-2 m-2 text-white bg-red-600 rounded text-lg font-bold text-left">{{__("You Pay More")}}:</label>
        <label class="inline px-2 m-2 text-white  rounded-lg text-lg bg-red-600 font-bold text-left">${{number_format($others_amount_total-$ctc_amount_total)}}</label>
    </div>
</div>
