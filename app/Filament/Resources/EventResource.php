<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EventResource\Pages;
use App\Filament\Resources\EventResource\RelationManagers;
use App\Models\Event;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EventResource extends Resource
{
    protected static ?string $model = Event::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('description')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->default(0.00)
                    ->prefix('R$'),
                Forms\Components\FileUpload::make('image')
                    ->image(),
                Forms\Components\DatePicker::make('date_start'),
                Forms\Components\DatePicker::make('date_end'),
                Forms\Components\DateTimePicker::make('subscribe_start'),
                Forms\Components\DateTimePicker::make('subscribe_until'),
                Forms\Components\TextInput::make('limit_subscribe')
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                // Tables\Columns\TextColumn::make('description')
                    // ->searchable(),
                Tables\Columns\TextColumn::make('price')
                    ->money('BRL')
                    ->sortable(),
                Tables\Columns\ImageColumn::make('image')->size(70),
                Tables\Columns\TextColumn::make('date_start')
                    ->date('d/m/Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('date_end')
                    ->date('d/m/Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('subscribe_start')
                    ->dateTime('d/m/Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('subscribe_until')
                    ->dateTime('d/m/Y')
                    ->sortable(),
                // Tables\Columns\TextColumn::make('limit_subscribe')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('created_at')
                //     ->dateTime()
                //     ->sortable()
                //     ->toggleable(isToggledHiddenByDefault: true),
                // Tables\Columns\TextColumn::make('updated_at')
                //     ->dateTime()
                //     ->sortable()
                //     ->toggleable(isToggledHiddenByDefault: true),
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
            //
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
