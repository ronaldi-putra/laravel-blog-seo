<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        // $data = $post->orderBy('created_at','desc')->get();
        $data = Post::latest()->paginate(3);
        $category = Category::all();
        return view('frontend.welcome',compact('data','category'));
    }

    public function isi_blog($slug)
    {
        $data = Post::where('slug', $slug)->get();
        $category = Category::all();
        return view('frontend.isi',compact('data','category'));
    }

}
