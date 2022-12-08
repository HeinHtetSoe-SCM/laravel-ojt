<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Contracts\Services\Post\PostServiceInterface;
use App\Http\Requests\FileRequest;
use App\Http\Requests\PostRequest;

class PostController extends Controller
{
    private $postService;

    public function __construct(PostServiceInterface $postService)
    {
        $this->postService = $postService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = $this->postService->index();

        return view('posts.index', [
            'posts' => $posts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->postService->getCategories();
        return view('posts.create', [
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\PostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $this->postService->store($request);

        return redirect()->route('posts.index')->with('success', 'Post created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = $this->postService->edit($id);
        return view('posts.edit', compact('data'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\PostRequest  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request)
    {
        $this->postService->update($request, $request->id);

        return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
    }

    public function uploadFile(FileRequest $request)
    {
        $uploadMessage = $this->postService->uploadFile($request);

        if (array_key_exists("error", $uploadMessage->original)) {
            return redirect()->route('posts.index')->with('fail', 'Post format and number of CSV items do not match.');
        }
        
        return redirect()->route('posts.index')->with('success', 'Posts imported successfully');
    }

    public function downloadFile()
    {
        return $this->postService->downloadFile();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $this->postService->delete($id);

        return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
    }
}

