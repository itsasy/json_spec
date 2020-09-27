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
        $articles = Article::applySorts(request('sort'))
            ->paginate(
                $perPage = request('page.size'),
                $columns = ['*'],
                $pageName = 'page[number]',
                $page = request('page.number')
            )->appends(request()->except('page.number'));

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
