<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $images = Image::query()
            ->where(Image::USER_ID, Auth::user()->{User::ID})
            ->get();

        $friends = Auth::user()->getFriends();
        $requests = Auth::user()->getPendingFriendships();
        $users = User::all();

        return view('pages.profile', [
            'images' => $images,
            'user' => Auth::user(),
            'friends' => $friends,
            'requests' => $requests,
            'users' => $users
        ]);
    }
}
