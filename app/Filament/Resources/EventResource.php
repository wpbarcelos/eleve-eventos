<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EventResource\Pages;
use App\Filament\Resources\EventResource\RelationManagers;
use App\Filament\Resources\EventSubscribeResource\RelationManagers\EventsRelationManager;
use App\Models\Event;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EventResource extends Resource
{
    protected static ?int $navigationSort = 1000;

    protected static ?string $navigationLabel = 'Eventos';

    protected static ?string $label = 'Eventos';

    protected static ?string $model = Event::class;

    protected static ?string $navigationIcon = 'heroicon-o-sparkles';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->label('Nome'),
                Forms\Components\TextInput::make('description')
                    ->required()
                    ->maxLength(255)
                    ->label('Descrição'),
                Forms\Components\TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->default(0.00)
                    ->prefix('R$')
                    ->label('Valor'),
                Forms\Components\DatePicker::make('date_start')
                ->label('Início'),
                Forms\Components\DatePicker::make('date_end')
                ->label('Término'),
                Forms\Components\FileUpload::make('image')
                    ->image()
                    ->label('Imagem'),


                Section::make('Inscrição')
                ->columns(3)
                ->schema([
                    Forms\Components\DateTimePicker::make('subscribe_start')
                    ->label('Início'),
                    Forms\Components\DateTimePicker::make('subscribe_until')
                    ->label('Término'),
                    Forms\Components\TextInput::make('limit_subscribe')
                    ->numeric()
                    ->label('Limite de vagas'),
                ]),


            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->label('Nome'),
                Tables\Columns\TextColumn::make('price')
                    ->money('BRL')
                    ->sortable()
                    ->label('Valor'),
                Tables\Columns\ImageColumn::make('image')->size(70)
                    ->label('Imagem'),
                Tables\Columns\TextColumn::make('date_start')
                    ->date('d/m/Y')
                    ->sortable()
                    ->label('Início'),
                Tables\Columns\TextColumn::make('date_end')
                    ->date('d/m/Y')
                    ->sortable()
                    ->label('Término'),
                Tables\Columns\TextColumn::make('subscribes_count')
                    ->counts('subscribes')
                    ->label('Inscritos')
                    ->sortable()
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            EventsRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEvents::route('/'),
            'create' => Pages\CreateEvent::route('/create'),
            'edit' => Pages\EditEvent::route('/{record}/edit'),
        ];
    }
}
