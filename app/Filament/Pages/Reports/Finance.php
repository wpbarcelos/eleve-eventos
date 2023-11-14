<?php

namespace App\Filament\Pages\Reports;

use App\Models\Event;
use App\Models\EventSubscribe;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Tables\Columns\CheckboxColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\Summarizers\Count;
use Filament\Tables\Columns\Summarizers\Sum;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;

class Finance extends Page implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public $name = "wanderson";

    public $data = [
        'event_id' => null,
        'paid' => ['0', '1']
    ];
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.reports.finance';

    protected static ?string $label = 'Financeiro';
    protected static ?string $navigationLabel = 'Financeiro';

    protected static ?string $inverseRelationship = 'section';
    protected static ?string $navigationGroup = "Relatórios";

    public function getHeading(): string
    {
        return "Relatório Financeiro";
    }


    public function form(Form $form): Form
    {
        return $form
            ->model(null)
            ->schema([
                Section::make()
                    ->schema([
                        Select::make('event_id')
                            ->options(Event::pluck('name', 'id')->toArray())
                            ->label('Evento')
                            ->live()
                            ->afterStateUpdated(function (?string $state, ?string $old) {
                                $this->resetTable();
                            }),
                        CheckboxList::make('paid')->label('Pago')->inlineLabel()
                            ->options(['1' => 'sim', '0' => 'não'])
                            ->live()
                            ->afterStateUpdated(fn() => $this->resetTable())

                    ])->columns(2)
            ])->statePath('data');
    }

    public function table(Table $table)
    {
        return $table->query(EventSubscribe::query()
            ->where('event_id', $this->data['event_id'])
            ->whereIn('paid', $this->data['paid'])
        )
            ->columns([
                TextColumn::make('name')->sortable()->label('Nome'),
                TextColumn::make('phone')->sortable()->label('Telefone')
                    ->url(fn(EventSubscribe $item) => empty($item['phone']) ? null : 'tel:' . $item['phone']),
                CheckboxColumn::make('paid')->sortable()->label('Pago')->disabled(),
                IconColumn::make('paid')->icon(fn(string $state) => match ($state) {
                    '1' => 'heroicon-o-check-badge',
                    '0' => 'heroicon-o-x-circle',
                }),
                TextColumn::make('event.price')->label('Valor')
            ]);
    }

    public function totalPending()
    {

        if (empty($this->data['event_id'])) {
            return;
        }
        
        $pending = EventSubscribe::where('event_id', $this->data['event_id'])
            ->where('paid', '0')
            ->count();
        $amount = Event::where('id', $this->data['event_id'])
            ->select('price')
            ->first();

        $totalPending = number_format($pending * (float) $amount->price, 2, ',', '.');


        return $totalPending;

    }


}
