<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\User;
use App\Models\BookIssue;
use App\Models\BookReturn;
use App\Models\DamagedBook; // মডেল ইমপোর্ট করা আছে
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard(Request $request)
    {
        // Dashboard Cards
        $totalBooks = Book::sum('quantity');
        $availableBooks = Book::sum('available_quantity');
        $borrowedBooks = BookIssue::where('status', 'Issued')->count();
        $returnedBooks = BookIssue::where('status', 'Returned')->count();
        $activeMembers = User::where('role', 'user')->count();
          
        $overdueBooks = BookIssue::where('status', 'Issued')
            ->whereDate('return_deadline', '<', now())
            ->count();

        // ১. পরিবর্তন: DamagedBook মডেল থেকে মোট ড্যামেজ বইয়ের সংখ্যা গণনা
        $damagedBooks = DamagedBook::sum('quantity');

        $fineCollection = BookReturn::sum('fine');
        
        // Search Books
        $keyword = $request->keyword;
        $searchBooks = collect();

        if ($keyword) {
            $searchBooks = Book::where('title', 'LIKE', "%{$keyword}%")
                ->orWhere('author', 'LIKE', "%{$keyword}%")
                ->orWhere('genre', 'LIKE', "%{$keyword}%")
                ->orWhere('edition', 'LIKE', "%{$keyword}%")
                ->get();
        }

        // Monthly Report
        $monthlyReports = BookIssue::select(
                DB::raw('MONTH(created_at) as month_no'),
                DB::raw('MONTHNAME(created_at) as month'),
                DB::raw('COUNT(*) as issued'),
                DB::raw("SUM(CASE WHEN status='Returned' THEN 1 ELSE 0 END) as returned"),
                DB::raw("SUM(CASE WHEN status='Issued' AND return_deadline < NOW() THEN 1 ELSE 0 END) as late")
            )
            ->groupBy('month_no', 'month')
            ->orderBy('month_no')
            ->get();

        return view('admin.dashboard', compact(
            'totalBooks',
            'availableBooks',
            'borrowedBooks',
            'returnedBooks',
            'activeMembers',
            'overdueBooks',
            'damagedBooks',
            'fineCollection',
            'monthlyReports',
            'keyword',
            'searchBooks'
        ));
    }

    // Admin Profile
    public function profile()
    {
        $user = Auth::user();
        return view('admin.profile.index', compact('user'));
    }

    // ২. পরিবর্তন: DamagedBook মডেল ব্যবহার করা হয়েছে
    public function damagedBooks()
    {
        $damagedBooks = DamagedBook::with(['user', 'book'])
            ->latest()
            ->get();

        return view(
            'admin.damaged_books.index',
            compact('damagedBooks')
        );
    }
}