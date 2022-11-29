<?php

namespace App\Contracts\Services\Post;

interface PostServiceInterface
{
    public function getPostsForPostPage();

    public function storePostForPostPage($request);
}