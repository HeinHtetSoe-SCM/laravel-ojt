<?php

namespace App\Contracts\Services\User;

interface UserServiceInterface
{
    public function register($request);

    public function getUser();

    public function update($request);

    public function changePassword($request);
}