<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'user_id',
        'issue_id',
        'amount',
        'payment_method',
        'mobile',
        'status',
        'transaction_id',
        'paid_at',
        'payment_status',
    ];

    protected $casts = [
        'paid_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function issue()
    {
        return $this->belongsTo(BookIssue::class, 'issue_id');
    }
}