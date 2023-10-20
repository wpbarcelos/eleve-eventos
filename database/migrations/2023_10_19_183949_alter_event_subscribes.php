<?php

use App\Models\Congregation;
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
        Schema::table('event_subscribes', function (Blueprint $table) {
            $table->foreignIdFor(Congregation::class)->nullable()->constrained()->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('event_subscribes', function (Blueprint $table) {
            $table->dropForeignIdFor(Congregation::class);
        });
    }
};
