<div>
    @include('livewire.new_show_vehicles.index_header')
    <div class="sidemenu mt-12 w-96 absolute">
    </div>
    <div class="py-2 mt-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden sm:rounded-lg mt-2">
                @include('common.header_content')
                @if($show_garage && !$show_additional && $garage && $client->date_at)
                    <div class="grid items-center justify-center">
                        <div>
                            <label for="date" class="block font-headline font-semibold">
                                {{__('Your appointment to get your vehicle is')}}
                            </label>
                            <span class="block font-bold text-lg text-gray-700 font-headline uppercase">
                                {{date("l d F Y", strtotime($client->date_at))}},
                                {{date("g:i A", strtotime($client->date_at))}}
                            </span>
                        </div>
                    </div>
                @endif
                @if($isOpen)
                    @include('livewire.new_show_vehicles.add_appointment')
                @endif

                @if($show_additional && !$show_garage && $client_has_vehicles_with_downpayment)
                    @include('livewire.new_show_vehicles.amount_additional_downpayment')
                @endif

                <div class="body_container mt-2">
                    <div class="container">
                        <div class="row relative">
                            <div class="custom-vehicle-details relative">
                                @if(isset($records) && $records->count())
                                    <div class="vehicle-listings">
                                         {{-- Que estoy presentando: --}}
                                         {{-- Aprobados
                                         Adicionales
                                         Garage --}}

                                        @foreach ($records as $record )
                                            @include($view_to_show)
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if($show_garage && !$show_additional && !$garage)
                @include('livewire.new_show_vehicles.not_garage')
            @endif

        </div>
    </div>
    @if(!$show_garage && $client_has_vehicles_with_downpayment)
        @include('livewire.new_show_vehicles.advice_additional_vehicles')
    @endif

    @include('common.fastpass')
</div>
<script>
    history.forward()
</script>
