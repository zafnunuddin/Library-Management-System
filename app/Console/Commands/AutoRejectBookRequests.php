<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\BookRequest;

class AutoRejectBookRequests extends Command
{
    protected $signature = 'requests:auto-reject';

    protected $description = 'Automatically reject pending book requests after 15 days';

    public function handle()
    {
        $requests = BookRequest::where('status', 'Pending')
            ->whereNotNull('request_deadline')
            ->where('request_deadline', '<=', now())
            ->get();

        foreach ($requests as $request) {

            $request->status = 'Rejected';
            $request->rejected_at = now();
            $request->save();
        }

        $this->info(
            $requests->count().' expired book request(s) rejected.'
        );

        return Command::SUCCESS;
    }
}