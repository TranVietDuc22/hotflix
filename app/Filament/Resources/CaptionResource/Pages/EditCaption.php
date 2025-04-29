<?php

namespace App\Filament\Resources\CaptionResource\Pages;

use App\Filament\Resources\CaptionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCaption extends EditRecord
{
    protected static string $resource = CaptionResource::class;

    protected function getRedirectUrl():string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getSavedNotificationTitle(): ?string
    {
        return 'Caption updated!';
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
