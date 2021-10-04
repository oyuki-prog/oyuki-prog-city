@extends('layouts.app')

@section('title', ' | 記事一覧')

@section('content')
    <div class="container">
        @foreach ($articles as $article)
        <div class="mb-3 shadow d-flex align-items-center">
            <div class="img-area">
                <img src="{{ Storage::url($article->bg_img_path) }}" class="main-img">
            </div>
            <div class="w-75 pl-3 align-middle">
                <div>
                    {{ $article->user->name }}による記事
                </div>
                <div class="h2">
                    <a class="d-block py-2" href="{{ route('articles.show', $article) }}">{{ $article->title }}</a>
                </div>
                <div>
                    {{ $article->category->name }}
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="d-flex justify-content-center">
        {{ $articles->links() }}
    </div>
@endsection
