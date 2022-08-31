<?php

namespace Database\Seeders;

use App\Models\MasterCategory;
use App\Models\MasterData;
use Illuminate\Database\Seeder;

class MasterDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $companyCategory = MasterCategory::whereCode("COMPANY")->first();
        $jobCategory = MasterCategory::whereCode("JOB")->first();
        $typeCategory = MasterCategory::whereCode("TYPE_APPLICATION")->first();
        $technologyCategory = MasterCategory::whereCode("TECHNOLOGY")->first();

        $companyArr = [
            [
                'master_category_id' => $companyCategory->id,
                'master_category_code' => $companyCategory->code,
                'code' => 'COMPANY00001',
                'name' => 'PT Brilyan Trimatra Utama',
            ],
            [
                'master_category_id' => $companyCategory->id,
                'master_category_code' => $companyCategory->code,
                'code' => 'COMPANY00002',
                'name' => 'PT Sinergi Cakra Sinatria',
            ],
            [
                'master_category_id' => $companyCategory->id,
                'master_category_code' => $companyCategory->code,
                'code' => 'COMPANY00003',
                'name' => 'CV Andromega',
            ],
            [
                'master_category_id' => $companyCategory->id,
                'master_category_code' => $companyCategory->code,
                'code' => 'COMPANY00004',
                'name' => 'PT Vortex Intelligent Network Solutions',
            ],
        ];

        $jobArr = [
            [
                'master_category_id' => $jobCategory->id,
                'master_category_code' => $jobCategory->code,
                'code' => 'JOB00001',
                'name' => 'Mobile Developer',
            ],
            [
                'master_category_id' => $jobCategory->id,
                'master_category_code' => $jobCategory->code,
                'code' => 'JOB00002',
                'name' => 'Frontend Developer',
            ],
            [
                'master_category_id' => $jobCategory->id,
                'master_category_code' => $jobCategory->code,
                'code' => 'JOB00003',
                'name' => 'Backend Developer',
            ],
            [
                'master_category_id' => $jobCategory->id,
                'master_category_code' => $jobCategory->code,
                'code' => 'JOB00004',
                'name' => 'Fullstack Developer',
            ],
            [
                'master_category_id' => $jobCategory->id,
                'master_category_code' => $jobCategory->code,
                'code' => 'JOB00005',
                'name' => 'Web Developer',
            ],
            [
                'master_category_id' => $jobCategory->id,
                'master_category_code' => $jobCategory->code,
                'code' => 'JOB00006',
                'name' => 'Software Engineer',
            ],
        ];

        $typeArr = [
            [
                'master_category_id' => $typeCategory->id,
                'master_category_code' => $typeCategory->code,
                'code' => 'TYPE_APPLICATION00001',
                'name' => 'Mobile Apps',
            ],
            [
                'master_category_id' => $typeCategory->id,
                'master_category_code' => $typeCategory->code,
                'code' => 'TYPE_APPLICATION00002',
                'name' => 'Web Apps',
            ],
            [
                'master_category_id' => $typeCategory->id,
                'master_category_code' => $typeCategory->code,
                'code' => 'TYPE_APPLICATION00003',
                'name' => 'Desktop Apps',
            ],
            [
                'master_category_id' => $typeCategory->id,
                'master_category_code' => $typeCategory->code,
                'code' => 'TYPE_APPLICATION00004',
                'name' => 'Multiplatform Apps',
            ],
        ];

        $technologyArr = [
            [
                'master_category_id' => $technologyCategory->id,
                'master_category_code' => $technologyCategory->code,
                'code' => 'TECHNOLOGY00001',
                'name' => 'Flutter',
            ],
            [
                'master_category_id' => $technologyCategory->id,
                'master_category_code' => $technologyCategory->code,
                'code' => 'TECHNOLOGY00002',
                'name' => 'Codeigniter',
            ],
            [
                'master_category_id' => $technologyCategory->id,
                'master_category_code' => $technologyCategory->code,
                'code' => 'TECHNOLOGY00003',
                'name' => 'Laravel',
            ],
            [
                'master_category_id' => $technologyCategory->id,
                'master_category_code' => $technologyCategory->code,
                'code' => 'TECHNOLOGY00004',
                'name' => 'React JS',
            ],
            [
                'master_category_id' => $technologyCategory->id,
                'master_category_code' => $technologyCategory->code,
                'code' => 'TECHNOLOGY00005',
                'name' => 'Firebase',
            ],
            [
                'master_category_id' => $technologyCategory->id,
                'master_category_code' => $technologyCategory->code,
                'code' => 'TECHNOLOGY00006',
                'name' => 'Google Maps',
            ],
            [
                'master_category_id' => $technologyCategory->id,
                'master_category_code' => $technologyCategory->code,
                'code' => 'TECHNOLOGY00007',
                'name' => 'REST API',
            ],
        ];

        $datas = [
            ...$companyArr,
            ...$jobArr,
            ...$typeArr,
            ...$technologyArr
        ];
        foreach ($datas as $k => $v) {
            MasterData::create($v);
        }
    }
}
