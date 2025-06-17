<?php

namespace App\Livewire\Admin;

use App\Models\News;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateNews extends Component
{

    use WithFileUploads;

    public $title;
    public $is_featured = false;
    public $description;
    public $content;
    public $image;
    public $author;
    public $category = '';
    public $status = '';

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

    public function storeNews()
    {
        $this->validate();

        $data = [
            'title' => $this->title,
            'is_featured' => (bool) $this->is_featured,
            'description' => $this->description,
            'content' => $this->content,
            'author' => $this->author,
            'category' => $this->category,
            'status' => $this->status,

        ];


        if ($this->image) {
            $data['image'] = $this->image->store('news', 'public');
        }



        try {
            // dd($data);
            News::create($data);
            $this->createNews();
            session()->flash('message', 'News created successfully.');
        } catch (\Exception $e) {
            session()->flash('error', 'Error: ' . $e->getMessage());
        }
    }


    public function testSubmit()
    {
        dd('test');
    }

    public function saveNews()
    {
        $this->storeNews();
    }
    public function UploadingImage()
    {

        $this->image;
    }

    public function createNews()
    {
        $this->resetInput();
        return redirect()->route('news');
    }
    private function resetInput()
    {
        $this->reset();
    }
    public function render()
    {
        return view('livewire.admin.create-news');
    }
}
