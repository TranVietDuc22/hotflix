<?php

namespace App\Filament\Widgets;

use App\Models\Episode;
use App\Models\Movie;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Users', User::query()->count())
                ->description('all in website')
                ->descriptionIcon('heroicon-m-user-group'),
            Stat::make('Movies', Movie::query()->count())
                ->description('added in website')
                ->descriptionIcon('heroicon-o-film'),
            Stat::make('Episodes', Episode::query()->count())
                ->description('add in website')
                ->descriptionIcon('heroicon-o-play'),
        ];
    }
}
