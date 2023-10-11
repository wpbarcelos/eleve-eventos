<?php

namespace App\Filament\Resources\EventDateResource\Pages;

use App\Filament\Resources\EventDateResource;
use App\Models\EventSubscribe;
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

    protected function afterSave()
    {
        /**@var \App\Models\EventDate $eventDate  */
        $eventDate = $this->record;

        $subscribes = $eventDate->event->subscribes
                    ->map(function($sub) use ($eventDate){
                        $sub->event_id = $eventDate->event->id;
                        return $sub;
                    });

        /*update `event_subscribes`
            set `event_date_id` = 1, `event_subscribes`.`updated_at` = 2023-10-05 13:25:05 where `id` = 1 */

        $eventDate->subscribes()->saveMany($subscribes);


    }
}
