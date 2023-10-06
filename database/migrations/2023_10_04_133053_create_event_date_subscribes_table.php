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
        Schema::create('event_date_subscribes', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\EventDate::class)->constrained();
            $table->foreignIdFor(\App\Models\EventSubscribe::class)->constrained();
            $table->enum('present',['y','n']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_date_subscribes');
    }
};
