<x-layouts.auth>
    <style>
        .glass-effect {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .input-focus {
            transition: all 0.3s ease;
        }

        .input-focus:focus {
            transform: translateY(-1px);
            box-shadow: 0 8px 25px rgba(99, 102, 241, 0.15);
        }

        .tag-input {
            position: relative;
        }

        .tag-container {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            margin-bottom: 0.5rem;
        }

        .tag-item {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.875rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            animation: tagSlideIn 0.3s ease-out;
        }

        @keyframes tagSlideIn {
            from {
                opacity: 0;
                transform: translateX(-10px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .tag-remove {
            cursor: pointer;
            width: 16px;
            height: 16px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.2s;
        }

        .tag-remove:hover {
            background: rgba(255, 255, 255, 0.3);
        }

        .image-preview {
            display: none;
            max-width: 200px;
            max-height: 150px;
            border-radius: 8px;
            margin-top: 0.5rem;
        }
    </style>

    <div class="space-y-6">
        <!-- Page Header -->
        <div>
            <h1 class="text-3xl font-bold theme-text-primary">Create Blog Post</h1>
            <p class="theme-text-secondary mt-2">Share your thoughts with the world</p>
        </div>

        <!-- Main Container -->
        <div class="theme-bg-card rounded-lg theme-shadow-lg theme-border-card border">
            <div class="px-6 py-4 theme-border-card border-b">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                    <h2 class="text-xl font-semibold theme-text-primary">Post Details</h2>
                </div>
            </div>

            <div class="p-6">
                <form action="{{ route('blogs.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <!-- Row 1: Title and Author -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                        <!-- Title Field -->
                        <div>
                            <label for="title" class="block text-sm font-semibold theme-text-primary mb-2">
                                <i class="fas fa-heading mr-1"></i>Title *
                            </label>
                            <input type="text" 
                                   id="title" 
                                   name="title" 
                                   value="{{ old('title') }}" 
                                   class="input-focus w-full pl-4 pr-4 py-3 theme-border-primary @error('title') border border-red-300 @enderror border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('title') border-red-300 focus:ring-red-500 @enderror transition-all duration-200 theme-bg-secondary theme-text-primary"
                                   placeholder="Enter blog post title"
                                   onkeyup="generateSlug()">
                            @error('title')
                                <p class="text-red-500 text-xs mt-2 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Author Field -->
                        <div>
                            <label for="author" class="block text-sm font-semibold theme-text-primary mb-2">
                                <i class="fas fa-user-edit mr-1"></i>Author *
                            </label>
                            <input type="text" 
                                   id="author" 
                                   name="author" 
                                   value="{{ old('author', auth()->user()->name ?? '') }}" 
                                   class="input-focus w-full pl-4 pr-4 py-3 theme-border-primary @error('author') border border-red-300 @enderror border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('author') border-red-300 focus:ring-red-500 @enderror transition-all duration-200 theme-bg-secondary theme-text-primary"
                                   placeholder="Enter author name">
                            @error('author')
                                <p class="text-red-500 text-xs mt-2 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    <!-- Row 2: Slug and Category -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                        <!-- Slug Field -->
                        <div>
                            <label for="slug" class="block text-sm font-semibold theme-text-primary mb-2">
                                <i class="fas fa-link mr-1"></i>Slug *
                            </label>
                            <input type="text" 
                                   id="slug" 
                                   name="slug" 
                                   value="{{ old('slug') }}" 
                                   class="input-focus w-full pl-4 pr-4 py-3 theme-border-primary @error('slug') border border-red-300 @enderror border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('slug') border-red-300 focus:ring-red-500 @enderror transition-all duration-200 theme-bg-secondary theme-text-primary"
                                   placeholder="auto-generated-from-title">
                            @error('slug')
                                <p class="text-red-500 text-xs mt-2 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Category Field -->
                        <div>
                            <label for="category_id" class="block text-sm font-semibold theme-text-primary mb-2">
                                <i class="fas fa-folder mr-1"></i>Category *
                            </label>
                            <select id="category_id" 
                                    name="category_id" 
                                    class="input-focus w-full pl-4 pr-4 py-3 theme-border-primary border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('category_id') border-red-300 focus:ring-red-500 @enderror transition-all duration-200 theme-bg-secondary theme-text-primary">
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <p class="text-red-500 text-xs mt-2 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    <!-- Row 3: Status and Tags -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                        <!-- Status Field -->
                        <div>
                            <label for="status" class="block text-sm font-semibold theme-text-primary mb-2">
                                <i class="fas fa-toggle-on mr-1"></i>Status
                            </label>
                            <select id="status" 
                                    name="status" 
                                    class="input-focus w-full pl-4 pr-4 py-3 theme-border-primary border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('status') border-red-300 focus:ring-red-500 @enderror transition-all duration-200 theme-bg-secondary theme-text-primary">
                                <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                                <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published</option>
                                <option value="scheduled" {{ old('status') == 'scheduled' ? 'selected' : '' }}>Scheduled</option>
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

                        <!-- Tags Field -->
                        <div>
                            <label for="tags" class="block text-sm font-semibold theme-text-primary mb-2">
                                <i class="fas fa-tags mr-1"></i>Tags
                            </label>
                            <div class="tag-input">
                                <div id="tag-container" class="tag-container"></div>
                                <input type="text" 
                                       id="tag-input" 
                                       class="input-focus w-full pl-4 pr-4 py-3 theme-border-primary border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 theme-bg-secondary theme-text-primary"
                                       placeholder="Type tags and press Enter or comma">
                                <input type="hidden" id="tags" name="tags" value="{{ old('tags') }}">
                            </div>
                            @error('tags')
                                <p class="text-red-500 text-xs mt-2 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    <!-- Short Content Field -->
                    <div class="mb-6">
                        <label for="short_content" class="block text-sm font-semibold theme-text-primary mb-2">
                            <i class="fas fa-align-left mr-1"></i>Short Description
                        </label>
                        <textarea id="short_content" 
                                  name="short_content" 
                                  class="input-focus w-full pl-4 pr-4 py-3 theme-border-primary border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('short_content') border-red-300 focus:ring-red-500 @enderror transition-all duration-200 theme-bg-secondary theme-text-primary"
                                  placeholder="Brief description of your blog post for previews" 
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

                    <!-- Content Field with Rich Text Editor -->
                    <div class="mb-6">
                        <label for="content" class="block text-sm font-semibold theme-text-primary mb-2">
                            <i class="fas fa-edit mr-1"></i>Content *
                        </label>
                        <textarea id="content" 
                                  name="content" 
                                  class="w-full"
                                  placeholder="Write your blog post content here...">{{ old('content') }}</textarea>
                        @error('content')
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
                        <label for="image" class="block text-sm font-semibold theme-text-primary mb-2">
                            <i class="fas fa-image mr-1"></i>Featured Image
                        </label>
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
                                    <input id="image" name="image" type="file" class="hidden" accept="image/*" onchange="previewImage(event)" />
                                </label>
                                <img id="image-preview" class="image-preview" alt="Image preview">
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
                        <a href="{{ route('blogs.index') }}" class="px-6 py-3 border theme-border-primary theme-text-primary font-semibold rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-all duration-200">
                            <i class="fas fa-times mr-2"></i>Cancel
                        </a>
                        <button type="submit" class="px-6 py-3 text-white hover:opacity-80 border border-blue-400 bg-blue-600 font-semibold rounded-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200 shadow-sm">
                            <i class="fa-solid fa-save mr-2"></i>
                            Create Post
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.8.2/tinymce.min.js"></script>
    <script>
        // Initialize TinyMCE Rich Text Editor
        tinymce.init({
            selector: '#content',
            height: 400,
            menubar: false,
            plugins: [
                'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
                'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
                'insertdatetime', 'media', 'table', 'help', 'wordcount'
            ],
            toolbar: 'undo redo | blocks | ' +
                'bold italic forecolor | alignleft aligncenter ' +
                'alignright alignjustify | bullist numlist outdent indent | ' +
                'removeformat | image link | code | help',
            content_style: 'body { font-family: -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif; font-size: 14px; }',
            setup: function (editor) {
                editor.on('change', function () {
                    editor.save();
                });
            }
        });

        // Tag functionality
        let tags = [];
        const tagInput = document.getElementById('tag-input');
        const tagContainer = document.getElementById('tag-container');
        const tagsHidden = document.getElementById('tags');

        // Load existing tags if any
        if (tagsHidden.value) {
            tags = tagsHidden.value.split(',').filter(tag => tag.trim() !== '');
            displayTags();
        }

        tagInput.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' || e.key === ',') {
                e.preventDefault();
                addTag();
            }
        });

        tagInput.addEventListener('blur', function() {
            addTag();
        });

        function addTag() {
            const tagValue = tagInput.value.trim();
            if (tagValue && !tags.includes(tagValue)) {
                tags.push(tagValue);
                displayTags();
                updateTagsInput();
                tagInput.value = '';
            }
        }

        function removeTag(tagToRemove) {
            tags = tags.filter(tag => tag !== tagToRemove);
            displayTags();
            updateTagsInput();
        }

        function displayTags() {
            tagContainer.innerHTML = '';
            tags.forEach(tag => {
                const tagElement = document.createElement('div');
                tagElement.className = 'tag-item';
                tagElement.innerHTML = `
                    <span>${tag}</span>
                    <span class="tag-remove" onclick="removeTag('${tag}')">
                        <i class="fas fa-times" style="font-size: 10px;"></i>
                    </span>
                `;
                tagContainer.appendChild(tagElement);
            });
        }

        function updateTagsInput() {
            tagsHidden.value = tags.join(',');
        }

        // Slug generation
        function generateSlug() {
            const title = document.getElementById('title').value;
            const slug = title
                .toLowerCase()
                .replace(/[^a-z0-9 -]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-')
                .trim('-');
            document.getElementById('slug').value = slug;
        }

        // Image preview
        function previewImage(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('image-preview');
            
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            } else {
                preview.style.display = 'none';
            }
        }
    </script>
</x-layouts.auth>