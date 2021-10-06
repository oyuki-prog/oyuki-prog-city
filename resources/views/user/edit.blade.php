@extends('layouts.app')

@section('title', ' | 記事編集')

@section('style')
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container pt-5">
        <form action="{{ route('user.update', $user) }}" method="POST" class="pt-5">
            @csrf
            @method('PATCH')
            <label for="self_intro" class="d-block">自己紹介文</label>
            <textarea name="self_intro" id="self_intro" class="w-100" required>{{ $user->self_intro }}</textarea>
            <button type="submit" class="btn btn-success d-block ml-auto">登録</button>
        </form>
    </div>
@endsection
