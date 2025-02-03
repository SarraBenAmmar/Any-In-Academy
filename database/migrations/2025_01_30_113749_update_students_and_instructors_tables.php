<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;



return new class extends Migration {
    public function up()
    {
        // Update students table
        Schema::table('students', function (Blueprint $table) {
            $table->dropColumn(['name_bn', 'contact_bn', 'language']); // Remove columns
            $table->renameColumn('name_en', 'name'); // Rename column
            $table->renameColumn('contact_en', 'contact'); // Rename column
        });

        // Update instructors table
        Schema::table('instructors', function (Blueprint $table) {
            $table->dropColumn(['name_bn', 'contact_bn', 'language']); // Remove columns
            $table->renameColumn('name_en', 'name'); // Rename column
            $table->renameColumn('contact_en', 'contact'); // Rename column
        });
    }

    public function down()
    {
        // Revert changes for students table
        Schema::table('students', function (Blueprint $table) {
            $table->string('name_bn')->nullable();
            $table->string('contact_bn')->nullable();
            $table->string('language')->nullable();

            $table->renameColumn('name', 'name_en');
            $table->renameColumn('contact', 'contact_en');
        });

        // Revert changes for instructors table
        Schema::table('instructors', function (Blueprint $table) {
            $table->string('name_bn')->nullable();
            $table->string('contact_bn')->nullable();
            $table->string('language')->nullable();

            $table->renameColumn('name', 'name_en');
            $table->renameColumn('contact', 'contact_en');
        });
    }
};
