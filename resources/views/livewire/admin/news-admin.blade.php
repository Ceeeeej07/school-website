<div>
    <div class="shadow-sm border border-gray-200 rounded-xl p-6 mb-6">
        <div class="max-w-7xl mx-auto">
            <div class="flex justify-between items-center mb-4">
                <div>
                    <h1 class="text-3xl font-bold text-white">News Management</h1>
                    <p class="text-gray-400 mt-1">Manage your news articles</p>
                </div>
                <button wire:click="createNews" class="bg-yellow-600 hover:bg-yellow-700 text-black px-4 py-2 rounded-lg flex items-center gap-2 transition-colors">
                    <flux:icon.plus class="size-6" />
                    Add News
                </button>
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


    @if($isOpen)
    <div class="fixed z-50 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <!-- Background overlay -->
            <div class="fixed inset-0 bg-gray-900/75 transition-opacity" wire:click="closeModal"></div>

            <!-- Modal panel -->
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full">
                <!-- Header -->
                <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-4">
                    <div class="flex items-center justify-between">
                        <h3 class="text-2xl font-bold text-white" id="modal-title">
                            Create News Article
                        </h3>
                        <button type="button" class="text-white hover:text-gray-200 transition-colors" wire:click="closeModal">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Form Content -->
                <div class="bg-white px-6 py-6">
                    <form wire:submit.prevent="store" class="space-y-6">
                        <!-- Title -->
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                                Title <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="title" wire:model="title" placeholder="Enter article title" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" required>
                            @error('title')
                            <p class="mt-1 text-sm text-red-600">{{ $errors->first('title') }}</p>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                                Description <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="description" wire:model="description" placeholder="Brief description of the article" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" required>
                            @error('description')
                            <p class="mt-1 text-sm text-red-600">{{ $errors->first('description') }}</p>
                            @enderror
                        </div>

                        <!-- Row for Author and Category -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Author -->
                            <div>
                                <label for="author" class="block text-sm font-medium text-gray-700 mb-2">
                                    Author <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="author" wire:model="author" placeholder="Author name" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" required>
                                @error('author')
                                <p class="mt-1 text-sm text-red-600">{{ $errors->first('author') }}</p>
                                @enderror
                            </div>

                            <!-- Category -->
                            <div>
                                <label for="category" class="block text-sm font-medium text-gray-700 mb-2">
                                    Category <span class="text-red-500">*</span>
                                </label>
                                <select id="category" wire:model="category" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" required>
                                    <option value="">Select category</option>
                                    <option value="politics">Politics</option>
                                    <option value="business">Business</option>
                                    <option value="technology">Technology</option>
                                    <option value="sports">Sports</option>
                                    <option value="entertainment">Entertainment</option>
                                    <option value="health">Health</option>
                                    <option value="science">Science</option>
                                    <option value="world">World</option>
                                    <option value="local">Local</option>
                                </select>
                                @error('category')
                                <p class="mt-1 text-sm text-red-600">{{ $errors->first('category') }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Image Upload -->
                        <div>
                            <label for="image" class="block text-sm font-medium text-gray-700 mb-2">
                                Featured Image
                            </label>

                            <!-- File input -->
                            <div class="mt-1">
                                <input type="file" id="image" wire:model="image" accept="image/*" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">

                                <!-- Loading indicator -->
                                <div wire:loading wire:target="image" class="mt-3 flex items-center text-sm text-blue-600">
                                    <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    Processing image...
                                </div>

                                <!-- Image Preview -->
                                @if($image)
                                <div class="mt-4 relative">
                                    <div class="relative inline-block">
                                        <img src="{{ $image->temporaryUrl() }}" alt="Preview" class="max-w-xs max-h-48 rounded-lg shadow-md border border-gray-200">
                                        <!-- Remove button -->
                                        <button type="button" wire:click="removeImage" class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center hover:bg-red-600 transition-colors shadow-lg" title="Remove image">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                        </button>
                                    </div>
                                    <!-- Image info -->
                                    <div class="mt-2 text-sm text-gray-600">
                                        <div class="flex items-center space-x-4">
                                            <span><strong>File:</strong> {{ $image->getClientOriginalName() }}</span>
                                            <span><strong>Size:</strong> {{ number_format($image->getSize() / 1024, 1) }} KB</span>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>

                            @error('image')
                            <p class="mt-1 text-sm text-red-600">{{ $errors->first('image') }}</p>
                            @enderror
                        </div>

                        <!-- Content -->
                        <div>
                            <label for="content" class="block text-sm font-medium text-gray-700 mb-2">
                                Content <span class="text-red-500">*</span>
                            </label>
                            <textarea id="content" wire:model="content" placeholder="Write your article content here..." rows="6" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors resize-vertical" required></textarea>
                            @error('content')
                            <p class="mt-1 text-sm text-red-600">{{ $errors->first('content') }}</p>
                            @enderror
                        </div>

                        <!-- Row for Featured and Status -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Is Featured -->
                            <div>
                                <label class="flex items-center">
                                    <input type="checkbox" wire:model="is_featured" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                    <span class="ml-2 text-sm font-medium text-gray-700">Featured Article</span>
                                </label>
                                <p class="mt-1 text-xs text-gray-500">This article will be highlighted on the homepage</p>
                                @error('is_featured')
                                <p class="mt-1 text-sm text-red-600">{{ $errors->first('is_featured') }}</p>
                                @enderror
                            </div>

                            <!-- Status -->
                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                                    Status <span class="text-red-500">*</span>
                                </label>
                                <select id="status" wire:model="status" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" required>
                                    <option value="">Select status</option>
                                    <option value="draft">Draft</option>
                                    <option value="published">Published</option>
                                    <option value="archived">Archived</option>
                                </select>
                                @error('status')
                                <p class="mt-1 text-sm text-red-600">{{ $errors->first('status') }}</p>
                                @enderror
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Footer -->
                <div class="bg-gray-50 px-6 py-4 flex flex-col sm:flex-row sm:justify-between sm:items-center gap-3">
                    <!-- Success Message -->
                    @if (session()->has('message'))
                    <div class="flex items-center bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded-md">
                        <svg class="h-5 w-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        {{ session('message') }}
                    </div>
                    @endif

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-2 sm:ml-auto">
                        <button type="button" wire:click="closeModal" class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                            Cancel
                        </button>
                        <button type="submit" wire:click="store" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors disabled:opacity-50 disabled:cursor-not-allowed" wire:loading.attr="disabled">
                            <span wire:loading.remove>Create Article</span>
                            <span wire:loading class="flex items-center">
                                <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Creating...
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
