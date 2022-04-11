<div>

    <div class="card-content">
        <div class="card-content">

                <table class="table mb-5" id="mytable">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-4 py-1">{{__("Neo Id")}}</th>
                            <th class="px-4 py-1">{{__("Date Created")}}</th>
                            <th class="px-4 py-1">{{__("Appointment Date")}}</th>
                            <th class="px-4 py-1">{{__("Expired Seeions")}}</th>
                            <th class="px-4 py-1">{{__("loggin_times")}}</th>
                         </tr>
                    </thead>
                    <tbody>
                        @foreach ($records as $record )
                        <tr>
                            <td class="border px-4 py-1 leading-relaxed sm:text-base md:text-xl xl:text-base text-gray-600">
                                {{$record->client_id}}
                            </td>
                            <td class="border px-4 py-1 leading-relaxed sm:text-base md:text-xl xl:text-base text-gray-600">
                                    {{date("l F d Y", strtotime($record->created_at))}}
                            </td>

                            <td class="border px-4 py-1 leading-relaxed sm:text-base md:text-xl xl:text-base text-gray-600">
                                @if($record->date_at)
                                {{date("l F d Y", strtotime($record->date_at))}}
                                @endif
                            </td>

                            <td class="border px-4 py-1 leading-relaxed sm:text-base md:text-xl xl:text-base text-gray-600">
                                {{$record->expired_sessions}}
                            </td>
                            <td class="border px-4 py-1 leading-relaxed sm:text-base md:text-xl xl:text-base text-gray-600">
                                {{$record->times_loggin}}
                            </td>

                        </tr>

                        @endforeach
                    </tbody>


                </table>

        </div>
    </div>
</div>
