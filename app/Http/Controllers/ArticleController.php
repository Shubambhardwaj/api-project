<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $article = Article::create([
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => Auth::id(),
        ]);

        return response()->json($article, 201);
    }

    public function index()
    {
        $articles = Article::where('user_id', Auth::id())->get();
        return response()->json($articles);
    }

    public function show($id)
    {
        $article = Article::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        return response()->json($article);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $article = Article::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $article->update($request->only(['title', 'content']));
        return response()->json($article);
    }

    public function destroy($id)
    {
        $article = Article::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $article->delete();
        return response()->json(null, 204);
    }
}
