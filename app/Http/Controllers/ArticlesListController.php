<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Repositories\ArticleRepository;

class ArticlesListController extends Controller
{

    public function blogIndex()
    {
        $yearBlogs = ArticleRepository::findPublishedBlogsAndGroupBySeason();
        return view('articles.blog.index', ['yearBlogs' => $yearBlogs]);
    }

    public function lookbookIndex()
    {
        $lookbooks = ArticleRepository::findPublishedLookbooks();
        return view('articles.lookbook.index', ['lookbooks' => $lookbooks]);
    }

}
