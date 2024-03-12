<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Curriculum;
use Carbon\Carbon;
use App\Models\Course;
use App\Models\User;

class UserController extends Controller
{
    public function showSchedule(Request $request)
    {
        try {
            $classes = Course::getAllClasses();

            $userId = 1; // テスト用の ユーザーID
            $user = User::getUserById($userId);
            $currentClassData = Course::getCurrentClassData($userId);

            // クラス変更
            $selectedClassId = $request->input('class_id');
            if ($selectedClassId) {
                $currentClassId = $selectedClassId;
                $currentClass = Course::find($currentClassId);
                $currentClassName = $currentClass->name;
            } else {
                $currentClassId = $currentClassData['id'];
                $currentClassName = $currentClassData['name'];
            }

            // 表示月
            $currentMonth = $request->input('month') ? Carbon::parse($request->input('month')) : Carbon::now();
            $firstAllowedMonth = Carbon::create(2024, 4, 1);
            $lastAllowedMonth = Carbon::create(2025, 3, 31);

            if ($currentMonth->lt($firstAllowedMonth) || $currentMonth->gt($lastAllowedMonth)) {
                $currentMonth = Carbon::now();
            }

            // 配信カリキュラムのフィルタリング
            $curriculum = new Curriculum();
            $displayMonth = $request->input('month', Carbon::now()->format('Y-m'));
            $curriculums = Curriculum::filterByClassIdAndMonth($currentClassId, $displayMonth)->get();

            // 前月次月の設定
            $monthSettings = Course::getPrevAndNextMonth($currentMonth);
            $prevMonth = $monthSettings['prevMonth'];
            $nextMonth = $monthSettings['nextMonth'];
            $displayMonth = $monthSettings['displayMonth'];

            return view('authenticated.schedule', compact('curriculums', 'prevMonth', 'nextMonth', 'displayMonth', 'classes', 'currentClassName', 'currentClassId'));
        } catch (\Exception $e) {
            \Log::error('エラーが発生しました: ' . $e->getMessage());
            return back()->withInput()->withErrors(['error' => 'エラーが発生しました。']);
        }
    }
}