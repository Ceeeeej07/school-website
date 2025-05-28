<?php

use Livewire\Volt\Component;
use Livewire\WithFileUploads;
use App\Models\News;
use Illuminate\Support\Str;


new class extends Component {

    use WithFileUploads;
    
    public $news;
    public $title;
    public $slug;
    public $description;
    public $content;
    public $image;
  

   protected $rules = [
    'title' => 'required|string|max:255',
    'image' => 'required|image', 
    'content' => 'required|string',
];

    public function store()
    {
        $this->validate();

        $data = [
            'title' => $this->title,
            'slug' => Str::slug($this->title),
            'description' => $this->description,
            'content' => $this->content,
        ];

        if($this->image) {
            $this->image->store('news', 'public');
        }

        News::updateOrCreate(
            ['slug' => $data['slug']],
            array_merge($data, ['image' => $this->image ? $this->image->hashName() : null])
        );
        $this->reset(['title', 'description', 'content', 'image']);

        session()->flash('message', 'News created successfully.');
    }
    
}; ?>

<div>
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <p class="text-3xl font-bold text-center text-white">News</p>

        <form wire:submit.prevent="store" class="flex flex-col gap-4">
            <input type="text" wire:model="title" placeholder="Title" class="p-2 rounded-md">

            <input type="text" wire:model="description" placeholder="Description" class="p-2 rounded-md">

            <input type="file" wire:model="image" placeholder="Image URL" class="p-2 rounded-md">
            <textarea wire:model="content" placeholder="Content" class="p-2 rounded-md"></textarea>
            <button type="submit" class="bg-blue-500 text-white p-2 rounded-md">Create News</button>
        </form>

        @if (session()->has('message'))
        <div class="bg-green-500 text-white p-2 rounded-md">
            {{ session('message') }}
        </div>
        @endif
    </div>

    <div class="flex flex-col gap-4">
        @foreach ($news as $item)
        <div class=" p-4 rounded-md shadow-md">
            <h2 class="text-xl font-bold">{{ $item->title }}</h2>
            <p>{{ $item->description }}</p>
            <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}" class="w-6 h-6 object-cover mt-2">
            <p>{{ $item->content }}</p>
        </div>
        @endforeach
    </div>
