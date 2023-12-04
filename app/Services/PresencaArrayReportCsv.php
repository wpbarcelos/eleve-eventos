<?php

namespace App\Services;

use App\Models\Event;
use Vitorccs\LaravelCsv\Concerns\Exportable;
use Vitorccs\LaravelCsv\Concerns\FromArray;

class PresencaArrayReportCsv implements FromArray
{

    use Exportable;

    public function array(): array
    {
        $event_id = request()->get('event_id');

        $event = Event::query()->where('id', $event_id)
            ->with('subscribes')
            ->with('dates')
            ->with('subscribes.eventdates')->get()->first();


        $columns[] = 'Nome';
        foreach ($event->dates as $eventDate) {
            $columns[] = "{$eventDate->date->format('d/m/Y')}";
        }
        $columns[] = 'Presenças';
        $columns[] = 'Faltas';
        $columns[] = 'Justificativas';

        $arr [] = $columns;

        foreach ($event->subscribes->sortBy('name') as $subscribe) {
            $col = [];
            $col[] = $subscribe->name;

            $justificativas = $presencas = $faltas = 0;

            foreach ($event->dates as $eventDate) {

                $presenca = null;
                $presencaLabel = 'F';

                foreach ($subscribe->eventdates as $subscribeEventDate) {
                    if ($subscribeEventDate->event_date_id == $eventDate->id) {
                        $presenca = $subscribeEventDate;
                        break;
                    }
                }

                if ($presenca) {
                    if ($presenca->present == 1) {
                        $presencaLabel = 'P';
                    } else if (!empty($presenca->justification)) {
                        $presencaLabel = 'J - ' . $presenca->justification;
                    }
                }

                if ($presencaLabel == 'F') {
                    $faltas++;
                } else if ($presencaLabel == 'P') {
                    $presencas++;
                } else {
                    $justificativas++;
                }
                $col[] = $presencaLabel;
            }

            $col[] = $presencas;
            $col[] = $faltas;
            $col[] = $justificativas;

            $arr[] = $col;
        }

        return $arr;
    }

}
