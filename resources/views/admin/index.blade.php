<x-layouts.admin>
    <div class="space-y-8">
        <!-- Page Header -->
        <div>
            <h1 class="text-3xl font-bold theme-text-primary">Dashboard</h1>
            <p class="theme-text-secondary mt-2">Welcome back! Here's what's happening with your business today.</p>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Total Users -->
            <div class="theme-bg-card rounded-2xl theme-shadow theme-border-card border p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium theme-text-secondary">Total Users</p>
                        <p class="text-3xl font-bold theme-text-primary">12,543</p>
                        <p class="text-sm theme-text-secondary mt-1">
                            <span class="text-green-500">+12%</span> from last month
                        </p>
                    </div>
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Revenue -->
            <div class="theme-bg-card rounded-2xl theme-shadow theme-border-card border p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium theme-text-secondary">Revenue</p>
                        <p class="text-3xl font-bold theme-text-primary">$45,231</p>
                        <p class="text-sm theme-text-secondary mt-1">
                            <span class="text-green-500">+20%</span> from last month
                        </p>
                    </div>
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Orders -->
            <div class="theme-bg-card rounded-2xl theme-shadow theme-border-card border p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium theme-text-secondary">Orders</p>
                        <p class="text-3xl font-bold theme-text-primary">1,234</p>
                        <p class="text-sm theme-text-secondary mt-1">
                            <span class="text-green-500">+8%</span> from last month
                        </p>
                    </div>
                    <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Conversion -->
            <div class="theme-bg-card rounded-2xl theme-shadow theme-border-card border p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium theme-text-secondary">Conversion</p>
                        <p class="text-3xl font-bold theme-text-primary">2.4%</p>
                        <p class="text-sm theme-text-secondary mt-1">
                            <span class="text-red-500">-1%</span> from last month
                        </p>
                    </div>
                    <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Sales Overview -->
            <div class="theme-bg-card rounded-2xl theme-shadow theme-border-card border p-6">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-xl font-semibold theme-text-primary">Sales Overview</h3>
                    <div class="flex space-x-2">
                        <button class="px-3 py-1 text-sm bg-blue-100 text-blue-600 rounded-lg">7D</button>
                        <button class="px-3 py-1 text-sm theme-text-secondary hover:theme-bg-secondary rounded-lg">30D</button>
                        <button class="px-3 py-1 text-sm theme-text-secondary hover:theme-bg-secondary rounded-lg">90D</button>
                    </div>
                </div>
                <div class="h-64 theme-bg-secondary rounded-lg flex items-center justify-center">
                    <div class="text-center">
                        <svg class="w-16 h-16 theme-text-muted mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                        <p class="theme-text-muted">Chart placeholder</p>
                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="theme-bg-card rounded-2xl theme-shadow theme-border-card border p-6">
                <h3 class="text-xl font-semibold theme-text-primary mb-6">Recent Activity</h3>
                <div class="space-y-4">
                    <div class="flex items-center space-x-4 p-4 theme-bg-secondary rounded-lg">
                        <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-medium theme-text-primary">New user registered</p>
                            <p class="text-xs theme-text-muted">2 minutes ago</p>
                        </div>
                    </div>

                    <div class="flex items-center space-x-4 p-4 theme-bg-secondary rounded-lg">
                        <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-medium theme-text-primary">Payment received</p>
                            <p class="text-xs theme-text-muted">5 minutes ago</p>
                        </div>
                    </div>

                    <div class="flex items-center space-x-4 p-4 theme-bg-secondary rounded-lg">
                        <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-medium theme-text-primary">New order placed</p>
                            <p class="text-xs theme-text-muted">10 minutes ago</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.admin>