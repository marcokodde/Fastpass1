<div class="vehicle-listings">
    @foreach ($records as $record )
        @if($show_garage)
            @include('livewire.suggested_vehicles.my_garage_list')
        @elseif($show_additional)
            @include('livewire.suggested_vehicles.additional_list')
        @else
            @include('livewire.suggested_vehicles.suggested_list')
        @endif
    @endforeach
</div>
