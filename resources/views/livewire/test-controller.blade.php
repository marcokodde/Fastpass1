<div>
    <button type="button"
            wire:click.prevent="$emit('add_to_garage', 'PF07485' )"
            class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
        Probar Ventana Modal Para Confirmar
    </button>

   <label>EL RESULTADO ES:  {{ $saludo}} </label>

    @include('common.faspass')
</div>
