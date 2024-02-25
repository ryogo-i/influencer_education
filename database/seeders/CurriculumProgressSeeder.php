<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CurriculumProgress;

class CurriculumProgressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CurriculumProgress::create([
            'curriculum_id' => 1,
            'users_id' => 1,
            'clear_flg' => 1,
        ]);
    }
}
