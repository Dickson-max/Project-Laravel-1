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
        Schema::table('majors', function (Blueprint $table) {
            $table->string('code', 20)->nullable()->unique();
            $table->text('description')->nullable();
        });

        $codes = [];

        foreach (DB::table('majors')->orderBy('id')->get(['id', 'name']) as $major) {
            $name = mb_strtolower(trim($major->name));
            $code = match ($name) {
                'akl', 'akuntansi dan keuangan lembaga' => 'AKL',
                'tkj', 'teknik komputer dan jaringan' => 'TKJ',
                'bid', 'bisnis digital' => 'BD',
                default => 'JUR-'.$major->id,
            };

            if (in_array($code, $codes, true)) {
                $code = 'JUR-'.$major->id;
            }

            $codes[] = $code;

            DB::table('majors')
                ->where('id', $major->id)
                ->update([
                    'code' => $code,
                    'description' => match ($code) {
                        'AKL' => 'Program keahlian yang membekali murid dengan kompetensi pencatatan dan pelaporan keuangan.',
                        'TKJ' => 'Program keahlian yang membekali murid dengan kompetensi instalasi, konfigurasi, dan pemeliharaan jaringan komputer.',
                        'BD' => 'Program keahlian yang membekali murid dengan kompetensi pemasaran dan pengelolaan bisnis berbasis digital.',
                        default => null,
                    },
                ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('majors', function (Blueprint $table) {
            $table->dropUnique(['code']);
            $table->dropColumn(['code', 'description']);
        });
    }
};
