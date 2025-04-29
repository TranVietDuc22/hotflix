<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Pages\Page;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Hash;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationGroup = 'Users Management';
    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('User Information')
                    ->schema([
                        Forms\Components\Section::make()
            ->schema([
                Forms\Components\TextInput::make('name')->label('Name')->required()->maxLength(50),
                Forms\Components\TextInput::make('email')->label('Email')->required()->email()->maxLength(50)->unique(ignoreRecord: true),
            ])->columns(2),
                        Forms\Components\Section::make()
            ->schema([
                Forms\Components\TextInput::make('password')
                    ->label('Password')
                    ->password()
                    ->required(fn(Page $livewire): bool => $livewire instanceof CreateRecord)
                    ->minLength(8)
                    ->same('passwordConfirm')
                    ->dehydrated(fn($state)=> filled($state))
                    ->dehydrateStateUsing(fn ($state) => Hash::make($state)),
                Forms\Components\TextInput::make('passwordConfirm')
                    ->label('Confirm Password')
                    ->password()
                    ->required(fn(Page $livewire): bool => $livewire instanceof CreateRecord)
                    ->minLength('8')
                    ->dehydrated(false),
            ])->columns(2),
                        Forms\Components\TextInput::make('information')->label('Information')->nullable()->json(),
                        Forms\Components\Toggle::make('is_verified')->label('Verified')->default(false),
                        Forms\Components\FileUpload::make('avatar_path')->label('Avatar')->image()->disk('public')->nullable(),
                        Forms\Components\Select::make('roles')
                            ->relationship('roles', 'name')
                            ->multiple()
                            ->preload()
                            ->searchable(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Name')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('email')->label('Email')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('information')->label('Information')->formatStateUsing(fn ($state) => json_encode($state)),
                Tables\Columns\ImageColumn::make('avatar_path')->label('Avatar')->circular(),
                Tables\Columns\IconColumn::make('is_verified')->label('Verified')->boolean(),
                Tables\Columns\TextColumn::make('roles.name')->label('Roles')->formatStateUsing(fn($state): string => str()->headline($state)),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
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
                Section::make('User Information')
                    ->schema([
                        TextEntry::make('name')->label('Name'),
                        TextEntry::make('email')->label('Email'),
                        TextEntry::make('information')->label('Information'),
                        IconEntry::make('is_verified')->boolean()->label('Verified'),
                        ImageEntry::make('avatar_path')->label('Avatar'),
                            TextEntry::make('roles.name')->label('Roles')
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
