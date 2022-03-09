<div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
        <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
            <div class="font-bold text-center">
                HAGA CLIC EN LA IMAGEN PARA DESBLOQUEAR PRECIOS nueva interfaz nuevas rutas
            </div>
        </div>
        <br>


        <hr>

        @if(isset($records) && $records->count())
           Total de vehículos sugeridos {{ $records->count()}}
        @endif
        AHORA DEBE IR A NUEVAS RUTAS
        <div class="flex justify-center mt-20">
            @if($token)
                <a href="{{ url('show_vehicles/'.$client_id . '/'.$token) }}">
                    <img class="relative z-10 object-scale-down h-max w-max" src="{{asset('images/fondo.png')}}">
                </a>
            @else

                <a href="{{ url('show_vehicles/'.$client_id) }}">
                    <img class="relative z-10 object-scale-down h-max w-max" src="{{asset('images/fondo.png')}}">
                </a>
            @endif

        </div>

    </div>
</div>
