<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('layouts.head')
    <body class="font-sans antialiased">

            <x-jet-banner />

            <div class="min-h-screen bg-white">
                {{-- @livewire('navigation-menu') --}}
                <canvas id="confetti-canvas" style="display:block"> </canvas>
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
        </script>
    </body>
</html>
