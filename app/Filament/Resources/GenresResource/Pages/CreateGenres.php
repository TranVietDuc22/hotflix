<?php

namespace App\Filament\Resources\GenresResource\Pages;

use App\Filament\Resources\GenresResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateGenres extends CreateRecord
{
    protected static string $resource = GenresResource::class;

    protected function getRedirectUrl():string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Genres created!';
    }
}
