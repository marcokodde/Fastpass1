<div>
    @include('livewire.show_vehicles.index')
    <div class="sidemenu mt-12 w-64 absolute">
    </div>
    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- TODO: Mejorar la presentación de este mensaje --}}
            {{__('Error establishing the connection. Check the link and try again.')}}
        </div>
    </div>

</div>
