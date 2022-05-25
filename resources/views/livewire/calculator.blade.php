<div class="mx-auto text-center items-center">
    <div class="grid grid-cols-3 gap-2">
        <div>
        </div>
        <div class="well center-block" style="border: 1px solid rgb(150, 146, 146);">
            <div class="flex rounded-lg justify-between">
                <label class="inline px-2 m-2 text-gray-700 text-sm font-bold text-left">{{__("Costo del Vehiculo:")}}</label>
                <input type="text" maxlength="15" id="amount" value="45000"
                class="shadow m-1 appearance-none border rounded w-1/5 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" >
            </div>

            <div class="flex rounded-lg justify-between">
                <label class="inline px-2 m-2 text-gray-700 text-sm font-bold text-left">{{__("Enganche:")}}</label>
                <input type="text" maxlength="15" id="downpayment" onchange="calcular()" value="4500"
                class="shadow m-1 appearance-none border rounded w-1/5 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" >
            </div>

            <div class="flex rounded-lg justify-between">
                <label class="inline px-2 m-2 text-gray-700 text-sm font-bold text-left">{{__("%Interes:")}}</label>
                <input type="text" maxlength="15" id="rate" onchange="calcular()" value="4.9"
                class="shadow m-1 appearance-none border rounded w-1/5 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" >
            </div>

            <div class="flex rounded-lg justify-between">
                <label class="inline px-2 m-2 text-gray-700 text-sm font-bold text-left">{{__("Termino:")}}</label>
                <input type="text" maxlength="15" id="plazo" onchange="calcular()" value="60"
                class="shadow m-1 appearance-none border rounded w-1/5 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" >
            </div>

        </div>
        <div>
        </div>
    </div>
    <br>
    <div class="mx-auto items-center text-center">
        <div class="grid grid-cols-4 gap-2">
            <div>
            </div>
            <div class="h-96 w-96 border-2 border-collapse border-gray-500" style="border: 2px solid #000;">
                <label class="inline px-2 m-2 text-gray-700 text-lg font-pop font-semibold mb-4">{{__("Otras Agencias")}}</label>

                <div class="flex rounded-lg justify-between">
                    <label class="inline px-2 m-2 text-gray-700 text-sm font-bold">{{__("Total Prestamo")}}</label>
                    <input type="text" maxlength="15"
                    class="shadow m-1 appearance-none border rounded w-1/5 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" >
                </div>
                <div class="flex rounded-lg justify-between">
                    <label class="inline px-2 m-2 text-gray-700 text-sm font-bold text-left">{{__("Pago Mensual")}}</label>
                    <input type="text" maxlength="15"
                    class="shadow m-1 appearance-none border rounded w-1/5 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" >
                </div>
                <div class="flex rounded-lg justify-between">
                    <label class="inline px-2 m-2 text-gray-700 text-sm font-bold text-left">{{__("Meses:")}}</label>
                    <input type="text" maxlength="15"
                    class="shadow m-1 appearance-none border rounded w-1/5 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" >
                </div>
                <div class="flex rounded-lg justify-between">
                    <label class="inline px-2 m-2 text-gray-700 text-sm font-bold text-left">{{__("Enganche:")}}</label>
                    <input type="text" maxlength="15"
                    class="shadow m-1 appearance-none border rounded w-1/5 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" >
                </div>
                <div class="flex rounded-lg justify-between">
                    <label class="inline px-2 m-2 text-gray-700 text-sm font-bold text-left">{{__("Pago de Intereses:")}}</label>
                    <input type="text" maxlength="15"
                    class="shadow m-1 appearance-none border rounded w-1/5 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" >
                </div>
                <div class="flex rounded-lg justify-between">
                    <label class="inline px-2 m-2 text-gray-700 text-sm font-bold text-left">{{__("TOTAL PAGADO:")}}</label>
                    <input type="text" maxlength="15"
                    class="shadow m-1 appearance-none border rounded w-1/5 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" >
                </div>

                <div class="flex text-white rounded justify-between mt-4">
                    <label class="inline px-2 m-2 text-white bg-red-600 rounded text-sm font-bold text-left">{{__("Pagas de Mas")}}:</label>
                    <input type="text" maxlength="15"
                    class="text-white" >
                </div>
            </div>

            {{--  Columna central 2  --}}
            <div class="h-96 w-96 border-2 border-collapse border-gray-500" style="border: 2px solid #000;">
                <label class="inline px-2 m-2 text-gray-700 text-lg font-pop font-semibold mb-4">{{__("Programa 0% de Interes")}}</label>

                <div class="flex rounded-lg justify-between">
                    <label class="inline px-2 m-2 text-gray-700 text-sm font-bold text-left">{{__("Total Prestamo:")}}</label>
                    <input type="text" maxlength="15"
                    class="shadow m-1 appearance-none border rounded w-1/5 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" >
                </div>
                <div class="flex rounded-lg justify-between">
                    <label class="inline px-2 m-2 text-gray-700 text-sm font-bold text-left">{{__("Pago Mensual:")}}</label>
                    <input type="text" maxlength="15"
                    class="shadow m-1 appearance-none border rounded w-1/5 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" >
                </div>
                <div class="flex rounded-lg justify-between">
                    <label class="inline px-2 m-2 text-gray-700 text-sm font-bold text-left">{{__("Meses:")}}</label>
                    <input type="text" maxlength="15"
                    class="shadow m-1 appearance-none border rounded w-1/5 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" >
                </div>
                <div class="flex rounded-lg justify-between">
                    <label class="inline px-2 m-2 text-gray-700 text-sm font-bold text-left">{{__("Enganche:")}}</label>
                    <input type="text" maxlength="15"
                    class="shadow m-1 appearance-none border rounded w-1/5 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" >
                </div>
                <div class="flex rounded-lg justify-between">
                    <label class="inline px-2 m-2 text-gray-700 text-sm font-bold text-left">{{__("Pago de Intereses:")}}</label>
                    <input type="text" maxlength="15"
                    class="shadow m-1 appearance-none border rounded w-1/5 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" >
                </div>
                <div class="flex rounded-lg justify-between">
                    <label class="inline px-2 m-2 text-gray-700 text-sm font-bold text-left">{{__("TOTAL PAGADO:")}}</label>
                    <input type="text" maxlength="15"
                    class="shadow m-1 appearance-none border rounded w-1/5 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" >
                </div>

                <div class="flex rounded justify-between  mt-4">
                    <label class="inline px-2 m-2 text-white bg-green-600 rounded text-sm font-bold text-left">{{__("Ahorras")}}:</label>
                    <input type="text" maxlength="15"
                    class="shadow m-1 appearance-none border rounded w-1/5 py-2 px-3 text-white leading-tight focus:outline-none focus:shadow-outline" >
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
            <label class="block px-2 m-2 text-gray-700 text-lg font-pop">{{__("Ahorras un total de $14,000.00")}}</label>
            <label class="block px-2 m-2 text-gray-700 text-lg font-pop">{{__("Terminaras de pagar tu vehiculo en 36 Meses")}}</label>
            <label class="block px-2 m-2 text-gray-700 text-lg font-pop">{{__("Te ahorras 12 Meses de pagos")}}</label>
            <label class="block px-2 m-2 text-gray-700 text-lg font-pop">{{__("Tan solo con pagar $3,000 mas de enganche")}}</label>
            <label class="block px-2 m-2 text-gray-700 text-2xl font-pop font-bold">{{__("Comienza ahorrar hoy mismo")}}</label>
        </div>
        <button type="button"
            wire:click=""
            style="background-color: #36c947"
            class="button mx-2 px-8 py-4 mt-4  text-black font-semibold rounded-lg hover:text-white">
        {{__("Descubre si calificas")}}
    </div>
</div>
