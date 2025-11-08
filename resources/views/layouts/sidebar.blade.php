<!-- Sidebar -->
<div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-100">

    <!-- Mobile sidebar backdrop -->
    
    <div 
        x-show="sidebarOpen"
        x-transition:enter="transition ease-in-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in-out duration-300"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-20 bg-black bg-opacity-50 sm:hidden"
        @click="sidebarOpen = false"
    ></div>

    

    <!-- Sidebar -->
    <aside
        :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
        class="fixed inset-y-0 z-30 w-64 bg-gradient-to-b from-blue-800 to-blue-900 shadow-lg transform transition-transform duration-300 sm:translate-x-0"
    >
        <div class="flex flex-col h-full">

            <!-- Logo -->
            <div class="flex items-center justify-center h-16 px-4 bg-blue-900">
                <div class="flex items-center space-x-2">
                    <i class="fas fa-futbol text-white text-2xl"></i>
                    <span class="text-white text-xl font-bold">FutsalBook</span>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
                <a href="{{ route('admin.dashboard') }}"
                   class="flex items-center px-4 py-3 text-white rounded-lg hover:bg-blue-700 transition-all duration-200 group {{ request()->routeIs('admin.dashboard') ? 'bg-blue-700 shadow-lg' : '' }}">
                    <i class="fas fa-tachometer-alt w-6"></i>
                    <span class="ml-3 font-medium">Dashboard</span>
                </a>

                <a href="{{ route('admin.venues.index') }}"
                   class="flex items-center px-4 py-3 text-white rounded-lg hover:bg-blue-700 transition-all duration-200 group {{ request()->routeIs('admin.venues.*') ? 'bg-blue-700 shadow-lg' : '' }}">
                    <i class="fas fa-map-marker-alt w-6"></i>
                    <span class="ml-3 font-medium">Lapangan</span>
                </a>

                <a href="{{ route('admin.bookings.index') }}"
                   class="flex items-center px-4 py-3 text-white rounded-lg hover:bg-blue-700 transition-all duration-200 group {{ request()->routeIs('admin.bookings.*') ? 'bg-blue-700 shadow-lg' : '' }}">
                    <i class="fas fa-calendar-check w-6"></i>
                    <span class="ml-3 font-medium">Booking</span>
                </a>

                <a href="{{ route('admin.users.index') }}"
                   class="flex items-center px-4 py-3 text-white rounded-lg hover:bg-blue-700 transition-all duration-200 group {{ request()->routeIs('admin.users.*') ? 'bg-blue-700 shadow-lg' : '' }}">
                    <i class="fas fa-users w-6"></i>
                    <span class="ml-3 font-medium">Pengguna</span>
                </a>


                
                <a href="{{ route('admin.payments.index') }}"
                class="flex items-center px-4 py-3 text-white rounded-lg hover:bg-blue-700 transition-all duration-200 group {{ request()->routeIs('admin.payments.*') ? 'bg-blue-700 shadow-lg' : '' }}">
                    <i class="fas fa-credit-card w-6"></i>
                    <span class="ml-3 font-medium">Kelola Pembayaran</span>
                </a>
            </nav>

            <!-- User Info -->
            <div class="p-4 border-t border-blue-700">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center">
                        <i class="fas fa-user text-white"></i>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-white font-medium text-sm truncate">{{ auth()->user()->name }}</p>
                        <p class="text-blue-200 text-xs capitalize">{{ auth()->user()->role }}</p>
                    </div>
                </div>
            </div>
        </div>
    </aside>

    <!-- Page content -->
    <div class="flex-1 flex flex-col">
        <!-- Topbar -->
        <header class="flex items-center justify-between px-4 py-2 bg-white shadow sm:hidden">
            <button @click="sidebarOpen = !sidebarOpen" class="text-gray-700 focus:outline-none">
                <i class="fas fa-bars text-xl"></i>
            </button>
            <div class="font-bold text-lg">Dashboard</div>
        </header>

        <!-- Main content -->
        <main class="flex-1 p-6 overflow-y-auto">
            @yield('content')
        </main>
    </div>

</div>

<!-- Alpine.js -->
<script src="//unpkg.com/alpinejs" defer></script>
