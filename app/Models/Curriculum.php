<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Curriculum extends Model
{
    use HasFactory;

    protected $table = 'curriculums';

    public function deliveryTimes()
    {
        return $this->hasMany(DeliveryTime::class);
    }

    public function classes()
    {
        return $this->belongsTo(Course::class, 'classes_id', 'id'); //Course(Class)モデルから取得
    }
}
