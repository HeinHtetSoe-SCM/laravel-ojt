<?php

namespace App\Contracts\Services\User;

interface UserServiceInterface
{
    public function register($request);

    public function getUserData();

    public function update($request);

    public function changePassword($request);
}