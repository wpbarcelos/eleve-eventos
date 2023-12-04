<?php

namespace App\Services;

use App\Models\Event;
use Vitorccs\LaravelCsv\Concerns\Exportable;
use Vitorccs\LaravelCsv\Concerns\FromArray;

class FinanceiroArrayReportCsv implements FromArray
{

    use Exportable;

    public function array():array
    {
        $event_id = request()->get('event_id');

        $event = Event::query()->where('id', $event_id)->with('subscribes')->get()->first();

        $arr[]  =  ['Nome', 'Pago', 'Valor'];

        foreach ($event->subscribes as $subscribe)  {
            $arr [] = [$subscribe->name, $subscribe->paid == 1 ? 'Sim' : 'Não', (float) $event->price];
        }

        return $arr;
    }



}
