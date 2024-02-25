<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Rules\CurrentPasswordRule;

class UserController extends Controller
{

    // トップ画面表示
    public function showTop() {
        return view('user.top');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // プロフィール変更画面表示
    public function showProfile()
    {
        // $user =  Auth::user();//ログインしているユーザー情報を取得
       //ログイン画面が別のため今は一番目の人がログインしたと仮定
       $user = User::find(1);


        // ユーザーが存在するか確認
        if ($user) {
            return view('user.profile', compact('user')); 
        } else {
            // 存在しない場合ログイン画面へ
            return redirect()->route('login')->with('error', 'ログインしてください。');
        }

    }

    // プロフィールを更新する
    public function updateProfile(Request $request) {
        // $user = Auth::user();　ログイン画面ない
        $user = User::find(1);

        $request->validate([
            'name' => 'required',
            'name_kana' => 'required',
            'email' => 'required',
        ]);

         // ユーザー情報を更新する
         DB::transaction(function() use($request, $user) {
            $user->fill([
                'name' => $request->input('name'),
                'name_kana' => $request->input('name_kana'),
                'email' => $request->input('email'),
            ]);
    
            // プロフィール画像がアップロードされた場合
            if ($request->hasFile('img_path')) {
                $image = $request->file('img_path');
                $imagePath = $image->store('public/images');
                $user->profile_image = str_replace('public/', '', $imagePath);
            }
    
            $user->save();
    
         });
        
        return redirect()->route('user.profile')
            ->with('success','プロフィールを更新しました。');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    // パスワード変更画面表示
    public function editPassword() //($id)
    {
        return view('user.password');
    }
    /**
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // パスワードの更新
    public function updatePassword(Request $request) {
        // $user = Auth::user();
        $user = User::find(1);

        $request->validate([
            'old_password' => ['required', new CurrentPasswordRule],
            'new_password' => ['required', 'confirmed', 'min:8'], //'confirmed' new_password_confirmationと一致するか確認

        ],
        [
            'old_password.required' => '旧パスワードは必須です。',
            'old_password.current_password' => '登録されているパスワードと一致しません。',
            'new_password.required' => '新パスワードは必須です。',
            'new_password.confirmed' => '新パスワードと新パスワード確認が一致しません。',
            'new_password.min' => '新パスワードは8文字以上で入力してください。',
        ]);

        //パスワードを変更
        $user->password = Hash::make($request->get('new_password'));
        $user->save();

        return redirect()->route('user.profile')->with('success', 'パスワードを変更しました');
        
    }
    
}
