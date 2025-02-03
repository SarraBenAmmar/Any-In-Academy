<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Drop unnecessary columns
            $table->dropColumn(['name_bn', 'contact_bn', 'language']);

            // Rename columns
            $table->renameColumn('name_en', 'name');
            $table->renameColumn('contact_en', 'contact');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Revert changes
            $table->string('name_bn')->nullable();
            $table->string('contact_bn')->nullable();
            $table->string('language')->nullable();

            $table->renameColumn('name', 'name_en');
            $table->renameColumn('contact', 'contact_en');
        });
    }
};
