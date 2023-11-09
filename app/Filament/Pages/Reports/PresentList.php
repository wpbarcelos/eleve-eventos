<?php

namespace App\Filament\Pages\Reports;

use App\Models\Event;
use Filament\Forms\Contracts\HasForms;
use Filament\Pages\Page;

class PresentList extends Page implements HasForms
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.reports.present-list';

    public $event_id = '';

    public $events = [];

    public function mount()
    {
        $this->events =  Event::pluck('name', 'id');
    }
}
