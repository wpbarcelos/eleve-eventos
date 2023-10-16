<?php

namespace App\Filament\Resources\EventResource\Pages;

use App\Filament\Resources\EventResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEvent extends EditRecord
{
    protected static string $resource = EventResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
            ->before(function(){
                $this->record->subscribes->each->delete();
            }),
        ];
    }

    public function getTitle(): string
    {
        return 'Editar Evento';
    }
}
