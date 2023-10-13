<?php

namespace App\Filament\Resources\EventDateResource\Pages;

use App\Filament\Resources\EventDateResource;
use App\Models\Event;
use App\Models\EventDate;
use App\Models\EventDateSubscribe;
use Filament\Actions\Action;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\Page;
use Filament\Support\Exceptions\Halt;
use Filament\Tables\Actions\Contracts\HasTable;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class EditEventDate extends Page implements HasForms
{
    use InteractsWithForms;
    protected static string $resource = EventDateResource::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    public ?array $data = [];


    protected static string $view = 'filament.resources.event-date-resource.pages.edit-event-date';


    public function mount(EventDate $record)
    {
        $data = $record->attributesToArray();

        $this->form->fill($data);

    }

    protected function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label(__('filament-panels::resources/pages/edit-record.form.actions.save.label'))
                ->submit('save'),
        ];
    }


    public function form(Form $form): Form
    {
        return  $form
            ->schema([
                Hidden::make('id'),
                Select::make('event_id')
                    ->options(Event::all()->pluck('name', 'id'))
                    ->label('Evento')
                    ->required(),
                DatePicker::make('date')
                    ->required()
                    ->unique(ignoreRecord: true),
            ])->statePath('data');
    }


    public function save()
    {

        try {
            $data =  $this->form->getState();

            $eventDate = EventDate::find($data['id']);
            $eventDate->update(
                $this->form->getState()
            );

            $eventDate->update($data);
        } catch (Halt $exception) {
            return;
        }


        Notification::make()
            ->success()
            ->title(__('filament-panels::resources/pages/edit-record.notifications.saved.title'))
            ->send();
    }
}
