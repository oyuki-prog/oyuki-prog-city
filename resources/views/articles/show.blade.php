@extends('layouts.app')

@section('title', ' | 記事詳細')

@section('style')
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
                        <img src="{{ Storage::url($article->user->avatar_path) }}" class="avatar">
                        <a class="font-weight-bold" href="">{{ $article->user->name }}</a>による記事
                    </div>
                    <h2 class="d-block py-3 display-4">{{ $article->title }}</h2>
                        <p>
                            {{ $article->prefecture->name }}
                            {{ $article->city_name }}
                            {{ $article->category->name }}
                        </p>
                    @if ($article->created_at == $article->updated_at)
                        <p>{{ date('Y年n月j日', strtotime($article->created_at)) }}に作成</p>
                    @else
                        <p>{{ date('Y年n月j日', strtotime($article->updated_at)) }}に更新</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex article-images">
        @if (!empty($article->images))
            @foreach ($article->images as $image)
                <img src="{{ Storage::url($image->img_path); }}" class="article-image">
            @endforeach
            </ul>
        @endif
    </div>

    <div class="container py-5 article-body">
        <p> {{ $article->body }} </p>
    </div>
@endsection
