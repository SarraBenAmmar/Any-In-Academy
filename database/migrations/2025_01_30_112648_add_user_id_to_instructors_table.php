<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('instructors', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->after('id')->nullable(); // Add user_id column
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // Define foreign key
        });
    }

    public function down()
    {
        Schema::table('instructors', function (Blueprint $table) {
            $table->dropForeign(['user_id']); // Drop foreign key
            $table->dropColumn('user_id');   // Remove the column
        });
    }
};
