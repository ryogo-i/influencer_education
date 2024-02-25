<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Grade;
use App\Models\Curriculum;
use App\Models\CurriculumProgress;

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
        $curriculum_progress = CurriculumProgress::where('users_id', $user->id)->get();

        // カリキュラムごとの進捗データ
        
        $curriculumProgressData = []; //カリキュラムごとの進捗データを格納するための空の配列を初期化

        foreach ($curriculums as $curriculum) {
            $isCleared = $curriculum_progress->where('curriculums_id', $curriculum->id)->first();//ユーザーが特定のカリキュラムを受講済みか
            $curriculumProgressData[$curriculum->id] = $isCleared;//カリキュラムごとにユーザーの受講済み情報を格納
        }

        return view('user.progress', compact('user', 'grades', 'curriculums', 'curriculumProgressData'));

    }
}