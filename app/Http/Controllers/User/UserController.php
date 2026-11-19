<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\BookIssue;
use App\Models\BookRequest;
use App\Models\BookReturn;
use App\Models\LegalPage;
use App\Models\Book;
use App\Models\Payment;

class UserController extends Controller
{
    public function profile()
    {
        $user = Auth::user();

        return view('user.profile.index', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required',
            'student_id' => 'required',
            'email' => 'required|email',
            'phone' => 'nullable',
            'department' => 'nullable',
            'semester' => 'nullable',
            'address' => 'nullable',
            'photo' => 'nullable|image',
        ]);

        if ($request->hasFile('photo')) {

            $photo = $request->file('photo')
                ->store('users', 'public');

            $user->photo = $photo;
        }

        $user->name = $request->name;
        $user->student_id = $request->student_id;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->department = $request->department;
        $user->semester = $request->semester;
        $user->address = $request->address;

        $user->save();

        return back()->with(
            'success',
            'Profile Updated Successfully'
        );
    }

    public function borrowedBooks()
    {
        //// Currently borrowed books
        $issues = BookIssue::with('book')
                    ->where('user_id', auth()->id())
                    ->latest()
                    ->get();

        return view(
            'user.borrowed_books.index',
            compact('issues')
        );
    }

    public function bookHistory()
    {
        $userId = Auth::id();

        // ইউজারের আগের ফেরত দেওয়া বইয়ের ইতিহাস
        $returnedBooks = BookReturn::with('book')
            ->whereHas('issue', function($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->latest()
            ->get();

        return view('user.book_history', compact('returnedBooks'));
    }

    public function dashboard(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

       $user = Auth::user();

    // আপনার আগের সব কোড ঠিক থাকবে...
    $issues = BookIssue::with('book')
        ->where('user_id', $user->id)
        ->where('status', 'Issued')
        ->latest()
        ->get();

    $pendingRequests = BookRequest::with('book')
        ->where('user_id', $user->id)
        ->where('status', 'Pending')
        ->latest()
        ->get();

    $rejectedRequests = BookRequest::with('book')
        ->where('user_id', $user->id)
        ->where('status', 'Rejected')
        ->latest()
        ->get();

    $returnedIssues = BookIssue::with(['book', 'returns'])
        ->where('user_id', $user->id)
        ->where('status', 'Returned')
        ->latest()
        ->get();

    $returnedBooks = BookReturn::with('book')
        ->whereHas('issue', function($query) use ($user) {
            $query->where('user_id', $user->id);
        })
        ->latest()
        ->get();

    // ➕ Payment History - ডাটাবেজের Structure মিলিয়ে ডাটা আনা হচ্ছে:
    $paymentHistory = Payment::with('issue.book')
        ->where('user_id', $user->id)
        ->latest()
        ->get();

    $newArrivals = Book::latest()->take(6)->get();
    $rulesPage = LegalPage::where('slug', 'library-rules')->first();

    $books = Book::where('available_quantity', '>', 0);

    if ($request->filled('search')) {
        $search = $request->search;
        $books->where(function ($query) use ($search) {
            $query->where('title', 'like', "%{$search}%")
                  ->orWhere('author', 'like', "%{$search}%")
                  ->orWhere('genre', 'like', "%{$search}%");
        });
    }

        $books = $books->latest()->get();

        return view('user.user_dashboard', compact(
            'user',
            'issues',
            'pendingRequests',
            'rejectedRequests',
            'returnedIssues',
            'returnedBooks',
            'paymentHistory',
            'newArrivals',
            'rulesPage',
            'books'
        ));
    }

    public function search(Request $request)
    {
        $search = $request->search;

        $books = Book::where('title', 'LIKE', "%{$search}%")
            ->orWhere('author', 'LIKE', "%{$search}%")
            ->orWhere('genre', 'LIKE', "%{$search}%")
            ->limit(8)
            ->get();

        return response()->json($books);
    }
}