<?php

namespace App\Filament\Resources\EventDateSubscribeResource\RelationManagers;

use App\Models\EventDateSubscribe;
use App\Models\EventSubscribe;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class SubscribesRelationManager extends RelationManager
{
    public ?string $pageClass = 'EventDateSubscribe';
    protected static string $relationship = 'datesubscribes';
    protected static ?string $recordTitleAttribute = 'event_subscribe_id';

    public function mount(): void
    {
        $this->loadDefaultActiveTab();


        /** @var \App\Models\EventDate $eventDate */
        $eventDate = $this->ownerRecord;

        $eventDate->event->subscribes->map(function ($event_subscribe) use ($eventDate) {

            EventDateSubscribe::firstOrCreate([
                'event_date_id' => $eventDate->id,
                'event_subscribe_id' => $event_subscribe->id,
            ]);

        });

    }


    public function form(Form $form): Form
    {
        $eventId = $this->ownerRecord->event->id;
        return $form
            ->schema([
                Forms\Components\Select::make('event_subscribe_id')
                    ->required()
                    ->options(
                        EventSubscribe::where('event_id', $eventId)
                            ->pluck('name', 'id')
                    )
                    ->unique(ignoreRecord: true)
                    ->label('Inscrito'),
                Forms\Components\Toggle::make('present')
                ->label('Presença'),
            ]);
    }

    public function table(Table $table): Table
    {

        $table->recordTitle('aaaaaaaa');

        return $table->heading('Inscritos')
            ->columns([
                // Tables\Columns\TextColumn::make('id'),
                Tables\Columns\TextColumn::make('subscribe.name')
                    ->label('Nome')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\ToggleColumn::make('present')
                    ->label('Presença')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                // Tables\Actions\CreateAction::make()
                // ->label('Adicionar Inscritos'),
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
                // Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
            ])
            ->paginationPageOptions([25,50,100,'all']);
    }
}
