<?php

namespace App\Filament\Resources\FillingResource\Pages;

use App\Filament\Resources\FillingResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFillings extends ListRecords
{
    protected static string $resource = FillingResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
