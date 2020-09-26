<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        // $data = $post->orderBy('created_at','desc')->get();
        $data = Post::latest()->get();
        return view('frontend.welcome',compact('data'));
    }
}
