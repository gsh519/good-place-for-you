<?php

namespace App\Http\Controllers;

use App\Post;
use App\Http\Requests\PostRequest;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Post::class, 'post');
    }
    public function index()
    {
        $posts = Post::all()->sortByDesc('created_at');
        return view('posts.index', ['posts' => $posts]);
    }

    //記事作成画面
    public function create()
    {
        return view('posts.create');
    }

    //記事投稿処理
    public function store(PostRequest $request, Post $post)
    {
        $post->fill($request->all());
        $post->user_id = $request->user()->id;
        $post->save();
        return redirect()->route('posts.index');
    }

    //記事編集画面
    public function edit(Post $post)
    {
        return view('posts.edit', ['post' => $post]);
    }

    //記事更新処理
    public function update(PostRequest $request, Post $post)
    {
        $post->fill($request->all())->save();
        return redirect()->route('posts.index');
    }

    //記事削除処理
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index');
    }

    //記事詳細画面
    public function show(Post $post)
    {
        return view('posts.show', ['post' => $post]);
    }
}
