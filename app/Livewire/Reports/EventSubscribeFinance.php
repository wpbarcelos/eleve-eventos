<?php

namespace App\Livewire\Reports;

use App\Models\Event;
use App\Models\EventSubscribe;
use Barryvdh\Debugbar\Facades\Debugbar;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Livewire\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Symfony\Component\ErrorHandler\Debug;

class EventSubscribeFinance extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public ?array $data = ['event_id' => '','paid'=> [0,1]];
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()->schema([

                    Select::make('event_id')
                        ->options(Event::pluck('name', 'id')->toArray())
                        ->label('Evento')
                        ->live(),
                    CheckboxList::make('paid')
                         ->options(['1'=> 'sim','0'=>'não'])
                        ->columns(1)
                    ->live()
                ])->columns(2)

            ])
            ->statePath('data');
    }


    public function table(Table $table): Table
    {
        Debugbar::info($this->data);

        return $table
            ->query(EventSubscribe::query()->with('event')
                        ->where('event_id', $this->data['event_id'])
                        ->whereIn('paid', $this->data['paid'])
                )
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\CheckboxColumn::make('paid')->disabled(),
                Tables\Columns\TextColumn::make('event.price')

            ])
            ->filters([
                //
            ])
            ->actions([
                //
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    //
                ]),
            ]);
    }

    public function render(): View
    {
        return view('livewire.reports.event-subscribe');
    }
}
