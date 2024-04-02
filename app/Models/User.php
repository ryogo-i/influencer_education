<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'name_kana',
        'email',
        'password',
        'profile_image',
        'classes_id',
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // classesテーブルとの関係性
    public function grade() {
        return $this->belongsTo(Grade::class, 'classes_id');
    }

    public function getProfile() {
        // userテーブルからデータを取得
        $profiles = User::all();

        return $profiles;
    }

    // classes_clear_checksテーブルのclasses_idを関連付け
    public function classesClearCheck() {
        return $this->belongsTo(ClassesClearCheck::class, 'classes_id');
    }

    // curriculum_progress	テーブルとの関連性
    public function curriculumProgress() {
        return $this->hasMany(CurriculumProgress::class, 'users_id');
    }
}
