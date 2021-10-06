@extends('layouts.app')

@section('title', ' | 記事一覧')

@section('style')
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
@endsection

@section('content')
@include('partial.search')
<div class="container mt-3">
        @if (!empty($header))
            <h3 class="d-block mb-3">{{ $header }}の記事一覧</h3>
        @endif
        @if (!empty($keyword))
            <h3 class="d-block mb-3">{{ $keyword }}を含む記事一覧</h3>
        @endif
        @if ($articles->total == 0)
            <h2>該当する記事はありません</h2>
        @endif
        @foreach ($articles as $article)
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
                        <a href="{{ route('area', [$article->prefecture_id, 'empty']) }}">
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
    </div>
    <div class="d-flex justify-content-center">
        {{ $articles->links() }}
    </div>
@endsection
