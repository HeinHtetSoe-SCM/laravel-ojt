<?php

namespace App\Dao\Post;

use App\Models\Post;
use App\Contracts\Dao\Post\PostDaoInterface;
use App\Models\Category;
use Illuminate\Http\Response;
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
    public function getCategories() {
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
            'status' => $request->status
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
            'status' => $request->status
        ]);
        $post->categories()->detach();
        $post->categories()->attach($request->categories);
        return $post;
    }

    public function uploadFile($request)
    {
        $file = $request->file('file');
        if ($file) {
            $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $fileSize = $file->getSize();

            $this->checkUploadedFileProperties($extension, $fileSize);
            $location = 'uploads';

            $file->move($location, $filename);
            $filepath = public_path($location."/".$filename);

            $file = fopen($filepath, 'r');
            $importData_arr = array();
            $i = 0;
            while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
                $num = count($filedata);
                if ($i == 0) {
                    $i++;
                    continue;
                }

                for ($c = 0; $c < $num; $c++) {
                    $importData_arr[$i][] = $filedata[$c];
                }
                $i++;
            }
            fclose($file);

            $j = 0;
            foreach ($importData_arr as $importData) {
                $title = $importData[0];
                $description = $importData[1];
                $status = $importData[2];
                $requestCategories = explode(' | ', $importData[3]);
                $j++;

                try {
                    DB::beginTransaction();
                    $post = Post::create([
                        'title' => $title,
                        'description' => $description,
                        'status' => $status
                    ]);
                    DB::commit();
                    $databaseCategories = Category::all();
                    $categoryIds = [];
                    foreach ($databaseCategories as $databaseCategory) {
                        foreach ($requestCategories as $requestCategory) {
                            if ($databaseCategory->name === $requestCategory) {
                                array_push($categoryIds, $databaseCategory->id);
                            }
                        }
                    }
                    $post->categories()->attach($categoryIds);
                } catch (\Exception $e) {
                    dd($e);
                    DB::rollBack();
                }
            }
            return response()->json([
                'message' => "$j records successfully uploaded"
            ]);
        } else {
            throw new \Exception('No file was uploaded', Response::HTTP_BAD_REQUEST);
        }
    }

    public function checkUploadedFileProperties($extension, $fileSize)
    {
        $valid_extension = array("csv", "xlsx");
        $maxFileSize = 2097152;

        if (in_array(strtolower($extension), $valid_extension)) {
            if ($fileSize <= $maxFileSize) {

            } else {
                throw new \Exception('No file was uploaded', Response::HTTP_REQUEST_ENTITY_TOO_LARGE);
            }
        } else {
            throw new \Exception('Invalid file extension', Response::HTTP_UNSUPPORTED_MEDIA_TYPE);
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

        $callback = function() use($posts, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($posts as $post) {
                $categoryNames = $post->categories->pluck('name')->toArray();

                $row['Title'] = $post->title;
                $row['Description'] = $post->description;
                $row['Status'] = $post->status;
                $row['Categories'] = implode(' | ', $categoryNames);

                fputcsv($file, [ $row['Title'], $row['Description'], $row['Status'], $row['Categories'] ]);
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
