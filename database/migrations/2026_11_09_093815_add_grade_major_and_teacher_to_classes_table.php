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
        Schema::table('classes', function (Blueprint $table) {
            $table->string('grade', 10)->nullable();
            $table->foreignId('major_id')->nullable()->constrained()->restrictOnDelete();
            $table->foreignId('teacher_id')->nullable()->constrained()->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('classes', function (Blueprint $table) {
            $table->dropForeign(['major_id']);
            $table->dropForeign(['teacher_id']);
            $table->dropColumn(['grade', 'major_id', 'teacher_id']);
        });
    }
};
