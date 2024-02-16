<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArticleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'title' => 'お知らせタイトル1',
                'posted_date' => now(),
                'article_contents' => 'テキストテキストテキストテキストテキストテキストテキスト1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'お知らせタイトル2',
                'posted_date' => now(),
                'article_contents' => 'テキストテキストテキストテキストテキストテキストテキスト2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'お知らせタイトル3',
                'posted_date' => now(),
                'article_contents' => 'テキストテキストテキストテキストテキストテキストテキスト3',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'お知らせタイトル4',
                'posted_date' => now(),
                'article_contents' => 'テキストテキストテキストテキストテキストテキストテキスト4',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'お知らせタイトル5',
                'posted_date' => now(),
                'article_contents' => 'テキストテキストテキストテキストテキストテキストテキスト5',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        
        DB::table('articles')->insert($data);
        
    }
}
