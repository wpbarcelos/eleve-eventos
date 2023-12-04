<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

Route::redirect('/','/admin');


Route::get('export/financeiro', function(\Illuminate\Http\Request $request){

    $request->validate([
        'event_id'=> 'required'
    ]);

    $event = \App\Models\Event::query()->where('id',$request->event_id)->with('subscribes')->get()->first();


    $csvFileName = 'relatorio_'. Str::of($event->name)->snake(). '_financeiro.csv';




    $handle = fopen('php://output', 'w');
    fputcsv($handle, ['Nome', 'Pago', 'Valor']); // Add more headers as needed

    foreach ($event->subscribes as $subscribe)  {
        fputcsv($handle, [$subscribe->name, $subscribe->paid == 1 ? 'Sim' : 'Não', (float) $event->price]); // Add more fields as needed
    }

    fclose($handle);

    $headers = [
        'Content-Type' => 'application/vnd.ms-excel',
        'Content-Disposition' => 'attachment; filename=' . $csvFileName,
        'Expires'=>' 0',
        'Pragma'=> 'must-revalidate',
        'Cache-Control'=> 'must-revalidate'
    ];

    return response('',200, $headers);

});



Route::get('export/presenca', function(\Illuminate\Http\Request $request){

    $request->validate([
        'event_id'=> 'required'
    ]);

    $event = \App\Models\Event::query()->where('id',$request->event_id)->with('subscribes')->with('dates')
        ->with('subscribes.eventdates')
        ->get()->first();


    $csvFileName = 'relatorio_'. Str::of($event->name)->snake() . '_presenca.csv';




    $handle = fopen('php://output', 'w');


    $columns[] = 'Nome';
    foreach($event->dates as $eventDate) {
        $columns[] = "{$eventDate->date->format('d/m/Y')}";
    }
    $columns[]= 'Presenças';
    $columns[]= 'Faltas';
    $columns[]= 'Justificativas';

    fputcsv($handle, $columns); // Add more headers as needed

    foreach ($event->subscribes->sortBy('name') as $subscribe)  {
        $col = [];
        $col[] = $subscribe->name;

        $justificativas = $presencas = $faltas = 0;

        foreach($event->dates as $eventDate) {

            $presenca = null;
            $presencaLabel = 'F';

            foreach($subscribe->eventdates as $subscribeEventDate) {
                if($subscribeEventDate->event_date_id == $eventDate->id) {
                    $presenca= $subscribeEventDate;
                    break;
                }
            }

            if( $presenca) {
                if($presenca->present == 1) {
                    $presencaLabel = 'P';
                } else if( !empty($presenca->justification)) {
                    $presencaLabel = 'J - ' . $presenca->justification;
                }
            }

            if( $presencaLabel == 'F') {
                $faltas++;
            } else if( $presencaLabel == 'P') {
                $presencas++;
            } else {
                $justificativas++;
            }
            $col[] = $presencaLabel;
        }

        $col[] = $presencas;
        $col[] = $faltas;
        $col[] = $justificativas;

        fputcsv($handle, $col); // Add more fields as needed
    }

    fclose($handle);

    $headers = [
        'Content-Type' => 'application/vnd.ms-excel',
        'Content-Disposition' => 'attachment; filename=' . $csvFileName,
        'Expires'=>' 0',
        'Pragma'=> 'must-revalidate',
        'Cache-Control'=> 'must-revalidate'
    ];

    return response('',200, $headers);

});
