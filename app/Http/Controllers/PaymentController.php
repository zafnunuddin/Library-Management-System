<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\BookIssue;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Show Payment Page
    |--------------------------------------------------------------------------
    */

    public function create($issueId)
    {
        $issue = BookIssue::with('book')
            ->where('id', $issueId)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        return view('user.payment.index', compact('issue'));
    }


    /*
    |--------------------------------------------------------------------------
    | Process Mock bKash / Nagad Payment
    |--------------------------------------------------------------------------
    */

    public function pay(Request $request, $issueId)
{
    $request->validate([
        'payment_method' => 'required|in:bkash,nagad',
        'mobile' => 'required|string|max:20',
    ]);

    $issue = BookIssue::with('book')
        ->where('id', $issueId)
        ->where('user_id', auth()->id())
        ->firstOrFail();

    // Calculate overdue days
    $today = now()->startOfDay();

    $returnDate = \Carbon\Carbon::parse(
        $issue->return_deadline
    )->startOfDay();

    $daysLate = $today->diffInDays(
        $returnDate,
        false
    );

    // Fine = 5 Tk per overdue day
    $fine = $daysLate < 0
        ? abs($daysLate) * 5
        : 0;

    // No fine
    if ($fine <= 0) {
        return back()->with(
            'error',
            'There is no overdue fine to pay.'
        );
    }

    // Already paid
    if ($issue->fine_paid) {
        return back()->with(
            'error',
            'This fine has already been paid.'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Mock bKash / Nagad Payment
    |--------------------------------------------------------------------------
    */

    $issue->update([
        'fine_paid' => true,
        'fine_payment_method' => $request->payment_method,
        'fine_paid_at' => now(),
    ]);

    return redirect()
        ->route('payment.success', $issue->id)
        ->with(
            'success',
            'Payment completed successfully via '
            . strtoupper($request->payment_method)
            . '.'
        );
}


    /*
    |--------------------------------------------------------------------------
    | Payment Success Page
    |--------------------------------------------------------------------------
    */

    public function success($paymentId)
    {
        $issue = BookIssue::with('book')
            ->where('id', $paymentId)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        return view(
            'user.payment.success',
            compact('issue')
        );
    }
}