<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\BookIssue;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Support\Str;

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
            ->where('user_id', Auth::id())
            ->firstOrFail();

        // Already paid?
        if ($issue->fine_paid) {
            return redirect()
                ->route('user.dashboard')
                ->with('error', 'This fine has already been paid.');
        }

        $today = Carbon::today();
        $returnDate = Carbon::parse($issue->return_deadline);

        // Calculate overdue days
        $daysOverdue = $returnDate->lt($today)
            ? $returnDate->diffInDays($today)
            : 0;

        // 5 Tk per overdue day
        $fine = $daysOverdue * 5;

        // No fine
        if ($fine <= 0) {
            return redirect()
                ->route('user.dashboard')
                ->with('error', 'You currently have no unpaid fine.');
        }

        return view(
            'user.payment',
            compact('issue', 'fine', 'daysOverdue')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Process Payment
    |--------------------------------------------------------------------------
    */
    public function pay(Request $request, $issueId)
    {
        $request->validate([
            'payment_method' => 'required|in:bkash,nagad',
            'mobile' => [
                'required',
                'regex:/^01[3-9][0-9]{8}$/'
            ],
        ]);

        $issue = BookIssue::with('book')
            ->where('id', $issueId)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        // Prevent double payment
        if ($issue->fine_paid) {
            return redirect()
                ->route('user.dashboard')
                ->with('error', 'This fine has already been paid.');
        }

        $today = Carbon::today();
        $returnDate = Carbon::parse($issue->return_deadline);

        $daysOverdue = $returnDate->lt($today)
            ? $returnDate->diffInDays($today)
            : 0;

        $fine = $daysOverdue * 5;

        if ($fine <= 0) {
            return redirect()
                ->route('user.dashboard')
                ->with('error', 'No fine is currently due.');
        }

        /*
        |--------------------------------------------------------------------------
        | Mock bKash / Nagad Payment
        |--------------------------------------------------------------------------
        */
        $payment = Payment::create([
            'user_id'        => Auth::id(),
            'issue_id'       => $issue->id,
            'amount'         => $fine,
            'payment_method' => $request->payment_method,
            'payment_status' => 'completed', // 'status' এর বদলে 'payment_status' ব্যবহার করা হয়েছে
            'transaction_id' => 'LMS-' . strtoupper(Str::random(10)),
            'paid_at'        => now(),
        ]);

        /*
        |--------------------------------------------------------------------------
        | Mark Fine as Paid
        |--------------------------------------------------------------------------
        */
        $issue->update([
            'fine_paid'           => true,
            'fine_payment_method' => $request->payment_method,
            'fine_paid_at'        => now(),
        ]);

        /*
        |--------------------------------------------------------------------------
        | Redirect to Success Page
        |--------------------------------------------------------------------------
        */
        return redirect()->route('payment.success', $payment->id);
    }

    /*
    |--------------------------------------------------------------------------
    | Payment Success
    |--------------------------------------------------------------------------
    */
    public function success($paymentId)
    {
        $payment = Payment::with(['issue.book'])
            ->where('id', $paymentId)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return view('user.payment_success', compact('payment'));
    }

    /*
    |--------------------------------------------------------------------------
    | Payment History
    |--------------------------------------------------------------------------
    */
    public function history()
    {
        $payments = Payment::with(['issue.book'])
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('user.payment_history', compact('payments'));
    }
}