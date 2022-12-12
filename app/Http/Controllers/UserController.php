<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Contracts\Services\User\UserServiceInterface;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    private $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    public function register()
    {
        return view('user.register');
    }

    public function store(RegisterRequest $request)
    {
        $user = $this->userService->register($request);
        Auth::login($user);

        return redirect()->route('home')->with('message', 'account created successfully');
    }

    public function login()
    {
        return view('user.login');
    }

    public function signIn(LoginRequest $request)
    {
        $credentials = ['email' => $request->email, 'password' => $request->password];
        if (Auth::attempt($credentials)) {
            return redirect()->route('home');
        } else {
            return redirect()->back()->with('fail', 'incorect email or password');
        }
    }

    public function profile()
    {
        $userData = $this->userService->getUserData();
        return view('user.profile', compact('userData'));
    }

    public function edit()
    {
        return view('user.edit');
    }

    public function update(UserUpdateRequest $request)
    {
        $this->userService->update($request);
        return redirect()->route('user.profile');
    }

    public function changePasswordPage()
    {
        return view('user.changePassword');
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        $this->userService->changePassword($request);
        return redirect()->route('user.profile');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }
}
