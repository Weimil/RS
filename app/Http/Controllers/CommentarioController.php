<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentarioController extends Controller
{
    public function save(Request $request)
    {
        $comentario=$request->input('comentario');
        $imageID=$request->input('imagenCommentario');
        $user=\Auth::user();
        $comment=new Comment();
        $comment->user_id=$user->id;
        $comment->content=$comentario;
        $comment->image_id=$imageID;
        $comment->save();
//        $json=$request->all();
//        $comment=new Comment();
//        $comment->user_id=$json['user_id'];
//        $comment->content=$json['content'];
//        $comment->image_id=$json['image_id'];
//        $comment->save();
//        //var_dump($json);
//        return response()->json($json);
        return redirect()->route('dashboard');
    }
    public function delete(Request $request){
        $comentarioID=$request->input('commentID');
        Comment::where('id',$comentarioID)->delete();
        return redirect()->route('dashboard');
    }
}
