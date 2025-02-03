<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('students', function (Blueprint $table) {
            // Remove postcode column
            $table->dropColumn('postcode');
        });
    }

    public function down()
    {
        Schema::table('students', function (Blueprint $table) {
            // Re-add postcode column if rollback is needed
            $table->string('postcode')->nullable();
        });
    }
};
