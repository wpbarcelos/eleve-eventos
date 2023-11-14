<x-filament-panels::page>

    {{ $this->form }}

    @if($data['event_id'])
        <div class="p-3 text-end">
            <p>Valor pendente: R$ {{ $this->totalPending() }}</p>
        </div>
    @endif

    {{ $this->table }}

</x-filament-panels::page>
