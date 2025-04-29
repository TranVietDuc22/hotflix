<?php

namespace App\Filament\Resources\MovieResource\Pages;

use App\Filament\Resources\MovieResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMovie extends EditRecord
{
    protected static string $resource = MovieResource::class;

    protected function getRedirectUrl():string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getSavedNotificationTitle(): ?string
    {
        return 'Movie updated!';
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
