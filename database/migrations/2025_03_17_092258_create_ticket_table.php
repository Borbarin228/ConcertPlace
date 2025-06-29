<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ticket', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('user_id')->index();
            $table->integer('number');
            $table->foreignId('concert_id')->index();
            $table->foreignId('category_id')->references('id')->on('ticket_categories');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ticket');
    }
};
