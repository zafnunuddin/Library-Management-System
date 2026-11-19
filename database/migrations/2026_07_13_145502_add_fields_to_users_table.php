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
    Schema::table('users', function (Blueprint $table) {

        $table->string('student_id')->nullable()->after('name');

        $table->string('phone')->nullable();

        $table->string('department')->nullable();

        $table->string('semester')->nullable();

        $table->text('address')->nullable();

        $table->string('photo')->nullable();

        $table->enum('role', [
            'admin',
            'user'
        ])->default('user');

        $table->enum('status', [
            'Active',
            'Inactive'
        ])->default('Active');

        $table->timestamp('last_login')->nullable();

        $table->date('member_since')->nullable();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
{
    Schema::table('users', function (Blueprint $table) {

        $table->dropColumn([
            'student_id',
            'phone',
            'department',
            'semester',
            'address',
            'photo',
            'role',
            'status',
            'last_login',
            'member_since'
        ]);
    });
}
};
