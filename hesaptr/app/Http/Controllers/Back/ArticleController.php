<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Article;
use File;
use Illuminate\Http\Request;
use Image;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::orderByDesc('updated_at')->paginate(100);
        return view('back.article.index', compact('articles'));
    }
    public function create()
    {
        return view('back.article.create');
    }
    public function edit($id)
    {
        $article = Article::where('id', $id)->first();
        if ($article) {
            return view('back.article.edit', compact('article'));
        } else {
            return redirect()->back()->with('error', __('Not found'));
        }

    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:articles',
        ]);
        $article = new Article;
        $article->name = $request->name;
        $article->slug = $request->slug;
        $article->description = $request->description;
        $article->content = $request->content;
        if ($request->img) {
            $path = 'uploads/articles/p_' . time() . '.webp';
            $img = Image::make($request->img)->encode('webp')->save($path);
            $img->destroy();
            $article->img = $path;
        }
        $article->save();
        return redirect()->route('admin.article')->with('success', __('Added'));
    }
    public function update(Request $request)
    {

        $article = Article::where('id', $request->id)->first();
        if ($article) {
            if($request->slug != $article->slug){
                $request->validate([
                    'slug' => 'required|unique:articles',
                ]);
            }
           
            $article->name = $request->name;
            $article->slug = $request->slug;
            $article->description = $request->description;
            $article->content = $request->content;
            if ($request->img) {
                File::delete($article->img);
                $path = 'uploads/articles/p_' . time() . '.webp';
                $img = Image::make($request->img)->encode('webp')->save($path);
                $img->destroy();
                $article->img = $path;
            }
            $article->updated_at = now();
            $article->save();
            return redirect()->route('admin.article')->with('success', __('Updated'));
        } else {
            abort(404);
        }

    }

    public function delete(Request $request)
    {
        $article = Article::where('id', $request->id)->first();
        if ($article) {
            File::delete($article->img);
            $article->delete();
            return redirect()->back()->with('success', __('Deleted'));
        } else {
            return redirect()->back()->with('error', __('Not found'));
        }
    }
}
