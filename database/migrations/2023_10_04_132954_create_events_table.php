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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->decimal('price')->default(0);
            $table->string('image')->nullable();
            $table->date('date_start')->nullable();
            $table->date('date_end')->nullable();
            $table->dateTime('subscribe_start')->nullable();
            $table->dateTime('subscribe_until')->nullable();
            $table->integer('limit_subscribe')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
