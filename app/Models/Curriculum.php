<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curriculum extends Model
{
    use HasFactory;

    //リレーション
    public function deliveryTimes()
    {
        return $this->hasMany(DeliveryTime::class, 'curriculums_id');
    }

    protected $table = 'curriculums';

    protected $fillable = [
        'name',
        'video_url',
        'description',
        'grade',
        'thumbnail',
        'public',
    ];
}