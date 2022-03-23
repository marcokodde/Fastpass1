<div class="relative mt-12">
    @if ($record->garage)
        <div class="vehicle shadow-2xl">
            @if($record->inventory->images)
                @php
                    $value = explode(",", $record->inventory->images);
                @endphp

                @if($value[0])
                    <div class="box_to_image" style="width:300px;">
                        <img src="{{ $value[0] }}" alt="{{ __('Not Image') }}">
                    </div>
                @else
                    <img class="h-44 w-44" src="{{ asset('images/default_image.png') }}" alt="">
                @endif
            @else
                @if($record->images)
                    <div class="box_to_image" style="width:300px;">
                        <img src="{{ $record->images }}" alt="{{ __('Not Image') }}">
                    </div>
                @else
                    <img class="h-44 w-44" src="{{ asset('images/default_image.png') }}" alt="">
                @endif
            @endif

            @if($record->inventory->vin || $record->inventory->make || $record->inventory->model )
                <label class="text-lg text-black font-oswald font-bold block">{{$record->inventory->year}} {{$record->inventory->make}} {{$record->inventory->model}}</label>
            @else
                <p>{{ __('No data available') }}</p>
            @endif

            @if($record->inventory->mileage)
                <label class="font-oswald block">{{ number_format($record->inventory->mileage, 0, '.', ',') }} {{ __('MILES') }}</label>
            @else
                <p>{{__('No data available') }}</p>
            @endif

            @if($record->inventory->stock)
                <label class="font-oswald block">{{__('STOCK')}} {{ $record->inventory->stock }}</label>
            @else
                <p>{{__('No data available') }}</p>
            @endif

            @if($record->inventory->retail_price)
                <h3 class="mt-2 @if ($record->inventory->sold_out) line-through @endif">{{ __('Price') }}: ${{ number_format($record->inventory->retail_price, 0, '.', ',') }}</h3>
            @elseif ($record->sale_price)
                <h3 class="mt-2 @if ($record->inventory->sold_out) line-through @endif">{{ __('Price') }}: ${{ number_format($record->sale_price, 0, '.', ',') }}</h3>
            @else
                <h5 class="mt-2 font-bold">{{__('Price data not available') }}</h5>
            @endif

            @if($record->is_additional_next_tier && $record->inventory->sold_out)
                <h5 class="mt-2 font-bold text-red-600">{{__('Additional Down Payment') }}</h5>
            @endif

            @if ($record->inventory->sold_out)
                <h3 class="mt-2 font-bold text-red-600">{{__('Vehicle Sold!') }}</h3>
            @endif

            <div class="mb-2">
                @if (!$record->inventory->sold_out)
                    <button type="button" class="bg-gray-600 font-bold text-white px-8 pb-4 py-4 m-4 rounded relative border-2 border-gray-700 disabled" disabled>
                        {{__('IN MY GARAGE')}}
                    </button>
                @else
                    <button type="button" class="bg-red-600 font-bold text-white px-8 pb-4 py-4 m-4 rounded relative border-2 border-red-700 disabled" disabled>
                        {{__('SOLD OUT')}}
                    </button>
                @endif
            </div>
        </div>
    @endif
</div>
