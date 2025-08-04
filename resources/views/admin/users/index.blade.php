<x-layouts.admin>
<div class="p-6">
    <div class="mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">All Users</h1>
                <p class="text-gray-600 mt-2">Manage and view all registered users</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-semibold text-gray-800">Users List</h2>
                <div class="flex items-center space-x-4">
                    <form method="GET" action="{{ route('admin.users') }}" class="flex items-center">
                        <div class="relative">
                            <input type="text" 
                                   name="search" 
                                   value="{{ request('search') }}"
                                   placeholder="Search users..." 
                                   class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <iconify-icon icon="mdi:magnify" class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></iconify-icon>
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
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            #ID
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Image
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Name
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Email
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Joined
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($users as $user)
                    <tr class="hover:bg-gray-50 transition-colors duration-200">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $users->firstItem() + $loop->index }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($user->profile_image)
                                <img class="h-10 w-10 border border-indigo-400 rounded-full object-cover" 
                                     src="{{ asset('storage/' . $user->profile_image) }}" 
                                     alt="{{ $user->name }}">
                            @else
                                <div class="h-10 w-10 rounded-full border border-indigo-300 text-slate-800 flex items-center justify-center font-semibold text-sm">
                                    {{ $user->getInitials() }}
                                </div>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ $user->name }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $user->email }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $user->created_at->format('M d, Y') }}</div>
                            <div class="text-sm text-gray-500">{{ $user->created_at->format('g:i A') }}</div>
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
                            <div class="text-gray-500">
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
        <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
            <div class="flex items-center justify-between">
                <div class="text-sm text-gray-700">
                    Showing <span class="font-medium">{{ $users->count() }}</span> users
                </div>
                <div class="text-sm text-gray-700">
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