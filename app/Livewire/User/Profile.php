<?php

namespace App\Livewire\User;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

class Profile extends Component
{
    use WithFileUploads;

    #[Title('Profile')]
    public $user, $name, $avatar;

    protected $rules = [
        'name' => 'required',
        'avatar' => 'nullable|image|mimes:jpg,jpeg,png',
    ];

    protected $messages = [
        'name.required' => 'Name is required.',
        'avatar.image' => 'Avatar is not valid.',
        'avatar.mimes' => 'Avatar is not valid.',
    ];

    public function mount()
    {
        $this->name = auth()->user()->name;
    }

    public function updateProfile()
    {
        $this->validate();
        if ($this->avatar) {
            $avatarPath = $this->avatar->store('images', 'public');
        }else{
            $avatarPath = Auth::user()->avatar_path;
        }
        Auth::user()->update([
            'name' => $this->name,
            'avatar_path' => $avatarPath,
        ]);
        $this->dispatch('show-alert', type: 'success', message: 'Profile updated successfully.');
    }

    public function favorite()
    {
        return $this->redirect('favorite');
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.user.profile');
    }
}
