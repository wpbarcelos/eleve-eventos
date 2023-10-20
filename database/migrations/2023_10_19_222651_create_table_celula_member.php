<?php

use App\Models\Celula;
use App\Models\EventSubscribe;
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
        Schema::create('celula_member', function (Blueprint $table) {
            $table->foreignIdFor(EventSubscribe::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Celula::class)->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('celula_member');
    }
};
