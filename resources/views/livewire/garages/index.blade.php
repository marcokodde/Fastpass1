<div>
   <div>
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
    </div>
    <table class="border ml-4 mt-2">
        @if ($garages->count())
            <tbody class="border-1 border-gray-700">
                @foreach ($garages as $garage)
                    <tr>
                        <td class="border px-2 py-1 font-semibold text-gray-700">{{ $garage->year }}</td>
                        <td class="border px-2 py-1 font-semibold text-gray-700">{{ $garage->make }}</td>
                        <td class="border px-2 py-1 font-semibold text-gray-700">{{ $garage->model }}</td>
                    </tr>
                @endforeach
            </tbody>
        @else
            <h1 class="font-semibold text-lg font-serif text-center mt-4">{{__("You have")}} {{env('GARAGE_SPACES')}} {{__("spaces in your garage")}}</h1>
        @endif
    </table>
</div>
