<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function save(Request $request)
    {
        $comment = new Comment();

        $comment->{Comment::USER_ID} = Auth::user()->{User::ID};
        $comment->{Comment::IMAGE_ID} = $request->input('image');
        $comment->{Comment::CONTENT} = $request->input('comment');

        $comment->save();

        return redirect()->route('dashboard');
    }

    public function delete(Request $request)
    {
        Comment::query()
            ->where(Comment::ID, $request->input('comment_id'))
            ->delete();

        return back();
    }
}
