<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {

            $table->id();

            // Host Event
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            // Data Film
            $table->string('movie_title');
            $table->string('genre');
            $table->integer('duration');
            $table->year('release_year');
            $table->string('poster')->nullable();
            $table->text('synopsis')->nullable();

            // Data Event
            $table->string('event_name');
            $table->date('event_date');
            $table->time('event_time');
            $table->text('description')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};