<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BookIssue;

class IssueController extends Controller
{
    public function issuedUsers()
    {
        $issuedUsers = BookIssue::with([
            'user',
            'book',
            'returns'
        ])
        ->latest()
        ->get();

        return view(
            'admin.issue.issued_users',
            compact('issuedUsers')
        );
    }
}