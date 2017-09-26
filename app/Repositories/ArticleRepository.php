<?php

namespace App\Repositories;

use App\Models\Article;
use Auth;
use Carbon\Carbon;
use File;
use Illuminate\Http\UploadedFile;
use Image;
use Storage;

class ArticleRepository
{

    public static function findById($id)
    {
        return Article::findOrFail($id);
    }

    public static function findPublishedBlogsAndGroupBySeason()
    {
        /** @var Article[] $articles */
        $articlesQuery = Article::where('section', 'blog');


        if (Auth::guest() || Auth::user()->role !== 'admin') {
            $articlesQuery->where('status', 'approved')
                ->where('publication_date', '<=', date('Y-m-d'));
        }

        $articles = $articlesQuery->orderBy('publication_date', 'DESC')->get();

        $reorderedArticles = [];

        foreach ($articles as $article) {
            $article->content = json_decode($article->content, true);
            $season = $article->getPublicationSeason();
            $year = $article->getPublicationYear();

            if (!isset($reorderedArticles[$year][$season])) {
                $reorderedArticles[$year][$season] = [];
            }

            $reorderedArticles[$year][$season][] = $article;
        }

        return $reorderedArticles;
    }

    public static function findPublishedLookbooks()
    {
        /** @var Article[] $articles */
        $articlesQuery = Article::where('section', 'lookbook');


        if (Auth::guest() || Auth::user()->role !== 'admin') {
            $articlesQuery->where('status', 'approved')
                ->where('publication_date', '<=', date('Y-m-d'));
        }

        return $articlesQuery->orderBy('publication_date', 'DESC')->get();
    }

    public static function insertArticle($articleArray)
    {
        $sanitizedArticleArray = self::sanitizeArticleArrayBeforeSave($articleArray);
        return Article::create($sanitizedArticleArray);
    }

    public static function updateArticle(Article $article, $articleArray)
    {
        $sanitizedArticleArray = self::sanitizeArticleArrayBeforeSave($articleArray);

        $article->status = $sanitizedArticleArray['status'];
        $article->publication_date = $sanitizedArticleArray['publication_date'];

        foreach (config('app.available_locales') as $language) {
            foreach (['title', 'description', 'seo_title', 'seo_description', 'seo_slug', 'image', 'content'] as $key) {
                $article->translateOrNew($language)->$key = $sanitizedArticleArray[$language][$key];
            }
        }

        $article->save();
        return $article;
    }

    private static function sanitizeArticleArrayBeforeSave($articleArray)
    {
        foreach (config('app.available_locales') as $language) {
            $articleArray[$language]['seo_title'] = $articleArray[$language]['title'];
            $articleArray[$language]['seo_slug'] = str_slug($articleArray[$language]['title']);

            if (!isset($articleArray[$language]['description'])) {
                $articleArray[$language]['description'] = '';
            }

            $articleArray[$language]['seo_description'] = str_limit($articleArray[$language]['description'], 150);

            if (!isset($articleArray[$language]['content'])) {
                $articleArray[$language]['content'] = [];
            }

            $articleArray[$language]['content'] = json_encode($articleArray[$language]['content']);
        }

        if (empty($articleArray['publication_date']) && $articleArray['status'] === 'approved') {
            $articleArray['publication_date'] = date('Y-m-d');
        }

        return $articleArray;
    }
}
