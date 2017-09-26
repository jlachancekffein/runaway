<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Auth;
use Carbon\Carbon;

class ShowArticleController extends Controller
{

    public function show($slug)
    {
        $article = $this->getCurrentLanguageArticleBySlug($slug);

        if (!$article) {
            $articles = $this->getArticlesBySlug($slug);

            if ($articles->count() !== 1) {
                abort(404);
            }

            $article = Article::find($articles->first()->id);
        }

        $contents = json_decode($article->content, true);

        foreach ($contents as $key => $content) {
            if ($content['templateId'] === 'blockText') {
                $contents[$key]['data']['text0'] = isset($contents[$key]['data']['text0']) ? $contents[$key]['data']['text0'] : '';
                $contents[$key]['data']['text1'] = isset($contents[$key]['data']['text1']) ? $contents[$key]['data']['text1'] : '';
            } elseif ($content['templateId'] === 'blockImageText') {
                $contents[$key]['data']['text'] = isset($contents[$key]['data']['text']) ? $contents[$key]['data']['text'] : '';
            } elseif ($content['templateId'] === 'blockTextImage') {
                $contents[$key]['data']['text'] = isset($contents[$key]['data']['text']) ? $contents[$key]['data']['text'] : '';
            }
        }

        $article->content = $contents;

        return view('articles.' . $article->section . '.show', compact('article'));
    }

    private function getCurrentLanguageArticleBySlug($slug)
    {
        $articleQuery = Article::whereHas('translations', function ($query) use ($slug) {
            $query->where('locale', session('locale'))
                ->where('seo_slug', $slug);
        });

        if (Auth::guest() || Auth::user()->role !== 'admin') {
            $articleQuery->where('status', 'approved')
                ->where('publication_date', '<=', Carbon::now());
        }

        return $articleQuery->first();
    }

    private function getArticlesBySlug($slug)
    {
        $articleQuery = Article::whereHas('translations', function ($query) use ($slug) {
            $query->where('seo_slug', $slug);
        });

        if (Auth::guest() || Auth::user()->role !== 'admin') {
            $articleQuery->where('status', 'approved')
                ->where('publication_date', '<=', Carbon::now());
        }

        return $articleQuery->get();
    }

}
