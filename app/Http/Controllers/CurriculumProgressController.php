<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Grade;
use App\Models\Curriculum;
use App\Models\CurriculumProgress;
use Illuminate\Support\Facades\DB;


class CurriculumProgressController extends Controller
{
    //授業進捗画面を表示
    public function indexProgress() {
        // $user =  Auth::user();//ログインしているユーザー情報を取得
        //ログイン画面が別のため今は一番目の人がログインしたと仮定
        $user = User::find(1);
        $grades = Grade::all();
        $curriculums = Curriculum::all();

        // 受講済みを表示、非表示の処理
        // 指定されたユーザーの進捗データ
        $curriculumProgress = DB::table('curriculums')
            ->leftJoin('curriculum_progress', 'curriculums.id', '=', 'curriculum_progress.curriculumus_id')
            ->select('curriculums.*', 'curriculum_progress.clear_flg')
            ->where('curriculum_progress.users_id', $user->id)
            ->orWhereNull('curriculum_progress.curriculumus_id')
            ->get();


        // カリキュラムごとの進捗データ
        
        $curriculumProgressData = []; //カリキュラムごとの進捗データを格納するための空の配列を初期化

        foreach ($curriculums as $curriculum) {
            $isCleared = $curriculumProgress->where('curriculumus_id', $curriculum->id)->first();
            $curriculumProgressData[$curriculum->id] = $isCleared;
        }


        return view('user.progress', compact('user', 'grades', 'curriculums', 'curriculumProgressData'));

    }
}