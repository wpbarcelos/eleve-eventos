<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CelulaResource\Pages;
use App\Filament\Resources\CelulaResource\RelationManagers;
use App\Models\Celula;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CelulaResource extends Resource
{
    protected static ?string $model = Celula::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')->label('Nome')
                    ->required()
                    ->maxLength(255),
                Forms\Components\FileUpload::make('image')
                    ->image()
                    ->label('Imagem'),
                Forms\Components\TextInput::make('owner')->label('Responsável')
                    ->maxLength(255),
                Forms\Components\TextInput::make('description')->label('Descrição')
                    ->maxLength(255),
                Forms\Components\TextInput::make('schedule')->label('Horário')
                    ->maxLength(255),
                Forms\Components\TextInput::make('address')->label('Endereço')
                    ->maxLength(255),
                Forms\Components\Toggle::make('active')->label('Ativo')
                    ->hiddenOn('create')
                    ->default(true)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Nome')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('image')->size(70)
                    ->label('Imagem'),
                Tables\Columns\TextColumn::make('owner')->label('Responsável')
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')->label('Descrição')
                    ->searchable(),
                Tables\Columns\TextColumn::make('schedule')->label('Horário')
                    ->searchable(),
                Tables\Columns\TextColumn::make('address')->label('Endereço')
                    ->searchable(),
                Tables\Columns\IconColumn::make('active')->label('Ativo')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListCelulas::route('/'),
            'create' => Pages\CreateCelula::route('/create'),
            'edit' => Pages\EditCelula::route('/{record}/edit'),
        ];
    }
}
