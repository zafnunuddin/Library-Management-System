<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\User;
use App\Models\BookIssue;
use App\Models\BookReturn;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public function download()
    {
        $totalBooks = Book::sum('quantity');

        $availableBooks = Book::sum('available_quantity');

        $borrowedBooks = BookIssue::where('status','Issued')->count();

        $returnedBooks = BookIssue::where('status','Returned')->count();

        $activeMembers = User::where('role','user')->count();

        $overdueBooks = BookIssue::where('status','Issued')
            ->whereDate('return_deadline','<',now())
            ->count();

        $fineCollection = BookReturn::sum('fine');

        $pdf = Pdf::loadView('admin.report_pdf', compact(
            'totalBooks',
            'availableBooks',
            'borrowedBooks',
            'returnedBooks',
            'activeMembers',
            'overdueBooks',
            'fineCollection'
        ));

        return $pdf->download('Library_Report.pdf');
    }
}