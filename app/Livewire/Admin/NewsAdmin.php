<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use App\Models\Status;
use App\Models\News;
use Livewire\Component;

use Livewire\WithPagination;
use Livewire\WithFileUploads;


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
    // public $category = '';
    // public $status = '';

    public $perPage = 5;
    public $search = '';

    public $isOpen = false;

    public $recordNews;
    public $category_id = '';
    public $status_id = '';

    public $categories;
    public $statuses;

    // public $newsList;




    protected $paginationTheme = 'tailwind';
    protected $rules = [
        'title' => 'required|string|max:255',
        'is_featured' => 'required|boolean',
        'image' => 'nullable|image|max:2048',
        'content' => 'required|string',
        'description' => 'required|string|max:500',
        'author' => 'required|string|max:100',
        'category_id' => 'required|exists:categories,id',
        'status_id' => 'required|exists:statuses,id',
    ];

    public function mount()
    {
        // $this->newsList = News::query()->paginate($this->perPage)->withQueryString();

        $this->categories = Category::all();
        $this->statuses = Status::all();
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




    // * modal
    public function openModal()
    {
        $this->isOpen = true;
    }
    public function closeModal()
    {
        $this->isOpen = false;
    }



    public function testSubmit()
    {
        dd('test');
    }

    // * redirector
    // public function addNews()
    // {
    //     return redirect()->route('create-news');
    // }

    // * Delete news
    public function deleteNews($id)
    {
        try {
            News::find($id)->delete();
            session()->flash('message', 'News deleted successfully.');
        } catch (\Exception $e) {
            session()->flash('error', 'Error: ' . $e->getMessage());
        }
    }

    // * update/edit news
    public function editNews($id)
    {
        $newsRecord = News::findOrFail($id);
        $this->title = $newsRecord->title;
        $this->is_featured = $newsRecord->is_featured;
        $this->description = $newsRecord->description;
        $this->content = $newsRecord->content;
        $this->author = $newsRecord->author;
        $this->category_id = $newsRecord->category_id;
        $this->status_id = $newsRecord->status_id;

        $this->openModal();
    }
    public function updateNews()
    {
        $this->validate();

        $data = [
            'title' => $this->title,
            'is_featured' => (bool) $this->is_featured,
            'description' => $this->description,
            'content' => $this->content,
            'author' => $this->author,
            'category_id' => $this->category_id,
            'status_id' => $this->status_id,
        ];

        if ($this->image) {
            $data['image'] = $this->image->store('news', 'public');
        }

        try {
            $this->recordNews->update($data);
            session()->flash('message', 'News updated successfully.');
            $this->closeModal();
        } catch (\Exception $e) {
            session()->flash('error', 'Error: ' . $e->getMessage());
        }
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
            ->when($this->status_id, function ($q) {
                $q->where('status_id', $this->status_id);
            })
            ->when($this->category_id, function ($q) {
                $q->where('category_id', $this->category_id);
            })
            ->latest();

        return view('livewire.admin.news-admin', [
            'newsList' => $query->paginate($this->perPage)->withQueryString(),
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
