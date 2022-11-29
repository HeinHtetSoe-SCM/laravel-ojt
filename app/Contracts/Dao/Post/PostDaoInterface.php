<?php

namespace App\Contracts\Dao\Post;

interface PostDaoInterface
{
    public function getPostsForPostPage();

    public function storePostForPostPage($request);
}