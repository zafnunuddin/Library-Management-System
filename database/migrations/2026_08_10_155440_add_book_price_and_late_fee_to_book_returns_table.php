<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('book_returns', function (Blueprint $table) {

            $table->decimal('book_price', 10, 2)
                ->default(0)
                ->after('fine');

            $table->decimal('late_fee', 10, 2)
                ->default(0)
                ->after('book_price');

        });
    }

    public function down(): void
    {
        Schema::table('book_returns', function (Blueprint $table) {

            $table->dropColumn([
                'book_price',
                'late_fee',
            ]);

        });
    }
};