<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::create('participants', function (Blueprint $table) {
        $table->id();

       $table->foreignId('user_id')->constrained()->cascadeOnDelete();
//nyimpen id user yg gbng ke event
$table->foreignId('event_id')->constrained()->cascadeOnDelete();
//biar ga ada user yg sm gnbng lbh dri1
$table->unique(['user_id', 'event_id']);

$table->enum('attendance_status', [
    'Pending',
    'Joined',
    'Cancelled'
])->default('Pending');

$table->timestamps();
    });
}
    public function down(): void
    {
        Schema::dropIfExists('participants');
    }
};
