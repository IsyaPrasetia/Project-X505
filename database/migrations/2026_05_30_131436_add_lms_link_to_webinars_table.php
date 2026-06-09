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
        Schema::table('webinars', function (Blueprint $table) {
            $table->string('lms_link', 255)->nullable()->after('register_link');
        });
    }

    public function down(): void
    {
        Schema::table('webinars', function (Blueprint $table) {
            $table->dropColumn('lms_link');
        });
    }
};
