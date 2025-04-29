<?php

namespace App\Filament\Pages\Auth;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Form;
use Filament\Pages\Auth\EditProfile as BaseEditProfile;
use Filament\Facades\Filament;

class EditProfile extends BaseEditProfile
{
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                $this->getNameFormComponent(),
                FileUpload::make('avatar_path')
                    ->label('Avatar')
                    ->image()
                    ->disk('public')
                    ->nullable(),
                $this->getEmailFormComponent(),
                $this->getPasswordFormComponent(),
                $this->getPasswordConfirmationFormComponent(),
            ]);
    }
    public function save(): void
    {
        parent::save();

        $this->redirect(Filament::getCurrentPanel()->getUrl(), navigate: true);
    }
}
