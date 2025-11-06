<header class="flex-shrink-0 border-b bg-white shadow-sm">
    <div class="flex items-center justify-between px-6 py-3">
        <!-- Left side -->
        <div class="flex items-center">
            <button @click="sidebarOpen = true" class="p-2 rounded-lg text-gray-600 hover:bg-gray-100 sm:hidden">
                <i class="fas fa-bars text-lg"></i>
            </button>
            
            <div class="ml-4 sm:ml-0">
                <h1 class="text-xl font-semibold text-gray-800">@yield('title', 'Dashboard')</h1>
            </div>
        </div>

        <!-- Right side -->
        <div class="flex items-center space-x-4">
            <!-- Notifications -->
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open" class="p-2 text-gray-600 hover:bg-gray-100 rounded-lg transition-colors duration-200">
                    <i class="fas fa-bell"></i>
                </button>
                
                <div x-show="open" @click.away="open = false" 
                     class="absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-xl border z-50"
                     style="display: none;">
                    <div class="p-4 border-b">
                        <h3 class="font-semibold text-gray-800">Notifikasi</h3>
                    </div>
                    <div class="max-h-60 overflow-y-auto">
                        <!-- Notification items -->
                        <div class="p-4 border-b hover:bg-gray-50 cursor-pointer">
                            <p class="text-sm text-gray-600">Tidak ada notifikasi baru</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- User Menu -->
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open" class="flex items-center space-x-3 p-2 rounded-lg hover:bg-gray-100 transition-colors duration-200">
                    <div class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center">
                        <i class="fas fa-user text-white text-sm"></i>
                    </div>
                    <span class="hidden sm:block text-gray-700 font-medium">{{ auth()->user()->name }}</span>
                    <i class="fas fa-chevron-down text-gray-500 text-xs"></i>
                </button>

                <div x-show="open" @click.away="open = false" 
                     class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border z-50"
                     style="display: none;">
                    <div class="p-2">
                        <div class="px-3 py-2 border-b">
                            <p class="text-sm font-medium text-gray-800">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-gray-500 capitalize">{{ auth()->user()->role }}</p>
                        </div>
                        
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-md transition-colors duration-200 flex items-center space-x-2">
                                <i class="fas fa-sign-out-alt w-4"></i>
                                <span>Logout</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>