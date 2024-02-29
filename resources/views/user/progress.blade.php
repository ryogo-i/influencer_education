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
                @foreach ($curriculumProgress as $progress)
                    @if ($progress->classes_id == $grade->id)
                        <div>
                            @if ($progress->clear_flg == 1)
                                <span class="clear_flg">受講済</span>
                            @else
                                <span class="not_clear">未受講</span>
                            @endif
                            @if ($user->grade->id >= $grade->id)
                                <a href="{{ route('user.curiiculum.show', ['id' => $progress->id]) }}">{{ $progress->title }}</a>
                            @else
                                <a>{{ $progress->title }}</a>
                            @endif
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    @endforeach
</div>

@endsection