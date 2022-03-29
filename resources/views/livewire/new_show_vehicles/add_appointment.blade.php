
<div class="fixed inset-0 z-10 overflow-y-auto ease-out duration-400">
    <div class="flex items-center justify-center min-h-full px-2 pt-4 pb-4 mt-4 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <!-- This element is to trick the browser into centering the modal contents. -->
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>
        <div class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle sm:w-auto" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
            <form>
                <div class="px-4 pt-2 pb-4 bg-white sm:p-6 sm:pb-4">
                    <div class="mb-4">
                        <span class="block text-lg font-headline text-gray-700 font-bold mb-2">{{__("Pick your Date and Time to get Driving!")}}</span>
                        <label  class="block text-gray-700 text-base font-bold mb-2">{{__("Appointment Date:")}}</label>

                        <input type="date"
                            wire:model="date_at"
                            wire:change="create_list_hours_to_appointment({{$dealer}})"
                            min="{{$min_date_to_appointment}}"
                            max="{{$max_date_to_appointment}}"
                            required
                            list="dates_available_to_appointment"
                            style=cursor:pointer;
                            class="rounded w-auto border py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        @error('date_at') <span class="text-red-500">{{ $message }}</span>@enderror

                        <datalist id="dates_available_to_appointment">
                            @foreach($dates_to_appointment as $date_to_appointment)
                                <option value="{{$date_to_appointment}}">
                            @endforeach
                        </datalist>
                    </div>
                    <div class="mb-2">
                        <label class="block mb-2 text-sm font-bold text-gray-700">{{__("Hour")}}</label>
                        <select wire:model="hour"
                        class="w-auto px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline">
                        <option value="" selected>{{__("Hour")}}</option>
                            @foreach($hours_to_appointment as $hour_to_appointment)
                                <option value="{{ $hour_to_appointment }}">{{ $hour_to_appointment }}</option>
                            @endforeach
                        </select>
                        @error('hour') <span class="text-red-500">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="px-4 py-3 bg-gray-50 sm:px-6 sm:flex sm:flex-row-reverse">
                    <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                        <button wire:click.prevent="store_appointment()" onclick="stopConfetti();" type="button" class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-700 focus:outline-none focus:shadow-outline-purple hover:bg-purple-700">
                            {{__('Save')}}
                        </button>
                    </span>
                    <span class="flex w-full mt-3 rounded-md shadow-sm sm:mt-0 sm:w-auto">
                        <button wire:click="closeModal()" onclick="stopConfetti();" class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-green-600 border border-transparent rounded-md active:bg-green-500 focus:outline-none focus:shadow-outline-green hover:bg-green-500">
                            {{__('Cancel')}}
                        </button>
                    </span>
                </div>
            </form>
        </div>
    </div>
</div>

