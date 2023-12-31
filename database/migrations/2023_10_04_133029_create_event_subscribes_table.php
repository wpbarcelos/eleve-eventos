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
        Schema::create('event_subscribes', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Event::class)->constrained()
                ->cascadeOnDelete();
            $table->string('name');
            $table->date('date_birth');
            $table->string('gender');
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->boolean('paid');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_subscribes');
    }
};
