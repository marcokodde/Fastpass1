<tr class="mt-5">
    <td class="border px-4 py-1 leading-relaxed sm:text-base md:text-xl xl:text-base text-gray-600">
        {{ $record->name }}
    </td>
    <td>
        <button
            wire:click="edit({{ $record->id }})"
            class="inline-flex  small red --jb-modal items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition"
            title="{{__("Edit")}}">
            {{__('Edit')}}
            <span class="icon"><i class="mdi mdi-eye"></i></span>
        </button>

        <button
            onclick="confirm_modal({{$record->id}})"
            class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition"
            title="{{__("Delete")}}">
            {{__('Delete')}}
            <span class="icon"><i class="mdi mdi-eye"></i></span>
        </button>

    </td>

</tr>
