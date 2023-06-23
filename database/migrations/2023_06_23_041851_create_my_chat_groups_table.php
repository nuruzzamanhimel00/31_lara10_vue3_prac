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
        Schema::create('my_chat_groups', function (Blueprint $table) {
            $table->id();
            $table->string('name');

            $table->foreignId('user_id');
            $table->string('code')->unique();
            $table->string('status')->default('active')->comment('active|inactive');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('my_chat_groups');
    }
};
