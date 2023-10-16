<?php

namespace App\Filament\Resources\EventSubscribeResource\Pages;

use App\Filament\Resources\EventSubscribeResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateEventSubscribe extends CreateRecord
{
    public function getTitle(): string
    {
        return 'Cadastro de Inscrito';
    }
    protected static string $resource = EventSubscribeResource::class;
}
