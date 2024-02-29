<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'posted_date',
        'article_contents',
    ];

    // 管理者側の操作

    // お知らせを削除
    public function deleteArticle() {
        $this->delete();
    }


}
