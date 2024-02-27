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

    public static function filterByClassId($classId)
    {
        return static::where('classes_id', $classId);
    }

    public function filterDeliveryTimesByMonth($month)
    {
        return DB::transaction(function () use ($month) {
            $this->filteredDeliveryTimes = $this->deliveryTimes->filter(function ($deliveryTime) use ($month) {
                $from = Carbon::parse($deliveryTime->delivery_from);
                $to = Carbon::parse($deliveryTime->delivery_to);
                return $from->format('Y-m') <= $month && $to->format('Y-m') >= $month;
            })->sortBy('delivery_from');
        });
    }

    public static function filterByClassIdAndMonth($classId, $month)
    {
        return DB::transaction(function () use ($classId, $month) {
            return static::where('classes_id', $classId)
                ->whereHas('deliveryTimes', function ($query) use ($month) {
                    $query->where('delivery_from', '<=', $month)
                        ->where('delivery_to', '>=', $month);
                })
                ->with('deliveryTimes')
                ->get();
        });
    }

    public static function withDeliveryTimes()
    {
        return static::with('deliveryTimes');
    }

    public function filterCurriculumsByClassAndMonth($currentClassId, $displayMonth)
    {
        return DB::transaction(function () use ($currentClassId, $displayMonth) {
            $filteredCurriculums = [];
            $curriculums = static::where('classes_id', $currentClassId)->with('deliveryTimes')->get();

            foreach ($curriculums as $curriculum) {
                $allDeliveryTimes = $curriculum->deliveryTimes;

                // フラグが1の場合は空のまま表示
                if ($curriculum->always_delivery_flg == 1) {
                    $curriculum->filteredDeliveryTimes = $allDeliveryTimes->sortBy('delivery_from');
                    $filteredCurriculums[] = $curriculum;
                    continue;
                }

                // すべてのDeliveryTimeを取得する
                $curriculum->filteredDeliveryTimes = $allDeliveryTimes->sortBy('delivery_from');
                $filteredCurriculums[] = $curriculum;
            }

            return $filteredCurriculums;
        });
    }
}