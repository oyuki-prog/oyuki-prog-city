<div class="container pt-5">
    <form class="form-group d-flex pt-3 align-items-center" method="GET" action="{{ route('articles.index') }}">
        <p class="d-block mb-0 w-25">キーワード検索</p>
        <input class="form-control mr-sm-2" type="search" name="keyword" placeholder="{{ __('Keyword') }}">
        <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Search</button>
    </form>
</div>
