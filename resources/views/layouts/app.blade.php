<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('layouts.head')
    <body class="font-sans antialiased">

            <x-jet-banner />

            <div class="min-h-screen bg-white">
                @auth
                    @livewire('navigation-menu')
                @endauth

                <!-- Page Heading -->
                @if (isset($header))
                    <header class="bg-white shadow">
                        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endif
                <!-- Page Content -->
                <main>
                    <h1 id="div1" style="display:none" class="mt-20 text-center align-center items-center text-gray-700 font-bold">{{__('Congratulations!')}}</h1>
                    <canvas class="bg-white transparent" id="confetti-canvas" style="display:none">
                    </canvas>
                    {{ $slot }}
                </main>
            </div>

        @stack('modals')
        @livewireScripts
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <script src="{{ asset('js/confetti.js')}}"></script>

        <script>
            window.addEventListener('show_toast_vehicle_added',({detail:{type,message}})=>{
                const Toast = Swal.mixin({
                    toast: false,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 2000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                })

                Toast.fire({
                    icon: 'success',
                    title: "{{__('The vehicle has been added to your garage.')}}"
                })

            })

            function confirm_modal(id) {
                var record = id;
                Swal.fire({
                    title: "{{__('Are you sure?')}}",
                    text: "{{__('You wo not be able to revert this!')}}",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: "{{__('Yes, delete it!')}}",
                    cancelButtonText: "{{__('Cancel')}}",
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.livewire.emit('destroy', record);
                        Swal.fire(
                        'Deleted!',
                        "{{__('Your record has been deleted.')}}",
                        'success'
                        )
                    }
                })
            }
        </script>
    </body>
</html>
