<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('webinars', function (Blueprint $table) {
            $table->id();
            $table->string('tag')->nullable();
            $table->text('title');
            $table->date('date')->nullable();
            $table->string('time')->nullable();
            $table->string('flyer')->nullable();
            $table->string('platform')->nullable();
            $table->string('duration')->nullable();
            $table->string('skp')->nullable();
            $table->string('price')->nullable();
            $table->string('price2')->nullable();
            $table->boolean('has_two_prices')->default(false);
            $table->string('register_link')->nullable();
            $table->text('professions')->nullable();
            $table->string('admin_left_name')->nullable();
            $table->string('admin_left_link')->nullable();
            $table->string('admin_right_name')->nullable();
            $table->string('admin_right_link')->nullable();
            $table->text('health_channel_text')->nullable();
            $table->string('health_channel_link')->nullable();
            $table->string('health_channel_btn_text')->nullable();
            $table->json('speakers')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('webinars');
    }
};
