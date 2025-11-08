<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment;
use Illuminate\Support\Facades\Storage;
use PDF; // gunakan package barryvdh/laravel-dompdf jika ingin export PDF

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::latest()->paginate(10);
        return view('admin.payments.index', compact('payments'));
    }

    public function create()
    {
        return view('admin.payments.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'customer_name' => 'required|string|max:255',
            'email' => 'required|email',
            'amount' => 'required|numeric',
            'status' => 'required|in:unpaid,paid,refunded',
            'payment_proof' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('payment_proof')) {
            $data['payment_proof'] = $request->file('payment_proof')->store('payment_proofs', 'public');
        }

        Payment::create($data);

        return redirect()->route('admin.payments.index')->with('success', 'Payment created successfully.');
    }

    public function edit(Payment $payment)
    {
        return view('admin.payments.edit', compact('payment'));
    }

    public function update(Request $request, Payment $payment)
    {
        $data = $request->validate([
            'customer_name' => 'required|string|max:255',
            'email' => 'required|email',
            'amount' => 'required|numeric',
            'status' => 'required|in:unpaid,paid,refunded',
            'payment_proof' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('payment_proof')) {
            if ($payment->payment_proof) {
                Storage::disk('public')->delete($payment->payment_proof);
            }
            $data['payment_proof'] = $request->file('payment_proof')->store('payment_proofs', 'public');
        }

        $payment->update($data);

        return redirect()->route('admin.payments.index')->with('success', 'Payment updated successfully.');
    }

    public function destroy(Payment $payment)
    {
        if ($payment->payment_proof) {
            Storage::disk('public')->delete($payment->payment_proof);
        }
        $payment->delete();
        return redirect()->route('admin.payments.index')->with('success', 'Payment deleted successfully.');
    }

    // Method untuk export PDF
    public function exportPdf()
{
    $payments = Payment::all(); // ambil semua data pembayaran

    // Misal pakai dompdf
    $pdf = \PDF::loadView('admin.payments.pdf', compact('payments'));
    return $pdf->download('laporan_pembayaran.pdf');
}
}
