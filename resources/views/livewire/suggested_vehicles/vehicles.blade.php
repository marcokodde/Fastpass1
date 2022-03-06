<div>
    @include('livewire.suggested_vehicles.index')
    <div class="sidemenu mt-12 w-64 absolute">
    </div>
    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @include('common.session_warning')

            <div class="bg-white overflow-hidden sm:rounded-lg mt-2">
                @include('common.header_content')
                <div class="body_container mt-2">
                    <div class="container">
                        <div class="row">
                            <div class="custom-vehicle-details">
                                @include('livewire.suggested_vehicles.vehicles_list')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @if($client_has_vehicles_with_downpayment && !$show_garage)
        @include('livewire.suggested_vehicles.advice_additional_vehicles')
        @include('livewire.suggested_vehicles.amount_additional_downpayment')
    @endif

</div>
