<?php

namespace Database\Seeders;

use App\Models\Major;
use App\Models\SchoolClass;
use App\Models\Teacher;
use Illuminate\Database\Seeder;

class ClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teacherIds = [
            'AKL' => Teacher::query()->where('nip', '198501012024')->value('id'),
            'TKJ' => Teacher::query()->where('nip', '198703152024')->value('id'),
            'BD' => Teacher::query()->where('nip', '198904202024')->value('id'),
        ];

        foreach ([
            '10 AKL',
            '11 AKL',
            '12 AKL',
            '10 TKJ 1',
            '10 TKJ 2',
            '11 TKJ 1',
            '11 TKJ 2',
            '12 TKJ 1',
            '12 TKJ 2',
            '12 TKJ 3',
            '10 BiD 1',
            '10 BiD 2',
            '11 BiD',
            '12 BiD',
        ] as $name) {
            preg_match('/^(10|11|12)\s+([A-Za-z]+)/', $name, $matches);

            $grade = match ($matches[1] ?? null) {
                '10' => 'X',
                '11' => 'XI',
                '12' => 'XII',
                default => null,
            };
            $majorCode = strtoupper($matches[2] ?? '');
            $majorCode = $majorCode === 'BID' ? 'BD' : $majorCode;
            $majorId = Major::query()->where('code', $majorCode)->value('id');

            SchoolClass::query()->firstOrCreate(
                ['name' => $name],
                [
                    'grade' => $grade,
                    'major_id' => $majorId,
                    'teacher_id' => $teacherIds[$majorCode] ?? null,
                ],
            );
        }
    }
}
