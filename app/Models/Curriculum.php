<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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
        return $this->belongsTo(Course::class, 'classes_id', 'id');
    }

    public static function withDeliveryTimes()
    {
        return static::with('deliveryTimes');
    }


    public static function filterByClassIdAndMonth($classId, $month)
    {
        $startDate = Carbon::createFromFormat('Y-m', $month)->startOfMonth();
        $endDate = Carbon::createFromFormat('Y-m', $month)->endOfMonth();

        return static::where('classes_id', $classId)
            ->where(function ($query) use ($startDate, $endDate) {
                $query->whereHas('deliveryTimes', function ($q) use ($startDate, $endDate) {
                    $q->where(function ($subQuery) use ($startDate, $endDate) {
                        $subQuery->whereBetween('delivery_from', [$startDate, $endDate])
                            ->orWhereBetween('delivery_to', [$startDate, $endDate]);
                    });
                })->orWhere('alway_delivery_flg', 1);
            })
            ->with([
                'deliveryTimes' => function ($query) use ($startDate, $endDate) {
                    $query->where(function ($q) use ($startDate, $endDate) {
                        $q->whereBetween('delivery_from', [$startDate, $endDate])
                            ->orWhereBetween('delivery_to', [$startDate, $endDate]);
                    });
                }
            ]);
    }
}