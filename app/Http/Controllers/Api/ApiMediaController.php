<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class ApiMediaController extends Controller
{
    public function show($id)
    {
        $data = Post::where('user_id', $id)->get();
        return response()->json($data);
    }
}
