<?php

namespace App\Http\Controllers;

use App\Post;
use App\Tag;
use App\Http\Requests\PostRequest;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
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
        $allTagNames = Tag::all()->map(function ($tag) {
            return ['text' => $tag->tag_name];
        });

        return view('posts.create', [
            'allTagNames' => $allTagNames,
        ]);
    }

    //記事投稿処理
    public function store(PostRequest $request, Post $post)
    {
        $post->fill($request->all());
        $post->user_id = $request->user()->id;
        $post->save();

        $request->tags->each(function ($tagName) use ($post) {
            $tag = Tag::firstOrCreate(['tag_name' => $tagName]);
            $post->tags()->attach($tag);
        });

        return redirect()->route('posts.index');
    }

    //記事編集画面
    public function edit(Post $post)
    {
        $tagNames = $post->tags->map(function ($tag) {
            return ['text' => $tag->tag_name];
        });

        $allTagNames = Tag::all()->map(function ($tag) {
            return ['text' => $tag->tag_name];
        });

        return view('posts.edit', [
            'post' => $post,
            'tagNames' => $tagNames,
            'allTagNames' => $allTagNames,
        ]);
    }

    //記事更新処理
    public function update(PostRequest $request, Post $post)
    {
        $post->fill($request->all())->save();

        $post->tags()->detach();
        $request->tags->each(function ($tagName) use ($post) {
            $tag = Tag::firstOrCreate(['tag_name' => $tagName]);
            $post->tags()->attach($tag);
        });
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

    //いいね機能処理
    public function like(Request $request, Post $post)
    {
        $post->likes()->detach($request->user()->id);
        $post->likes()->attach($request->user()->id);

        return [
            'id' => $post->id,
            'countLikes' => $post->count_likes,
        ];
    }

    public function unlike(Request $request, Post $post)
    {
        $post->likes()->detach($request->user()->id);

        return [
            'id' => $post->id,
            'countLikes' => $post->count_likes,
        ];
    }
}
