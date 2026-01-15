<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Gallery;
use Livewire\Component;

class Galery extends Component
{
    public $perPage = 12;
    public $selectedCategory = null;

    public function mount($category = null)
    {
        $this->selectedCategory = $category;
    }

    public function loadMore()
    {
        $this->perPage += 12;
    }

    public function selectCategory($categoryId)
    {
        $this->selectedCategory = $categoryId;
        $this->perPage = 12; // Reset to initial
    }

    public function render()
    {
        $categories = Category::where('is_featured', true)
            ->orderBy('name')
            ->get();

        $query = Gallery::query();

        if ($this->selectedCategory) {
            $query->where('category_id', $this->selectedCategory);
        }

        $galleries = $query->orderBy('created_at', 'desc')
            ->take($this->perPage)
            ->get();

        $hasMore = $query->count() > $this->perPage;

        return view('livewire.galery', [
            'galleries' => $galleries,
            'categories' => $categories,
            'hasMore' => $hasMore
        ]);
    }
}
