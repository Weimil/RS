<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function like($id)
    {
        $like = new Like();

        $like->{Like::USER_ID} = Auth::user()->{User::ID};
        $like->{Like::IMAGE_ID} = $id;

        $like->save();

        return redirect()->route('dashboard');
    }

    public function dislike($id)
    {
        Like::query()
            ->where(Like::IMAGE_ID, $id)
            ->where(Like::USER_ID, Auth::user()->{User::ID})
            ->delete();

        return redirect()->route('dashboard');
    }

    public function debug_like($image_id, $user_id)
    {
        $like = new Like();

        $like->{Like::USER_ID} = $user_id;
        $like->{Like::IMAGE_ID} = $image_id;

        $like->save();
    }

    public function debug_dislike($image_id, $user_id)
    {
        Like::query()
            ->where(Like::IMAGE_ID, $image_id)
            ->where(Like::USER_ID, $user_id)
            ->delete();
    }
}
