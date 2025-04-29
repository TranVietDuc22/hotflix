<?php

namespace App\Filament\Resources\GenresResource\Pages;

use App\Filament\Resources\GenresResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditGenres extends EditRecord
{
    protected static string $resource = GenresResource::class;

    protected function getRedirectUrl():string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getSavedNotificationTitle(): ?string
    {
        return 'Genres updated!';
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
