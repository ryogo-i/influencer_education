@extends('layouts.app')
@section('title', 'お知らせ')
@section('content')
<a class="back_button" href="">←戻る</a>

<p>{{ $curriculum->title }}</p>
<p>{{ $curriculum->description	 }}</p>


@endsection