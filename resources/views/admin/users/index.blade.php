@extends('layouts.app')

@section('title', 'Kelola Pengguna')

@section('content')
<div class="space-y-6 animate-fade-in">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Kelola Pengguna</h1>
            <p class="text-gray-600 mt-1">Kelola semua pengguna sistem booking futsal</p>
        </div>
        <a href="{{ route('admin.users.create') }}" 
           class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center space-x-2 transition-colors duration-200">
            <i class="fas fa-plus"></i>
            <span>Tambah Pengguna</span>
        </a>
    </div>

    <!-- Stats -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-blue-500">
            <p class="text-sm font-medium text-gray-600">Total Pengguna</p>
            <p class="text-3xl font-bold text-gray-900 mt-2">{{ $users->count() }}</p>
        </div>
        <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-green-500">
            <p class="text-sm font-medium text-gray-600">Pengguna Aktif</p>
            <p class="text-3xl font-bold text-gray-900 mt-2">{{ $users->where('is_active', true)->count() }}</p>
        </div>
        <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-red-500">
            <p class="text-sm font-medium text-gray-600">Admin</p>
            <p class="text-3xl font-bold text-gray-900 mt-2">{{ $users->where('role', 'admin')->count() }}</p>
        </div>
        <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-purple-500">
            <p class="text-sm font-medium text-gray-600">Owner</p>
            <p class="text-3xl font-bold text-gray-900 mt-2">{{ $users->where('role', 'owner')->count() }}</p>
        </div>
    </div>

    <!-- Filter -->
    <div class="bg-white rounded-xl shadow-lg p-6">
        <div class="flex flex-col sm:flex-row gap-4">
            <input type="text" id="searchInput" placeholder="Cari nama atau email..."
                class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" />
            <select id="roleFilter" class="px-4 py-2 border border-gray-300 rounded-lg">
                <option value="all">Semua Role</option>
                <option value="admin">Admin</option>
                <option value="owner">Owner</option>
                <option value="user">User</option>
            </select>
            <select id="statusFilter" class="px-4 py-2 border border-gray-300 rounded-lg">
                <option value="all">Semua Status</option>
                <option value="active">Aktif</option>
                <option value="inactive">Nonaktif</option>
            </select>
        </div>
    </div>

    <!-- Tabel -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">#</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Role</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No. HP</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Dibuat</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200" id="usersTable">
                    @forelse($users as $user)
                        <tr class="user-row"
                            data-name="{{ strtolower($user->name) }}"
                            data-email="{{ strtolower($user->email) }}"
                            data-role="{{ $user->role }}"
                            data-status="{{ $user->is_active ? 'active' : 'inactive' }}">
                            <td class="px-6 py-4 text-sm">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4 text-sm font-medium">{{ $user->name }}</td>
                            <td class="px-6 py-4 text-sm">{{ $user->email }}</td>
                            <td class="px-6 py-4 text-sm">{{ ucfirst($user->role) }}</td>
                            <td class="px-6 py-4 text-sm">{{ $user->phone ?? '-' }}</td>
                            <td class="px-6 py-4 text-sm">
                                @if($user->is_active)
                                    <span class="text-green-600">Aktif</span>
                                @else
                                    <span class="text-gray-500">Nonaktif</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm">{{ $user->created_at->format('d M Y') }}</td>
                            <td class="px-6 py-4 text-sm flex space-x-3">
                                <a href="{{ route('admin.users.edit', $user) }}" class="text-blue-600 hover:text-blue-800">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form action="{{ route('admin.users.toggle-status', $user) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="text-gray-600 hover:text-green-700">
                                        <i class="fas {{ $user->is_active ? 'fa-ban' : 'fa-check' }}"></i>
                                    </button>
                                </form>

                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline" onsubmit="return confirm('Hapus pengguna ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-6 py-4 text-center text-sm text-gray-500">
                                Belum ada pengguna. <a href="{{ route('admin.users.create') }}" class="text-blue-600 hover:underline">Tambah sekarang</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
