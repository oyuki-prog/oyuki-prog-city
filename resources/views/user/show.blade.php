@extends('layouts.app')

@section('title', ' | ' . $user->name)

@section('style')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endsection

@section('content')
    <div class="container py-5">
        <div class="pt-5 d-flex">
            <div class="icon-area d-flex justify-content-center rounded-circle border">
                @if ($user->avatar_path)
                    <img src="{{ Storage::url($user->avatar_path) }}" class="icon" id="preview">
                @else
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/ac/No_image_available.svg/1024px-No_image_available.svg.png" class="icon" id="preview">
                @endif
            </div>

            <div class="ml-5 w-75">
                <p class="h3 d-block mb-3 font-weight-bolder">{{ $user->name }}</p>
                @if ($user->prefecture_id)
                    <p class="h4 d-block mb-5">{{ $user->prefecture->name }}出身</p>
                @endif
                @if ($user->self_intro)
                    <p class="h4 d-inline-block mb-1">自己紹介</p>
                    @if ($user->id == Auth::id())
                        <a href="{{ route('user.edit', $user) }}">変更</a>
                    @endif
                    <p class="m-0 self-intro">{!! nl2br(e($user->self_intro)) !!}</p>
                @else
                    @if ($user->id == Auth::id())
                        <a href="{{ route('user.edit', $user) }}">自己紹介文を追加する</a>
                    @endif
                @endif
            </div>
        </div>

        @if ($user->id == Auth::id())
            <form action="{{ route('user.update', Auth::id()) }}" enctype="multipart/form-data" method="POST"
                class="icon-form">
                @csrf
                @method('PATCH')
                <input type="file" name="avatar_path" id="avatar_path" accept="image/*" class="d-block mt-3 file">
                <button type="submit" class="py-0 px-3 btn btn-success d-block my-2 mx-0">
                    @if ($user->avatar_path)
                        アイコンを更新
                    @else
                        アイコンを登録
                    @endif
                </button>
            </form>
        @endif
        @if (!empty($user->articles[0]))
            <p class="h3 d-block mt-5 margin">{{ $user->name }} さんの記事一覧</p>
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
                            <a class="font-weight-bold d-inline-block pr-2"
                                href="{{ route('user.show', $article->user) }}">{{ $article->user->name }}</a>が
                            @if ($article->created_at == $article->updated_at)
                                {{ date('Y年n月j日', strtotime($article->created_at)) }}に作成
                            @else
                                {{ date('Y年n月j日', strtotime($article->updated_at)) }}に更新
                            @endif
                        </div>
                        <div class="h3">
                            <a class="d-block py-2"
                                href="{{ route('articles.show', $article) }}">{{ $article->title }}</a>
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
                            <a
                                href="{{ route('category', $article->category_id) }}">{{ $article->category->name }}</a>
                        </p>
                    </div>
                </div>
            @endforeach
        @else
            <p class="d-block my-5 h3 margin">{{ $user->name }} さんが投稿した記事はありません</p>
        @endif
        @if ($user->id == Auth::id())
            <form id="delete-form" action="{{ route('user.destroy', Auth::id()) }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="btn btn-outline-danger d-block my-5" onclick="if(!confirm('今までに書いた記事も削除されます。\n本当に削除していいですか？')){return false}">アカウントを削除</button>
            </form>
        @endif
    </div>
@endsection
