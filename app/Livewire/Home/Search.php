<?php

namespace App\Livewire\Home;

use Livewire\Attributes\Title;
use Livewire\Component;

class Search extends Component
{
    #[Title("Searching...")]

    public $slug;
    public function search()
    {
        if (empty(trim($this->slug))) {
            $this->dispatch('notify', 'Bạn muốn tìm gì');
            return;
        }

        $searchSlug = $this->slug;

        $this->reset('slug');

        return redirect()->route('home.search', ['slug' => $searchSlug]);

    }

    public function render()
    {
        return view('livewire.home.search');
    }
}
