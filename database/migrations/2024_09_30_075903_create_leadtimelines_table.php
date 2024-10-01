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
        Schema::create('leadtimelines', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lead_id'); // Regular column, no foreign key constraint
            $table->string('status'); // Status of the timeline (e.g., New, In Progress, Closed)
            $table->string('title'); // Title of the timeline entry
            $table->text('message'); // Message for the timeline entry
            $table->string('note')->nullable(); // Note for the timeline entry
            $table->string('badge_color')->nullable(); // Badge color for the timeline entry
            $table->string('message_color')->nullable(); // Message color for the timeline entry
            $table->timestamps(); // Created and updated timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leadtimelines');
    }
};
