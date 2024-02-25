<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CurriculumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $curriculums = [];

        for ($i = 1; $i <= 12; $i++) {
            for ($j = 1; $j<= 3; $j++) {
                $curriculums[] = [
                    'title' => "授業タイトル{$j}",
                    'alway_delivery_flg' => 0,
                    'classes_id' => $i,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'thumbnail' => 'a',
                    'description' => 'text',
                    'video_url' => 'a',
                ];
            }
        }

        DB::table('curriculums')->insert($curriculums);
    }
}
