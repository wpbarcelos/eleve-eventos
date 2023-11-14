<x-filament-panels::page>

    {{ $this->form }}

    @if($data['event_id'])
        <div class="p-3 text-end d-flex gap-3">

            <p style="color:green">Valor Pago: R$ {{ $this->totalPaid() }} - {{  $this->percentPaid() }}%</p>
            <p style="color:orangered">Valor pendente: R$ {{ $this->totalPending() }} - {{ $this->percentPending() }} %</p>
        </div>
    @endif

    {{ $this->table }}

</x-filament-panels::page>
