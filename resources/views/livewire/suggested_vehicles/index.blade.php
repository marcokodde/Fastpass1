<x-app-layout>
    @livewire('navigations')
    <div class="sidemenu mt-12 w-64 absolute">
        @livewire('garages')
    </div>
    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <h1 class="font-bold text-center items-center text-3xl leading uppercase">{{__('Vehicles you are approved')}}</h1>
                <table border="1">
                    <thead>
                        <th>No</th>
                        <th>STOCK</th>
                        <th>VIN</th>
                        <th>GRADE</th>
                        <th>NEXT TIER</th>
                    </thead>
                    <tbody>
                        @foreach ($records as $record )
                            <tr>
                                <td>{{$loop->index + 1}}</td>
                                <td>{{$record['stock']}}</td>
                                <td>{{$record['vin']}}</td>
                                <td>{{$record['grade']}}</td>
                                <td align="right">{{number_format($record['additionalDownpaymentForNextTier'],2)}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @livewire('additionalvehicles')
</x-app-layout>
