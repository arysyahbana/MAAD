<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function like($post_id)
    {
        $like = Like::where('post_id', $post_id)->where('user_id', auth()->user()->id)->first();

        if ($like) {
            $like->delete();
            return back();
        } else {
            Like::create([
                'post_id' => $post_id,
                'user_id' => auth()->user()->id
            ]);
            return back();
        }
    }

    public function like_show($name)
    {
        $page = 'like';
        $likePosts = Post::whereHas('rLike', function ($query) use ($name) {
            $query->where('name', $name);
        })->latest()->paginate(8);

        $show = User::where('name', $name)->first();

        return view('frontend.Post.front_like_show', compact('likePosts', 'show', 'page'));
    }
}
