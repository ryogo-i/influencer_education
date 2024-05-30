<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryTime extends Model
{
    use HasFactory;

    protected $dates = [
        'delivery_from',
        'delivery_to',
    ];

    protected $fillable = [
        'curriculums_id',
        'delivery_from',
        'delivery_to',
    ];

    // リレーションの設定
    public function curriculum()
    {
        return $this->belongsTo(Curriculum::class, 'curriculums_id');
    }
}

