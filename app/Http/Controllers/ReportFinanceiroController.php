<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Services\FinanceiroArrayReportCsv;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ReportFinanceiroController extends Controller
{
    public function __invoke()
    {
        request()->validate([
            'event_id' => 'required|exists:events,id'
        ]);
        $event = Event::query()->where('id', request()->get('event_id'))->first();

        $report = new FinanceiroArrayReportCsv();
        return $report->download('financeiro__' . Str::of($event->name)->snake() . '.csv');

    }
}
