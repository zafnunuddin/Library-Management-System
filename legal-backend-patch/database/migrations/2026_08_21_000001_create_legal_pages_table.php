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
        Schema::create('legal_pages', function (Blueprint $table) {
            $table->id();

            // 'terms' or 'privacy-policy'
            $table->string('slug')->unique();

            $table->string('title');

            // Full page content (HTML allowed, rendered with admin-controlled trust)
            $table->longText('content');

            // Bumped every time the content is saved, so we can show "last updated"
            $table->unsignedInteger('version')->default(1);

            // Which admin last saved this page
            $table->foreignId('updated_by')
                  ->nullable()
                  ->constrained('users')
                  ->nullOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('legal_pages');
    }
};
