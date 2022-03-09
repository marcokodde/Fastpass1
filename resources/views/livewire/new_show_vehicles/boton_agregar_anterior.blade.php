@if ($garage && !$garage->available_spaces_like_next_tier() && $garage->is_vehicle_in_garage($record->inventory->stock))
    <button disabled title="{{__('Vehicle Added')}}"
    type="button" class="bg-gray-600 text-white px-4 pb-2 py-2 m-2 rounded-lg relative uppercase">
    {{__('Added To Garage')}}
    </button>
@elseif ($garage && $garage->occupied_spaces_like_next_tier() && !$garage->available_spaces_like_next_tier() && $garage->not_available_spaces_like_next_tier())
    <button disabled title="{{__('Garage Full')}}"
    type="button" class="bg-gray-500 text-white px-8 pb-4 py-4 m-4 rounded-lg relative uppercase">
    {{__('Garage Full')}}
    </button>
@else
    <button type="button" style="background-color:#6AB04C"
        wire:click.prevent="$emit('add_to_garage', '{{$record->inventory->stock}}' )"
        class="text-black px-8 pb-4 py-4 m-4 rounded-lg relative uppercase">
    {{__('Add To Garage')}}
    </button>
@endif
