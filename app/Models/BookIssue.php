<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Book;
use App\Models\BookReturn;

class BookIssue extends Model
{
    protected $fillable = [
    'user_id',
    'book_id',
    'issue_date',
    'return_deadline',
    'status',
    'handover_confirmed',
    'handover_confirmed_at',
    'fine_paid',
    'fine_payment_method',
    'fine_paid_at',
];

    protected $casts = [
    'fine_paid' => 'boolean',
    'fine_paid_at' => 'datetime',
    'handover_confirmed' => 'boolean',
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

    public function returns()
    {
        return $this->hasOne(BookReturn::class, 'issue_id');
    }
}
