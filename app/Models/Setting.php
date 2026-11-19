<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
    'admin_name',
    'email',
    'phone',
    'profile_photo',
    'library_name',
    'university_name',
    'fine_per_day',
    'maximum_borrow_days',
    'maximum_books_per_user',
    'library_logo',
    'email_notification',
    'due_notification',
    'registration_notification',
];
}
