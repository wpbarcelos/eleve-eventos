<?php

namespace App\Filament\Resources\EventDateResource\Pages;

use App\Filament\Resources\EventDateResource;
use App\Filament\Resources\EventDateResource\Widgets\EventDateStatusOverview;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEventDate extends EditRecord
{
    protected static string $resource = EventDateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            EventDateStatusOverview::class
        ];
    }
}
