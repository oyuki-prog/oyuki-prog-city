@extends('layouts.app')

@section('title', ' | 記事一覧')

@section('style')
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container mt-3">
        @foreach ($articles as $article)
            <div class="mb-3 shadow d-flex align-items-center">
                <div class="img-area">
                    @if ($article->bg_img_path)
                        <img src="{{ Storage::url($article->bg_img_path) }}" class="main-img">
                    @else
                        <p class="align-middle h-100 d-inline-block">画像なし</p>
                    @endif
                </div>
                <div class="w-75 pl-3 align-middle">
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
                    <div class="h3">
                        <a class="d-block py-2" href="{{ route('articles.show', $article) }}">{{ $article->title }}</a>
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
        @endforeach
    </div>
    <div class="d-flex justify-content-center">
        {{ $articles->links() }}
    </div>
@endsection
