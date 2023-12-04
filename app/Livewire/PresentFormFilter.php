<?php

namespace App\Livewire;

use App\Models\Event;
use App\Models\EventDate;
use App\Models\EventDateSubscribe;
use App\Models\EventSubscribe;
use Doctrine\DBAL\Schema\Table;
use Filament\Forms\Components\Select;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Tables\Actions\Contracts\HasTable;
use Filament\Tables\Concerns\InteractsWithTable;
use Livewire\Component;

class PresentFormFilter extends Component implements HasForms
{

    use InteractsWithForms;

    public ?array $data = ['event_id' => ''];
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('event_id')
                    ->options(Event::pluck('name', 'id')->toArray())
                    ->label('Evento')
                    ->live()
            ])
            ->statePath('data');
    }



    public function render()
    {
        $event_subscribes = [];
        $event_dates = [];

        if (!empty($this->data['event_id'])) {
            $event_dates = EventDate::where('event_id', $this->data['event_id'])
                ->withCasts(['date' => 'date:d/m/Y'])
                ->get();

            if ($event_dates->count() > 0) {
                $event_subscribes = EventSubscribe::where('event_id', $this->data['event_id'])
                    ->orderBy('name')
                    ->with('eventdates')
                    ->get();

                $event_subscribes = $event_subscribes->map(function ($event_subscribe) use ($event_dates) {

                    $eventsDatesCount = $event_dates->count();
                    $presents =  $event_subscribe->eventdates->sum('present');

                    $event_subscribe->arr_event_date = $event_subscribe->eventdates->pluck('present', 'event_date_id');

                    $event_subscribe->present_count = $presents;
                    $event_subscribe->present_percentage = round((100 / $eventsDatesCount) * $presents);

                    return $event_subscribe;
                });
            }
        }
        return view('livewire.present-form-filter', compact('event_subscribes', 'event_dates'));
    }
}
