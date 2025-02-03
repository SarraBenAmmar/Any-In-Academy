<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('students', function (Blueprint $table) {
            // Add user_id as a foreign key
            $table->unsignedBigInteger('user_id')->after('id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            // Remove unnecessary columns
            $table->dropColumn(['nationality', 'address', 'city', 'state']);
        });
    }

    public function down()
    {
        Schema::table('students', function (Blueprint $table) {
            // Revert changes
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');

            $table->string('nationality')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
        });
    }
};
