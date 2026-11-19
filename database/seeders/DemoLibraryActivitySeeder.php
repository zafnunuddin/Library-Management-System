<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\BookIssue;
use App\Models\BookRequest;
use App\Models\BookReturn;
use App\Models\User;
use Illuminate\Database\Seeder;

class DemoLibraryActivitySeeder extends Seeder
{
    /**
     * Populates every tab of the demo student's dashboard (Issued Books &
     * Pay, Pending Request, Request History) with realistic sample data.
     * Safe to run more than once — every row is looked up before creating.
     */
    public function run(): void
    {
        $student = User::where('email', 'student@edu.bd')->first();

        if (! $student) {
            return;
        }

        $bookByTitle = fn (string $title) => Book::where('title', $title)->first();

        // --- Currently issued: due soon (no fine yet) ---------------------
        $this->issue(
            $student,
            $bookByTitle('Operating System Concepts'),
            now()->subDays(13),
            now()->addDay()
        );

        // --- Currently issued: safe, plenty of time left ------------------
        $this->issue(
            $student,
            $bookByTitle('Artificial Intelligence: A Modern Approach'),
            now()->subDays(3),
            now()->addDays(11)
        );

        // --- Currently issued: overdue with an unpaid fine -----------------
        // (Data Structures in C++ is intentionally out of stock in
        // BookSeeder, this is that copy.)
        $this->issue(
            $student,
            $bookByTitle('Data Structures in C++'),
            now()->subDays(30),
            now()->subDays(15)
        );

        // --- Previously borrowed & returned --------------------------------
        $this->issueAndReturn(
            $student,
            $bookByTitle('Clean Code'),
            now()->subMonths(6)->subDays(14),
            now()->subMonths(6),
            now()->subMonths(6)
        );

        $this->issueAndReturn(
            $student,
            $bookByTitle('Intro to Mathematical Statistics'),
            now()->subMonths(5)->subDays(14),
            now()->subMonths(5),
            now()->subMonths(5)
        );

        // --- A request still waiting on the librarian ----------------------
        BookRequest::firstOrCreate(
            [
                'user_id' => $student->id,
                'book_id' => $bookByTitle('Contract Law')->id,
                'status' => 'Pending',
            ]
        );

        // --- A request the librarian already turned down --------------------
        BookRequest::firstOrCreate(
            [
                'user_id' => $student->id,
                'book_id' => $bookByTitle('Principles of Management')->id,
                'status' => 'Rejected',
            ]
        );
    }

    /**
     * Create an active "Issued" record for $book, decrementing stock only
     * the first time it's created.
     */
    private function issue(User $student, ?Book $book, $issueDate, $dueDate): void
    {
        if (! $book) {
            return;
        }

        $issue = BookIssue::firstOrCreate(
            [
                'user_id' => $student->id,
                'book_id' => $book->id,
                'status' => 'Issued',
            ],
            [
                'issue_date' => $issueDate->toDateString(),
                'return_deadline' => $dueDate->toDateString(),
            ]
        );

        if ($issue->wasRecentlyCreated && $book->available_quantity > 0) {
            $book->decrement('available_quantity');
        }
    }

    /**
     * Create a fully returned issue + return record for the
     * "Previously Borrowed" history table.
     */
    private function issueAndReturn(User $student, ?Book $book, $issueDate, $dueDate, $returnedDate): void
    {
        if (! $book) {
            return;
        }

        $issue = BookIssue::firstOrCreate(
            [
                'user_id' => $student->id,
                'book_id' => $book->id,
                'status' => 'Returned',
            ],
            [
                'issue_date' => $issueDate->toDateString(),
                'return_deadline' => $dueDate->toDateString(),
            ]
        );

        BookReturn::firstOrCreate(
            ['issue_id' => $issue->id],
            [
                'book_id' => $book->id,
                'actual_return_date' => $returnedDate->toDateString(),
                'fine' => 0,
                'book_price' => 0,
                'late_fee' => 0,
                'fine_paid' => true,
                'condition' => 'Good',
            ]
        );
    }
}
