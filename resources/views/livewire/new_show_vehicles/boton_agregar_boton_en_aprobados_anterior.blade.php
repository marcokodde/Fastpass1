@if ($garage && !$garage->has_space() && !$garage->available_spaces() && $garage->is_vehicle_in_garage($record->inventory->stock))
<button disabled title="{{__('Vehicle Added')}}"
type="button" class="bg-gray-600 text-white px-4 pb-4 py-4 m-4 rounded-lg relative uppercase">
{{__('Added To Garage')}}
</button>
@elseif($garage && $garage->not_available_spaces())
<button disabled title="{{__('Garage Full')}}"
type="button" class="bg-gray-500 text-white px-8 pb-4 py-4 m-4 rounded-lg relative uppercase">
{{__('Garage Full')}}
</button>
@elseif ($garage && $garage->is_vehicle_in_garage($record->inventory->stock))
<button disabled title="{{__('Vehicle Added')}}"
type="button" class="bg-gray-600 text-white px-4 pb-4 py-4 m-4 rounded-lg relative uppercase">
{{__('Added To Garage')}}
</button>
@else
<button type="button"
    wire:click.prevent="$emit('add_to_garage', '{{$record->inventory->stock}}' )"
    style="background-color: #6AB04C"
    class=" text-black px-8 pb-4 py-4 m-4 rounded-lg relative uppercase">
{{__('Add To Garage')}}
</button>
@endif
