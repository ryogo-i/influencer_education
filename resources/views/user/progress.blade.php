@extends('layouts.app')
@section('title', '授業進捗画面')
@section('content')
<a class="back_button" href="{{ route('user.top') }}">←戻る</a>
<div class="user_progress">
    <input type="hidden" name="id" value="{{ $user->id }}">
    @if($user->profile_image)
        <img src="{{ asset('storage/' . $user->profile_image) }}" alt="プロフィール画像" id="image">
    @else
        <img src="{{ asset('images/no-image.png') }}" alt="プロフィール画像">
    @endif
    <div>
        <p>{{ $user->name }}の授業進捗</p>
        <p>現在の学年: <span class="user_grade">{{ $user->grade->name }}</span></p>
    </div>
</div>

<div class="grade_class_container">
    @foreach ($grades as $grade)
    <div class="grade_class_title">
        <div class="grade">
            <p>{{ $grade->name }}</p>
        </div>
        <div class="class_title">
            @foreach ($curriculums as $curriculum)
                @if ($curriculumProgressData[$curriculum->id] && $curriculumProgressData[$curriculum->id]->clear_flg == 1)
                    <span class="clear_flg">受講済</span>
                @endif
                @if ($curriculum->classes_id == $grade->id)
                        @if ($user->grade->id >= $grade->id)
                            <a href="{{ route('user.curiiculum.show', ['id' => $curriculum->id]) }}">{{ $curriculum->title }}</a>
                        @else
                            <a>{{ $curriculum->title }}</a>
                        @endif
                    @endif
            @endforeach
        </div>
        </div>
    @endforeach
</div>

@endsection