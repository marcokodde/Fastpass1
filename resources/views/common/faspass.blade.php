<script>
    document.addEventListener('livewire:load', function() {
        @this.on('add_to_garage', stock_number => {
            Swal.fire({
                title: "{{__('ALERT')}}",
                text: "{{__('By adding this car to your garage, you decrease an available space')}}",
                showCancelButton: true,
                cancelButtonText: 'NO',
                cancelButtonColor: '#5CB352',
                confirmButtonColor: '#F4EC08',
                confirmButtonText: "{{__('YES, ADD VEHICLE')}}"
            }).then((result) => {
                if (result.value) {
                    @this.call('add_vehicle_to_garage', stock_number)
                }
            })
        })
    })
</script>
