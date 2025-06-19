<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('concert_category', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ticket_category_id')->references('id')->on('ticket_categories');
            $table->foreignId('concert_id');
            $table->double('price')->nullable();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('concert_category');
    }
};
