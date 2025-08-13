<x-layouts.auth>
    {{-- Breadcumb --}}
    <x-breadcrumb :breadcrumbs="[
        ['label' => 'Settings', 'url' => route('admin.dashboard')],
        ['label' => 'Categories']
    ]" />
    <div class="space-y-6">
        <!-- Main Container -->
        <div class="theme-bg-card rounded-lg theme-shadow-lg theme-border-card border">
            <!-- Header Section -->
            <div class="px-6 py-4 theme-border-card border-b">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                    <h2 class="text-xl font-semibold theme-text-primary">All Categories</h2>
                    <div class="mt-4 sm:mt-0 flex items-center space-x-4">
                        <!-- Search Input -->
                        <form action="{{ route('categories.index') }}" method="GET" class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 theme-text-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                            <input type="text" 
                                   name="search"
                                   value="{{ request('search') }}"
                                   placeholder="Search categories..." 
                                   class="pl-10 pr-4 py-2 theme-border-card border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 theme-bg-secondary theme-text-primary">
                        </form>
                        
                        <!-- Add Category Button -->
                        <a href="{{ route('categories.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                            <i class="fas fa-plus mr-2"></i>
                            Add Category
                        </a>
                    </div>
                </div>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y theme-border-card divide-y">
                    <thead class="theme-bg-secondary">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium theme-text-muted uppercase tracking-wider">
                                ID
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium theme-text-muted uppercase tracking-wider">
                                Image
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium theme-text-muted uppercase tracking-wider">
                                Category
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium theme-text-muted uppercase tracking-wider">
                                Slug
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium theme-text-muted uppercase tracking-wider">
                                Parent
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium theme-text-muted uppercase tracking-wider">
                                Status
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium theme-text-muted uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="theme-bg-card divide-y theme-border-card divide-y">
                        @forelse($categories as $category)
                        <tr class="hover:theme-bg-secondary transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm theme-text-primary">{{ $category->id }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($category->image)
                                    <img src="{{ asset('storage/' . $category->image) }}" 
                                         alt="{{ $category->name }}" class="w-10 h-10 rounded-lg object-cover">
                                @else
                                    <div class="w-10 h-10 theme-bg-secondary rounded-lg flex items-center justify-center theme-text-primary text-sm font-bold">
                                        <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium theme-text-primary">{{ $category->name }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm theme-text-primary">{{ $category->slug }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm theme-text-primary">
                                    @if($category->parent)
                                        {{ $category->parent->name }}
                                    @else
                                        <span class="text-gray-400">None</span>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ $category->status == 'active' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                    {{ ucfirst($category->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex items-center space-x-2">
                                    <a href="{{ route('categories.edit', $category->id) }}" class="text-blue-600 hover:text-blue-900">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure you want to delete this category?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="px-6 py-4 text-center theme-text-muted">
                                <div class="flex flex-col items-center justify-center py-6">
                                    <iconify-icon icon="heroicons:folder-open" class="w-12 h-12 text-gray-400 mb-3"></iconify-icon>
                                    <p>No categories found.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination (if needed) -->
            @if(method_exists($categories, 'links'))
            <div class="px-6 py-4 theme-border-card border-t theme-bg-secondary">
                <div class="flex items-center justify-between">
                    <div class="text-sm theme-text-secondary">
                        Showing {{ $categories->firstItem() ?? 0 }} to {{ $categories->lastItem() ?? 0 }} of {{ $categories->total() ?? 0 }} results
                    </div>
                    <div class="flex items-center space-x-2">
                        @if($categories->hasPages())
                            {{ $categories->links() }}
                        @endif
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</x-layouts.auth>