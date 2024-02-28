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
        Schema::create('tool_events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('events_id')->references('id')->on('events')->onDelete('cascade');
            $table->foreignId('tools_id')->references('id')->on('tools')->onDelete('cascade');
            $table->string('tools_name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tool_events');
    }
};
