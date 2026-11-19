<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\DefaulterNotice;
use App\Models\BookIssue;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class DefaulterController extends Controller
{
    /**
     * Show the list of current defaulters (overdue, not yet returned books).
     */
    public function index()
    {
        $defaulters = $this->getDefaulters();

        return view('defaulters', compact('defaulters'));
    }

    /**
     * Send an overdue reminder email to a single defaulter.
     */
    public function mailOne(BookIssue $issue)
    {
        $issue->load(['user', 'book', 'returns']);

        if (! $issue->user || ! $issue->user->email) {
            return back()->with('error', 'This student has no email address on file.');
        }

        if ($issue->returns) {
            return back()->with('error', 'This book has already been returned.');
        }

        [$overdueDays, $fineAmount] = $this->calculateOverdue($issue);

        if ($overdueDays <= 0) {
            return back()->with('error', 'This book is not overdue yet.');
        }

        try {
            Mail::to($issue->user->email)
                ->send(new DefaulterNotice($issue, $overdueDays, $fineAmount));

            return back()->with('success', 'Reminder email sent to ' . $issue->user->name . '.');
        } catch (\Throwable $e) {
            Log::error('Defaulter mail failed: ' . $e->getMessage());

            return back()->with('error', 'Failed to send email. Please try again later.');
        }
    }

    /**
     * Send an overdue reminder email to every current defaulter.
     */
    public function mailAll()
    {
        $defaulters = $this->getDefaulters();

        $sent = 0;
        $failed = 0;

        foreach ($defaulters as $row) {
            $issue = $row['issue'];

            if (! $issue->user || ! $issue->user->email) {
                $failed++;
                continue;
            }

            try {
                Mail::to($issue->user->email)
                    ->send(new DefaulterNotice($issue, $row['overdueDays'], $row['fine']));

                $sent++;
            } catch (\Throwable $e) {
                Log::error('Defaulter bulk mail failed for issue #' . $issue->id . ': ' . $e->getMessage());
                $failed++;
            }
        }

        if ($sent === 0) {
            return back()->with('error', 'No emails could be sent. Please check student email addresses.');
        }

        $message = "Reminder emails sent to {$sent} defaulter(s).";

        if ($failed > 0) {
            $message .= " {$failed} could not be emailed.";
        }

        return back()->with('success', $message);
    }

    /**
     * Build the list of current defaulters with their overdue days and fine.
     */
    private function getDefaulters()
    {
        $finePerDay = optional(Setting::first())->fine_per_day ?? 0;

        $issues = BookIssue::with(['user', 'book', 'returns'])
            ->whereDoesntHave('returns')
            ->whereNotNull('return_deadline')
            ->where('return_deadline', '<', now()->startOfDay())
            ->latest()
            ->get();

        return $issues->map(function (BookIssue $issue) use ($finePerDay) {
            [$overdueDays, $fine] = $this->calculateOverdue($issue, $finePerDay);

            return [
                'issue' => $issue,
                'overdueDays' => $overdueDays,
                'fine' => $fine,
            ];
        })->values();
    }

    /**
     * Calculate how many days an issue is overdue and the fine owed.
     */
    private function calculateOverdue(BookIssue $issue, ?int $finePerDay = null): array
    {
        if ($finePerDay === null) {
            $finePerDay = optional(Setting::first())->fine_per_day ?? 0;
        }

        if (! $issue->return_deadline) {
            return [0, 0.0];
        }

        $deadline = Carbon::parse($issue->return_deadline)->startOfDay();
        $today = now()->startOfDay();

        $overdueDays = $today->gt($deadline) ? $deadline->diffInDays($today) : 0;
        $fine = $overdueDays * $finePerDay;

        return [$overdueDays, (float) $fine];
    }
}
