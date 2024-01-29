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
        Schema::table('photos', function (Blueprint $table) {
            $table->string('preloaded_url')->after('url')->nullable();
            $table->string('storage_path')->after('url')->nullable();
            $table->string('storage_preloaded_path')->after('url')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('photos', function (Blueprint $table) {
            $table->dropColumn(['preloaded_url','storage_path','storage_preloaded_path']);
        });
    }
};
