<?php

namespace App\Livewire\Admin;

use App\Livewire\Forms\NewsForm;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\News;
use Illuminate\Support\Str;
use Livewire\WithPagination;

class NewsAdmin extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $title;
    public $is_featured = false;
    public $description;
    public $content;
    public $image;
    public $author;
    public $category = '';
    public $status = '';

    public $perPage = 5;
    public $search = '';



    protected $paginationTheme = 'tailwind';
    protected $rules = [
        'title' => 'required|string|max:255',
        'is_featured' => 'required|boolean',
        'image' => 'nullable|image|max:2048',
        'content' => 'required|string',
        'description' => 'required|string|max:500',
        'author' => 'required|string|max:100',
        'category' => 'in:Academic,Entertainment,Sports',
        'status' => 'in:Draft,Published',
    ];

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




    // * Store news


    public function testSubmit()
    {
        dd('test');
    }

    // * redirector
    public function addNews()
    {
        return redirect()->route('create-news');
    }

    // * update/edit news
    // public function editNews(News $news)
    // {
    //     $this->validate();

    //     $newsList = News::findOrFail($news->id);
    //     $this->title = $newsList->title;
    //     $this->is_featured = $newsList->is_featured;
    //     $this->description = $newsList->description;
    //     $this->image = $newsList->image;
    //     $this->content = $newsList->content;
    //     $this->author = $newsList->author;
    //     $this->category = $newsList->category;
    //     $this->status = $newsList->status;

    //     $this->openModal();
    // }

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

        // return view('livewire.admin.news-admin', [
        //     'newsList' => News::query()
        //         ->where('title', 'like', '%' . $this->search . '%')
        //         ->orWhere('author', 'like', '%' . $this->search . '%')
        //         ->orWhere('category', 'like', '%' . $this->search . '%')
        //         ->orderBy('created_at', 'desc')
        //         ->paginate($this->perPage)
        //         ->withQueryString(),
        //     'categories' => ['Academic', 'Entertainment', 'Sports'],
        //     'statuses' => ['Draft', 'Published']
        // ]);
    }
}
