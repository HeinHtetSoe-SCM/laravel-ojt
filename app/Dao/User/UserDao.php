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

    public function getUser()
    {
        return Auth::user();
    }

    public function update($request)
    {
        User::where('id', auth()->id())->update([
            'name' => $request->name,
            'email' => $request->email
        ]);
    }

    public function changePassword($request)
    {
        User::where('id', auth()->id())->update([
            'password' => Hash::make($request->password)
        ]);
    }
}