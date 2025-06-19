<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('concerts', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('city');
            $table->string('place');
            $table->date('start_at');
            $table->boolean('is_accepted');
        });

        Schema::create('ticket_categories', function (Blueprint $table){
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->string('description');
            $table->foreignId('owner_id')->references('id')->on('users');
            $table->double('price');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('concerts');
        Schema::dropIfExists('ticket_categories');
    }
};
