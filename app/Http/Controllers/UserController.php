<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserUpdateStatusRequest;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    public function index()
    {
        $users = $this->userRepository->getUsersRole();
        return Inertia::render("Admin/Users", compact('users'));
    }

    public function updateStatus(UserUpdateStatusRequest $request)
    {
        $data = $request->validated();
        $user = $this->userRepository->get($data['user_id']);
        $user->status = $data['status'];
        $this->userRepository->save($user);
        return redirect()->back();
    }

    public function userQuotes(int $user_id)
    {
        $user = $this->userRepository->get($user_id);
        $quotes = $user->quotes;
        return Inertia::render("Admin/UserQuotes", compact('user', 'quotes'));
    }
}
