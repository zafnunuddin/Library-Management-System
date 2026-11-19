<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('book_requests', function (Blueprint $table) {

            $table->boolean('handover_confirmed')
                ->default(false)
                ->after('request_deadline');

            $table->timestamp('handover_confirmed_at')
                ->nullable()
                ->after('handover_confirmed');
        });
    }

    public function down(): void
    {
        Schema::table('book_requests', function (Blueprint $table) {

            $table->dropColumn([
                'handover_confirmed',
                'handover_confirmed_at',
            ]);

        });
    }
};