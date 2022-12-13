<?php

namespace App\Services\Post;

use App\Contracts\Dao\Post\PostDaoInterface;
use App\Contracts\Services\Post\PostServiceInterface;
use App\Models\Post;
use Illuminate\Http\Response;

class PostService implements PostServiceInterface
{
    private $postDao;

    public function __construct(PostDaoInterface $postDao)
    {
        $this->postDao = $postDao;
    }

    /**
     * Get posts for post page
     * 
     * @return object
     */
    public function index()
    {
        return $this->postDao->index();
    }

    public function getCategories()
    {
        return $this->postDao->getCategories();
    }
    /**
     * Store post for post page
     * @param object $request
     * @return object
     */
    public function store($request)
    {
        $image = $request->file('file');
        $imageName = null;
        if (!is_null($image)) {
            $imageName = time() . '.' . $image->getClientOriginalName();
            $location = 'images';
            $image->move($location, $imageName);
        }

        $request->image = $imageName;

        return $this->postDao->store($request);
    }

    /**
     * Edit post for post page
     * @param int $id
     * @return object
     */
    public function edit($id)
    {
        return $this->postDao->edit($id);
    }

    /**
     * Update post for post page
     * @param object $request
     * @param int $id
     * @return object
     */
    public function update($request, $id)
    {
        $image = $request->file('file');
        $imageName = Post::findOrFail($id)->image;
        if (!is_null($image)) {
            $imageName = time() . '.' . $image->getClientOriginalName();
            $location = 'images';
            $image->move($location, $imageName);
        }

        $request->image = $imageName;

        return $this->postDao->update($request, $id);
    }

    public function uploadFile($request)
    {
        $file = $request->file('file');
        if ($file) {
            $filename = $file->getClientOriginalName();
            $location = 'uploads';

            $file->move($location, $filename);
            $filepath = public_path($location . "/" . $filename);

            $file = fopen($filepath, 'r');
            $filteredDatas = [];

            $i = 0;
            while (($filedata = fgetcsv($file, filesize($filepath), ",")) !== FALSE) {
                $num = count($filedata);
                if ($num < 4) {
                    return [
                        'error' => 'invalid datas'
                    ];
                }

                if ($i == 0) {
                    $i++;
                    continue;
                }

                for ($c = 0; $c < $num; $c++) {
                    $filteredDatas[$i][] = $filedata[$c];
                }
                $i++;
            }
            fclose($file);
            unlink($filepath);

            foreach ($filteredDatas as $filteredData) {
                $title = $filteredData[0];
                $description = $filteredData[1];
                $status = $filteredData[2];
                $requestCategories = explode('|', trim($filteredData[3]));
                $data = [
                    'title' => $title,
                    'description' => $description,
                    'status' => $status,
                    'categories' => $requestCategories
                ];
                $this->postDao->uploadFile($data);
            }
            return [
                'success' => "Records successfully uploaded"
            ];
        } else {
            throw new \Exception('No file was uploaded', Response::HTTP_BAD_REQUEST);
        }
    }

    public function downloadFile()
    {
        return $this->postDao->downloadFile();
    }

    /**
     * Delete post for post page
     * @param int $id
     * @return object
     */
    public function delete($id)
    {
        return $this->postDao->delete($id);
    }
}
