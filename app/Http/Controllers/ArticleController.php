<?php

namespace App\Http\Controllers;

use App\Http\Resources\ArticleResource;
use App\Http\Resources\ArticlesCollection;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        //        return ArticlesCollection::make($articleQuery->get());

        $articles = Article::applySorts(request('sort'))->get();

        return ArticlesCollection::make($articles);
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Article $article)
    {
        return ArticleResource::make($article);
    }

    public function update(Request $request, Article $article)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
