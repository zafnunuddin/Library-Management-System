<?php

namespace Database\Seeders;

use App\Models\LegalPage;
use Illuminate\Database\Seeder;

class LibraryRulesSeeder extends Seeder
{
    /**
     * Seeds the "Rules & Guidelines" tab on the student dashboard.
     *
     * This reuses the same legal_pages table/UI that already powers
     * /terms and /privacy-policy, so an admin can edit this content at
     * /admin/legal-pages/library-rules/edit without any extra screens.
     */
    public function run(): void
    {
        LegalPage::updateOrCreate(
            ['slug' => 'library-rules'],
            [
                'title' => 'Library Rules & Guidelines',
                'content' => $this->defaultContent(),
                'version' => 1,
            ]
        );
    }

    private function defaultContent(): string
    {
        return <<<'HTML'
<h5>Fine Calculation Policy</h5>
<table class="table table-dark table-striped mb-4">
    <thead>
        <tr>
            <th>Condition / Violation</th>
            <th>Fine Calculation / Action Rule</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>1&ndash;30 Days Overdue</td>
            <td><strong class="text-warning">Tk 5 per day</strong> calculated automatically from the due date.</td>
        </tr>
        <tr>
            <td>More than 30 Days Overdue</td>
            <td><strong class="text-danger">Temporary Library Suspension</strong> until dues are cleared.</td>
        </tr>
        <tr>
            <td>Lost Book</td>
            <td><strong class="text-danger">Replacement Cost + Tk 500 Processing Fee</strong></td>
        </tr>
        <tr>
            <td>Damaged Book</td>
            <td><strong class="text-danger">Replacement Cost + Tk 500 Processing Fee</strong></td>
        </tr>
    </tbody>
</table>

<h5>Library Rules &amp; Regulations</h5>
<ol>
    <li><strong>Book Return &amp; Due Dates:</strong> Students must return borrowed books before the due date. Late returns incur a daily penalty fee.</li>
    <li><strong>Suspension &amp; Fee Payment:</strong> Exceeding 30 overdue days results in temporary suspension. Fines must be paid to the administrative desk or via the online payment gateway.</li>
    <li><strong>Borrow Limit:</strong> A student may keep a maximum of 3 books issued at the same time.</li>
    <li><strong>Requesting a Book:</strong> Use "Browse Library Catalog" to request an available book. Your request stays under "Pending Request" until a librarian approves it.</li>
    <li><strong>Renewals:</strong> Contact the library desk before the due date to request a renewal, subject to demand from other students.</li>
</ol>
HTML;
    }
}
