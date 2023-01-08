<?php

namespace App\Filament\Resources\FillingResource\Pages;

use App\Filament\Resources\FillingResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFilling extends EditRecord
{
    protected static string $resource = FillingResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
