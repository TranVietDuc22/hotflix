<?php

namespace App\Filament\Resources\FormatResource\Pages;

use App\Filament\Resources\FormatResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFormat extends EditRecord
{
    protected static string $resource = FormatResource::class;

    protected function getRedirectUrl():string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getSavedNotificationTitle(): ?string
    {
        return 'Format updated!';
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
