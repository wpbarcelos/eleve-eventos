<?php

namespace App\Livewire;

use App\Models\EventDateSubscribe;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Livewire\Component;

class EventdateSubscribes extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public $eventDate;
    public $eventDateSubscribes;

    public function table(Table $table): Table
    {
        return $table
            ->query(EventDateSubscribe::query()->where('event_date_id', $this->eventDate)->with('subscribe'))
            ->columns([
                TextColumn::make('subscribe.name')->searchable()->sortable()->label('Nome'),
                ToggleColumn::make('present')->label("Presença"),
            ])
            ->filters([
                // ...
            ])
            ->actions([
                // ...
            ])
            ->bulkActions([
                // ...
            ])->paginated([25, 50 ,'all']);
    }




    public function mount()
    {
        $this->eventDateSubscribes = EventDateSubscribe::all()->where('event_date_id', $this->eventDate);

    }

    public function render()
    {
        return view('livewire.eventdate-subscribes');
    }
}
