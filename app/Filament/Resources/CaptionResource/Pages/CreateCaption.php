<?php

namespace App\Filament\Resources\CaptionResource\Pages;

use App\Filament\Resources\CaptionResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCaption extends CreateRecord
{
    protected static string $resource = CaptionResource::class;

    protected function getRedirectUrl():string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Caption created!';
    }
}
