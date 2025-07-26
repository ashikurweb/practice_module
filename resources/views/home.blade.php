<x-layouts.app>
    <h1>Home</h1>
    <p>{{ auth()->user()->name ?? 'Guest' }}</p>
</x-layouts.app>