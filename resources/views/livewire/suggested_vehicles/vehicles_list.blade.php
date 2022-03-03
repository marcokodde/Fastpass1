<div class="vehicle-listings">
    @foreach ($records as $record )
        @if($show_garage)
            @include('livewire.suggested_vehicles.my_garage_list')
        @else
            @include('livewire.suggested_vehicles.suggested_list')
        @endif
    @endforeach
</div>
