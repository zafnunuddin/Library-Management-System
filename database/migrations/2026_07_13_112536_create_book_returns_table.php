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
    Schema::create('book_returns', function (Blueprint $table) {

        $table->id();

        $table->foreignId('issue_id')
              ->constrained('book_issues')
              ->cascadeOnDelete();

        $table->date('actual_return_date');

        $table->decimal('fine',8,2)
              ->default(0);

        $table->string('damage_photo')
              ->nullable();

        $table->text('notice')
              ->nullable();

        $table->enum('condition',[
            'Good',
            'Damaged',
            'Lost'
        ])->default('Good');

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_returns');
    }
};
