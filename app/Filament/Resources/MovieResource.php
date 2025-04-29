<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MovieResource\Pages;
use App\Models\Movie;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MovieResource extends Resource
{
    protected static ?string $model = Movie::class;

    protected static ?string $navigationGroup = 'Movies Management';
    protected static ?string $navigationIcon = 'heroicon-o-film';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Film Infomation')
                ->schema([
                    Forms\Components\Section::make('')
            ->schema([
                Forms\Components\TextInput::make('title')->required(),
                Forms\Components\TextInput::make('original_name'),
            ])->columns(2),
                    Forms\Components\Textarea::make('description')->columnSpanFull(),
                    Forms\Components\Repeater::make('link_film')
                        ->schema([
                            Forms\Components\Select::make('server')->label('Server')
                                ->options(config('movie_config.server'))->required(),
                            Forms\Components\TextInput::make('name')->label('Episode/ Status')->default('1')->required(),
                            Forms\Components\TextInput::make('embed')->label('Embed link')->required(),
                        ])->columns(3)->addActionLabel('Add More'),
                    Forms\Components\Section::make('')
            ->schema([
                Forms\Components\TextInput::make('cast'),
                Forms\Components\TextInput::make('director'),
                Forms\Components\TextInput::make('current_episode'),
                Forms\Components\TextInput::make('time'),
                Forms\Components\TextInput::make('total_episodes')->required(),
                Forms\Components\TextInput::make('year'),
                Forms\Components\Select::make('category_id')
                    ->relationship('category', 'title',  fn ($query) => $query->where('status', 'published'))
                    ->searchable()->preload()->required(),
                Forms\Components\Select::make('country_id')
                    ->relationship('country', 'name',  fn ($query) => $query->where('status', 'published'))
                    ->searchable()->preload(),
                Forms\Components\Select::make('genres')
                    ->multiple()
                    ->relationship('genres', 'title',  fn ($query) => $query->where('status', 'published'))
                    ->searchable()->preload(),
                Forms\Components\Select::make('caption_id')
                    ->label('Caption/ Language')
                    ->relationship('caption', 'title')
                    ->searchable()->preload()->createOptionForm([
                        Forms\Components\TextInput::make('title')->label('Add new caption')->required(),
                    ]),
                Forms\Components\TextInput::make('poster')->label('Poster Link'),
                Forms\Components\Select::make('format_id')
                    ->relationship('format', 'title')
                    ->searchable()->preload()->createOptionForm([
                        Forms\Components\TextInput::make('title')->label('Add new format')->required(),
                    ]),
                Forms\Components\TextInput::make('banner')->label('Banner Link'),
            ])->columns(2),
                    Forms\Components\Toggle::make('is_film_hot'),
                    Forms\Components\Select::make('status')->label('Status')->options([
                        'draft' => 'Draft',
                        'reviewing' => 'Reviewing',
                        'published' => 'Published',
                    ])
                        ->default('draft')
                        ->live()
                        ->required()
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->sortable()->searchable(),
                Tables\Columns\ImageColumn::make('poster')->label('Poster'),
                Tables\Columns\TextColumn::make('category.title')->label('Category'),
                Tables\Columns\TextColumn::make('country.name')->label('Country'),
                Tables\Columns\TextColumn::make('time')->label('Time'),
                Tables\Columns\TextColumn::make('format.title')->label('Format'),
                Tables\Columns\TextColumn::make('caption.title')->label('Caption/ Language'),
                Tables\Columns\TextColumn::make('genres.title')->label('Genres')->listWithLineBreaks(),
                Tables\Columns\TextColumn::make('status')->label('Status')->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'draft' => 'gray',
                        'reviewing' => 'warning',
                        'published' => 'success',
                        default => 'secondary',
                    }),
                Tables\Columns\ToggleColumn::make('is_film_hot')->label('Hot Film')
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
                    TextEntry::make('title')->label('Title'),
                    TextEntry::make('original_name')->label('Original Name'),
                    TextEntry::make('description')->label('Description'),
                    TextEntry::make('cast')->label('Cast'),
                    TextEntry::make('director')->label('Director'),
                    TextEntry::make('time')->label('Time'),
                    TextEntry::make('current_episode')->label('Current Episode'),
                    TextEntry::make('total_episodes')->label('Total Episodes'),
                    TextEntry::make('year')->label('Year'),
                    TextEntry::make('category.title')->label('Category'),
                    TextEntry::make('country.name')->label('Country'),
                    TextEntry::make('format.title')->label('Format'),
                    TextEntry::make('caption.title')->label('Caption/ Language'),
                    TextEntry::make('genres.title')->label('Genres'),
                    IconEntry::make('status')->label('Status')->icon(fn (string $state): string => match ($state) {
                        'draft' => 'heroicon-o-pencil',
                        'reviewing' => 'heroicon-o-clock',
                        'published' => 'heroicon-o-check-circle',
                    }),
                    ImageEntry::make('poster')->label('Poster')
                        ->columnSpanFull(),
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
            'index' => Pages\ListMovies::route('/'),
            'create' => Pages\CreateMovie::route('/create'),
            'edit' => Pages\EditMovie::route('/{record}/edit'),
        ];
    }
}
