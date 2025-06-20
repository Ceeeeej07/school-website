<div>
    <div class="shadow-sm border border-gray-200 rounded-xl p-6 mb-6">
        <div class="max-w-7xl mx-auto">
            <div class="flex justify-between items-center mb-4">
                <div>
                    <h1 class="text-3xl font-bold text-white">News Management</h1>
                    <p class="text-gray-400 mt-1">Manage your news articles</p>
                </div>

                <button wire:click="openModal" class="bg-yellow-600 hover:bg-yellow-700 text-black px-4 py-2 rounded-lg flex items-center gap-2 transition-colors">
                    <flux:icon.plus class="size-6" />
                    Add News
                </button>

                {{-- <a href={{ route('create-news') }} wire:click="addNews" class="bg-yellow-600 hover:bg-yellow-700 text-black px-4 py-2 rounded-lg flex items-center gap-2 transition-colors">
                <flux:icon.plus class="size-6" />
                Add News
                </a> --}}
            </div>

            <!-- Filters & Search -->
            <div class="flex flex-col md:flex-row gap-4">
                <!-- Search input - will expand to fill available space -->
                <flux:input type="text" wire:model.live="search" placeholder="Search news..." class="flex-grow md:flex-grow-[2]" />

                <!-- Dropdowns with fixed widths -->
                <flux:select wire:model.live="status_id" class="px-4 py-2 bg-gray-600 border border-gray-300 rounded-lg focus:ring w-full md:w-48">
                    <flux:select.option value="">All Status</flux:select.option>
                    @foreach($statuses as $status)
                    <flux:select.option value="{{ $status->id }}">{{ $status->name }}</flux:select.option>
                    @endforeach
                </flux:select>

                <flux:select wire:model.live="category_id" class="px-4 py-2 bg-gray-600 border border-gray-300 rounded-lg focus:ring w-full md:w-48">
                    <flux:select.option value="">All Categories</flux:select.option>
                    @foreach ($categories as $category)
                    <flux:select.option value="{{ $category->id }}">{{ $category->name }}</flux:select.option>
                    @endforeach
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
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">{{ $n->category->name }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">{{ $n->status->name }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ \Carbon\Carbon::parse($n['created_at'])->format('F d, Y')}}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex items-center gap-2">
                                    <button type="button" wire:click="editNews({{ $n->id }})" class="text-green-600 hover:text-green-900" title="Edit">
                                        <flux:icon.pencil-square class="size-6" />
                                    </button>
                                    <button type="button" wire:click="deleteNews({{ $n->id }})" wire:confirm="Delete this article?" class="text-red-600 hover:text-red-900" title="Delete">
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
    @if($isOpen)
    <div class="fixed z-50 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <!-- Background overlay -->
            <div class="fixed inset-0 bg-gray-900/75 transition-opacity"></div>

            <!-- Modal panel -->
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full">
                <!-- Header -->
                <div class="bg-gradient-to-r from-gray-800 to-gray-500 px-6 py-4">
                    <div class="flex items-center justify-between">
                        <h3 class="text-2xl font-bold text-white">
                            Create News Article
                        </h3>
                        <button type="button" class="text-white hover:text-gray-200 transition-colors" wire:click="closeModal">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
                @livewire('admin.create-news')
            </div>
        </div>
    </div>
    @endif
</div>
