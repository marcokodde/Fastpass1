<div>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{__('RESET DATA CLIENT')}}
        </h2>
    </x-slot>

    <div class="py-4 px-4">
        @include('common.crud_message')

        @if($client)
            {{ $client->client_id}}
        @else
            NO HAY CLIENTE
        @endif
        <div class="col-md-6 mx-4 px-4 mb-4">

            <form>
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2 text-left">{{__("Neo Client Id")}}</label>
                        <input type="text" wire:model="client_id"
                                onchange="read_clientd"
                                placeholder="{{__("Neo Client Id")}}"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        @error('name') <span class="text-red-500">{{ $message }}</span>@enderror
                    </div>
                    @if($client)
                        {{-- Vehículos Sugeridos --}}
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2 text-left">{{__("Suggested Vehicles")}}</label>
                            <label class="block text-gray-700 text-sm font-bold mb-2 text-left">{{$client->suggested_vehicles->count()}}</label>
                        </div>

                        {{-- Garages --}}
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2 text-left">{{__("Garages")}}</label>
                            <label class="block text-gray-700 text-sm font-bold mb-2 text-left">{{$client->garages->count()}}</label>
                        </div>

                        {{-- Sesiones --}}
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2 text-left">{{__("Sessions")}}</label>
                            <label class="block text-gray-700 text-sm font-bold mb-2 text-left">{{$client->sessions->count()}}</label>
                        </div>

                    @endif
                </div>
                <div class="float-right">
                    <x-jet-button wire:click="read_client">
                        {{ __('Read Client') }}
                    </x-jet-button>
                </div>


                    @if($client)
                        <x-jet-button onclick="confirm_modal({{$client->_id}})">{{__('Reset Data Clien')}}</x-jet-button>
                        <button  onclick="confirm_modal({{$client->_id}})"
                                class="button small red --jb-modal hover:text-black font-bold rounded-lg"
                                data-target="sample-modal"
                                type="button"
                                title="{{__("Delete")}}">
                            <span class="icon"><i class="mdi mdi-trash-can"></i></span>
                        </button>
                    @endif
            </form>
        </div>

    </div>
</div>
<script>
    function confirm_modal(client){
        alert('Hola');
    }
</script>
