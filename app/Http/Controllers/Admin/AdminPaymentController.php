<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class AdminPaymentController extends Controller
{
    public function index()
    {
        // সব পেমেন্ট ডাটা তুলে আনা
        $payments = Payment::latest()->paginate(10);

        return view('admin.payments.index', compact('payments'));
    }

    public function approve($id)
    {
        $payment = Payment::findOrFail($id);

        $payment->update([
            'payment_status' => 'completed'
        ]);

        if ($payment->issue) {
            $payment->issue->update([
                'fine_paid' => true,
                'fine_paid_at' => now(),
            ]);
        }

        return redirect()->back()->with('success', 'Payment approved successfully!');
    }
}