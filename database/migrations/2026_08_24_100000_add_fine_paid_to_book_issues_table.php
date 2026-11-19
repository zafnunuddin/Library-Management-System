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
        // NOTE: an earlier migration (2026_08_23_142535) already added
        // `fine_paid` and `fine_paid_at` to this table (under the column
        // name `payment_method` instead of `fine_payment_method`). Adding
        // `fine_paid` / `fine_paid_at` again here throws a "duplicate
        // column" SQL error and aborts the whole `php artisan migrate`
        // run — which stops every migration after it (books, requests,
        // etc.) from ever being created. Guard each column so this
        // migration is safe whether or not the 08-23 one already ran.
        Schema::table('book_issues', function (Blueprint $table) {

            if (! Schema::hasColumn('book_issues', 'fine_paid')) {
                $table->boolean('fine_paid')->default(false)->after('status');
            }

            if (! Schema::hasColumn('book_issues', 'fine_payment_method')) {
                $table->string('fine_payment_method')->nullable()->after('fine_paid');
            }

            if (! Schema::hasColumn('book_issues', 'fine_paid_at')) {
                $table->timestamp('fine_paid_at')->nullable()->after('fine_payment_method');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('book_issues', function (Blueprint $table) {

            $drop = array_filter(
                ['fine_paid', 'fine_payment_method', 'fine_paid_at'],
                fn ($column) => Schema::hasColumn('book_issues', $column)
            );

            if ($drop) {
                $table->dropColumn($drop);
            }
        });
    }
};
