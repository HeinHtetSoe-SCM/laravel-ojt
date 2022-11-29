<?php

namespace App\Dao\Post;

use DB;
use App\Models\Post;
use App\Contracts\Dao\Post\PostDaoInterface;

class PostDao implements PostDaoInterface
{
    public function getPostsForPostPage()
    {   
        return Post::all();
    }
}