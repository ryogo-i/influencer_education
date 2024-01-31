<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\Curriculum;
use App\Models\DeliveryTime;
use Illuminate\Support\Facades\View;
use Carbon\Carbon;
use App\Models\Course; //Course（Class）から取得
use App\Models\User;

class UserController extends Controller
{
    public function showSchedule(Request $request)
    {
        // 全てのクラスを取得
        $class = Course::all();

        // ユーザーの情報を取得（ログイン画面作成前のテスト用）
        $user = User::find(1);

        // 現在のクラスIDと名前を取得
        $currentClassId = $user->now_class;
        $currentClass = Course::find($currentClassId);
        $currentClassName = $user && $user->now_class ? $currentClass->name : null;

        // サイドバーからのクラス選択
        $selectedClassId = $request->input('class_id');
        if ($selectedClassId) {
            $currentClassId = $selectedClassId;
            $currentClass = Course::find($currentClassId);
            $currentClassName = $currentClass->name;
        }

        // クラス選択後のカリキュラムのフィルタリング
        if ($currentClassId) {
            $filteredCurriculums = Curriculum::where('classes_id', $currentClassId)
                ->with('deliveryTimes')
                ->get();
        } else {
            $filteredCurriculums = Curriculum::with('deliveryTimes')->get();
        }

        // 表示する月の設定
        $currentMonth = $request->input('month') ? Carbon::parse($request->input('month')) : Carbon::now();
        $firstAllowedMonth = Carbon::create(2023, 4, 1);
        $lastAllowedMonth = Carbon::create(2024, 3, 31);

        if ($currentMonth->lt($firstAllowedMonth) || $currentMonth->gt($lastAllowedMonth)) {
            $currentMonth = Carbon::now();
        }

        // 配信カリキュラムのフィルタリング
        $curriculums = Curriculum::with('deliveryTimes')->get();
        $filteredCurriculums = [];
        $displayMonth = $currentMonth;
        foreach ($curriculums as $curriculum) {
            if ($curriculum->classes_id == $currentClassId) {
                $filteredDeliveryTimes = $curriculum->deliveryTimes->filter(function ($deliveryTime) use ($displayMonth) {
                    $from = Carbon::parse($deliveryTime->delivery_from)->format('Y年n月');
                    $to = Carbon::parse($deliveryTime->delivery_to)->format('Y年n月');
                    return $from <= $displayMonth->format('Y年n月') && $displayMonth->format('Y年n月') <= $to;
                });
                if ($filteredDeliveryTimes->isNotEmpty()) {
                    $curriculum->filteredDeliveryTimes = $filteredDeliveryTimes;
                    $filteredCurriculums[] = $curriculum;
                }
            }
        }

        // 前月と次月の設定
        $prevMonth = $currentMonth->copy()->subMonth()->format('Y-m');
        $nextMonth = $currentMonth->copy()->addMonth()->format('Y-m');
        $displayMonth = $currentMonth;

        // ビューを返す
        return view('authenticated.schedule', compact('curriculums', 'filteredCurriculums', 'prevMonth', 'nextMonth', 'displayMonth', 'class', 'currentClassName'));
    }
}
