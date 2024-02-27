<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiPostController extends Controller
{
    public function index()
    {
        // $posts = Post::all();
        $posts = Post::with('rUser:id,name')->get();
        return PostResource::collection($posts);
    }

    public function show($id)
    {
        $posts = Post::with('rUser:id,name')->with('rCategory:id,name')->findOrFail($id);
        return new PostResource($posts);
    }

    public function store(Request $request)
    {
        // return $request->file;

        $request->validate([
            'title' => 'required',
            'file' => 'required|mimes:png,jpg,jpeg,mp4,mkv,webm,mp3,m4a,',
            'body' => 'required',
        ]);
        $store = new Post();
        $files = $request->file('file');
        $ext = $files->getClientOriginalExtension();
        if ($ext == 'png' || $ext == 'jpg' || $ext == 'jpeg') {
            $ext = $request->file('file')->extension();
            $final = 'photo' . time() . '.' . $ext;
            $request->file('file')->move(storage_path('app/public/uploads/photo/'), $final);
            $store->file = $final;
        }
        if ($ext == 'mp4' || $ext == 'mkv' || $ext == 'webm') {
            $ext = $request->file('file')->extension();
            $final = 'video' . time() . '.' . $ext;
            $request->file('file')->move(storage_path('app/public/uploads/video/'), $final);
            $store->file = $final;
        }
        if ($ext == 'mp3' || $ext == 'm4a') {
            $ext = $request->file('file')->extension();
            $final = 'audio' . time() . '.' . $ext;
            $request->file('file')->move(storage_path('app/public/uploads/audio/'), $final);
            $store->file = $final;
        }
        $store->user_id = Auth::guard()->user()->id;
        $store->name = $request->title;
        $store->body = $request->body;
        $store->category_id = $request->category_id;
        $store->save();
        return new PostResource($store);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'body' => 'required',
        ]);
        $update = Post::findOrFail($id);
        $update->name = $request->input('name');
        $update->body = $request->input('body');
        $update->save();
        return new PostResource($update);
    }

    public function delete($id)
    {
        $delete = Post::findOrFail($id);
        $delete->delete();

        return 204;
    }
}
