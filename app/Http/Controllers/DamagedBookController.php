<?php

namespace App\Http\Controllers;

use App\Models\DamagedBook;
use Illuminate\Http\Request;

class DamagedBookController extends Controller
{
    public function index()
    {
        // সম্পর্কের (relationships) জন্য book এবং user ইগার লোড করা হলো
        $damagedBooks = DamagedBook::with(['book', 'user'])->latest()->get();

        return view('admin.damaged_books.index', compact('damagedBooks'));
    }

    public function destroy($id)
    {
        $damaged = DamagedBook::findOrFail($id);
        $damaged->delete();

        return redirect()->back()->with('success', 'Damaged book record deleted successfully.');
    }

    public function damagedBooks()
{
    // BookReturn এর বদলে DamagedBook মডেল ব্যবহার করুন
    $damagedBooks = DamagedBook::with(['user', 'book'])
        ->latest()
        ->get();

    return view(
        'admin.damaged_books.index',
        compact('damagedBooks')
    );
}
}