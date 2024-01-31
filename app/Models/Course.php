<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Course extends Model
{
    use HasFactory;

    protected $table = 'classes';

    protected $fillable = [
        'name',
    ];

    public function curriculums()
    {
        return $this->hasMany(Curriculum::class, 'classes_id', 'id');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'now_class', 'id');
    }
}
