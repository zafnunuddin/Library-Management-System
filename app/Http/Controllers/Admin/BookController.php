<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\BookIssue;
use App\Models\BookReturn;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\DamagedBook;

class BookController extends Controller
{
    //all books
    public function index()
{
    $books = Book::orderBy('id', 'asc')->get();

    return view(
        'admin.all_books.index',
        compact('books')
    );
}
//add book
    public function store(Request $request)
{
    $request->validate([

        'title' => 'required',
        'author' => 'required',
        'edition' => 'required',
        'genre' => 'required',
        'quantity' => 'required|integer|min:1',

        // Book Details
        'serial_no' => 'nullable|string|max:100|unique:books,serial_no',
        'isbn' => 'nullable|string|max:50',
        'language' => 'nullable|string|max:100',
        'publisher' => 'nullable|string|max:255',
        'publication_year' => 'nullable|integer|min:1000|max:9999',
        'printing_no' => 'nullable|string|max:100',
        'publication_place' => 'nullable|string|max:255',
        'shelf_location' => 'nullable|string|max:100',

        // Book Information
        'past_edition' => 'nullable|string',
        'new_edition' => 'nullable|string',
        'description' => 'nullable|string',
        'book_abstract' => 'nullable|string',
        'table_of_contents' => 'nullable|string',

        // Main Book Cover
        'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

        // Preview Images
        'preview_cover' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        'preview_page_1' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        'preview_page_2' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        'preview_page_3' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        'preview_page_4' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
    ]);


    /*
    |--------------------------------------------------------------------------
    | Main Book Cover
    |--------------------------------------------------------------------------
    */

    $photo = "default-book.jpg";

    if ($request->hasFile('photo')) {

        $photo = $request->file('photo')
            ->store('books', 'public');
    }


    /*
    |--------------------------------------------------------------------------
    | Preview Cover
    |--------------------------------------------------------------------------
    */

    $previewCover = null;

    if ($request->hasFile('preview_cover')) {

        $previewCover = $request->file('preview_cover')
            ->store('book-previews', 'public');
    }


    /*
    |--------------------------------------------------------------------------
    | Preview Page 1
    |--------------------------------------------------------------------------
    */

    $previewPage1 = null;

    if ($request->hasFile('preview_page_1')) {

        $previewPage1 = $request->file('preview_page_1')
            ->store('book-previews', 'public');
    }


    /*
    |--------------------------------------------------------------------------
    | Preview Page 2
    |--------------------------------------------------------------------------
    */

    $previewPage2 = null;

    if ($request->hasFile('preview_page_2')) {

        $previewPage2 = $request->file('preview_page_2')
            ->store('book-previews', 'public');
    }


    /*
    |--------------------------------------------------------------------------
    | Preview Page 3
    |--------------------------------------------------------------------------
    */

    $previewPage3 = null;

    if ($request->hasFile('preview_page_3')) {

        $previewPage3 = $request->file('preview_page_3')
            ->store('book-previews', 'public');
    }


    /*
    |--------------------------------------------------------------------------
    | Preview Page 4
    |--------------------------------------------------------------------------
    */

    $previewPage4 = null;

    if ($request->hasFile('preview_page_4')) {

        $previewPage4 = $request->file('preview_page_4')
            ->store('book-previews', 'public');
    }


    /*
    |--------------------------------------------------------------------------
    | Serial No (auto-generate when left blank)
    |--------------------------------------------------------------------------
    */

    $serialNo = $request->serial_no;

    if (!$serialNo) {

        $prefix = collect(explode(' ', $request->genre))
            ->map(fn ($word) => strtoupper(substr($word, 0, 3)))
            ->implode('-');

        $nextId = (Book::max('id') ?? 0) + 1;

        $serialNo = $prefix . '-BK-' . str_pad($nextId, 3, '0', STR_PAD_LEFT);

        while (Book::where('serial_no', $serialNo)->exists()) {
            $nextId++;
            $serialNo = $prefix . '-BK-' . str_pad($nextId, 3, '0', STR_PAD_LEFT);
        }
    }


    /*
    |--------------------------------------------------------------------------
    | Save Book
    |--------------------------------------------------------------------------
    */

    Book::create([

        // Basic Information
        'title' => $request->title,
        'author' => $request->author,
        'edition' => $request->edition,
        'genre' => $request->genre,
        'serial_no' => $serialNo,

        // Quantity
        'quantity' => $request->quantity,
        'available_quantity' => $request->quantity,

        // Book Details
        'isbn' => $request->isbn,
        'language' => $request->language,
        'publisher' => $request->publisher,
        'publication_year' => $request->publication_year,
        'printing_no' => $request->printing_no,
        'publication_place' => $request->publication_place,
        'shelf_location' => $request->shelf_location,

        // Edition Information
        'past_edition' => $request->past_edition,
        'new_edition' => $request->new_edition,

        // Description & Abstract
        'description' => $request->description,
        'book_abstract' => $request->book_abstract,

        // Table of Contents
        'table_of_contents' => $request->table_of_contents,

        // Main Cover
        'photo' => $photo,

        // Preview Images
        'preview_cover' => $previewCover,
        'preview_page_1' => $previewPage1,
        'preview_page_2' => $previewPage2,
        'preview_page_3' => $previewPage3,
        'preview_page_4' => $previewPage4,

        // Status
        'status' => $request->quantity > 0
            ? 'Available'
            : 'Out of Stock',

        // Upload Time
        'uploaded_at' => now(),
    ]);


    return back()->with(
        'success',
        'Book Added Successfully'
    );
}
          //edit
public function edit($id)
{
    $book = Book::findOrFail($id);

    return view('admin.edit.index', compact('book'));
}

public function update(Request $request, $id)
{
    $book = Book::findOrFail($id);

    $request->validate([

        // Basic Information
        'title' => 'required|string|max:255',
        'author' => 'required|string|max:255',
        'edition' => 'required|string|max:100',
        'genre' => 'required|string|max:100',
        'quantity' => 'required|integer|min:1',

        // Book Details
        'serial_no' => 'nullable|string|max:100|unique:books,serial_no,' . $id,
        'isbn' => 'nullable|string|max:50',
        'language' => 'nullable|string|max:100',
        'publisher' => 'nullable|string|max:255',
        'publication_year' => 'nullable|integer|min:1000|max:9999',
        'printing_no' => 'nullable|string|max:100',
        'publication_place' => 'nullable|string|max:255',
        'shelf_location' => 'nullable|string|max:100',

        // Book Information
        'past_edition' => 'nullable|string',
        'new_edition' => 'nullable|string',
        'description' => 'nullable|string',
        'book_abstract' => 'nullable|string',
        'table_of_contents' => 'nullable|string',

        // Main Cover
        'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

        // Preview Images
        'preview_cover' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        'preview_page_1' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        'preview_page_2' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        'preview_page_3' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        'preview_page_4' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

    ]);


    /*
    |--------------------------------------------------------------------------
    | Basic Information
    |--------------------------------------------------------------------------
    */

    $book->title = $request->title;
    $book->author = $request->author;
    $book->edition = $request->edition;
    $book->genre = $request->genre;

    if ($request->filled('serial_no')) {
        $book->serial_no = $request->serial_no;
    }


    /*
    |--------------------------------------------------------------------------
    | Quantity
    |--------------------------------------------------------------------------
    */

    $oldQuantity = $book->quantity;

    $book->quantity = $request->quantity;

    /*
    | Keep issued books count correct
    */

    $issuedBooks = $oldQuantity - $book->available_quantity;

    if ($issuedBooks < 0) {
        $issuedBooks = 0;
    }

    $book->available_quantity =
        $request->quantity - $issuedBooks;

    if ($book->available_quantity < 0) {
        $book->available_quantity = 0;
    }


    /*
    |--------------------------------------------------------------------------
    | Book Details
    |--------------------------------------------------------------------------
    */

    $book->isbn = $request->isbn;

    $book->language = $request->language;

    $book->publisher = $request->publisher;

    $book->publication_year = $request->publication_year;

    $book->printing_no = $request->printing_no;

    $book->publication_place = $request->publication_place;

    $book->shelf_location = $request->shelf_location;


    /*
    |--------------------------------------------------------------------------
    | Edition Information
    |--------------------------------------------------------------------------
    */

    $book->past_edition = $request->past_edition;

    $book->new_edition = $request->new_edition;


    /*
    |--------------------------------------------------------------------------
    | Description & Abstract
    |--------------------------------------------------------------------------
    */

    $book->description = $request->description;

    $book->book_abstract = $request->book_abstract;


    /*
    |--------------------------------------------------------------------------
    | Table of Contents
    |--------------------------------------------------------------------------
    */

    $book->table_of_contents =
        $request->table_of_contents;


    /*
    |--------------------------------------------------------------------------
    | Main Book Cover
    |--------------------------------------------------------------------------
    */

    if ($request->hasFile('photo')) {

        if (
            $book->photo &&
            $book->photo !== 'default-book.jpg' &&
            Storage::disk('public')->exists($book->photo)
        ) {

            Storage::disk('public')->delete(
                $book->photo
            );
        }

        $book->photo =
            $request->file('photo')
                ->store('books', 'public');
    }


    /*
    |--------------------------------------------------------------------------
    | Preview Cover
    |--------------------------------------------------------------------------
    */

    if ($request->hasFile('preview_cover')) {

        if (
            $book->preview_cover &&
            Storage::disk('public')->exists(
                $book->preview_cover
            )
        ) {

            Storage::disk('public')->delete(
                $book->preview_cover
            );
        }

        $book->preview_cover =
            $request->file('preview_cover')
                ->store('book-previews', 'public');
    }


    /*
    |--------------------------------------------------------------------------
    | Preview Page 1
    |--------------------------------------------------------------------------
    */

    if ($request->hasFile('preview_page_1')) {

        if (
            $book->preview_page_1 &&
            Storage::disk('public')->exists(
                $book->preview_page_1
            )
        ) {

            Storage::disk('public')->delete(
                $book->preview_page_1
            );
        }

        $book->preview_page_1 =
            $request->file('preview_page_1')
                ->store('book-previews', 'public');
    }


    /*
    |--------------------------------------------------------------------------
    | Preview Page 2
    |--------------------------------------------------------------------------
    */

    if ($request->hasFile('preview_page_2')) {

        if (
            $book->preview_page_2 &&
            Storage::disk('public')->exists(
                $book->preview_page_2
            )
        ) {

            Storage::disk('public')->delete(
                $book->preview_page_2
            );
        }

        $book->preview_page_2 =
            $request->file('preview_page_2')
                ->store('book-previews', 'public');
    }


    /*
    |--------------------------------------------------------------------------
    | Preview Page 3
    |--------------------------------------------------------------------------
    */

    if ($request->hasFile('preview_page_3')) {

        if (
            $book->preview_page_3 &&
            Storage::disk('public')->exists(
                $book->preview_page_3
            )
        ) {

            Storage::disk('public')->delete(
                $book->preview_page_3
            );
        }

        $book->preview_page_3 =
            $request->file('preview_page_3')
                ->store('book-previews', 'public');
    }


    /*
    |--------------------------------------------------------------------------
    | Preview Page 4
    |--------------------------------------------------------------------------
    */

    if ($request->hasFile('preview_page_4')) {

        if (
            $book->preview_page_4 &&
            Storage::disk('public')->exists(
                $book->preview_page_4
            )
        ) {

            Storage::disk('public')->delete(
                $book->preview_page_4
            );
        }

        $book->preview_page_4 =
            $request->file('preview_page_4')
                ->store('book-previews', 'public');
    }


    /*
    |--------------------------------------------------------------------------
    | Status
    |--------------------------------------------------------------------------
    */

    $book->status =
        $book->available_quantity > 0
            ? 'Available'
            : 'Out of Stock';


    /*
    |--------------------------------------------------------------------------
    | Save
    |--------------------------------------------------------------------------
    */

    $book->save();


    /*
    |--------------------------------------------------------------------------
    | Success
    |--------------------------------------------------------------------------
    */

    return redirect()
        ->route('all_books')
        ->with(
            'success',
            'Book Updated Successfully'
        );
}

public function destroy($id)
{
    $book = Book::findOrFail($id);

    // ছবি delete (যদি থাকে)
    if ($book->photo && \Storage::disk('public')->exists($book->photo)) {
        \Storage::disk('public')->delete($book->photo);
    }

    $book->delete();

    return redirect()->route('all_books')
        ->with('success', 'Book Deleted Successfully');
}

public function issueForm()
{
    $users = User::where('role', 'user')->get();

    $books = Book::where('available_quantity', '>', 0)->get();

    return view(
        'admin.issue.index',
        compact('users', 'books')
    );
}

public function issueStore(Request $request)
{
    $request->validate([
        'user_id' => 'required|exists:users,id',
        'book_id' => 'required|exists:books,id',
        'issue_date' => 'required|date',
        'return_date' => 'required|date',
    ]);

    $book = Book::findOrFail($request->book_id);

    if ($book->available_quantity <= 0)
    {
        return back()->with(
            'error',
            'Book is Out of Stock'
        );
    }

    BookIssue::create([

        'user_id' => $request->user_id,

        'book_id' => $request->book_id,

        'issue_date' => $request->issue_date,

        'return_deadline' => $request->return_date,

        'status' => 'Issued',

    ]);

    $book->decrement('available_quantity');

    $book->save();

    return back()->with(
        'success',
        'Book Issued Successfully'
    );
}
public function returnForm()
{
    $issues = BookIssue::with('user', 'book')
        ->where('status', 'Issued')
        ->get();

    return view(
        'admin.return.index',
        compact('issues')
    );
}

public function returnStore(Request $request)
{
    $request->validate([
        'issue_id' => 'required|exists:book_issues,id',
        'actual_return_date' => 'required|date',
        'fine' => 'nullable|numeric',
        'fine_paid' => 'required|boolean',
        'condition' => 'nullable|string',
        'damage_photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        'notice' => 'nullable|string',
        'return_type' => 'required|in:normal,overdue,damaged',
        'book_price' => 'nullable|numeric|min:0'
    ]);

    // Find Issue
    $issue = BookIssue::with('book', 'user')->findOrFail($request->issue_id);

    // Prevent double return
    if ($issue->status === 'Returned') {
        return back()->with('error', 'This book has already been returned.');
    }

    // Find Book
    $book = Book::findOrFail($issue->book_id);

    // Calculate Late Fee
    $lateDays = 0;
    $lateFee = 0;
    $deadline = \Carbon\Carbon::parse($issue->return_deadline);
    $actualReturnDate = \Carbon\Carbon::parse($request->actual_return_date);

    if ($actualReturnDate->greaterThan($deadline)) {
        $lateDays = $deadline->diffInDays($actualReturnDate);
        $lateFee = $lateDays * 5; // ৳5 per day
    }

    $bookPrice = 0;
    $damagePhoto = null;

    if ($request->return_type === 'normal') {
        $condition = 'Good';
        $fine = 0;
        $lateFee = 0;
        $book->increment('available_quantity');
    } 
    elseif ($request->return_type === 'overdue') {
        $condition = 'Good';
        $fine = $lateFee;
        $book->increment('available_quantity');
    } 
    else { // Damaged Return
        $condition = 'Damaged';
        $bookPrice = $request->book_price ?? 0;
        $fine = $bookPrice + $lateFee;

        if ($request->hasFile('damage_photo')) {
            $damagePhoto = $request->file('damage_photo')->store('damaged_photos', 'public');
        }

        // ১. DamagedBook টেবিলে ডাটা Insert করা
        DamagedBook::create([
            'book_id' => $issue->book_id,
            'user_id' => $issue->user_id,
            'quantity' => 1,
            'book_price' => $bookPrice,
            'late_fee' => $lateFee,
            'damage_photo' => $damagePhoto ?? 'default-book.jpg',
            'notice' => $request->notice,
            'return_date' => $request->actual_return_date,
        ]);

        // ২. মূল Library Inventory থেকে মোট Quantity কমানো
        if ($book->quantity > 0) {
            $book->decrement('quantity');
        }
        if ($book->available_quantity > 0) {
            $book->decrement('available_quantity');
        }
    }

    // Update Book Status
    $book->status = $book->available_quantity > 0 ? 'Available' : 'Out of Stock';
    $book->save();

    // Save Return Record (BookReturn টেবিলেও ইতিহাস রাখার জন্য)
    BookReturn::create([
        'issue_id' => $issue->id,
        'book_id' => $issue->book_id,
        'actual_return_date' => $request->actual_return_date,
        'fine' => $fine,
        'book_price' => $bookPrice,
        'late_fee' => $lateFee,
        'fine_paid' => $request->fine_paid,
        'damage_photo' => $damagePhoto ?? 'default-book.jpg',
        'notice' => $request->notice,
        'condition' => $condition,
    ]);

    // Update Issue Status
    $issue->status = 'Returned';
    $issue->save();

    // Response Flash Message
    if ($request->return_type === 'normal') {
        $message = 'Book Returned Successfully.';
    } elseif ($request->return_type === 'overdue') {
        $message = 'Book Returned Successfully. Late Fee: ৳' . $lateFee;
    } else {
        $message = 'Damaged Book Returned Successfully. Total Payable: ৳' . $fine;
    }

    return redirect()->back()->with('success', $message);
}
public function search(Request $request)
{
    return redirect()->route('admin.dashboard', [
        'keyword' => $request->keyword
    ]);
}

public function liveSearch(Request $request)
{
    $search = $request->search;

    $books = Book::where('title', 'LIKE', "%{$search}%")
        ->orWhere('author', 'LIKE', "%{$search}%")
        ->orWhere('genre', 'LIKE', "%{$search}%")
        ->orWhere('edition', 'LIKE', "%{$search}%")
        ->orderBy('title', 'asc')
        ->limit(8)
        ->get([
            'id',
            'title',
            'author',
            'genre',
            'edition',
            'photo',
            'available_quantity'
        ]);

    return response()->json($books);
}

public function getBook($id)
{
    $book = Book::findOrFail($id);

    return view('admin.book_details.index', compact('book'));
}

public function deletePhoto($id)
{
    $book = Book::findOrFail($id);

    if ($book->photo && Storage::disk('public')->exists($book->photo)) {
        Storage::disk('public')->delete($book->photo);
    }

    $book->photo = null;
    $book->save();

    return back()->with('success', 'Book photo deleted successfully.');
}


public function publicBookDetails($id)
{
    $book = Book::findOrFail($id);

    return view('book_details', compact('book'));
}

public function home()
{
    // Total book copies
    $totalBooks = Book::sum('quantity');

    // Total registered students/users
    $totalMembers = User::where('role', 'user')->count();

    // Total different categories/genres
    $totalCategories = Book::whereNotNull('genre')
        ->where('genre', '!=', '')
        ->distinct('genre')
        ->count('genre');

    // Featured books
    $books = Book::latest()->take(8)->get();

    return view('home', compact(
        'books',
        'totalBooks',
        'totalMembers',
        'totalCategories'
    ));
}

public function details($id)
{
    $book = Book::findOrFail($id);

    return view('book-details', compact('book'));
}

public function storeReturn(Request $request)
{
    // ... Validation Rules ...

    if ($request->return_type === 'damaged') {
        
        // ১. Damaged Record Save
        $damagedBook = new DamagedBook();
        $damagedBook->book_id = $issue->book_id;
        $damagedBook->user_id = $issue->user_id;
        $damagedBook->quantity = 1; // অথবা ইনপুট ফিল্ড থেকে নেওয়া সংখ্যা
        $damagedBook->book_price = $request->book_price;
        $damagedBook->late_fee = $request->fine;
        $damagedBook->notice = $request->notice;
        
        if ($request->hasFile('damage_photo')) {
            $damagedBook->damage_photo = $request->file('damage_photo')->store('damaged_photos', 'public');
        }
        $damagedBook->save();

        // ২. মূল Library Inventory থেকে সংখ্যা কমানো
        $book = Book::find($issue->book_id);
        if ($book && $book->quantity > 0) {
            $book->decrement('quantity', 1);
        }
    }

    return redirect()->back()->with('success', 'Return processed successfully!');
}



}