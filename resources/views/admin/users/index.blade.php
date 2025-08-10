<x-layouts.auth>
    <div class="space-y-6">
        <!-- Page Header -->
        <div>
            <h1 class="text-3xl font-bold theme-text-primary">Users Management</h1>
            <p class="theme-text-secondary mt-2">Manage your application users and their permissions</p>
        </div>

        <!-- Main Container -->
        <div class="theme-bg-card rounded-lg theme-shadow-lg theme-border-card border">
            <!-- Header Section -->
            <div class="px-6 py-4 theme-border-card border-b">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                    <h2 class="text-xl font-semibold theme-text-primary">All Users</h2>
                    <div class="mt-4 sm:mt-0 flex items-center space-x-4">
                        <!-- Search Input -->
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 theme-text-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                            <input type="text" 
                                   placeholder="Search users..." 
                                   class="pl-10 pr-4 py-2 theme-border-card border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 theme-bg-secondary theme-text-primary">
                        </div>
                        
                        <!-- Add User Button -->
                        <button class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                            <i class="fas fa-plus mr-2"></i>
                            Add User
                        </button>
                    </div>
                </div>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y theme-border-card divide-y">
                    <thead class="theme-bg-secondary">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium theme-text-muted uppercase tracking-wider">
                                User
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium theme-text-muted uppercase tracking-wider">
                                Email
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium theme-text-muted uppercase tracking-wider">
                                Role
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
                        @forelse($users as $user)
                        <tr class="hover:theme-bg-secondary transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    @if($user->profile_image)
                                        <img src="{{ asset('storage/' . $user->profile_image) }}" 
                                             alt="Profile" class="w-10 h-10 rounded-full object-cover">
                                    @else
                                        <div class="w-10 h-10 theme-bg-secondary rounded-full flex items-center justify-center theme-text-primary text-sm font-bold">
                                            {{ $user->getInitials() }}
                                        </div>
                                    @endif
                                    <div class="ml-4">
                                        <div class="text-sm font-medium theme-text-primary">{{ $user->name }}</div>
                                        <div class="text-sm theme-text-muted">ID: {{ $user->id }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm theme-text-primary">{{ $user->email }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                    {{ $user->role ?? 'User' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ $user->email_verified_at ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                    {{ $user->email_verified_at ? 'Verified' : 'Pending' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex items-center space-x-2">
                                    <button class="text-blue-600 hover:text-blue-900">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="text-red-600 hover:text-red-900">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center theme-text-muted">
                                No users found.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="px-6 py-4 theme-border-card border-t theme-bg-secondary">
                <div class="flex items-center justify-between">
                    <div class="text-sm theme-text-secondary">
                        Showing {{ $users->firstItem() ?? 0 }} to {{ $users->lastItem() ?? 0 }} of {{ $users->total() ?? 0 }} results
                    </div>
                    <div class="flex items-center space-x-2">
                        @if($users->hasPages())
                            {{ $users->links() }}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.auth>