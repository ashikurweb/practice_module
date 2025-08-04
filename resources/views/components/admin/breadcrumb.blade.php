@props(['breadcrumbs' => []])

<nav class="flex items-center mt-3 mb-5 space-x-1 text-sm">
    {{-- Home Icon --}}
    <a href="{{ route('admin.index') }}"
       class="flex items-center gap-1 px-2 py-1 rounded-lg text-slate-600 hover:text-indigo-600 hover:bg-indigo-50 transition-colors">
        <iconify-icon icon="heroicons:home" class="w-4 h-4"></iconify-icon>
    </a>

    @foreach($breadcrumbs as $breadcrumb)
        {{-- Separator --}}
        <iconify-icon icon="heroicons:chevron-right" class="w-4 h-4 text-slate-400"></iconify-icon>

        @if($loop->last)
            <span class="px-2 py-1 rounded-lg bg-indigo-50 text-indigo-700 font-medium">
                {{ $breadcrumb['label'] }}
            </span>
        @else
            <a href="{{ $breadcrumb['url'] }}"
               class="px-2 py-1 rounded-lg text-slate-600 hover:text-indigo-600 hover:bg-indigo-50 transition-colors">
                {{ $breadcrumb['label'] }}
            </a>
        @endif
    @endforeach
</nav>
