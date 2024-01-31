<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DeliveryTime extends Model
{
    use HasFactory;
    protected $fillable = ['curriculum_id', 'delivery_from', 'delivery_to'];

    public function curriculum()
    {
        return $this->belongsTo(Curriculum::class);
    }
}
