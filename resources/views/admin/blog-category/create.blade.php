<x-layouts.auth>
    <div class="space-y-6">
        <!-- Page Header -->
        <div>
            <h1 class="text-3xl font-bold theme-text-primary">Create Category</h1>
            <p class="theme-text-secondary mt-2">Add a new blog category to your website</p>
        </div>

        <!-- Main Container -->
        <div class="theme-bg-card rounded-lg theme-shadow-lg theme-border-card border">
            <div class="px-6 py-4 theme-border-card border-b">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                    <h2 class="text-xl font-semibold theme-text-primary">Category Details</h2>
                </div>
            </div>

            <div class="p-6">
                <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <!-- Name Field -->
                    <div class="mb-6">
                        <label for="name" class="block text-sm font-semibold theme-text-primary mb-2">Name *</label>
                        <input type="text" 
                               id="name" 
                               name="name" 
                               value="{{ old('name') }}" 
                               class="w-full pl-4 pr-4 py-3 theme-border-primary border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('name') border-red-300 focus:ring-red-500 @enderror transition-all duration-200 theme-bg-secondary theme-text-primary"
                               placeholder="Enter category name" required>
                        @error('name')
                            <p class="text-red-500 text-xs mt-2 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Parent Category Field -->
                    <div class="mb-6">
                        <label for="parent_id" class="block text-sm font-semibold theme-text-primary mb-2">Parent Category</label>
                        <select id="parent_id" 
                                name="parent_id" 
                                class="w-full pl-4 pr-4 py-3 theme-border-primary border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('parent_id') border-red-300 focus:ring-red-500 @enderror transition-all duration-200 theme-bg-secondary theme-text-primary">
                            <option value="">None (Top Level Category)</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('parent_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('parent_id')
                            <p class="text-red-500 text-xs mt-2 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Slug Field -->
                    <div class="mb-6">
                        <label for="slug" class="block text-sm font-semibold theme-text-primary mb-2">Slug *</label>
                        <input type="text" 
                               id="slug" 
                               name="slug" 
                               value="{{ old('slug') }}" 
                               class="w-full pl-4 pr-4 py-3 theme-border-primary border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('slug') border-red-300 focus:ring-red-500 @enderror transition-all duration-200 theme-bg-secondary theme-text-primary"
                               placeholder="enter-category-slug" required>
                        @error('slug')
                            <p class="text-red-500 text-xs mt-2 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Status Field -->
                    <div class="mb-6">
                        <label for="status" class="block text-sm font-semibold theme-text-primary mb-2">Status</label>
                        <select id="status" 
                                name="status" 
                                class="w-full pl-4 pr-4 py-3 theme-border-primary border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('status') border-red-300 focus:ring-red-500 @enderror transition-all duration-200 theme-bg-secondary theme-text-primary">
                            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                        @error('status')
                            <p class="text-red-500 text-xs mt-2 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Short Content Field -->
                    <div class="mb-6">
                        <label for="short_content" class="block text-sm font-semibold theme-text-primary mb-2">Short Description</label>
                        <textarea id="short_content" 
                                  name="short_content" 
                                  class="w-full pl-4 pr-4 py-3 theme-border-primary border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('short_content') border-red-300 focus:ring-red-500 @enderror transition-all duration-200 theme-bg-secondary theme-text-primary"
                                  placeholder="Brief description of the category" 
                                  rows="3">{{ old('short_content') }}</textarea>
                        @error('short_content')
                            <p class="text-red-500 text-xs mt-2 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Image Field -->
                    <div class="mb-8">
                        <label for="image" class="block text-sm font-semibold theme-text-primary mb-2">Category Image</label>
                        <div class="mt-1 flex items-center">
                            <div class="w-full">
                                <label class="flex flex-col items-center px-4 py-6 theme-bg-secondary theme-border-primary border border-dashed rounded-lg cursor-pointer hover:bg-gray-50 transition-all duration-200">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                        <svg class="w-12 h-12 theme-text-muted mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        <p class="mb-2 text-sm theme-text-primary"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                                        <p class="text-xs theme-text-muted">PNG, JPG or JPEG (MAX. 2MB)</p>
                                    </div>
                                    <input id="image" name="image" type="file" class="hidden" accept="image/*" />
                                </label>
                            </div>
                        </div>
                        @error('image')
                            <p class="text-red-500 text-xs mt-2 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="flex items-center justify-end space-x-4 mt-6">
                        <a href="{{ route('categories.index') }}" class="px-6 py-3 border theme-border-primary theme-text-primary font-semibold rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-all duration-200">
                            Cancel
                        </a>
                        <button type="submit" class="px-6 py-3 text-white hover:opacity-80 border border-blue-400 bg-blue-600 font-semibold rounded-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200 shadow-sm">
                            <i class="fa-solid fa-save mr-2"></i>
                            Create Category
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.auth>