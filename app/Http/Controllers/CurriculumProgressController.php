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
    public function indexProgress()
    {
        // $user =  Auth::user();//ログインしているユーザー情報を取得
        //ログイン画面が別のため今は一番目の人がログインしたと仮定
        $user = User::find(1);

        // Classesをクエリビルダーで取得
        $grades = DB::table('classes')->get();

        // Curriculumsをクエリビルダーで取得
        $curriculums = DB::table('curriculums')->get();

        // 受講済みを表示、非表示の処理
        // 指定されたユーザーの進捗データ
        $curriculumProgress = DB::table('curriculums')
            ->leftJoin('curriculum_progress', 'curriculums.id', '=', 'curriculum_progress.curriculumus_id')
            ->leftJoin('classes', 'curriculums.classes_id', '=', 'classes.id') // Join Classes
            ->select('curriculums.*', 'curriculum_progress.clear_flg', 'classes.*') // Select Classes columns
            ->where('curriculum_progress.users_id', $user->id)
            ->orWhereNull('curriculum_progress.curriculumus_id')
            ->get();

        return view('user.progress', compact('user', 'grades', 'curriculums', 'curriculumProgress'));
    }
}
