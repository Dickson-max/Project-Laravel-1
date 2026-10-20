<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        foreach (DB::table('classes')->select(['id', 'name', 'grade', 'major_id'])->orderBy('id')->get() as $schoolClass) {
            if (! preg_match('/^(10|11|12)\s+([A-Za-z]+)/', $schoolClass->name, $matches)) {
                continue;
            }

            $updates = [];

            if ($schoolClass->grade === null) {
                $updates['grade'] = match ($matches[1]) {
                    '10' => 'X',
                    '11' => 'XI',
                    '12' => 'XII',
                };
            }

            if ($schoolClass->major_id === null) {
                $majorCode = strtoupper($matches[2]);
                $majorCode = $majorCode === 'BID' ? 'BD' : $majorCode;
                $majorId = DB::table('majors')->where('code', $majorCode)->value('id');

                if ($majorId !== null) {
                    $updates['major_id'] = $majorId;
                }
            }

            if ($updates !== []) {
                DB::table('classes')->where('id', $schoolClass->id)->update($updates);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Keep values derived from existing class names; later edits may have changed them.
    }
};
