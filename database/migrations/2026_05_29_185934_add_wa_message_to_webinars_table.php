<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('webinars', function (Blueprint $table) {
            $table->text('wa_message')->nullable()->after('register_closed');
        });
    }

    public function down(): void
    {
        Schema::table('webinars', function (Blueprint $table) {
            $table->dropColumn('wa_message');
        });
    }
};
