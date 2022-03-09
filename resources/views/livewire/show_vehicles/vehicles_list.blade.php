<div class="vehicle-listings">
    @foreach ($records as $record )
        @if($show_garage)
            @include('livewire.show_vehicles.my_garage_list')
        @elseif($show_additional)
            @include('livewire.show_vehicles.additional_list')
        @else
            @include('livewire.show_vehicles.suggested_list')
        @endif
    @endforeach
</div>
