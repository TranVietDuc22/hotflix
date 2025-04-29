<?php

namespace App\Filament\Resources\FormatResource\Pages;

use App\Filament\Resources\FormatResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateFormat extends CreateRecord
{
    protected static string $resource = FormatResource::class;

    protected function getRedirectUrl():string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Format created!';
    }
}
