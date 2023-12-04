<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Services\PresencaArrayReportCsv;
use Illuminate\Support\Str;

class ReportPresencaController extends Controller
{
    public function __invoke()
    {
        request()->validate([
            'event_id' => 'required|exists:events,id'
        ]);
        $event = Event::query()->where('id', request()->get('event_id'))->first();

        $report = new PresencaArrayReportCsv();
        return $report->download('presenca__' . Str::of($event->name)->snake() . '.csv');
    }

}
