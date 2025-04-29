<?php

namespace App\Filament\Widgets;

use App\Models\Movie;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class MovieChart extends ChartWidget
{
    protected static ?string $heading = 'Movies Chart';

    protected static string $color = 'info';
    protected static ?int $sort = 3;

    protected function getData(): array
    {
        $data = Trend::model(Movie::class)
            ->between(
                start: now()->startOfMonth(),
                end: now()->endOfMonth(),
            )
            ->perDay()
            ->count();

        return [
            'datasets' => [
                [
                    'label' => 'Movies',
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                ],
            ],
            'labels' => $data->map(fn (TrendValue $value) => $value->date),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
