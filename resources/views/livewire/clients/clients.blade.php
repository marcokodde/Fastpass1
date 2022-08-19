<div class="container">

    <div class="card-content mb-10">
        <div class="card-content">
            <div class="flex flex-row max-w-sm">
                <label class="block text-gray-700 text-sm font-bold mb-2 text-left">{{ __('From') }}</label>
                <input type="date" wire:model="date_from"
                    class="ml-2 block px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
                <label class="ml-20  text-gray-700 text-sm font-bold mb-2 text-left">{{ __('To') }}</label>
                <input type="date" wire:model="date_to"
                    class="ml-2  border border-solid border-gray-300 rounded focus:bg-white focus:border-blue-600">
            </div>
        </div>
    </div>
    <div class="card-content">
        <div class="card-content">

            <table class="table mb-5" id="mytable">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-1">{{ __('Neo Id') }}</th>
                        <th class="px-4 py-1">{{ __('Date Created') }}</th>
                        <th class="px-4 py-1">{{ __('Appointment Date') }}</th>
                        <th class="px-4 py-1">{{ __('Expired Sessions') }}</th>
                        <th class="px-4 py-1">{{ __('loggin_times') }}</th>
                        <th class="px-4 py-1">{{ __('Times Login') }}</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($records as $record)

                        <tr>
                            <td
                                class="border px-4 py-1 leading-relaxed sm:text-base md:text-xl xl:text-base text-gray-600">
                                {{ $record->client_id }}
                            </td>
                            <td
                                class="border px-4 py-1 leading-relaxed sm:text-base md:text-xl xl:text-base text-gray-600">
                                {{ date('l F d Y', strtotime($record->created_at)) }}
                            </td>

                            <td
                                class="border px-4 py-1 leading-relaxed sm:text-base md:text-xl xl:text-base text-gray-600">
                                @if ($record->date_at)
                                    {{ date('l F d Y', strtotime($record->date_at)) }}
                                @endif
                            </td>

                            <td
                                class="border px-4 py-1 leading-relaxed sm:text-base md:text-xl xl:text-base text-gray-600">
                                {{ $record->expired_sessions }}
                            </td>
                            <td
                                class="border px-4 py-1 leading-relaxed sm:text-base md:text-xl xl:text-base text-gray-600">
                                {{ $record->times_loggin }}
                            </td>
                            <td
                                class="border px-4 py-1 leading-relaxed sm:text-base md:text-xl xl:text-base text-gray-600">
                                {{ $record->loggin_times }}
                            </td>

                        </tr>
                    @endforeach
                </tbody>


            </table>

        </div>
    </div>
</div>
