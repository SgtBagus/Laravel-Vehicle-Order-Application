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
        Schema::create('vehicle_lists', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('number_vechile');
            $table->integer('fuel');
            $table->enum('status', ['ready', 'onRent', 'notReady'])->default('ready');
            $table->bigInteger('created_by');
            $table->bigInteger('updated_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicle_lists');
    }
};
