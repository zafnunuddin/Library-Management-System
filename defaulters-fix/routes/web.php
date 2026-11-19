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
use App\Models\User;

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

// Login Page
Route::get('/login', [AuthController::class, 'login'])
    ->name('login');

// Login Process
Route::post('/login', [AuthController::class, 'authenticate'])
    ->name('login.post');

// Registration Page
Route::get('/register', [AuthController::class, 'register'])
    ->name('register');

// Registration Process
Route::post('/register', [AuthController::class, 'storeRegistration'])
    ->name('register.store');

// Logout
Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');


/*
|--------------------------------------------------------------------------
| Home Route
|--------------------------------------------------------------------------
*/

// Website open করলে Login page দেখাবে
Route::get('/', function () {
    return redirect()->route('login');
});


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Admin Dashboard
    |--------------------------------------------------------------------------
    */

    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])
        ->name('admin.dashboard');


    /*
    |--------------------------------------------------------------------------
    | Book Management
    |--------------------------------------------------------------------------
    */

    // Add Book Page
    Route::get('/add-book', function () {
        return view('admin.add_books.index');
    })->name('add_book');

    // Store Book
    Route::post('/books/store', [BookController::class, 'store'])
        ->name('books.store');

    // All Books
    Route::get('/all-books', [BookController::class, 'index'])
        ->name('all_books');

    // Edit Book
    Route::get('/books/{id}/edit', [BookController::class, 'edit'])
        ->name('books.edit');

    // Update Book
    Route::put('/books/{id}', [BookController::class, 'update'])
        ->name('books.update');

    // Delete Book
    Route::delete('/books/{id}', [BookController::class, 'destroy'])
        ->name('books.destroy');

    // Delete Book Photo
    Route::delete('/books/{id}/photo', [BookController::class, 'deletePhoto'])
        ->name('books.photo.delete');


    /*
    |--------------------------------------------------------------------------
    | Admin Search
    |--------------------------------------------------------------------------
    */

    Route::get('/search', [BookController::class, 'search'])
        ->name('search');

    Route::get('/admin/live-search', [BookController::class, 'liveSearch'])
        ->name('admin.live.search');

    Route::get('/admin/book/{id}', [BookController::class, 'getBook'])
        ->name('admin.book.details');


    /*
    |--------------------------------------------------------------------------
    | Issue Book
    |--------------------------------------------------------------------------
    */

    Route::get('/issue-book', [BookController::class, 'issueForm'])
        ->name('issue_book');

    Route::post('/issue-book', [BookController::class, 'issueStore'])
        ->name('issue.store');


    /*
    |--------------------------------------------------------------------------
    | Return Book
    |--------------------------------------------------------------------------
    */

    Route::get('/return-book', [BookController::class, 'returnForm'])
        ->name('return_book');

    Route::post('/return-book', [BookController::class, 'returnStore'])
        ->name('return.store');


    /*
    |--------------------------------------------------------------------------
    | Users
    |--------------------------------------------------------------------------
    */

    Route::get('/users', function () {

    $users = User::orderByRaw("CASE WHEN role = 'admin' THEN 0 ELSE 1 END")
                 ->orderBy('id', 'asc')
                 ->get();

    return view('admin.users.index', compact('users'));

})->name('users');

    /*
    |--------------------------------------------------------------------------
    | Reports
    |--------------------------------------------------------------------------
    */

    Route::get('/reports', function () {
        return view('admin.reports.index');
    })->name('reports');

    Route::get('/report/download', [ReportController::class, 'download'])
        ->name('report.download');


    /*
    |--------------------------------------------------------------------------
    | Admin Profile
    |--------------------------------------------------------------------------
    */

    // Profile
    Route::get('/admin/profile', [ProfileController::class, 'index'])
        ->name('profile');

    // Edit Profile
    Route::get('/admin/profile/edit', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    // Update Profile
    Route::post('/admin/profile/update', [ProfileController::class, 'update'])
        ->name('profile.update');

    // Delete Profile Photo
    Route::delete('/admin/profile/photo', [ProfileController::class, 'deletePhoto'])
        ->name('profile.photo.delete');

    // Change Password Page
    Route::get('/admin/change-password', [ProfileController::class, 'changePassword'])
        ->name('password.change');

    // Update Password
    Route::post('/admin/change-password', [ProfileController::class, 'updatePassword'])
        ->name('password.update');

    /*
    |--------------------------------------------------------------------------
    | Defaulters List & Email Notices
    |--------------------------------------------------------------------------
    */
    Route::get('/defaulters', [DefaulterController::class, 'index'])
        ->name('defaulters');

    Route::post('/defaulters/{issue}/mail', [DefaulterController::class, 'mailOne'])
        ->name('defaulters.mail');

    Route::post('/defaulters/mail-all', [DefaulterController::class, 'mailAll'])
        ->name('defaulters.mail_all');

});


/*
|--------------------------------------------------------------------------
| Student / User Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | User Dashboard
    |--------------------------------------------------------------------------
    */

    Route::get('/user/dashboard', [UserController::class, 'dashboard'])
        ->name('user.dashboard');


    /*
    |--------------------------------------------------------------------------
    | User Profile
    |--------------------------------------------------------------------------
    */

    Route::get('/user/profile', [UserController::class, 'profile'])
        ->name('user.profile');

    Route::post('/user/profile/update', [UserController::class, 'updateProfile'])
        ->name('user.profile.update');


    /*
    |--------------------------------------------------------------------------
    | Borrowed Books
    |--------------------------------------------------------------------------
    */

    Route::get('/user/borrowed-books', [UserController::class, 'borrowedBooks'])
        ->name('user.borrowed');


    /*
    |--------------------------------------------------------------------------
    | Search Books
    |--------------------------------------------------------------------------
    */

    Route::get('/user/search-books', [UserController::class, 'search'])
        ->name('user.search');


    /*
    |--------------------------------------------------------------------------
    | User Settings
    |--------------------------------------------------------------------------
    */

    Route::get('/user/settings', function () {
        return view('user.settings.index');
    })->name('user.settings');

});

Route::get('/damaged-books', [AdminController::class, 'damagedBooks'])
    ->name('damaged_books');

Route::get('/admin/issued-users', [IssueController::class, 'issuedUsers'])
    ->name('admin.issued.users');