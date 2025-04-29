<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GenresResource\Pages;
use App\Filament\Resources\GenresResource\RelationManagers;
use App\Models\Genres;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class GenresResource extends Resource
{
    protected static ?string $model = Genres::class;

    protected static ?string $navigationGroup = 'Movies Management';
    protected static ?string $navigationIcon = 'heroicon-o-tag';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                ->schema([
                    Forms\Components\TextInput::make('title')->label('Title')->required()->maxLength(100),
                    Forms\Components\TextInput::make('description')->label('Description')->nullable(),
                    Forms\Components\Select::make('status')->label('Status')->options([
                        'draft' => 'Draft',
                        'reviewing' => 'Reviewing',
                        'published' => 'Published',
                    ])
                        ->default('draft')
                        ->live()
                        ->required()
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->label('Title')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('description')->label('Description'),
                Tables\Columns\TextColumn::make('status')->badge()->label('Status')
                    ->color(fn (string $state): string => match ($state) {
                        'draft' => 'gray',
                        'reviewing' => 'warning',
                        'published' => 'success',
                        default => 'secondary',
                    })
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListGenres::route('/'),
            'create' => Pages\CreateGenres::route('/create'),
            'edit' => Pages\EditGenres::route('/{record}/edit'),
        ];
    }
}
