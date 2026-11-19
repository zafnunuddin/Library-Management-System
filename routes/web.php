<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Admin\IssueController;
use App\Http\Controllers\Admin\DefaulterController;
use App\Http\Controllers\Admin\RequestController as AdminRequestController;
use App\Http\Controllers\Admin\LegalPageController;
use App\Http\Controllers\LegalController;
use App\Http\Controllers\User\BookRequestController;
use App\Http\Controllers\User\PaymentController;
use App\Models\User;
use App\Http\Controllers\DamagedBookController;
use App\Http\Controllers\Admin\AdminPaymentController;
/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

// Login Page
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('login.post');

// Registration Page
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'storeRegistration'])->name('register.store');

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


/*
|--------------------------------------------------------------------------
| Password Reset
|--------------------------------------------------------------------------
*/
Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');
Route::get('/reset-password/{token}', [AuthController::class, 'showResetPassword'])->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.reset.update');


/*
|--------------------------------------------------------------------------
| Legal Pages (Public)
|--------------------------------------------------------------------------
*/
Route::get('/terms', [LegalController::class, 'show'])->name('terms')->defaults('slug', 'terms');
Route::get('/privacy-policy', [LegalController::class, 'show'])->name('privacy')->defaults('slug', 'privacy-policy');


/*
|--------------------------------------------------------------------------
| Home Route
|--------------------------------------------------------------------------
*/
Route::get('/', [BookController::class, 'home'])->name('home');


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    /* Admin Dashboard */
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    /* Book Management */
    // Add Book Page (FIXED: Route Name 'books.create' ও 'add_book' দুটোই যোগ করা হয়েছে)
    Route::get('/add-book', function () {
        return view('admin.add_books.index');
    })->name('add_book');
    
    Route::get('/books/create', function () {
        return view('admin.add_books.index');
    })->name('books.create');

    Route::post('/books/store', [BookController::class, 'store'])->name('books.store');
    Route::get('/all-books', [BookController::class, 'index'])->name('all_books');
    Route::get('/books/{id}/edit', [BookController::class, 'edit'])->name('books.edit');
    Route::put('/books/{id}', [BookController::class, 'update'])->name('books.update');
    Route::delete('/books/{id}', [BookController::class, 'destroy'])->name('books.destroy');
    Route::delete('/books/{id}/photo', [BookController::class, 'deletePhoto'])->name('books.photo.delete');

    /* Admin Search */
    Route::get('/search', [BookController::class, 'search'])->name('search');
    Route::get('/admin/live-search', [BookController::class, 'liveSearch'])->name('admin.live.search');
    Route::get('/admin/book/{id}', [BookController::class, 'getBook'])->name('admin.book.details');

    /* Issue Book */
    Route::get('/issue-book', [BookController::class, 'issueForm'])->name('issue_book');
    Route::post('/issue-book', [BookController::class, 'issueStore'])->name('issue.store');

    /* Return Book */
    Route::get('/return-book', [BookController::class, 'returnForm'])->name('return_book');
    Route::post('/return-book', [BookController::class, 'returnStore'])->name('return.store');

    /* Users List */
    Route::get('/users', function () {
        $users = User::orderByRaw("CASE WHEN role = 'admin' THEN 0 ELSE 1 END")
                     ->orderBy('id', 'asc')
                     ->get();
        return view('admin.users.index', compact('users'));
    })->name('users');

    /* Reports */
    Route::get('/reports', function () {
        return view('admin.reports.index');
    })->name('reports');
    Route::get('/report/download', [ReportController::class, 'download'])->name('report.download');

    /* Admin Profile */
    Route::get('/admin/profile', [ProfileController::class, 'index'])->name('profile');
    Route::get('/admin/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/admin/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/admin/profile/photo', [ProfileController::class, 'deletePhoto'])->name('profile.photo.delete');
    Route::get('/admin/change-password', [ProfileController::class, 'changePassword'])->name('password.change');
    Route::post('/admin/change-password', [ProfileController::class, 'updatePassword'])->name('password.update');

    /* Defaulters List */
    Route::get('/defaulters', [DefaulterController::class, 'index'])->name('defaulters');
    Route::post('/defaulters/{issue}/mail', [DefaulterController::class, 'mailOne'])->name('defaulters.mail');
    Route::post('/defaulters/mail-all', [DefaulterController::class, 'mailAll'])->name('defaulters.mail_all');

    /* Book Requests */
    Route::get('/requests', [AdminRequestController::class, 'index'])->name('requests.index');
    Route::post('/requests/{bookRequest}/approve', [AdminRequestController::class, 'approve'])->name('requests.approve');
    Route::post('/requests/{bookRequest}/reject', [AdminRequestController::class, 'reject'])->name('requests.reject');
    Route::post('/requests/{bookRequest}/handover', [AdminRequestController::class, 'confirmHandover'])->name('requests.handover');

    /* Legal Pages Admin */
    Route::get('/admin/legal-pages', [LegalPageController::class, 'index'])->name('admin.legal.index');
    Route::get('/admin/legal-pages/{slug}/edit', [LegalPageController::class, 'edit'])->name('admin.legal.edit');
    Route::put('/admin/legal-pages/{slug}', [LegalPageController::class, 'update'])->name('admin.legal.update');

    /* Damaged Books (Admin) */
   Route::get('/damaged-books', [AdminController::class, 'damagedBooks'])->name('admin.damaged.books');
    Route::get('/admin/issued-users', [IssueController::class, 'issuedUsers'])->name('admin.issued.users');
});


/*
|--------------------------------------------------------------------------
| Student / User Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    Route::get('/user/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
    Route::get('/user/profile', [UserController::class, 'profile'])->name('user.profile');
    Route::post('/user/profile/update', [UserController::class, 'updateProfile'])->name('user.profile.update');
    Route::get('/user/borrowed-books', [UserController::class, 'borrowedBooks'])->name('user.borrowed');
    Route::get('/user/search-books', [UserController::class, 'search'])->name('user.search');

    /* Payments */
    Route::post('/user/issues/{issue}/pay-fine', [PaymentController::class, 'pay'])->name('user.issues.pay');
    Route::get('/payment/{issueId}', [PaymentController::class, 'create'])->name('payment.create');
    Route::post('/payment/{issueId}', [PaymentController::class, 'pay'])->name('payment.pay');
    Route::get('/payment-success/{paymentId}', [PaymentController::class, 'success'])->name('payment.success');
    Route::middleware(['auth'])->group(function () {
    // ড্যাশবোর্ডের রাউট
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
    
    // পেমেন্ট হিস্ট্রি যদি আলাদা পেজেও এক্সেস রাখতে চান (Optional)
    Route::get('/payment-history', [PaymentController::class, 'history'])->name('payment.history');
});

    /* Book Requests */
    Route::post('/user/books/{book}/request', [BookRequestController::class, 'store'])->name('user.books.request');
    Route::delete('/user/requests/{bookRequest}/cancel', [BookRequestController::class, 'cancel'])->name('user.requests.cancel');

    /* User Settings */
    Route::get('/user/settings', function () {
        return view('user.settings.index');
    })->name('user.settings');
});

/* Single Book Details */
Route::get('/book/{id}', [BookController::class, 'details'])->name('book.details');


/* Book History Route */
Route::get('/user/book-history', [UserController::class, 'bookHistory'])->name('user.book.history');

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    
    // Payment Routes
    Route::get('/payments', [AdminPaymentController::class, 'index'])->name('payments.index');
    Route::patch('/payments/{id}/approve', [AdminPaymentController::class, 'approve'])->name('payments.approve');

});