<?php

namespace App\Contracts\Dao\User;

interface UserDaoInterface
{
    public function register($request);

    public function getUserData();

    public function update($request);

    public function changePassword($request);
}