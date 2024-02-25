<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curriculum extends Model
{
    use HasFactory;

    protected $table = 'curriculums'; 

    protected $fillable = [
        'title',
        'thumbnail',
        'description',
        'video_url',
        'alway_delivery_flg',
        'classes_id',
        'created_at',
        'updated_at',
    ];

    public function grade () {
        return $this->belongsTo(Grade::class, 'classes_id');
    }

    public function curriculumProgress() {
        return $this->hasMany(CurriculumProgress::class, 'curriculumus_id');
    }
}
