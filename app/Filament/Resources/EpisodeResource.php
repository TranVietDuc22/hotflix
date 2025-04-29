<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EpisodeResource\Pages;
use App\Models\Episode;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EpisodeResource extends Resource
{
    protected static ?string $model = Episode::class;

    protected static ?string $navigationGroup = 'Movies Management';
    protected static ?string $navigationIcon = 'heroicon-o-wallet';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Movie Information')
                    ->schema([
                        Forms\Components\Select::make('movie_id')
                            ->label('Movie')
                            ->relationship('movie', 'title', modifyQueryUsing: fn($query)=> $query->where('total_episodes', '>', 1))->preload()->required(),
                        Forms\Components\TextInput::make('episode')->label('Episode'),
                    ]),
                Forms\Components\Section::make('Option')
                    ->schema([
                        Forms\Components\Repeater::make('link_film')
                            ->schema([
                                Forms\Components\Select::make('server')->label('Server')
                                    ->options(config('movie_config.server'))->required(),
                                Forms\Components\TextInput::make('embed')->label('Embed link')->required(),
                            ])
                            ->reorderable()
                            ->addActionLabel('Add More'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('movie.title')->searchable()->sortable()->label('Movie'),
                Tables\Columns\TextColumn::make('link_film')->label('Link Film'),
                Tables\Columns\TextColumn::make('movie.caption.title')->label('Caption/ Language'),
                Tables\Columns\TextColumn::make('episode')->label('Episode'),
                Tables\Columns\TextColumn::make('movie.total_episodes')->label('Total Episodes'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Film Information')
                    ->schema([
                        TextEntry::make('movie.title')->label('Movie title'),
                        TextEntry::make('movie.caption.title')->label('Caption/ Language'),
                        TextEntry::make('episode')->label('Episode'),
                        TextEntry::make('movie.total_episodes')->label('Total Episodes'),
                    ])
            ]);
    }
    public static function getRelations(): array
    {
        return [
            //
        ];
    }
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEpisodes::route('/'),
            'create' => Pages\CreateEpisode::route('/create'),
            'edit' => Pages\EditEpisode::route('/{record}/edit'),
        ];
    }
}
