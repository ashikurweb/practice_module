@props(['breadcrumbs' => []])

<nav class="flex items-center space-x-2 text-sm font-medium text-slate-500 mb-4">
    {{-- Home Icon --}}
    <a href="{{ route('admin.index') }}" class="flex items-center hover:text-blue-600 transition-colors">
        <iconify-icon icon="heroicons:home" class="w-4 h-4"></iconify-icon>
    </a>

    @foreach($breadcrumbs as $breadcrumb)
        <span class="text-slate-400">
            <iconify-icon icon="heroicons:chevron-right" class="w-4 h-4"></iconify-icon>
        </span>
        
        @if($loop->last)
            <span class="text-slate-800">{{ $breadcrumb['label'] }}</span>
        @else
            <a href="{{ $breadcrumb['url'] }}" class="hover:text-blue-600 transition-colors">
                {{ $breadcrumb['label'] }}
            </a>
        @endif
    @endforeach
</nav>