<div class="single-heading-wrap">

    <div class="container">
        <h1 class="title">{{ $vehicle->year }} {{ $vehicle->make }} {{ $vehicle->model }}</h1>
        <p class="info">
            @if($vehicle->mileage)
                {{ number_format($vehicle->mileage, 0, '.', ',') }} {{ __('MILES') }}
            @else
                {{ __('Miles data not available') }}
            @endif
            @if($vehicle->stock)
                &nbsp;|&nbsp; STOCK {{ $vehicle->stock }}
            @else
                &nbsp;|&nbsp;  {{ __('Stock Code not available') }}
            @endif
        </p>

    </div>
</div>

<script src="//dealermade.com/assets/media-layer/v2/dm.js"
    data-dm-dealership-id="coast-to-coast-motors"
    data-dm-insert-before-element-attribute="class"
    data-dm-insert-before-element-attribute-value="vehicle-details"
    data-dm-vehicle-vin="{{ $vehicle->vin }}">
</script>
<div class="vehicle-details"></div>

<div class="gallery-block">
    <div class="container">
        <div class="flex-gallery">
            <ul class="slides">
                @if($vehicle->images)
                    @foreach ( explode(",", $vehicle->images) as $image_url)
                        @if(!$loop->first)
                            <li><img src="{{ $image_url }}"/></li>
                        @endif
                    @endforeach
                @endif
            </ul>
        </div>
    </div>
</div>