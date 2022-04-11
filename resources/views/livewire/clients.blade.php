<div>

    <div class="card-content">
        <div class="card-content">

                <table class="table mb-5" id="mytable">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-4 py-1">{{__("Date")}}</th>
                            <th class="px-4 py-1">{{__("Total")}}</th>
                         </tr>
                    </thead>
                    <tbody>
                        @foreach ($records as $record )
                        <tr>
                            <td class="border px-4 py-1 leading-relaxed sm:text-base md:text-xl xl:text-base text-gray-600">
                                {{date("l F d Y", strtotime($record->date))}}
                            </td>
                            <td class="border px-4 py-1 leading-relaxed sm:text-base md:text-xl xl:text-base text-gray-600">
                                {{ $record->total }}
                            </td>
                        </tr>

                        @endforeach
                    </tbody>


                </table>

        </div>
    </div>
</div>
