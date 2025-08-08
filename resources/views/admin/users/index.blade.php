<x-layouts.admin>
<div class="p-6">
    <div class="mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold theme-text-primary">All Users</h1>
                <p class="theme-text-secondary mt-2">Manage and view all registered users</p>
            </div>
        </div>
    </div>

    <div class="theme-bg-primary rounded-lg theme-shadow-lg overflow-hidden theme-border-primary border">
        <div class="px-6 py-4 theme-border-primary border-b">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-semibold theme-text-primary">Users List</h2>
                <div class="flex items-center space-x-4">
                    <form method="GET" action="{{ route('admin.users') }}" class="flex items-center">
                        <div class="relative">
                            <input type="text" 
                                   name="search" 
                                   value="{{ request('search') }}"
                                   placeholder="Search users..." 
                                   class="pl-10 pr-4 py-2 theme-border-primary border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 theme-bg-secondary theme-text-primary">
                            <iconify-icon icon="mdi:magnify" class="absolute left-3 top-1/2 transform -translate-y-1/2 theme-text-muted"></iconify-icon>
                        </div>
                        <button type="submit" class="ml-2 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-colors duration-200">
                            Search
                        </button>
                        @if(request('search'))
                            <a href="{{ route('admin.users') }}" class="ml-2 bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg transition-colors duration-200">
                                Clear
                            </a>
                        @endif
                    </form>
                </div>
            </div>
        </div>
        
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y theme-border-primary divide-y">
                <thead class="theme-bg-secondary">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium theme-text-muted uppercase tracking-wider">
                            #ID
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium theme-text-muted uppercase tracking-wider">
                            Image
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium theme-text-muted uppercase tracking-wider">
                            Name
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium theme-text-muted uppercase tracking-wider">
                            Email
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium theme-text-muted uppercase tracking-wider">
                            Joined
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium theme-text-muted uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="theme-bg-primary divide-y theme-border-primary divide-y">
                    @forelse($users as $user)
                    <tr class="hover:theme-bg-secondary transition-colors duration-200">
                        <td class="px-6 py-4 whitespace-nowrap text-sm theme-text-muted">
                            {{ $users->firstItem() + $loop->index }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($user->profile_image)
                                <img class="h-10 w-10 border border-indigo-400 rounded-full object-cover" 
                                     src="{{ asset('storage/' . $user->profile_image) }}" 
                                     alt="{{ $user->name }}">
                            @else
                                <div class="h-10 w-10 rounded-full border border-indigo-300 theme-text-primary flex items-center justify-center font-semibold text-sm">
                                    {{ $user->getInitials() }}
                                </div>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium theme-text-primary">
                            {{ $user->name }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm theme-text-primary">
                            {{ $user->email }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm theme-text-primary">{{ $user->created_at->format('M d, Y') }}</div>
                            <div class="text-sm theme-text-muted">{{ $user->created_at->format('g:i A') }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex space-x-2">
                                <button class="text-indigo-600 hover:text-indigo-900 transition-colors duration-200">
                                    <iconify-icon icon="mdi:eye" class="text-lg"></iconify-icon>
                                </button>
                                <button class="text-yellow-600 hover:text-yellow-900 transition-colors duration-200">
                                    <iconify-icon icon="mdi:pencil" class="text-lg"></iconify-icon>
                                </button>
                                <button class="text-red-600 hover:text-red-900 transition-colors duration-200">
                                    <iconify-icon icon="mdi:delete" class="text-lg"></iconify-icon>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center">
                            <div class="theme-text-muted">
                                <iconify-icon icon="mdi:account-group" class="text-4xl mx-auto mb-4"></iconify-icon>
                                <p class="text-lg font-medium">No users found</p>
                                <p class="text-sm">There are no registered users yet.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($users->count() > 0)
        <div class="px-6 py-4 theme-border-primary border-t theme-bg-secondary">
            <div class="flex items-center justify-between">
                <div class="text-sm theme-text-secondary">
                    Showing <span class="font-medium">{{ $users->count() }}</span> users
                </div>
                <div class="text-sm theme-text-secondary">
                    Total: <span class="font-medium">{{ $users->count() }}</span> users
                </div>
            </div>
        </div>
        @endif
    </div>

    <div class="mt-4 px-6">
        {{ $users->links() }}
    </div>
</div>
</x-layouts.admin>