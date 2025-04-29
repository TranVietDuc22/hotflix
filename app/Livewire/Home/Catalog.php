<?php

namespace App\Livewire\Home;

use App\Models\Category;
use App\Models\Country;
use App\Models\Genres;
use App\Models\Movie;
use Livewire\Component;

class Catalog extends Component
{
    public $categories, $countries, $genres;
    public $catalogItems = [];

    public function mount()
    {
        // Lấy danh mục, quốc gia, thể loại
        $this->categories = Category::select('uuid', 'title')->get()->map(fn($item) => array_merge($item->toArray(), ['sourceTable' => 'categories']));
        $this->countries = Country::select('uuid', 'name')->get()->map(fn($item) => array_merge($item->toArray(), ['sourceTable' => 'countries']));
        $this->genres = Genres::select('uuid', 'title')->get()->map(fn($item) => array_merge($item->toArray(), ['sourceTable' => 'genres']));

        // Gom tất cả vào `catalogItems`
        $this->catalogItems = collect([])
            ->merge($this->categories)
            ->merge($this->countries)
            ->merge($this->genres);
    }

    public function browserByType($uuid, $sourceTable)
    {
        return redirect()->route('film.browser', [
            'uuid' => $uuid,
            'sourceTable' => $sourceTable
        ]);
    }

    public function render()
    {
        return view('livewire.home.catalog', [
            'catalogItems' => $this->catalogItems
        ]);
    }
}
