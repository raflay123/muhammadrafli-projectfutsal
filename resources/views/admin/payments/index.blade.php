@extends('layouts.app')

@section('title', 'Kelola Pembayaran')

@section('content')
<div class="space-y-6 animate-fade-in">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Kelola Pembayaran</h1>
            <p class="text-gray-600 mt-1">Kelola semua transaksi pembayaran pelanggan</p>
        </div>
        <div class="flex space-x-3">
            <a href="{{ route('admin.payments.create') }}" 
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center space-x-2 transition-colors duration-200 shadow-md">
                <i class="fas fa-plus-circle"></i>
                <span>Tambah Transaksi</span>
            </a>
            <a href="{{ route('admin.payments.exportPdf') }}" 
                class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg flex items-center space-x-2 transition-colors duration-200 shadow-md">
                <i class="fas fa-file-pdf"></i>
                <span>Export PDF</span>
            </a>
        </div>
    </div>
    
    <div class="bg-white rounded-xl shadow-lg p-6">
        <div class="flex flex-col sm:flex-row gap-4">
            <input type="text" id="searchInput" placeholder="Cari ID transaksi, nama, atau email..."
                class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" />
            
            {{-- Anda bisa tambahkan dropdown filter status jika diperlukan, seperti: --}}
            {{-- 
            <select id="statusFilter" class="px-4 py-2 border border-gray-300 rounded-lg">
                <option value="all">Semua Status</option>
                <option value="paid">Paid</option>
                <option value="unpaid">Unpaid</option>
                <option value="refunded">Refunded</option>
            </select>
            --}}
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
    
    <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-blue-500">
        <p class="text-sm font-medium text-gray-600">Total Transaksi</p>
        {{-- PERBAIKAN: Gunakan kelas font-bold dan ukuran teks besar untuk menonjolkan angka --}}
        <p class="text-3xl font-bold text-gray-900 mt-2">{{ $totalPayments ?? 0 }}</p>
    </div>

    <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-green-500">
        <p class="text-sm font-medium text-gray-600">Paid</p>
        {{-- PERBAIKAN: Gunakan kelas font-bold dan ukuran teks besar --}}
        <p class="text-3xl font-bold text-gray-900 mt-2">{{ $paidPayments ?? 0 }}</p>
    </div>

    <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-yellow-500">
        <p class="text-sm font-medium text-gray-600">Unpaid</p>
        {{-- PERBAIKAN: Gunakan kelas font-bold dan ukuran teks besar --}}
        <p class="text-3xl font-bold text-gray-900 mt-2">{{ $unpaidPayments ?? 0 }}</p>
    </div>
    
    <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-red-500">
        <p class="text-sm font-medium text-gray-600">Refunded</p>
        {{-- PERBAIKAN: Gunakan kelas font-bold dan ukuran teks besar --}}
        <p class="text-3xl font-bold text-gray-900 mt-2">{{ $refundedPayments ?? 0 }}</p>
    </div>
</div>
    
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="overflow-x-auto">
            @if(isset($payments) && $payments->count() > 0)
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Pelanggan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jumlah</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Bukti Transfer</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($payments as $payment)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><strong>#{{ $payment->id }}</strong></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $payment->customer_name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $payment->email }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">Rp {{ number_format($payment->amount, 0, ',', '.') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($payment->status == 'paid')
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Paid</span>
                                @elseif($payment->status == 'unpaid')
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Unpaid</span>
                                @else
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Refunded</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                @if($payment->payment_proof)
                                    <a href="{{ asset('storage/'.$payment->payment_proof) }}" target="_blank" class="text-blue-600 hover:text-blue-800 transition-colors duration-150 flex items-center space-x-1">
                                        <i class="fas fa-eye"></i><span>Lihat</span>
                                    </a>
                                @else
                                    <span class="text-gray-400">-</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $payment->created_at->format('d/m/Y') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm flex space-x-3">
                                <a href="{{ route('admin.payments.edit', $payment->id) }}" class="text-yellow-600 hover:text-yellow-800" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.payments.destroy', $payment->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus transaksi ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                @if($payments->hasPages())
                <div class="p-4 border-t border-gray-200">
                    <div class="flex justify-between items-center text-sm text-gray-600">
                        <span>
                            Menampilkan {{ $payments->firstItem() }} - {{ $payments->lastItem() }} dari {{ $payments->total() }} transaksi
                        </span>
                        <div>
                            {{ $payments->links('pagination::tailwind') }} 
                        </div>
                    </div>
                </div>
                @endif
            
            @else
                <div class="text-center py-10">
                    <i class="fas fa-credit-card text-gray-300 text-5xl mb-3"></i>
                    <h4 class="text-xl font-semibold text-gray-700 mb-2">Belum ada data transaksi</h4>
                    <p class="text-gray-500 mb-6">Mulai dengan menambahkan transaksi pembayaran pertama Anda.</p>
                    <a href="{{ route('admin.payments.create') }}" 
                        class="px-6 py-3 bg-blue-600 text-white rounded-lg shadow-lg hover:bg-blue-700 transition duration-150 flex items-center justify-center mx-auto w-fit">
                        <i class="fas fa-plus-circle mr-2"></i> Tambah Transaksi Pertama
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection