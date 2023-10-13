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
        Schema::create('submission_lists', function (Blueprint $table) {
            $table->id();
            $table->string('submission_name');
            $table->string('reason');
            $table->bigInteger('vehicle_id');
            $table->enum('status', ['waiting', 'approval', 'rejected'])->default('waiting');
            $table->string('note');
            $table->date('start_date');
            $table->date('end_date');
            $table->bigInteger('approve_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('submission_lists');
    }
};
