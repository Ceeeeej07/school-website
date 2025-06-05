<div>
    <div class="shadow-sm border border-gray-200 rounded-xl p-6 mb-6">
        <div class="max-w-7xl mx-auto">
            <div class="flex justify-between items-center mb-4">
                <div>
                    <h1 class="text-3xl font-bold text-white">News Management</h1>
                    <p class="text-gray-400 mt-1">Manage your news articles</p>
                </div>
                <button class="bg-yellow-600 hover:bg-yellow-700 text-black px-4 py-2 rounded-lg flex items-center gap-2 transition-colors">
                    <i class="fas fa-plus"></i>
                    Add News
                </button>
            </div>

            <!-- Filters & Search -->
            <div class="flex flex-col md:flex-row gap-4">
                <div class="relative flex-1">
                    <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    <input type="text" placeholder="Search news..." class="bg-gray-600 w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring">
                </div>
                <select class="px-4 py-2 bg-gray-600 border border-gray-300 rounded-lg focus:ring">
                    <option>All Status</option>
                    <option>Published</option>
                    <option>Draft</option>
                </select>
                <select class="px-4 py-2 bg-gray-600 border border-gray-300 rounded-lg focus:ring">
                    <option>All Categories</option>
                    <option>Technology</option>
                    <option>Business</option>
                    <option>Sports</option>
                </select>
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
                    @if(empty($newsList))
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
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="text-sm font-medium text-gray-900 flex items-center gap-2">
                                    {{ $n->title }}

                                    <!-- TODO fix this 
                                                {{-- @if(Boolean($n->is_featured == true)) --}}
                                                <span class="bg-yellow-100 text-yellow-800 text-xs px-2 py-1 rounded-full">Featured</span>
                                                {{-- @endif --}}
                        -->
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $n->author }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">{{ $n->category }}</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">{{ $n->is_published ? 'Published' : 'Draft' }}</span>
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
                    @endif
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
            <div class="flex-1 flex justify-between sm:hidden">
                <button class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">Previous</button>
                <button class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">Next</button>
            </div>
            <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                <div>
                    <p class="text-sm text-gray-700">Showing <span class="font-medium">1</span> to <span class="font-medium">10</span> of <span class="font-medium">97</span> results</p>
                </div>
                <div>
                    <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px">
                        <button class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <button class="bg-blue-50 border-blue-500 text-blue-600 relative inline-flex items-center px-4 py-2 border text-sm font-medium">1</button>
                        <button class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium">2</button>
                        <button class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium">3</button>
                        <button class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </nav>
                </div>
            </div>
        </div>
    </div>



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
</div>
