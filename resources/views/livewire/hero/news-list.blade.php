<div>
    <h3 class="text-2xl font-bold mb-6 text-black">Latest News</h3>

    @if ($loading)
    <div class="flex justify-center items-center py-10">
        <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-700"></div>
    </div>
    @elseif ($error)
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
        {{ $error }}
    </div>
    @elseif (empty($newsItems))
    <div class="bg-gray-100 p-6 rounded-lg text-center">
        <p class="text-gray-500">No news items available.</p>
    </div>
    @else
    @foreach ($newsItems as $newsItem)
    <!-- News Item -->
    <div class="news-item bg-white rounded-lg shadow-lg overflow-hidden mb-6 transform transition duration-300 hover:shadow-xl">
        <div class="flex flex-col md:flex-row">
            @if(isset($newsItem['image']) && $newsItem['image'])
            <div class="md:w-1/3">
                <img src="{{ asset('storage/' . $newsItem['image']) }}" alt="{{ $newsItem['title'] }}" class="w-full h-48 md:h-full object-cover">
            </div>
            @endif
            <div class="{{ isset($newsItem['image']) && $newsItem['image'] ? 'md:w-2/3' : 'w-full' }} p-6">
                <div class="flex items-center justify-between mb-2">
                    <div class="flex items-center text-gray-500 text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        {{ \Carbon\Carbon::parse($newsItem['created_at'])->format('F d, Y') }}
                    </div>
                    @if($newsItem['is_featured'] ?? false)
                    <span class="bg-yellow-500 text-white text-xs px-2 py-1 rounded">Featured</span>
                    @endif
                </div>
                <h3 class="text-xl font-semibold mb-3 text-gray-800">{{ $newsItem['title'] }}</h3>
                <p class="text-gray-600 mb-4">{{ $newsItem['description'] }}</p>
                <a href="#" wire:click.prevent="$dispatch('show-news-detail', { id: {{ $newsItem['id'] }} })" class="inline-block text-green-600 hover:text-green-800 font-medium">Read More →</a>
            </div>
        </div>
    </div>
    @endforeach
    @endif

    <!-- Refresh button -->
    <div class="flex justify-center mt-4">
        <button wire:click="fetchNews" class="bg-green-600 hover:bg-green-800 text-white px-4 py-2 rounded-lg shadow transition">
            Refresh News
        </button>
    </div>
</div>
