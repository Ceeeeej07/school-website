<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\News;
use Illuminate\Support\Str;
use Livewire\WithPagination;

class NewsAdmin extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $perPage = 5;
    public $search = '';
    public $title = '';
    public $is_featured = false;
    public $slug;
    public $description;
    public $content;
    public $image;
    public $author;
    public $category = '';
    public $status = '';



    protected $paginationTheme = 'tailwind';
    protected $rules = [
        'title' => 'required|string|max:255',
        'is_featured' => 'required|boolean',
        'slug' => 'required|string|max:255|unique:news,slug',
        'image' => 'required|image',
        'content' => 'required|string',
        'description' => 'required|string|max:500',
        'author' => 'required|string|max:100',
        'category' => 'in:Academic,Entertainment,Sports',
        'status' => 'in:Draft,Published',
    ];

    public function mount()
    {
        $this->slug = Str::slug($this->title);
    }

    // * Search and pagination
    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function updatingPerPage()
    {
        $this->resetPage();
    }
    public function getNewsListProperty()
    {
        return News::where('title', 'like', '%' . $this->search . '%')
            ->orWhere('author', 'like', '%' . $this->search . '%')
            ->orWhere('category', 'like', '%' . $this->search . '%')
            ->orderBy('created_at', 'desc')
            ->paginate($this->perPage);
    }


    // *Fetch news for admin panel



    // * Store or update news
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

        $data['is_featured'] = (bool) $this->is_featured;

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
        $query = News::query()
            ->when($this->search, function ($q) {
                $q->where(function ($query) {
                    $query->where('title', 'like', '%' . $this->search . '%')
                        ->orWhere('description', 'like', '%' . $this->search . '%')
                        ->orWhere('content', 'like', '%' . $this->search . '%')
                        ->orWhere('author', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->status, function ($q) {
                $q->where('status', $this->status);
            })
            ->when($this->category, function ($q) {
                $q->where('category', $this->category);
            })
            ->latest();

        return view('livewire.admin.news-admin', [
            'newsList' => $query->paginate($this->perPage)->withQueryString()
        ]);
    }
}
