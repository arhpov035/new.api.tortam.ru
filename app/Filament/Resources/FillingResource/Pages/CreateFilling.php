<?php

namespace App\Filament\Resources\FillingResource\Pages;

use App\Filament\Resources\FillingResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateFilling extends CreateRecord
{
    protected static string $resource = FillingResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
