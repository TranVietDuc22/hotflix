<?php

namespace App\Filament\Resources\CaptionResource\Pages;

use App\Filament\Resources\CaptionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCaptions extends ListRecords
{
    protected static string $resource = CaptionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
