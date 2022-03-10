<div>
    @include('livewire.new_show_vehicles.index_header')
    <div class="sidemenu mt-12 w-64 absolute">
    </div>
    <div class="py-2 mt-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden sm:rounded-lg mt-2">
                @include('common.header_content')

                @if($show_additional && !$show_garage && $client_has_vehicles_with_downpayment)
                    @include('livewire.new_show_vehicles.amount_additional_downpayment')
                @endif

                <div class="body_container mt-2">
                    <div class="container">
                        <div class="row relative">
                            <div class="custom-vehicle-details relative">
                                @if(isset($records) && $records->count())
                                <div class="vehicle-listings">
                                    @foreach ($records as $record )
                                        @include($view_to_show)
                                    @endforeach
                                </div>
                                    {{-- @include('livewire.show_vehicles.vehicles_list') --}}
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if(!$show_garage && $client_has_vehicles_with_downpayment)
        @include('livewire.new_show_vehicles.advice_additional_vehicles')
    @endif

    @include('common.fastpass')
</div>
