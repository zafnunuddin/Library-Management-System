<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\BookIssue;
use App\Models\BookRequest;
use Illuminate\Support\Facades\DB;

class RequestController extends Controller
{
    /**
     * Show all book requests.
     *
     * Pending requests whose 15-day deadline has passed
     * will automatically become Rejected when the admin
     * opens the request list.
     */
    public function index()
    {
        // Auto reject expired pending requests
        BookRequest::where('status', 'Pending')
            ->whereNotNull('request_deadline')
            ->where('request_deadline', '<', now())
            ->update([
                'status' => 'Rejected',
            ]);

         $requests = BookRequest::with([
        'user',
        'book',
        'issue'
    ])
    ->latest()
    ->get();

    return view('admin.requests.index', compact('requests'));
    }


    /**
     * Admin approves a pending request.
     *
     * IMPORTANT:
     * Approving does NOT issue the book yet.
     * The book will be issued only after handover confirmation.
     */
    public function approve(BookRequest $bookRequest)
    {
        if ($bookRequest->status !== 'Pending') {
            return back()->with(
                'error',
                'This request has already been processed.'
            );
        }

        // Check 15-day deadline
        if (
            $bookRequest->request_deadline &&
            $bookRequest->request_deadline->isPast()
        ) {
            $bookRequest->status = 'Rejected';
            $bookRequest->save();

            return back()->with(
                'error',
                'This request has expired and was automatically rejected.'
            );
        }

        $book = Book::findOrFail($bookRequest->book_id);

        // Check availability
        if ($book->available_quantity <= 0) {
            return back()->with(
                'error',
                'Cannot approve, "' . $book->title . '" is out of stock.'
            );
        }

        // Approve only.
        // BookIssue will NOT be created yet.
        $bookRequest->status = 'Approved';
        $bookRequest->approved_at = now();
        $bookRequest->handover_confirmed = false;
        $bookRequest->handover_confirmed_at = null;
        $bookRequest->save();

        return back()->with(
            'success',
            'Request approved. Now hand over "' .
            $book->title .
            '" to ' .
            $bookRequest->user->name .
            ' and confirm the handover.'
        );
    }


    /**
     * Reject a pending request.
     */
    public function reject(BookRequest $bookRequest)
    {
        if ($bookRequest->status !== 'Pending') {
            return back()->with(
                'error',
                'This request has already been processed.'
            );
        }

        $bookRequest->status = 'Rejected';
        $bookRequest->save();

        return back()->with(
            'success',
            'Request for "' .
            $bookRequest->book->title .
            '" has been rejected.'
        );
    }


    /**
     * Confirm physical book handover.
     *
     * After the admin physically gives the book to the student,
     * this method creates the BookIssue and decreases stock.
     */
    public function confirmHandover(BookRequest $bookRequest)
    {
        if ($bookRequest->status !== 'Approved') {
            return back()->with(
                'error',
                'Only approved requests can be handed over.'
            );
        }

        if ($bookRequest->handover_confirmed) {
            return back()->with(
                'error',
                'Book handover has already been confirmed.'
            );
        }

        $book = Book::findOrFail($bookRequest->book_id);

        if ($book->available_quantity <= 0) {
            return back()->with(
                'error',
                'Cannot hand over "' .
                $book->title .
                '" because it is out of stock.'
            );
        }

        // Prevent duplicate issue
        $alreadyIssued = BookIssue::where(
            'user_id',
            $bookRequest->user_id
        )
            ->where(
                'book_id',
                $bookRequest->book_id
            )
            ->where(
                'status',
                'Issued'
            )
            ->exists();

        if ($alreadyIssued) {
            return back()->with(
                'error',
                'This student already has this book issued.'
            );
        }

        DB::transaction(function () use ($bookRequest, $book) {

            // Create actual book issue
            BookIssue::create([
                'user_id' => $bookRequest->user_id,
                'book_id' => $bookRequest->book_id,
                'issue_date' => now()->toDateString(),
                'return_deadline' => now()
                    ->addDays(14)
                    ->toDateString(),
                'status' => 'Issued',

                // Handover information
                'handover_confirmed' => true,
                'handover_confirmed_at' => now(),
            ]);

            // Reduce available quantity
            $book->decrement('available_quantity');

            // Update request
            $bookRequest->handover_confirmed = true;
            $bookRequest->handover_confirmed_at = now();
            $bookRequest->save();
        });

        return back()->with(
            'success',
            'Book "' .
            $book->title .
            '" has been handed over to ' .
            $bookRequest->user->name .
            ' successfully.'
        );
    }
}