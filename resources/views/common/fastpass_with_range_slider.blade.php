<script>
    document.addEventListener('livewire:load', function() {
        @this.on('add_to_garage', stock_number => {
            Swal.fire({
                title: "{{__('Attention')}}",
                text: "{{__('By adding this vehicle you will decrease one space in your garage.')}}",
                showCancelButton: true,
                cancelButtonText: 'NO',
                cancelButtonColor: "#F40816",
                confirmButtonColor: "#6AB04C",
                confirmButtonText: "{{__('YES, ADD VEHICLE')}}",
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    @this.call('add_vehicle_to_garage', stock_number)
                }
            })
        })

        @this.on('downpayment_limits' => {
            alert('Se llama el método java script para atrapar los límites del downpayment')
        })
    })

    document.addEventListener

</script>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
<script>
    $( function() {
        $( "#slider-range" ).slider({
            range: true,
            min: 500,
            max: 4000,
            step: 500,
            values: [ 500, 4000 ],
            slide: function( event, ui ) {
                // $( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
                @this.call('downpayment_limits',ui.values[ 0],ui.values[ 1]);
            },

        });

        $( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) + " - $" + $( "#slider-range" ).slider( "values", 1 ) );
    });
</script>
<script>
    Livewire.on('update_downpayment_limits', min,max => {
        alert('Debe actualizar los valores de los límites: ' + min + ' - ' + max);
    })
    </script>
