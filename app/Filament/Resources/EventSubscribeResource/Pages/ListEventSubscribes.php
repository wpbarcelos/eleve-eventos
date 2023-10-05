<?php

namespace App\Filament\Resources\EventSubscribeResource\Pages;

use App\Filament\Resources\EventSubscribeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEventSubscribes extends ListRecords
{
    protected static string $resource = EventSubscribeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
