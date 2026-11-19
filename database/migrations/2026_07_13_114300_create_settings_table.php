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
    Schema::create('settings', function (Blueprint $table) {

        $table->id();

        $table->string('admin_name')->nullable();

        $table->string('email')->nullable();

        $table->string('phone')->nullable();

        $table->string('profile_photo')
              ->nullable();

        $table->string('library_name')
              ->nullable();

        $table->string('university_name')
              ->nullable();

        $table->integer('fine_per_day')
              ->default(0);

        $table->integer('maximum_borrow_days')
              ->default(14);

        $table->integer('maximum_books_per_user')
              ->default(3);

        $table->string('library_logo')
              ->nullable();

        $table->boolean('email_notification')
              ->default(true);

        $table->boolean('due_notification')
              ->default(true);

        $table->boolean('registration_notification')
              ->default(true);

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
