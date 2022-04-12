<div class="bg-white" style="background-color: #fff">
    <img class="stnd skip-lazy " width="207" height="110" alt="CTC Auto Group" src="https://149646797.v2.pressablecdn.com/wp-content/uploads/2021/05/brand-logo.png"/>
</div>
<div class="py-2">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
            @include('common.crud_message')
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                {{__($manage_title)}}
            </h2>

            {{--  Boton para crear elemento  --}}
            @if($allow_create)
                @include('common.crud_create_button')
            @endif
            {{--  Vista busquedas de items  --}}
            <div class="w-56 text-left">
                @if(isset($view_search))
                    @include($view_search)
                @endif
            </div>

            {{--  Modal para confirmar elemento --}}
            @if($confirm_delete)
                @include('common.confirm_delete')
            @endif


                {{-- Si se crea o edita --}}
                @if($isOpen)
                    @include('livewire.locators.form')
                @endif

            @if($records->count())
                <table class="table w-auto">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-4 py-1">{{__("Locator")}}</th>
                            <th colspan="2" class="px-4 py-1 text-center">{{__("Actions")}}</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($records as $record)
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
                        @endforeach
                    </tbody>
                </table>
            @else
                @include('common.no_records_found')
            @endif
           @include('common.pagination')
        </div>
    </div>
</div>