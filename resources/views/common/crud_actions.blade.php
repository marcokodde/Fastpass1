
<td colspan="2" class="px-1 text-center border text-lg">
    <button type="button"
         wire:click="edit({{ $record->id }})"

        class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition"
        data-toggle="modal"
        data-target="#crudModal">

    </button>


    <button type="button"
            wire:click="edit({{ $record->id }})"
            class="button small bg-green-500 --jb-modal hover:text-withe font-bold rounded-lg"
            data-target="sample-modal"
            title="{{__("Edit")}}">
            <span class="icon"><i class="mdi mdi-eye"></i></span>
    </button>

    @if($record->can_be_delete())
        <button  onclick="confirm_modal({{$record->id}})"
                class="button small red --jb-modal hover:text-black font-bold rounded-lg"
                data-target="sample-modal"
                type="button"
                title="{{__("Delete")}}">
            <span class="icon"><i class="mdi mdi-trash-can"></i></span>
        </button>
    @else
        <button  type="button"
                class="button small red --jb-modal hover:text-black font-bold rounded-lg"
                data-target="sample-modal"
                disabled
                title="{{__("It ca not delete")}}">
            <span class="icon"><i class="mdi mdi-trash-can"></i></span>
        </button>
    @endif
</td>

