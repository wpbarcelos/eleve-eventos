<?php

namespace App\Filament\Resources\EventSubscribeResource\Pages;

use App\Filament\Resources\EventSubscribeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEventSubscribe extends EditRecord
{
    public function getTitle(): string
    {
        return 'Editar evento';
    }

    protected static string $resource = EventSubscribeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
