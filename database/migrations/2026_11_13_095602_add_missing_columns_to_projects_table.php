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
        Schema::table('projects', function (Blueprint $table) {
            if (!Schema::hasColumn('projects', 'tech_stack')) {
                $table->string('tech_stack')->nullable();
            }
            if (!Schema::hasColumn('projects', 'thumbnail')) {
                $table->string('thumbnail')->nullable();
            }
            if (!Schema::hasColumn('projects', 'live_url')) {
                $table->string('live_url')->nullable();
            }
            if (!Schema::hasColumn('projects', 'github_url')) {
                $table->string('github_url')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn(['tech_stack', 'thumbnail', 'live_url', 'github_url']);
        });
    }
};
