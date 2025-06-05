<?php

namespace App\Livewire\Hero;

use Livewire\Component;
use App\Models\News;

class NewsList extends Component
{
    public $newsItems = [];
    public $loading = true;
    public $error = null;
    public $limit = 3;



    public function mount($limit = 3)
    {
        $this->limit = $limit;
        $this->loadNews();
    }

    public function fetchNews()
    {
        $this->loading = true;
        $this->loadNews();
    }


    protected function loadNews()
    {
        try {
            $this->newsItems = News::latest()
                ->take($this->limit)
                ->get()
                ->toArray();
            $this->error = null;
        } catch (\Exception $e) {
            $this->error = "Failed to load news: " . $e->getMessage();
            $this->newsItems = [];
        } finally {
            $this->loading = false;
        }
    }
    public function render()
    {
        return view('livewire.hero.news-list');
    }
}
