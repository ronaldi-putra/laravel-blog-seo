<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $post = Post::paginate(5);
        return view('admin.post.index',compact('post'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tag = Tag::all();
        $category = Category::all();
        return view('admin.post.create', compact('category','tag'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|min:3',
            'categories_id' => 'required',
            'content' => 'required',
            'gambar' => 'required',
        ]);
        $gambar = $request->gambar;
        $new_gambar = time().$gambar->getClientOriginalName();

        $post = Post::create([
            'judul' => $request->judul,
            'slug' => Str::slug($request->judul,'-'),
            'categories_id' => $request->categories_id,
            'content' => $request->content,
            'gambar' => 'public/uploads/posts/'.$new_gambar,
            'user_id' => Auth::id()
        ]);
        $post->tag()->attach($request->tags);
        $gambar->move('public/uploads/posts/', $new_gambar);
        return redirect()->back()->with('sukses','Postingan anda berhasil disimpan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::all();
        $tag = Tag::all();
        $post = Post::findOrFail($id);
        return view('admin.post.edit', compact('post','tag','category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|min:3',
            'categories_id' => 'required',
            'content' => 'required',
        ]);

        $post = Post::findOrFail($id);

        if ($request->has('gambar')) {
            $gambar = $request->gambar;
            $new_gambar = time().$gambar->getClientOriginalName();
            $gambar->move('public/uploads/posts/', $new_gambar);

            $post_data = [
                'judul' => $request->judul,
                'slug' => Str::slug($request->judul,'-'),
                'categories_id' => $request->categories_id,
                'content' => $request->content,
                'gambar' => 'public/uploads/posts/'.$new_gambar,
            ];
        }else{
            $post_data = [
                'judul' => $request->judul,
                'slug' => Str::slug($request->judul,'-'),
                'categories_id' => $request->categories_id,
                'content' => $request->content,
            ];
        }

        $post->tag()->sync($request->tags);
        $post->update($post_data);
        return redirect('post')->with('sukses','Postingan anda berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return redirect()->back()->with('sukses','Postingan berhasil dihapus, silahkan cek Trashed post!');
    }

    public function tampil_hapus()
    {
        $post = Post::onlyTrashed()->paginate(5);
        return view('admin.post.hapus',compact('post'));
    }

    public function restore($id)
    {
        $post = Post::withTrashed()->where('id', $id)->first();
        $post->restore();

        return redirect()->back()->with('sukses','Postingan berhasil direstore, silahkan cek List Post!');
    }

    public function kill($id)
    {
        $post = Post::withTrashed()->where('id', $id)->first();
        $post->forceDelete();

        return redirect()->back()->with('sukses', 'Postingan berhasil dihapus secara permanen!');
    }
}
