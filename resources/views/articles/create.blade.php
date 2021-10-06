@extends('layouts.app')

@section('title', ' | 新規記事作成')

@section('content')
    <div class="container pt-5">

        <form action="{{ route('articles.store') }}" enctype="multipart/form-data" method="POST" class="pt-5">
            @csrf
            <div class="form-group d-flex align-items-center">
                <label for="title" class="mb-0 w-25">タイトル</label>
                <input type="text" name="title" id="title" required class="form-control" value="{{ old('title') }}"placeholder="例）八幡平のうまいもん">
            </div>

            <div class="form-group d-flex align-items-center">
                <label for="category_id" class="mb-0 w-25">カテゴリー名</label>
                <select name="category_id" id="category_id" class="form-control">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @if ($category->id == old('category_id')) selected @endif>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group d-flex align-items-center">
                <label for="prefecture_id" class="mb-0 w-25">県名</label>
                <select name="prefecture_id" id="prefecture_id" class="form-control">
                    @foreach ($prefectures as $prefecture)
                        <option value="{{ $prefecture->id }}" @if ($prefecture->id == old('prefecture_id')) selected @endif>{{ $prefecture->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group d-flex align-items-center">
                <label for="city_name" class="mb-0 w-25">市町村名</label>
                <input type="text" name="city_name" id="city_name" required class="form-control" value="{{ old('city_name') }}" placeholder="例）八幡平市">
            </div>

            <div class="form-group d-flex align-items-center">
                <label for="bg_img_path" class="mb-0 w-25">メイン画像</label>
                <input type="file" name="bg_img_path" id="bg_img_path" class="form-controll">
                <img id="preview" width="200px">
            </div>

            <div class="form-group d-flex align-items-center">
                <label for="img_path" class="mb-0 w-25">画像リスト（複数可）</label>
                <input type="file" name="img_path[]" id="img_path" class="form-controll" multiple>
                <img id="preview2" width="200px">
            </div>

            <div class="form-group">
                <label for="body">内容</label>
                <textarea name="body" id="body" class="form-control">{{ old('body') }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary text-white font-weight-bold d-block ml-auto">投稿</button>
        </form>
    </div>
@endsection
