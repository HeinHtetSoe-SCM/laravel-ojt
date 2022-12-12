<?php

namespace App\Dao\User;

use App\Models\User;
use App\Contracts\Dao\User\UserDaoInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserDao implements UserDaoInterface
{
    public function register($request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return $user;
    }

    public function getUserData()
    {
        return Auth::user();
    }

    public function update($request)
    {
        $loggedInUser = Auth::user();
        $user = User::findOrFail($loggedInUser->id);

        $user->update([
            'name' => $request->name,
            'email' => $request->email
        ]);
    }

    public function changePassword($request)
    {
        $loggedInUser = Auth::user();
        $user = User::findOrFail($loggedInUser->id);

        $user->update([
            'password' => Hash::make($request->password)
        ]);
    }
}