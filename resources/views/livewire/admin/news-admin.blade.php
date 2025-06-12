<div>
    <div class="shadow-sm border border-gray-200 rounded-xl p-6 mb-6">
        <div class="max-w-7xl mx-auto">
            <div class="flex justify-between items-center mb-4">
                <div>
                    <h1 class="text-3xl font-bold text-white">News Management</h1>
                    <p class="text-gray-400 mt-1">Manage your news articles</p>
                </div>
                <a href={{ route('create-news') }} wire:click="addNews" class="bg-yellow-600 hover:bg-yellow-700 text-black px-4 py-2 rounded-lg flex items-center gap-2 transition-colors">
                    <flux:icon.plus class="size-6" />
                    Add News
                </a>
            </div>

            <!-- Filters & Search -->
            <div class="flex flex-col md:flex-row gap-4">
                <!-- Search input - will expand to fill available space -->
                <flux:input type="text" wire:model.live="search" placeholder="Search news..." class="flex-grow md:flex-grow-[2]" />

                <!-- Dropdowns with fixed widths -->
                <flux:select wire:model.live="status" class="px-4 py-2 bg-gray-600 border border-gray-300 rounded-lg focus:ring w-full md:w-48">
                    <flux:select.option value="">All Status</flux:select.option>
                    <flux:select.option value="Published">Published</flux:select.option>
                    <flux:select.option value="Draft">Draft</flux:select.option>
                </flux:select>

                <flux:select wire:model.live="category" class="px-4 py-2 bg-gray-600 border border-gray-300 rounded-lg focus:ring w-full md:w-48">
                    <flux:select.option value="">All Categories</flux:select.option>
                    <flux:select.option value="Technology">Academic</flux:select.option>
                    <flux:select.option value="Business">Entertainment</flux:select.option>
                    <flux:select.option value="Sports">Sports</flux:select.option>
                </flux:select>
            </div>
        </div>

        <!-- News Table -->
        <div class="overflow-x-auto mt-4 rounded-t-xl">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Author</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @if($newsList->isEmpty())
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4" colspan="6">
                            <div class="flex flex-col items-center">
                                <div class="text-sm font-medium text-gray-900">No news available</div>
                                <div class="text-sm text-gray-500 mt-1">Please add some news articles.</div>
                            </div>
                        </td>
                    </tr>
                    @else
                    @foreach($newsList as $n)
                    <div wire:key="news-list">
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="text-sm font-medium text-gray-900 flex items-center gap-2">
                                        {{ $n->title }}
                                        @if($n['is_featured'] ?? false)
                                        <span class="bg-yellow-100 text-yellow-800 text-xs px-2 py-1 rounded-full">Featured</span>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $n->author }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">{{ $n->category }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">{{ $n->status }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ \Carbon\Carbon::parse($n['created_at'])->format('F d, Y')}}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex items-center gap-2">
                                    <button class="text-blue-600 hover:text-blue-900" title="View">
                                        <flux:icon.eye class="size-6" />
                                    </button>
                                    <button class="text-green-600 hover:text-green-900" title="Edit">
                                        <flux:icon.pencil-square class="size-6" />
                                    </button>
                                    <button class="text-red-600 hover:text-red-900" title="Delete">
                                        <flux:icon.trash class="size-6" />
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </div>
                    @endif
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div wire:key="news-pagination" class="d-flex justify-content-center bg-white p-4 rounded-b-xl">
            {{ $newsList->links() }}
        </div>

    </div>

    <!-- Modal -->

</div>
