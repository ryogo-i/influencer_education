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

    public function getCurriculums()
    {
        return $this->curriculums()->with('deliveryTimes')->get();
    }

    public static function getCurrentClassNameAndId($userId)
    {
        return DB::transaction(function () use ($userId) {
            $user = User::find($userId);
            if (!$user) {
                return null;
            }

            $currentClassId = $user->now_class;
            $currentClass = static::find($currentClassId);
            $currentClassName = $user && $user->now_class ? $currentClass->name : null;

            return [
                'id' => $currentClassId,
                'name' => $currentClassName,
            ];
        });
    }

    public static function getPrevAndNextMonth($currentMonth)
    {
        return DB::transaction(function () use ($currentMonth) {
            $prevMonth = $currentMonth->copy()->subMonth()->format('Y-m');
            $nextMonth = $currentMonth->copy()->addMonth()->format('Y-m');
            return [
                'prevMonth' => $prevMonth,
                'nextMonth' => $nextMonth,
                'displayMonth' => $currentMonth,
            ];
        });
    }

    public static function getAllClasses()
    {
        return static::all();
    }

    public static function getCurrentClassData($userId)
    {
        return static::getCurrentClassNameAndId($userId);
    }
}