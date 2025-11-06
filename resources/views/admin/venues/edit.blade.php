@extends('layouts.app')

@section('title', 'Edit Lapangan - ' . $venue->name)

@section('content')
<div class="space-y-6 animate-fade-in">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Edit Lapangan</h1>
            <p class="text-gray-600 mt-1">Edit data lapangan {{ $venue->name }}</p>
        </div>
        <a href="{{ route('admin.venues.index') }}" 
           class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg flex items-center space-x-2 transition-colors duration-200">
            <i class="fas fa-arrow-left"></i>
            <span>Kembali</span>
        </a>
    </div>

    <!-- Form -->
    <div class="bg-white rounded-xl shadow-lg p-6">
        <form action="{{ route('admin.venues.update', $venue) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Nama Lapangan -->
                <div class="md:col-span-2">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama Lapangan *</label>
                    <input type="text" 
                           name="name" 
                           id="name"
                           value="{{ old('name', $venue->name) }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
                           placeholder="Contoh: Lapangan Futsal Merdeka"
                           required>
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Deskripsi -->
                <div class="md:col-span-2">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi *</label>
                    <textarea 
                        name="description" 
                        id="description"
                        rows="4"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
                        placeholder="Deskripsi lengkap tentang lapangan..."
                        required>{{ old('description', $venue->description) }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Lokasi -->
                <div class="md:col-span-2">
                    <label for="location" class="block text-sm font-medium text-gray-700 mb-2">Lokasi *</label>
                    <input type="text" 
                           name="location" 
                           id="location"
                           value="{{ old('location', $venue->location) }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
                           placeholder="Contoh: Jl. Merdeka No. 123, Jakarta"
                           required>
                    @error('location')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Harga per Jam -->
                <div>
                    <label for="price_per_hour" class="block text-sm font-medium text-gray-700 mb-2">Harga per Jam (Rp) *</label>
                    <input type="number" 
                           name="price_per_hour" 
                           id="price_per_hour"
                           value="{{ old('price_per_hour', $venue->price_per_hour) }}"
                           min="0"
                           step="1000"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
                           placeholder="Contoh: 175000"
                           required>
                    @error('price_per_hour')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Status Ketersediaan -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status Ketersediaan</label>
                    <div class="flex items-center space-x-3">
                        <label class="flex items-center">
                            <input type="checkbox" 
                                   name="is_available" 
                                   value="1"
                                   {{ old('is_available', $venue->is_available) ? 'checked' : '' }}
                                   class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                            <span class="ml-2 text-sm text-gray-700">Lapangan tersedia</span>
                        </label>
                    </div>
                </div>

                <!-- Jam Buka -->
                <div>
                    <label for="open_time" class="block text-sm font-medium text-gray-700 mb-2">Jam Buka *</label>
                    <input type="time" 
                           name="open_time" 
                           id="open_time"
                           value="{{ old('open_time', $venue->open_time) }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
                           required>
                    @error('open_time')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Jam Tutup -->
                <div>
                    <label for="close_time" class="block text-sm font-medium text-gray-700 mb-2">Jam Tutup *</label>
                    <input type="time" 
                           name="close_time" 
                           id="close_time"
                           value="{{ old('close_time', $venue->close_time) }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
                           required>
                    @error('close_time')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Submit Button -->
            <div class="mt-8 flex justify-end space-x-3">
                <a href="{{ route('admin.venues.index') }}" 
                   class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg transition-colors duration-200">
                    Batal
                </a>
                <button type="submit" 
                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg flex items-center space-x-2 transition-colors duration-200">
                    <i class="fas fa-save"></i>
                    <span>Update Lapangan</span>
                </button>
            </div>
        </form>
    </div>
</div>
@endsection