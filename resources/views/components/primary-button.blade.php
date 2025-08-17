<button type="submit" id="{{ $id ?? 'submitBtn' }}"
    class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl text-sm font-medium text-white {{ $bgColor ?? 'bg-violet-600' }} hover:bg-violet-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition-all duration-200 shadow-lg {{ $customClass ?? '' }}">
    <span id="btnContent" class="flex items-center">
        {{ $slot }}  <!-- This renders the icon and text -->
    </span>
    <span id="btnLoading" class="hidden flex items-center">
        <div class="spinner mr-2"></div>
        Processing...
    </span>
</button>