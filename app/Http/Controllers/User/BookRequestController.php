<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

use App\Models\Book;
use App\Models\BookRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookRequestController extends Controller
{
    /**
     * A logged-in student requests to borrow a book. The admin approves
     * or rejects it later from Admin\RequestController.
     */
    public function store(Request $request, Book $book)
    {
        $userId = Auth::id();

        $alreadyPending = BookRequest::where('user_id', $userId)
            ->where('book_id', $book->id)
            ->where('status', 'Pending')
            ->exists();

        if ($alreadyPending) {
            return back()->with(
                'error',
                'You already have a pending request for "'.$book->title.'".'
            );
        }

        if ($book->available_quantity <= 0) {
            return back()->with(
                'error',
                '"'.$book->title.'" is currently out of stock.'
            );
        }

        BookRequest::create([
    'user_id' => $userId,
    'book_id' => $book->id,
    'status' => 'Pending',
    'request_deadline' => now()->addDays(15),
]);
        return back()->with(
            'success',
            'Request submitted for "'.$book->title.'". A librarian will review it shortly.'
        );
    }

    /**
     * A student withdraws their own pending request.
     */
    public function cancel(BookRequest $bookRequest)
    {
        if ($bookRequest->user_id !== Auth::id()) {
            abort(403);
        }

        if ($bookRequest->status !== 'Pending') {
            return back()->with(
                'error',
                'Only pending requests can be cancelled.'
            );
        }

        $bookRequest->delete();

        return back()->with(
            'success',
            'Request cancelled.'
        );
    }
}
