@if(!$garage)  <!-- No hay garage permite agregar lo que sea -->
    <button type="button"
            style="background-color:#6AB04C"
            wire:click.prevent="$emit('add_to_garage', '{{$record->inventory->stock}}' )"
            class="text-black px-8 pb-4 py-4 m-4 rounded-lg relative uppercase">
            {{__('Add To Garage')}}
    </button>
@else
    <!-- Es adicional y ya no hay lugar para adicionales -->
    @if($record->is_addional_downpayment() && !$garage->available_spaces_like_next_tier())
        <button type="button"
            disabled
            title="{{__('Garage Full')}}"
            class="bg-gray-500 text-white px-8 pb-4 py-4 m-4 rounded-lg relative uppercase">
        {{__('Garage Full')}}
        </button>

    @else
        <!-- ELSE de que es adicional y que no hay lugar para ellos-->
        @if($garage->available_spaces())  <!-- Hay garage y hay espacios -->
            @if($garage->is_vehicle_in_garage($record->inventory->stock)) <!-- Vehículo en el garage? -->
                <button type="button"
                        disabled
                        title="{{__('Vehicle Added')}}"
                        class="bg-gray-600 text-white px-4 pb-2 py-2 m-2 rounded-lg relative uppercase">
                        {{__('Added To Garage')}}
                </button>
            @else <!-- No está en el garage -->
                @if($record->is_addional_downpayment()) <!-- ¿Es de enganche adicional? -->
                    @if($garage->available_spaces_like_next_tier()) <!-- ¿Hay espacio para adicionales ? -->
                        <button type="button" style="background-color:#6AB04C"
                                wire:click.prevent="$emit('add_to_garage', '{{$record->inventory->stock}}' )"
                                class="text-black px-8 pb-4 py-4 m-4 rounded-lg relative uppercase">
                            {{__('Add To Garage')}}
                        </button>
                    @else
                        <button type="button"
                                disabled
                                title="{{__('Garage Full')}}"
                                class="bg-gray-500 text-white px-8 pb-4 py-4 m-4 rounded-lg relative uppercase">
                            {{__('Garage Full')}}
                        </button>
                    @endif
                @else <!-- No es adicional -->
                    <button type="button"
                            style="background-color:#6AB04C"
                            wire:click.prevent="$emit('add_to_garage', '{{$record->inventory->stock}}' )"
                            class="text-black px-8 pb-4 py-4 m-4 rounded-lg relative uppercase">
                    {{__('Add To Garage')}}
                    </button>

                @endif
            @endif
        @else
            <button type="button"
                    disabled
                    title="{{__('Garage Full')}}"
                    class="bg-gray-500 text-white px-8 pb-4 py-4 m-4 rounded-lg relative uppercase">
                {{__('Garage Full')}}
            </button>
        @endif

    @endif


@endif




