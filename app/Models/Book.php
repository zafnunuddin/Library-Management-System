<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{

protected $fillable = [
    'title',
    'author',
    'edition',
    'genre',
    'serial_no',
    'quantity',
    'available_quantity',

    // Book Details
    'isbn',
    'language',
    'publisher',
    'publication_year',
    'printing_no',
    'publication_place',
    'shelf_location',

    // Book Information
    'past_edition',
    'new_edition',
    'description',
    'book_abstract',
    'table_of_contents',

    // Book Images
    'photo',
    'preview_cover',
    'preview_page_1',
    'preview_page_2',
    'preview_page_3',
    'preview_page_4',

    // Other
    'status',
    'uploaded_at',
];

protected $casts = [

    'quantity' => 'integer',

    'available_quantity' => 'integer',

    'uploaded_at' => 'datetime',

];

    public function issues()
{
    return $this->hasMany(BookIssue::class);
}

public function requests()
{
    return $this->hasMany(BookRequest::class);
}

public function returns()
{
    return $this->hasMany(BookReturn::class);
}
}
