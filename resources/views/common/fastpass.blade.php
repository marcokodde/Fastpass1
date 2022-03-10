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
    })
</script>
