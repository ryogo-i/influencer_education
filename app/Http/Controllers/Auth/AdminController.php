<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use App\Models\Banner;

class AdminController extends Controller
{
    public function dashboard()
    {
        $admin = Auth::guard('admin')->user();

        return view('admin.dashboard', ['admin' => $admin]);
    }

    // バナー管理
    public function banner_management()
    {
        $banners = Banner::all();

        return view('admin.banner_management', ['banners' => $banners]);
    }

    //バナー消去
    public function delete($id)
    {
        try {
            $banner = new Banner();
            $banner->deleteBanner($id);
            return redirect('/admin/banner_management');
        } catch (\Exception $e) {
            \Log::error('エラーが発生しました: ' . $e->getMessage());
            return back()->withInput()->withErrors(['error' => 'エラーが発生しました。']);
        }
    }

    //バナー登録
    public function create(Request $request)
    {
        try {
            $banner = new Banner();
            $banner->createBanner($request);
        } catch (\Exception $e) {
            \Log::error('エラーが発生しました: ' . $e->getMessage());
            return back()->withInput()->withErrors(['error' => 'エラーが発生しました。']);
        }
    }


    //バナー変更
    public function update(Request $request, $id)
    {
        $banner = Banner::find($id);
        $request->validate([
            'bannerImage' => 'nullable|image|max:2048',
        ]);

        if (!$banner) {
            abort(404);
        }
        try {
            if ($request->hasFile('bannerImage')) {
                // 新しい画像がアップロードされた場合の処理
                $banner->updateBanner($request);
            }
            return redirect()->route('admin.banner_management', ['id' => $id])->with('success', '更新完了しました。');
        } catch (\Exception $e) {
            \Log::error('エラーが発生しました: ' . $e->getMessage());
            return back()->withInput()->withErrors(['error' => 'エラーが発生しました。']);
        }
    }
}