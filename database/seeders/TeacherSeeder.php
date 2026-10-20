<?php

namespace Database\Seeders;

use App\Models\Teacher;
use Illuminate\Database\Seeder;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ([
            [
                'nip' => '198501012024',
                'name' => 'Budi Santoso',
                'gender' => 'L',
                'subject' => 'Akuntansi Dasar',
                'phone_number' => '081234560001',
                'status' => 'Aktif',
            ],
            [
                'nip' => '198703152024',
                'name' => 'Siti Aminah',
                'gender' => 'P',
                'subject' => 'Jaringan Komputer',
                'phone_number' => '081234560002',
                'status' => 'Aktif',
            ],
            [
                'nip' => '198904202024',
                'name' => 'Rahmat Hidayat',
                'gender' => 'L',
                'subject' => 'Bisnis Digital',
                'phone_number' => '081234560003',
                'status' => 'Aktif',
            ],
        ] as $teacher) {
            Teacher::query()->firstOrCreate(
                ['nip' => $teacher['nip']],
                $teacher,
            );
        }
    }
}
