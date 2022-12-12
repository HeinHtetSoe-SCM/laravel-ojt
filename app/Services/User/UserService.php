<?php

namespace App\Services\User;

use App\Contracts\Dao\User\UserDaoInterface;
use App\Contracts\Services\User\UserServiceInterface;

class UserService implements UserServiceInterface
{
    private $userDao;

    public function __construct(UserDaoInterface $userDao)
    {
        $this->userDao = $userDao;
    }

    public function register($request)
    {
        return $this->userDao->register($request);
    }

    public function getUserData()
    {
        return $this->userDao->getUserData();
    }

    public function update($request)
    {
        return $this->userDao->update($request);
    }

    public function changePassword($request)
    {
        return $this->userDao->changePassword($request);
    }
}