<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    protected function index()
    {
        return view('pages.users', [
            'users' => User::query()->orderBy(User::CREATED_AT, 'desc')->get(),
            'friends' => Auth::user()->getFriends(),
            'pending' => Auth::user()->getPendingFriendships()
        ]);
    }

    protected function profile($id)
    {
        return view('pages.user_profile', [
            'user' => User::query()->where(User::ID, $id)->first(),
            'images' => Image::query()->where(Image::USER_ID, $id)->get()
        ]);
    }

    protected function search(Request $request)
    {
        $criteria = $request->input('buscar');

        $users = User::query()
            ->where(User::NAME, 'like', '%' . $criteria . '%')
            ->orWhere(User::SURNAME, 'like', '%' . $criteria . '%')
            ->orWhere(User::USER_NAME, 'like', '%' . $criteria . '%')
            ->get();

        return view('pages.users', ['users' => $users]);
    }

    protected function send(Request $request)
    {
        $recipient = $request->input('recipient');
        $recipient = User::all()->find($recipient);
        Auth::user()->befriend($recipient);
        return $this->index();
    }

    protected function cancel(Request $request)
    {
        $recipient = $request->input('recipient');
        $sender = $request->input('sender');

        DB::table('friendships')
            ->where('recipient_id', $recipient)
            ->where('sender_id', $sender)
            ->delete();

        return $this->index();
    }

    protected function accept(Request $request)
    {
        $senderId = $request->input('sender');
        $sender = User::all()->find($senderId);

        Auth::user()->acceptFriendRequest($sender);

        return $this->index();
    }

    protected function deny(Request $request)
    {
        $sender = User::all()->find($request->input('sender'));

        Auth::user()->denyFriendRequest($sender);

        return $this->index();
    }
}
