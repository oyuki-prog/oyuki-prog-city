@extends('layouts.app')

@section('title', ' | ' . $user->name)

@section('style')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endsection

@section('content')
    <div class="container pt-5">
        <div class="pt-5 d-flex">
            <div class="icon-area d-flex align-items-center justify-content-center">
                @if ($user->avatar_path)
                    <img src="{{ Storage::url($user->avatar_path) }}" class="icon">
                @else
                    <p class="mb-0 d-block font-weight-bolder w-100 h-100 bg-gray">No Image</p>
                @endif
            </div>
            <div class="ml-5 w-75">
                <p class="h3 d-block mb-3 font-weight-bolder">{{ $user->name }}</p>
                @if ($user->prefecture_id)
                    <p class="h4 d-block mb-3">{{ $user->prefecture->name }}出身</p>
                @endif
                <p class="h4 d-block mb-3">自己紹介</p>
                @if ($user->self_intro)
                    <p class="m-0">{!! nl2br(e($user->self_intro)) !!}</p>
                @endif
            </div>
        </div>

        @if (!empty($user->articles))
            <p class="h3 d-block mt-5">{{ $user->name }} さんの記事一覧</p>
            @foreach ($user->articles as $article)
        <div class="mb-3 shadow d-flex align-items-center">
                <div class="img-area d-flex justify-content-center align-items-center">
                    @if ($article->bg_img_path)
                        <img src="{{ Storage::url($article->bg_img_path) }}" class="main-img">
                    @else
                        <p class="mb-0">画像なし</p>
                    @endif
                </div>
                <div class="w-75 pl-3 align-middle">
                    <div class="d-flex align-items-center">
                        @if ($article->user->avatar_path)
                            <img src="{{ Storage::url($article->user->avatar_path) }}" class="avatar">
                        @endif
                        <a class="font-weight-bold d-inline-block pr-2" href="{{ route('user.show', $article->user) }}">{{ $article->user->name }}</a>が
                        @if ($article->created_at == $article->updated_at)
                            {{ date('Y年n月j日', strtotime($article->created_at)) }}に作成
                        @else
                            {{ date('Y年n月j日', strtotime($article->updated_at)) }}に更新
                        @endif
                    </div>
                    <div class="h3">
                        <a class="d-block py-2" href="{{ route('articles.show', $article) }}">{{ $article->title }}</a>
                    </div>
                    <p class="mb-1 d-inline-block">
                        場所：
                        <a href="{{ route('area', [$article->prefecture_id, 1]) }}">
                            {{ $article->prefecture->name }}
                        </a>
                        <a href="{{ route('area', [$article->prefecture_id, $article->city_name]) }}">
                            {{ $article->city_name }}
                        </a>
                    </p>
                    <p>
                        カテゴリー：
                        <a href="{{ route('category', $article->category_id) }}">{{ $article->category->name }}</a>
                    </p>
                </div>
            </div>
            @endforeach
        @else
            <p>{{ $user->name }} さんはまだ記事を投稿していません</p>
        @endif
    </div>
@endsection
