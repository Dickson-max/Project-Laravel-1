<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('students', function (Blueprint $table) {
            if (! Schema::hasColumn('students', 'major_id')) {
                $table->foreignId('major_id')
                    ->nullable()
                    ->after('user_id')
                    ->constrained('majors');
            }

            if (! Schema::hasColumn('students', 'class_id')) {
                $table->foreignId('class_id')
                    ->nullable()
                    ->after('major_id')
                    ->constrained('classes');
            }
        });

        if (Schema::hasColumn('students', 'major')) {
            foreach (DB::table('students')->whereNotNull('major')->distinct()->pluck('major') as $majorName) {
                $majorId = DB::table('majors')->where('name', $majorName)->value('id');

                if ($majorId === null) {
                    $majorId = DB::table('majors')->insertGetId([
                        'name' => $majorName,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }

                DB::table('students')
                    ->where('major', $majorName)
                    ->update(['major_id' => $majorId]);
            }
        }

        if (Schema::hasColumn('students', 'class')) {
            foreach (DB::table('students')->whereNotNull('class')->distinct()->pluck('class') as $className) {
                $classId = DB::table('classes')->where('name', $className)->value('id');

                if ($classId === null) {
                    $classId = DB::table('classes')->insertGetId([
                        'name' => $className,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }

                DB::table('students')
                    ->where('class', $className)
                    ->update(['class_id' => $classId]);
            }
        }

        Schema::table('students', function (Blueprint $table): void {
            foreach (['class', 'major'] as $column) {
                if (Schema::hasColumn('students', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('students', function (Blueprint $table): void {
            if (! Schema::hasColumn('students', 'major')) {
                $table->string('major')->nullable();
            }

            if (! Schema::hasColumn('students', 'class')) {
                $table->string('class')->nullable();
            }
        });

        DB::table('students')
            ->join('majors', 'students.major_id', '=', 'majors.id')
            ->update(['students.major' => DB::raw('majors.name')]);

        DB::table('students')
            ->join('classes', 'students.class_id', '=', 'classes.id')
            ->update(['students.class' => DB::raw('classes.name')]);

        Schema::table('students', function (Blueprint $table) {
            if (Schema::hasColumn('students', 'major_id')) {
                $table->dropForeign(['major_id']);
                $table->dropColumn('major_id');
            }
            if (Schema::hasColumn('students', 'class_id')) {
                $table->dropForeign(['class_id']);
                $table->dropColumn('class_id');
            }
        });
    }
};
