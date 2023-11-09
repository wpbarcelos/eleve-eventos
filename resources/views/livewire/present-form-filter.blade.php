<div>
    <div class="mb-5">
        {{ $this->form }}
    </div>


    @if ($data['event_id'])
        @if ($event_dates)
            <table class=" w-full ">
                <thead>
                    <tr class=''>
                        <th class="bg-white border border-slate-300 p-2 rounded text-bold">Nome</th>
                        @foreach ($event_dates as $event_date)
                            <th width='5%' class="bg-white text-left border border-slate-300 p-2 rounded text-bold">
                                {{ $event_date->date->format('d/m') }}</th>
                        @endforeach

                        <th class="bg-white border border-slate-300 p-2 rounded text-bold">%Falta</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($event_subscribes as $event_subscribe)
                        <tr>
                            <td class="bg-white border border-slate-300 p-3 rounded">
                                {{ $event_subscribe->name }}
                            </td>
                            @foreach ($event_dates as $event_date)
                                <td width='5%' class="bg-white border border-slate-300 p-3 rounded">
                                    @if (isset($event_subscribe?->arr_event_date[$event_date->id]) && $event_subscribe->arr_event_date[$event_date->id] == 1)
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="green" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    {{-- @elseif() --}}

                                    {{-- <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                                      </svg> --}}

                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="red" class="w-6 h-6 rounded-full ">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    @endif
                                </td>
                            @endforeach

                            <td width='5%'
                                class="bg-white border border-slate-300 p-3 rounded text-right
                                    @if ($event_subscribe->present_percentage < 70) text-red-300 font-bold @endif
                                    ">
                                {{ $event_subscribe->present_percentage }}
                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan='99'>
                                <p class='text-center'>Nenhum dados encontrado</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        @else
            <p class='text-center'>Nenhuma chamada registrada para esse evento</p>
        @endif
    @endif


</div>
