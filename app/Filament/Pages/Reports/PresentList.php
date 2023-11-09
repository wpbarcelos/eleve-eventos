<?php

namespace App\Filament\Pages\Reports;

use App\Models\Event;
use Filament\Forms\Contracts\HasForms;
use Filament\Pages\Page;

class PresentList extends Page implements HasForms
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.reports.present-list';

    protected static ?string $label = 'Lista de Presença';

    protected static ?string $navigationLabel = 'Lista de Presença';

    protected static ?string $navigationGroup = "Relatórios";

    public function getHeading(): string
    {
        return "Relatório de lista de presença";
    }

    public $event_id = '';

    public $events = [];

    public function mount()
    {
        $this->events =  Event::pluck('name', 'id');
    }
}
