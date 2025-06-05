<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\News;
use Illuminate\Support\Str;

class NewsAdmin extends Component
{
    use WithFileUploads;

    public $newsList = [];
    public $title = '';
    public $is_featured = false;
    public $slug;
    public $description;
    public $content;
    public $image;
    public $author;
    public $category;
    public $status = 'Draft';

    protected $rules = [
        'title' => 'required|string|max:255',
        'is_featured' => 'required|boolean',
        'slug' => 'required|string|max:255|unique:news,slug',
        'image' => 'required|image',
        'content' => 'required|string',
        'description' => 'required|string|max:500',
        'author' => 'required|string|max:100',
        'category' => 'required|string|max:100',
        'status' => 'in:Draft,Published,Archived',
    ];

    public function mount()
    {
        $this->slug = Str::slug($this->title);
        $this->loadNewsAdmin();
    }

    public function fetchNewsAdmin()
    {
        $this->loadNewsAdmin();
    }

    public function loadNewsAdmin()
    {
        try {
            $this->newsList = News::latest()->get();
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to load news: ' . $e->getMessage());
            $this->newsList = [];
        }
    }




    public function store()
    {
        $this->validate();

        $data = [
            'title' => $this->title,
            'is_featured' => $this->is_featured,
            'slug' => Str::slug($this->title),
            'description' => $this->description,
            'content' => $this->content,
            'author' => $this->author,
            'category' => $this->category,
            'status' => $this->status,
        ];

        if ($this->is_featured) {
            $data['is_featured'] = true;
        } else {
            $data['is_featured'] = false;
        }

        if ($this->image) {
            $this->image->store('news', 'public');
        }

        News::updateOrCreate(
            ['slug' => $data['slug']],
            array_merge($data, ['image' => $this->image ? $this->image->hashName() : null])
        );
        $this->reset(['title', 'description', 'is_featured', 'content', 'image', 'author', 'category', 'status']);


        session()->flash('message', 'News created successfully.');
    }


    public function render()
    {
        return view('livewire.admin.news-admin');
    }
}
