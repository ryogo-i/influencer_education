<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Banner extends Model
{
    use HasFactory;

    protected $fillable = ['image'];

    public function deleteBanner($id)
    {
        $banner = $this->findOrFail($id);

        $banner->delete();
    }


    public function createBanner($request)
    {
        if ($request->hasFile('bannerImage')) {
            $path = $request->file('bannerImage')->store('public/banners');
            $path = str_replace('public/', '', $path); //publicを含むパスに保存されてしまうため、変更

            $banner = new Banner();
            $banner->image = $path;
            $banner->save();
        } else {
            throw new \Exception('No file provided!');
        }
    }

    public function updateBanner($request)
    {
        if ($request->hasFile('bannerImage')) {
            // 既存の画像を削除
            Storage::delete('public/' . $this->image);

            // 新しい画像を保存
            $path = $request->file('bannerImage')->store('public/banners');
            $path = str_replace('public/', '', $path); //publicを含むパスに保存されてしまうため、変更
            $this->image = $path;
            $this->save();
        } else {
            throw new \Exception('No file provided!');
        }
    }
}