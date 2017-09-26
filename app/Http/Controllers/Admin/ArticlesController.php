<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Models\Article;
use App\Models\ArticleTranslation;
use App\Repositories\ArticleRepository;
use Auth;
use File;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Image;
use Storage;

class ArticlesController extends Controller
{

    public function index($section)
    {
        $articles = Article::where('section', $section)->get();

        return view('admin.articles.index', compact('articles', 'section'));
    }

    public function create($section)
    {
        return view('admin.articles.create', compact('section'));
    }

    public function store(StoreArticleRequest $request)
    {
        $article = ArticleRepository::insertArticle($request->input());

        session()->flash('status', ucfirst($article->section) . ' créé');

        return [
            'redirect' => '/admin/articles/' . $article->section
        ];
    }

    public function upload(Request $request)
    {
        $file = $request->file('file');

        $filename = $this->getPathnameFromFilename(sha1_file($file->getPathname())) . '.' . $file->extension();
        $file->move(dirname($filename), basename($filename));

        return [
            'path' => str_replace(base_path('storage/app/public'), '/storage', $filename)
        ];
    }

    public function edit($section, $id)
    {
        $article = ArticleRepository::findById($id);

        return view('admin.articles.edit', compact('article'));
    }

    public function update(UpdateArticleRequest $request, $section, $id)
    {
        $article = ArticleRepository::findById($id);
        ArticleRepository::updateArticle($article, $request->input());

        session()->flash('status', ucfirst($article->section) . ' sauvegardé');

        return [
            'redirect' => '/admin/articles/' . $article->section
        ];
    }

    public function destroy($section, $id)
    {
        ArticleTranslation::where('article_id', $id)->delete();
        Article::destroy($id);
        session()->flash('status', ucfirst($section) . ' supprimée');

        $user = Auth::user();
        logger("User #$user->id deleted article #$id");

        return redirect(route('articles.index', ['section' => $section]));
    }

    private function getPathnameFromFilename($filename)
    {
        return storage_path(implode('/', [
            'app/public/articles',
            substr($filename, 0, 1),
            substr($filename, 1, 1),
            substr($filename, 2, 1),
            $filename
        ]));
    }

}
