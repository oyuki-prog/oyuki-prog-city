@extends('layouts.app')

@section('title', ' | 記事詳細')

@section('style')
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <style>
        .wallpaper {
            background: no-repeat url({{ $url }}) center center/cover;
            height: 100%;
        }

    </style>
@endsection

@section('content')
    <div class="wallpaper">
        <div class="head">
            <div class="container d-flex justify-content-center align-items-center">
                <div class="py-5 w-100">
                    <div class="d-flex align-items-center">
                        @if ($article->user->avatar_path)
                            <img src="{{ Storage::url($article->user->avatar_path) }}" class="avatar">
                        @endif
                        <a class="font-weight-bold d-inline-block pr-2" href="">{{ $article->user->name }}</a>が
                        @if ($article->created_at == $article->updated_at)
                            {{ date('Y年n月j日', strtotime($article->created_at)) }}に作成
                        @else
                            {{ date('Y年n月j日', strtotime($article->updated_at)) }}に更新
                        @endif
                    </div>
                    <div class="display-4 my-3">
                        {{ $article->title }}
                    </div>
                    <p class="mb-1 d-inline-block">
                        場所：{{ $article->prefecture->name }}
                        {{ $article->city_name }}
                    </p>
                    <p>
                        カテゴリー：{{ $article->category->name }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    @if (!empty($article->images[0]))
        <div class="d-flex article-images">
            @foreach ($article->images as $image)
                <img src="{{ Storage::url($image->img_path) }}" class="article-image">
            @endforeach
        </div>
    @endif

    <div class="container py-3 article-body">
        <p> {{ $article->body }} </p>
    </div>
@endsection
