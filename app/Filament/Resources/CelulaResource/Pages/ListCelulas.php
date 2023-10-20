<?php

namespace App\Filament\Resources\CelulaResource\Pages;

use App\Filament\Resources\CelulaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCelulas extends ListRecords
{
    protected static string $resource = CelulaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
