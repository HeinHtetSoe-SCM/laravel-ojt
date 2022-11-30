<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Contracts\Services\Post\PostServiceInterface;
use App\Http\Requests\PostRequest;

class PostController extends Controller
{
    private $postService;

    public function __construct(PostServiceInterface $postService)
    {
        $this->postService = $postService;
    }

    public function index()
    {
        $posts = $this->postService->index();

        return view('posts.index', [
            'posts' => $posts
        ]);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(PostRequest $request)
    {
        $this->postService->store($request);

        return redirect()->route('posts.index')->with('success', 'Post created successfully.');
    }

    public function edit($id)
    {
        $post = $this->postService->edit($id);

        return view('posts.edit', compact('post'));

    }

    public function update(PostRequest $request)
    {
        $this->postService->update($request, $request->id);

        return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
    }

    public function delete($id)
    {
        $this->postService->delete($id);

        return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
    }
}
