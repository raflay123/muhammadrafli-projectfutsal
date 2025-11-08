@extends('layouts.app')

@section('title', 'Tambah Transaksi Pembayaran')

@section('content')
<div class="space-y-6 animate-fade-in">
    <div class="flex justify-between items-center border-b pb-3">
        <h1 class="text-2xl font-bold text-gray-800">Tambah Transaksi Pembayaran</h1>
        <a href="{{ route('admin.payments.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition duration-150 flex items-center space-x-2 shadow-md">
            <i class="fas fa-arrow-left"></i>
            <span>Kembali</span>
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-lg p-6">
        <form action="{{ route('admin.payments.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                <div>
                    <label for="customer_name" class="block text-sm font-medium text-gray-700 mb-1">
                        Nama Pelanggan <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="customer_name" name="customer_name" value="{{ old('customer_name') }}" required
                        class="w-full px-3 py-2 border rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('customer_name') border-red-500 @enderror">
                    @error('customer_name')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                        Email <span class="text-red-500">*</span>
                    </label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required
                        class="w-full px-3 py-2 border rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('email') border-red-500 @enderror">
                    @error('email')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="amount" class="block text-sm font-medium text-gray-700 mb-1">
                        Jumlah Pembayaran <span class="text-red-500">*</span>
                    </label>
                    <div class="relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span class="text-gray-500 sm:text-sm">Rp</span>
                        </div>
                        <input type="number" id="amount" name="amount" value="{{ old('amount') }}" min="0" step="1" required
                            class="block w-full pl-10 pr-3 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500 @error('amount') border-red-500 @enderror" placeholder="Cth: 150000">
                    </div>
                    @error('amount')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-1">
                        Status <span class="text-red-500">*</span>
                    </label>
                    <select id="status" name="status" required
                        class="w-full px-3 py-2 border rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('status') border-red-500 @enderror">
                        <option value="">Pilih Status</option>
                        <option value="unpaid" {{ old('status') == 'unpaid' ? 'selected' : '' }}>Unpaid</option>
                        <option value="paid" {{ old('status') == 'paid' ? 'selected' : '' }}>Paid</option>
                        <option value="refunded" {{ old('status') == 'refunded' ? 'selected' : '' }}>Refunded</option>
                    </select>
                    @error('status')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label for="payment_proof" class="block text-sm font-medium text-gray-700 mb-1">
                    Bukti Transfer (Opsional)
                </label>
                <input type="file" id="payment_proof" name="payment_proof" accept="image/*,.pdf"
                    class="block w-full text-sm text-gray-500
                    file:mr-4 file:py-2 file:px-4
                    file:rounded-lg file:border-0
                    file:text-sm file:font-semibold
                    file:bg-blue-50 file:text-blue-700
                    hover:file:bg-blue-100 
                    @error('payment_proof') border-red-500 @enderror">
                <p class="mt-1 text-xs text-gray-500">Format yang didukung: JPG, PNG, PDF. Maksimal 2MB.</p>
                @error('payment_proof')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end space-x-4 pt-4 border-t">
                <button type="reset" class="px-4 py-2 text-gray-700 border border-gray-300 rounded-lg hover:bg-gray-100 transition duration-150 flex items-center space-x-2">
                    <i class="fas fa-undo"></i>
                    <span>Reset</span>
                </button>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-150 flex items-center space-x-2 shadow-md">
                    <i class="fas fa-save"></i>
                    <span>Simpan Transaksi</span>
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Format input amount dengan separator ribuan
    document.getElementById('amount').addEventListener('input', function(e) {
        // Hapus semua karakter non-digit
        let value = this.value.replace(/[^\d]/g, '');
        
        // Format dengan separator ribuan
        if (value.length > 0) {
            value = parseInt(value, 10).toLocaleString('id-ID');
            this.value = value;
        }
    });
</script>
@endsection