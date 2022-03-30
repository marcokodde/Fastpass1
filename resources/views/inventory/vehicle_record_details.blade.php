

<div class="vehicle-content container">
    <div class="custom-vehicle-wrap">
        @include('inventory.vehicle_record_start_aproval')
        <div class="custom-vehicle-details">
            <div class="vehicle-details">
                <div class="custom-nav-tabs">
                    <a class="custom-nav-item active" data-controls="overview">{{__('Overview')}}</a>
                </div>
                <div class="custom-tab-content">
                    <div class="custom-tab-pane active" id="overview">
                        <div class="custom-flexrow">
                            <div class="custom-flexcol">
                                <div class="listing-wrap">
                                    <div class="header uppercase">{{ __('Basic Details') }}</div>
                                    <ul class="listing-features-list">
                                        <li><span>Stock #</span>
                                            <span>
                                                @if($vehicle->stock)
                                                    {{ $vehicle->stock }}
                                                @else
                                                    {{ __('Stock Code not available') }}
                                                @endif
                                            </span>
                                        </li>
                                        <li><span>VIN</span><span>{{ $vehicle->vin }}</span></li>
                                        <li><span>{{ __('Miles') }}</span>
                                            <span>
                                                @if($vehicle->mileage)
                                                    {{ number_format($vehicle->mileage, 0, '.', ',') }} {{ __('MILES') }}
                                                @else
                                                    {{ __('Miles data not available') }}
                                                @endif
                                            </span>
                                        </li>
                                        <li><span>{{ __('Body Type') }}</span><span>{{ $vehicle->body }}</span></li>
                                        <li>
                                            <span>{{ __('Engine Type') }}</span>
                                            <span>
                                                @if($vehicle->trim )
                                                    {{ $vehicle->trim }}
                                                @else
                                                    {{ __('Trim data not available') }}
                                                @endif
                                            </span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="custom-flexcol"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
