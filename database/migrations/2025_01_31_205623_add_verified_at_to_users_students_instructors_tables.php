<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddVerifiedAtToUsersStudentsInstructorsTables extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->timestamp('verified_at')->nullable();
        });

        Schema::table('students', function (Blueprint $table) {
            $table->timestamp('verified_at')->nullable();
        });

        Schema::table('instructors', function (Blueprint $table) {
            $table->timestamp('verified_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('verified_at');
        });

        Schema::table('students', function (Blueprint $table) {
            $table->dropColumn('verified_at');
        });

        Schema::table('instructors', function (Blueprint $table) {
            $table->dropColumn('verified_at');
        });
    }
}

