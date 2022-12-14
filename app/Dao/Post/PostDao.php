<?php

namespace App\Dao\Post;

use App\Models\Post;
use App\Contracts\Dao\Post\PostDaoInterface;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class PostDao implements PostDaoInterface
{
    /**
     * Get post for post page
     * 
     * @return object
     */
    public function index()
    {
        return Post::latest()->paginate(5);
    }

    /**
     * get category data to create post
     * 
     * @return object
     */
    public function getCategories()
    {
        return Category::all();
    }

    /**
     * Store post for post page
     * @param object $request
     * @return object
     */
    public function store($request)
    {
        $post = Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'image' => $request->image
        ]);

        $post->categories()->attach($request->categories);
        return $post;
    }

    /**
     * Edit post for post page
     * @param int $id
     * @return object
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $categories = Category::all();
        $oldCategoryIds = $post->categories->pluck('id')->toArray();
        return [
            "post" => $post,
            "categories" => $categories,
            "oldCategoryIds" => $oldCategoryIds
        ];
    }

    /**
     * Update post for post page
     * @param object $request
     * @param int $id
     * @return object
     */
    public function update($request, $id)
    {
        $post = Post::findOrFail($id);
        $post->update([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'image' => $request->image
        ]);
        $post->categories()->detach();
        $post->categories()->attach($request->categories);
        return $post;
    }

    public function uploadFile($request)
    {
        try {
            $existPost = Post::where('title', $request['title'])->first();

            if(empty($existPost)) {
                $existPost = Post::create([
                    'title' => $request['title'],
                    'description' => $request['description'],
                    'status' => $request['status']
                ]);
            } else {
                $existPost->update([
                    'title' => $request['title'],
                    'description' => $request['description'],
                    'status' => $request['status']
                ]);
            }

            $categoryIds = [];
            foreach ($request['categories'] as $category) {
                if (trim($category)) {
                    $existCategory = Category::where('name', $category)->first();
                    if (empty($existCategory)) {
                        $existCategory = Category::create(['name' => $category]);
                    }
                    $categoryIds[] = $existCategory->id;
                }
            }
            $existPost->categories()->detach();
            $existPost->categories()->attach($categoryIds);
        } catch (\Exception $e) {
            dd($e);
            DB::rollBack();
        }
    }

    public function downloadFile()
    {
        $fileName = 'posts.csv';
        $posts = Post::all();

        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];

        $columns = [
            'Title',
            'Description',
            'Status',
            'Categories'
        ];

        $callback = function () use ($posts, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($posts as $post) {
                $categoryNames = $post->categories->pluck('name')->toArray();

                $row['Title'] = $post->title;
                $row['Description'] = $post->description;
                $row['Status'] = $post->status;
                $row['Categories'] = implode('|', $categoryNames);

                fputcsv($file, [$row['Title'], $row['Description'], $row['Status'], $row['Categories']]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Delete post for post page
     * @param int $id
     * @return object
     */
    public function delete($id)
    {
        $post = Post::findOrFail($id);
        return $post->delete();
    }
}
