<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
    Schema::table('books', function (Blueprint $table) {

        $table->string('isbn')->nullable()->after('author');

        $table->string('language')->nullable()->after('isbn');

        $table->string('publisher')->nullable()->after('language');

        $table->year('publication_year')->nullable()->after('publisher');

        $table->string('printing_no')->nullable()->after('publication_year');

        $table->string('publication_place')->nullable()->after('printing_no');

        $table->string('shelf_location')->nullable()->after('publication_place');

        $table->longText('book_abstract')->nullable()->after('description');

        $table->longText('table_of_contents')->nullable()->after('book_abstract');

        $table->string('preview_cover')->nullable()->after('photo');

        $table->string('preview_page_1')->nullable()->after('preview_cover');

        $table->string('preview_page_2')->nullable()->after('preview_page_1');

        $table->string('preview_page_3')->nullable()->after('preview_page_2');

        $table->string('preview_page_4')->nullable()->after('preview_page_3');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    Schema::table('books', function (Blueprint $table) {

        $table->dropColumn([
            'isbn',
            'language',
            'publisher',
            'publication_year',
            'printing_no',
            'publication_place',
            'shelf_location',
            'book_abstract',
            'table_of_contents',
            'preview_cover',
            'preview_page_1',
            'preview_page_2',
            'preview_page_3',
            'preview_page_4',
        ]);
    });
}
};
