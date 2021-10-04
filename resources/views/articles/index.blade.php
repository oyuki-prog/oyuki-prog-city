@extends('layouts.app')

@section('title', ' | 記事一覧')

@section('content')
    <div class="container">
        @foreach ($articles as $article)
        <div class="mb-3 shadow py-3 px-4">
            <div>
                {{ $article->user->name }}による記事
            </div>
            <div class="h2">
                <a href="{{ route('articles.show', $article) }}">{{ $article->title }}</a>
            </div>
            <div>
                {{ $article->category->name }}
            </div>
        </div>
        @endforeach
    </div>
@endsection
