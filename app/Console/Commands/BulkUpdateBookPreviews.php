<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Book;

class BulkUpdateBookPreviews extends Command
{
    protected $signature = 'books:update-previews';
    protected $description = 'Update preview cover and 4 preview pages for all existing books';

    public function handle()
    {
        // public/storage/book-previews/ ফোল্ডারে আপনার ডিফল্ট ডামি/প্রিভিউ ছবিগুলো রাখতে হবে
        $defaultCover = 'book-previews/default_cover.jpg';
        $defaultP1    = 'book-previews/default_p1.jpg';
        $defaultP2    = 'book-previews/default_p2.jpg';
        $defaultP3    = 'book-previews/default_p3.jpg';
        $defaultP4    = 'book-previews/default_p4.jpg';

        $books = Book::all();

        if ($books->isEmpty()) {
            $this->error('No books found in the database!');
            return;
        }

        foreach ($books as $book) {
            $book->update([
                'preview_cover'  => $defaultCover,
                'preview_page_1' => $defaultP1,
                'preview_page_2' => $defaultP2,
                'preview_page_3' => $defaultP3,
                'preview_page_4' => $defaultP4,
            ]);
        }

        $this->info("Successfully updated preview images for all {$books->count()} books!");
    }
}