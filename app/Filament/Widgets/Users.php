<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class Users extends BaseWidget
{
    protected static ?string $heading = 'New Users';
    protected static ?int $sort = 4;

    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(User::query()->latest('created_at'))
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Name')->sortable()->searchable(),
                Tables\Columns\ImageColumn::make('avatar_path')->label('Avatar')->circular(),
                Tables\Columns\TextColumn::make('email')->label('Email')->sortable()->searchable(),
                Tables\Columns\IconColumn::make('is_verified')->boolean()->label('Verified')
            ]);
    }
}
