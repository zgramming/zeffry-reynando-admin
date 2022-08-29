<?php

namespace Database\Seeders;

use App\Models\MasterCategory;
use Illuminate\Database\Seeder;

class MasterCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datas = [
            [
                'code' => 'TYPE_APPLICATION',
                'name' => "Tipe Aplikasi",
                'description' => 'Deskripsi Tipe Aplikasi',
                'status' => 'active',
            ],
            [
                'code' => 'TECHNOLOGY',
                'name' => "Teknologi",
                'description' => 'Deskripsi Teknologi',
                'status' => 'active',
            ],
            [
                'code' => 'COMPANY',
                'name' => "Perusahaan / Kantor",
                'description' => 'Deskripsi Perusahaan / Kantor',
                'status' => 'active',
            ],
            [
                'code' => 'JOB',
                'name' => "Pekerjaan",
                'description' => 'Deskripsi Pekerjaan',
                'status' => 'active',
            ],
        ];

        foreach ($datas as $key => $value) {
            MasterCategory::create($value);
        }
    }
}
