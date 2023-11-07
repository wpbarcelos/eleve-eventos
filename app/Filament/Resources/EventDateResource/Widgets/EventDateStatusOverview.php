<?php

namespace App\Filament\Resources\EventDateResource\Widgets;

use App\Models\EventDate;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class EventDateStatusOverview extends BaseWidget
{
    public ?EventDate $record = null;

    protected function getStats(): array
    {
        $this->record->load('datesubscribes');

        return [
            Stat::make("Total", $this->record->datesubscribes()->count()),
            Stat::make("Presentes", $this->record->datesubscribes()->where('present', 1)->count()),
            Stat::make("Ausentes", $this->record->datesubscribes()->where('present', 0)->count()),
        ];
    }
}
