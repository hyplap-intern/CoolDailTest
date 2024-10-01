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
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vendor_uid'); // Foreign key to 'vendor' table
            $table->unsignedBigInteger('cp_uid'); // Foreign key to 'channel partner' or 'contact person' table
            $table->unsignedBigInteger('assigned_to'); // Foreign key to the 'user' who is responsible for this lead
            $table->string('status'); // Status of the lead (e.g., New, In Progress, Closed)
            $table->date('next_followup_date')->nullable(); // Next follow-up date, can be null
            $table->unsignedBigInteger('trx_uid')->nullable(); // Transaction reference, if applicable, can be null
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
