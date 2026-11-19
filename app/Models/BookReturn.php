<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookReturn extends Model
{
    protected $fillable = [
    'issue_id',
    'book_id',
    'actual_return_date',
    'fine',
    'book_price',
    'late_fee',
    'fine_paid',
    'damage_photo',
    'notice',
    'condition',
];

protected $casts = [
    'fine_paid' => 'boolean',
];

    public function issue()
    {
        return $this->belongsTo(BookIssue::class, 'issue_id');
    }

    public function book()
{
    return $this->belongsTo(Book::class);
}
}