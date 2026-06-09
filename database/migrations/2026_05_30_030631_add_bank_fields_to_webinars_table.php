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
            $table->string('bank_name')->nullable()->after('professions');
            $table->string('bank_account_no')->nullable()->after('bank_name');
            $table->string('bank_account_name')->nullable()->after('bank_account_no');
            $table->string('bank_logo')->nullable()->after('bank_account_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('webinars', function (Blueprint $table) {
            $table->dropColumn(['bank_name', 'bank_account_no', 'bank_account_name', 'bank_logo']);
        });
    }
};
