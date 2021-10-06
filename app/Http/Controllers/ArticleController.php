<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Image;
use App\Models\Prefecture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Article::query();
        $prefectures = Prefecture::all();
        $categories = Category::all();

        $articles = $query->orderBy('updated_at','desc')->paginate(10);

        if ($request->input('keyword'))
        {
            $keyword = $request->input('keyword');
            $query->where('title', 'like', '%' . $keyword . '%')
                ->orWhere('body', 'like', '%' . $keyword . '%')
                ->orWhere('city_name', 'like', $keyword . '%')
                ->orWhereHas('prefecture', function ($query) use ($keyword) {
                    $query->where('name', 'like', $keyword . '%');
                })
                ->orWhereHas('category', function ($query) use ($keyword) {
                    $query->where('name', 'like', '%' . $keyword . '%');
                });
            $articles = $query->orderBy('created_at', 'desc')->paginate(10);
            return view('articles.index', compact('articles', 'keyword', 'prefectures', 'categories'));
        }

        return view('articles.index', compact('articles', 'prefectures', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $prefectures = Prefecture::all();
        return view('articles.create', compact('categories', 'prefectures'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $article = new Article();
        $article->fill($request->all());

        //メイン画像の保存処理
        if ($request->bg_img_path) {
            $file = $request->bg_img_path;
            $fileName = time() . $file->getClientOriginalName();
            $target_path = storage_path('app/public/bg_image');
            $file->move($target_path, $fileName);
            $article->bg_img_path ='bg_image/' . $fileName;
        }

        $article->user_id = Auth::id();
        $article->save();

        //画像リストの保存処理
        if ($files = $request->file('img_path')) {
            foreach ($files as $file) {
                $fileName = time() . $file->getClientOriginalName();
                $target_path = storage_path('app/public/article_image');
                $file->move($target_path, $fileName);

                //新たな画像レコードを作成
                $image = new Image();
                $image->article_id = $article->id;
                $image->img_path = 'article_image/' . $fileName;
                $image->save();
            }
        }


        return redirect('/articles');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        $user = Auth::user();
        $url = Storage::url($article->bg_img_path);
        return view('articles.show', compact('article', 'url', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        $user = Auth::user();
        if ($user->id != $article->user_id) {
            return redirect()->route('articles.index');
        }

        $categories = Category::all();
        $prefectures = Prefecture::all();
        return view('articles.edit', compact('article', 'categories', 'prefectures'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        $article->fill($request->all());

        //メイン画像の保存処理
        if ($file = $request->bg_img_path) {
            $fileName = time() . $file->getClientOriginalName();
            $target_path = storage_path('app/public/bg_image');
            $file->move($target_path, $fileName);
            $article->bg_img_path = 'bg_image/' . $fileName;
        }

        $user = Auth::user();

        $article->user_id = $user->id;
        $article->save();

        //画像リストの保存処理
        if ($files = $request->file('img_path')) {
            foreach ($article->images as $image) {
                $pathdelete = storage_path('app/public/') . $image->img_path;
                File::delete($pathdelete);
                $image = Image::find($image->id);
                $image->delete();
            }

            foreach ($files as $file) {
                $fileName = time() . $file->getClientOriginalName();
                $target_path = storage_path('app/public/article_image');
                $file->move($target_path, $fileName);

                //新たな画像レコードを作成
                $image = new Image();
                $image->article_id = $article->id;
                $image->img_path = 'article_image/' . $fileName;
                $image->save();
            }
        }

        return redirect()->route('articles.show', $article);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $article->delete();
        return redirect('/articles');
    }

    public function category($id)
    {
        $prefectures = Prefecture::all();
        $categories = Category::all();
        $category = Category::find($id);
        $header = $category->name;
        $query = Article::query();
        $query->where('category_id', $id);
        $articles = $query->orderBy('created_at', 'desc')->paginate(10);
        return view('articles.index', compact('articles', 'header', 'prefectures', 'categories'));
    }

    public function area($prefecture_id, $city_name)
    {
        $prefectures = Prefecture::all();
        $categories = Category::all();
        $query = Article::query();
        $prefecture = Prefecture::find($prefecture_id);

        if ($city_name != 1){
            $header = $prefecture->name . ' ' . $city_name;
            $query->where('prefecture_id', $prefecture_id)
            ->where('city_name', 'like', $city_name . '%');
        } else {
            $header = $prefecture->name;
            $query->where('prefecture_id', $prefecture_id);
        }

        $articles = $query->orderBy('created_at', 'desc')->paginate(10);
        return view('articles.index', compact('articles', 'header', 'prefectures', 'categories'));
    }
}
