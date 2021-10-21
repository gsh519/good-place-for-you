<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function show(string $tag_name)
    {
        $tag = Tag::where('tag_name', $tag_name)->first();
        return view('tags.show', ['tag' => $tag]);
    }
}
