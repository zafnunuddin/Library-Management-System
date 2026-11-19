<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Adds fine tracking to book_issues so an overdue fine can be paid
     * online while the book is still checked out (i.e. before a
     * book_returns row exists for it).
     */
    public function up(): void
    {
        Schema::table('book_issues', function (Blueprint $table) {

            $table->boolean('fine_paid')
                  ->default(false)
                  ->after('status');

            $table->string('payment_method')
                  ->nullable()
                  ->after('fine_paid');

            $table->timestamp('fine_paid_at')
                  ->nullable()
                  ->after('payment_method');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('book_issues', function (Blueprint $table) {
            $table->dropColumn(['fine_paid', 'payment_method', 'fine_paid_at']);
        });
    }
};
