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
        Schema::create('scheduled_classes', function (Blueprint $table) {
            $table->id();
            $table->foreignid('instructor_id')->constrained('users');
            $table->foreignid('class_type_id')->constrained();;
            $table->datetime('date_time')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scheduled_classes');
    }
};
