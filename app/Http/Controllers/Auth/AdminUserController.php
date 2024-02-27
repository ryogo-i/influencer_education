<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\AdminRegisterUser;
use App\Http\Requests\AdminLoginFormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    public function showAdminLogin()
    {
        return view('admin.login');
    }


    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        Log::info('Attempted credentials: ' . json_encode($credentials));

        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();


            return redirect()->intended('/admin/dashboard')->with('login_success', 'ログイン成功しました。');
        }

        return back()->withErrors([
            'login_error' => 'メールアドレスかパスワードが間違っています。',
        ]);
    }

    public function adminLogout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')->with('logout_success', 'ログアウト成功しました。');
    }

    //ユーザー登録
    public function showRegistrationForm()
    {
        return view('admin.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
        ]);

        try {
            AdminRegisterUser::registerUser(
                $request->input('name'),
                $request->input('email'),
                $request->input('password')
            );

            auth()->attempt($request->only('name', 'email', 'password'));

            return redirect('admin/login')->with('register', '登録成功しました。');
        } catch (\Exception $e) {
            \Log::error('エラーが発生しました: ' . $e->getMessage());

            return back()->withInput()->withErrors(['error' => 'ユーザー登録中にエラーが発生しました。']);
        }
    }


}