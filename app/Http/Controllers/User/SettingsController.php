<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserUpdateDataRequest;
use App\Http\Requests\User\UserUpdatePasswordRequest;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        return view('user.settings.index', compact('user'));
    }

    public function updateUserData(UserUpdateDataRequest $request)
    {
        auth()->user()->update($request->validated());
        return redirect()->back()->with('success', 'User data successfully updated!');
    }

    public function updateUserPassword(UserUpdatePasswordRequest $request)
    {
        auth()->user()->update($request->validated());
        return redirect()->back()->with('success', 'User password successfully updated!');
    }
}
