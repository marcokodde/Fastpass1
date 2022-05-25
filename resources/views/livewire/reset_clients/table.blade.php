<thead>
    <tr class="bg-gray-100">
        <th class="px-4 py-1">{{__("Client Id")}}</th>
        <th class="px-4 py-1">{{__("Suggested Vehicles")}}</th>
        <th class="px-4 py-1">{{__("Garages")}}</th>
        <th class="px-4 py-1">{{__("Sessions")}}</th>
        <th colspan="2" class="px-4 py-1 text-center">{{__("Action")}}</th>
    </tr>
</thead>
<tbody>
    <tr class="mt-5">
        <td class="border px-4 py-1 leading-relaxed sm:text-base md:text-xl xl:text-base text-gray-600">
            {{ $record->client_id }}
        </td>
        <td>{{$record->suggested_vehicles->count()}}</td>
        <td>{{$record->garages->count()}}</td>
        <td>{{$record->sessions->count()}}</td>

        <td>
            <button
                onclick="confirm_modal({{$record->id}})"
                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition"
                data-toggle="modal"
                data-target="#crudModal">
                {{__('Reset Data Client')}}
            </button>

        </td>

    </tr>
</tbody>
