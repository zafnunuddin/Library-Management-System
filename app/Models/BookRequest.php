<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Book;

class BookRequest extends Model
{
    protected $fillable = [
        'user_id',
        'book_id',
        'status',
        'request_deadline',
        'rejected_at',
        'handover_confirmed',      // <-- এই দুটি ফিল্ড যুক্ত করুন
        'handover_confirmed_at',   // <--
    ];

    protected $casts = [
    'request_deadline' => 'datetime',
    'rejected_at' => 'datetime',
    'handover_confirmed_at' => 'datetime',
];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id');
    }

    public function issue()
{
    return $this->hasOne(
        BookIssue::class,
        'book_id',
        'book_id'
    )->where('user_id', $this->user_id);
}
}
