<?php

namespace App\Filament\Resources\CelulaResource\Pages;

use App\Filament\Resources\CelulaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCelula extends EditRecord
{
    protected static string $resource = CelulaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
