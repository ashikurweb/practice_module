<x-layouts.auth>
    {{-- Toggle Switch CSS --}}
    <style>
        .toggle-switch {
            position: relative;
            display: inline-block;
            width: 40px;
            height: 20px;
            flex-shrink: 0;
        }

        .toggle-input {
            opacity: 0;
            width: 0;
            height: 0;
            position: absolute;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #cbd5e1;
            transition: all 0.25s ease;
            border-radius: 10px;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 16px;
            width: 16px;
            left: 2px;
            bottom: 2px;
            background-color: white;
            border-radius: 50%;
            transition: all 0.25s ease;
            box-shadow: 0 1px 3px rgba(0,0,0,0.3);
        }

        .toggle-input:checked + .slider {
            background-color: #10b981;
        }

        .toggle-input:checked + .slider:before {
            transform: translateX(20px);
        }

        .slider:hover {
            box-shadow: 0 0 0 2px rgba(16, 185, 129, 0.2);
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 500;
            text-transform: capitalize;
        }

        .status-draft {
            background-color: #fef3c7;
            color: #92400e;
        }

        .status-published {
            background-color: #d1fae5;
            color: #065f46;
        }

        .status-scheduled {
            background-color: #dbeafe;
            color: #1e40af;
        }

        .blog-title {
            max-width: 250px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .blog-excerpt {
            max-width: 200px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
    </style>

    {{-- Breadcumb --}}
    <x-breadcrumb :breadcrumbs="[
        ['label' => 'Content', 'url' => route('admin.dashboard')],
        ['label' => 'Blog Posts']
    ]" />
    
    <div class="space-y-6">
        <!-- Main Container -->
        <div class="theme-bg-card rounded-lg theme-shadow-lg theme-border-card border">
            <!-- Header Section -->
            <div class="px-6 py-4 theme-border-card border-b">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                    <h2 class="text-xl font-semibold theme-text-primary">All Blog Posts</h2>
                    <div class="mt-4 sm:mt-0 flex items-center space-x-4">
                        <!-- Search Input -->
                        <form action="{{ route('blogs.index') }}" method="GET" class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 theme-text-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                            <input type="text" 
                                   name="search"
                                   value="{{ request('search') }}"
                                   placeholder="Search posts..." 
                                   class="pl-10 pr-4 py-2 theme-border-card border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 theme-bg-secondary theme-text-primary">
                        </form>

                        <!-- Filter Dropdown -->
                        <form action="{{ route('blogs.index') }}" method="GET" class="relative">
                            <input type="hidden" name="search" value="{{ request('search') }}">
                            <select name="status" 
                                    onchange="this.form.submit()"
                                    class="px-3 py-2 theme-border-card border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent theme-bg-secondary theme-text-primary">
                                <option value="">All Status</option>
                                <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                                <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Published</option>
                                <option value="scheduled" {{ request('status') == 'scheduled' ? 'selected' : '' }}>Scheduled</option>
                            </select>
                        </form>
                        
                        <!-- Add Blog Post Button -->
                        <a href="{{ route('blogs.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                            <i class="fas fa-plus mr-2"></i>
                            Add Post
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
                                Title
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium theme-text-muted uppercase tracking-wider">
                                Author
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium theme-text-muted uppercase tracking-wider">
                                Category
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium theme-text-muted uppercase tracking-wider">
                                Status
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium theme-text-muted uppercase tracking-wider">
                                Created
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium theme-text-muted uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="theme-bg-card divide-y theme-border-card divide-y">
                        @forelse($blogs as $blog)
                        <tr class="hover:theme-bg-secondary transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm theme-text-primary font-medium">{{ $blog->id }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($blog->image)
                                    <img src="{{ asset('storage/' . $blog->image) }}" 
                                         alt="{{ $blog->title }}" class="w-12 h-12 rounded-lg object-cover shadow-sm">
                                @else
                                    <div class="w-12 h-12 theme-bg-secondary rounded-lg flex items-center justify-center theme-text-primary text-sm font-bold">
                                        <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="blog-title">
                                    <div class="text-sm font-medium theme-text-primary" title="{{ $blog->title }}">
                                        {{ $blog->title }}
                                    </div>
                                    @if($blog->short_content)
                                        <div class="blog-excerpt text-xs theme-text-muted mt-1" title="{{ $blog->short_content }}">
                                            {{ $blog->short_content }}
                                        </div>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm theme-text-primary">{{ $blog->author }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm theme-text-primary">
                                    <span class="inline-flex items-center px-2 py-1 rounded-md text-xs bg-gray-100 text-gray-800">
                                        <i class="fas fa-folder mr-1"></i>
                                        {{ $blog->category->name ?? 'Uncategorized' }}
                                    </span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center justify-start gap-3">
                                    {{-- Toggle Switch Form for Status --}}
                                    <div class="flex-shrink-0">
                                        <form action="{{ route('blogs.toggle-status', $blog->slug) }}" method="POST" class="inline-flex">
                                            @csrf
                                            <label class="toggle-switch cursor-pointer" title="Click to toggle published/draft">
                                                <input type="checkbox" 
                                                       class="toggle-input"
                                                       {{ $blog->status == 'published' ? 'checked' : '' }}
                                                       onchange="this.form.submit()">
                                                <span class="slider"></span>
                                            </label>
                                        </form>
                                    </div>
                                    {{-- Status Badge --}}
                                    <div class="flex-shrink-0">
                                        <span class="status-badge status-{{ $blog->status }}">
                                            <i class="fas {{ $blog->status == 'published' ? 'fa-check-circle' : ($blog->status == 'scheduled' ? 'fa-clock' : 'fa-edit') }} mr-1"></i>
                                            {{ $blog->status }}
                                        </span>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm theme-text-primary">
                                    {{ $blog->created_at->format('M d, Y') }}
                                </div>
                                <div class="text-xs theme-text-muted">
                                    {{ $blog->created_at->format('h:i A') }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center space-x-2">
                                    {{-- View Post --}}
                                    <a href="{{ route('blogs.show', $blog->slug) }}" 
                                       class="px-2 py-1 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors" 
                                       title="View Post">
                                        <i class="fas fa-eye text-sm"></i>
                                    </a>
                                    {{-- Edit Post --}}
                                    <a href="{{ route('blogs.edit', $blog->slug) }}" 
                                       class="px-2 py-1 bg-blue-100 text-blue-600 rounded-lg hover:bg-blue-200 transition-colors" 
                                       title="Edit Post">
                                        <i class="fas fa-edit text-sm"></i>
                                    </a>
                                    {{-- Duplicate Post --}}
                                    <form action="{{ route('blogs.duplicate', $blog->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        <button type="submit" 
                                                class="px-2 py-1 bg-green-100 text-green-600 rounded-lg hover:bg-green-200 transition-colors" 
                                                title="Duplicate Post">
                                            <i class="fas fa-copy text-sm"></i>
                                        </button>
                                    </form>
                                    {{-- Delete Post --}}
                                    <form action="{{ route('blogs.destroy', $blog->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="px-2 py-1 bg-red-100 text-red-600 rounded-lg hover:bg-red-200 transition-colors" 
                                                title="Delete Post"
                                                onclick="return confirm('Are you sure you want to delete this blog post?')">
                                            <i class="fas fa-trash text-sm"></i>
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

            <!-- Pagination -->
            @if(method_exists($blogs, 'links'))
            <div class="px-6 py-4 theme-border-card border-t theme-bg-secondary">
                <div class="flex items-center justify-between">
                    <div class="text-sm theme-text-secondary">
                        Showing {{ $blogs->firstItem() ?? 0 }} to {{ $blogs->lastItem() ?? 0 }} of {{ $blogs->total() ?? 0 }} results
                    </div>
                    <div class="flex items-center space-x-2">
                        @if($blogs->hasPages())
                            {{ $blogs->appends(request()->query())->links() }}
                        @endif
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>

    {{-- Bulk Actions Modal (Optional) --}}
    <div id="bulkActionsModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md theme-bg-card">
            <div class="mt-3 text-center">
                <h3 class="text-lg font-medium theme-text-primary">Bulk Actions</h3>
                <div class="mt-2 px-7 py-3">
                    <p class="text-sm theme-text-muted">
                        Select an action to perform on selected posts.
                    </p>
                </div>
                <div class="items-center px-4 py-3 space-y-2">
                    <button class="px-4 py-2 bg-green-500 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-green-600">
                        Publish Selected
                    </button>
                    <button class="px-4 py-2 bg-yellow-500 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-yellow-600">
                        Draft Selected
                    </button>
                    <button class="px-4 py-2 bg-red-500 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-red-600">
                        Delete Selected
                    </button>
                    <button onclick="closeBulkModal()" class="px-4 py-2 bg-gray-500 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-gray-600">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Bulk actions functionality (optional)
        function openBulkModal() {
            document.getElementById('bulkActionsModal').classList.remove('hidden');
        }

        function closeBulkModal() {
            document.getElementById('bulkActionsModal').classList.add('hidden');
        }

        // Auto-submit search form on typing (with debounce)
        let searchTimeout;
        const searchInput = document.querySelector('input[name="search"]');
        if (searchInput) {
            searchInput.addEventListener('input', function() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(() => {
                    this.form.submit();
                }, 500);
            });
        }
    </script>
</x-layouts.auth>