<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EventSubscribeResource\Pages;
use App\Filament\Resources\EventSubscribeResource\RelationManagers;
use App\Models\EventSubscribe;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\RawJs;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EventSubscribeResource extends Resource
{
    protected static ?string $model = EventSubscribe::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->columns(3)
                    ->schema([
                        Forms\Components\Select::make('event_id')
                            ->relationship('event', 'name')
                            ->required(),
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\DatePicker::make('date_birth')
                            ->required(),
                        Forms\Components\Radio::make('gender')
                            ->required()
                            ->options(['m' => 'Masculino', 'f' => 'Feminino'])
                            ,

                    ]),
                    Section::make()
                    ->description('Contato')
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('phone')
                        ->helperText('Digite somente os numeros')
                            ->tel()
                            ->maxLength(255)
                            ->mask(RawJs::make(<<<'JS'
                                    $input.startsWith('2') ||  $input.startsWith('(2')? '(99)99999-9999' : '99999-9999'
                                JS)),
                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->maxLength(255),

                    ]),
                    Section::make()
                    ->description('Financeiro')
                    ->schema([
                        Forms\Components\Toggle::make('paid')
                        ->required()
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('event.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                // Tables\Columns\TextColumn::make('date_birth')
                //     ->date()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('gender')
                //     ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable(),
                // Tables\Columns\TextColumn::make('email')
                //     ->searchable(),
                Tables\Columns\ToggleColumn::make('paid')
                    ->disabled(function($data){
                        if( $data->event->price > 0 ){
                            return false;
                        }

                        return true;
                    }),
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
            'index' => Pages\ListEventSubscribes::route('/'),
            'create' => Pages\CreateEventSubscribe::route('/create'),
            'edit' => Pages\EditEventSubscribe::route('/{record}/edit'),
        ];
    }
}
