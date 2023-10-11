<?php

namespace App\Filament\Resources\EventDateResource\Pages;

use App\Filament\Resources\EventDateResource;
use App\Models\EventDateSubscribe;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateEventDate extends CreateRecord
{
    protected static string $resource = EventDateResource::class;


    protected function afterCreate()
    {

        /** @var \App\Models\EventDate $eventDate */
        $eventDate = $this->record;

        $eventDate->event->subscribes->map(function ($event_subscribe) use ($eventDate) {

            EventDateSubscribe::firstOrCreate([
                'event_date_id' => $eventDate->id,
                'event_subscribe_id' => $event_subscribe->id,
            ]);

        });
    }


}
