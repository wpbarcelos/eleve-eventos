<?php

namespace App\Livewire;

use App\Models\EventSubscribe;
use Filament\Support\Contracts\TranslatableContentDriver;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Filament\Tables\Contracts\HasTable;
class FinanceTable extends Component implements HasTable
{
    use InteractsWithTable;

//    public function table(Table $table): Table
//    {
//        return $table->query(EventSubscribeFinance::query())
//            ->columns([
//                TextColumn::make('name')
//            ])
//            ->filters([
//                // ...
//            ])
//            ->actions([
//                // ...
//            ])
//            ->bulkActions([
//                // ...
//            ]);
//
//    }



    public function render(): View
    {
        return view('livewire.finance-table');
    }


    public function makeFilamentTranslatableContentDriver(): ?TranslatableContentDriver
    {
        // TODO: Implement makeFilamentTranslatableContentDriver() method.
    }
}
