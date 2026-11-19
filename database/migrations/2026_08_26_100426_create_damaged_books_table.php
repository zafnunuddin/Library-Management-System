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
        Schema::create('damaged_books', function (Blueprint $table) {
            $table->id();
            $table->foreignId('book_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null'); // কে নষ্ট করেছে (যদি থাকে)
            $table->integer('quantity')->default(1); // কত কপি নষ্ট হয়েছে
            $table->decimal('book_price', 8, 2)->default(0);
            $table->decimal('late_fee', 8, 2)->default(0);
            $table->string('damage_photo')->nullable();
            $table->text('notice')->nullable();
            $table->date('return_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('damaged_books');
    }
};