<?php

namespace App\Http\Controllers;

use App\Models\post;
use Illuminate\Http\Request;
use app\Http\Controllers\Controller;
use Illuminate\Support\Facade\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $post = post::orderBy('id', 'description')->pagination(3);
        return view('post.index',['posts'=>$posts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=> 'required',
            'content'=> 'required',
        ]);
        $postData = ['title' => $request->title, 'content'=>$request->content];
        post::create($postData);
        return redirect('/post')->with(['message'=>'post added successfully!','status'=>'success']);
    }
    

    /**
     * Display the specified resource.
     */
    public function show(post $post)
    {
        return view('post.show',['post'=>$post]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(post $post)
    {
        return view('post.edit',['post'=>$post]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, post $post)
    {
        $postdata = ['title'=>$request->title, 'content'=>$request->content];
        $post->update($postData);
        return redirect('/post')->with(['message' => 'post updated successfully!', 'status'=>'success']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(post $post)
    {
        $post->delete();
        return redirect('/post')->with(['message' => 'post deleted successfully!', 'status'=>'success']);
    }
}
