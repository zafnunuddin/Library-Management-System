<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('book_returns', function (Blueprint $table) {

            $table->boolean('fine_paid')
                  ->default(false)
                  ->after('late_fee');

        });
    }

    public function down(): void
    {
        Schema::table('book_returns', function (Blueprint $table) {

            $table->dropColumn('fine_paid');

        });
    }
};